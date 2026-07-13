<?php

namespace App\View\Composers;

use App\Models\Category;
use App\Models\Department;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SharedDataComposer
{
    public const DEPARTMENTS_CACHE_KEY = 'departments.active.latest';
    public const CATEGORIES_CACHE_KEY  = 'categories.active.latest';
    public const CACHE_TTL_HOURS = 1;

    /**
     * Dono departments aur categories ek hi composer mein bind kar diye,
     * taake '*' wildcard sirf EK dafa chale, do baar nahi.
     */
    public function compose(View $view): void
    {
        $departments = Cache::remember(
            self::DEPARTMENTS_CACHE_KEY,
            now()->addHours(self::CACHE_TTL_HOURS),
            fn () => Department::query()
                ->with(['categories' => fn ($query) => $query->where('status', 1)->latest()->take(5)])
                ->where('status', 1)
                ->latest()
                ->take(8)
                ->get()
        );

        $categories = Cache::remember(
            self::CATEGORIES_CACHE_KEY,
            now()->addHours(self::CACHE_TTL_HOURS),
            fn () => Category::query()
                ->where('status', 1)
                ->latest()
                ->take(8)
                ->get()
        );

        $view->with(compact('departments', 'categories'));
    }
}