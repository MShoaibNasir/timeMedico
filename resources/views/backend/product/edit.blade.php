@extends('backend.layout.master')

@section('content')
<section class="content mt-3">
    <div class="container-fluid">

        <!-- Header -->
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Product</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/manager') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Product</li>
                </ol>
            </div>
        </div>

        <!-- Errors -->
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Form Card -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-dark">

                    <div class="card-header">
                        <h3 class="card-title">Edit Product</h3>
                    </div>

                    <form action="{{ route('manager.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row">


                                <!-- Name -->
                                <div class="col-md-6 mt-2">
                                    <div class="form-group mb-3">
                                        <strong>Category:</strong>
                                        <select name="category_id" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach($category as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <strong>Name:<span style="color: red;">*</span></strong>
                                        <input type="text" name="name" value="{{$product->name}}" placeholder="Enter Name" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <strong>Generic Name:<span style="color: red;">*</span></strong>
                                        <input type="text" name="generic_name" value="{{$product->generic_name}}" placeholder="Enter Generic Name" class="form-control">
                                    </div>
                                </div>
                                <!-- SKU -->
                                <div class="col-md-6 mt-2">
                                    <div class="form-group mb-3">
                                        <strong>SKU:</strong>
                                        <input type="text"
                                            name="sku"
                                            class="form-control"
                                            value="{{ $product->sku }}"
                                            placeholder="Enter SKU">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <strong>Company Name:<span style="color: red;">*</span></strong>
                                        <input type="text" name="company_name" value="{{$product->company_name}}" placeholder="Company Name" class="form-control">
                                    </div>
                                </div>
                                <!-- Price -->
                                <div class="col-md-6 mt-2">
                                    <div class="form-group mb-3">
                                        <strong>Price:<span style="color:red;">*</span></strong>
                                        <input type="number"
                                            name="price"
                                            class="form-control"
                                            value="{{ $product->price }}"
                                            placeholder="Enter  Price">
                                    </div>
                                </div>


                                <!-- Current Image -->
                                <div class="col-md-6 mt-2">
                                    <div class="form-group mb-3">
                                        <strong>Current Image:</strong><br>

                                        @if($product->image)
                                        <img src="{{ asset('storage/'.$product->image) }}"
                                            width="80"
                                            height="80"
                                            style="object-fit: cover; border-radius: 8px; border:1px solid #ddd;">
                                        @else
                                        <div style="width:80px;height:80px;
                                                        display:flex;align-items:center;
                                                        justify-content:center;
                                                        border:1px dashed #ccc;
                                                        border-radius:8px;
                                                        color:#888;font-size:12px;
                                                        background:#f5f5f5;">
                                            No Image
                                        </div>
                                        @endif

                                    </div>
                                </div>
                                <!-- Image -->
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <strong>Change Image:</strong>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>



                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <strong>Is Stock:<span style="color: red;">*</span></strong>
                                        <input type="checkbox" name="in_stock" {{ $product->in_stock==1 ? 'checked' : '' }}>
                                    </div>
                                </div>


                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <strong>Discount(In Percentage):<span style="color: red;">*</span></strong>
                                        <input type="number" name="discount" class="form-control" value="{{ $product->discount }}">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <strong>Description:</strong>
                                        <textarea name="product_description" id="product_description" class="form-control">{{ $product->product_description }}</textarea>
                                    </div>
                                </div>




                                <!-- Quantity -->
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <strong>Quantity:<span style="color:red;">*</span></strong>
                                        <input type="number"
                                            name="quantity"
                                            class="form-control"
                                            value="{{$product->quantity}}"
                                            placeholder="Enter Quantity">
                                    </div>
                                </div>




                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <strong>Type:<span style="color: red;">*</span></strong>
                                        <select name="type" class="form-control">
                                            <option value="">Select Type</option>
                                            @foreach ($type as $data)
                                            <option value="{{ $data->id }}"
                                                {{ $data->id == $product->type ? 'selected' : '' }}>
                                                {{ $data->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <strong>Status:<span style="color:red;">*</span></strong>
                                        <select name="status" class="form-control">
                                            <option value="1" {{$product->status==1 ? 'selected' : ''}}>Active</option>
                                            <option value="0" {{$product->status==0 ? 'selected' : ''}}>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-dark">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@push('specific_css')
<style>
    /* (your checkbox CSS kept unchanged for reuse) */
    .checkbox-wrapper-13 input[type=checkbox] {
        --active: #275EFE;
        --active-inner: #fff;
        --focus: 2px rgba(39, 94, 254, .3);
        --border: #BBC1E1;
        --border-hover: #275EFE;
        --background: #fff;
        --disabled: #F6F8FF;
        --disabled-inner: #E1E6F9;
    }
</style>
@endpush

@push('specific_js')
@endpush