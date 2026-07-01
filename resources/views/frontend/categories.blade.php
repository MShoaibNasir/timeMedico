@extends('frontend.layout.master')
@section('content')
<main class="main">
    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background-image: url('{{ asset('frontend/images/about-01.jpg') }}');"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">Category</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">Category</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!-- category area -->
    <div class="category-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">Our Category</span>
                        <h2 class="site-title">Our Popular <span>Category</span></h2>
                    </div>
                </div>
            </div>

            <div class="row g-3 categories_row">
                @forelse($categories as $data)
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="category-item">
                        <a href="{{ route('frontend.productFilter', [Crypt::encryptString($data->id)]) }}">
                            <div class="category-info">
                                <div class="icon">
                                    <img src="{{ asset('storage/'.$data->image) }}" alt="{{ $data->name }}">
                                </div>
                                <div class="content">
                                    <h4>{{ $data->name }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info text-center py-4">
                        <h5 class="mb-2">📂 No Categories Available</h5>
                        <p class="mb-0">
                            We couldn't find any categories at the moment. Please visit again later.
                        </p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- category area end-->

</main>
@endsection