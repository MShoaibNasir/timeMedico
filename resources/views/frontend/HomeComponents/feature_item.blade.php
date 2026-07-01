
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
                    <div class="product-item">
                        <div class="product-img">
                            <a href="shop-single"><img src="{{ asset('storage/'.$item->image) }}" alt="image"></a>
                            <div class="product-action-wrap">
                                <div class="product-action">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quickview" data-tooltip="tooltip" title="Quick View"><i class="far fa-eye"></i></a>
                                    <a href="wishlist" data-tooltip="tooltip" title="Add To Wishlist"><i class="far fa-heart"></i></a>

                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3 class="product-title"><a href="shop-single">{{$item->name}}</a></h3>
                            <div class="product-rate">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <div class="product-bottom">
                                <div class="product-price">
                                    <span>Rs {{number_format($item->price,2)}}</span>
                                </div>
                                <button type="button" class="product-cart-btn" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart">
                                    <i class="far fa-shopping-bag"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
    <!-- featured item end -->