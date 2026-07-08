<!-- featured item -->
<div class="product-area pt-80">
    <div class="container">
        <div class="row">
            <div class="col-12 wow fadeInDown" data-wow-delay=".25s">
                <div class="site-heading-inline">
                    <h2 class="site-title">Featured Items</h2>
                    <a href="shop">View More <i class="fas fa-angle-double-right"></i></a>
                </div>
            </div>
        </div>
        <div class="product-wrap item-2 wow fadeInUp" data-wow-delay=".25s">
            <div class="product-slider owl-carousel owl-theme">
                @foreach ($featured_items as $item)
                @include('frontend.Components.product',['item'=>$item])
                @endforeach


            </div>
        </div>
    </div>
</div>
<!-- featured item end -->