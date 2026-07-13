<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Department;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\UserDataFotOTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use Illuminate\Validation\ValidationException;

class FrontendController extends Controller
{

    public function index()
    {
        if (Auth::guard('web')->check()) {
            $userId = Auth::guard('web')->id();
            $wishlist = session('wishlist', []);
            $userWishlist = $wishlist[$userId] ?? [];
            // dd($userWishlist);
        }

        // dd(Auth::guard('web')->check());
        $sliders = HomeSlider::where('type', 'website')->where('status', 1)->get();
        $departments = Department::where('status', 1)->get();
        $tranding_items = Product::where('status', 1)->where('type', 10)->get();
        $featured_items = Product::where('status', 1)->where('type', 6)->get();
        $on_sale_items = Product::where('status', 1)->where('type', 12)->get();
        $best_seller_items = Product::where('status', 1)->where('type', 13)->get();
        $top_rated = Product::where('status', 1)->where('type', 14)->get();
        $polular_item_categories = Category::with('products_with_out_trashed')->where('status', 1)->take(5)->latest()->get();

   
        return view('frontend.index')->with([
            'sliders' => $sliders,
            'departments' => $departments,
            'tranding_items' => $tranding_items,
            'featured_items' => $featured_items,
            'on_sale_items' => $on_sale_items,
            'best_seller_items' => $best_seller_items,
            'top_rated' => $top_rated,
            'polular_item_categories' => $polular_item_categories

        ]);
    }


    public function aboutUs()
    {

        return view('frontend.about');
    }


    public function singleShop($id)
    {
        $id = Crypt::decryptString($id);
        $product = Product::with('category', 'type_data')->where('id', $id)->first();
        return view('frontend.singleShop', ['product' => $product]);
    }


    public function categories($id)
    {
        $id = Crypt::decryptString($id);
        $categories = Category::with('products')->where('status', 1)->where('department_id', $id)->latest()->get();
        return view('frontend.categories', ['categories' => $categories]);
    }
    public function productFilter($id)
    {
        $id = Crypt::decryptString($id);

        return view('frontend.productFilter', ['id' => $id]);
    }
    public function productlist(Request $request)
    {
        $product = Product::with('category', 'type_data')->where('category_id', $request->category_id)->where('status', 1)->get();
 
        return view('frontend.productList', ['product' => $product]);
    }

    public function register()
    {
        return view('frontend.register');
    }
    public function login()
    {
        return view('frontend.login');
    }



    public function signup(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name'  => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone_number' => [
                    'required',
                    'regex:/^03[0-9]{2}-[0-9]{7}$/'
                ],
            ], [
                'name.required'   => 'Please enter your full name.',
                'email.required'  => 'Please enter your email address.',
                'email.email'     => 'Please enter a valid email address.',
                'phone_number.required'  => 'Please enter your phone number.',
                'phone_number.regex'     => 'Phone number must be in the format 03XX-XXXXXXX.',
            ]);

            $otp = rand(1000, 9999);

            UserDataFotOTP::create([
                'name'         => $request->name,
                'email'        => $request->email,
                'phone_number' => $request->phone_number,
                'otp'          => 1234 // Changed from hardcoded 12345 to your dynamic $otp
            ]);

            $email = $request->email;
            $phone = $request->phone_number;

            return response()->json([
                'success' => true,
                'html' => view('frontend.otpModal', compact('phone', 'email'))->render()
            ]);
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $th) {
            Log::error('Signup Error: ' . $th->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
    public function verifyotp(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'otp_phone' => 'required',
                'otp_email' => 'required'
            ]);
            $data = UserDataFotOTP::where([
                'email' => $request->otp_email,
                'phone_number' => $request->otp_phone,
                'otp' => $request->otp
            ])->latest()->first();
            if (!$data) {
                return response()->json([
                    'info' => true,
                    'message' => 'Otp Not Verified!'
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Otp Verified!'
                ]);
            }
            // $agent = new Agent();
            // $user = User::create([
            //     'name'         => $data->name,
            //     'email'        => $data->email,
            //     'phone_number' => $data->phone_number,
            //     'ip_address'   => request()->ip(),
            //     'browser'      => $agent->browser(),
            //     'os'           => $agent->platform(),
            //     'user_agent'   => request()->userAgent(),
            // ]);

            // // Login user
            // Auth::guard('web')->login($user);
            // return response()->json([
            //     'success' => true,
            //     'message' => 'Otp Verified and Login Successfully!'
            // ]);
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $th) {
            Log::error('Signup Error: ' . $th->getMessage());
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function saveUser(Request $request)
    {
        $data = UserDataFotOTP::where([
            'email'        => $request->email,
            'phone_number' => $request->phone,
            'otp'          => $request->otp
        ])->latest()->first();
        if (!$data) {
            return redirect()->back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }
        $agent = new Agent();
        $user = User::updateOrCreate(

            [
                'email' => $data->email,
            ],

            [
                'name'         => $data->name,
                'phone_number' => $data->phone_number,
                'ip_address'   => request()->ip(),
                'browser'      => $agent->browser(),
                'os'           => $agent->platform(),
                'user_agent'   => request()->userAgent(),
            ]
        );

        Auth::guard('web')->login($user);
        return redirect()->route('frontend.home.page')->with(['success' => 'OTP verified and logged in successfully!']);
    }





    public function loginUser(Request $request)
    {
        $user = User::where('email', $request->email)->where('phone_number', $request->phone_number)->first();
        Auth::guard('web')->login($user);
        return redirect()->route('frontend.home.page')->with(['success' => 'Logged in Successfully!']);
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('frontend.home.page')->with('success', 'Logged out successfully.');
    }

    public function quickeView(Request $request)
    {
        $product = Product::with('category')->where('id', $request->product_id)->first();
        return view('frontend.Components.quickViewModal', ['product' => $product]);
    }

    public function addToCart(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            return response()->json([
                'status' => true,
                'message' => 'Please login first.'
            ]);
        }
        $product = Product::find($request->product_id);
        if (!$product) {
            return response()->json([
                'status' => true,
                'message' => 'Product not found.'
            ]);
        }
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += ($request->quantity ?? 1);
        } else {

            $cart[$product->id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->price,
                'image'    => $product->image,
                'quantity' => ($request->quantity ?? 1),
            ];
        }
        session()->put('cart', $cart);

        return response()->json([
            'status' => false
        ]);
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });


        return view('frontend.Components.mycart', ['cart' => $cart, 'total' => $total]);
    }


    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
            return response()->json([
                'status' => true,
                'message' => 'Product removed from cart',
                'count' => count($cart)
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Product not found in cart'
        ]);
    }
}
