@extends('frontend.layout.master')

@section('content')

@php
    $wishlist = session('wishlist', []);
@endphp

<main class="main">

    <!-- Breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url('{{ asset('assets/images/about-01.jpg') }}')"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">Shop</h4>
                <ul class="breadcrumb-menu">
                    <li>
                        <a href="{{ url('/') }}">
                            <i class="far fa-home"></i> Home
                        </a>
                    </li>
                    <li class="active">{{ $brand->name }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Area -->
    <div class="shop-area bg py-90">
        <div class="container">

            <div class="row">

                @forelse ($product as $item)

                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="product-item">

                            <!-- Product Image -->
                            <div class="product-img">
                                <a href="{{ route('frontend.singleShop', [Crypt::encryptString($item->id)]) }}">
                                    <img src="{{ asset('storage/' . $item->image) }}"
                                         alt="{{ $item->name }}">
                                </a>

                                <div class="product-action-wrap">
                                    <div class="product-action">

                                        <!-- Quick View -->
                                        <a href="javascript:void(0)"
                                           class="quickeView"
                                           data-product-id="{{ $item->id }}"
                                           data-bs-toggle="modal"
                                           data-bs-target="#quickview">
                                            <i class="far fa-eye"></i>
                                        </a>

                                        <!-- Wishlist -->
                                        @if(in_array($item->id, $wishlist))
                                            <a href="javascript:void(0)"
                                               class="wishlist"
                                               data-product-id="{{ $item->id }}"
                                               title="Remove From Wishlist"
                                               style="background-color:red;">
                                                <span class="fas fa-heart"></span>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)"
                                               class="wishlist"
                                               data-product-id="{{ $item->id }}"
                                               title="Add To Wishlist">
                                                <span class="far fa-heart"></span>
                                            </a>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <!-- Product Content -->
                            <div class="product-content">

                                <h3 class="product-title">
                                    <a href="{{ route('frontend.singleShop', [Crypt::encryptString($item->id)]) }}">
                                        {{ $item->name }}
                                    </a>
                                </h3>

                                <div class="product-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>

                                <div class="product-bottom">

                                    <div class="product-price">
                                        @if($item->discount_amount > 0)
                                            <span>
                                                Rs <del>{{ number_format($item->price, 2) }}</del>
                                                {{ number_format($item->final_price, 2) }}
                                            </span>
                                        @else
                                            <span>
                                                Rs {{ number_format($item->price, 2) }}
                                            </span>
                                        @endif
                                    </div>

                                    <button type="button"
                                            class="product-cart-btn"
                                            data-product-id="{{ $item->id }}"
                                            title="Add To Cart">
                                        <i class="far fa-shopping-bag"></i>
                                    </button>

                                </div>

                            </div>
                            <!-- Product Content End -->

                        </div>
                    </div>

                @empty

                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            No products available.
                        </div>
                    </div>

                @endforelse

            </div>

        </div>
    </div>
    <!-- Shop Area End -->

</main>

@endsection