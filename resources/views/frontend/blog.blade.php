@extends('frontend.layout.master')
@section('content')
<main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb">
<div class="site-breadcrumb-bg" style="background: url('{{ asset('frontend/images/about-01.jpg') }}');"></div>            <div class="container">
                <div class="site-breadcrumb-wrap">
                    <h4 class="breadcrumb-title">Blog</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                        <li class="active">Blog</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- breadcrumb end -->


        <!-- about area -->
        <div class="about-area py-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-left wow fadeInLeft" data-wow-delay=".25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInLeft;">
                            <div class="about-img">
                                <div class="row">
                                    <div class="col-9">
                                        <img class="img-1" src="{{ asset($blog->image) }}" alt="">
                                    </div>
                                
                                </div>
                            </div>
                          
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-right wow fadeInRight" data-wow-delay=".25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInRight;">
                            <div class="site-heading mb-3">
                            
                                <h2 class="site-title">
                                   {{ $blog->name }}
                                </h2>
                            </div>
                            <p>
                                {{ $blog->description }}
                            </p>
                          
                           </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection