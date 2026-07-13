@extends('frontend.layout.master')
@section('content')
<style>
    div#presciption_list {
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
                <h4 class="breadcrumb-title">Prescription</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">Prescription</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!-- Upload Prescription -->
    <div class="contact-area pt-100 pb-80">
        <div class="container">
            <div class="contact-wrapper">
                <div class="row align-items-center">
                    <div id="presciption_list">
                        <a href="{{route('frontend.prescription.list')}}" class="btn btn-danger btn-sm">Prescription List</a>
                    </div>
                    <!-- Left Content -->
                    <div class="col-lg-5">
                        <div class="contact-content">

                            <h2 class="mb-3">Prescription</h2>

                            <p class="mb-4">
                                Upload your prescription and get your medications delivered quickly and safely.
                            </p>

                            <div class="contact-info mb-3">
                                <div class="contact-info-icon">
                                    <i class="far fa-file-upload"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5>Prescription Guide</h5>
                                </div>
                            </div>

                            <ul class="list-unstyled prescription-guide">
                                <li class="mb-3">
                                    <i class="far fa-check-circle text-success me-2"></i>
                                    Upload a clear image of your prescription.
                                </li>

                                <li class="mb-3">
                                    <i class="far fa-check-circle text-success me-2"></i>
                                    Doctor's details must be clearly visible.
                                </li>

                                <li class="mb-3">
                                    <i class="far fa-check-circle text-success me-2"></i>
                                    Prescription date should be visible.
                                </li>

                                <li class="mb-3">
                                    <i class="far fa-check-circle text-success me-2"></i>
                                    Patient name and details should be included.
                                </li>

                                <li class="mb-3">
                                    <i class="far fa-check-circle text-success me-2"></i>
                                    Medicine dosage instructions should be readable.
                                </li>
                            </ul>

                        </div>
                    </div>

                    <!-- Right Form -->
                    <div class="col-lg-7">
                        <div class="contact-form">

                            <div class="contact-form-header">
                                <h2>Upload Prescription</h2>
                                <p>
                                    Fill out the form below and upload your prescription.
                                    Our team will review it and contact you shortly.
                                </p>
                            </div>

                            <form method="post" action="{{route('frontend.prescription.upload')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="mb-2 fw-bold">
                                        Upload Prescription
                                    </label>

                                    <input type="file" class="form-control" required name="image" accept=".jpg,.jpeg,.png,.pdf" required="">
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="hidden" name="address" value="{{$address}}">
                                    <input type="hidden" name="address_type" value="{{$address_type}}">
                                    <input type="hidden" name="address_id" value="{{$address_id}}">
                                    <small class="text-muted">
                                        Accepted formats: JPG, PNG, PDF (Max 5MB)<br>
                                        Note: Always upload a clear version of your Prescription for getting better results
                                    </small>
                                </div>

                                <button type="submit" class="theme-btn">
                                    Upload Prescription
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