@extends('backend.layout.master')

@section('content')

<section class="content mt-3">
    <div class="container-fluid">

        
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Coupon</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/manager') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Create Coupon</li>
                </ol>
            </div>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row">
            <div class="col-md-12">

                <div class="card card-dark">

                    <div class="card-header">
                        <h3 class="card-title">Create Coupon</h3>
                    </div>

                    <form action="{{ route('manager.coupon.store') }}" method="POST">
                        @csrf

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label><strong>Coupon Code</strong></label>
                                    <input type="text"
                                        name="code"
                                        class="form-control"
                                        placeholder="e.g. SAVE20"
                                        value="{{ old('code') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label><strong>Coupon Type</strong></label>
                                    <select name="type" class="form-control">
                                        <option value="">Select Type</option>
                                        <option value="fixed">Fixed Amount</option>
                                        <option value="percent">Percentage</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label><strong>Value</strong></label>
                                    <input type="number"
                                        step="0.01"
                                        name="value"
                                        class="form-control"
                                        placeholder="Discount Value">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label><strong>Minimum Order Amount</strong></label>
                                    <input type="number"
                                        step="0.01"
                                        name="min_order_amount"
                                        class="form-control"
                                        placeholder="0.00">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label><strong>Maximum Discount Amount</strong></label>
                                    <input type="number"
                                        step="0.01"
                                        name="max_discount_amount"
                                        class="form-control"
                                        placeholder="Optional">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label><strong>Usage Limit</strong></label>
                                    <input type="number"
                                        name="usage_limit"
                                        class="form-control"
                                        placeholder="Optional">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label><strong>Expiry Date</strong></label>
                                    <input type="datetime-local"
                                        name="expires_at"
                                        class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label><strong>Status</strong></label>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-dark">
                                <i class="fas fa-save"></i> Create Coupon
                            </button>

                            <a href="{{ route('manager.coupon.index') }}"
                                class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>


</section>
@endsection