<?php

namespace App\Http\Controllers\API;


use App\Models\Product;
use App\Models\Area;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AreaController extends BaseController
{
    public function list()
    {
        return Area::where('status', 1)->get();
    }
}
