    <!-- product list -->
    <div class="product-list py-100">
        <div class="container wow fadeInUp" data-wow-delay=".25s">
            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="product-list-box border">
                        <h2 class="product-list-title">On sale</h2>
                        @foreach ($on_sale_items as $item)
                        <div class="product-list-item">
                            <div class="product-list-img">
                                <a href="shop-single"><img src="{{ asset('storage/'.$item->image) }}" alt="#"></a>
                            </div>
                            <div class="product-list-content">
                                <h4><a href="shop-single">{{$item->name}}</a></h4>
                                <div class="product-list-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <div class="product-list-price">
                                    <span>RsRs {{number_format($item->price,2)}}</span>
                                </div>
                            </div>
                            <a href="#" class="product-list-btn" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart"><i class="far fa-shopping-bag"></i></a>
                        </div>
                        @endforeach


                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="product-list-box border">
                        <h2 class="product-list-title">Best Seller</h2>
                        @foreach ($best_seller_items as $item)
                          <div class="product-list-item">
                            <div class="product-list-img">
                                <a href="shop-single"><img src="{{ asset('storage/'.$item->image) }}" alt="#"></a>
                            </div>
                            <div class="product-list-content">
                                <h4><a href="shop-single">{{$item->name}}</a></h4>
                                <div class="product-list-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <div class="product-list-price">
                                    <span>RsRs {{number_format($item->price,2)}}</span>
                                </div>
                            </div>
                            <a href="#" class="product-list-btn" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart"><i class="far fa-shopping-bag"></i></a>
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="product-list-box border">
                        <h2 class="product-list-title">Top Rated</h2>
                        @foreach ($top_rated as $item)
                       <div class="product-list-item">
                            <div class="product-list-img">
                                <a href="shop-single"><img src="{{ asset('storage/'.$item->image) }}" alt="#"></a>
                            </div>
                            <div class="product-list-content">
                                <h4><a href="shop-single">{{$item->name}}</a></h4>
                                <div class="product-list-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <div class="product-list-price">
                                    <span>RsRs {{number_format($item->price,2)}}</span>
                                </div>
                            </div>
                            <a href="#" class="product-list-btn" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart"><i class="far fa-shopping-bag"></i></a>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product list end -->