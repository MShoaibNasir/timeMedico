@extends('frontend.layout.master')
@section('content')
<main class="main">

    <!-- hero slider -->

    <div class="hero-section hs-1 mt-30">
        <div class="container">
            <div class="hero-slider owl-carousel owl-theme">
                @foreach ($sliders as $slide)
                <div class="hero-single">
                    <div class="hero-img">
                        <img src="{{ asset('storage/' . $slide->image) }}" alt="Banner 1">
                    </div>
                </div>
                @endforeach



            </div>
        </div>
    </div>




    @include('frontend.HomeComponents.department',['departments'=>$departments])

    {{--
    <!-- small banner -->
    <div class="small-banner pb-100">
        <div class="container wow fadeInUp" data-wow-delay=".25s">
            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="banner-item">
                        <img src="{{ asset('frontend/images/mini-banner-1.jpg')}}" alt="">
    <div class="banner-content">
        <p>Sanitizer</p>
        <h3>Hand Sanitizer <br> Collectons</h3>
        <a href="shop">Shop Now</a>
    </div>
    </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4">
        <div class="banner-item">
            <img src="{{ asset('frontend/images/mini-banner-2.jpg')}}" alt="">
            <div class="banner-content">
                <p>Hot Sale</p>
                <h3>Face Wash Sale <br> Collections</h3>
                <a href="shop">Discover Now</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4">
        <div class="banner-item">
            <img src="{{ asset('frontend/images/mini-banner-3.jpg')}}" alt="">
            <div class="banner-content">
                <p>Facial Mask</p>
                <h3>Facial Mask Sale <br> Up To <span>50%</span> Off</h3>
                <a href="shop">Discover Now</a>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    --}}
    <!-- small banner end -->

    @include('frontend.HomeComponents.trending',['tranding_items'=>$tranding_items])
    @include('frontend.HomeComponents.feature')
    @include('frontend.HomeComponents.populer_item',['polular_item_categories'=>$polular_item_categories])
    <!-- big banner -->
     {{--  
    <div class="big-banner">
        <div class="container wow fadeInUp" data-wow-delay=".25s">
            <div class="banner-wrap" style="background-image: url({{asset('frontend/images/big-banner.jpg')}});">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="banner-content">
                            <div class="banner-info">
                                <h6>Mega Collections</h6>
                                <h2>Huge Sale Up To <span>40%</span> Off</h2>
                                <p>at our outlet stores</p>
                            </div>
                            <a href="shop" class="theme-btn">Shop Now<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    --}}
    <!-- big banner end -->

  @include('frontend.HomeComponents.feature_item',['featured_items'=>$featured_items])
  @include('frontend.HomeComponents.popular_brands')
  @include('frontend.HomeComponents.productlist',['on_sale_items'=>$on_sale_items,'best_seller_items'=>$best_seller_items,'top_rated'=>$top_rated])
  @include('frontend.HomeComponents.blogs')
</main>


@endsection