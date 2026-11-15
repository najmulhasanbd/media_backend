<?php

use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CastingCallController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShootingHouseController;
use App\Http\Controllers\Admin\TalentController;
use App\Http\Controllers\Admin\VideoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Hero Sliders
    Route::post('sliders/reorder', [HeroSliderController::class, 'reorder'])->name('sliders.reorder');
    Route::resource('sliders', HeroSliderController::class);

    // Talents & Artists
    Route::post('talents/reorder', [TalentController::class, 'reorder'])->name('talents.reorder');
    Route::resource('talents', TalentController::class);
    Route::resource('categories', CategoryController::class);

    // Casting Calls
    Route::post('casting-calls/reorder', [CastingCallController::class, 'reorder'])->name('casting-calls.reorder');
    Route::resource('casting-calls', CastingCallController::class);

    // Video Portfolio
    Route::post('videos/reorder', [VideoController::class, 'reorder'])->name('videos.reorder');
    Route::resource('videos', VideoController::class);

    // Shooting Houses
    Route::post('shooting-houses/reorder', [ShootingHouseController::class, 'reorder'])->name('shooting-houses.reorder');
    Route::resource('shooting-houses', ShootingHouseController::class);

    // Articles / Diaries / Opinions
    Route::post('articles/reorder', [ArticleController::class, 'reorder'])->name('articles.reorder');
    Route::resource('articles', ArticleController::class);

    // Notices
    Route::post('notices/reorder', [NoticeController::class, 'reorder'])->name('notices.reorder');
    Route::resource('notices', NoticeController::class);

    // Reviews
    Route::post('reviews/reorder', [ReviewController::class, 'reorder'])->name('reviews.reorder');
    Route::resource('reviews', ReviewController::class);

    // FAQs (Homepage Accordion)
    Route::post('faqs/reorder', [FaqController::class, 'reorder'])->name('faqs.reorder');
    Route::resource('faqs', FaqController::class);

    // Audition Applications
    Route::get('applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::patch('applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');
    Route::delete('applications/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy');

    // System Cache Clear
    Route::get('clear-cache', function () {
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        toastr()->success('All application and view caches cleared successfully!');
        return back();
    })->name('clear-cache');

    // Settings & Profile Management
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::post('settings/profile', [SettingController::class, 'updateProfile'])->name('settings.profile');
    Route::post('settings/password', [SettingController::class, 'updatePassword'])->name('settings.password');
});
