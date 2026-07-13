@php
$wishlist = session('wishlist', []);
@endphp
@forelse ($product as $item)
<div class="col-md-6 col-lg-4">
    <div class="product-item">
        <div class="product-img">
            <a href="{{ route('frontend.singleShop', [Crypt::encryptString($item->id)]) }}">
                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->name }}">
            </a>

            <div class="product-action-wrap">
                <div class="product-action">
                    <a data-product-id="{{$item->id}}" class="quickeView" data-bs-toggle="modal" data-bs-target="#quickview">
                        <i class="far fa-eye"></i>
                    </a>

                    @if(in_array($item->id, $wishlist))
                    <a style="background-color:red;" data-product-id="{{$item->id}}" data-tooltip="tooltip" title="Add To Wishlist" class="wishlist"><span class="fas fa-heart"></span></a>
                    @else
                    <a data-product-id="{{$item->id}}" class="wishlist" data-tooltip="tooltip" title="Add To Wishlist"><span class="far fa-heart"></span></a>
                    @endif
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
                    @if($item->discount_amount > 0)
                    <span>Rs <del>{{number_format($item->price,2)}}</del> {{number_format($item->final_price,2)}}</span>
                    @else
                    <span>Rs {{number_format($item->price,2)}}</span>
                    @endif
                </div>

                <button type="button" class="product-cart-btn" data-product-id="{{$item->id}}" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart">
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