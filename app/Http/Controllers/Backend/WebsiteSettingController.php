<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use Purifier;
use Illuminate\Support\Facades\Storage;

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
            'address' => 'nullable|string|max:255',
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
            'favicon' => 'nullable|file|mimes:png,ico|max:512',
        ]);
        
        //Base64 Decode multiple fields
        foreach (['phone', 'address', 'copyright_text', 'location_map', 'google_analytic'] as $field) {
            if (!empty($data[$field])) {
                $decoded = base64_decode($data[$field], true);

                if ($decoded !== false) {
                    // Agar field 'phone' ya 'address' ho toh direct decoded value rakhein, baki sab ko purify karein
                    if (in_array($field, ['phone', 'copyright_text', 'location_map', 'google_analytic'])) {
                        $data[$field] = $decoded;
                    } else {
                        $data[$field] = Purifier::clean($decoded);
                    }
                }
            }
        }
            
        //dd($data);

        $setting = WebsiteSetting::firstOrFail();
        $setting->update($data);
		
		if ($request->hasFile('logo')) {	
		$setting->clearMediaCollection('logo');
		$setting->addMedia($request->file('logo'))->toMediaCollection('logo');
		}
		
		if ($request->hasFile('favicon')) {	
		$setting->clearMediaCollection('favicon');
		$setting->addMedia($request->file('favicon'))->toMediaCollection('favicon');
		}
		
         activity()->causedBy(auth()->user())->performedOn($setting)->withProperties($data)->event('updated')->log('Update website setting');
		 
         return redirect()->back()->with('success', 'Website settings updated successfully!');
    }
}
