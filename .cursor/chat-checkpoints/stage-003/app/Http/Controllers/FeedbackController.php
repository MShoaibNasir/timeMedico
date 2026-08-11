<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\Frontend\Feedback\UploadRequest;
use App\Services\FeedbackServices;
use Illuminate\Support\Facades\Auth;


class FeedbackController extends Controller
{
    protected FeedbackServices $feedbackServices;
    public function __construct(FeedbackServices $feedbackServices)
    {
        $this->feedbackServices = $feedbackServices;
    }


    public function show()
    {

        return view('frontend.feedback');
    }

    public function upload(UploadRequest $request)
    {
        $data = $request->validated();
        if (!Auth::guard('web')->check()) {
            return frontend_redirect_to_login(url()->previous());
        }
        $data['user_id'] = Auth::guard('web')->user()->id;

        $this->feedbackServices->upload($data);
        return redirect()->back()->with(
            'success',
            'Thank you for your feedback. We appreciate your valuable input.'
        );
    }


    // public function list()
    // {
    //     $feedbacks = $this->feedbackServices->list();
    //     return view('frontend.feedbackList',['feedbacks'=>$feedbacks]);
    // }
}
