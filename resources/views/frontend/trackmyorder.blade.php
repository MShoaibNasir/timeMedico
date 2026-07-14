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
                @include('components\userDashboardSidebar',['active'=>'trackmyorder'])
                <div class="col-lg-9">
                    <div class="user-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="user-card user-track-order">
                                    <h4 class="user-card-title">Track My Order</h4>
                                    <div class="track-order-content">
                                        <h5>Tracking Order Number:</h5>
                                        <input type="text" class="form-control my-4" name="order_no" placeholder="Order No" id="order_no">
                                        <div id="tracking_data">

                                        </div>

                                    </div>
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
    $(document).ready(function() {
        // Pehli dafa data load karne ke liye
        filter_data();

        function filter_data(currentpage) {
            var action = 'fetch_data';
            var order_no = $('#order_no').val();
            var search_product = $("#search_product").val();
            var min_price = $("#min_price").val();
            var max_price = $("#max_price").val();
            var sort_val = $("#sorting_dropdown").val();
            var ayis_page = currentpage ?? 1;

            $.ajax({
                type: 'POST',
                url: "{{ route('frontend.dashboard.trackOrder') }}",
                data: {
                    order_no: order_no,
                    _token: '{{csrf_token()}}'
                },
                beforeSend: function() {
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
                success: function(data) {
                    $('#tracking_data').html(data);
                    Swal.close();
                },
                error: function(data) {
                    console.log(data);
                    Swal.close();
                }
            });
        }

        // Search input par filter chalanay ke liye
        $('#order_no').on('keyup', function() {
            filter_data();
        });



        // Sorting dropdown change handler
        $('body').on('change', '#sorting_dropdown', function(e) {
            filter_data();
        });

        // Pagination links handler
        $('body').on('click', '.pagination a', function(f) {
            f.preventDefault();
            var url = $(this).attr('href');
            var currentpage = url.split('page=')[1];
            filter_data(currentpage);
        });
    });
</script>

@endsection