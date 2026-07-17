<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;

class BlogsController extends Controller
{


    public function show($id)
    {
        $blog=Blog::where('id',$id)->first();
        return view('frontend.blog',['blog'=>$blog]);
    }
}
