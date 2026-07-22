<?php

namespace App\Http\Controllers\API;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;

class WebsiteSettingController extends BaseController
{

    public function index(Request $request)
    {
        $data = WebsiteSetting::where('id', 1)->first();
        return $data;
    }
}
