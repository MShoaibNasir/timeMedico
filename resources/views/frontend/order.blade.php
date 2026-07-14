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
                @include('components\userDashboardSidebar',['active'=>'orderlist'])
                <div class="col-lg-9">
                    <div class="user-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="user-card">
                                    <div class="user-card-header">
                                        <h4 class="user-card-title">My Orders List</h4>
                                        <div class="user-card-header-right">
                                            <div class="user-card-filter">
                                                <select class="select" style="display: none;">
                                                    <option value="">Default</option>
                                                    <option value="1">Pending</option>
                                                    <option value="2">Processing</option>
                                                    <option value="3">Cancelled</option>
                                                    <option value="4">Completed</option>
                                                </select>
                                                <div class="nice-select select" tabindex="0"><span class="current">Default</span>
                                                    <ul class="list">
                                                        <li data-value="" class="option selected">Default</li>
                                                        <li data-value="1" class="option">Pending</li>
                                                        <li data-value="2" class="option">Processing</li>
                                                        <li data-value="3" class="option">Cancelled</li>
                                                        <li data-value="4" class="option">Completed</li>
                                                    </ul>
                                                </div>
                                            </div>
                                         
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
                                                        <a href="{{ route('frontend.dashboard.orderDetail', encrypt($item->id)) }}"
                                                            class="btn btn-outline-secondary btn-sm rounded-2">
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