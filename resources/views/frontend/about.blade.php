@extends('frontend.layout.master')
@section('content')
<main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb">
<div class="site-breadcrumb-bg" style="background: url('{{ asset('frontend/images/about-01.jpg') }}');"></div>            <div class="container">
                <div class="site-breadcrumb-wrap">
                    <h4 class="breadcrumb-title">About Us</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                        <li class="active">About Us</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- breadcrumb end -->


        <!-- about area -->
        <div class="about-area py-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-left wow fadeInLeft" data-wow-delay=".25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInLeft;">
                            <div class="about-img">
                                <div class="row">
                                    <div class="col-7">
                                        <img class="img-1" src="{{asset('frontend/images/about-02.jpg')}}" alt="">
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img class="img-2" src="{{asset('frontend/images/about-03.jpg')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="about-experience">
                                <div class="about-experience-icon">
                                    <img src="{{asset('frontend/images/experience.svg')}}" alt="">
                                </div>
                                <b>30 Years Of <br> Experience</b>
                            </div>
                            <div class="about-shape">
                                <img src="{{asset('frontend/images/about-04.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-right wow fadeInRight" data-wow-delay=".25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInRight;">
                            <div class="site-heading mb-3">
                                <span class="site-title-tagline justify-content-start">
                                    <i class="flaticon-drive"></i> About Us
                                </span>
                                <h2 class="site-title">
                                    We Provide Best and Original <span>Medical</span> Product For You
                                </h2>
                            </div>
                            <p>
                                We are standard text ever since the when an unknown printer took a galley of type and
                                scrambled it to make type but the majority have suffered alteration in some form by injected humour
                                specimen book. It has survived not only five but also the leap into electronic remaining
                                essentially by injected humour unchanged.
                            </p>
                            <div class="about-list">
                                <ul>
                                    <li><i class="fas fa-check-double"></i> Streamlined Shipping Experience</li>
                                    <li><i class="fas fa-check-double"></i> Affordable Modern Design</li>
                                    <li><i class="fas fa-check-double"></i> Competitive Price &amp; Easy To Shop</li>
                                    <li><i class="fas fa-check-double"></i> We Made Awesome Products</li>
                                </ul>
                            </div>
                           </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- about area end -->


        <!-- counter area -->
        <div class="counter-area pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="counter-box">
                            <div class="icon">
                                <img src="{{asset('frontend/images/sale.svg')}}" alt="">
                            </div>
                            <div class="counter-info">
                                <div class="counter-amount">
                                    <span class="counter" data-count="+" data-to="50" data-speed="3000">50</span>
                                    <span class="counter-sign">k</span>
                                </div>
                                <h6 class="title">Total Sales </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="counter-box">
                            <div class="icon">
                                <img src="{{asset('frontend/images/rate.svg')}}" alt="">
                            </div>
                            <div class="counter-info">
                                <div class="counter-amount">
                                    <span class="counter" data-count="+" data-to="90" data-speed="3000">90</span>
                                    <span class="counter-sign">k</span>
                                </div>
                                <h6 class="title">Happy Clients</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="counter-box">
                            <div class="icon">
                                <img src="{{asset('frontend/images/employee.svg')}}" alt="">
                            </div>
                            <div class="counter-info">
                                <div class="counter-amount">
                                    <span class="counter" data-count="+" data-to="150" data-speed="3000">150</span>
                                    <span class="counter-sign">+</span>
                                </div>
                                <h6 class="title">Team Workers</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="counter-box">
                            <div class="icon">
                                <img src="{{asset('frontend/images/award.svg')}}" alt="">
                            </div>
                            <div class="counter-info">
                                <div class="counter-amount">
                                    <span class="counter" data-count="+" data-to="30" data-speed="3000">30</span>
                                    <span class="counter-sign">+</span>
                                </div>
                                <h6 class="title">Win Awards</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- counter area end -->


       


       

        <!-- team-area -->
        <div class="team-area pt-100 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">Our Team</span>
                            <h2 class="site-title">Meet Our Expert <span>Team</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInUp" data-wow-delay=".25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <div class="team-img">
                                <img src="{{asset('frontend/images/team-01.jpg')}}" alt="thumb">
                            </div>
                            <div class="team-content">
                                <div class="team-bio">
                                    <h5><a href="#">Chad Smith</a></h5>
                                    <span>Senior Manager</span>
                                </div>
                            </div>
                            <div class="team-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInUp" data-wow-delay=".50s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                            <div class="team-img">
                                <img src="{{asset('frontend/images/team-05.jpg')}}" alt="thumb">
                            </div>
                            <div class="team-content">
                                <div class="team-bio">
                                    <h5><a href="#">Malissa Fie</a></h5>
                                    <span>SEO Expert</span>
                                </div>
                            </div>
                            <div class="team-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInUp" data-wow-delay=".75s" style="visibility: visible; animation-delay: 0.75s; animation-name: fadeInUp;">
                            <div class="team-img">
                                <img src="{{asset('frontend/images/team-07.jpg')}}" alt="thumb">
                            </div>
                            <div class="team-content">
                                <div class="team-bio">
                                    <h5><a href="#">Arron Rodri</a></h5>
                                    <span>CEO &amp; Founder</span>
                                </div>
                            </div>
                            <div class="team-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInUp" data-wow-delay="1s" style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;">
                            <div class="team-img">
                                <img src="{{asset('frontend/images/team-04.jpg')}}" alt="thumb">
                            </div>
                            <div class="team-content">
                                <div class="team-bio">
                                    <h5><a href="#">Tony Pinako</a></h5>
                                    <span>Digital Marketer</span>
                                </div>
                            </div>
                            <div class="team-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- team-area end -->


        <!-- feature area -->
        <div class="feature-area">
            <div class="container wow fadeInUp" data-wow-delay=".25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                <div class="feature-wrap">
                    <div class="row g-0">
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fal fa-truck"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Free Delivery</h4>
                                    <p>Orders Over Rs.2000</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fal fa-sync"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Get Refund</h4>
                                    <p>Within 30 Days Returns</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fal fa-wallet"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Safe Payment</h4>
                                    <p>100% Secure Payment</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fal fa-headset"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>24/7 Support</h4>
                                    <p>Feel Free To Call Us</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- feature area end -->




        <!-- brand area -->
        <div class="brand-area bg pt-50 pb-50">
            <div class="container wow fadeInUp" data-wow-delay=".25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <h2 class="site-title">Trusted by over <span>3.2k+</span> companies</h2>
                        </div>
                    </div>
                </div>
                <div class="brand-slider pt-40 pb-40 owl-carousel owl-theme owl-loaded owl-drag">
                    
                    
                    
                    
                    
                    
                <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-1135px, 0px, 0px); transition: all; width: 3408px;"><div class="owl-item cloned" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/about-logo.png')}}" alt="">
                    </div></div><div class="owl-item cloned" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/02.png')}}" alt="">
                    </div></div><div class="owl-item cloned" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/03.png')}}" alt="">
                    </div></div><div class="owl-item cloned" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/04.png')}}" alt="">
                    </div></div><div class="owl-item cloned" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/05.png')}}" alt="">
                    </div></div><div class="owl-item cloned" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/06.png')}}" alt="">
                    </div></div><div class="owl-item active" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/about-logo.png')}}" alt="">
                    </div></div><div class="owl-item active" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/02.png')}}" alt="">
                    </div></div><div class="owl-item active" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/03.png')}}" alt="">
                    </div></div><div class="owl-item active" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/04.png')}}" alt="">
                    </div></div><div class="owl-item active" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/05.png')}}" alt="">
                    </div></div><div class="owl-item active" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/06.png')}}" alt="">
                    </div></div><div class="owl-item cloned" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/about-logo.png')}}" alt="">
                    </div></div><div class="owl-item cloned" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/02.png')}}" alt="">
                    </div></div><div class="owl-item cloned" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/03.png')}}" alt="">
                    </div></div><div class="owl-item cloned" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/04.png')}}" alt="">
                    </div></div><div class="owl-item cloned" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/05.png')}}" alt="">
                    </div></div><div class="owl-item cloned" style="width: 169.333px; margin-right: 20px;"><div class="brand-item">
                        <img src="{{asset('frontend/images/06.png')}}" alt="">
                    </div></div></div></div><div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots disabled"></div></div>
                
            </div>
        </div>
        <!-- brand area end -->

    </main>
@endsection