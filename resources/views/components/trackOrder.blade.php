@if(!$order)

<div class="alert alert-warning">
    Enter a valid order number to track your order.
</div>

@else

@if(!$order_verify_for_payment)

@php
$statusSteps = [
    'Pending' => 1,
    'Processing' => 2,
    'On The Way' => 3,
    'Delivered' => 4,
];

$currentStep = $statusSteps[$order->status] ?? 0;
@endphp

@if(in_array($order->status, ['Rejected', 'Returned']))

<div class="alert alert-danger">
    <strong>Order Status:</strong> {{ $order->status }}
</div>

@else

<div class="mb-4 text-center">
    <h5>Order #{{ $order->order_no }}</h5>
    <span class="badge bg-primary">{{ $order->status }}</span>
</div>

<div class="track-order-step">

    <div class="step-item {{ $currentStep >= 1 ? 'completed' : '' }}">
        <div class="step-icon">
            <i class="fal fa-shopping-cart"></i>
        </div>
        <h6>Order Confirmed</h6>
    </div>

    <div class="step-item {{ $currentStep >= 2 ? 'completed' : '' }}">
        <div class="step-icon">
            <i class="fal fa-cog"></i>
        </div>
        <h6>Processing</h6>
    </div>

    <div class="step-item {{ $currentStep >= 3 ? 'completed' : '' }}">
        <div class="step-icon">
            <i class="fal fa-truck-fast"></i>
        </div>
        <h6>On The Way</h6>
    </div>

    <div class="step-item {{ $currentStep >= 4 ? 'completed' : '' }}">
        <div class="step-icon">
            <i class="fal fa-home"></i>
        </div>
        <h6>Delivered</h6>
    </div>

</div>

@endif

@else

@if($order->payment_type == 'cod')
<div class="alert alert-warning">
    This order was placed using Cash on Delivery. Payment slip upload is not required.
</div>
@else
<!-- Bank Details Card -->
<div class="card shadow-sm border-0 mb-4">

    <div class="card-header text-white" style="background:#2C2872;">
        <h5 class="mb-0" style="color:#ffff">
            <i class="fas fa-university me-2"></i>
            Bank Transfer Details
        </h5>
    </div>

    <div class="card-body">

        <div class="alert alert-info">
            <strong>Instructions:</strong>
            Please transfer the exact order amount of
            <strong>PKR {{ number_format($order->total_amount, 2) }}</strong>
            to the bank account below. Once payment has been completed,
            upload your payment slip for verification.
        </div>

        <div class="border rounded p-3 bg-light">

            <h6 class="fw-bold mb-3">
                <i class="fas fa-building-columns me-2"></i>
                Bank Information
            </h6>

            <div class="row mb-2">
                <div class="col-md-4 fw-semibold">
                    Bank Name
                </div>
                <div class="col-md-8">
                    {{ $setting->bank_name ?? 'Meezan Bank Limited' }}
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-4 fw-semibold">
                    Account Title
                </div>
                <div class="col-md-8">
                    {{ $setting->account_title ?? 'Time Medico' }}
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-4 fw-semibold">
                    Account Number
                </div>
                <div class="col-md-8">

                    <span id="accountNumber">
                        {{ $setting->account_number ?? '1234567890' }}
                    </span>

                    <button type="button"
                        class="btn btn-sm btn-outline-secondary ms-2"
                        onclick="copyText('accountNumber', this)">
                        Copy
                    </button>

                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-4 fw-semibold">
                    IBAN
                </div>
                <div class="col-md-8">

                    <span id="iban">
                        {{ $setting->iban ?? 'PK00MEZN0000001234567890' }}
                    </span>

                    <button type="button"
                        class="btn btn-sm btn-outline-secondary ms-2"
                        onclick="copyText('iban', this)">
                        Copy
                    </button>

                </div>
            </div>

            <div class="row">
                <div class="col-md-4 fw-semibold">
                    Branch
                </div>
                <div class="col-md-8">
                    {{ $setting->branch_name ?? 'Main Branch' }}
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Upload Payment Slip -->
<div class="card border-0 shadow-sm">

    <div class="card-header text-white" style="background:#EE1B21;">
        <h5 class="mb-0" style="color: #ffff;">
            <i class="fa-solid fa-file-invoice-dollar me-2"></i>
            Upload Payment Slip
        </h5>
    </div>

    <div class="card-body">

        <form action="{{ route('frontend.dashboard.uploadPaymentSlip') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <input type="hidden"
                name="order_id"
                value="{{ $order->id }}">

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Payment Slip <span class="text-danger">*</span>
                </label>

                <input type="file"
                    name="image_payment_slip"
                    class="form-control"
                    required
                    accept=".jpg,.jpeg,.png,.pdf">

                <small class="text-muted">
                    Accepted formats: JPG, JPEG, PNG, PDF (Maximum 5 MB)
                </small>

            </div>

            <div class="alert alert-warning mb-4">
                <strong>Note:</strong>
                Your order will remain
                <strong>Pending Verification</strong>
                until our accounts team verifies your payment.
            </div>

            <button type="submit"
                class="btn text-white"
                style="background:#EE1B21;">

                <i class="fa-solid fa-cloud-arrow-up me-2"></i>
                Submit Payment Slip

            </button>

        </form>

    </div>

</div>

@endif

@endif

@endif

<script>
    function copyText(id, btn) {

        let text = document.getElementById(id).innerText;

        navigator.clipboard.writeText(text);

        let originalText = btn.innerHTML;

        btn.innerHTML = 'Copied';

        setTimeout(() => {
            btn.innerHTML = originalText;
        }, 2000);
    }
</script>