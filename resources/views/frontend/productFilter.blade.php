@extends('frontend.layout.master')
@section('content')

<main class="main">
    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url(assets/images/about-01.jpg)"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">Shop</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">Shop</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- shop-area -->
    <div class="shop-area bg py-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop-sidebar">
                        <!-- Search Filter -->
                        <div class="shop-widget">
                            <div class="shop-search-form">
                                <h4 class="shop-widget-title">Search</h4>
                                <form action="#" onsubmit="return false;">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Search" id="search_product">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div class="shop-widget">
                            <h4 class="shop-widget-title">Category</h4>
                            <ul class="shop-category-list">
                                <li><a href="#" class="category-filter {{ empty($id) ? 'active' : '' }}" data-id="">All Categories</a></li>
                                <!-- Agar aap categories dynamic loop kar rahe hain toh aise likhein -->
                                @if(isset($categories))
                                    @foreach($categories as $cat)
                                        <li><a href="#" class="category-filter {{ $id == $cat->id ? 'active' : '' }}" data-id="{{ $cat->id }}">{{ $cat->name }}</a></li>
                                    @endforeach
                                @else
                                    <li><a href="#" class="category-filter {{ $id == 1 ? 'active' : '' }}" data-id="1">Medicine</a></li>
                                @endif
                            </ul>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="shop-widget">
                            <h4 class="shop-widget-title">Price Range</h4>
                            <div class="price-range-box">
                                <div class="price-range-input">
                                    <input type="text" id="price-amount" readonly="">
                                    <input type="hidden" id="min_price" value="0">
                                    <input type="hidden" id="max_price" value="5000">
                                </div>
                                <div id="price-slider" class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"></div>
                            </div>
                        </div>

                        <div class="shop-widget-banner mt-30 mb-50">
                            <div class="banner-img" style="background-image:url(assets/images/shop-banner.jpg)"></div>
                            <div class="banner-content">
                                <h6>Get <span>35% Off</span></h6>
                                <h4>New Collection of Medicine</h4>
                                <a href="#" class="theme-btn">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-9">
                    <div class="col-md-12">
                        <div class="shop-sort">
                            <div class="shop-sort-box">
                                <div class="shop-sorty-label">Sort By:</div>
                                <!-- Sahi select element custom values ke sath -->
                                <select class="select" id="sorting_dropdown">
                                    <option value="default">Default Sorting</option>
                                    <option value="latest">Latest Items</option>
                                    <option value="price_low">Price - Low To High</option>
                                    <option value="price_high">Price - High To Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="shop-item-wrap item-4">
                        <div class="row g-4" id="productlist"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" value="{{$id}}" id="category_id">
</main>

<script>
$(document).ready(function() {
    
    // UI Slider Initialization (Agar jQuery UI use ho raha hai)
    if($("#price-slider").length > 0) {
        $("#price-slider").slider({
            range: true,
            min: 0,
            max: 5000,
            values: [0, 5000],
            slide: function(event, ui) {
                $("#price-amount").val(ui.values[0] + " - " + ui.values[1]);
                $("#min_price").val(ui.values[0]);
                $("#max_price").val(ui.values[1]);
            },
            change: function(event, ui) {
                filter_data();
            }
        });
        $("#price-amount").val("$" + $("#price-slider").slider("values", 0) + " - $" + $("#price-slider").slider("values", 1));
    }

    // Pehli dafa data load karne ke liye
    filter_data();

    function filter_data(currentpage) {
        var action = 'fetch_data';
        var category_id = $('#category_id').val();
        var search_product = $("#search_product").val();
        var min_price = $("#min_price").val();
        var max_price = $("#max_price").val();
        var sort_val = $("#sorting_dropdown").val();
        var ayis_page = currentpage ?? 1;

        $.ajax({
            type: 'POST',
            url: "{{ route('frontend.productlist') }}",
            data: {
                action: action,
                category_id: category_id,
                search_product: search_product,
                min_price: min_price,
                max_price: max_price,
                sort_val: sort_val,
                ayis_page: ayis_page,
                _token: '{{csrf_token()}}'
            },
            beforeSend: function() {
                $('#productlist').html('<center><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></center>');
            },
            success: function(data) {
                $('#productlist').html(data);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    // Search input par filter chalanay ke liye
    $("#search_product").on('keyup', function() {
        filter_data();
    });

    // Category links click handler
    $('.category-filter').on('click', function(e) {
        e.preventDefault();
        $('.category-filter').removeClass('active');
        $(this).addClass('active');
        $('#category_id').val($(this).data('id'));
        filter_data();
    });

    // Sorting dropdown change handler
    $('body').on('change', '#sorting_dropdown', function(e) {
        filter_data();
    });

    // Pagination links handler
    $('body').on('click', '.pagination a', function(f) {
        f.preventDefault();
        var url = $(this).attr('href');
        var currentpage = url.split('page=')[1];
        filter_data(currentpage);
    });
});
</script>
@endsection