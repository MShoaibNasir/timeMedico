<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Area;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Throwable;

class OrderController extends Controller
{
    

    public function placeOrder(Request $request): JsonResponse
    {
        // ===================================================================
        // STEP 1: Validation - SIRF non-financial data client se accept karte hain.
        // Price/discount/total kahin se bhi validate nahi ho rahe client se -
        // ye hamesha DB se (product ki current price/discount se) calculate honge.
        // ===================================================================
        $validator = Validator::make($request->all(), [
            'user_id'              => ['required', 'exists:users,id'],
            'customer_name'        => ['required', 'string', 'max:255'],
            'customer_email'       => ['required', 'email', 'max:255'],
            'phone'                => ['required', 'string', 'max:20'],
            'area_id'                => ['required', 'integer'],
            // SECURITY: address_id sirf usi user_id se belong karni chahiye jo
            // request mein diya gaya hai - koi doosre user ka address_id use
            // na ho sake (chahe user_id khud tamper bhi ho jaye, address
            // ownership check ek extra layer hai).
            'address_id'           => [
                'required',
                'integer',
                Rule::exists('customer_address', 'id')->where('user_id', $request->input('user_id')),
            ],
 
            'delivery_instruction' => ['nullable', 'string', 'max:500'],
            'payment_type'         => ['required', 'in:cod,online'],
            //'image_payment_slip'   => ['nullable', 'string', 'max:500'], // pehle se uploaded file ka path/URL
            'image_payment_slip' => ['nullable','file','mimes:jpg,jpeg,png,pdf','max:2048'],
 
            'coupon_code'          => ['nullable', 'string', 'exists:coupons,code'],
 
            // Items mein SIRF product_id aur quantity chahiye - price/discount
            // client se accept hi nahi kar rahe (security ke liye).
            'items'                => ['required', 'array', 'min:1'],
            'items.*.product_id'   => ['required', 'exists:products,id'],
            'items.*.quantity'     => ['required', 'integer', 'min:1', 'max:100'],
        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }
 
        $validated = $validator->validated();
 
        // ===================================================================
        // STEP 2: Address snapshot + coupon resolve karein
        // ===================================================================
        $address = CustomerAddress::findOrFail($validated['address_id']);
        $addressSnapshot = trim("{$address->address_type} - {$address->address}");
        $area = Area::findOrFail($validated['area_id']);
        
        // Payment slip upload (agar online payment/bank transfer flow ho)
        $paymentSlipPath = null;
        if ($request->hasFile('image_payment_slip')) {
            $paymentSlipPath = $request->file('image_payment_slip')->store('payment-slips', 'public');
        }


        $coupon = null;
        if (! empty($validated['coupon_code'])) {
            $coupon = Coupon::where('code', $validated['coupon_code'])->first();
 
            if (! $coupon || ! $coupon->isValid()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This coupon is invalid or has expired.',
                ], 422);
            }
        }
 
        // ===================================================================
        // STEP 3: Transaction ke andar - order + items + stock decrement +
        // coupon usage sab ek sath succeed/fail hote hain
        // ===================================================================
        try {
            $order = DB::transaction(function () use ($validated, $addressSnapshot, $area, $coupon, $paymentSlipPath) {
 
                // --- Har item ke liye DB se authoritative price/discount nikalein,
                // aur stock lock kar ke verify karein (client se koi price accept nahi) ---
                $orderItemsData = [];
                $subTotal = 0;
                $productDiscountTotal = 0;
 
                foreach ($validated['items'] as $itemInput) {
                    $product = Product::where('id', $itemInput['product_id'])->lockForUpdate()->first();
 
                    if (! $product || $product->status !== 1) {
                        throw ValidationException::withMessages([
                            'items' => "Product ID {$itemInput['product_id']} is no longer available.",
                        ]);
                    }
 
                    if (isset($product->stock) && $itemInput['quantity'] > $product->stock) {
                        throw ValidationException::withMessages([
                            'items' => "Only {$product->stock} of \"{$product->name}\" left in stock.",
                        ]);
                    }
 
                    $discountPercentage = $product->discount ?? 0;
                    $priceAfterDiscount = $product->price - ($product->price * $discountPercentage / 100);
                    $lineSubtotal = $priceAfterDiscount * $itemInput['quantity'];
 
                    $subTotal += $product->price * $itemInput['quantity'];
                    $productDiscountTotal += ($product->price * $itemInput['quantity']) - $lineSubtotal;
 
                    $orderItemsData[] = [
                        'product'              => $product,
                        'quantity'             => $itemInput['quantity'],
                        'price'                => $product->price,
                        'discount_percentage'  => $discountPercentage,
                        'price_after_discount' => $priceAfterDiscount,
                        'subtotal'             => $lineSubtotal,
                    ];
                }
 
                // --- Coupon discount (agar apply hai) - subtotal minus product discount ke against ---
                $afterProductDiscount = $subTotal - $productDiscountTotal;
                $couponDiscount = $coupon ? $coupon->calculateDiscount($afterProductDiscount) : 0;
 

                 $deliveryFee = (float) str_replace(',', '', $area->delivery_charges);
                //$deliveryFee = (float) config('cart.delivery_fee');
                $platformFee = (float) config('cart.platform_fee');
                $afterDiscount = max(0, $afterProductDiscount - $couponDiscount);
                $grandTotal = $afterDiscount + $deliveryFee + $platformFee;
 
                // --- Order create karein (order_no temporary placeholder se,
                // kyunke asal order_no sirf insert ke baad $order->id se milta hai) ---
                $order = Order::create([
                    'order_no'              => 'TEMP-' . uniqid(),
                    'user_id'               => $validated['user_id'],
                    'customer_name'         => $validated['customer_name'],
                    'customer_email'        => $validated['customer_email'],
                    'phone'                 => $validated['phone'],
                    'address'               => $addressSnapshot,
                    'area'                  => $area->name ?? '',
                    'delivery_instruction'  => $validated['delivery_instruction'] ?? null,
                    'total_amount'          => $subTotal,
                    'discount'              => $productDiscountTotal + $couponDiscount,
                    'coupon_code'           => $coupon?->code,
                    'coupon_discount'       => $couponDiscount,
                    'after_discount_amount' => $afterDiscount,
                    'delivery_charges'      => $deliveryFee,
                    'platform_fee'          => $platformFee,
                    'grand_total'           => $grandTotal,
                    'payment_type'          => $validated['payment_type'],
                    'image_payment_slip'    => $paymentSlipPath, //$validated['image_payment_slip'] ?? null,
                    'status'                => 'Pending',
                ]);
 
                $order->order_no = 100000000 + $order->id;
                $order->save();
 
                // --- Order items create karein + stock decrement karein ---
                foreach ($orderItemsData as $data) {
                    OrderItem::create([
                        'order_id'             => $order->id,
                        'product_id'           => $data['product']->id,
                        'name'                 => $data['product']->name,
                        'quantity'             => $data['quantity'],
                        'price'                => $data['price'],
                        'discount_percentage'  => $data['discount_percentage'],
                        'price_after_discount' => $data['price_after_discount'],
                        'subtotal'             => $data['subtotal'],
                    ]);
 
                    if (isset($data['product']->stock)) {
                        $data['product']->decrement('stock', $data['quantity']);
                    }
                }
 
                if ($coupon) {
                    $coupon->increment('used_count');
                }
 
                return $order;
            });
        } catch (ValidationException $e) {
            // Business errors (stock khatam, product unavailable) - user ko dikhana theek hai
            return response()->json([
                'success' => false,
                'message' => collect($e->errors())->flatten()->first(),
            ], 422);
        } catch (Throwable $e) {
            // Unexpected/system errors - detail sirf log mein
            Log::error('Mobile order placement failed', [
                'user_id' => $request->input('user_id'),
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);
 
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while placing your order. Please try again.',
            ], 500);
        }
 
        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully',
            'data'    => [
                'id'             => $order->id,
                'order_no'       => $order->order_no,
                'customer_name'  => $order->customer_name,
                'total_amount'   => $order->total_amount,
                'discount'       => $order->discount,
                'coupon_discount' => $order->coupon_discount,
                'delivery_charges' => $order->delivery_charges,
                'platform_fee'   => $order->platform_fee,
                'grand_total'    => $order->grand_total,
                'payment_type'   => $order->payment_type,
                'status'         => $order->status,
            ],
        ]);
    }






    public function placeOrderOld(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'customer_name'      => 'required|string|max:255',
            'phone'              => 'required|string|max:20',
            'address'            => 'required|string',
            'user_id'            => 'required|exists:users,id',
            'total_amount'       => 'required|numeric|min:0',
            'delivery_charges'   => 'nullable|numeric|min:0',
            'discount'           => 'nullable|numeric|min:0',
            'after_discount_amount' => 'nullable|numeric|min:0',
            'payment_type'       => 'required|in:Cash,JazzCash,EasyPaisa,Bank Transfer,COD,Online',
            'image_payment_slip' => 'nullable|string',
            'items'              => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.name'       => 'required|string',
            'items.*.quantity'   => 'required|integer|min:1',
            'items.*.price'      => 'required|numeric|min:0',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        DB::beginTransaction();

        try {


            $lastOrder = Order::lockForUpdate()->latest('id')->first();

            $orderNo = $lastOrder
                ? ((int) $lastOrder->order_no) + 1
                : 100000001;

            $order = Order::create([
                'order_no'         => $orderNo,
                'user_id'          => $request->user_id,
                'customer_name'    => $request->customer_name,
                'phone'            => $request->phone,
                'address'          => $request->address,
                'total_amount'     => $request->total_amount,
                'delivery_charges' => $request->delivery_charges ?? 0,
                'discount'         => $request->discount ?? 0,
                'after_discount_amount' =>  $request->after_discount_amount ?? 0,
                'payment_type'     => $request->payment_type,
                'image_payment_slip' => $request->image_payment_slip ?? null,
                'status'           => 'Pending'
            ]);

            foreach ($request->items as $item) {

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product_id'],
                    'name'       => $item['name'],
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                    'discount_percentage' => $item['discount_percentage'],
                    'price_after_discount' => $item['price_after_discount'],
                    'subtotal'   => $item['quantity'] * $item['price_after_discount']
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully',
                'data' => [
                    'id' => $order->id,
                    'order_no' => $order->order_no,
                    'customer_name' => $order->customer_name,
                    'total_amount' => $order->total_amount,
                    'delivery_charges' => $order->delivery_charges,
                    'discount' => $order->discount,
                    'payment_type' => $order->payment_type,
                    'status' => $order->status
                ]
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getUserOrders(Request $request)
    {
        $user_id = $request->id;

        $orders = Order::with('items', 'items.product_image')
            ->where('user_id', $user_id)
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Orders fetched successfully',
            'data' => $orders
        ]);
    }
}
