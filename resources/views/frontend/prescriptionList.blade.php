@extends('frontend.layout.master')
@section('content')
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
    <div class="contact-area pt-40 pb-80">
        <div class="container">

            <div class="contact-wrapper">
                <div class="row align-items-center">
                    <!-- Right Form -->
                    <div class="col-lg-12">
                        <div class="contact-form">
                            <div class="contact-form-header">
                                <h2>Prescription List</h2>
                            </div>

                            <div class="table-responsive mt-3">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($prescription as $key => $address)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                @if($address->image)
                                                <img src="{{ asset('storage/'.$address->image) }}"
                                                    alt="Prescription"
                                                    width="80"
                                                    height="80"
                                                    style="object-fit: cover; cursor:pointer;"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#imageModal"
                                                    onclick="showImage('{{ asset('storage/'.$address->image) }}')">
                                                @else
                                                No Image
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                No addresses found.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>



                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Upload Prescription End -->

</main>
<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Prescription Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Prescription">
            </div>
        </div>
    </div>
</div>
<script>
    function showImage(imageUrl) {
        document.getElementById('modalImage').src = imageUrl;
    }
</script>

@endsection