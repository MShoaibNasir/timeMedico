@extends('frontend.layout.master')

@section('content')

<style>
    .search-order {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .search-order .form-control {
        flex: 1;
    }

    @media (max-width: 576px) {
        .search-order {
            flex-direction: column;
        }

        .search-order .btn {
            width: 100%;
        }
    }
</style>

<main class="main">

    <!-- Breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg"
            style="background-image: url('{{ asset('frontend/images/about-01.jpg') }}');">
        </div>

        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">Track My Order</h4>

                <ul class="breadcrumb-menu">
                    <li>
                        <a href="{{ url('/') }}">
                            <i class="far fa-home"></i> Home
                        </a>
                    </li>
                    <li class="active">Track My Order</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- User Dashboard -->
    <div class="user-area bg pt-100 pb-80">
        <div class="container">
            <div class="row">

                @include('components.userDashboardSidebar',['active'=>'trackmyorder'])

                <div class="col-lg-9">
                    <div class="user-wrapper">

                        <div class="user-card user-track-order">

                            <h4 class="user-card-title">
                                Track My Order
                            </h4>

                            <div class="track-order-content">

                                <p class="mb-3">
                                    Enter your Order Number below to check the current status of your order.
                                </p>

                                <div class="search-order">

                                    <input type="text"
                                        class="form-control"
                                        id="order_no"
                                        name="order_no"
                                        placeholder="Enter Order Number">

                                    <button type="button"
                                        class="btn btn-warning"
                                        id="order_no_button">
                                        <i class="far fa-search"></i>
                                        Track Order
                                    </button>

                                </div>

                                <div id="tracking_data" class="mt-4"></div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- User Dashboard End -->

</main>

<script>
    $(document).ready(function() {

        function trackOrder() {

            let order_no = $('#order_no').val().trim();

            if (order_no === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Order Number Required',
                    text: 'Please enter your order number.'
                });
                return;
            }

            $.ajax({
                type: "POST",
                url: "{{ route('frontend.dashboard.trackOrder') }}",
                data: {
                    order_no: order_no,
                    _token: "{{ csrf_token() }}"
                },

                beforeSend: function() {

                    Swal.fire({
                        title: 'Searching...',
                        text: 'Please wait while we fetch your order details.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                },

                success: function(response) {

                    $('#tracking_data').html(response);
                    Swal.close();

                },

                error: function(xhr) {

                    Swal.close();

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Unable to fetch order details. Please try again.'
                    });

                    console.log(xhr);

                }
            });
        }

        $('#order_no_button').on('click', function() {
            trackOrder();
        });

        $('#order_no').on('keypress', function(e) {

            if (e.which == 13) {
                trackOrder();
            }

        });

    });
</script>

@endsection