@extends('backend.layout.master')
@section('content')
<section class="content mt-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Speaking and Writing Opportunities</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/manager') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Speaking and Writing</li>
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
                    <th>User Name</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Duration</th>
                    <th>Visit</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $data)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->type }}</td>
                    <td>{{ $data->duration }}</td>
                    @if($data->resource_type=='link')
                    @php
                    $url = $data->link;
                    if (!Str::startsWith($url, ['http://', 'https://'])) {
                    $url = 'https://' . $url;
                    }
                    @endphp
                    <td><a href="{{$url}}" target="_blank" class="btn btn-primary btn-sm">Visit</a></td>
                    @else
                    <td>
                        <a href="{{asset($data->video)}}"
                            target="_blank"
                            class="btn btn-primary btn-sm"
                            download>
                            Visit
                        </a>
                    </td>
                    @endif
                    <td>
                        @if($data->status==0)
                        <a href="{{ route('manager.communication.status', $data->id) }}" class="btn btn-success btn-sm">Approved</a>
                        @else
                        <a href="{{ route('manager.communication.status', $data->id) }}" class="btn btn-danger btn-sm">Not Approved</a>
                        @endif
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
        event.preventDefault(); // prevent form submit
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
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });
            }
        });
    }
    $(document).ready(function() {
        $("#dataTable").dataTable();

    });
</script>
@endpush