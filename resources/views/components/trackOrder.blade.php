@if(!$order)

<div class="alert alert-warning">
    Enter a valid order number to track your order.
</div>

@else

@php

$statusSteps = [
    'Pending'    => 1,
    'Processing' => 2,
    'On The way' => 3,
    'Delivered'  => 4,
];

$currentStep = $statusSteps[$order->status] ?? 0;

@endphp

@if(in_array($order->status,['Rejected','Returned']))

<div class="alert alert-danger">
    <strong>Order Status:</strong> {{ $order->status }}
</div>

@else

<div class="mb-4 text-center">
    <h5>Order #{{ $order->order_no }}</h5>
    <span class="badge bg-primary">{{ $order->status }}</span>
</div>

<div class="track-order-step">

    <div class="step-item {{ $currentStep >= 1 ? 'completed' : '' }}">
        <div class="step-icon">
            <i class="fal fa-shopping-cart"></i>
        </div>
        <h6>Order Confirmed</h6>
    </div>

    <div class="step-item {{ $currentStep >= 2 ? 'completed' : '' }}">
        <div class="step-icon">
            <i class="fal fa-cog"></i>
        </div>
        <h6>Processing</h6>
    </div>

    <div class="step-item {{ $currentStep >= 3 ? 'completed' : '' }}">
        <div class="step-icon">
            <i class="fal fa-truck-fast"></i>
        </div>
        <h6>On The Way</h6>
    </div>

    <div class="step-item {{ $currentStep >= 4 ? 'completed' : '' }}">
        <div class="step-icon">
            <i class="fal fa-home"></i>
        </div>
        <h6>Delivered</h6>
    </div>

</div>

@endif

@endif