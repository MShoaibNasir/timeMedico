@extends('frontend.layout.master')
@section('content')
<style>
    div#address_list {
        width: 100%;
        display: flex;
        justify-content: end;
    }
</style>
<main class="main">

    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url('{{ asset('frontend/images/about-01.jpg') }}');""></div>
        <div class=" container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">Address</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">Address</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!-- Upload Prescription -->
    <div class="contact-area pt-40 pb-80">
        <div class="container">

            <div class="contact-wrapper">
                <div class="row align-items-center">
                    <!-- Right Form -->

                    <div class="col-lg-12">
                        <div class="contact-form">
                            <div id="address_list">
                                <a href="{{route('frontend.customer.address.list')}}" class="btn btn-danger btn-sm">Address List</a>
                            </div>
                            <div class="contact-form-header">
                                <h2>Upload Address</h2>

                            </div>

                            <form method="post" action="{{route('frontend.customer.address.upload')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="mb-2 fw-bold">
                                        Address Type
                                    </label>
                                    <select name="address_type" id="address_type" class="form-control" require>
                                        <option value="">Select Address Type</option>
                                        <option value="Home">Home</option>
                                        <option value="Office">Office</option>
                                        <option value="Business">Business</option>
                                        <option value="Billing">Billing</option>
                                        <option value="Shipping">Shipping</option>
                                        <option value="Permanent">Permanent</option>
                                        <option value="Current">Current</option>
                                        <option value="Temporary">Temporary</option>
                                        <option value="Work">Work</option>
                                        <option value="Warehouse">Warehouse</option>
                                        <option value="Branch">Branch Office</option>
                                        <option value="HeadOffice">Head Office</option>
                                        <option value="Store">Store</option>
                                        <option value="Factory">Factory</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    @error('address_type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="mb-2 fw-bold">
                                        Address
                                    </label>
                                    <textarea name="address" class="form-control" id="address" require></textarea>
                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="theme-btn">
                                    Upload Address
                                    <i class="far fa-upload"></i>
                                </button>

                                <div class="col-md-12 my-3">
                                    <div class="form-messege text-success"></div>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Upload Prescription End -->

</main>


@endsection