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
use App\Http\Controllers\API\PublicationController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ResourceLibraryController;
use App\Http\Controllers\API\SkillController;
use App\Http\Controllers\API\CommunicationController;
use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->name('authentication.')->controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->prefix('education')->controller(EducationController::class)->group(function () {
    Route::post('store', 'store');
    Route::post('update', 'update');
    Route::delete('delete', 'delete');
    Route::get('index', 'index');
    Route::get('show', 'show');
});

Route::middleware('auth:sanctum')->prefix('skill')->controller(SkillController::class)->group(function () {
    Route::post('store', 'store');
    Route::post('update', 'update');
    Route::delete('delete', 'delete');
    Route::get('index', 'index');
    Route::get('show', 'show');
});

Route::middleware('auth:sanctum')->prefix('dtp')->controller(DTPController::class)->group(function () {
    Route::post('store', 'store');
    Route::post('update', 'update');
    Route::delete('delete', 'delete');
    Route::get('list', 'index');
    Route::get('show', 'show');
});
Route::middleware('auth:sanctum')->prefix('bio/profile')->controller(BioProfileController::class)->group(function () {
    Route::post('store', 'store');
    Route::post('update', 'update');
    Route::delete('delete', 'delete');
    Route::get('list', 'index');
    Route::get('show', 'show');
});

Route::middleware('auth:sanctum')->prefix('professional/experience')->controller(ProfessionalExperienceController::class)->group(function () {
    Route::post('store', 'store');
    Route::post('update', 'update');
    Route::delete('delete', 'delete');
    Route::get('list', 'index');
    Route::get('show', 'show');
});

Route::middleware('auth:sanctum')->prefix('directorship')->controller(DirectorShipController::class)->group(function () {
    Route::post('store', 'store');
    Route::post('update', 'update');
    Route::delete('delete', 'delete');
    Route::get('list', 'index');
    Route::get('show', 'show');
});
Route::middleware('auth:sanctum')->prefix('boardMember')->controller(BoardComitteeMemberController::class)->group(function () {
    Route::post('store', 'store');
    Route::post('update', 'update');
    Route::delete('delete', 'delete');
    Route::get('list', 'index');
    Route::get('show', 'show');
});
Route::middleware('auth:sanctum')->prefix('additional/certificate')->controller(AdditionalCertificateController::class)->group(function () {
    Route::post('store', 'store');
    Route::post('update', 'update');
    Route::delete('delete', 'delete');
    Route::get('list', 'index');
    Route::get('show', 'show');
});

Route::middleware('auth:sanctum')->prefix('publications')->controller(PublicationController::class)->group(function () {
    Route::post('store', 'store');
    Route::post('update', 'update');
    Route::delete('delete', 'delete');
    Route::get('list', 'index');
    Route::get('show', 'show');
});
Route::middleware('auth:sanctum')->prefix('award')->controller(AwardController::class)->group(function () {
    Route::post('store', 'store');
    Route::post('update', 'update');
    Route::delete('delete', 'delete');
    Route::get('list', 'index');
    Route::get('show', 'show');
});

Route::middleware('auth:sanctum')->prefix('event')->controller(EventController::class)->group(function () {
    Route::get('data', 'geteventData');

});

Route::middleware('auth:sanctum')->prefix('library')->controller(ResourceLibraryController::class)->group(function () {
    Route::get('list', 'index');
});
Route::middleware('auth:sanctum')->prefix('communication')->controller(CommunicationController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('store', 'store');
    Route::post('update', 'update');
    Route::get('show', 'show');
});

Route::get('/email/verify/{id}/{hash}', [RegisterController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');
