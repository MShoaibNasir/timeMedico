<style>
    .selectAllCheckbox {
        display: flex;
        gap: 7px;
    }

    label {
        margin: 0;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order No</th>
                        <th>Customer Name</th>
                        <th>Phone</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        @can('order-show')
                        <th>Action</th>
                        @endcan

                    </tr>
                </thead>

                <tbody>

                    @foreach ($data as $key=>$item)


                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $item->order_no }}</td>
                        <td>{{ $item->customer_name }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ number_format($item->total_amount,2) }}</td>
                        <td>
                            @if($item->status == 'Pending')
                            <span class="badge bg-warning text-dark px-3 py-2">
                                <i class="fa fa-clock me-1"></i> Pending
                            </span>

                            @elseif($item->status == 'Processing')
                            <span class="badge bg-info  px-3 py-2">
                                <i class="fa fa-spinner me-1"></i> Processing
                            </span>

                            @elseif($item->status == 'Delivered')
                            <span class="badge bg-success px-3 py-2">
                                <i class="fa fa-check-circle me-1"></i> Delivered
                            </span>

                            @elseif($item->status == 'Cancelled')
                            <span class="badge bg-danger px-3 py-2">
                                <i class="fa fa-times-circle me-1"></i> Cancelled
                            </span>

                            @elseif($item->status == 'Returned')
                            <span class="badge bg-secondary px-3 py-2">
                                <i class="fa fa-undo me-1"></i> Returned
                            </span>

                            @else
                            <span class="badge bg-dark px-3 py-2">
                                {{ $item->status }}
                            </span>
                            @endif
                        </td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        @can('order-show')
                        <td>
                            <a href="{{ route('manager.order.view', [encrypt($item->id)]) }}"
                                class="btn btn-sm btn-primary"
                                title="View Order">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                        @endcan

                    </tr>
                    @endforeach




                </tbody>
            </table>
        </div>
    </div>


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

        function deleteFunction(key) {

            let form = document.getElementById('deleteForm' + key);

            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

        }
    </script>
</div>