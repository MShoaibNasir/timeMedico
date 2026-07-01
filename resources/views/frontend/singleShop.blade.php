@extends('frontend.layout.master')
@section('content')
<main class="main">

    <!-- breadcrumb -->
    <div class="site-breadcrumb">
<div class="site-breadcrumb-bg" style="background: url('{{ asset('frontend/images/about-01.jpg') }}');">            <div class="container">
                <div class="site-breadcrumb-wrap">
                    <h4 class="breadcrumb-title">Shop Single</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="home"><i class="far fa-home"></i> Home</a></li>
                        <li class="active">Shop Single</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- breadcrumb end -->


        <!-- shop single -->
        <div class="shop-single py-90">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-lg-6 col-xxl-5">
                        <div class="shop-single-gallery">
                            
                            <div class="flexslider-thumbnails">
                             <ul class="slides">
    <li data-thumb="{{ asset('frontend/images/product/01.png') }}" rel="adjustX:10, adjustY:">
            <img src="{{ asset('frontend/images/product/01.png') }}" alt="Product 1">
            </li>
            <li data-thumb="{{ asset('frontend/images/product/02.png') }}">
                <img src="{{ asset('frontend/images/product/02.png') }}" alt="Product 2">
            </li>
            <li data-thumb="{{ asset('frontend/images/product/03.png') }}">
                <img src="{{ asset('frontend/images/product/03.png') }}" alt="Product 3">
            </li>
            <li data-thumb="{{ asset('frontend/images/product/04.png') }}">
                <img src="{{ asset('frontend/images/product/04.png') }}" alt="Product 4">
            </li>
            </ul>
        </div>
    </div>
    </div>
    <div class="col-md-12 col-lg-6 col-xxl-6">
        <div class="shop-single-info">
            <h4 class="shop-single-title">Surgical Face Mask</h4>
            <div class="shop-single-rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <i class="far fa-star"></i>
                <span class="rating-count"> (4 Customer Reviews)</span>
            </div>
            <div class="shop-single-price">
                <del>Rs690</del>
                <span class="amount">Rs650</span>
                <span class="discount-percentage">30% Off</span>
            </div>
            <p class="mb-3">
                There are many variations of passages of Lorem Ipsum available, but the majority have
                suffered alteration in some form, by injected humour, or randomised words which don't
                look even slightly believable.
            </p>
            <div class="shop-single-cs">
                <div class="row">
                    <div class="col-md-3 col-lg-4 col-xl-3">
                        <div class="shop-single-size">
                            <h6>Quantity</h6>
                            <div class="shop-cart-qty">
                                <button class="minus-btn"><i class="fal fa-minus"></i></button>
                                <input class="quantity" type="text" value="1" disabled="">
                                <button class="plus-btn"><i class="fal fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-4 col-xl-3">
                        <div class="shop-single-size">
                            <h6>Size</h6>
                            <select class="select">
                                <option value="">Choose Size</option>
                                <option value="1">Extra Small</option>
                                <option value="2">Small</option>
                                <option value="3">Medium</option>
                                <option value="4">Extra Large</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="shop-single-sortinfo">
                <ul>
                    <li>Stock: <span>Available</span></li>
                    <li>SKU: <span>656TYTR</span></li>
                    <li>Category: <span>Medicine</span></li>
                    <li>Brand: <a href="#">Novak</a></li>
                    <li>Tags: <a href="#">Medicine</a>,<a href="#">Healthcare</a>,<a href="#">Modern</a>,<a href="#">Shop</a></li>
                </ul>
            </div>
            <div class="shop-single-action">
                <div class="row align-items-center">
                    <div class="col-md-6 col-lg-12 col-xl-6">
                        <div class="shop-single-btn">
                            <a href="cart" class="theme-btn"><span class="far fa-shopping-bag"></span>Add To Cart</a>
                            <a href="#" class="theme-btn theme-btn2" data-tooltip="tooltip" title="Add To Wishlist"><span class="far fa-heart"></span></a>

                        </div>
                    </div>
                    <div class="col-md-6 col-lg-12 col-xl-6">
                        <div class="shop-single-share">
                            <span>Share:</span>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-x-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-pinterest-p"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- shop single details -->
    <div class="shop-single-details">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-tab1" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1" aria-selected="true">Description</button>
                <button class="nav-link" id="nav-tab2" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">Additional
                    Info</button>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="nav-tab1">
                <div class="shop-single-desc">
                    <p>
                        There are many variations of passages of Lorem Ipsum available, but the majority
                        have suffered alteration in some form, by injected humour, or randomised words which
                        don't look even slightly believable. If you are going to use a passage of Lorem
                        Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of
                        text. All the Lorem Ipsum generators on the Internet tend to repeat predefined
                        chunks as necessary, making this the first true generator on the Internet.
                    </p>
                    <p>
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                        doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                        veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam
                        voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur
                        magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est,
                        qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.
                    </p>
                    <div class="row">
                        <div class="col-lg-5 col-xl-4">
                            <div class="shop-single-list">
                                <h5 class="title">Features</h5>
                                <ul>
                                    <li>Modern Art Deco Chaise Lounge</li>
                                    <li>Unique cylindrical design copper finish</li>
                                    <li>Covered in grey velvet fabric</li>
                                    <li>Modern Bookcase in Copper Colored Finish</li>
                                    <li>Use of Modern Materials</li>
                                    <li>Mirrored compartments and upgraded interior</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-5">
                            <div class="shop-single-list">
                                <h5 class="title">Specifications</h5>
                                <ul>
                                    <li><span>Dimensions:</span> 4ft W x 7ft h</li>
                                    <li><span>Model Year:</span> 2024</li>
                                    <li><span>Available Sizes:</span> 8.5, 9.0, 9.5, 10.0</li>
                                    <li><span>Manufacturer:</span> Reebok Inc.</li>
                                    <li><span>Available Colors:</span> White/Red/Blue,Black/Orange/Green</li>
                                    <li><span>Made In:</span> USA</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="nav-tab2">
                <div class="shop-single-additional">
                    <p>
                        There are many variations of passages of Lorem Ipsum available, but the majority
                        have suffered alteration in some form, by injected humour, or randomised words which
                        don't look even slightly believable. If you are going to use a passage of Lorem
                        Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of
                        text. All the Lorem Ipsum generators on the Internet tend to repeat predefined
                        chunks as necessary, making this the first true generator on the Internet.
                    </p>
                    <p>
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                        doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                        veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam
                        voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur
                        magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est,
                        qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.
                    </p>
                    <div class="shop-single-list">
                        <h5 class="title">Shipping Options:</h5>
                        <ul>
                            <li><span>Standard:</span> 6-7 Days, Shipping Cost - Free</li>
                            <li><span>Express:</span> 1-2 Days, Shipping Cost - Rs20</li>
                            <li><span>Courier:</span> 2-3 Days, Shipping Cost - Rs30</li>
                            <li><span>Fastgo:</span> 1-3 Days, Shipping Cost - Rs15</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- shop single details end -->


    <!-- related item -->
    <div class="product-area related-item pt-40">
        <div class="container px-0">
            <div class="row">
                <div class="col-12">
                    <div class="site-heading-inline">
                        <h2 class="site-title">Related Items</h2>
                        <a href="shop">View More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row g-4 item-2">
                <div class="col-md-6 col-lg-3">
                    <div class="product-item">
                        <div class="product-img">
                            <span class="type new">New</span>
                            <a href="shop-single"><img src="{{asset('frontend/images/product/07.png')}}" alt=""></a>
                            <div class="product-action-wrap">
                                <div class="product-action">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quickview" data-bs-placement="right" data-tooltip="tooltip" title="Quick View"><i class="far fa-eye"></i></a>
                                    <a href="#" data-bs-placement="right" data-tooltip="tooltip" title="Add To Wishlist"><i class="far fa-heart"></i></a>

                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3 class="product-title"><a href="shop-single">Surgical Face Mask</a></h3>
                            <div class="product-rate">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <div class="product-bottom">
                                <div class="product-price">
                                    <span>Rs100.00</span>
                                </div>
                                <button type="button" class="product-cart-btn" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart">
                                    <i class="far fa-shopping-bag"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="product-item">
                        <div class="product-img">
                            <span class="type hot">Hot</span>
                            <a href="shop-single"><img src="{{asset('frontend/images/product/08.png')}}" alt=""></a>
                            <div class="product-action-wrap">
                                <div class="product-action">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quickview" data-bs-placement="right" data-tooltip="tooltip" title="Quick View"><i class="far fa-eye"></i></a>
                                    <a href="#" data-bs-placement="right" data-tooltip="tooltip" title="Add To Wishlist"><i class="far fa-heart"></i></a>

                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3 class="product-title"><a href="shop-single">Surgical Face Mask</a></h3>
                            <div class="product-rate">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <div class="product-bottom">
                                <div class="product-price">
                                    <span>Rs100.00</span>
                                </div>
                                <button type="button" class="product-cart-btn" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart">
                                    <i class="far fa-shopping-bag"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="product-item">
                        <div class="product-img">
                            <span class="type oos">Out Of Stock</span>
                            <a href="shop-single"><img src="{{asset('frontend/images/product/12.png')}}" alt=""></a>
                            <div class="product-action-wrap">
                                <div class="product-action">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quickview" data-bs-placement="right" data-tooltip="tooltip" title="Quick View"><i class="far fa-eye"></i></a>
                                    <a href="#" data-bs-placement="right" data-tooltip="tooltip" title="Add To Wishlist"><i class="far fa-heart"></i></a>

                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3 class="product-title"><a href="shop-single">Surgical Face Mask</a></h3>
                            <div class="product-rate">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <div class="product-bottom">
                                <div class="product-price">
                                    <span>Rs100.00</span>
                                </div>
                                <button type="button" class="product-cart-btn" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart">
                                    <i class="far fa-shopping-bag"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="product-item">
                        <div class="product-img">
                            <span class="type discount">10% Off</span>
                            <a href="shop-single"><img src="{{asset('frontend/images/product/14.png')}}" alt=""></a>
                            <div class="product-action-wrap">
                                <div class="product-action">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quickview" data-bs-placement="right" data-tooltip="tooltip" title="Quick View"><i class="far fa-eye"></i></a>
                                    <a href="#" data-bs-placement="right" data-tooltip="tooltip" title="Add To Wishlist"><i class="far fa-heart"></i></a>

                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3 class="product-title"><a href="shop-single">Surgical Face Mask</a></h3>
                            <div class="product-rate">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <div class="product-bottom">
                                <div class="product-price">
                                    <del>Rs120.00</del>
                                    <span>Rs100.00</span>
                                </div>
                                <button type="button" class="product-cart-btn" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart">
                                    <i class="far fa-shopping-bag"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- related item end -->
    </div>
    </div>
    <!-- shop single end -->

</main>


@endsection