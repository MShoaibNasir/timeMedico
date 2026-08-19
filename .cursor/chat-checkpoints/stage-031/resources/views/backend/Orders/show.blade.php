@extends('backend.layout.master')
@section('content')

<div class="container py-5">
    <div class="row">

@if($order->order_source=='Admin Panel' && $order->payment_type=='online')
        <div class="alert alert-info">
            <strong>Instructions:</strong>
            Since you are placing this order on behalf of the customer, please share the following link with the customer to complete the online payment:
            <strong>http://timesmedico.test/user-dashboard/upload-Payment</strong>
        </div>
@endif

        <div class="col-lg-12">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Order Header -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h3 class="mb-1">Order #{{ $order->order_no }}</h3>
                            <p class="text-muted mb-0">
                                Placed on {{ $order->created_at->format('d M Y h:i A') }}
                            </p>
                            <p class="text-muted mb-0">
                                Payment Type <span class="badge  bg-danger">{{ strtoupper($order->payment_type) }}</span>
                            </p>
                        </div>

                        @if($order->order_confirmed_by_admin == 0 && $order->payment_type == 'online' && $order->order_source != 'Admin Panel')
                        <a href="{{ route('manager.order.verify',[$order->id]) }}"
                            class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-shield-check me-1"></i> Verify Order
                        </a>
                        @else

                        <div class="d-flex align-items-center gap-3">
                            @php
                            $badgeClass = [
                            'Pending' => 'bg-warning',
                            'Processing' => 'bg-primary',
                            'On The way' => 'bg-info',
                            'Delivered' => 'bg-success',
                            'Rejected' => 'bg-danger',
                            'Returned' => 'bg-secondary',
                            ];
                            @endphp

                            <span class="badge {{ $badgeClass[$order->status] ?? 'bg-dark' }} fs-6">
                                {{ $order->status }}
                            </span>

                            @if($order->isTerminalStatus())
                                <span class="text-muted small">Status is final and cannot be changed.</span>
                            @else
                            <form action="{{ route('manager.order.update', $order->id) }}"
                                method="POST"
                                class="d-flex align-items-center gap-2">
                                @csrf
                                @method('PUT')

                                <select name="status" class="form-select form-select-sm" style="width:160px;">
                                    @foreach($order->allowedStatuses() as $status)
                                    <option value="{{ $status }}"
                                        {{ $order->status == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                    @endforeach
                                </select>

                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-rotate me-1"></i> Update
                                </button>
                            </form>
                            @endif
                        </div>

                        @endif
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Customer Details -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Customer Information</h5>
                        </div>

                        <div class="card-body">

                            <p class="mb-2">
                                <strong>Name:</strong>
                                {{ $order->customer_name }}
                            </p>

                            <p class="mb-2">
                                <strong>Phone:</strong>
                                {{ $order->phone }}
                            </p>
                            <p class="mb-2">
                                <strong>Email:</strong>
                                {{ $order->customer_email ?? '----' }}
                            </p>

                            <p class="mb-0">
                                <strong>Address:</strong>
                                {{ $order->address }}
                            </p>
                            <p class="mb-0">
                                <strong>Delivery Method:</strong>
                                {{ \App\Services\CartService::deliveryMethodLabel($order->delivery_method ?? 'local') }}
                            </p>
                            <p class="mb-0">
                                <strong>Area:</strong>
                                {{ $order->area ?? $order->delivery_area_text ?? '—' }}
                            </p>
                            <p class="mb-0">
                                <strong>Order Source:</strong>
                                {{ $order->order_source }}
                            </p>
                            @if(isset($order->social_media_order_source))
                            <p class="mb-0">
                                <strong>Social Media Source:</strong><br>
                                {{ $order->social_media_order_source }}
                            </p>
                            @endif

                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Order Summary</h5>
                        </div>

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <strong>Rs {{ number_format($order->total_amount) }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Delivery Charges</span>
                                <strong>Rs {{ number_format($order->delivery_charges ?? 0) }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Platform Charges</span>
                                <strong>Rs {{ number_format($order->platform_fee ?? 0) }}</strong>
                            </div>

                            {{-- <div class="d-flex justify-content-between mb-2">
                                <span>Discount</span>
                                <strong>
                                    Rs {{ number_format($order->discount ?? 0) }}
                            </strong>
                        </div>
                        --}}

                        <hr>

                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Grand Total</span>
                            <strong class="text-success fs-5">
                                Rs {{ number_format($order->grand_total) }}
                            </strong>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <!-- Order Items -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0">Ordered Products</h5>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th width="120">Price</th>
                                {{-- <th width="120">Discount In (%)</th>
                                <th width="120">Price After Discount</th> --}}
                                <th width="100">Qty</th>
                                <th width="150">Total</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($order->items as $item)

                            <tr>

                                <td>
                                    <div class="d-flex align-items-center">

                                        @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/'.$item->product->image) }}"
                                            width="60"
                                            height="60"
                                            class="rounded me-3"
                                            style="object-fit:cover;">
                                        @else
                                        <img src="{{ asset('frontend/images/no-image.png') }}"
                                            width="60"
                                            height="60"
                                            class="rounded me-3"
                                            style="object-fit:cover;">
                                        @endif

                                        <div>
                                            <h6 class="mb-0">
                                                {{ $item->product->name ?? $item->name }}
                                            </h6>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    Rs {{ number_format($item->price, 2) }}
                                </td>
                                {{-- Discount (enable later)
                                <td>
                                    {{ $item->product->discount ?? 0 }}
                                </td>
                                <td>
                                    {{ $item->product->final_price ?? 0 }}
                                </td>
                                --}}

                                <td>
                                    {{ $item->quantity }}
                                </td>

                                <td>
                                    Rs {{ number_format($item->product->final_price * $item->quantity, 2) }}
                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    No products found.
                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>

            </div>
        </div>
        @if(isset($order->image_payment_slip))
        <!-- Order Items -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0">Payment Slip Image</h5>
            </div>
            <div class="card-body p-0">
                <img src="{{ asset('storage/' . $order->image_payment_slip) }}"
                    alt="Payment Slip"
                    width="400">
            </div>
        </div>
        @endif

    </div>
</div>

</div>

@endsection