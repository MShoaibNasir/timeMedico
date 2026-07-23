<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Frontend\Feedback\UploadRequest;
use App\Services\FeedbackServices;

class FeedbackController extends BaseController
{
    protected FeedbackServices $feedbackServices;

    public function __construct(FeedbackServices $feedbackServices)
    {
        $this->feedbackServices = $feedbackServices;
    }

    public function upload(UploadRequest $request)
    {
        $data = $request->validated();

        if (!$request->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'User ID is required.'
            ], 422);
        }

        $data['user_id'] = $request->user_id;

        $feedback = $this->feedbackServices->upload($data);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your feedback. We appreciate your valuable input.',
            'data' => $feedback
        ], 200);
    }
}
