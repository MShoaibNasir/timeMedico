    <!-- product list -->
    <div class="product-list py-100">
        <div class="container wow fadeInUp" data-wow-delay=".25s">
            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="product-list-box border">
                        <h2 class="product-list-title">On sale</h2>
                        @foreach ($on_sale_items as $item)
                        <x-frontend.products.itemlist :item="$item" />
                        @endforeach


                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="product-list-box border">
                        <h2 class="product-list-title">Best Seller</h2>
                        @foreach ($best_seller_items as $item)
                          <x-frontend.products.itemlist :item="$item" />
                        @endforeach

                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="product-list-box border">
                        <h2 class="product-list-title">Top Rated</h2>
                        @foreach ($top_rated as $item)
                       <x-frontend.products.itemlist :item="$item" />
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product list end -->