<style>
    .selectAllCheckbox {
        display: flex;
        gap: 7px;
    }

    label {
        margin: 0;
    }
</style>
{{--
<div class="col-md-12 my-3 text-end">
    {!! Form::open(array('route' => 'export_vrc_event_list','method'=>'POST')) !!}
    {!! Form::hidden('environment_data', $jsondata) !!}
    {!! Form::submit('Export VRC Events', array('name' => 'export', 'class' => 'btn btn-danger')); !!}
    {!! Form::close() !!}
</div>  --}}
<h4>Send Email</h4>
<form id="bulkEmailForm" action="{{ route('manager.email.send.bulk') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="email_subject" class="form-label">Email Subject</label>
        <input type="text" class="form-control" id="email_subject" name="subject" required>
    </div>

    <div class="mb-3">
        <label for="email_body" class="form-label">Email Message</label>
        <textarea class="form-control" id="email_body" name="body" rows="5"></textarea>
    </div>

    <button type="submit" class="btn btn-primary my-4" id="sendBtn" disabled>
        <i class="fas fa-paper-plane"></i> Send Email
    </button>
    </div>
    <div class="row my-4">
        <div class="col-3 selectAllCheckbox">
            <label for="">Check All</label>
            <input type="checkbox" id='selectAll'>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th scope="col">S No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone No</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Cnic/Passport No</th>

                        </tr>
                    </thead>

                    <tbody>

                        @foreach($data as $item)
                        <tr>
                            <td>
                                <input type="checkbox" name="user_ids[]"
                                    value="{{ $item->id }}" class="rowChk">
                            </td>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone_number}}</td>
                            <td>{{$item->gender}}</td>
                            <td>{{$item->cnic_or_passport}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
</form>

<div class="col-md-12 my-3">{{ $data->links("pagination::bootstrap-4") }}</div>
<div class="col-md-12">Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of total {{$data->total()}} entries</div>
<script>
    $(function() {
        const $selectAll = $('#selectAll');
        const $rowChk = $('.rowChk');
        const $sendBtn = $('#sendBtn');

        // toggle all
        $selectAll.on('change', () => $rowChk.prop('checked', $selectAll.prop('checked')).trigger('change'));

        // enable/disable button
        $rowChk.on('change', () => {
            $sendBtn.prop('disabled', !$('.rowChk:checked').length && !$selectAll.prop('checked'));
        });

        // confirmation
        $('#bulkEmailForm').on('submit', function() {
            return confirm('Send email to selected users?');
        });
    });
</script>
</div>