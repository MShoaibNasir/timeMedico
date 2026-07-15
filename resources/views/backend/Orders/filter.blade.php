@extends('backend.layout.master')
@section('content')

<style>
    label {
        display: flex;
        font-size: 19px;
        font-weight: 700;
    }
</style>

<div class="content">
    <div class="container-fluid pt-4 px-4 form_width">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h1 class="mb-0">Order Management</h1>
            </div>
            <div class="row g-3">

                <div class="col-md-3">
                    <label>Order No</label>
                    <input type="text" id="order_no" class="form-control" placeholder="Order No">
                </div>

                <div class="col-md-3">
                    <label>Date</label>
                    <input type="date" id="order_date" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Customer Name / Phone</label>
                    <input type="text" id="customer_search" class="form-control"
                        placeholder="Customer Name or Phone">
                </div>

                <div class="col-md-3">
                    <label>Status</label>
                    <select id="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Processing">Processing</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="Returned">Returned</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Qty</label>
                    <select id="qty" class="form-control">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>

            </div>

            <div id="order_list"></div>

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

                let order_no = $("#order_no").val();
                let order_date = $("#order_date").val();
                let customer_search = $("#customer_search").val();
                let status = $("#status").val();
                let qty = $("#qty").val();
                let page = currentpage ?? 1;

                $.ajax({
                    url: "{{ route('manager.order.list') }}",
                    type: "GET",

                    data: {
                        order_no: order_no,
                        order_date: order_date,
                        customer_search: customer_search,
                        status: status,
                        qty: qty,
                        page: page
                    },
                    success: function(response) {
                        $("#order_list").html(response);
                    }
                });
            }

            $('body').on('keyup', '#order_no,#customer_search', function() {
                filter_data();
            });

            $('body').on('change', '#order_date,#status,#qty', function() {
                filter_data();
            });

            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                filter_data(page);
            });

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



            $('body').on('change', '#sorting, #direction, #qty,#main_class,#type, #district, #tehsil_id, #uc_id,#bank_name', function(e) {
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