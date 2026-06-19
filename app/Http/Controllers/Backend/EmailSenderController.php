<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Jobs\BulkEmailJob;
use App\Jobs\TestJob;
use App\Services\EmailSendServices;
use Illuminate\Http\Request;

class EmailSenderController extends Controller
{
    public function __construct(
        protected emailSendServices $emailsendService
    ) {}

    public function filter()
    {
        return view('backend.User.filter');
    }

    public function index(Request $request)
    {

        $data = $this->emailsendService->index($request);

        return view('backend.User.list', compact('data'));
    }

    public function create()
    {
        return view('backend.event.create');
    }

    public function bulkEmail(Request $request)
    {

        $ids = $request->input('user_ids', []);
        $subject = $request->input('subject');
        $body = $request->input('body');

        if (! $subject || ! $body) {
            return back()->with('error', 'Subject and message are required.');
        }
        BulkEmailJob::dispatch($ids, $subject, $body);
        return back()->with('success', 'Emails are being sent in the background!');
    }
}
