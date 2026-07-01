@extends('backend.layout.master')
@section('content')
<style>
    form {
        padding: 10px;
    }
</style>
<section class="content mt-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Product</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/manager')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Create Product</li>
                </ol>
            </div>
        </div>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
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
                        <h3 class="card-title">Create Product</h3>
                    </div>
                    <form method="POST" action="{{ route('manager.product.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <!-- Main Class Dropdown -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Category: <span style="color: red;">*</span></strong>
                                    <select name="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach($classes as $class)
                                        <option value="{{ $class->id }}">
                                            {{ $class->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Sub Class Name -->
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <strong>Name:<span style="color: red;">*</span></strong>
                                    <input type="text" name="name" placeholder="Enter Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <strong>Generic Name:<span style="color: red;">*</span></strong>
                                    <input type="text" name="generic_name" placeholder="Enter Generic Name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <strong>SKU:<span style="color: red;">*</span></strong>
                                    <input type="text" name="sku" placeholder="Enter Sku Number" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <strong>Price:<span style="color: red;">*</span></strong>
                                    <input type="number" name="price" placeholder="Price" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <strong>Company Name:<span style="color: red;">*</span></strong>
                                    <input type="text" name="company_name" placeholder="Company Name" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <strong>Is Stock:<span style="color: red;">*</span></strong>
                                    <input type="checkbox" name="in_stock" checked>
                                </div>
                            </div>


                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <strong>Discount(In Percentage):<span style="color: red;">*</span></strong>
                                    <input type="number" name="discount" class="form-control" value="0">
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <strong>Description:</strong>
                                    <textarea name="product_description" id="product_description" class="form-control"></textarea>
                                </div>
                            </div>



                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <strong>Quantity:<span style="color: red;">*</span></strong>
                                    <input type="number" name="quantity" placeholder="Enter Quantity" class="form-control">
                                </div>
                            </div>

                            <!-- Logo -->
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <strong>Image:</strong>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <strong>Status:<span style="color: red;">*</span></strong>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <strong>Type:<span style="color: red;">*</span></strong>
                                    <select name="type" class="form-control">
                                        @foreach ($type as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <strong>Unit:<span style="color: red;">*</span></strong>
                                    <select name="unit" class="form-control">
                                        <option value="box">Box</option>
                                        <option value="strip">Strip</option>
                                        <option value="bottle">Bottle</option>
                                        <option value="piece">Piece</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="col-md-12 text-center mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-floppy-disk"></i> Submit
                                </button>
                            </div>

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
    @supports (-webkit-appearance: none) or (-moz-appearance: none) {
        .checkbox-wrapper-13 input[type=checkbox] {
            --active: #275EFE;
            --active-inner: #fff;
            --focus: 2px rgba(39, 94, 254, .3);
            --border: #BBC1E1;
            --border-hover: #275EFE;
            --background: #fff;
            --disabled: #F6F8FF;
            --disabled-inner: #E1E6F9;
            -webkit-appearance: none;
            -moz-appearance: none;
            height: 21px;
            outline: none;
            display: inline-block;
            vertical-align: top;
            position: relative;
            margin: 0;
            cursor: pointer;
            border: 1px solid var(--bc, var(--border));
            background: var(--b, var(--background));
            transition: background 0.3s, border-color 0.3s, box-shadow 0.2s;
        }

        .checkbox-wrapper-13 input[type=checkbox]:after {
            content: "";
            display: block;
            left: 0;
            top: 0;
            position: absolute;
            transition: transform var(--d-t, 0.3s) var(--d-t-e, ease), opacity var(--d-o, 0.2s);
        }

        .checkbox-wrapper-13 input[type=checkbox]:checked {
            --b: var(--active);
            --bc: var(--active);
            --d-o: .3s;
            --d-t: .6s;
            --d-t-e: cubic-bezier(.2, .85, .32, 1.2);
        }

        .checkbox-wrapper-13 input[type=checkbox]:disabled {
            --b: var(--disabled);
            cursor: not-allowed;
            opacity: 0.9;
        }

        .checkbox-wrapper-13 input[type=checkbox]:disabled:checked {
            --b: var(--disabled-inner);
            --bc: var(--border);
        }

        .checkbox-wrapper-13 input[type=checkbox]:disabled+label {
            cursor: not-allowed;
        }

        .checkbox-wrapper-13 input[type=checkbox]:hover:not(:checked):not(:disabled) {
            --bc: var(--border-hover);
        }

        .checkbox-wrapper-13 input[type=checkbox]:focus {
            box-shadow: 0 0 0 var(--focus);
        }

        .checkbox-wrapper-13 input[type=checkbox]:not(.switch) {
            width: 21px;
        }

        .checkbox-wrapper-13 input[type=checkbox]:not(.switch):after {
            opacity: var(--o, 0);
        }

        .checkbox-wrapper-13 input[type=checkbox]:not(.switch):checked {
            --o: 1;
        }

        .checkbox-wrapper-13 input[type=checkbox]+label {
            display: inline-block;
            vertical-align: middle;
            cursor: pointer;
            margin-left: 4px;
        }

        .checkbox-wrapper-13 input[type=checkbox]:not(.switch) {
            border-radius: 7px;
        }

        .checkbox-wrapper-13 input[type=checkbox]:not(.switch):after {
            width: 5px;
            height: 9px;
            border: 2px solid var(--active-inner);
            border-top: 0;
            border-left: 0;
            left: 7px;
            top: 4px;
            transform: rotate(var(--r, 20deg));
        }

        .checkbox-wrapper-13 input[type=checkbox]:not(.switch):checked {
            --r: 43deg;
        }
    }

    .checkbox-wrapper-13 * {
        box-sizing: inherit;
    }

    .checkbox-wrapper-13 *:before,
    .checkbox-wrapper-13 *:after {
        box-sizing: inherit;
    }
</style>
@endpush

@push('specific_js')
@endpush