<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Department;
use App\Observers\CategoryObserver;
use App\Observers\DepartmentObserver;
use App\View\Composers\SharedDataComposer;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;




class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super_admin') ? true : null;
        });
        Schema::defaultStringLength(191);


        View::composer('*', SharedDataComposer::class);
        Department::observe(DepartmentObserver::class);
        Category::observe(CategoryObserver::class);

    }
}
