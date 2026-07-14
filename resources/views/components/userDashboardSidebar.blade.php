@php
$authentication=Auth::guard('web')->check();
if($authentication){
$user=Auth::guard('web')->user();
}
@endphp

<div class="col-lg-3">
    <div class="sidebar">
        <div class="sidebar-top">
            <div class="sidebar-profile-img">
                @if($authentication && !empty($user->image))
                <img src="{{ asset('storage/'.$user->image) }}"
                    alt="Profile"
                    width="100"
                    class="img-thumbnail">
                @else
                <img src="{{ asset('frontend/images/3.jpg') }}" alt="image">
                @endif
            </div>
            @if($authentication)
            <h5>{{ $user->name }}</h5>
            <p>{{ $user->email }}</p>
            @else
            <h5>Full Name</h5>
            <p>email@gmail.com</p>
            @endif

        </div>

        <ul class="sidebar-list">
            <li><a class="{{ $active=='dashboard' ? 'active' : '' }}" href="{{route('frontend.dashboard.show')}}"><i class="far fa-gauge-high"></i> Dashboard</a></li>
            <li><a class="{{ $active=='profile' ? 'active' : '' }}" href="{{route('frontend.dashboard.profile')}}"><i class="far fa-user"></i> My Profile</a></li>
            <li><a class="{{ $active=='orderlist' ? 'active' : '' }}" href="{{route('frontend.dashboard.orderlist')}}"><i class="far fa-shopping-bag"></i> My Order List <span class="badge badge-danger">02</span></a></li>
            <li><a class="{{ $active=='wishlist' ? 'active' : '' }}" href="{{route('frontend.wishlist.WishList')}}"><i class="far fa-heart"></i> My Wishlist <span class="badge badge-danger">02</span></a></li>
            <li><a class="{{ $active=='trackmyorder' ? 'active' : '' }}" href="{{route('frontend.dashboard.trackingOrder')}}"><i class="far fa-map-location-dot"></i> Track My Order</a></li>
            <li><a href="{{route('frontend.logout')}}"><i class="far fa-sign-out"></i> Logout</a></li>
        </ul>
    </div>
</div>