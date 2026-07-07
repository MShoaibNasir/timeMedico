<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\CustomerAddress;

class CustomerAddressController extends BaseController
{

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address'      => 'required|string',
            'address_type' => 'required|string',
            'user_id' => 'required|integer',
            //'is_primary'   => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ], 422);
        }
        $address = CustomerAddress::create([
            'user_id'      => $request->user_id,
            'address'      => $request->address,
            'address_type' => $request->address_type,
            // 'is_primary'   => $request->is_primary ?? 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Address added successfully.'

        ]);
    }
    public function is_primary(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id'      => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ], 422);
        }



        CustomerAddress::where('user_id', $request->user_id)->update(['is_primary' => 0]);
        CustomerAddress::where('id', $request->address_id)->where('user_id', $request->user_id)->update(['is_primary' => 1]);

        return response()->json([
            'success' => true,
            'message' => 'Address has been set as your primary address successfully.'

        ]);
    }


    public function list(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ], 422);
        }
        
        return CustomerAddress::latest()->where('user_id', $request->user_id)->get();
    }
}
