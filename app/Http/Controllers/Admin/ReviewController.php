<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    use ImageUploadTrait;

    public function index(): View
    {
        $reviews = Review::orderBy('order', 'asc')->orderBy('id', 'asc')->paginate(30);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function reorder(Request $request): \Illuminate\Http\JsonResponse
    {
        $orderList = $request->input('order', []);
        foreach ($orderList as $index => $id) {
            Review::where('id', $id)->update(['order' => $index + 1]);
        }
        return response()->json(['success' => true, 'message' => 'Reviews reordered successfully!']);
    }

    public function create(): View
    {
        return view('admin.reviews.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'photo' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->uploadImage($request->file('photo'), 'uploads/reviews', 300, 300, 80, true);
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['status'] = $request->has('status');
        $validated['order'] = (Review::max('order') ?? 0) + 1;

        Review::create($validated);

        toastr()->success('Review created successfully!');
        return redirect()->route('admin.reviews.index');
    }

    public function edit(Review $review): View
    {
        return view('admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'photo' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->updateImage($request->file('photo'), $review->photo, 'uploads/reviews', 300, 300, 80, true);
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['status'] = $request->has('status');
        $validated['order'] = (Review::max('order') ?? 0) + 1;

        $review->update($validated);

        toastr()->success('Review updated successfully!');
        return redirect()->route('admin.reviews.index');
    }

    public function destroy(Review $review): RedirectResponse
    {
        $this->deleteImage($review->photo);
        $review->delete();

        toastr()->success('Review deleted successfully!');
        return back();
    }
}
