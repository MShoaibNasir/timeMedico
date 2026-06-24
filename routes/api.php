<?php

use App\Http\Controllers\API\AdditionalCertificateController;
use App\Http\Controllers\API\AwardController;
use App\Http\Controllers\API\BioProfileController;
use App\Http\Controllers\API\BoardComitteeMemberController;
use App\Http\Controllers\API\DirectorShipController;
use App\Http\Controllers\API\DTPController;
use App\Http\Controllers\API\EducationController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\ProfessionalExperienceController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\SliderController;
use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->middleware('api.secret')->name('authentication.')->controller(RegisterController::class)->group(function () {
    Route::post('emailLogin', 'register');
    Route::post('emailVerification', 'tokenVerify');
});

Route::prefix('slider')->middleware('api.secret')->controller(SliderController::class)->group(function () {
    Route::get('/list', 'index');
});
Route::prefix('department')->middleware('api.secret')->controller(DepartmentController::class)->group(function () {
    Route::get('/list', 'index');
});
Route::prefix('category')->middleware('api.secret')->controller(CategoryController::class)->group(function () {
    Route::post('/list', 'index');
});
Route::prefix('product')->middleware('api.secret')->controller(ProductController::class)->group(function () {
    Route::post('/list', 'index');
    Route::post('/detail', 'detail');
});

