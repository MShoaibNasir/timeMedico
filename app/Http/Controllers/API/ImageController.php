<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UploadPrescription;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;



class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'   => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'path'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all(),
            ], 422);
        }

        $imagePath = null;
        $path=$request->path;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store($path, 'public');
        }

       

        return response()->json([
            'success' => true,
            'message' => 'Image uploaded successfully.',
            'image'=>$imagePath
        ]);
    }
}
