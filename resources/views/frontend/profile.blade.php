@extends('frontend.layout.master')
@section('content')
<main class="main">
    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background-image: url('{{ asset('frontend/images/about-01.jpg') }}');"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">My Wishlist</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">My Wishlist</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!-- user dashboard -->
    <div class="user-area bg pt-100 pb-80">
        <div class="container">
            <div class="row">
                @include('components\userDashboardSidebar',['active'=>'profile'])
                <div class="col-lg-9">
                    <div class="user-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="user-card">
                                    <h4 class="user-card-title">Profile Info</h4>
                                    <div class="user-form">
                                        <form action="{{route('frontend.dashboard.updateProfile')}}" method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text"
                                                            name="name"
                                                            class="form-control"
                                                            value="{{ old('name', $user->name) }}"
                                                            placeholder="Name">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}" placeholder="Phone">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Profile Image:</label>
                                                        <br>
                                                        @if($user->image)
                                                        <img src="{{ asset('storage/'.$user->image) }}"
                                                            alt="Profile"
                                                            width="100"
                                                            class="img-thumbnail">
                                                        @endif

                                                        <input type="file" name="image" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="submit" class="theme-btn">
                                                        <span class="far fa-user"></span> Save Changes
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- user dashboard end -->

</main>





@endsection