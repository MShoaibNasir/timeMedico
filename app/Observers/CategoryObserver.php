<?php

namespace App\Observers;

use App\Models\Category;
use App\View\Composers\SharedDataComposer;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    /**
     * NOTE: Departments cache ke andar ab categories bhi eager-load
     * hoti hain (Department::with('categories')), is liye category
     * change hone par DEPARTMENTS cache bhi clear karni zaroori hai,
     * warna departments cache stale/purani categories dikhati rahegi.
     */
    public function saved(Category $category): void
    {
        Cache::forget(SharedDataComposer::CATEGORIES_CACHE_KEY);
        Cache::forget(SharedDataComposer::DEPARTMENTS_CACHE_KEY);
    }

    public function deleted(Category $category): void
    {
        Cache::forget(SharedDataComposer::CATEGORIES_CACHE_KEY);
        Cache::forget(SharedDataComposer::DEPARTMENTS_CACHE_KEY);
    }
}