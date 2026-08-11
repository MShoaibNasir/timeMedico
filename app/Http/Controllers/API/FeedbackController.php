<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Frontend\Feedback\UploadRequest;
use App\Services\FeedbackServices;
use Illuminate\Http\Request;
use App\Models\Feedback;


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


    public function list(Request $request)
    {
        if (!$request->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'User ID is required.'
            ], 422);
        }
        return Feedback::where('user_id', $request->user_id)->where('status', 1)->get();
    }
}
