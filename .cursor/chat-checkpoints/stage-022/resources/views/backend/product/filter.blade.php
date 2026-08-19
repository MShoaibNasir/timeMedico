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
                                            <select name="main_class" id="main_class" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach ($Classes as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">{{ __('Search By Type') }}</label>
                                        <div class="">
                                            <select name="" id="type" class="form-control">
                                                <option value="">Select Type</option>
                                                @foreach ($types as $item)
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

                        @can('product-edit')
                        <div class="card border-0 shadow-sm mb-4 text-start">
                            <div class="card-body">
                                <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-3">
                                    <div>
                                        <h5 class="mb-1">Bulk Update Products</h5>
                                        <p class="text-muted mb-0 small">
                                            Select products from the list below, tick the fields you want to change, set values, then apply.
                                            <strong><span id="bulkSelectedCount">0</span></strong> product(s) selected.
                                        </p>
                                    </div>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" id="clearProductSelection">
                                        Clear selection
                                    </button>
                                </div>

                                <form id="bulkProductUpdateForm" action="{{ route('manager.product.bulkUpdate') }}" method="POST">
                                    @csrf
                                    <div id="bulkProductIds"></div>

                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input bulk-field-toggle" type="checkbox" value="category_id" id="fld_category" data-target="#bulk_category_id">
                                                <label class="form-check-label" for="fld_category">Category</label>
                                            </div>
                                            <select name="category_id" id="bulk_category_id" class="form-select" disabled>
                                                <option value="">Select Category</option>
                                                @foreach ($Classes as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input bulk-field-toggle" type="checkbox" value="brand_id" id="fld_brand" data-target="#bulk_brand_id">
                                                <label class="form-check-label" for="fld_brand">Brand</label>
                                            </div>
                                            <select name="brand_id" id="bulk_brand_id" class="form-select" disabled>
                                                <option value="">Select Brand</option>
                                                @foreach ($brands as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input bulk-field-toggle" type="checkbox" value="type" id="fld_type" data-target="#bulk_type">
                                                <label class="form-check-label" for="fld_type">Type</label>
                                            </div>
                                            <select name="type" id="bulk_type" class="form-select" disabled>
                                                <option value="">Select Type</option>
                                                @foreach ($types as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input bulk-field-toggle" type="checkbox" value="price" id="fld_price" data-target="#bulk_price">
                                                <label class="form-check-label" for="fld_price">Price</label>
                                            </div>
                                            <input type="number" step="0.01" min="0" name="price" id="bulk_price" class="form-control" disabled placeholder="e.g. 255">
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input bulk-field-toggle" type="checkbox" value="discount" id="fld_discount" data-target="#bulk_discount">
                                                <label class="form-check-label" for="fld_discount">Discount (%)</label>
                                            </div>
                                            <input type="number" step="1" min="0" max="100" name="discount" id="bulk_discount" class="form-control" disabled placeholder="e.g. 10">
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input bulk-field-toggle" type="checkbox" value="quantity" id="fld_quantity" data-target="#bulk_quantity">
                                                <label class="form-check-label" for="fld_quantity">Stock Quantity</label>
                                            </div>
                                            <input type="number" min="0" name="quantity" id="bulk_quantity" class="form-control" disabled placeholder="e.g. 50">
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input bulk-field-toggle" type="checkbox" value="in_stock" id="fld_in_stock" data-target="#bulk_in_stock">
                                                <label class="form-check-label" for="fld_in_stock">In Stock Flag</label>
                                            </div>
                                            <select name="in_stock" id="bulk_in_stock" class="form-select" disabled>
                                                <option value="1">In Stock</option>
                                                <option value="0">Out of Stock</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input bulk-field-toggle" type="checkbox" value="status" id="fld_status" data-target="#bulk_status">
                                                <label class="form-check-label" for="fld_status">Product Status</label>
                                            </div>
                                            <select name="status" id="bulk_status" class="form-select" disabled>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input bulk-field-toggle" type="checkbox" value="generic_name" id="fld_generic" data-target="#bulk_generic_name">
                                                <label class="form-check-label" for="fld_generic">Generic Name</label>
                                            </div>
                                            <input type="text" name="generic_name" id="bulk_generic_name" class="form-control" disabled placeholder="Generic name">
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input bulk-field-toggle" type="checkbox" value="unit" id="fld_unit" data-target="#bulk_unit">
                                                <label class="form-check-label" for="fld_unit">Unit</label>
                                            </div>
                                            <input type="text" name="unit" id="bulk_unit" class="form-control" disabled placeholder="e.g. strip, ml">
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input bulk-field-toggle" type="checkbox" value="company_name" id="fld_company" data-target="#bulk_company_name">
                                                <label class="form-check-label" for="fld_company">Company Name</label>
                                            </div>
                                            <input type="text" name="company_name" id="bulk_company_name" class="form-control" disabled placeholder="Company">
                                        </div>
                                    </div>

                                    <div class="mt-3 d-flex flex-wrap gap-2">
                                        <button type="button" id="bulkApplyBtn" class="btn btn-primary" disabled>
                                            <i class="fa-solid fa-pen-to-square me-1"></i> Apply Bulk Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endcan

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

            window.selectedProductIds = window.selectedProductIds || new Set();

            function syncBulkSelectionUI() {
                const count = window.selectedProductIds.size;
                $('#bulkSelectedCount').text(count);
                $('#bulkApplyBtn').prop('disabled', count === 0);
                $('#pageSelectedHint').text($('.product-row-chk:checked').length);
            }

            window.restoreProductSelection = function() {
                $('.product-row-chk').each(function() {
                    const id = String($(this).val());
                    $(this).prop('checked', window.selectedProductIds.has(id));
                });

                const $rows = $('.product-row-chk');
                const allChecked = $rows.length > 0 && $rows.filter(':checked').length === $rows.length;
                $('#selectAllProducts, #selectAllProductsHead').prop('checked', allChecked);
                syncBulkSelectionUI();
            };

            function setPageSelection(checked) {
                $('.product-row-chk').each(function() {
                    const id = String($(this).val());
                    $(this).prop('checked', checked);
                    if (checked) {
                        window.selectedProductIds.add(id);
                    } else {
                        window.selectedProductIds.delete(id);
                    }
                });
                $('#selectAllProducts, #selectAllProductsHead').prop('checked', checked);
                syncBulkSelectionUI();
            }

            $(document).on('change', '.product-row-chk', function() {
                const id = String($(this).val());
                if (this.checked) {
                    window.selectedProductIds.add(id);
                } else {
                    window.selectedProductIds.delete(id);
                }
                const $rows = $('.product-row-chk');
                const allChecked = $rows.length > 0 && $rows.filter(':checked').length === $rows.length;
                $('#selectAllProducts, #selectAllProductsHead').prop('checked', allChecked);
                syncBulkSelectionUI();
            });

            $(document).on('change', '#selectAllProducts, #selectAllProductsHead', function() {
                setPageSelection($(this).prop('checked'));
            });

            $('#clearProductSelection').on('click', function() {
                window.selectedProductIds.clear();
                $('.product-row-chk').prop('checked', false);
                $('#selectAllProducts, #selectAllProductsHead').prop('checked', false);
                syncBulkSelectionUI();
            });

            $(document).on('change', '.bulk-field-toggle', function() {
                const target = $($(this).data('target'));
                target.prop('disabled', !this.checked);
                if (!this.checked) {
                    if (target.is('select')) {
                        target.prop('selectedIndex', 0);
                    } else {
                        target.val('');
                    }
                }
            });

            $('#bulkApplyBtn').on('click', function() {
                const ids = Array.from(window.selectedProductIds);
                const fields = $('.bulk-field-toggle:checked').map(function() {
                    return $(this).val();
                }).get();

                if (!ids.length) {
                    Swal.fire('No products selected', 'Please select at least one product from the list.', 'warning');
                    return;
                }

                if (!fields.length) {
                    Swal.fire('No fields selected', 'Tick at least one field to update.', 'warning');
                    return;
                }

                // Validate enabled field values
                for (let i = 0; i < fields.length; i++) {
                    const field = fields[i];
                    const $toggle = $('.bulk-field-toggle[value="' + field + '"]');
                    const $input = $($toggle.data('target'));
                    const val = $input.val();
                    if (val === null || val === '') {
                        Swal.fire('Missing value', 'Please provide a value for "' + field.replace(/_/g, ' ') + '".', 'warning');
                        return;
                    }
                }

                Swal.fire({
                    title: 'Apply bulk update?',
                    html: 'Update <strong>' + fields.length + '</strong> field(s) on <strong>' + ids.length + '</strong> product(s).',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, update',
                    confirmButtonColor: '#0d6efd'
                }).then(function(result) {
                    if (!result.isConfirmed) return;

                    const $form = $('#bulkProductUpdateForm');
                    const $idsWrap = $('#bulkProductIds').empty();
                    ids.forEach(function(id) {
                        $idsWrap.append('<input type="hidden" name="product_ids[]" value="' + id + '">');
                    });

                    // Remove old fields[] then add current
                    $form.find('input[name="fields[]"]').remove();
                    fields.forEach(function(field) {
                        $form.append('<input type="hidden" name="fields[]" value="' + field + '">');
                    });

                    $form.trigger('submit');
                });
            });

            function filter_data(currentpage) {
                $('.filter_data').html('<div id="loading"></div>');
                var action = 'fetch_data';
                var sorting = $("#sorting").val();
                var direction = $("#direction").val();
                var product_name = $("#product_name").val();
                var qty = $("#qty").val();
                var main_class = $("#main_class").val();
                var type = $("#type").val();


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
                        type: type,
                        ayis_page: ayis_page,
                        _token: '{{csrf_token()}}'
                    },



                    beforeSend: function() {
                        $('.filter_data').html('<center><img src="{{ asset("frontend/images/loader.png") }}" width="300" alt="Loader" /></center>');
                    },
                    success: function(data) {

                        $('.filter_data').html(data);
                        if (typeof window.restoreProductSelection === 'function') {
                            window.restoreProductSelection();
                        }
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
            // Make filter_data available if needed
            window.productFilterData = filter_data;
        });
    </script>
    @endpush
