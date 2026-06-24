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
                        <th>No</th>
                        <th>Category Name</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>SKU</th>
                        <th>Price</th>
                        {{--<th>Disc In %</th>--}}
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>

                <tbody>

                    @foreach ($data as $key=>$item)

                    <tr>

                        <td class="align-middle">
                            {{ $loop->iteration }}
                        </td>

                        <td class="align-middle">
                            {{ $item->category->name ?? 'N/A' }}
                        </td>

                        <td class="align-middle">
                            {{ $item->name }}
                        </td>

                        <td class="align-middle">
                            @if($item->image)
                            <img src="{{ asset('storage/'.$item->image) }}"
                                width="60"
                                height="60"
                                style="object-fit: cover; border-radius: 8px; border:1px solid #ddd; padding:2px;">
                            @else
                            <div style="
            width:60px;
            height:60px;
            background:#f1f1f1;
            border:1px dashed #ccc;
            border-radius:8px;
            display:flex;
            align-items:center;
            justify-content:center;
            margin:auto;
            color:#888;
            font-size:11px;
            font-weight:600;
        ">
                                No Logo
                            </div>
                            @endif
                        </td>
                        <td class="align-middle">
                            {{ $item->sku }}
                        </td>
                        <td class="align-middle">
                            {{ $item->price }}
                        </td>


                        <td class="align-middle">
                            <span class="badge {{ $item->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <td class="align-middle">
                            @can('product-edit')
                            <a class="btn btn-primary btn-sm"
                                href="{{ route('manager.product.edit', $item->id) }}">
                                Edit
                            </a>
                            @endcan

                            @can('product-delete')
                            <form method="POST"
                                action="{{ route('manager.product.destroy', $item->id) }}"
                                style="display:inline"
                                class="delete-form"
                                id="deleteForm{{ $key }}">
                                @csrf
                                @method('DELETE')

                                <button type="button"
                                    class="btn btn-danger btn-sm"
                                    onclick="deleteFunction({{ $key }})">
                                    Delete
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