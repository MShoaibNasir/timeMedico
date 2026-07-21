<?php

namespace App\Observers;

use App\Models\Menu;
use App\View\Composers\SharedDataComposer;
use Illuminate\Support\Facades\Cache;

class MenuObserver
{
    /**
     * Kyunke menu record ka 'type' change ho sakta hai (jaise header se
     * footer mein move ho jaye), safest hai HAR menu-related cache key
     * clear kar dena jab bhi koi menu save/delete ho.
     */
    public function saved(Menu $menu): void
    {
        $this->clearAllMenuCaches();
    }

    public function deleted(Menu $menu): void
    {
        $this->clearAllMenuCaches();
    }

    protected function clearAllMenuCaches(): void
    {
        Cache::forget(SharedDataComposer::HEADER_MENU_CACHE_KEY);

        foreach (SharedDataComposer::FOOTER_MENU_CACHE_KEYS as $cacheKey => $menuType) {
            Cache::forget($cacheKey);
        }
    }
}