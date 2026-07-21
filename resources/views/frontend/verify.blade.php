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
        height: 52px;
    }

    .search-order .btn {
        height: 52px;
        min-width: 180px;
    }

    .verification-note {
        border-left: 4px solid #0d6efd;
        background: #f8fbff;
        padding: 15px 20px;
        border-radius: 8px;
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
                <h4 class="breadcrumb-title">
                    Payment Verification Portal
                </h4>

                <ul class="breadcrumb-menu">
                    <li>
                        <a href="{{ url('/') }}">
                            <i class="far fa-home"></i> Home
                        </a>
                    </li>
                    <li class="active">
                        Payment Verification Portal
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Payment Verification Section -->
    <div class="user-area bg pt-100 pb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="user-wrapper">

                        <div class="user-card user-track-order">

                            <div class="text-center mb-4">
                                <h4 class="user-card-title mb-2">
                                    Payment Verification Portal
                                </h4>

                                <p class="text-muted mb-0">
                                    Search your order using the Order Number below.
                                    Once your order is located, you can upload your
                                    payment slip for verification.
                                </p>
                            </div>

                            <div class="verification-note mb-4">
                                <strong>Important Note:</strong>
                                Please search your order using the correct
                                <strong>Order Number</strong>. After locating your
                                order, upload your payment slip. Our verification
                                team will review your payment and notify you once
                                the payment has been verified.
                            </div>

                            <div class="search-order">

                                <input type="text"
                                    class="form-control"
                                    id="order_no"
                                    name="order_no"
                                    placeholder="Enter Your Order Number">

                                <button type="button"
                                    class="btn btn-warning"
                                    id="order_no_button">
                                    <i class="far fa-search"></i>
                                    Search Order
                                </button>

                            </div>

                            <div id="tracking_data" class="mt-4"></div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Payment Verification Section End -->

</main>

<script>
    $(document).ready(function() {

        function searchOrder() {

            let order_no = $('#order_no').val().trim();

            if (order_no === '') {

                Swal.fire({
                    icon: 'warning',
                    title: 'Order Number Required',
                    text: 'Please enter your Order Number to continue.'
                });

                return;
            }

            $.ajax({
                type: "POST",
                url: "{{ route('frontend.dashboard.trackOrder') }}",
                data: {
                    order_no: order_no,
                    order_verify_for_payment:true,
                    _token: "{{ csrf_token() }}"
                },

                beforeSend: function() {

                    Swal.fire({
                        title: 'Searching Order',
                        text: 'Please wait while we retrieve your order details.',
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
                        title: 'Order Not Found',
                        text: 'We could not find an order matching the provided Order Number.'
                    });

                    console.log(xhr);

                }
            });
        }

        $('#order_no_button').on('click', function() {
            searchOrder();
        });

        $('#order_no').on('keypress', function(e) {

            if (e.which == 13) {
                searchOrder();
            }

        });

    });
</script>

@endsection