<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Models\CustomerAddress;

class CustomerAddressController extends Controller
{

    public function show()
    {
        return view('frontend.uploadAddress');
    }




    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address'      => 'required|string',
            'address_type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user_id = Auth::guard('web')->id();

        $first_address = CustomerAddress::where('user_id', $user_id)->first();

        $is_primary = $first_address ? 0 : 1;

        CustomerAddress::create([
            'user_id'      => $user_id,
            'address'      => $request->address,
            'address_type' => $request->address_type,
            'is_primary'   => $is_primary,
        ]);

        return redirect()->route('frontend.customer.address.list')->with('success', 'Address uploaded successfully!');
    }

    public function list()
    {
        $user_id = Auth::guard('web')->id();
        $customer_address = CustomerAddress::where('user_id', $user_id)->get();
        return view('frontend.addressList', ['customer_address' => $customer_address]);
    }
    public function makePrimary(Request $request,$id)
    {
        $user_id = Auth::guard('web')->id();
        CustomerAddress::where('user_id', $user_id)->update(['is_primary'=>0]);
        CustomerAddress::where('id', $id)->update(['is_primary'=>1]);
        return redirect()->back()->with(['success'=>"Primary Address Change Successfully!"]);
    }
}
