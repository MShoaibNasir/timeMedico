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
                @include('components\userDashboardSidebar',['active'=>'dashboard'])
                <div class="col-lg-9">
                    <div class="user-wrapper">
                        <div class="user-card">
                            <h4 class="user-card-title">Summary</h4>
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="dashboard-widget color-1">
                                        <div class="dashboard-widget-info">
                                            <h1>{{$pending_orders}}</h1>
                                            <span>Pending Orders</span>
                                        </div>
                                        <div class="dashboard-widget-icon">
                                            <i class="fal fa-list"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="dashboard-widget color-2">
                                        <div class="dashboard-widget-info">
                                            <h1>{{$completed_orders}}</h1>
                                            <span>Completed Orders</span>
                                        </div>
                                        <div class="dashboard-widget-icon">
                                            <i class="fal fa-layer-group"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="dashboard-widget color-3">
                                        <div class="dashboard-widget-info">
                                            <h1>{{$return_orders}}</h1>
                                            <span>Return Orders</span>
                                        </div>
                                        <div class="dashboard-widget-icon">
                                            <i class="fal fa-wallet"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="user-card">
                                    <div class="user-card-header">
                                        <h4 class="user-card-title">Recent Orders</h4>
                                        <div class="user-card-header-right">
                                            <a href="{{route('frontend.dashboard.orderlist')}}" class="theme-btn">View All Orders</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-borderless text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#Order No</th>
                                                    <th>Purchased Date</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $item)
                                                <tr>
                                                    <td>
                                                        <span class="table-list-code">{{ $item->order_no }}</span>
                                                    </td>
                                                    <td>
                                                        {{ $item->created_at->format('F d, Y h:i A') }}
                                                    </td>
                                                    <td>
                                                        Rs {{ number_format($item->total_amount) }}
                                                    </td>
                                                    <td>
                                                        <span class="badge
            @if($item->status == 'Pending')
                bg-warning
            @elseif($item->status == 'Processing')
                bg-primary
            @elseif($item->status == 'On The way')
                bg-info
            @elseif($item->status == 'Delivered')
                bg-success
            @elseif($item->status == 'Rejected')
                bg-danger
            @elseif($item->status == 'Returned')
                bg-secondary
            @endif">
                                                            {{ $item->status }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('frontend.dashboard.orderDetail', encrypt($item->id)) }}" class="btn btn-outline-secondary btn-sm rounded-2">
                                                            <i class="far fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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