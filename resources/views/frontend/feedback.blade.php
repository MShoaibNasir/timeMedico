@extends('frontend.layout.master')

@section('content')

<main class="main">
    <!-- Breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url('{{ asset('frontend/images/about-01.jpg') }}');"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">Customer Feedback</h4>
                <ul class="breadcrumb-menu">
                    <li>
                        <a href="home">
                            <i class="far fa-home"></i> Home
                        </a>
                    </li>
                    <li class="active">Feedback</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Feedback Area -->
    <div class="login-area py-100">
        <div class="container">

            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">

                    <h2 class="mb-3">We Value Your Feedback</h2>

                    <p class="text-muted">
                        At Time Medico, customer satisfaction is at the heart of everything we do.
                        Your feedback helps us improve our services, enhance your experience,
                        and better serve our valued customers.
                    </p>

                    <p class="text-muted">
                        Whether you would like to share a suggestion, appreciation, concern,
                        or report an issue, we welcome your comments and carefully review every submission.
                    </p>
                </div>
            </div>

            <div class="col-lg-7 mx-auto">
                <div class="login-form shadow-sm">
                    <div class="login-header text-center mb-4">
                        <img src="{{ asset('frontend/images/timemedio-logo.png') }}"
                            alt="Time Medico"
                            style="max-width: 180px;">

                        <h3 class="mt-4">Share Your Experience</h3>

                        <p class="text-muted">
                            Please complete the form below and let us know how we can improve.
                            We appreciate your valuable feedback.
                        </p>
                    </div>
                    <form action="{{route('frontend.feedback.upload')}}" method="POST" id="registerForm">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Email Address</label>
                            <input type="email"
                                class="form-control"
                                name="email"
                                value="{{ old('email') }}"

                                placeholder="Optional">
                        </div>
                        <div class="form-group mb-3">
                            <label>Subject <span class="text text-danger">*</span></label>
                            <input type="text"
                                class="form-control"
                                name="subject"
                                value="{{ old('subject') }}"
                                placeholder="Subject Write Here">
                        </div>



                        <div class="form-group mb-4">
                            <label>Your Feedback <span class="text-danger">*</span></label>
                            <textarea
                                class="form-control"
                                name="message"
                                rows="6"
                                placeholder="Please share your experience, suggestions, comments, or concerns..."
                                required>{{ old('message') }}</textarea>
                        </div>

                        <button type="submit"
                            class="theme-btn w-100"
                            id="register_button"
                            style="border:none;">
                            <i class="far fa-paper-plane"></i>
                            Submit Feedback
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>


</main>


<script src="https://code.jquery.com/jquery-4.0.0.js"></script>
@if ($errors->any())
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true
    });

    Toast.fire({
        icon: 'error',
        title: `{!! implode('<br>', $errors->all()) !!}`
    });
</script>
@endif
@endsection