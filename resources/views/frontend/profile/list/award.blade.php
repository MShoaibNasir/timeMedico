<style>
    .table-wrapper {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin-top: 20px;
    }

    .table thead th {
        background: #f7f9fc;
        font-weight: 600;
        color: #444;
        border-bottom: 2px solid #e9ecef;
    }

    .table tbody tr:hover {
        background: #f2f6ff;
        transition: 0.2s;
    }

    .table td,
    .table th {
        vertical-align: middle;
        padding: 14px 16px;
        border-color: #e9ecef;
    }

    .badge-status {
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 12px;
    }

    .badge-pass {
        background: #d1e7dd;
        color: #0f5132;
    }

    .badge-fail {
        background: #f8d7da;
        color: #842029;
    }
</style>
@if(count($award) > 0)
<div class="table-wrapper">
    <h5 class="mb-3" style="font-weight:600;">Award Data</h5>

    <table class="table table-borderless align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Organization</th>
                <th>Evaluation Period</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($award as $data)
            <tr>
                <th>{{$loop->index+1}}</th>
                <td>{{$data->title}}</td>
                <td>{{$data->organization}}</td>
                <td>{{$data->evaluation_period}}</td>
                <td>
                    <a class="btn btn-danger btn-sm deleteAward" data-id="{{$data->id}}">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@section('scripts')
<script>
$('.deleteAward').click(function() {
    const Id = $(this).attr('data-id');
    const experienceIdData = { Id };

    // Show confirmation first
    Swal.fire({
        title: 'Are you sure?',
        text: "This award will be deleted permanently!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Send AJAX request after confirmation
            $.ajax({
                url: "{{ route('frontend.award.delete') }}",
                method: 'POST',
                beforeSend: function() {
                    Swal.fire({
                        title: 'Deleting Data...',
                        text: 'Please wait',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: experienceIdData,
                success: function(response) {
                    console.log(response);
                    Swal.close();
                    showAward(); // refresh award data
                    Swal.fire(
                        'Deleted!',
                        'The award has been deleted.',
                        'success'
                    );
                },
                error: function(xhr, status, error) {
                    Swal.close();
                    console.error(error);
                }
            });
        }
    });
});

</script>