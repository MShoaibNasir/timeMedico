<!DOCTYPE html><html lang="en"><head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- title -->
    <title>Time Medico</title>

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

        <!-- header top -->

        <div class="header-top">
            <div class="container-fluid">
            <div class="top-marquee">
    <marquee behavior="scroll" direction="left" scrollamount="6">
        This is the official website of Time Medico and other sites that are running under this name have no affiliation with Time Medico.
    </marquee>
</div>
            </div>
        </div>

        <!-- header top end -->

        <!-- header middle -->
        <div class="header-middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-5 col-lg-3 col-xl-3">
                        <div class="header-middle-logo">
                            <a class="navbar-brand" href="{{route('frontend.home.page')}}">
                                <img src="{{ asset('frontend/images/timemedio-logo.png') }}" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="d-none d-lg-block col-lg-6 col-xl-5">
                        <div class="header-middle-search">
                            <form action="#">
                                <div class="search-content">
                                    <select class="select">
                                        <option value="">All Category</option>
                                        <option value="1">Medicine</option>
                                        <option value="2">Medical Equipments</option>
                                        <option value="3">Beauty Care</option>
                                        <option value="4">Baby & Mom Care</option>
                                        <option value="5">Healthcare</option>
                                        <option value="6">Food & Nutrition</option>
                                        <option value="7">Medical Supplies</option>
                                        <option value="8">Lab Test</option>
                                        <option value="9">Fitness</option>
                                        <option value="10">Vitamins & Supplement</option>
                                        <option value="11">Pet Care</option>
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
                                <li>
                                    <a href="login" class="list-item">
                                        <div class="list-item-icon">
                                            <i class="far fa-user-circle"></i>
                                        </div>
                                        <div class="list-item-info">
                                            <h6>Sign In</h6>
                                            <h5>Account</h5>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="wishlist" class="list-item">
                                        <div class="list-item-icon">
                                            <i class="far fa-heart"></i><span>0</span>
                                        </div>
                                        <div class="list-item-info">
                                            <h6>Wishlist</h6>
                                            <h5>My Items</h5>
                                        </div>
                                        
                                    </a>
                                </li>
                                <li class="dropdown-cart">
                                    <a href="cart" class="shop-cart list-item">
                                        <div class="list-item-icon">
                                            <i class="far fa-shopping-bag"></i><span>3</span>
                                        </div>
                                        <div class="list-item-info">
                                            <h6>Rs350.00</h6>
                                            <h5>My Cart</h5>
                                        </div>
                                        
                                    </a>
                                    <div class="dropdown-cart-menu">
                                        <div class="dropdown-cart-header">
                                            <span>03 Items</span>
                                            <a href="cart">View Cart</a>
                                        </div>
                                        <ul class="dropdown-cart-list">
                                            <li>
                                                <div class="dropdown-cart-item">
                                                    <div class="cart-img">
                                                        <a href="shop-single"><img src="{{ asset('frontend/images/01_1.png') }}" alt="#"></a>
                                                    </div>
                                                    <div class="cart-info">
                                                        <h4><a href="shop-single">Surgical Face Mask</a></h4>
                                                        <p class="cart-qty">1x - <span class="cart-amount">Rs200.00</span></p>
                                                    </div>
                                                    <a href="#" class="cart-remove" title="Remove this item"><i class="far fa-times-circle"></i></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="dropdown-cart-item">
                                                    <div class="cart-img">
                                                        <a href="shop-single"><img src="{{ asset('frontend/images/02_3.png') }}" alt="#"></a>
                                                    </div>
                                                    <div class="cart-info">
                                                        <h4><a href="shop-single">Surgical Face Mask</a></h4>
                                                        <p class="cart-qty">1x - <span class="cart-amount">Rs120.00</span></p>
                                                    </div>
                                                    <a href="#" class="cart-remove" title="Remove this item"><i class="far fa-times-circle"></i></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="dropdown-cart-item">
                                                    <div class="cart-img">
                                                        <a href="shop-single"><img src="{{ asset('frontend/images/03_2.png') }}" alt="#"></a>
                                                    </div>
                                                    <div class="cart-info">
                                                        <h4><a href="shop-single">Surgical Face Mask</a></h4>
                                                        <p class="cart-qty">1x - <span class="cart-amount">Rs330.00</span></p>
                                                    </div>
                                                    <a href="#" class="cart-remove" title="Remove this item"><i class="far fa-times-circle"></i></a>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="dropdown-cart-bottom">
                                            <div class="dropdown-cart-total">
                                                <span>Total</span>
                                                <span class="total-amount">Rs650.00</span>
                                            </div>
                                            <a href="#" class="theme-btn">Checkout</a>
                                        </div>
                                    </div>
                                </li>
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
                                                    <div class="col-12 col-lg-2">
                                                        <h5 class="mega-menu-title">Medicine</h5>
                                                        <ul class="mega-menu-item">
                                                            <li><a class="dropdown-item" href="shop-single">Allergies & Sinus</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">E.N.T Preparations</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">Eye Preparations</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">Vitamin & Nutritional</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">Fever & Pain Relief</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">Dermatological</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-12 col-lg-2">
                                                        <h5 class="mega-menu-title">Equipment</h5>
                                                        <ul class="mega-menu-item">
                                                            <li><a class="dropdown-item" href="shop-single">Biopsy Tools</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">Monitoring</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">Infusion Stands</a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="shop-single">Lighting</a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="shop-single">Machines</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">Thermometer</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-12 col-lg-2">
                                                        <h5 class="mega-menu-title">Wound Care</h5>
                                                        <ul class="mega-menu-item">
                                                            <li><a class="dropdown-item" href="shop-single">Surgical Sutures</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">Bandages</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">Patches and Tapes</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">Stomatology</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">Wound Healing</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">Uniforms</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-12 col-lg-2">
                                                        <h5 class="mega-menu-title">Higiene</h5>
                                                        <ul class="mega-menu-item">
                                                            <li><a class="dropdown-item" href="shop-single">Face Masks</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">Sterilization</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">Surgical Foils</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">Disposable Products</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">Protective Covers</a></li>
                                                            <li><a class="dropdown-item" href="shop-single">Diagnostic Tests</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <div class="mega-menu-img">
                                                            <a href="#"><img src="{{ asset('frontend/images/mega-menu-banner.jpg') }}" alt=""></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
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
                               
                                
                                <li class="nav-item"><a class="nav-link" href="blog">Blog</a></li>
                                <li class="nav-item"><a class="nav-link" href="track-order">Track Order</a></li>
                                <li class="nav-item"><a class="nav-link" href="contact-us">Contact</a></li>
                            </ul>
                            <!-- nav-right -->
                            <div class="nav-right">
                                <a href="shop" class="theme-btn dwnld-btn">Download the App<i class="fab fa-google-play"></i></a>
                                 <a class="nav-right-link" href="prescription"><i class="fal fa-upload"></i> Upload Prescription</a> 
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

