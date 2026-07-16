@extends('frontend.layout.master')
@section('content')
<main class="main">

<!-- breadcrumb -->
<div class="site-breadcrumb">
    <div class="site-breadcrumb-bg" style="background: url({{ asset('frontend/images/about-01.jpg') }})"></div>
    <div class="container">
        <div class="site-breadcrumb-wrap">
            <h4 class="breadcrumb-title">Order Confirmed</h4>
            <ul class="breadcrumb-menu">
                <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                <li class="active">Order Confirmed</li>
            </ul>
        </div>
    </div>
</div>
<!-- breadcrumb end -->


<div class="container py-5">
    <div class="text-center py-5">
        <i class="far fa-check-circle text-success" style="font-size: 64px;"></i>

        <h2 class="mt-4">Thank you, {{ $order->customer_name }}!</h2>
        <p class="text-muted">Your order has been placed successfully.</p>

        <div class="d-inline-block text-start mt-4 p-4 border rounded">
            <p><strong>Order No:</strong> {{ $order->order_no }}</p>
            <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_type) }}</p>
            <p><strong>Grand Total:</strong> {{ money($order->grand_total) }}</p>
            <p><strong>Status:</strong> <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span></p>
        </div>

        <div class="mt-4">
            <a href="{{ route('frontend.home.page') }}" class="theme-btn">Continue Shopping</a>
        </div>
    </div>
</div>



</main>
@endsection