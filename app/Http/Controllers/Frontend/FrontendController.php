<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Article;
use App\Models\CastingCall;
use App\Models\Category;
use App\Models\Faq;
use App\Models\HeroSlider;
use App\Models\Notice;
use App\Models\Review;
use App\Models\Setting;
use App\Models\ShootingHouse;
use App\Models\Talent;
use App\Models\Video;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FrontendController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display the dynamic frontend homepage.
     */
    public function index(): View
    {
        $heroSliders = HeroSlider::where('status', true)->orderBy('order', 'asc')->get();
        $talents = Talent::with('category')->where('status', true)->where('is_featured', true)->latest()->take(8)->get();
        $categories = Category::where('status', true)->get();
        $castingCalls = CastingCall::where('status', 'open')->latest()->take(6)->get();
        $videos = Video::where('status', true)->where('is_featured', true)->latest()->take(6)->get();
        $shootingHouses = ShootingHouse::where('status', true)->latest()->take(4)->get();
        $articles = Article::where('status', true)->latest()->take(6)->get();
        $notices = Notice::where('status', true)->orderBy('is_pinned', 'desc')->latest()->take(5)->get();
        $reviews = Review::where('status', true)->where('is_featured', true)->latest()->take(6)->get();
        $faqs = Faq::where('status', true)->orderBy('order', 'asc')->get();
        $settings = Setting::pluck('value', 'key');

        return view('frontend.index', compact(
            'heroSliders',
            'talents',
            'categories',
            'castingCalls',
            'videos',
            'shootingHouses',
            'articles',
            'notices',
            'reviews',
            'faqs',
            'settings'
        ));
    }

    /**
     * Display talent profiles page.
     */
    public function profiles(Request $request): View
    {
        $query = Talent::with('category')->where('status', true)->latest();

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('specialty', 'like', '%' . $request->search . '%');
            });
        }

        $talents = $query->paginate(12);
        $categories = Category::where('status', true)->get();

        return view('frontend.pages.profiles', compact('talents', 'categories'));
    }

    /**
     * Display international artists.
     */
    public function internationalArtists(): View
    {
        $talents = Talent::with('category')->where('is_international', true)->where('status', true)->latest()->paginate(12);
        return view('frontend.pages.international_artists', compact('talents'));
    }

    /**
     * Display video portfolio.
     */
    public function videos(Request $request): View
    {
        $query = Video::where('status', true)->latest();
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
        $videos = $query->paginate(12);
        return view('frontend.pages.videos', compact('videos'));
    }

    /**
     * Display shooting houses.
     */
    public function shootingHouses(): View
    {
        $houses = ShootingHouse::where('status', true)->latest()->paginate(9);
        return view('frontend.pages.shooting_houses', compact('houses'));
    }

    /**
     * Display official notices.
     */
    public function notices(): View
    {
        $notices = Notice::where('status', true)->orderBy('is_pinned', 'desc')->latest()->paginate(10);
        return view('frontend.pages.notices', compact('notices'));
    }

    /**
     * Display directors diary.
     */
    public function directorsDiary(): View
    {
        $articles = Article::where('type', 'director')->where('status', true)->latest()->paginate(9);
        return view('frontend.pages.directors_diary', compact('articles'));
    }

    /**
     * Display artists diary.
     */
    public function artistsDiary(): View
    {
        $articles = Article::where('type', 'artist')->where('status', true)->latest()->paginate(9);
        return view('frontend.pages.artists_diary', compact('articles'));
    }

    /**
     * Display opinions.
     */
    public function opinions(): View
    {
        $articles = Article::where('type', 'opinion')->where('status', true)->latest()->paginate(9);
        return view('frontend.pages.opinions', compact('articles'));
    }

    /**
     * Display client & artist reviews.
     */
    public function reviews(): View
    {
        $reviews = Review::where('status', true)->latest()->paginate(12);
        return view('frontend.pages.reviews', compact('reviews'));
    }

    /**
     * Handle frontend profile / audition submission.
     */
    public function apply(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'gender' => 'nullable|string|max:50',
            'age' => 'nullable|string|max:50',
            'height' => 'nullable|string|max:50',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'portfolio_url' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:5120',
            'bio' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->uploadImage($request->file('photo'), 'uploads/applications', 600, 800, 80, true);
        }

        Application::create($validated);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'আপনার আবেদনটি সফলভাবে জমা নেওয়া হয়েছে! আমাদের কাস্টিং টিম শীঘ্রই আপনার সাথে যোগাযোগ করবে।'
            ]);
        }

        toastr()->success('আপনার আবেদনটি সফলভাবে জমা নেওয়া হয়েছে! আমাদের কাস্টিং টিম শীঘ্রই আপনার সাথে যোগাযোগ করবে।');
        return back();
    }
}
