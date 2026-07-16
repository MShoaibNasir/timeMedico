<?php

namespace App\Http\Controllers\API;


use Illuminate\Support\Facades\Validator;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends BaseController
{



    public function getCoupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $coupon = Coupon::where('code', $request->coupon_code)
            ->where('status', 1)
            ->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid coupon code.'
            ], 404);
        }

        // Expiry Check
        if ($coupon->expires_at && now()->gt($coupon->expires_at)) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon has expired.'
            ], 422);
        }

        // Usage Limit Check
        if (!is_null($coupon->usage_limit) && $coupon->used_count >= $coupon->usage_limit) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon usage limit reached.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Coupon applied successfully.',
            'data' => [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'type' => $coupon->type,
                'value' => $coupon->value,
                'min_order_amount' => $coupon->min_order_amount,
                'max_discount_amount' => $coupon->max_discount_amount,
            ]
        ]);
    }
}
