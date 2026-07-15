@extends('backend.layout.master')

@section('content')

<section class="content mt-3">
    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Coupon</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/manager') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Edit Coupon
                    </li>
                </ol>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Validation Errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Edit Coupon</h3>
            </div>

            <form action="{{ route('manager.coupon.update', $coupon->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Coupon Code <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="code"
                                   class="form-control"
                                   value="{{ old('code', $coupon->code) }}"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Coupon Type <span class="text-danger">*</span></label>
                            <select name="type"
                                    class="form-control"
                                    required>
                                <option value="percent"
                                    {{ old('type', $coupon->type) == 'percent' ? 'selected' : '' }}>
                                    Percentage
                                </option>

                                <option value="fixed"
                                    {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>
                                    Fixed Amount
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Discount Value <span class="text-danger">*</span></label>
                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   name="value"
                                   class="form-control"
                                   value="{{ old('value', $coupon->value) }}"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Minimum Order Amount</label>
                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   name="min_order_amount"
                                   class="form-control"
                                   value="{{ old('min_order_amount', $coupon->min_order_amount) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Maximum Discount Amount</label>
                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   name="max_discount_amount"
                                   class="form-control"
                                   value="{{ old('max_discount_amount', $coupon->max_discount_amount) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Usage Limit</label>
                            <input type="number"
                                   min="1"
                                   name="usage_limit"
                                   class="form-control"
                                   value="{{ old('usage_limit', $coupon->usage_limit) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Expiry Date</label>
                            <input type="datetime-local"
                                   name="expires_at"
                                   class="form-control"
                                   value="{{ old('expires_at', $coupon->expires_at ? \Carbon\Carbon::parse($coupon->expires_at)->format('Y-m-d\TH:i') : '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1"
                                    {{ old('status', $coupon->status) == 1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0"
                                    {{ old('status', $coupon->status) == 0 ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                        </div>

                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Update Coupon
                    </button>

                    <a href="{{ route('manager.coupon.index') }}"
                       class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>
        </div>

    </div>
</section>

@endsection