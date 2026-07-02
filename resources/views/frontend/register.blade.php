@extends('frontend.layout.master')
@section('content')
<main class="main">

    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url('{{ asset('frontend/images/about-01.jpg') }}');"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">Register</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">Register</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!-- register area -->
    <div class="login-area py-100">
        <div class="container">
            <div class="col-md-5 mx-auto">
                <div class="login-form">
                    <div class="login-header">
                        <img src="{{asset('frontend/images/timemedio-logo.png')}}" alt="">
                        <p>Create your free account</p>
                    </div>
                    <form action="#" method="POST" id="registerForm">
                        @CSRF
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" required name="name" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" class="form-control" required name="email" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <label>Phone No</label>
                            <input
                                type="text"
                                name="phone_number"
                                id="phone_number"
                                class="form-control"
                                placeholder="0321-6905568"
                                maxlength="12"
                                pattern="03[0-9]{2}-[0-9]{7}"
                                required>
                        </div>
                        <!-- <div class="form-check form-group">
                        <input class="form-check-input" type="checkbox" value="" id="agree">
                        <label class="form-check-label" for="agree">
                           I agree with the <a href="terms">Terms Of Service.</a>
                        </label>
                    </div> -->
                        <div class="d-flex align-items-center">
                            <button type="submit" class="theme-btn" id="register_button" style="border: none;"><i class="far fa-paper-plane"></i> Register</button>
                        </div>
                    </form>
                    <div class="login-footer">
                        <p>Already have an account? <a href="login">Login.</a></p>
                        <div class="social-login">
                            <span class="social-divider">or</span>
                            <!-- <p>Continue with social media</p> -->
                            <div class="social-login-list">
                                <!-- <a href="#" class="fb-auth"><i class="fab fa-facebook-f"></i> Facebook</a> -->
                                <!-- <a href="#" class="gl-auth"><i class="fab fa-google"></i> Google</a> -->
                                <!-- <a href="#" class="tw-auth"><i class="fab fa-x-twitter"></i> Twitter</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- register area end -->

</main>

<!-- OTP Modal -->



  <div id="opt_modal"></div>




<script src="https://code.jquery.com/jquery-4.0.0.js"></script>

<script>
    $('#register_button').on('click', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('frontend.signup') }}",
            type: "POST",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            data: $('#registerForm').serialize(),
            beforeSend: function() {
                Swal.fire({
                    title: 'Please Wait',
                    text: 'Registering account...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $('#register_button').prop('disabled', true);
            },

            success: function(response) {
                Swal.close();

                if (response.success) {
                 

                    // Target the response.html variable explicitly
                    $('#opt_modal').html(response.html);
                  

                    $('#registerForm')[0].reset();
                } else {
                    // Catches manual error responses coming back with a 200 status code
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Something went wrong.'
                    });
                }
            },

            error: function(xhr) {
                console.log(xhr.responseJSON);

                let errors = xhr.responseJSON?.errors;
                let errorMessage = '';

                if (errors) {
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + '<br>';
                    });
                } else {
                    // Displays the custom string thrown from the controller's try-catch block
                    errorMessage = xhr.responseJSON?.message || 'Something went wrong. Please try again.';
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error Occurred',
                    html: errorMessage
                });
            },

            complete: function() {
                $('#register_button').prop('disabled', false);
            }
        });
    });

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