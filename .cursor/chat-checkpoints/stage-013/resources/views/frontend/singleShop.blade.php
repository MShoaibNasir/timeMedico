@extends('frontend.layout.master')
@section('content')
@php
    $wishlist = session('wishlist', []);
    $cart = session('cart', []);
    $cartQty = (int) ($cart[$product->id]['quantity'] ?? 0);
    $inStock = ((int) ($product->quantity ?? 0) > 0) || (int) ($product->in_stock ?? 0) === 1;
    $hasDiscount = (float) ($product->discount_amount ?? 0) > 0;
    $displayPrice = $hasDiscount ? $product->final_price : $product->price;
    $description = trim(strip_tags((string) ($product->product_description ?? '')));
@endphp
<main class="main">
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background-image: url('{{ asset('frontend/images/about-01.jpg') }}');"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">{{ $product->name }}</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('frontend.home.page') }}"><i class="far fa-home"></i> Home</a></li>
                    @if($product->category)
                        <li>
                            <a href="{{ route('frontend.productFilter', [Crypt::encryptString($product->category_id)]) }}">
                                {{ $product->category->name }}
                            </a>
                        </li>
                    @endif
                    <li class="active">{{ $product->name }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="shop-single py-90">
        <div class="container">
            <div class="row g-4 align-items-start">
                <div class="col-md-9 col-lg-6 col-xxl-5">
                    <div class="shop-single-gallery">
                        <div class="flexslider-thumbnails">
                            <ul class="slides">
                                <li data-thumb="{{ asset('storage/'.$product->image) }}">
                                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xxl-6">
                    <div class="shop-single-info">
                        @if($product->category)
                            <span class="shop-single-badge">{{ $product->category->name }}</span>
                        @endif

                        <h1 class="shop-single-title">{{ $product->name }}</h1>

                        <div class="shop-single-price">
                            @if($hasDiscount)
                                <span class="amount-old">Rs {{ number_format($product->price, 2) }}</span>
                                <span class="amount">Rs {{ number_format($displayPrice, 2) }}</span>
                                <span class="shop-single-discount">-{{ rtrim(rtrim(number_format((float) $product->discount, 2), '0'), '.') }}%</span>
                            @else
                                <span class="amount">Rs {{ number_format($displayPrice, 2) }}</span>
                            @endif
                        </div>

                        @if($description !== '')
                            <p class="shop-single-excerpt mb-3">{{ \Illuminate\Support\Str::limit($description, 220) }}</p>
                        @endif

                        <div class="shop-single-sortinfo">
                            <ul>
                                <li>
                                    Stock:
                                    <span class="{{ $inStock ? 'text-success' : 'text-danger' }}">
                                        {{ $inStock ? 'In Stock' : 'Out of Stock' }}
                                        @if((int) ($product->quantity ?? 0) > 0)
                                            ({{ (int) $product->quantity }} available)
                                        @endif
                                    </span>
                                </li>
                                @if(!empty($product->sku))
                                    <li>SKU: <span>{{ $product->sku }}</span></li>
                                @endif
                                @if($product->category)
                                    <li>Category: <span>{{ $product->category->name }}</span></li>
                                @endif
                                @if($product->type_data)
                                    <li>Type: <span>{{ $product->type_data->name }}</span></li>
                                @endif
                                @if(!empty($product->unit))
                                    <li>Unit: <span>{{ $product->unit }}</span></li>
                                @endif
                            </ul>
                        </div>

                        <div class="shop-single-action">
                            <div class="product-cart-action shop-single-cart-wrap" data-product-id="{{ $product->id }}">
                                <div class="shop-single-add-row" @if($cartQty > 0) style="display:none;" @endif>
                                    <div class="shop-cart-qty shop-single-local-qty">
                                        <button type="button" class="minus-btn shop-single-qty-minus" aria-label="Decrease quantity">
                                            <i class="fal fa-minus"></i>
                                        </button>
                                        <input class="quantity" type="text" value="1" disabled aria-label="Quantity to add">
                                        <button type="button" class="plus-btn shop-single-qty-plus" aria-label="Increase quantity">
                                            <i class="fal fa-plus"></i>
                                        </button>
                                    </div>

                                    <button type="button"
                                        class="theme-btn product-cart-btn shop-single-add-btn"
                                        data-product-id="{{ $product->id }}"
                                        @if(!$inStock) disabled @endif>
                                        <i class="far fa-shopping-bag"></i>
                                        <span>{{ $inStock ? 'Add to Cart' : 'Out of Stock' }}</span>
                                    </button>
                                </div>

                                <div class="shop-cart-qty product-card-qty shop-single-in-cart-qty" @if($cartQty < 1) style="display:none;" @endif>
                                    <button type="button" class="minus-btn product-qty-minus" aria-label="Decrease quantity">
                                        <i class="fal fa-minus"></i>
                                    </button>
                                    <input class="quantity product-qty-input" type="text" value="{{ max($cartQty, 1) }}" disabled aria-label="Cart quantity">
                                    <button type="button" class="plus-btn product-qty-plus" aria-label="Increase quantity">
                                        <i class="fal fa-plus"></i>
                                    </button>
                                </div>

                                @if(in_array($product->id, $wishlist))
                                    <a class="theme-btn theme-btn2 wishlist shop-single-wish-btn is-active"
                                        data-product-id="{{ $product->id }}"
                                        title="Remove from Wishlist">
                                        <span class="fas fa-heart"></span>
                                    </a>
                                @else
                                    <a class="theme-btn theme-btn2 wishlist shop-single-wish-btn"
                                        data-product-id="{{ $product->id }}"
                                        title="Add to Wishlist">
                                        <span class="far fa-heart"></span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="shop-single-details">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-tab1" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1" aria-selected="true">Description</button>
                        <button class="nav-link" id="nav-tab2" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">Product Details</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="nav-tab1">
                        <div class="shop-single-desc">
                            @if($description !== '')
                                <p>{{ $product->product_description }}</p>
                            @else
                                <p class="text-muted mb-0">No description available for this product.</p>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="nav-tab2">
                        <div class="shop-single-additional">
                            <div class="shop-single-list">
                                <h5 class="title">Product Information</h5>
                                <ul>
                                    <li><span>Product Name:</span> {{ $product->name }}</li>
                                    @if(!empty($product->sku))
                                        <li><span>SKU:</span> {{ $product->sku }}</li>
                                    @endif
                                    @if($product->category)
                                        <li><span>Category:</span> {{ $product->category->name }}</li>
                                    @endif
                                    @if($product->type_data)
                                        <li><span>Type:</span> {{ $product->type_data->name }}</li>
                                    @endif
                                    @if(!empty($product->unit))
                                        <li><span>Unit:</span> {{ $product->unit }}</li>
                                    @endif
                                    <li>
                                        <span>Availability:</span>
                                        {{ $inStock ? 'In Stock' : 'Out of Stock' }}
                                        @if((int) ($product->quantity ?? 0) > 0)
                                            — {{ (int) $product->quantity }} units
                                        @endif
                                    </li>
                                    <li><span>Price:</span> Rs {{ number_format($displayPrice, 2) }}</li>
                                    @if($hasDiscount)
                                        <li><span>Discount:</span> {{ rtrim(rtrim(number_format((float) $product->discount, 2), '0'), '.') }}%</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(isset($relatedProducts) && $relatedProducts->count())
                <div class="shop-single-related mt-70">
                    <div class="site-heading mb-40">
                        <h2 class="site-title mb-0">Related Products</h2>
                    </div>
                    <div class="row g-3 item-2">
                        @foreach($relatedProducts as $item)
                            <div class="col-6 col-md-4 col-lg-3">
                                @include('frontend.Components.product', ['item' => $item])
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection

@push('script')
<script>
$(function () {
    const maxStock = {{ max((int) ($product->quantity ?? 0), 1) }};

    $(document).on('click', '.shop-single-qty-plus', function (e) {
        e.preventDefault();
        e.stopPropagation();
        const input = $(this).closest('.shop-single-local-qty').find('.quantity');
        let value = parseInt(input.val(), 10) || 1;
        if (value < maxStock) {
            input.val(value + 1);
        }
    });

    $(document).on('click', '.shop-single-qty-minus', function (e) {
        e.preventDefault();
        e.stopPropagation();
        const input = $(this).closest('.shop-single-local-qty').find('.quantity');
        let value = parseInt(input.val(), 10) || 1;
        if (value > 1) {
            input.val(value - 1);
        }
    });
});
</script>
@endpush
