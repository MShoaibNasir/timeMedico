@extends('backend.layout.master')

@section('content')

<section class="content mt-3">
    <div class="container-fluid">

```
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Brand</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ url('/manager') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Edit Brand</li>
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
                    <h3 class="card-title">Edit Brand</h3>
                </div>

                <form action="{{ route('manager.brand.update', $brand->id) }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group mb-3">
                            <strong>Blog Name:</strong>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name', $brand->name) }}"
                                   placeholder="Enter Blog Name">
                        </div>

                        <div class="form-group mb-3">
                            <strong>Current Image:</strong><br>

                            @if($brand->image)
                                <img src="{{ asset($brand->image) }}"
                                     width="120"
                                     class="img-thumbnail mb-2">
                            @else
                                <span class="text-muted">No image uploaded.</span>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <strong>Change Image:</strong>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <strong>Description:</strong>
                            <textarea name="description"
                                      rows="6"
                                      class="form-control"
                                      placeholder="Enter Blog Description">{{ old('description', $brand->description) }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <strong>Status:</strong>
                            <select name="status" class="form-control">
                                <option value="1" {{ $brand->status == 1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0" {{ $brand->status == 0 ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-dark">
                            Update
                        </button>

                        <a href="{{ route('manager.blog.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>

</div>
```

</section>
@endsection
