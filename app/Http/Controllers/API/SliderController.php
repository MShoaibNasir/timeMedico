<?php

namespace App\Http\Controllers\API;

use App\Models\HomeSlider;
use Illuminate\Http\Request;

class SliderController extends BaseController
{

    public function index(Request $request)
    {
        $data = HomeSlider::where('status', 1)->where('type', 'mobile')->where('position', 'upper')->select('id', 'image')->get();
        return $data;
    }
    public function downslider(Request $request)
    {
        $data = HomeSlider::where('status', 1)->where('type', 'mobile')->where('position', 'downside')->select('id', 'image')->get();
        return $data;
    }
}
