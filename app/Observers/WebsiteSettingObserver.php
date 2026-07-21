<?php

namespace App\Observers;

use App\Models\WebsiteSetting;
use App\View\Composers\SharedDataComposer;
use Illuminate\Support\Facades\Cache;

class WebsiteSettingObserver
{
    public function saved(WebsiteSetting $setting): void
    {
        Cache::forget(SharedDataComposer::SETTING_CACHE_KEY);
    }
}