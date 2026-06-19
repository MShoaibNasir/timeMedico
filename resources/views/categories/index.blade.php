@extends('backend.layout.master')

@section('content')
<div class="container">
    <h2 class="mb-4">All Categories</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('manager.categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    @if($categories->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Created By</th>
                    <th>Products</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->user->name ?? 'N/A' }}</td>
                    <td>
                        @if($category->products->count())
                            <ul>
                                @foreach($category->products as $product)
                                    <li>{{ $product->name }} (by {{ $product->user->name ?? 'N/A' }})</li>
                                @endforeach
                            </ul>
                        @else
                            <em>No products</em>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('manager.categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('manager.categories.destroy', $category) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('manager.categories.show', $category) }}" class="btn btn-sm btn-info">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No categories found.</p>
    @endif
</div>
@endsection
