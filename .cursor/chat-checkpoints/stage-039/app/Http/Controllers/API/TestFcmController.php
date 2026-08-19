<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\FcmService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * TEMPORARY / TESTING ONLY.
 * Remove this controller and the POST /api/test/fcm route after FCM is verified.
 */
class TestFcmController extends Controller
{
    /** TEMPORARY test device token — not persisted. */
    private const TEST_FCM_TOKEN = 'cPKfzrp-RcWXgXQnV3ueJt:APA91bFFaLrFzvV1DH-96aGlSB3sQeilKKJU7YhzHRhtYvx3PVtm0WciE8voRl77p1ViWtmbVr5yvmcMmSsNE7UF5kfGTnGcuox8mCa2McRaynfeOazVpUE';

    public function send(Request $request, FcmService $fcm): JsonResponse
    {
        $token = trim((string) $request->input('fcmToken', self::TEST_FCM_TOKEN));
        if ($token === '') {
            $token = self::TEST_FCM_TOKEN;
        }

        $title = 'Time Medico Test Notification';
        $body = 'Firebase push notification is working successfully.';
        $data = [
            'type' => 'test',
            'message' => 'FCM test notification',
        ];

        try {
            $result = $fcm->send($token, $title, $body, $data);

            return response()->json([
                'success' => true,
                'temporary' => true,
                'message' => 'Firebase accepted the test notification.',
                'title' => $title,
                'body' => $body,
                'data' => $data,
                'fcm_result' => $result,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'temporary' => true,
                'message' => 'Firebase rejected the test notification.',
                'error' => $e->getMessage(),
                'error_class' => $e::class,
            ], 422);
        }
    }
}
