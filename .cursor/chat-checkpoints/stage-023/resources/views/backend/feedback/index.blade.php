@extends('backend.layout.master')
@section('content')

<section class="content mt-3">
    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Customer Feedback</h1>
                <p class="text-muted mb-0">Feedback submitted by website users</p>
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

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable"
                           class="table table-striped table-bordered dt-responsive nowrap"
                           cellspacing="0"
                           width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($feedback as $key => $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $data->user->name ?? 'Guest / N/A' }}
                                    @if($data->user && $data->user->phone_number)
                                        <div class="small text-muted">{{ $data->user->phone_number }}</div>
                                    @endif
                                </td>
                                <td>{{ $data->email ?: ($data->user->email ?? '—') }}</td>
                                <td>{{ $data->subject ?: '—' }}</td>
                                <td>
                                    {{ \Illuminate\Support\Str::limit($data->message, 80) }}
                                </td>
                                <td>{{ optional($data->created_at)->format('d M Y, h:i A') }}</td>
                                <td>
                                    <a href="{{ route('manager.feedback.show', $data->id) }}"
                                       class="btn btn-outline-primary btn-sm">
                                        View
                                    </a>
                                    <form id="deleteFeedbackForm{{ $key }}"
                                          method="POST"
                                          action="{{ route('manager.feedback.destroy', $data->id) }}"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                class="btn btn-outline-danger btn-sm"
                                                onclick="deleteFeedback({{ $key }})">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No feedback submitted yet.</td>
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

@push('specific_js')
<script>
    function deleteFeedback(key) {
        var form = $("#deleteFeedbackForm" + key);

        Swal.fire({
            title: "Delete this feedback?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Yes, delete it"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    $(document).ready(function () {
        if ($("#dataTable tbody tr").length && !$("#dataTable tbody tr td[colspan]").length) {
            $("#dataTable").DataTable({
                order: [[5, 'desc']]
            });
        }
    });
</script>
@endpush
