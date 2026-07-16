<!-- featured item -->
<div class="product-area pt-80">
    <div class="container">
        <div class="row">
            <div class="col-12 wow fadeInDown" data-wow-delay=".25s">
                <div class="site-heading-inline">
                    <h2 class="site-title">Featured Items</h2>
                  {{-- <a href="{{ url('shop') }}">View More <i class="fas fa-angle-double-right"></i></a> --}}
                </div>
            </div>
        </div>
        

        @if($featured_items->count() > 0)
            <div class="product-wrap item-2 wow fadeInUp" data-wow-delay=".25s">
                <div class="product-slider owl-carousel owl-theme">
                    @foreach ($featured_items as $item)
                        @include('frontend.Components.product',['item'=>$item])
                    @endforeach
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="text-center py-5 bg-light rounded shadow-sm">
                        <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                        <h4 class="mb-2">No Featured Products Available</h4>
                        <p class="text-muted mb-0">
                            Featured products will appear here once they are available. Please check back later.
                        </p>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
<!-- featured item end -->