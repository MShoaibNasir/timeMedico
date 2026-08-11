<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- title -->
    <title>{{ $setting?->site_name ?? '' }}</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/fav-icon.png') }}">

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all-fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/flex-slider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
	@stack('styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('frontend/js/jquery-3.7.1.min.js') }}"></script>


</head>

<body>



    <!-- preloader -->
    <div class="preloader">
        <div class="loader-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- preloader end -->


    <!-- header area -->
    <header class="header">

        @if(!empty($setting?->marquee))
		<!-- header top -->
        <div class="header-top">
            <div class="container-fluid">
                <div class="top-marquee">
                    <marquee behavior="scroll" direction="left" scrollamount="6">
                        {{ $setting->marquee ?? '' }}
                    </marquee>
                </div>
            </div>
        </div>
        <!-- header top end -->
		@endif

        <!-- header middle -->
        <div class="header-middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-5 col-lg-3 col-xl-3">
                        <div class="header-middle-logo">
                            <a class="navbar-brand" href="{{route('frontend.home.page')}}">
    @if($setting?->hasMedia('logo'))
		<img src="{{ $setting->getFirstMediaUrl('logo', 'small') }}" alt="{{ $setting?->site_name ?? '' }}" />
	@endif
                            </a>
                        </div>
                    </div>
                    <div class="d-none d-lg-block col-lg-6 col-xl-5">
                        <div class="header-middle-search">
                            <form action="#">
                                <div class="search-content">
                                    <select class="select">
                                        <option value="">All Category</option>
                                        @foreach($allcategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" placeholder="Search Here...">
                                    <button type="submit" class="search-btn"><i class="far fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-7 col-lg-3 col-xl-4">
                        <div class="header-middle-right">
                            <ul class="header-middle-list">
                                @if(Auth::guard('web')->check())
                                <li>
                                    <a href="{{route('frontend.logout')}}" class="list-item">
                                        <div class="list-item-icon">
                                            <i class="fas fa-sign-out-alt"></i>
                                        </div>
                                        <div class="list-item-info">
                                            <h6>Logout</h6>

                                        </div>
                                    </a>
                                </li>
                                @else
                                <li>
                                    <a href="{{route('frontend.register')}}" class="list-item">
                                        <div class="list-item-icon">
                                            <i class="far fa-user-circle"></i>
                                        </div>
                                        <div class="list-item-info">
                                            <h6>Sign In</h6>
                                            <h5>Account</h5>
                                        </div>
                                    </a>
                                </li>
                                @endif
                                <li class="wishlist_count_show">
                                    @php
                                        $wishlist = session()->get('wishlist', []);
                                        $count_wishlist = is_array($wishlist) ? count($wishlist) : 0;
                                    @endphp
                                    @include('frontend.Components.wishlist', ['count_wishlist' => $count_wishlist])
                                </li>
                                @if(Auth::guard('web')->check())
                                <li class="dropdown-cart">
                                </li>
                                @endif
                            </ul>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <!-- header middle end -->

        <!-- navbar -->
        <div class="main-navigation">
            <nav class="navbar navbar-expand-lg">
                <div class="container position-relative">
                    <a class="navbar-brand" href="{{route('frontend.home.page')}}">
                        <img src="{{ asset('frontend/images/timemedio-logo.png') }}" class="logo-scrolled" alt="logo">
                    </a>
                    <div class="category-all">
                        <button class="category-btn" type="button">
                            <i class="fas fa-list-ul"></i><span>All Categories</span>
                        </button>
                        <ul class="main-category">
                            {{--@dump($departments->toArray())--}}
                            {{--@dump($categories->toArray())--}}
                            @foreach($departments as $department)
                            <li><a href="{{ route('frontend.categories', [Crypt::encryptString($department->id)]) }}"><img src="{{ asset('storage/'.$department->image) }}" alt="{{ $department->name }}"><span>{{ $department->name }}</span></a></li>
                            @endforeach
                            {{--
                            <li><a href="shop"><img src="{{ asset('frontend/images/health-care.svg') }}" alt=""><span>Medicine</span></a></li>
                            <li><a href="shop"><img src="{{ asset('frontend/images/health-care.svg') }}" alt=""><span>Healthcare</span></a></li>
                            <li><a href="shop"><img src="{{ asset('frontend/images/beauty-care.svg') }}" alt=""><span>Beauty Care</span></a></li>
                            <li><a href="shop"><img src="{{ asset('frontend/images/sexual.svg') }}" alt=""><span>Sexual Wellness</span></a></li>
                            <li><a href="shop"><img src="{{ asset('frontend/images/fitness.svg') }}" alt=""><span>Fitness</span></a></li>
                            <li><a href="shop"><img src="{{ asset('frontend/images/lab-test.svg') }}" alt=""><span>Lab Test</span></a></li>
                            <li><a href="shop"><img src="{{ asset('frontend/images/baby-mom-care.svg') }}" alt=""><span>Baby & Mom Care</span></a></li>
                            <li><a href="shop"><img src="{{ asset('frontend/images/supplements.svg') }}" alt=""><span>Vitamins & Supplement</span></a></li>
                            <li><a href="shop"><img src="{{ asset('frontend/images/food-nutrition.svg') }}" alt=""><span>Food & Nutrition</span></a></li>
                            <li><a href="shop"><img src="{{ asset('frontend/images/medical-equipements.svg') }}" alt=""><span>Medical Equipments</span></a></li>
                            <li><a href="shop"><img src="{{ asset('frontend/images/medical-supplies.svg') }}" alt=""><span>Medical Supplies</span></a></li>
                            <li><a href="shop"><img src="{{ asset('frontend/images/pet-care.svg') }}" alt=""><span>Pet Care</span></a></li>
                            --}}
                        </ul>
                    </div>
                    <div class="mobile-menu-right">
                        <div class="mobile-menu-btn">
                            <a href="#" class="nav-right-link search-box-outer"><i class="far fa-search"></i></a>
                            <a href="wishlist.html" class="nav-right-link"><i class="far fa-heart"></i><span>2</span></a>
                            <a href="shop-cart.html" class="nav-right-link"><i class="far fa-shopping-bag"></i><span>5</span></a>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <a href="index.html" class="offcanvas-brand" id="offcanvasNavbarLabel">
                                <img src="{{ asset('frontend/images/logo.png') }}" alt="">
                            </a>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1">

                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="{{route('frontend.home.page')}}">Home</a>

                                </li>
                                <li class="nav-item"><a class="nav-link" href="about-us">About</a></li>



                                <li class="nav-item mega-menu dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Shop</a>
                                    <div class="dropdown-menu fade-down">
                                        <div class="mega-content">
                                            <div class="container-fluid px-lg-0">
                                                <div class="row">
                                                    <div class="col-12 col-lg-8">
                                                        <div class="row row-cols-2 row-cols-lg-4 g-3">
                                                            @foreach ($departments as $department)
                                                            <div class="col">
                                                                <h5 class="mega-menu-title">{{ $department->name }}</h5>
                                                                <ul class="mega-menu-item">
                                                                    @forelse ($department->categories as $category)
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('frontend.productFilter', [Crypt::encryptString($category->id)]) }}">
                                                                            {{ $category->name }}
                                                                        </a>
                                                                    </li>
                                                                    @empty
                                                                    <li><span class="dropdown-item disabled">No categories yet</span></li>
                                                                    @endforelse
                                                                </ul>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-lg-4">
                                                        <div class="mega-menu-img">
                                                            <a href="#"><img src="{{ asset('frontend/images/mega-menu-banner.jpg') }}" alt="Shop banner"></a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                {{--
                                    <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Products</a>
                                    <ul class="dropdown-menu fade-down">
                                        <li><a class="dropdown-item" href="shop-single">Allergies & Sinus</a></li>
                                        <li><a class="dropdown-item" href="shop-single">E.N.T Preparations</a></li>
                                        <li><a class="dropdown-item" href="shop-single">Eye Preparations</a></li>
                                        <li><a class="dropdown-item" href="shop-single">Vitamin & Nutritional</a></li>
                                        <li><a class="dropdown-item" href="shop-single">Fever & Pain Relief</a></li>
                                        <li><a class="dropdown-item" href="shop-single">Dermatological</a></li>
                                        <li><a class="dropdown-item" href="shop-single">Biopsy Tools</a></li>
                                        <li><a class="dropdown-item" href="shop-single">Monitoring</a></li>
                                        <li><a class="dropdown-item" href="shop-single">Infusion Stands</a></li>
                                        <li><a class="dropdown-item" href="shop-single">Lighting</a></li>
                                        <li><a class="dropdown-item" href="shop-single">Machines</a></li>
                                    </ul>
                                </li>
                                --}}
                                {{--<li class="nav-item"><a class="nav-link" href="blog">Blog</a></li>--}}
                                
                                {{--<li class="nav-item"><a class="nav-link" href="track-order">Track Order</a></li>--}}
                                <li class="nav-item"><a class="nav-link" href="{{ route('frontend.contact')}}">Contact</a></li>
                                @if(Auth::guard('web')->check())
                                <li class="nav-item"><a class="nav-link" href="{{route('frontend.dashboard.trackingOrder')}}">Track Order</a></li>
                                @endif
                                @if(Auth::guard('web')->check())
                                <li class="nav-item"><a class="nav-link" href="{{route('frontend.customer.address.show')}}">Upload Address</a></li>
                                @endif
                            </ul>
                            <!-- nav-right -->

                            <div class="nav-right">
                                <a href="shop" class="theme-btn dwnld-btn">Download the App<i class="fab fa-google-play"></i></a>
                                @if(Auth::guard('web')->check())
                                <a class="nav-right-link" href="{{route('frontend.prescription.show')}}"><i class="fal fa-upload"></i> Upload Prescription</a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- navbar end -->

    </header>
    <!-- header area end -->


    <!-- mobile popup search -->
    <div class="search-popup">
        <button class="close-search"><span class="far fa-times"></span></button>
        <form action="#">
            <div class="form-group">
                <input type="search" name="search-field" class="form-control" placeholder="Search Here..." required="">
                <button type="submit"><i class="far fa-search"></i></button>
            </div>
        </form>
    </div>
    <!-- mobile popup search end -->