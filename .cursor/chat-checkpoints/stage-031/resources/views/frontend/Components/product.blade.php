@php
$wishlist = session('wishlist', []);
$cart = session('cart', []);
$cartQty = (int) ($cart[$item->id]['quantity'] ?? 0);
$displayPrice = $item->discount_amount > 0 ? $item->final_price : $item->price;
@endphp
<div class="product-item">
    <div class="product-img">
        <a href="{{ route('frontend.singleShop', [Crypt::encryptString($item->id)]) }}"><img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->name }}"></a>
        <div class="product-action-wrap">
            <div class="product-action">
                <a href="#" data-bs-toggle="modal" data-product-id="{{$item->id}}" data-bs-target="#quickview" class="quickeView" data-tooltip="tooltip" title="Quick View"><i class="far fa-eye"></i></a>
                @if(in_array($item->id, $wishlist))
                <a style="background-color:red;" data-product-id="{{$item->id}}" data-tooltip="tooltip" title="Add To Wishlist" class="wishlist"><span class="fas fa-heart"></span></a>
                @else
                <a data-product-id="{{$item->id}}" class="wishlist" data-tooltip="tooltip" title="Add To Wishlist"><span class="far fa-heart"></span></a>
                @endif
            </div>
        </div>
    </div>
    <div class="product-content">
        <h3 class="product-title"><a href="{{ route('frontend.singleShop', [Crypt::encryptString($item->id)]) }}">{{$item->name}}</a></h3>

        <div class="product-bottom">
            <div class="product-price">
                {{-- Discount strikethrough (enable later)
                @if($item->discount_amount > 0)
                <span class="product-price-old">Rs {{ number_format($item->price, 2) }}</span>
                @endif
                --}}
                <span class="product-price-current">
                    <span class="product-currency">Rs</span>
                    <span class="product-amount">{{ number_format($item->price, 2) }}</span>
                </span>
            </div>

            <div class="product-cart-action" data-product-id="{{ $item->id }}">
                <button type="button"
                    class="product-cart-btn"
                    data-product-id="{{ $item->id }}"
                    data-bs-placement="left"
                    data-tooltip="tooltip"
                    title="Add To Cart"
                    @if($cartQty > 0) style="display:none;" @endif>
                    <i class="far fa-shopping-bag"></i>
                </button>

                <div class="shop-cart-qty product-card-qty" @if($cartQty < 1) style="display:none;" @endif>
                    <button type="button" class="minus-btn product-qty-minus" aria-label="Decrease quantity" title="Decrease">
                        <i class="fal fa-minus"></i>
                    </button>
                    <input class="quantity product-qty-input" type="text" value="{{ max($cartQty, 1) }}" disabled aria-label="Quantity">
                    <button type="button" class="plus-btn product-qty-plus" aria-label="Increase quantity" title="Increase">
                        <i class="fal fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
