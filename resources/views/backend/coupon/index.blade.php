@extends('backend.layout.master')

@section('content')

<section class="content mt-3">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="row mb-3">
            <div class="col-sm-6">
                <h1 class="mb-0">Coupon List</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/manager') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Coupon List
                    </li>
                </ol>
            </div>
        </div>

        <!-- Coupon Table -->
        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-striped w-100">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Coupon Code</th>
                                <th>Discount</th>
                                <th>Min Order</th>
                                <th>Max Discount</th>
                                <th>Usage Limit</th>
                                <th>Used</th>
                                <th>Expiry Date</th>
                                <th>Status</th>
                                <th width="160">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($coupons as $key => $coupon)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <span class="badge badge-info p-2">
                                        {{ $coupon->code }}
                                    </span>
                                </td>

                                <td>
                                    @if($coupon->type == 'percent')
                                    <span class="badge badge-success">
                                        {{ $coupon->value }}%
                                    </span>
                                    @else
                                    <span class="badge badge-primary">
                                        Rs. {{ number_format($coupon->value, 2) }}
                                    </span>
                                    @endif
                                </td>

                                <td>
                                    Rs. {{ number_format($coupon->min_order_amount, 2) }}
                                </td>

                                <td>
                                    Rs. {{ number_format($coupon->max_discount_amount, 2) }}
                                </td>

                                <td>
                                    {{ $coupon->usage_limit }}
                                </td>

                                <td>
                                    {{ $coupon->used_count }}
                                </td>

                                <td>
                                    @if($coupon->expires_at)
                                    {{ \Carbon\Carbon::parse($coupon->expires_at)->format('d M Y') }}
                                    @else
                                    N/A
                                    @endif
                                </td>

                                <td>
                                    @if($coupon->status == 1)
                                    <span class="badge badge-success">
                                        Active
                                    </span>
                                    @else
                                    <span class="badge badge-danger">
                                        Inactive
                                    </span>
                                    @endif
                                </td>

                                <td>

                                    @can('coupon-edit')
                                    <a href="{{ route('manager.coupon.edit', $coupon->id) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan

                                    @can('coupon-delete')
                                    <form id="deleteCouponForm{{ $key }}"
                                        action="{{ route('manager.coupon.destroy', $coupon->id) }}"
                                        method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                            class="btn btn-danger btn-sm"
                                            onclick="deleteFunction({{ $key }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endcan

                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="10" class="text-center">
                                    No Coupons Found
                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection

@push('specific_css')
<style>
    .card {
        border: none;
        border-radius: 10px;
    }

    .table th,
    .table td {
        vertical-align: middle !important;
    }

    .badge {
        font-size: 12px;
        padding: 6px 10px;
    }
</style>
@endpush

@push('specific_js')
<script>
    function deleteFunction(key) {
        let form = $("#deleteCouponForm" + key);

        Swal.fire({
            title: 'Delete Coupon?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Yes, Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 25
        });
    });
</script>
@endpush