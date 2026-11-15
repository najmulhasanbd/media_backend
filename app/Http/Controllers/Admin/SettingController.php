<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingController extends Controller
{
    use ImageUploadTrait;

    public function index(Request $request): View
    {
        $settings = Setting::pluck('value', 'key');
        $tab = $request->query('tab', 'brand');
        $user = auth()->user();

        return view('admin.settings.index', compact('settings', 'tab', 'user'));
    }

    public function update(Request $request): RedirectResponse
    {
        $fields = [
            'site_name',
            'site_tagline',
            'site_email',
            'site_phone',
            'site_whatsapp',
            'site_address',
            'showreel_url',
            'stat_projects',
            'stat_artists',
            'stat_films',
            'stat_satisfaction',
            'social_facebook',
            'social_instagram',
            'social_youtube',
            'social_vimeo',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::set($field, $request->input($field));
            }
        }

        // Handle Site Logo Upload
        if ($request->hasFile('site_logo')) {
            $logoPath = $this->uploadImage($request->file('site_logo'), 'uploads/settings', 600, 200);
            Setting::set('site_logo', $logoPath);
        }

        // Handle Favicon Upload
        if ($request->hasFile('site_favicon')) {
            $faviconPath = $this->uploadImage($request->file('site_favicon'), 'uploads/settings', 128, 128);
            Setting::set('site_favicon', $faviconPath);
        }

        toastr()->success('Site settings and branding updated successfully!');
        $activeTab = $request->input('active_tab', 'brand');
        return redirect()->route('admin.settings.index', ['tab' => $activeTab]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|max:5120',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            $user->avatar = $this->uploadImage($request->file('avatar'), 'uploads/avatars', 400, 400);
        }

        $user->save();

        toastr()->success('Admin profile credentials and photo updated successfully!');
        return redirect()->route('admin.settings.index', ['tab' => 'profile']);
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        toastr()->success('Account password updated successfully! Please use your new password next time you log in.');
        return redirect()->route('admin.settings.index', ['tab' => 'password']);
    }
}
