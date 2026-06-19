@extends('backend.layout.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Product</h2>

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

    <form action="{{ route('manager.products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name">Product Name:</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $product->name) }}">
        </div>

        <div class="form-group mb-3">
            <label for="categories">Assign Categories:</label>
            <select name="categories[]" id="categories" class="form-control" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
        <a href="{{ route('manager.products.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
