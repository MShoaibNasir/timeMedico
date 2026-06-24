<?php

namespace App\Http\Controllers\API;

// use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\Frontend\Auth\LoginRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Frontend\Auth\RegisterRequest;
use App\Models\User;
use App\Services\UserAuthService;
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
                'errors' => $validator->errors()
            ], 422);
        }

        $validatedData = $validator->validated();

        $otp = rand(1000, 9999);

        $user = User::updateOrCreate(
            ['email' => $validatedData['email']],
            [
                'name'         => $validatedData['name'],
                'phone_number' => $validatedData['phone_number'],
                'otp'          => 1234,

                'fcmToken'    => $validatedData['fcmToken'],
                'deviceId'    => $validatedData['deviceId'],
                'phoneModel'  => $validatedData['phoneModel'],
                'phoneMake'   => $validatedData['phoneMake'],
                'appVersion'  => $validatedData['appVersion'],
            ]
        );



        return response()->json([
            'success' => true,
            'message' => 'OTP generated successfully',
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
                'errors' => $validator->errors()
            ], 422);
        }

        $user_verify = User::where('email', $request->email)
            ->where('phone_number', $request->phone_number)
            ->where('otp', $request->otp)
            ->first();

        if (!$user_verify) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP'
            ], 401);
        }
        $token = $user_verify->createToken('TIME')->plainTextToken;
        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully',
            'token'   => $token,
            'data'    => [
                'id' => $user_verify->id,
                'name' => $user_verify->name,
                'email' => $user_verify->email,
                'phone_number' => $user_verify->phone_number,
                'fcmToken' => $user_verify->fcmToken,
                'deviceId' => $user_verify->deviceId,
                'phoneModel' => $user_verify->phoneModel,
                'phoneMake' => $user_verify->phoneMake,
                'appVersion' => $user_verify->appVersion,
            ]
        ]);
    }
}
