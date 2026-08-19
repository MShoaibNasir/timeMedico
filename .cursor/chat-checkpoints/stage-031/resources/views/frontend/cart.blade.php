@extends('frontend.layout.master')
@section('content')
<main class="main">

<!-- breadcrumb -->
<div class="site-breadcrumb">
    <div class="site-breadcrumb-bg" style="background: url({{ asset('frontend/images/about-01.jpg') }})"></div>
    <div class="container">
        <div class="site-breadcrumb-wrap">
            <h4 class="breadcrumb-title">Shop Cart</h4>
            <ul class="breadcrumb-menu">
                <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                <li class="active">Shop Cart</li>
            </ul>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<!-- shop cart -->
<div class="shop-cart py-90">
    <div class="container">
	{{--
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
	--}}
        <div class="shop-cart-wrap">
            @if (empty($cartItems))
                <div class="text-center py-5">
                    <p class="fs-5 text-muted">Your cart is currently empty.</p>
                    <a href="{{ route('frontend.home.page') }}" class="theme-btn">Continue Shopping</a>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart-table">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            {{-- <th>Discount</th> --}}
                                            <th>Quantity</th>
                                            <th>Sub Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $data)
                                            <tr>
                                                <td>
                                                    <div class="shop-cart-img">
                                                        <a href="{{ route('frontend.singleShop', [Crypt::encryptString($data['id'])]) }}">
                                                            <img src="{{ asset('storage/' . $data['image']) }}" alt="{{ $data['name'] }}">
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="shop-cart-content">
                                                        <h5 class="shop-cart-name">
                                                            <a href="{{ route('frontend.singleShop', [Crypt::encryptString($data['id'])]) }}">
                                                                {{ $data['name'] }}
                                                            </a>
                                                        </h5>
                                                        {{--
                                                        <div class="shop-cart-info">
                                                            <p class="cart-qty">
                                                                {{ $data['quantity'] }}x -
                                                                <span class="cart-amount">{{ money($data['price']) }}</span>
                                                            </p>
                                                        </div>
                                                        --}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="shop-cart-price">
                                                        <span>{{ money($data['price']) }}</span>
                                                    </div>
                                                </td>
                                                {{-- Discount (enable later)
                                                <td>
                                                    <div class="">
                                                        <span>{{ money($data['discount']) }}</span>
                                                    </div>
                                                </td>
                                                --}}
                                                <td>
                                                    <form action="{{ route('frontend.cart.update', $data['id']) }}" method="POST" class="shop-cart-qty">
                                                        @csrf
                                                        @method('PATCH')
 
                                                        <button type="submit" name="quantity" value="{{ max(1, $data['quantity'] - 1) }}" class="minus-btn" {{ $data['quantity'] <= 1 ? 'disabled' : '' }}>
                                                            <i class="fal fa-minus"></i>
                                                        </button>
 
                                                        <input class="quantity" type="number" name="quantity_display"
                                                               value="{{ $data['quantity'] }}" min="1" max="100"
                                                               onchange="this.form.quantity.value = this.value; this.form.submit();">
 
                                                        <button type="submit" name="quantity" value="{{ min(100, $data['quantity'] + 1) }}" class="plus-btn">
                                                            <i class="fal fa-plus"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <div class="shop-cart-subtotal">
                                                        <span>{{ money($data['price'] * $data['quantity']) }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form action="{{ route('frontend.cart.remove', $data['id']) }}" method="POST"
                                                          onsubmit="return confirm('Are you sure you want to remove this item from the cart?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="cart-removee" title="Remove this item">
                                                            <i class="far fa-times-circle"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
 
                        <div class="shop-cart-footer">
                            <div class="row">
                                <div class="col-md-7 col-lg-6">
                                    <div class="shop-cart-coupon">
                                        @if ($summary['coupon_code'])
                                            {{-- Coupon already applied - remove option dikhayein --}}
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-success">
                                                    Coupon "{{ $summary['coupon_code'] }}" applied
                                                </span>
                                                <form action="{{ route('frontend.coupon.remove') }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                                                </form>
                                            </div>
                                        @else
                                            <form action="{{ route('frontend.coupon.apply') }}" method="POST" class="form-group">
                                                @csrf
                                                <input type="text" name="coupon_code" class="form-control" placeholder="Your Coupon Code" required>
                                                <button class="theme-btn" type="submit">Apply Coupon</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-5 col-lg-6">
                                    <div class="shop-cart-btn text-md-end d-flex gap-2 justify-content-md-end">
                                        <form action="{{ route('frontend.cart.clear') }}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to clear the entire cart?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="theme-btn">Clear Cart</button>
                                        </form>
 
                                        <a href="{{ route('frontend.home.page') }}" class="theme-btn">
                                            <span class="fas fa-arrow-left"></span> Continue Shopping
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
 
                    <div class="col-lg-4">
                        <div class="shop-cart-summary">
                            <h5>Cart Summary</h5>
                            <ul>
                                <li><strong>Sub Total:</strong> <span>{{ money($summary['sub_total']) }}</span></li>
 
                                {{-- Discount (enable later)
                                @if ($summary['product_discount'] > 0)
                                    <li><strong>Product Discount:</strong> <span>- {{ money($summary['product_discount']) }}</span></li>
                                @endif
 
                                @if ($summary['coupon_discount'] > 0)
                                    <li>
                                        <strong>Coupon Discount ({{ $summary['coupon_code'] }}):</strong>
                                        <span>- {{ money($summary['coupon_discount']) }}</span>
                                    </li>
                                @endif
 
                                <li><strong>After Discount:</strong> <span>{{ money($summary['after_discount']) }}</span></li>
                                --}}
                                <li><strong>Delivery Fee:</strong> <span>+ {{ money($summary['delivery_fee']) }}</span></li>
                                <li><strong>Platform Fee:</strong> <span>+ {{ money($summary['platform_fee']) }}</span></li>
                                <li class="shop-cart-total">
                                    <strong>Order Total</strong>
                                    <span>{{ money($summary['order_total']) }}</span>
                                </li>
                            </ul>
                            <div class="text-end mt-40">
                                <a href="{{ route('frontend.checkout') }}" class="theme-btn">
                                    Checkout Now<i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- shop cart end -->



</main>
@endsection