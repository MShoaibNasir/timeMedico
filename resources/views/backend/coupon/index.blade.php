@extends('backend.layout.master')

@section('content')

<section class="content mt-3">
    <div class="container-fluid">

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

                                @canany(['coupon-edit','coupon-delete'])
                                    <th width="150">Action</th>
                                @endcanany
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($coupons as $coupon)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <span class="badge badge-info">
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
                                        Rs. {{ number_format($coupon->min_order_amount ?? 0, 2) }}
                                    </td>

                                    <td>
                                        Rs. {{ number_format($coupon->max_discount_amount ?? 0, 2) }}
                                    </td>

                                    <td>
                                        {{ $coupon->usage_limit ?? 0 }}
                                    </td>

                                    <td>
                                        {{ $coupon->used_count ?? 0 }}
                                    </td>

                                    <td>
                                        @if($coupon->expires_at)
                                            {{ \Carbon\Carbon::parse($coupon->expires_at)->format('d M Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td>
                                        @if($coupon->status)
                                            <span class="badge badge-success">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    @canany(['coupon-edit','coupon-delete'])

                                        <td>

                                            @can('coupon-edit')
                                                <a href="{{ route('manager.coupon.edit',$coupon->id) }}"
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan

                                            @can('coupon-delete')
                                                <form id="deleteCouponForm{{ $coupon->id }}"
                                                      action="{{ route('manager.coupon.destroy',$coupon->id) }}"
                                                      method="POST"
                                                      style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="button"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="deleteCoupon({{ $coupon->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan

                                        </td>

                                    @endcanany

                                </tr>

                            @endforeach

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
        border: 0;
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
    function deleteCoupon(id)
    {
        Swal.fire({
            title: 'Delete Coupon?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Yes, Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#deleteCouponForm' + id).submit();
            }
        });
    }

    $(function () {

        if ($.fn.DataTable.isDataTable('#dataTable')) {
            $('#dataTable').DataTable().destroy();
        }

        $('#dataTable').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 25,
            language: {
                emptyTable: "No coupons found"
            }
        });

    });
</script>
@endpush