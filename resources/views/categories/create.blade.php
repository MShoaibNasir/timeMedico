@extends('backend.layout.master')
@section('content')

<div class="container">
    <h2 class="mb-4">Add New Category</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>There were some problems with your input:</strong>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <form action="{{route('manager.categories.store')}}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="name">Category Name:</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{old('name')}}">
        </div>

        <div class="form-group mb-3">
            <label for="products">Assign Products:</label>
            <select name="products[]" id="products" class="form-control" multiple>
                
                @foreach($products as $item)
                <option value="{{ $item->id  }}">
                    {{ $item->name  }} (by {{ $item->user->name ?? "N/A"  }})
                </option>
                @endforeach
               
            </select>
            <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple.</small>
        </div>

        <button type="submit" class="btn btn-success">Create Category</button>
        <a href="{{route('manager.categories.index')}}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection