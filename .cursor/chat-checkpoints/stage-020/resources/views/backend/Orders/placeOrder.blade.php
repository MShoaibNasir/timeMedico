@extends('backend.layout.master')

@section('content')
<div class="content container-fluid px-4 py-3">
    <div class="card border-0 shadow-sm rounded-3">

        {{-- Card Header --}}
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <div class="avatar avatar-sm bg-primary-subtle text-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="fa fa-shopping-cart fa-lg"></i>
                </div>
                <div>
                    <h5 class="card-title mb-0 fw-bold text-dark">Create Customer Order</h5>
                </div>
            </div>
        </div>

        <div class="card-body p-4">

            {{-- Info Alert --}}
            <div class="alert alert-primary border-0 bg-primary-subtle text-primary-emphasis d-flex align-items-center rounded-3 p-3 mb-4" role="alert">
                <i class="fa fa-info-circle fa-lg me-3"></i>
                <div class="fs-7">
                    <strong>Quick Tip:</strong> Enter customer details and select products below. Unit prices, sub-totals, delivery charges, and grand totals update dynamically.
                </div>
            </div>

            <form action="{{ route('manager.order.place.store') }}" novalidate method="POST" id="placeOrderForm">
                @csrf

                {{-- ============ SECTION 1: CUSTOMER DETAILS ============ --}}
                <div class="mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-primary rounded-pill me-2">1</span>
                        <h6 class="mb-0 fw-bold text-uppercase text-secondary tracking-wide">Customer Details</h6>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-dark">Customer Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa fa-user text-muted"></i></span>
                                <input type="text" name="customer_name" class="form-control border-start-0" placeholder="e.g. Ali Raza" required>
                            </div>
                        </div>

                         <div class="col-md-4">
                            <label class="form-label fw-semibold text-dark">Phone Number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa fa-phone text-muted"></i></span>
                                <input type="text"
                                    id="phoneInput"
                                    name="phone"
                                    class="form-control border-start-0"
                                    placeholder="03XX-XXXXXXX"
                                    maxlength="12"
                                    pattern="^03[0-9]{2}-[0-9]{7}$"
                                    title="Please enter a valid Pakistani phone number (e.g., 0321-6905568)"
                                    required>
                            </div>
                            <small class="text-muted fs-7">Format: 03XX-XXXXXXX</small>
                        </div>
                        

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-dark">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa fa-envelope text-muted"></i></span>
                                <input type="email" name="customer_email" class="form-control border-start-0" placeholder="optional@domain.com">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-dark">Order Source</label>
                            <select name="social_media_order_source" class="form-select">
                                <option value="WhatsApp">WhatsApp</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Phone Call">Phone Call</option>
                                <option value="Walk In">Walk In</option>
                            </select>
                        </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-dark">Delivery Option <span class="text-danger">*</span></label>
                                <select name="delivery_method" id="delivery_method" class="form-select" required>
                                    <option value="local">Local Area Delivery</option>
                                    <option value="courier">Courier (Non-serviceable areas)</option>
                                    <option value="pakistan">All Over Pakistan</option>
                                </select>
                            </div>

                            <div class="col-md-4" id="adminAreaWrap">
                                <label class="form-label fw-semibold text-dark">Delivery Area <span class="text-danger">*</span></label>
                                <select name="area_id" id="area_id" class="form-select">
                                    <option value="">Select Area</option>
                                    <optgroup label="Serviceable (Local)" id="serviceableGroup">
                                        @foreach($serviceableAreas as $area)
                                        <option value="{{ $area->id }}" data-charges="{{ $area->delivery_charges }}" data-serviceable="1">
                                            {{ $area->name }}
                                        </option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Non-serviceable (Courier)" id="nonServiceableGroup">
                                        @foreach($nonServiceableAreas as $area)
                                        <option value="{{ $area->id }}" data-charges="{{ $area->delivery_charges }}" data-serviceable="0">
                                            {{ $area->name }}
                                        </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>

                            <div class="col-md-4 d-none" id="adminPakistanWrap">
                                <label class="form-label fw-semibold text-dark">City / Area (Pakistan) <span class="text-danger">*</span></label>
                                <input type="text" name="delivery_area_text" id="delivery_area_text" class="form-control" placeholder="e.g. Lahore, Multan">
                            </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-dark">Payment Method</label>
                            <select name="payment_type" class="form-select">
                                <option value="cod">Cash On Delivery (COD)</option>
                                <option value="online">Online Payment</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark">Delivery Address</label>
                            <textarea name="address" rows="3" class="form-control" placeholder="Complete street address, house/flat number..."></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark">Delivery Instructions</label>
                            <textarea name="delivery_instruction" rows="3" class="form-control" placeholder="e.g. Call before arriving, leave at reception..."></textarea>
                        </div>
                    </div>
                </div>

                <hr class="my-4 text-muted opacity-25">

                {{-- ============ SECTION 2: ORDER ITEMS ============ --}}
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-primary rounded-pill me-2">2</span>
                            <h6 class="mb-0 fw-bold text-uppercase text-secondary tracking-wide">Order Items</h6>
                        </div>

                        <button type="button" id="addProduct" class="btn btn-outline-primary btn-sm rounded-2 fw-semibold shadow-sm">
                            <i class="fa fa-plus me-1"></i> Add Product
                        </button>
                    </div>

                    <div class="table-responsive border rounded-3 overflow-hidden shadow-sm">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light border-bottom">
                                <tr>
                                    <th width="42%" class="py-3 px-3">Product</th>
                                    <th width="15%" class="py-3 px-3">Unit Price</th>
                                    <th width="13%" class="py-3 px-3">Quantity</th>
                                    <th width="18%" class="py-3 px-3">Subtotal</th>
                                    <th width="12%" class="text-center py-3 px-3">Action</th>
                                </tr>
                            </thead>

                            <tbody id="productRows" class="border-top-0">
                                <tr>
                                    <td class="p-3">
                                        <select name="products[0][product_id]" class="form-control product-select" required>
                                            <option value="">Search product by name...</option>
                                            @foreach($product as $item)
                                            <option value="{{ $item->id }}" data-price="{{ $item->final_price ?? $item->price }}">
                                                {{ $item->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="p-3">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light border-end-0">Rs</span>
                                            <input type="text" class="form-control bg-light text-end price border-start-0 fw-semibold" readonly value="0.00">
                                        </div>
                                    </td>

                                    <td class="p-3">
                                        <input type="number" name="products[0][quantity]" class="form-control form-control-sm text-center qty fw-bold" value="1" min="1">
                                    </td>

                                    <td class="p-3">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light border-end-0">Rs</span>
                                            <input type="text" class="form-control bg-light text-end subtotal border-start-0 fw-bold text-dark" readonly value="0.00">
                                        </div>
                                    </td>

                                    <td class="text-center p-3">
                                        <button type="button" class="btn btn-outline-danger btn-sm removeRow rounded-circle p-0 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <hr class="my-4 text-muted opacity-25">

                {{-- ============ SECTION 3: SUMMARY & SUBMIT ============ --}}
                <div class="row justify-content-end">
                    <div class="col-lg-5 col-md-6">
                        <div class="card border border-light-subtle rounded-3 shadow-sm bg-light">
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-3 text-dark border-bottom pb-2">Order Summary</h6>

                                <div class="d-flex justify-content-between mb-2 text-secondary">
                                    <span>Sub Total</span>
                                    <span class="fw-semibold text-dark">Rs <span id="subTotal">0.00</span></span>
                                </div>

                                <div class="d-flex justify-content-between mb-2 text-secondary">
                                    <span>Delivery Charges</span>
                                    <span class="fw-semibold text-dark">Rs <span id="deliveryCharges">0.00</span></span>
                                </div>

                                <div class="d-flex justify-content-between mb-3 text-secondary">
                                    <span>Platform Fee</span>
                                    <span class="fw-semibold text-dark">Rs <span id="platformFee">15.00</span></span>
                                </div>

                                <hr class="my-3">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="h6 mb-0 fw-bold text-dark">Grand Total</span>
                                    <span class="h4 mb-0 fw-bolder text-primary">Rs <span id="grandTotal">0.00</span></span>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm rounded-3 mt-2">
                                    <i class="fa fa-check-circle me-2"></i> Confirm &amp; Create Order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection



@push('specific_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {

        const PLATFORM_FEE = 15;
        let rowCount = 1;

        function initSelect2(scope) {
            scope.find('.product-select').select2({
                width: '100%',
                placeholder: 'Search product by name...'
            });
        }

        // Init first row
        initSelect2($('#productRows'));

        $('#addProduct').on('click', function() {

            let row = `
                <tr>
                    <td class="p-3">
                        <select name="products[${rowCount}][product_id]" class="form-control product-select" required>
                            <option value="">Search product by name...</option>
                            @foreach($product as $item)
                                <option value="{{ $item->id }}" data-price="{{ $item->final_price ?? $item->price }}">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td class="p-3">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0">Rs</span>
                            <input type="text" class="form-control bg-light text-end price border-start-0 fw-semibold" readonly value="0.00">
                        </div>
                    </td>
                    <td class="p-3">
                        <input type="number" name="products[${rowCount}][quantity]" class="form-control form-control-sm text-center qty fw-bold" value="1" min="1">
                    </td>
                    <td class="p-3">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0">Rs</span>
                            <input type="text" class="form-control bg-light text-end subtotal border-start-0 fw-bold text-dark" readonly value="0.00">
                        </div>
                    </td>
                    <td class="text-center p-3">
                        <button type="button" class="btn btn-outline-danger btn-sm removeRow rounded-circle p-0 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;

            let $row = $(row);
            $('#productRows').append($row);
            initSelect2($row);

            rowCount++;
        });

        $(document).on('click', '.removeRow', function() {
            if ($('#productRows tr').length > 1) {
                $(this).closest('tr').remove();
                calculateTotal();
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'At least one product row is required.',
                    confirmButtonColor: '#0d6efd'
                });
            }
        });

        $(document).on('change', '.product-select', function() {
            let row = $(this).closest('tr');
            let price = parseFloat($('option:selected', this).data('price')) || 0;
            let qty = parseInt(row.find('.qty').val()) || 1;

            row.find('.price').val(price.toFixed(2));
            row.find('.subtotal').val((price * qty).toFixed(2));

            calculateTotal();
        });

        $(document).on('keyup change', '.qty', function() {
            let row = $(this).closest('tr');
            let price = parseFloat(row.find('.price').val()) || 0;
            let qty = parseInt($(this).val()) || 1;

            row.find('.subtotal').val((price * qty).toFixed(2));

            calculateTotal();
        });

        $('#area_id').on('change', calculateTotal);
        $('#delivery_method').on('change', function () {
            syncAdminDeliveryUI();
            calculateTotal();
        });

        const COURIER_FEE = {{ (float) ($courierFee ?? config('cart.courier_fee', 250)) }};
        const PAKISTAN_FEE = {{ (float) ($pakistanFee ?? config('cart.pakistan_delivery_fee', 350)) }};

        function syncAdminDeliveryUI() {
            const method = $('#delivery_method').val();
            if (method === 'pakistan') {
                $('#adminAreaWrap').addClass('d-none');
                $('#adminPakistanWrap').removeClass('d-none');
                $('#area_id').prop('required', false).val('');
                $('#delivery_area_text').prop('required', true);
            } else {
                $('#adminAreaWrap').removeClass('d-none');
                $('#adminPakistanWrap').addClass('d-none');
                $('#area_id').prop('required', true);
                $('#delivery_area_text').prop('required', false).val('');

                // Filter options by method
                $('#area_id option').each(function () {
                    const serviceable = $(this).data('serviceable');
                    if (typeof serviceable === 'undefined') return;
                    if (method === 'local') {
                        $(this).toggle(serviceable == 1);
                    } else {
                        $(this).toggle(serviceable == 0);
                    }
                });
                $('#area_id').val('');
            }
        }

        function calculateTotal() {
            let subTotal = 0;

            $('.subtotal').each(function() {
                subTotal += parseFloat($(this).val()) || 0;
            });

            const method = $('#delivery_method').val();
            let deliveryCharges = 0;

            if (method === 'pakistan') {
                deliveryCharges = PAKISTAN_FEE;
            } else if (method === 'courier') {
                deliveryCharges = parseFloat($('#area_id option:selected').data('charges')) || COURIER_FEE;
            } else {
                deliveryCharges = parseFloat($('#area_id option:selected').data('charges')) || 0;
            }

            let grandTotal = subTotal + deliveryCharges + PLATFORM_FEE;

            $('#subTotal').text(subTotal.toFixed(2));
            $('#deliveryCharges').text(deliveryCharges.toFixed(2));
            $('#platformFee').text(PLATFORM_FEE.toFixed(2));
            $('#grandTotal').text(grandTotal.toFixed(2));
        }

        syncAdminDeliveryUI();

        // Phone input formatter
        $('#phoneInput').on('input', function(e) {
            let num = $(this).val().replace(/\D/g, '');

            if (num.length > 11) {
                num = num.substring(0, 11);
            }

            if (num.length > 4) {
                $(this).val(num.substring(0, 4) + '-' + num.substring(4));
            } else {
                $(this).val(num);
            }
        });

        // Form Submit Validation
        $('#placeOrderForm').on('submit', function(e) {
            let hasProduct = false;
            $('.product-select').each(function() {
                if ($(this).val()) hasProduct = true;
            });

            if (!hasProduct) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Product Missing',
                    text: 'Please select at least one product before creating the order.',
                    confirmButtonColor: '#dc3545'
                });
                return false;
            }

            let phoneVal = $('#phoneInput').val().trim();
            let pakPhoneRegex = /^03[0-9]{2}-[0-9]{7}$/;

            if (!pakPhoneRegex.test(phoneVal)) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Phone Number',
                    text: 'Please enter a valid Pakistani phone number in format: 03XX-XXXXXXX',
                    confirmButtonColor: '#dc3545'
                }).then(() => {
                    $('#phoneInput').focus();
                });
                return false;
            }
        });

        // ==========================================
        // Backend Flash Messages & Validation Trigger
        // ==========================================



        // Backend Validation Errors

    });
</script>

@endpush
@push('specific_js')
<!-- SweetAlert CDN (agar master layout me missing hai) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // 1. Validation Errors ($errors Bag)
        @if ($errors->any())
            let errorList = '';
            @foreach ($errors->all() as $error)
                errorList += '<li style="text-align: left; margin-bottom: 4px;">• {{ $error }}</li>';
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Validation Failed',
                html: `<ul style="list-style-type: none; padding-left: 0; color: #dc3545;    display: flex;    justify-content: center;">${errorList}</ul>`,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'OK'
            });
        @endif

        // 2. Custom Backend Error (with('error', $message))
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: `{!! addslashes(session('error')) !!}`,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'OK'
            });
        @endif

        // 3. Success Alert Trigger
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif

    });
</script>
@endpush