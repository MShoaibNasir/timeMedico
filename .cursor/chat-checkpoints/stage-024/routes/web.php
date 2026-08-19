<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\EmailSenderController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\HomeSliderController;
use App\Http\Controllers\Backend\AreaController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\TypeController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\FeedbackBackendController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\CustomerAddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\BrandsController;

use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\WebsiteSettingController;
use App\Services\FcmService;




Route::prefix('manager')->name('manager.')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminController::class, 'loginPost'])->name('login.post');
    Route::middleware(['auth:admin', 'prevent-back-history'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [AdminController::class, 'logout'])->name('logout');
		
		
		
		
		Route::prefix('dashboard/pages')->controller(PageController::class)->as('cms.pages.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{page}', 'edit')->name('edit');
                Route::put('/update/{page}', 'update')->name('update');
                Route::delete('/delete/{page}', 'destroy')->name('destroy');
                Route::post('/toggle-status', 'toggleStatus')->name('toggle-status');
            });
            Route::prefix('dashboard/menus')->controller(MenuController::class)->as('cms.menus.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{menu}', 'edit')->name('edit');
                Route::put('/update/{menu}', 'update')->name('update');
                Route::delete('/delete/{menu}', 'destroy')->name('destroy');
                Route::post('/toggle-status', 'toggleStatus')->name('toggle-status');
            });
			Route::prefix('dashboard/settings')->controller(WebsiteSettingController::class)->as('cms.settings.')->group(function () {
				Route::get('/edit', 'edit')->name('edit');
                Route::post('/edit', 'update')->name('update');
            });
		
		
		
		
		

        Route::prefix('dashboard/category')->name('category.')->controller(CategoryController::class)->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/toggleStatus/{id}', 'toggleStatus')->name('toggleStatus');
        });




        Route::prefix('dashboard/coupon')->name('coupon.')->controller(CouponController::class)->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/toggleStatus/{id}', 'toggleStatus')->name('toggleStatus');
        });








        Route::prefix('dashboard/department')->name('department.')->controller(DepartmentController::class)->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/toggleStatus/{id}', 'toggleStatus')->name('toggleStatus');
        });
        Route::prefix('dashboard/type')->name('type.')->controller(TypeController::class)->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/toggleStatus/{id}', 'toggleStatus')->name('toggleStatus');
        });

        Route::prefix('dashboard/slider')->name('slider.')->controller(HomeSliderController::class)->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/toggleStatus/{id}', 'toggleStatus')->name('toggleStatus');
        });

        Route::prefix('admin/dashboard/product')->name('product.')->controller(ProductController::class)->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::post('/list', 'list')->name('list');
            Route::get('/create', 'create')->name('create');
            Route::get('/filter', 'filter')->name('filter');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/toggleStatus/{id}', 'toggleStatus')->name('toggleStatus');
            Route::post('/bulk-update', 'bulkUpdate')->name('bulkUpdate');
        });

        Route::prefix('admin/dashboard/feedback')->name('feedback.')->controller(FeedbackBackendController::class)->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/export', 'export')->name('export');
            Route::get('/show/{id}', 'show')->name('show');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        Route::prefix('admin/dashboard/area')->name('area.')->controller(AreaController::class)->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::post('/list', 'list')->name('list');
            Route::get('/create', 'create')->name('create');
            Route::get('/filter', 'filter')->name('filter');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/toggleStatus/{id}', 'toggleStatus')->name('toggleStatus');
            Route::post('/bulk-delivery-charges', 'bulkDeliveryCharges')->name('bulkDeliveryCharges');
        });

        Route::prefix('admin/dashboard/blog')->name('blog.')->controller(BlogController::class)->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/list', 'list')->name('list');
            Route::get('/create', 'create')->name('create');
            Route::get('/filter', 'filter')->name('filter');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/toggleStatus/{id}', 'toggleStatus')->name('toggleStatus');
        });
        Route::prefix('admin/dashboard/brand')->name('brand.')->controller(BrandController::class)->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/list', 'list')->name('list');
            Route::get('/create', 'create')->name('create');
            Route::get('/filter', 'filter')->name('filter');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/toggleStatus/{id}', 'toggleStatus')->name('toggleStatus');
        });




        Route::prefix('admin/dashboard/orders')->name('order.')->controller(OrderController::class)->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/list', 'list')->name('list');
            Route::get('/create', 'create')->name('create');
            Route::get('/filter', 'filter')->name('filter');
            Route::post('/store', 'store')->name('store');
            Route::get('/verify/{id}', 'verify')->name('verify');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/toggleStatus/{id}', 'toggleStatus')->name('toggleStatus');
            Route::get('/view/{id}', 'view')->name('view');
            Route::put('/updateStatus/{id}', 'updateStatus')->name('updateStatus');
            Route::get('/place-order-page', 'placeOrderPage')->name('placeOrderPage');
            Route::post('/place-order-store', 'placeOrderStore')->name('place.store');
        });


        Route::resources([
            'roles' => RoleController::class,
            'permissions' => PermissionController::class,
            'users' => AdminController::class,
        ]);
        Route::prefix('email/send')->name('email.send.')->controller(EmailSenderController::class)->group(function () {
            Route::post('index', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::post('bulk', 'bulkEmail')->name('bulk');
        });
    });
});
Auth::routes();





Route::prefix('/')->name('frontend.')->middleware(['prevent-back-history'])->controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home.page');
    Route::get('/singleShop/{id}', 'singleShop')->name('singleShop');
    Route::get('about-us', 'aboutUs')->name('aboutUs');
    Route::get('shop', 'shop')->name('shop');
    Route::get('categories/{id}', 'categories')->name('categories');
    Route::get('productFilter/{id}', 'productFilter')->name('productFilter');
    Route::post('productlist', 'productlist')->name('productlist');
    Route::get('register', 'register')->name('register');
    Route::get('login', 'login')->name('login');
    Route::post('login/user', 'loginUser')->name('loginUser');
    Route::post('signup', 'signup')->name('signup');
    Route::post('verifyotp', 'verifyotp')->name('verifyotp');
    Route::post('saveUser', 'saveUser')->name('saveUser');
    Route::get('website/logout', 'logout')->name('logout');
    Route::post('quickeView', 'quickeView')->name('quickeView');
    Route::post('addToCart', 'addToCart')->name('addToCart');
    Route::post('viewCart', 'viewCart')->name('viewCart');
    Route::post('removeFromCart', 'removeFromCart')->name('removeFromCart');
    Route::post('updateCartQuantity', 'updateCartQuantity')->name('updateCartQuantity');

    //Added By Ayaz
    Route::get('/contact-us', 'contact')->name('contact');
    Route::post('/contact-us', 'contactPost')->name('contact.post');
    Route::get('/sitemap', 'sitemap')->name('sitemap');
    Route::get('/page/{id}', 'pageshow')->name('page.show');
    // Frontend End
});


Route::prefix('/')->name('frontend.')->middleware(['prevent-back-history'])->controller(CartController::class)->group(function () {
    // Coupon routes 
    Route::post('coupon', 'applyCoupon')->name('coupon.apply');
    Route::delete('coupon', 'removeCoupon')->name('coupon.remove');
    //Route::get('checkout', 'checkout')->name('checkout');

    Route::get('cart-checkout', 'index')->name('cartcheckout');
    Route::patch('cart/{product}', 'update')->name('cart.update');
    Route::delete('cart/{product}', 'remove')->name('cart.remove');
    Route::delete('cart', 'clear')->name('cart.clear');

    Route::post('cart/summary', 'cartsummary')->name('cart.summary');
    Route::post('order/place', 'placeOrderNew')->name('order.place');
    Route::get('order/thank-you/{order}', 'thankYou')->name('order.thankyou');
});





//Route::post('/ajax/add-to-cart', [CartNewController::class, 'add'])->name('frontend.ajax.cart.add');



Route::prefix('wishlist/')->name('frontend.wishlist.')->middleware(['prevent-back-history'])->controller(WishlistController::class)->group(function () {
    Route::post('add/', 'add')->name('add');
    Route::post('show/', 'show')->name('show');
    Route::get('/', 'WishList')->name('WishList');
    Route::post('product_list/', 'product_list')->name('product_list');
});

Route::prefix('blog/')->name('frontend.blog.')->middleware(['prevent-back-history'])->controller(BlogsController::class)->group(function () {
    Route::get('{id}/', 'show')->name('show');
});
Route::prefix('brand/')->name('frontend.brand.')->middleware(['prevent-back-history'])->controller(BrandsController::class)->group(function () {
    Route::get('{id}/', 'show')->name('show');
});



Route::prefix('user-dashboard/')->name('frontend.dashboard.')->middleware(['prevent-back-history'])->controller(UserDashboardController::class)->group(function () {
    Route::get('/', 'show')->name('show');
    Route::get('profile', 'profile')->name('profile');
    Route::post('update-profile', 'updateProfile')->name('updateProfile');
    Route::get('order-list', 'orderlist')->name('orderlist');
    Route::get('order-detail/{id}', 'orderDetail')->name('orderDetail');
    Route::post('order-reorder/{id}', 'reorder')->name('reorder');
    Route::get('track-order', 'trackingOrder')->name('trackingOrder');
    Route::post('track-order-data', 'trackOrder')->name('trackOrder');
    Route::post('upload-payment-slip', 'uploadPaymentSlip')->name('uploadPaymentSlip');
    Route::get('/upload-Payment', 'uploadPayment')->name('uploadPayment');

});

Route::prefix('prescription/')->name('frontend.prescription.')->middleware(['prevent-back-history'])->controller(PrescriptionController::class)->group(function () {
    Route::get('/', 'show')->name('show');
    Route::get('/list', 'list')->name('list');
    Route::post('upload', 'upload')->name('upload');
});

Route::prefix('customer-address/')->name('frontend.customer.address.')->middleware(['prevent-back-history'])->controller(CustomerAddressController::class)->group(function () {
    Route::get('/', 'show')->name('show');
    Route::get('/list', 'list')->name('list');
    Route::post('upload', 'upload')->name('upload');
    Route::get('make-primary/{id}', 'makePrimary')->name('makePrimary');
});












Route::get('/test-mail', function () {
    try {
        Mail::raw('This is a test email from Laravel.', function ($message) {
            $message->to('shoaibnasir315@gmail.com ') // 👈 Change this
                ->subject('Test Email');
        });
        return '✅ Email sent successfully!';
    } catch (Exception $e) {
        return '❌ Email sending failed: ' . $e->getMessage();
    }
});


Route::get('/test-notification', function (FcmService $fcm) {
    $token = "cPKfzrp-RcWXgXQnV3ueJt:APA91bFFaLrFzvV1DH-96aGlSB3sQeilKKJU7YhzHRhtYvx3PVtm0WciE8voRl77p1ViWtmbVr5yvmcMmSsNE7UF5kfGTnGcuox8mCa2McRaynfeOazVpUE";

    try {
        $result = $fcm->send($token, "Test Title", "Ye test notification hai");
        return response()->json(['status' => 'sent', 'result' => $result]);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
});
