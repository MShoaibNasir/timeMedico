<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserDataFotOTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'appVersion' => $request->appVersion,

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
                'image' => $user->image,
                'bio'          => $user->bio,
                'phoneModel' => $user->phoneModel,
                'phoneMake' => $user->phoneMake,
                'appVersion' => $user->appVersion,
            ]
        ]);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|string',
            'name'         => 'required|string',
            'bio'          => 'required|string',
            'user_id'      => 'required|exists:users,id',
            'image'        => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User Not Found.'
            ], 404);
        }

        $user->update([
            'name'         => $request->name,
            'phone_number' => $request->phone_number,
            'bio'          => $request->bio,
            'image'        => $request->image,
        ]);

        $user->refresh();

        return response()->json([
            'success' => true,
            'message' => 'User Updated Successfully',
            'data'    => [
                'id'           => $user->id,
                'name'         => $user->name,
                'email'        => $user->email,
                'phone_number' => $user->phone_number,
                'bio'          => $user->bio,
                'image'        => $user->image,
                'fcmToken'     => $user->fcmToken,
                'deviceId'     => $user->deviceId,
                'phoneModel'   => $user->phoneModel,
                'phoneMake'    => $user->phoneMake,
                'appVersion'   => $user->appVersion,
            ]
        ]);
    }

    public function marquee()
    {
        return 'Welcome to the official Time Medico App. Please use only our official app for a safe and secure experience.';
    }
    public function privacyPolicy()
    {
        $policy = Setting::where('key', 'privacy_policy')->first();

        return response()->json([
            'status' => true,
            'title' => 'Privacy Policy',
            'content' => $policy?->value,
        ]);
    }
}
