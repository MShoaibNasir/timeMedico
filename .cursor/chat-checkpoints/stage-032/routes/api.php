<?php

use App\Http\Controllers\API\AdditionalCertificateController;
use App\Http\Controllers\API\AwardController;
use App\Http\Controllers\API\BioProfileController;
use App\Http\Controllers\API\BoardComitteeMemberController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\AreaController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\CustomerAddressController;
use App\Http\Controllers\API\PrescriptionController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\FeedbackController;
use App\Http\Controllers\API\NotificationController as ApiNotificationController;
use App\Http\Controllers\API\SliderController;
use App\Http\Controllers\API\CouponController;
use App\Http\Controllers\API\WebsiteSettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->middleware('api.secret')->name('authentication.')->controller(RegisterController::class)->group(function () {
    Route::post('emailLogin', 'register');
    Route::post('emailVerification', 'tokenVerify');
    Route::get('/marquee', 'marquee');
    Route::get('/privacyPolicy', 'privacyPolicy');
});

Route::prefix('authentication')->middleware(['api.secret'])->name('authentication.')->controller(RegisterController::class)->group(function () {
    Route::post('updateProfile', 'updateProfile');
});

Route::prefix('slider')->middleware('api.secret')->controller(SliderController::class)->group(function () {
    Route::get('/list', 'index');
    Route::get('/list/downslider', 'downslider');
});
Route::prefix('department')->middleware('api.secret')->controller(DepartmentController::class)->group(function () {
    Route::get('/list', 'index');
});
Route::prefix('category')->middleware('api.secret')->controller(CategoryController::class)->group(function () {
    Route::post('/list', 'index');
});

Route::prefix('product')->middleware('api.secret')->controller(ProductController::class)->group(function () {
    Route::get('/list', 'index');
    Route::post('data', 'data');
    Route::post('/detail', 'detail');
    Route::post('/data/with-respect-type', 'productDataWithRespectType');
    Route::post('/search', 'search');
    Route::post('/type-search', 'typeSearch');
});

//  token required apis
Route::prefix('Prescription')->middleware(['api.secret', 'auth:sanctum'])->controller(PrescriptionController::class)->group(function () {
    Route::post('/upload', 'upload');
    Route::post('/get', 'list');
});
Route::prefix('image')->middleware(['api.secret', 'auth:sanctum'])->controller(ImageController::class)->group(function () {
    Route::post('/upload', 'upload');
});

Route::prefix('address')->middleware(['api.secret', 'auth:sanctum'])->controller(CustomerAddressController::class)->group(function () {
    Route::post('/add', 'add');
    Route::post('/make_primary', 'is_primary');
    Route::post('/list', 'list');
});
Route::prefix('coupon')->middleware(['api.secret', 'auth:sanctum'])->controller(CouponController::class)->group(function () {
    Route::post('/get', 'getCoupon');
});
Route::prefix('websitesetting')->middleware(['api.secret'])->controller(WebsiteSettingController::class)->group(function () {
    Route::get('/get', 'index');
});



Route::prefix('Orders')->controller(OrderController::class)->group(function () {
    Route::post('/place', 'placeOrder');
    Route::post('/get', 'getUserOrders');
});


Route::prefix('area')->middleware(['api.secret'])->controller(AreaController::class)->group(function () {
    Route::get('/list', 'list');
});

Route::prefix('feedback')->middleware(['api.secret'])->controller(FeedbackController::class)->group(function () {
    Route::post('/upload', 'upload');
    Route::post('/list', 'list');
});

Route::prefix('notifications')->middleware(['api.secret', 'auth:sanctum'])->controller(ApiNotificationController::class)->group(function () {
    Route::get('/list', 'index');
    Route::post('/{id}/read', 'markRead');
    Route::post('/read-all', 'markAllRead');
});
