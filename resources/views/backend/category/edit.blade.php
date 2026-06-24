@extends('backend.layout.master')

@section('content')
<section class="content mt-3">
    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/manager') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Category</li>
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
                        <h3 class="card-title">Edit Category</h3>
                    </div>

                    <form action="{{ route('manager.category.update', $category->id) }}"
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
                                       value="{{ old('name', $category->name) }}">
                            </div>

                            <div class="form-group mb-3">
                                <strong>Department:</strong>
                                <select name="department_id" class="form-control">
                                    <option value="">Select Option</option>

                                    @foreach ($departments as $data)
                                        <option value="{{ $data->id }}"
                                            {{ $category->department_id == $data->id ? 'selected' : '' }}>
                                            {{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <strong>Current Image:</strong><br>

                                @if($category->image)
                                    <img src="{{ asset($category->image) }}"
                                         width="120"
                                         class="img-thumbnail mb-2">
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <strong>Change Image:</strong>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <strong>Status:</strong>
                                <select name="status" class="form-control">
                                    <option value="1"
                                        {{ $category->status == 1 ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="0"
                                        {{ $category->status == 0 ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-dark">
                                Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</section>
@endsection