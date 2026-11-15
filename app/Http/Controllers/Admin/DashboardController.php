<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Article;
use App\Models\CastingCall;
use App\Models\Category;
use App\Models\HeroSlider;
use App\Models\Notice;
use App\Models\Review;
use App\Models\ShootingHouse;
use App\Models\Talent;
use App\Models\Video;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with real dynamic statistics.
     */
    public function index(): View
    {
        $stats = [
            'total_talents' => Talent::count(),
            'international_talents' => Talent::where('is_international', true)->count(),
            'verified_talents' => Talent::where('is_verified', true)->count(),
            'total_videos' => Video::count(),
            'casting_calls' => CastingCall::where('status', 'open')->count(),
            'total_calls' => CastingCall::count(),
            'shooting_houses' => ShootingHouse::count(),
            'articles' => Article::count(),
            'notices' => Notice::count(),
            'total_applications' => Application::count(),
            'pending_applications' => Application::where('status', 'pending')->count(),
            'shortlisted_applications' => Application::where('status', 'shortlisted')->count(),
            'approved_applications' => Application::where('status', 'approved')->count(),
            'reviews' => Review::count(),
            'sliders' => HeroSlider::count(),
        ];

        $latestApplications = Application::latest()->take(6)->get();
        $latestTalents = Talent::with('category')->latest()->take(6)->get();
        $activeCastingCalls = CastingCall::where('status', 'open')->latest()->take(3)->get();
        $featuredVideos = Video::where('status', true)->latest()->take(3)->get();
        $recentNotices = Notice::where('status', true)->latest()->take(3)->get();

        // Data for category chart
        $categories = Category::withCount('talents')->get();
        $categoryLabels = $categories->pluck('name')->toArray();
        $categoryCounts = $categories->pluck('talents_count')->toArray();

        // Data for video categories
        $videoCategories = [
            'Cinema' => Video::where('category', 'cinema')->count(),
            'TVC' => Video::where('category', 'tvc')->count(),
            'Drama' => Video::where('category', 'drama')->count(),
            'Music' => Video::where('category', 'music')->count(),
            'OTT' => Video::where('category', 'ott')->count(),
        ];

        return view('admin.dashboard', compact(
            'stats',
            'latestApplications',
            'latestTalents',
            'activeCastingCalls',
            'featuredVideos',
            'recentNotices',
            'categoryLabels',
            'categoryCounts',
            'videoCategories'
        ));
    }
}
