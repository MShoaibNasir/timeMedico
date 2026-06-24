<?php

namespace App\Http\Controllers\API;


use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Services\AwardServices;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
  

   
    public function index(Request $request)
    {
             $validator = Validator::make($request->all(), [
            'department_id'  => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        $data = Category::where('status', 1)->where('department_id',$request->department_id)->select('id','name','image')->get();
        return $data;
    }

   
}
