<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Log;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.pages.index');
    }

    public function logs()
    {
        $logs = Log::get();

        return view('backend.logs.index', compact('logs'));
    }

    public function cvReview()
    {
        return view('backend.curriculum-vitae.index');
    }
}
