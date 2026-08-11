@extends('frontend.layout.master')
@section('content')
<main class="main">

    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url('{{ asset('frontend/images/about-01.jpg') }}');""></div>
            <div class=" container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">Login</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">Login</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!-- login area -->
    <div class="login-area py-90">
        <div class="container">
            <div class="col-md-7 col-lg-5 mx-auto">
                <div class="login-form">
                    <div class="login-header">
                        <img src="{{ asset('frontend/images/timemedio-logo.png') }}" alt="">
                        <p>Login with your account</p>
                    </div>
                    <form action="{{route('frontend.loginUser')}}" method="post">
                        @csrf
                        @if(request('redirect'))
                            <input type="hidden" name="redirect" value="{{ request('redirect') }}">
                        @endif
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" required class="form-control" placeholder="Your Email" name="email">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input required type="text" id="phone_number" class="form-control" placeholder="0321-6905568" maxlength="12" pattern="03[0-9]{2}-[0-9]{7}" name="phone_number">
                        </div>
                        {{--<div class="d-flex justify-content-between mb-4">
                                <div class="form-check">
                                    <!-- <input class="form-check-input" type="checkbox" value="" id="remember"> -->
                                    <!-- <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label> -->
                                </div>
                                <!-- <a href="forgot-password" class="forgot-pass">Forgot Password?</a> -->
                            </div>
--}}
                        <div class="d-flex align-items-center">
                            <button type="submit" class="theme-btn"><i class="far fa-sign-in"></i> Login</button>
                        </div>
                    </form>
                    <div class="login-footer">
                        <p>Don't have an account? <a href="{{ route('frontend.register', request()->only('redirect')) }}">Register</a></p>
                        <div class="social-login">
                            <div class="social-login-list">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- login area end -->

</main>

<script>
    // Aapka phone formatting event listener (Yeh bilkul perfect hai!)
    document.getElementById('phone_number').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        value = value.substring(0, 11);
        if (value.length > 4) {
            value = value.substring(0, 4) + '-' + value.substring(4);
        }
        e.target.value = value;
    });
</script>


@endsection