@forelse ($product as $item)
<div class="col-md-6 col-lg-4">
    @include('frontend.Components.product', ['item' => $item])
</div>
@empty
<div class="col-12">
    <div class="alert alert-info text-center">
        No products available.
    </div>
</div>
@endforelse
