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


        <div class="row">
            <div class="col-6">
                <form action="{{ route('manager.area.UpdateBulkPrice') }}" method="post" id="bulkPriceForm">
                    @csrf

                    <input type="text"
                        name="price"
                        placeholder="Price"
                        class="form-control"
                        value="{{ old('price') }}">

                    <select name="calcualtion_option" class="form-control my-2">
                        <option value="">Select Calculation Option</option>
                        <option value="add" {{ old('calcualtion_option') == 'add' ? 'selected' : '' }}>
                            Add
                        </option>
                        <option value="minus" {{ old('calcualtion_option') == 'minus' ? 'selected' : '' }}>
                            Minus
                        </option>
                    </select>

                    <!-- Selected area ids yahan JS se inject honge -->
                    <div id="selectedAreaIdsContainer"></div>

                    <button type="submit" class="btn btn-danger btn-sm">Submit</button>
                </form>
            </div>
        </div>

        <div class="col-md-12">
            <table id="dataTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th><input type="checkbox" id="selectAllAreas"></th>
                        <th>No</th>
                        <th>Name</th>
                        <th>Delivery Charges</th>
                        <th>Service Available</th>

                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $key => $data)
                    <tr>
                        <td>
                            <input type="checkbox" class="area-checkbox" value="{{ $data->id }}">
                        </td>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->delivery_charges }}</td>
                        <td>
                            <span class="badge {{ $data->is_service_able == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $data->is_service_able == 1 ? 'Yes' : 'No' }}
                            </span>
                        </td>
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



@push('specific_js')


@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        html: `{!! implode('<br>', $errors->all()) !!}`,
        confirmButtonColor: '#d33'
    });
</script>
@endif
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session("success") }}'
    });
</script>
@endif



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
    // Select All checkbox
    $(document).on('change', '#selectAllAreas', function() {
        $('.area-checkbox').prop('checked', $(this).is(':checked'));
    });

    // Form submit hone se pehle selected ids ko hidden inputs ke through bhejna
    $('#bulkPriceForm').on('submit', function(e) {
        var selected = $('.area-checkbox:checked').map(function() {
            return $(this).val();
        }).get();

        // Purane hidden inputs saaf karo (agar dobara submit ho)
        $('#selectedAreaIdsContainer').empty();

        if (selected.length === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'No Area Selected',
                text: 'Please select at least one area.'
            });
            return false;
        }

        selected.forEach(function(id) {
            $('#selectedAreaIdsContainer').append(
                '<input type="hidden" name="area_ids[]" value="' + id + '">'
            );
        });
    });
    $(document).ready(function() {
        $("#dataTable").dataTable();

    });
</script>
@endpush