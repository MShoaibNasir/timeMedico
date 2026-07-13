<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;


class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'customer_name'      => 'required|string|max:255',
            'phone'              => 'required|string|max:20',
            'address'            => 'required|string',
            'user_id'            => 'required|exists:users,id',
            'total_amount'       => 'required|numeric|min:0',
            'delivery_charges'   => 'nullable|numeric|min:0',
            'discount'           => 'nullable|numeric|min:0',
            'payment_type'       => 'required|in:Cash,JazzCash,EasyPaisa,Bank Transfer',
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
                    'price_after_dicount' => $item['price_after_dicount'],
                    'subtotal'   => $item['quantity'] * $item['price_after_dicount']
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => true,
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

        $orders = Order::with('items')
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
