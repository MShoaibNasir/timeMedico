@extends('backend.layout.master')

@section('content')
<section class="content mt-3">
    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Area</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/manager') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Area</li>
                </ol>
            </div>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card card-dark">

                    <div class="card-header">
                        <h3 class="card-title">Edit Area</h3>
                    </div>

                    <form action="{{ route('manager.area.update', $area->id) }}"
                        method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            <div class="form-group mb-3">
                                <strong>Name:</strong>
                                <input type="text"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name', $area->name) }}">
                            </div>

                            <div class="form-group mb-3">
                                <strong>Delivery Charges:</strong>
                                <input type="number" step="0.01" min="0" name="delivery_charges"
                                    placeholder="Enter Delivery Charges"
                                    value="{{ old('delivery_charges', $area->delivery_charges) }}"
                                    class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <strong>Delivery Coverage:</strong>
                                <select name="is_service_able" class="form-control" required>
                                    <option value="1" @selected(old('is_service_able', $area->is_service_able ? '1' : '0') == '1')>
                                        Serviceable (Local delivery)
                                    </option>
                                    <option value="0" @selected(old('is_service_able', $area->is_service_able ? '1' : '0') == '0')>
                                        Non-serviceable (Courier only)
                                    </option>
                                </select>
                                <small class="text-muted">Mark areas like Bahria Town / Baldia Town as non-serviceable for courier delivery.</small>
                            </div>

                            <div class="form-group mb-3">
                                <strong>Status:</strong>
                                <select name="status" class="form-control">
                                    <option value="1" {{ (int) $area->status === 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ (int) $area->status === 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-dark">Update</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
