<h4 class="user-card-title">My Wishlist</h4>

<div class="row g-4 mt-20 item-2">
    @forelse ($products as $item)
    <div class="col-md-6 col-lg-4">
        <div class="product-item">
            <div class="product-img">

                <a href="{{ route('frontend.singleShop', [Crypt::encryptString($item->id)]) }}">
                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->name }}">
                </a>

                <div class="product-action-wrap">
                    <div class="product-action">

                        <a
                            style="cursor: pointer;"
                            data-bs-toggle="modal"
                            data-bs-target="#quickview"
                            data-bs-placement="top"
                            data-tooltip="tooltip"
                            title="Quick View">
                            <i class="far fa-eye"></i>
                        </a>

                        <a
                            style="cursor: pointer;"
                            class="remove-wishlist wishlist"
                            data-product-id="{{ $item->id }}"
                            data-bs-placement="top"
                            data-tooltip="tooltip"
                            title="Remove From Wishlist">
                            <i class="far fa-xmark"></i>
                        </a>

                    </div>
                </div>
            </div>

            <div class="product-content">
                <h3 class="product-title">
                    <a href="{{ route('frontend.singleShop', [Crypt::encryptString($item->id)]) }}">
                        {{ $item->name }}
                    </a>
                </h3>

                <div class="product-rate">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>

                <div class="product-bottom">
                    <div class="product-price">
                        <span>Rs {{ number_format($item->price, 2) }}</span>
                    </div>

                    <button type="button"
                        class="product-cart-btn"
                        data-bs-placement="left"
                        data-tooltip="tooltip"
                        title="Add To Cart">
                        <i class="far fa-shopping-bag"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center">
        <h5>No products found in wishlist.</h5>
    </div>
    @endforelse
</div>

@if($products->hasPages())
<div class="pagination-area mt-4 mb-3">
    {{ $products->links() }}
</div>
@endif