<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use App\View\Composers\SharedDataComposer;
use Purifier;
use Illuminate\Support\Facades\Cache;

class WebsiteSettingController extends Controller
{
    // Show edit form
    public function edit()
    {
        $setting = WebsiteSetting::firstOrCreate([]); // ensure record exists
        return view('backend.settings.edit', compact('setting'));
    }

    // Update settings
    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'address' => 'nullable|string|max:1000',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'google_site_verification' => 'nullable|string|max:255',
            'copyright_text' => 'nullable|string|max:500',
            'location_map' => 'nullable|string|max:1000',
            'google_analytic' => 'nullable|string|max:500',
            'logo' => 'nullable|file|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'favicon' => 'nullable|file|mimes:jpg,jpeg,png,ico,webp|max:512',
        ]);

        // Base64 Decode multiple fields
        foreach (['phone', 'address', 'copyright_text', 'location_map', 'google_analytic'] as $field) {
            if (! empty($data[$field])) {
                $decoded = base64_decode($data[$field], true);

                if ($decoded !== false) {
                    if (in_array($field, ['phone', 'copyright_text', 'location_map', 'google_analytic'], true)) {
                        $data[$field] = $decoded;
                    } else {
                        $data[$field] = Purifier::clean($decoded);
                    }
                }
            }
        }

        // Never mass-assign uploaded files into string columns.
        unset($data['logo'], $data['favicon']);

        $setting = WebsiteSetting::firstOrFail();
        $setting->update($data);

        if ($request->hasFile('logo')) {
            $setting->clearMediaCollection('logo');
            $setting->addMedia($request->file('logo'))->toMediaCollection('logo');
            $setting->logo = null;
        }

        if ($request->hasFile('favicon')) {
            $setting->clearMediaCollection('favicon');
            $setting->addMedia($request->file('favicon'))->toMediaCollection('favicon');
            $setting->favicon = null;
        }

        if ($setting->isDirty(['logo', 'favicon'])) {
            $setting->save();
        }

        Cache::forget(SharedDataComposer::SETTING_CACHE_KEY);

        activity()->causedBy(auth()->user())->performedOn($setting)->withProperties($data)->event('updated')->log('Update website setting');

        return redirect()->back()->with('success', 'Website settings updated successfully!');
    }
}
