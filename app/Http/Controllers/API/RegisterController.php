<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\UserDataFotOTP;
use Illuminate\Http\Request;

class RegisterController extends BaseController
{



    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:255',
            'email'        => 'required|string|email|max:255',
            'phone_number' => 'required|string',
            'fcmToken' => 'required|string',
            'deviceId' => 'required|string',
            'phoneModel' => 'required|string',
            'phoneMake' => 'required|string',
            'appVersion' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $validatedData = $validator->validated();
        $otp = rand(1000, 9999);
        UserDataFotOTP::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
            'otp'          => 1234,
            'fcmToken' => $request->fcmToken,
            'deviceId' => $request->deviceId,
            'phoneModel' => $request->phoneModel,
            'phoneMake' => $request->phoneMake,
            'appVersion' => $request->appVersion
        ]);
        return response()->json([
            'success' => true,
            'message' => 'OTP sent to your email ' . $request->email . '.',
            'otp'     => 1234,
        ]);
    }



    public function tokenVerify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'        => 'required|string|email|max:255',
            'phone_number' => 'required|string',
            'otp'          => 'required|digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $data = UserDataFotOTP::where([
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'otp' => $request->otp
        ])->latest()->first();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP. Please enter the correct code.'
            ], 401);
        }




        $user = User::updateOrCreate(
            [
                'email' => $data->email,
            ],
            [
                'name'         => $data->name,
                'phone_number' => $data->phone_number,
                'fcmToken' => $data->fcmToken,
                'deviceId' => $data->deviceId,
                'phoneModel' => $data->phoneModel,
                'phoneMake' => $data->phoneMake,
                'appVersion' => $data->appVersion



            ]
        );

        $token = $user->createToken('TIME')->plainTextToken;
        return response()->json([
            'success' => true,
            'message' => 'OTP Verified Successfully',
            'token'   => $token,
            'data'    => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'fcmToken' => $user->fcmToken,
                'deviceId' => $user->deviceId,
                'phoneModel' => $user->phoneModel,
                'phoneMake' => $user->phoneMake,
                'appVersion' => $user->appVersion,
            ]
        ]);
    }
}
