<!-- product list -->
<div class="product-list py-100">
    <div class="container wow fadeInUp" data-wow-delay=".25s">
        <div class="row g-4">

            <!-- On Sale -->
            <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                <div class="product-list-box border">
                    <h2 class="product-list-title">On Sale</h2>

                    @forelse ($on_sale_items as $item)
                        <x-frontend.products.itemlist :item="$item" />
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-box-open fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">No sale products available.</p>
                        </div>
                    @endforelse

                </div>
            </div>

            <!-- Best Seller -->
            <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                <div class="product-list-box border">
                    <h2 class="product-list-title">Best Seller</h2>

                    @forelse ($best_seller_items as $item)
                        <x-frontend.products.itemlist :item="$item" />
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-box-open fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">No best seller products available.</p>
                        </div>
                    @endforelse

                </div>
            </div>

            <!-- Top Rated -->
            <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                <div class="product-list-box border">
                    <h2 class="product-list-title">Top Rated</h2>

                    @forelse ($top_rated as $item)
                        <x-frontend.products.itemlist :item="$item" />
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-box-open fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">No top-rated products available.</p>
                        </div>
                    @endforelse

                </div>
            </div>

        </div>
    </div>
</div>
<!-- product list end -->