<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class HeroSliderController extends Controller
{
    use ImageUploadTrait;

    public function index(): View
    {
        $sliders = HeroSlider::orderBy('order', 'asc')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create(): View
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'badge' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'btn_text_1' => 'nullable|string|max:100',
            'btn_url_1' => 'nullable|string|max:255',
            'btn_text_2' => 'nullable|string|max:100',
            'btn_url_2' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'), 'uploads/sliders', 1920, 1080);
        }

        $validated['order'] = (HeroSlider::max('order') ?? 0) + 1;
        $validated['status'] = $request->has('status');

        HeroSlider::create($validated);

        toastr()->success('Hero slider created successfully!');
        return redirect()->route('admin.sliders.index');
    }

    public function reorder(Request $request): \Illuminate\Http\JsonResponse
    {
        $orderList = $request->input('order', []);
        foreach ($orderList as $index => $id) {
            HeroSlider::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Slider order updated successfully via drag and drop!'
        ]);
    }

    public function edit(HeroSlider $slider): View
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, HeroSlider $slider): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'badge' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'btn_text_1' => 'nullable|string|max:100',
            'btn_url_1' => 'nullable|string|max:255',
            'btn_text_2' => 'nullable|string|max:100',
            'btn_url_2' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->updateImage($request->file('image'), $slider->image, 'uploads/sliders', 1920, 1080);
        }

        $validated['status'] = $request->has('status');

        $slider->update($validated);

        toastr()->success('Hero slider updated successfully!');
        return redirect()->route('admin.sliders.index');
    }

    public function destroy(HeroSlider $slider): RedirectResponse
    {
        $this->deleteImage($slider->image);
        $slider->delete();

        toastr()->success('Hero slider deleted successfully!');
        return back();
    }
}
