<?php

namespace App\Http\Controllers\API;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends BaseController
{
   
    public function index(Request $request)
    {
        
        $data = Department::where('status',1)->select('id','name','image')->get();
        return $data;
    }

    

 

   
    
}
