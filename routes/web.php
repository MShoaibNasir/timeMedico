<?php

use App\Http\Controllers\Backend\AdminController;
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
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\CustomerAddressController;





Route::prefix('manager')->name('manager.')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminController::class, 'loginPost'])->name('login.post');
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [AdminController::class, 'logout'])->name('logout');

        Route::prefix('dashboard/category')->name('category.')->controller(CategoryController::class)->group(function () {
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





Route::prefix('/')->name('frontend.')->controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home.page');
    Route::get('/singleShop/{id}', 'singleShop')->name('singleShop');
    Route::get('about-us', 'aboutUs')->name('aboutUs');
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
    // Khalid End


});


Route::prefix('wishlist/')->name('frontend.wishlist.')->controller(WishlistController::class)->group(function () {
    Route::post('add/', 'add')->name('add');
    Route::post('show/', 'show')->name('show');
    Route::get('/', 'WishList')->name('WishList');
    Route::post('product_list/', 'product_list')->name('product_list');
});



Route::prefix('user-dashboard/')->name('frontend.dashboard')->controller(UserDashboardController::class)->group(function () {
    Route::get('/', 'show')->name('show');
});

Route::prefix('prescription/')->name('frontend.prescription.')->controller(PrescriptionController::class)->group(function () {
    Route::get('/', 'show')->name('show');
    Route::get('/list', 'list')->name('list');
    Route::post('upload', 'upload')->name('upload');

});

Route::prefix('customer-address/')->name('frontend.customer.address.')->controller(CustomerAddressController::class)->group(function () {
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
