<?php

namespace App\Http\Controllers\API;
use App\Models\HomeSlider;
use Illuminate\Http\Request;

class SliderController extends BaseController
{

    public function index(Request $request)
    {
        $data = HomeSlider::where('status', 1)->select('id', 'image')->get();
        return $data;
    }
}
