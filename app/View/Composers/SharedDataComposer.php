<?php

namespace App\View\Composers;

use App\Models\Category;
use App\Models\Department;
use App\Models\Menu;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SharedDataComposer
{
    public const DEPARTMENTS_CACHE_KEY = 'departments.active.latest';
    public const ALLCATEGORIES_CACHE_KEY  = 'allcategories.active.latest';
    public const CATEGORIES_CACHE_KEY  = 'categories.active.latest';
    public const SETTING_CACHE_KEY     = 'website.setting';
    public const HEADER_MENU_CACHE_KEY = 'menu.header.items';

    public const FOOTER_MENU_CACHE_KEYS = [
        'footer_menu_2' => Menu::TYPE_FOOTER_COLUMN_1,
        'footer_menu_3' => Menu::TYPE_FOOTER_COLUMN_2,
    ];

    public const CACHE_TTL_HOURS = 1;
    public const FOOTER_MENU_TTL_MINUTES = 60;

    /**
     * Departments, categories, website setting, header menu, aur footer
     * menus - sab EK hi '*' composer mein - taake wildcard sirf ek dafa
     * chale, alag-alag view-specific composers na banane padein.
     */
    public function compose(View $view): void
    {
        $departments = Cache::remember(
            self::DEPARTMENTS_CACHE_KEY,
            now()->addHours(self::CACHE_TTL_HOURS),
            fn () => Department::query()
                ->with(['categories' => fn ($q) => $q->where('status', 1)->latest()->limit(5)])
                ->where('status', 1)
                ->latest()
                ->take(10)
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

        $allcategories = Cache::remember(
            self::ALLCATEGORIES_CACHE_KEY,
            now()->addHours(self::CACHE_TTL_HOURS),
            fn () => Category::query()
                ->where('status', 1)
                ->get()
        );

        $setting = Cache::remember(
            self::SETTING_CACHE_KEY,
            now()->addHours(self::CACHE_TTL_HOURS),
            fn () => WebsiteSetting::firstOrCreate([], ['site_name' => config('app.name')])
        );

        $topMenus = Cache::remember(
            self::HEADER_MENU_CACHE_KEY,
            now()->addHours(self::CACHE_TTL_HOURS),
            fn () => Menu::query()
                ->whereNull('parent_id')
                ->with('children')
                ->where('type', Menu::TYPE_HEADER)
                ->active()
                ->orderBy('sorting')
                ->get()
        );

        $footerMenus = [];
        foreach (self::FOOTER_MENU_CACHE_KEYS as $cacheKey => $menuType) {
            $footerMenus[$cacheKey] = Cache::remember(
                $cacheKey,
                now()->addMinutes(self::FOOTER_MENU_TTL_MINUTES),
                fn () => Menu::query()
                    ->whereNull('parent_id')
                    ->where('type', $menuType)
                    ->active()
                    ->orderBy('sorting')
                    ->get()
            );
        }

        $view->with(compact('departments', 'allcategories', 'categories', 'setting', 'topMenus', 'footerMenus'));
    }
}