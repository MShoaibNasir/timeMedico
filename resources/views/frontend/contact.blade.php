@extends('frontend.layout.master')
@section('content')
<main class="main">

<!-- breadcrumb -->
<div class="site-breadcrumb">
    <div class="site-breadcrumb-bg" style="background: url({{ asset('frontend/images/about-01.jpg') }})"></div>
    <div class="container">
        <div class="site-breadcrumb-wrap">
            <h4 class="breadcrumb-title">Contact Us</h4>
            <ul class="breadcrumb-menu">
                <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                <li class="active">Contact Us</li>
            </ul>
        </div>
    </div>
</div>
<!-- breadcrumb end -->


<!-- contact area -->
<div class="contact-area pt-100 pb-80">
    <div class="container">
        <div class="contact-wrapper">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="contact-info">
                                    <div class="contact-info-icon">
                                        <i class="fal fa-map-location-dot"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <h5>Address</h5>
                                        <p>12 National Stadium Rd, KDA Scheme 1 Extension Gulshan-e-Iqbal, Karachi, Pakistan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-info">
                                    <div class="contact-info-icon">
                                        <i class="fal fa-headset"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <h5>Call Us</h5>
                                        <p>+92 21 111020202</p>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-info">
                                    <div class="contact-info-icon">
                                        <i class="fal fa-envelopes"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <h5>Email Us</h5>
                                        <p>info@timemedico.com</p>
                                        <p>timemedico@hotmail.com</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-info">
                                    <div class="contact-info-icon">
                                        <i class="fal fa-alarm-clock"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <h5>Open Time</h5>
                                        <p>Mon-Fri (9.00AM - 8.00PM)</p>
                                        <p>Sunday - <span class="text-danger">Closed</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="contact-form">
                        <div class="contact-form-header">
                            <h2>Get In Touch</h2>
                            <p>It is a long established fact that a reader will be distracted by the readable
                                content of a page words which even slightly when looking at its layout. </p>
                        </div>
                        {{ html()->form('POST', route('frontend.contact.post'))->open() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
										{{ html()->text('name')->class('form-control')->placeholder('Your Name')->required()->value(old('name')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
										{{ html()->email('email')->class('form-control')->placeholder('Your Email')->required()->value(old('email')) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ html()->text('subject')->class('form-control')->placeholder('Your Subject')->required()->value(old('subject')) }}
                            </div>
                            <div class="form-group">
                                {{ html()->textarea('message')->cols(30)->rows(4)->class('form-control')->placeholder('Write Your Message')->required()->value(old('message')) }}
                            </div>
                            {{ html()->button('Send Message <i class="far fa-paper-plane"></i>')->type('submit')->class('theme-btn') }}
                            <div class="col-md-12 my-3">
                                <div class="form-messege text-success"></div>
                            </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end contact area -->





<!-- map -->
<div class="contact-map">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3619.188609828884!2d67.07882507529759!3d24.891547344013112!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33ecffe2db917%3A0xf28b832f218e1784!2sTime%20Medico!5e0!3m2!1sen!2s!4v1782198809089!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<!-- end map -->

</main>
@endsection