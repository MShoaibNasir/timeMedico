@extends('backend.layout.master')
@section('content')

<section class="content mt-3">
    <div class="container-fluid">


    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Feedback List</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ url('/manager') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Feedback List</li>
            </ol>
        </div>
    </div>

    <div class="col-md-12">
        <table id="dataTable"
               class="table table-striped table-bordered dt-responsive nowrap"
               cellspacing="0"
               width="100%">

            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($feedback as $key => $data)
             
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->user->name ?? '----' }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->subject }}</td>
                    <td>{{ $data->message }}</td>
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
    function deleteFunction(key)
    {
        var form = $("#deleteBlogForm" + key);

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

    $(document).ready(function () {
        $("#dataTable").DataTable();
    });
</script>

@endpush
