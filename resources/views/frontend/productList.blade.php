@forelse ($product as $item)
<div class="col-md-6 col-lg-4">
    <div class="product-item">
        <div class="product-img">
            <a href="{{ route('frontend.singleShop', [Crypt::encryptString($item->id)]) }}">
                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->name }}">
            </a>

            <div class="product-action-wrap">
                <div class="product-action">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#quickview">
                        <i class="far fa-eye"></i>
                    </a>

                    <a href="#">
                        <i class="far fa-heart"></i>
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

                <button type="button" class="product-cart-btn">
                    <i class="far fa-shopping-bag"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-12">
    <div class="alert alert-info text-center">
        No products available.
    </div>
</div>
@endforelse