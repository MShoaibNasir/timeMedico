@extends('backend.layout.master')
@section('content')

<section class="content mt-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Slider List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/manager') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Slider List</li>
                </ol>
            </div>
        </div>
        {{-- @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @elseif ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif --}}
    <div class="col-md-12">
        <table id="dataTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
            width="100%">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $key => $data)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $data->image) }}" width="50" height="50">
                    </td>


                    <td class="align-middle">
                        <span class="badge {{ $data->status == 1 ? 'bg-success' : 'bg-danger' }}">
                            {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                        </span>
                    </td>


                    <td>
                        @can('category-edit')
                        <a class="btn btn-primary btn-sm" href="{{ route('manager.slider.edit',$data->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        @endcan

                        @can('category-delete')
                        <form id="deleteAdminForm{{ $key }}"
                            method="POST"
                            action="{{ route('manager.slider.destroy', $data->id) }}"
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

    });
</script>
@endpush