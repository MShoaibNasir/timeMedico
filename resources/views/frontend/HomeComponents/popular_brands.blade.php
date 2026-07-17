<!-- brand area -->
<div class="brand-area pt-80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="site-heading-inline">
                    <h2 class="site-title">Popular Brands</h2>
                </div>
            </div>
        </div>

        @if(isset($brands) && $brands->count() > 0)
        <div class="brand-slider owl-carousel owl-theme">

            @foreach($brands as $brand)
            <div class="brand-item">
                <a href="{{route('frontend.brand.show',[$brand->id])}}">
                    <img
                        src="{{ asset($brand->image) }}"
                        alt="{{ $brand->name }}"
                        class="img-fluid">
                </a>
            </div>
            @endforeach

        </div>
        @else
        <div class="row">
            <div class="col-12 text-center">
                <p>No brands found.</p>
            </div>
        </div>
        @endif

    </div>
</div>
<!-- brand area end -->