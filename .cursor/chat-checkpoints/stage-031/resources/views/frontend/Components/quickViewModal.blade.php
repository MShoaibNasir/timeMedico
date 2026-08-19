<div class="modal-content">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        <i class="far fa-xmark"></i>
    </button>

    <div class="modal-body">
        <div class="row">

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="quickview-img">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="quickview-content">

                    <h4 class="quickview-title">
                        {{ $product->name }}
                    </h4>

                    <div class="quickview-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>

                    <div class="quickview-price">
                        <h5>
                            {{-- Discount (enable later)
                            @if($product->discount_amount > 0)
                            <del>Rs {{ number_format($product->price,2) }}</del>
                            <span>Rs {{ number_format($product->final_price,2) }}</span>
                            @else
                            --}}
                            <span>Rs {{ number_format($product->price,2) }}</span>
                            {{-- @endif --}}
                        </h5>
                    </div>

                    <ul class="quickview-list">
                        <li>
                            Category:
                            <span>{{ $product->category->name ?? 'N/A' }}</span>
                        </li>

                        <li>
                            Stock:
                            <span class="stock">
                                {{ ($product->quantity ?? 0) > 0 ? 'Available' : 'Out of Stock' }}
                            </span>
                        </li>

                        @if(!empty($product->brand))
                        <li>
                            Brand:
                            <span>{{ $product->brand }}</span>
                        </li>
                        @endif
                    </ul>

                    @if(!empty($product->description))
                    <p class="mt-3">
                        {!! Str::limit(strip_tags($product->description), 150) !!}
                    </p>
                    @endif

                    <div class="quickview-cart">
                        <a href="{{ route('frontend.singleShop', [Crypt::encryptString($product->id)]) }}" class="theme-btn">
                            View Details
                        </a>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>