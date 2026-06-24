@extends('backend.layout.master')
@section('content')

<style>
    .loader img {
        width: 120px;
        height: 120px;
        animation: spin 1.5s linear infinite;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
        margin: 5px;
        /* Added margin for spacing */
    }

    #myImg:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .mmodal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .mmodal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #ccaption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .mmodal-content,
    #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .cclose {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .cclose:hover,
    .cclose:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
        .mmodal-content {
            width: 100%;
        }
    }

    .button_rotate {
        margin-top: 20px;
        font-size: 16px;
        cursor: pointer;
        background: black;
        width: 100px;
        color: #fff;
    }


    .rotating-image {
        transition: transform 0.5s ease-in-out;
        /* Smooth rotation */


    }

    #loader_data {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
    }

    .form-label {
        margin-bottom: 0.5rem;
        width: 100%;
        text-align: left;
    }

    /* Chrome, Safari, Edge */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<div class="content">
    <div class="container-fluid pt-4 px-4 form_width">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h1 class="mb-0">Product Management</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="pdmadatalist">
                        <!--Toolbar-->
                        <div class="toolbar">
                            <div class="filters-toolbar-wrapper">
                                <div class="row">

                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">{{ __('Search By Category') }}</label>
                                        <div class="">
                                            <select name="" id="main_class" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach ($Classes as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">{{ __('Search By Product Name') }}</label>
                                        <div class="">
                                            <input type="text" name="product_name" id="product_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">{{ __('Direction') }}</label>
                                        <div class="">
                                            <select name="direction" id="direction" class="form-control">
                                                <option value="asc">ASC</option>
                                                <option value="desc">DESC</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">{{ __('Sort By') }}</label>
                                        <div class="">
                                            <select name="sorting" id="sorting" class="form-control">
                                                <option value="id" selected>ID</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">{{ __('Quantity') }}</label>
                                        <div class="">
                                            <select name="qty" id="qty" class="form-control">
                                                <option value="10" selected>10</option>
                                                <option value="25">25</option>
                                                <option value="500">500</option>
                                                <option value="1000">1000</option>
                                            </select>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                        <!--End Toolbar-->
                        <div class="filter_data"></div>
                    </div>
                </div>

            </div>


            {{-- <div id="mmyModal" class="mmodal">
                <span class="cclose">&times;</span>
                <img class="mmodal-content" id="img01">
                <div id="ccaption"></div>
            </div>
            --}}
        </div>
    </div>


    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ session('error') }}",
            toast: true, // This enables the toast mode
            position: 'top-end', // Position of the toast
            showConfirmButton: false, // Hides the confirm button
            timer: 3000 // Time to show the toast in milliseconds
        });
    </script>
    @endif
    @if(session('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "{{ session('success') }}"
        });
    </script>
    @endif


    @endsection

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <style>
        .pdmadatalist .form-group {
            margin-bottom: 15px;
        }

        .pdmadatalist label {
            display: block;
            text-align: left;
        }

        .pdmadatalist .select2-container {
            width: 100% !important;
            text-align: left;
        }
    </style>
    @push('specific_js')
    <script src="https://code.jquery.com/jquery-4.0.0.js" integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('.js-example-basic-multiple').select2();






        });

        $(document).ready(function() {
            filter_data();

            function filter_data(currentpage) {
                $('.filter_data').html('<div id="loading"></div>');
                var action = 'fetch_data';
                var sorting = $("#sorting").val();
                var direction = $("#direction").val();
                var product_name = $("#product_name").val();
                var qty = $("#qty").val();
                var main_class = $("#main_class").val();


                var district = $("#district").val();
                var tehsil_id = $("#tehsil_id").val();
                var uc_id = $("#uc_id").val();

                var beneficiary_name = $("#beneficiary_name").val();
                var bank_name = $("#bank_name").val();
                var b_reference_number = $("#b_reference_number").val();
                var cnic = $("#cnic").val();

                //var colors = get_filter('color');


                var ayis_page = currentpage ?? 1;

                $.ajax({
                    type: 'POST',
                    url: "{{ route('manager.product.list') }}",
                    data: {
                        action: action,
                        district: district,
                        tehsil_id: tehsil_id,
                        uc_id: uc_id,
                        b_reference_number: b_reference_number,
                        bank_name: bank_name,
                        beneficiary_name: beneficiary_name,
                        cnic: cnic,
                        sorting: sorting,
                        direction: direction,
                        product_name: product_name,
                        qty: qty,
                        main_class: main_class,
                        ayis_page: ayis_page,
                        _token: '{{csrf_token()}}'
                    },



                    beforeSend: function() {
                        $('.filter_data').html('<center><img src="{{ asset("frontend/images/logo/loader.png") }}" width="300" alt="Loader" /></center>');
                    },
                    success: function(data) {

                        $('.filter_data').html(data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });

            }

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                });
                return filter;
            }





            $('.common_selector').click(function() {
                filter_data();
            });

            $("#b_reference_number, #beneficiary_name, #cnic,#product_name").on('keyup keydown', function() {
                filter_data();
            });



            $('body').on('change', '#sorting, #direction, #qty,#main_class, #district, #tehsil_id, #uc_id,#bank_name', function(e) {
                e.preventDefault();

                filter_data();
            });

            $('body').on('click', '.pagination a', function(f) {
                f.preventDefault();
                var url = $(this).attr('href');
                var currentpage = url.split('page=')[1];
                filter_data(currentpage);
            });







        });
    </script>
    @endpush