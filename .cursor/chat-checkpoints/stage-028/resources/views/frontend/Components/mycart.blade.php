<a href="{{ route('frontend.cartcheckout') }}" class="shop-cart tm-action-btn list-item">
    <span class="tm-action-icon list-item-icon">
        <i class="far fa-shopping-bag"></i><span class="tm-count-badge">{{ count($cart) }}</span>
    </span>
    <span class="tm-action-meta list-item-info">
        <small>Rs{{ number_format($total,2) }}</small>
        <strong>My Cart</strong>
    </span>
</a>
<div class="dropdown-cart-menu tm-cart-panel">
    <div class="dropdown-cart-header">
        <span>{{ count($cart) }} Items</span>
        <a href="{{ route('frontend.cartcheckout') }}">View Cart</a>
    </div>
    <ul class="dropdown-cart-list">
        @forelse ($cart as $data)
        <li>
            <div class="dropdown-cart-item">
                <div class="cart-img">
                    <a href="{{ route('frontend.singleShop', [Crypt::encryptString($data['id'])]) }}">
                        <img src="{{ asset('storage/'.$data['image']) }}" alt="{{ $data['name'] }}">
                    </a>
                </div>

                <div class="cart-info">
                    <h4>
                        <a href="{{ route('frontend.singleShop', [Crypt::encryptString($data['id'])]) }}">
                            {{ $data['name'] }}
                        </a>
                    </h4>

                    <p class="cart-qty">
                        {{ $data['quantity'] }}x -
                        <span class="cart-amount">
                            Rs {{ number_format($data['price'], 2) }}
                        </span>
                    </p>
                </div>

                <a href="#"
                    class="cart-remove"
                    data-product-id="{{ $data['id'] }}"
                    title="Remove this item">
                    <i class="far fa-times-circle"></i>
                </a>
            </div>
        </li>
        @empty
        <li class="tm-notify-empty">Your cart is empty.</li>
        @endforelse
    </ul>
    <div class="dropdown-cart-bottom">
        <div class="dropdown-cart-total">
            <span>Total</span>
            <span class="total-amount">Rs{{ number_format($total,2) }}</span>
        </div>
        <a href="{{ route('frontend.cartcheckout') }}" class="theme-btn">Checkout</a>
    </div>
</div>
