<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;use Illuminate\Http\Request;use Illuminate\Support\Facades\Validator;

class SiteSettingController extends Controller
{
        public function index()
        {
            $siteSettings = SiteSetting::where('id', 1)->first();
            return view('admin.pages.otherSetting.siteSetting', compact('siteSettings'));
        }

        public function createOrUpdate(Request $request, $id = null)
        {
            // Validation rules
            $rules = [
                'name' => 'nullable',
                'title' => 'nullable',
                'meta_description' => 'nullable',
                'favicon' => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:5120', // Adjust max file size as needed
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:5120', // Adjust max file size as needed
                'site_preview_image' => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:5120', // Adjust max file size as needed
                'email' => 'nullable|email',
                'phone' => 'nullable',
                'address' => 'nullable',
                'short_description' => 'nullable',
                'site_link' => 'nullable',
                'facebook_link' => 'nullable|url',
                'twitter_link' => 'nullable|url',
                'linkedin_link' => 'nullable|url',
                'instagram_link' => 'nullable|url',
                'youtube_link' => 'nullable|url',
                'customize_logo' => 'nullable',
                'customize_link' => 'nullable',
                'bulk_order_logo' => 'nullable',
            ];

            // Validate the request data
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Check if the setting with the provided ID exists
            if ($id) {
                $setting = SiteSetting::findOrFail($id);
                $setting->update($request->except(['favicon', 'logo', 'site_preview_image','customize_logo','bulk_order_logo'])); // Exclude image fields from update
            } else {
                // If no ID provided, create a new setting
                $setting = new SiteSetting($request->except(['favicon', 'logo', 'site_preview_image','customize_logo','bulk_order_logo'])); // Exclude image fields from creation
            }

            // Handle favicon upload
            if ($request->hasFile('favicon')) {
                $faviconName = time().'.'.$request->file('favicon')->extension();
                $request->file('favicon')->move(public_path('images/favicons'), $faviconName);
                $setting->favicon = 'images/favicons/'.$faviconName;
            }

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $logoName = time().'.'.$request->file('logo')->extension();
                $request->file('logo')->move(public_path('images/logos'), $logoName);
                $setting->logo = 'images/logos/'.$logoName;
            }

            // Handle logo upload
            if ($request->hasFile('site_preview_image')) {
                $previewName = time().'.'.$request->file('site_preview_image')->extension();
                $request->file('site_preview_image')->move(public_path('images/site_preview_image'), $previewName);
                $setting->site_preview_image = 'images/site_preview_image/'.$previewName;
            }


            // Handle customize logo upload
            if ($request->hasFile('customize_logo')) {
                $previewName = time().'.'.$request->file('customize_logo')->extension();
                $request->file('customize_logo')->move(public_path('images/customize_logo'), $previewName);
                $setting->customize_logo = 'images/customize_logo/'.$previewName;
            }


            // Handle bulk order logo upload
            if ($request->hasFile('bulk_order_logo')) {
                $previewName = time().'.'.$request->file('bulk_order_logo')->extension();
                $request->file('bulk_order_logo')->move(public_path('images/bulk_order_logo'), $previewName);
                $setting->bulk_order_logo = 'images/bulk_order_logo/'.$previewName;
            }

            $setting->save();
            $message = $id ? 'Site settings updated successfully!' : 'Site settings created successfully!';
            return redirect()->back()->with('success', $message);
        }
}
