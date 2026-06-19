resources/views/categories/edit.blade.php
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Category</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems with your input:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ '{{ $error }}' }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ '{{ route("categories.update", $category) }}' }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name">Category Name:</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ '{{ old("name", $category->name) }}' }}">
        </div>

        <div class="form-group mb-3">
            <label for="products">Assign Products:</label>
            <select name="products[]" id="products" class="form-control" multiple>
                @foreach($products as $product)
                    <option value="{{ '{{ $product->id }}' }}" 
                        {{ '{{ in_array($product->id, $selectedProducts) ? "selected" : "" }}' }}>
                        {{ '{{ $product->name }}' }} (by {{ '{{ $product->user->name ?? "N/A" }}' }})
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="{{ '{{ route("categories.index") }}' }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection




      