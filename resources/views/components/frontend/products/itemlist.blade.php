<div class="product-list-item">
	<div class="product-list-img">
		<a href="{{ route('frontend.singleShop', [Crypt::encryptString($item->id)]) }}"><img src="{{ asset('storage/'.$item->image) }}" alt="#"></a>
	</div>
	<div class="product-list-content">
		<h4><a href="{{ route('frontend.singleShop', [Crypt::encryptString($item->id)]) }}">{{$item->name}}</a></h4>

		<div class="product-list-price">
			@if($item->discount_amount>0)
			<span>Rs <del>{{number_format($item->price,2)}}</del>  {{number_format($item->final_price,2)}}</span>
			@else
			<span>Rs{{number_format($item->price,2)}}</span>
			@endif
		</div>
	</div>
	<button type="button" class="product-list-btn product-cart-btn" data-product-id="{{$item->id}}" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart">
                <i class="far fa-shopping-bag"></i>
            </button>
</div>

