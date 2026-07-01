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
                        <div class="shop-widget">
                            <div class="shop-search-form">
                                <h4 class="shop-widget-title">Search</h4>
                                <form action="#">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <button type="search"><i class="far fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="shop-widget">
                            <h4 class="shop-widget-title">Category</h4>
                            <ul class="shop-category-list">
                                <li><a href="#">Medicine</a></li>

                            </ul>
                        </div>

                        <div class="shop-widget">
                            <h4 class="shop-widget-title">Price Range</h4>
                            <div class="price-range-box">
                                <div class="price-range-input">
                                    <input type="text" id="price-amount" readonly="">
                                </div>
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 10%; width: 30%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 10%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 40%;"></span>
                                </div>
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
                                <select class="select" style="display: none;">
                                    <option value="1">Default Sorting</option>
                                    <option value="5">Latest Items</option>
                                    <option value="2">Best Seller Items</option>
                                    <option value="3">Price - Low To High</option>
                                    <option value="4">Price - High To Low</option>
                                </select>
                                <div class="nice-select select" tabindex="0"><span class="current">Default Sorting</span>
                                    <ul class="list">
                                        <li data-value="1" class="option selected">Default Sorting</li>
                                        <li data-value="5" class="option">Latest Items</li>
                                        <li data-value="2" class="option">Best Seller Items</li>
                                        <li data-value="3" class="option">Price - Low To High</li>
                                        <li data-value="4" class="option">Price - High To Low</li>
                                    </ul>
                                </div>
                                <div class="shop-sort-show">Showing 1-10 of 50 Results</div>
                            </div>
                            <div class="shop-sort-gl">
                                <a href="shop" class="shop-sort-grid active"><i class="far fa-grid-round-2"></i></a>
                                <a href="shop-list" class="shop-sort-list"><i class="far fa-list-ul"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="shop-item-wrap item-4">
                        
                        <div class="row g-4" id="productlist"></div>
                    </div>
                    <!-- pagination -->
                    <div class="pagination-area mt-50">
                        <div aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true"><i class="far fa-arrow-left"></i></span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><span class="page-link">...</span></li>
                                <li class="page-item"><a class="page-link" href="#">10</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true"><i class="far fa-arrow-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- pagination end -->
                </div>
            </div>
        </div>
    </div>

<input type="hidden"  value="{{$id}}" id="category_id">
</main>

<script src="https://code.jquery.com/jquery-4.0.0.js"></script>
<script>
    let category_id=$('#category_id').val();
    $.ajax({
        url: "{{ route('frontend.productlist') }}",
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{category_id:category_id},

        beforeSend: function() {
            Swal.fire({
                title: 'Loading...',
                text: 'Please wait while fetch products.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        },

        success: function(response) {
           
            $('#productlist').html(response);
        },

        complete: function() {
            Swal.close();
        },

        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Something went wrong.'
            });
     
        }
    });
</script>


@endsection