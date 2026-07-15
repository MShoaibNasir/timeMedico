@extends('frontend.layout.master')
@section('content')
<main class="main">

<!-- breadcrumb -->
<div class="site-breadcrumb">
    <div class="site-breadcrumb-bg" style="background: url({{ asset('frontend/images/about-01.jpg') }})"></div>
    <div class="container">
        <div class="site-breadcrumb-wrap">
            <h4 class="breadcrumb-title">Shop Checkout</h4>
            <ul class="breadcrumb-menu">
                <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                <li class="active">Shop Checkout</li>
            </ul>
        </div>
    </div>
</div>
<!-- breadcrumb end -->




</main>
@endsection