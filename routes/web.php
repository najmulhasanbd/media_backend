<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/profiles', [FrontendController::class, 'profiles'])->name('profiles');
Route::get('/international-artists', [FrontendController::class, 'internationalArtists'])->name('international.artists');
Route::get('/videos', [FrontendController::class, 'videos'])->name('videos');
Route::get('/shooting-houses', [FrontendController::class, 'shootingHouses'])->name('shooting.houses');
Route::get('/notices', [FrontendController::class, 'notices'])->name('notices');
Route::get('/directors-diary', [FrontendController::class, 'directorsDiary'])->name('directors.diary');
Route::get('/artists-diary', [FrontendController::class, 'artistsDiary'])->name('artists.diary');
Route::get('/opinions', [FrontendController::class, 'opinions'])->name('opinions');
Route::get('/reviews', [FrontendController::class, 'reviews'])->name('reviews');

// Public Audition Application submission
Route::post('/apply', [FrontendController::class, 'apply'])->name('apply');

// Dashboard redirect to Admin
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return redirect()->route('admin.settings.index', ['tab' => 'profile']);
    })->name('profile.edit');
});

require __DIR__.'/auth.php';
