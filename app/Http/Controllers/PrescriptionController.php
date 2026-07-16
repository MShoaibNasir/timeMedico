<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Department;
use App\Models\HomeSlider;
use App\Models\CustomerAddress;
use App\Models\UserDataFotOTP;
use App\Models\UploadPrescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\ValidationException;

class PrescriptionController extends Controller
{


    public function show()
    {
        $id = Auth::guard('web')->user()->id;
        $customer_address = CustomerAddress::where('user_id', $id)->where('is_primary', 1)->first();


        if (!$customer_address) {
            return redirect()->back()->with([
                'info' => 'Please upload the address before proceeding further.'
            ]);
        }


        $address_id = $customer_address->id;
        $address = $customer_address->address;
        $address_type = $customer_address->address_type;


        return view('frontend.prescription', ['address_id' => $address_id, 'address' => $address, 'address_type' => $address_type]);
    }

    public function upload(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'image' => 'required|file',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user_id = Auth::guard('web')->id();


        $imagePath = 'prescription';
        $path = $request->path;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store($path, 'public');
        }



        $prescription = UploadPrescription::create([
            'user_id' => $user_id,
            'address' => $request->address,
            'address_type' => $request->address_type,
            'address_id' => $request->address_id,
            'image'   => $imagePath
        ]);

        return redirect()->route('frontend.prescription.list')->with('success', 'Prescription  uploaded successfully!');
    }

    public function list()
    {
        $user_id = Auth::guard('web')->id();
        $prescription = UploadPrescription::where('user_id', $user_id)->latest()->get();
        return view('frontend.prescriptionList', ['prescription' => $prescription]);
    }
  
}
