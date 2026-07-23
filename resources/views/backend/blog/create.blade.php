@extends('backend.layout.master')

@section('content')

<section class="content mt-3">
    <div class="container-fluid">


    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Create Blog</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ url('/manager') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Create Blog</li>
            </ol>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul class="mb-0 mt-2">
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
                    <h3 class="card-title">
                        <i class="fas fa-blog mr-1"></i> Create Blog
                    </h3>
                </div>

                <form action="{{ route('manager.blog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label><strong>Blog Name</strong></label>
                            <input type="text"
                                name="name"
                                class="form-control"
                                placeholder="Enter Blog Name"
                                value="{{ old('name') }}"
                                required>
                        </div>

                        <div class="form-group mb-3">
                            <label><strong>Blog Image</strong></label>
                            <input type="file" name="image" class="form-control">
                            <small class="text-muted">
                                Allowed: JPG, JPEG, PNG, SVG (Max: 2MB)
                            </small>
                        </div>

                        <div class="form-group mb-3">
                            <label><strong>Description</strong></label>
                            <textarea name="description"
                                rows="6"
                                class="form-control"
                                placeholder="Enter Blog Description"
                                required>{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label><strong>Status</strong></label>
                            <select name="status" class="form-control" required>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-dark">
                            <i class="fas fa-save mr-1"></i> Submit
                        </button>

                        <a href="{{ route('manager.blog.list') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>

</div>

</section>
@endsection
