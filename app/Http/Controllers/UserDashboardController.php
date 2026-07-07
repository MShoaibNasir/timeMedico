<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class UserDashboardController extends Controller
{

    public function show(Request $request)
    {
        return view('frontend.UserDashboard');
    }
}
