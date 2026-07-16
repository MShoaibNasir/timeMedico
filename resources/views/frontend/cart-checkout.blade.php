@extends('frontend.layout.master')
@section('content')
<main class="main">

<!-- breadcrumb -->
<div class="site-breadcrumb">
    <div class="site-breadcrumb-bg" style="background: url({{ asset('frontend/images/about-01.jpg') }})"></div>
    <div class="container">
        <div class="site-breadcrumb-wrap">
            <h4 class="breadcrumb-title">Cart Checkout</h4>
            <ul class="breadcrumb-menu">
                <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                <li class="active">Cart Checkout</li>
            </ul>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<!-- shop cart -->
<div class="shop-cart pt-5">
    <div class="container">
	{{--
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
	--}}
			
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif			
			
	
        <div class="shop-cart-wrap">
            @if (empty($cartItems))
                <div class="text-center py-5">
                    <p class="fs-5 text-muted pb-5">Your cart is currently empty.</p>
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
                                            <th>Discount</th>
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
                                                <td>
                                                    <div class="">
                                                        <span>{{ $data['discount'] }}%</span>
                                                    </div>
                                                </td>
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
                                <li><strong>Delivery Fee:</strong> <span>+ {{ money($summary['delivery_fee']) }}</span></li>
                                <li><strong>Platform Fee:</strong> <span>+ {{ money($summary['platform_fee']) }}</span></li>
                                <li class="shop-cart-total">
                                    <strong>Order Total</strong>
                                    <span>{{ money($summary['order_total']) }}</span>
                                </li>
                            </ul>
							{{--
                            <div class="text-end mt-40">
                                <a href="{{ route('frontend.checkout') }}" class="theme-btn">
                                    Checkout Now<i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
							--}}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- shop cart end -->

@if ($cartItems)
<!-- shop checkout -->
        <div class="shop-checkout pt-3">
            <div class="container">
                <div class="shop-checkout-wrap">
				{{ html()->form('POST', route('frontend.order.place'))->open() }}
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="shop-checkout-step">
                                <div class="accordion" id="shopCheckout">
                                    <div class="accordion-item">
                                      <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#checkoutStep1" aria-expanded="true" aria-controls="checkoutStep1">
                                            Customer Info
                                        </button>
                                      </h2>
                                      <div id="checkoutStep1" class="accordion-collapse collapse show" data-bs-parent="#shopCheckout">
                                        <div class="accordion-body">
                                            <div class="shop-checkout-form">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Customer Name</label>
                                                                {{ html()->text('customer_name')->class('form-control')->placeholder('Customer Name')->required()->value(old('customer_name', $user->name))->attribute('readonly') }}
                                                                @error('customer_name') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Customer Email</label>
                                                                {{ html()->email('customer_email')->class('form-control')->placeholder('Customer Email Address')->required()->value(old('customer_email', $user->email))->attribute('readonly') }}
                                                                @error('customer_email') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Customer Phone Number</label>
                                                                {{ html()->text('customer_phone')->class('form-control')->placeholder('Customer Phone Number')->required()->value(old('customer_phone', $user->phone_number)) }}
                                                                @error('customer_phone') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label>Delivery Address</label>
@if ($customer_address->isEmpty())
<p class="text-muted">You don't have any saved addresses. Please add a new address below</p>
@else
{{ html()->select('address_id', $customer_address)->class('form-control')->placeholder('Select Address')->required()->value(old('address_id')) }}
@endif
                                                                @error('address_id') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label>Delivery Instruction</label>
                                                                {{ html()->textarea('delivery_instruction')->cols(30)->rows(4)->class('form-control')->placeholder('Write Your Message')->value(old('delivery_instruction')) }}
                                                            </div>
                                                        </div>

                                                    </div>

                                            </div>
                                        </div>
                                      </div>
                                    </div>


                                    <div class="accordion-item">
                                      <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#checkoutStep3" aria-expanded="false" aria-controls="checkoutStep3">
                                           Payment Method
                                        </button>
                                      </h2>
                                      <div id="checkoutStep3" class="accordion-collapse collapse" data-bs-parent="#shopCheckout">
                                        <div class="accordion-body">
                                            <div class="shop-checkout-payment">
                                                @error('payment_method')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <ul class="nav payment-method-list mb-3" id="pills-tab" role="tablist" style="list-style:none; padding:0;">
                                                    <li class="payment-method-option" role="presentation">
                                                        <input type="radio" class="btn-check" name="payment_method"
                                                               id="pills-tab-1" value="online" autocomplete="off"
                                                               data-bs-toggle="pill" data-bs-target="#pills-1"
                                                               {{-- old('payment_method', 'online') === 'online' ? 'checked' : '' --}}
															   {{ old('payment_method') === 'online' ? 'checked' : '' }}
                                                               required>
                                                        <label class="payment-method-label" for="pills-tab-1">
                                                            <span class="payment-method-check">
                                                                <i class="fas fa-check"></i>
                                                            </span>
                                                            <div class="checkout-payment-img">
                                                                <img src="{{ asset('frontend/images/visa.svg') }}" alt="Visa">
                                                            </div>
                                                            <span>Pay Online</span>
                                                        </label>
                                                    </li>

                                                    <li class="payment-method-option" role="presentation">
                                                        <input type="radio" class="btn-check" name="payment_method"
                                                               id="pills-tab-4" value="cod" autocomplete="off"
                                                               data-bs-toggle="pill" data-bs-target="#pills-4"
                                                               {{ old('payment_method') === 'cod' ? 'checked' : '' }}
															   required>
                                                        <label class="payment-method-label" for="pills-tab-4">
                                                            <span class="payment-method-check">
                                                                <i class="fas fa-check"></i>
                                                            </span>
                                                            <div class="checkout-payment-img">
                                                                <img src="{{ asset('frontend/images/cod-3.svg') }}" alt="Cash on Delivery">
                                                            </div>
                                                            <span>Cash On Delivery</span>
                                                        </label>
                                                    </li>
                                                </ul>

                                                <div class="tab-content" id="pills-tabContent">
                                                    <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-tab-1" tabindex="0">
                                                        <div class="shop-checkout-form onlinepayment">
                                                            <span>After clicking &ldquo;Proceed to online payment&rdquo;, you will be redirected to transaction page to complete your purchase securely.</span>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-4" role="tabpanel" aria-labelledby="pills-tab-4" tabindex="0">
                                                        <div class="shop-checkout-form cod">
                                                            <span>Cash On Delivery</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center pb-5">
                        {{ html()->button('Proceed Order Now <i class="fas fa-arrow-right"></i>')->type('submit')->class('theme-btn') }}
                        </div>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
        <!-- shop checkout end -->
		@endif
</main>
@endsection

@push('styles')
<style>
    .shop-checkout-wrap .payment-method-option {
        position: relative;
        margin:5px;
    }

    .shop-checkout-wrap .payment-method-option .btn-check {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .shop-checkout-wrap .payment-method-label {
        position: relative;
        display: flex;
        align-items: center;
        gap: 12px;
        border: 2px solid #e5e5e5;
        border-radius: 10px;
        padding: 14px 18px;
        cursor: pointer;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
        width: 100%;
    }

    .shop-checkout-wrap .payment-method-label:hover {
        border-color: #cfcfcf;
    }

    /* Selected state - jab radio checked ho */
    .shop-checkout-wrap .btn-check:checked + .payment-method-label {
        border-color: #e53935;
        box-shadow: 0 0 0 1px #e53935;
    }

    /* Top-left checkmark badge - default hidden, checked hone par dikhta hai */
    .shop-checkout-wrap .payment-method-check {
        position: absolute;
        top: -10px;
        left: -10px;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #ccc;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        opacity: 0;
        transform: scale(0.6);
        transition: all 0.2s ease;
    }

    .shop-checkout-wrap .btn-check:checked + .payment-method-label .payment-method-check {
        opacity: 1;
        transform: scale(1);
        background: #e53935;
    }

    .shop-checkout-wrap .payment-method-label .checkout-card-img img,
    .shop-checkout-wrap .payment-method-label .checkout-payment-img img {
        height: 50px;
        margin-right: 4px;
    }
</style>
@endpush