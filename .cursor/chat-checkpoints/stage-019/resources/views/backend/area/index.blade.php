@extends('backend.layout.master')
@section('content')

<section class="content mt-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Area List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/manager') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Area List</li>
                </ol>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @can('area-edit')
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                    <div>
                        <h5 class="mb-1">Bulk Delivery Charges</h5>
                        <p class="text-muted mb-0 small">Apply one change to all areas at once (e.g. +10 Rs on every area).</p>
                    </div>
                </div>

                <form id="bulkDeliveryForm" action="{{ route('manager.area.bulkDeliveryCharges') }}" method="POST">
                    @csrf
                    <div class="row g-2 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Action</label>
                            <select name="mode" class="form-select" required>
                                <option value="increase" @selected(old('mode') === 'increase')>Increase by (+)</option>
                                <option value="decrease" @selected(old('mode') === 'decrease')>Decrease by (−)</option>
                                <option value="set" @selected(old('mode') === 'set')>Set all to</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Amount (Rs)</label>
                            <input type="number"
                                   name="amount"
                                   class="form-control"
                                   min="0"
                                   step="0.01"
                                   value="{{ old('amount', 10) }}"
                                   placeholder="e.g. 10"
                                   required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Apply to</label>
                            <select name="scope" class="form-select" required>
                                <option value="all" @selected(old('scope', 'all') === 'all')>All areas</option>
                                <option value="active" @selected(old('scope') === 'active')>Active areas only</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="button" id="bulkDeliveryBtn" class="btn btn-primary w-100">
                                <i class="fa-solid fa-bolt me-1"></i> Apply to Areas
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endcan

        <div class="col-md-12">
            <table id="dataTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Delivery Charges</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $key => $data)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $data->name }}</td>
                        <td>Rs {{ number_format((float) $data->delivery_charges, 2) }}</td>
                        <td class="align-middle">
                            <span class="badge {{ $data->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            @can('area-edit')
                            <a class="btn btn-primary btn-sm" href="{{ route('manager.area.edit',$data->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            @endcan

                            @can('area-delete')
                            <form id="deleteAdminForm{{ $key }}"
                                method="POST"
                                action="{{ route('manager.area.destroy', $data->id) }}"
                                style="display:inline">
                                @csrf
                                @method('DELETE')

                                <button type="button"
                                    class="btn btn-danger btn-sm"
                                    onclick="deleteFunction({{ $key }})">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

@push('specific_css')
@endpush

@push('specific_js')
<script>
    function deleteFunction(key) {
        var form = $("#deleteAdminForm" + key);

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    $(document).ready(function() {
        $("#dataTable").dataTable();

        $('#bulkDeliveryBtn').on('click', function () {
            var form = $('#bulkDeliveryForm');
            var mode = form.find('[name="mode"] option:selected').text();
            var amount = form.find('[name="amount"]').val();
            var scope = form.find('[name="scope"] option:selected').text();

            if (amount === '' || Number(amount) < 0) {
                Swal.fire('Invalid amount', 'Please enter a valid amount (0 or more).', 'error');
                return;
            }

            Swal.fire({
                title: 'Apply to areas?',
                html: '<strong>' + mode + '</strong> Rs <strong>' + amount + '</strong><br>Scope: <strong>' + scope + '</strong>',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, apply'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
