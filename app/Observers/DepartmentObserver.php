<?php

namespace App\Observers;

use App\Models\Department;
use App\View\Composers\SharedDataComposer;
use Illuminate\Support\Facades\Cache;

class DepartmentObserver
{
    /**
     * Cache sirf tab clear hogi jab koi department actually
     * create/update/delete ho — har request par nahi.
     */
    public function saved(Department $department): void
    {
        Cache::forget(SharedDataComposer::DEPARTMENTS_CACHE_KEY);
    }

    public function deleted(Department $department): void
    {
        Cache::forget(SharedDataComposer::DEPARTMENTS_CACHE_KEY);
    }
}