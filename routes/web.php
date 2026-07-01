<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\EmailSenderController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\HomeSliderController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\ForumChatController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\Backend\TypeController;





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
    // Khalid End




    Route::get('refresh-your-dtp', 'refresh_your_dtp')->name('refresh_your_dtp');
    Route::post('upload/refresh-your-dtp', 'uploadRefreshyourdtp')->name('uploadRefreshyourdtp');
    Route::get('writing', 'writing')->name('writing');
    Route::get('resource_library', 'resource_library')->name('resource_library');
    Route::get('/resource_library/{slug}', 'sectionShow')->name('section.show');
    //Route::get('forum', 'forum')->name('forum');


    Route::post('add/experience/list', 'addExperienceList')->name('addExperienceList');
    Route::post('save/experience', 'saveExperience')->name('saveExperience');
    Route::post('experience/list', 'experienceList')->name('experienceList');
    Route::post('experience/delete', 'experienceDelete')->name('experienceDelete');


    // directorship
    Route::post('add/directorship', 'saveDirector')->name('saveDirector');
    Route::post('directorList', 'directorList')->name('directorList');
    Route::post('directorDelete', 'directorDelete')->name('director.delete');

    // board of member
    Route::post('add/board', 'saveBoardMember')->name('saveBoardMember');
    Route::post('boardList', 'boardList')->name('boardList');
    Route::post('boardDelete', 'boardDelete')->name('board.data.delete');

    // saveAdditional
    Route::post('add/additional/certificate', 'saveAdditionCertificate')->name('saveAdditionCertificate');
    Route::post('/certificate/list', 'certificateList')->name('certificateList');
    Route::post('certificate/delete', 'certificateDelete')->name('certificate.data.delete');



    // for skills
    Route::post('skills', 'skills')->name('skills');
    Route::post('save/skill', 'saveSkill')->name('saveSkill');
    Route::post('delete/skill', 'deleteSkill')->name('deleteSkill');



    // publications 
    Route::post('save/publications', 'savePublications')->name('savePublications');
    Route::post('publications/list', 'publicationList')->name('publications.list');
    Route::post('publications/delete', 'publicationDelete')->name('publications.delete');


    // award

    Route::post('save/award', 'saveAward')->name('saveAward');
    Route::post('award/list', 'AwardList')->name('award.list');
    Route::post('award/delete', 'AwardDelete')->name('award.delete');


    Route::post('register', 'register')->name('user.register');
    Route::post('login', 'login')->name('user.login');
    Route::get('checkLogin', 'checkLogin')->name('checkLogin');
    Route::get('verify/email/{id}', 'verifyEmail')->name('verify.email');
    Route::get('picg/logout', 'logout')->name('logout');
    Route::post('forget/password', 'forgetPassword')->name('forget.password');
    Route::get('reset/password/{id}', 'resetPassword')->name('resetPassword');
    Route::post('update/password', 'updatePassword')->name('updatePassword');
});


Route::prefix('notifications/')->name('notifications.')->controller(NotificationsController::class)->group(function () {
    Route::post('show', 'showNotifications')->name('show');
});

Route::prefix('pay-fast')->name('payment.')->controller(PaymentController::class)->group(function () {
    Route::get('/payment', 'payment')->name('payment');
    Route::get('/success', 'success')->name('success');
    Route::get('/failure', 'failure')->name('failure');
    Route::get('/checkout', 'checkout')->name('checkout');
    Route::get('/paymentThroughEmail', 'paymentThroughEmail')->name('paymentThroughEmail');
});


Route::prefix('/profile')->name('profile.')->controller(ProfileController::class)->group(function () {
    Route::get('/', 'view')->name('view');
});


Route::prefix('/cv')->name('cv.')->controller(CVController::class)->group(function () {
    Route::get('/', 'view')->name('view');
    Route::get('/download/cv', 'downloadCV')->name('downloadCV');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//forum
Route::post('/forum/{id}/subscribe', [ForumController::class, 'subscribe'])->name('forum.subscribe');
Route::resource('forum', ForumController::class);

//forum chat 
Route::prefix('/forum')->controller(ForumChatController::class)->group(function () {
    Route::get('/{forum}/chat', 'showChatRoom')->name('forumChatRoom');
    Route::post('/{topic}/send', 'sendMessage')->name('sendMessage');
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
