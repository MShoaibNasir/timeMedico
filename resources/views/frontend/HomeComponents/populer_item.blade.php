<!-- popular item -->
<div class="product-area pb-100">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-12 wow fadeInDown" data-wow-delay=".25s">
                        <div class="site-heading-inline">
                            <h2 class="site-title">Popular Items</h2>
                            <a href="{{ url('shop') }}">All Products <i class="fas fa-angle-double-right"></i></a>
                        </div>
                        <div class="item-tab">
                            <ul class="nav nav-pills mt-40 mb-50" id="item-tab" role="tablist">
                                @foreach($polular_item_categories as $index => $category)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $index == 0 ? 'active' : '' }}" 
                                                id="item-tab{{ $category->id }}" 
                                                data-bs-toggle="pill" 
                                                data-bs-target="#pill-item-tab{{ $category->id }}" 
                                                type="button" 
                                                role="tab" 
                                                aria-controls="pill-item-tab{{ $category->id }}" 
                                                aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                                            {{ $category->name }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="tab-content wow fadeInUp" data-wow-delay=".25s" id="item-tabContent">
                    @foreach($polular_item_categories as $index => $category)
                        <div class="tab-pane {{ $index == 0 ? 'show active' : '' }}" 
                             id="pill-item-tab{{ $category->id }}" 
                             role="tabpanel" 
                             aria-labelledby="item-tab{{ $category->id }}" 
                             tabindex="0">
                            <div class="row g-3 item-2">
                                
                                @forelse($category->products_with_out_trashed as $product)
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        @include('frontend.Components.product',['item'=>$product])
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-4">
                                        <p class="text-muted">No products found in this category.</p>
                                    </div>
                                @endforelse

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="col-lg-3">
                <div class="product-banner wow fadeInRight" data-wow-delay=".25s">
                    <a href="#">
                        <img src="{{ asset('frontend/images/product-banner.jpg') }}" alt="Promo Banner">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- popular item end -->