<div id="wrapper">
    <div id="pagee" class="clearfix">
        <header class="main-header fixed-header">
            <!-- Main Top  Header  -->
            <!--<nav class="navbar sticky-top bg-white border-bottom">-->
            <nav class=" py-2 bg-white border-bottom">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <div
                                class="d-flex align-items-center gap-3">
                                <img width="100px"
                                    src="{{ asset('frontend/images/logo/picg-logoo.png') }}">
                                <p>Inspiring Governance for a
                                    sustainable tomorrow</p>
                            </div>
                        </div>
                        <div class="col-lg-4 text-end ">
                            <div
                                class="d-flex justify-content-end align-items-center d-sm-none">
                                @if (!Auth::guard('web')->check())
                                <a href="#modalLogin"
                                    data-bs-toggle="modal"
                                    class="text-dark text-decoration-none px-3 border-end fs-6">
                                    <i class="fas fa-user me-1"
                                        style="color:#2196F3;"></i>
                                    Login
                                </a>
                                <a href="#modalRegister"
                                    data-bs-toggle="modal"
                                    class="text-dark text-decoration-none px-3 fs-6">
                                    <i class="fa fa-user-plus me-1"
                                        style="color:#2196F3;"></i>
                                    Register
                                </a>
                                @else


                                <div class="flat-bt-top">
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Alumni Profile
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('profile.view') }}">
                                                    View Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('frontend.editProfile') }}">
                                                    Edit Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" id='notifications' data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Notifications
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="{{ route('frontend.logout') }}">
                                                    Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </nav>

            <!-- Main Top  Header  -->

            <!-- Header Lower -->
            <div class="header-lower">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner-header">
                            <div class="inner-header-left">
                                <div class="logo-box flex">
                                    <div class="logo"><a href="{{route('frontend.home.page')}}"><img src="{{ asset('frontend/images/logo/logo@2x.png') }}" alt="logo" width="166" height="48"></a></div>
                                </div>
                                <div class="nav-outer flex align-center">
                                    <!-- Main Menu -->
                                    <nav class="main-menu show navbar-expand-md">
                                        <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                            <ul class="navigation clearfix">
                                                <!-- <li><a href="#">Home</a>

                                                    </li> -->
                                                <li><a href="{{route('frontend.aboutUs')}}">About Us</a>

                                                </li>
                                                <!-- <li><a href="#">Resource Hub</a> -->
                                                <li class="dropdown2"><a href="#">Self Development</a>
                                                    <ul>
                                                        <li><a href="#">Advanced Database</a>
                                                        </li>
                                                        <li><a href="{{route('frontend.refresh_your_dtp')}}">Refresh Your DTP</a></li>
                                                        <li><a href="{{route('frontend.freediscountedworkshops')}}">Free &amp; Discounted Workshops</a></li>
                                                    </ul>
                                                    <div class="dropdown2-btn"></div>
                                                    <div class="dropdown2-btn"></div>
                                                </li>

                                                <li class="dropdown2"><a href="#">Events</a>
                                                    <ul>
                                                        <li><a href="{{route('frontend.calendar')}}">Calender</a></li>
                                                        <li><a href="{{route('frontend.directorMeetEvent')}}">Director Meets & Events</a></li>
                                                    </ul>
                                                    <div class="dropdown2-btn"></div>
                                                    <div class="dropdown2-btn"></div>
                                                </li>

                                                <li><a href="{{route('frontend.speeking')}}">Speaking Opportunities</a>

                                                </li>
                                                <li><a href="{{route('frontend.writing')}}">Writing Opportunities</a>

                                                </li>
                                                <li><a href="{{route('frontend.resource_library')}}">Resource Library</a>
                                                    <ul>
                                                        <li><a href="about-us.html">About Us</a></li>
                                                        <li><a href="our-service.html">Resource Hub</a></li>
                                                        <li><a href="pricing.html">Contact</a></li>
                                                        <li><a href="contact.html">Contact</a></li>


                                                    </ul>
                                                </li>
                                                <li><a href="{{route('forum.index')}}">Forums</a>
                                                    <ul>
                                                        <li><a href="blog.html">Blog Default</a></li>
                                                        <li><a href="blog-grid.html">Blog Grid</a></li>
                                                        <li><a href="blog-detail.html">Blog Post Details</a></li>
                                                    </ul>
                                                </li>


                                                <li><a href="{{route('frontend.contactUs')}}">Contact</a>
                                                    <ul>
                                                        <li><a href="blog.html">Blog Default</a></li>
                                                        <li><a href="blog-grid.html">Blog Grid</a></li>
                                                        <li><a href="blog-detail.html">Blog Post Details</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </nav>
                                    <!-- Main Menu End-->
                                </div>
                            </div>


                            <div class="mobile-nav-toggler mobile-button"><span></span></div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Header Lower -->

            <!-- Mobile Menu  -->
            <div class="close-btn"><span class="icon flaticon-cancel-1"></span></div>
            <div class="mobile-menu">
                <div class="menu-backdrop"></div>
                <nav class="menu-box">
                    <div class="nav-logo"><a href="index.html"><img src="images/logo/logo%402x.png" alt="nav-logo"
                                width="174" height="44"></a></div>
                    <div class="bottom-canvas">
                        <div class="login-box flex align-center">
                            <a href="#modalLogin" data-bs-toggle="modal">Login</a>
                            <span>/</span>
                            <a href="#modalRegister" data-bs-toggle="modal">Register</a>
                        </div>
                        <div class="menu-outer"></div>
                        <div class="button-mobi-sell">
                            <a class="tf-btn primary" href="#">Join Alumni</a>
                        </div>
                        <div class="mobi-icon-box">
                            <div class="box d-flex align-items-center">
                                <span class="icon icon-phone2"></span>
                                <div>+(92) 2135306673-74</div>
                            </div>
                            <div class="box d-flex align-items-center">
                                <span class="icon icon-mail"></span>
                                <div>info@picg.org.pk</div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- End Mobile Menu -->

        </header>



      