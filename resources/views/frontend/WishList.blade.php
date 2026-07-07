@extends('frontend.layout.master')
@section('content')
<main class="main">
    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background-image: url('{{ asset('frontend/images/about-01.jpg') }}');"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">My Wishlist</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">My Wishlist</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!-- user dashboard -->
    <div class="user-area bg pt-100 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="sidebar">
                        <div class="sidebar-top">
                            <div class="sidebar-profile-img">
                                <img src="assets/images/03.jpg" alt="">
                                <button type="button" class="profile-img-btn"><i class="far fa-camera"></i></button>
                                <input type="file" class="profile-img-file">
                            </div>
                            <h5>Antoni Jonson</h5>
                            <p>antoni@example.com</p>
                        </div>
                        <ul class="sidebar-list">
                            <li><a href="dashboard"><i class="far fa-gauge-high"></i> Dashboard</a></li>
                            <li><a href="user-profile"><i class="far fa-user"></i> My Profile</a></li>
                            <li><a href="order-list"><i class="far fa-shopping-bag"></i> My Order List <span class="badge badge-danger">02</span></a></li>
                            <li><a class="active" href="wishlist"><i class="far fa-heart"></i> My Wishlist <span class="badge badge-danger">02</span></a></li>
                            <li><a href="track-order"><i class="far fa-map-location-dot"></i> Track My Order</a></li>
                            <li><a href="user-setting"><i class="far fa-gear"></i> Settings</a></li>
                            <li><a href="#"><i class="far fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="user-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="user-card">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- user dashboard end -->

</main>



<script>
    function showing_wish_list_data() {
        $.ajax({
            url: "{{ route('frontend.wishlist.product_list') }}",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content') // Safe side ke liye data me bhi token bhej rahe hain
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                // Loader ko smoothly open karne ke liye
                Swal.fire({
                    title: 'Loading...',
                    text: 'Please wait while we fetch your wishlist.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false, // Extra button hata diya
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function(response) {
                // Pehle HTML content update karein, phir loader close karein (behtarin UI flow ke liye)
                $('.user-card').html(response);

                // Chota sa delay taaki SweetAlert smoothly close ho sake
                setTimeout(function() {
                    Swal.close();
                }, 300);
            },
            error: function(xhr) {
                // Agar error aaye toh pehle swal close karke naya error box dikhayein
                Swal.close();
                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Something went wrong.'
                    });
                }, 100);
            }
        });
    }

    $(document).ready(function() {
        showing_wish_list_data();
    });

    $(document).on('click', '.wishlist', function(e) {
        e.preventDefault();

        setTimeout(function() {
            showing_wish_list_data();
        }, 500);
    });
</script>

@endsection