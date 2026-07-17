<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UploadPrescription;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;



class PrescriptionController extends Controller
{
    public function upload(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'address' => 'required|string|max:255',
            'image'   => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all(),
            ], 422);
        }

        // $imagePath = null;

        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('prescriptions', 'public');
        // }

        $prescription = UploadPrescription::create([
            'user_id' => $request->user_id,
            'address' => $request->address,
            'image'   => $request->image,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Prescription uploaded successfully.',
            'data' => $prescription
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
                'message' => $validator->errors()->all(),
            ], 422);
        }
        $user_id = $request->user_id;
        $prescription = UploadPrescription::where('user_id', $user_id)->latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'Prescription get successfully.',
            'data' => $prescription
        ]);
    }
}
