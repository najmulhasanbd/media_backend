<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Talent;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TalentController extends Controller
{
    use ImageUploadTrait;

    public function index(Request $request): View
    {
        $query = Talent::with('category')->orderBy('order', 'asc')->orderBy('id', 'asc');

        if ($request->filled('type') && $request->type === 'international') {
            $query->where('is_international', true);
        }

        $talents = $query->paginate(30);
        return view('admin.talents.index', compact('talents'));
    }

    public function reorder(Request $request): \Illuminate\Http\JsonResponse
    {
        $orderList = $request->input('order', []);
        foreach ($orderList as $index => $id) {
            Talent::where('id', $id)->update(['order' => $index + 1]);
        }
        return response()->json(['success' => true, 'message' => 'Talents reordered successfully!']);
    }

    public function create(): View
    {
        $categories = Category::where('status', true)->get();
        return view('admin.talents.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'specialty' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:50',
            'age' => 'nullable|string|max:50',
            'height' => 'nullable|string|max:50',
            'experience' => 'nullable|string|max:50',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:5120',
            'audition_url' => 'nullable|string|max:255',
            'portfolio_url' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->uploadImage($request->file('photo'), 'uploads/talents', 600, 800, 80, true);
        }

        $validated['is_international'] = $request->has('is_international');
        $validated['is_verified'] = $request->has('is_verified');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['status'] = $request->has('status');
        $validated['order'] = (Talent::max('order') ?? 0) + 1;

        Talent::create($validated);

        toastr()->success('Talent profile created successfully!');
        return redirect()->route('admin.talents.index');
    }

    public function edit(Talent $talent): View
    {
        $categories = Category::where('status', true)->get();
        return view('admin.talents.edit', compact('talent', 'categories'));
    }

    public function update(Request $request, Talent $talent): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'specialty' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:50',
            'age' => 'nullable|string|max:50',
            'height' => 'nullable|string|max:50',
            'experience' => 'nullable|string|max:50',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:5120',
            'audition_url' => 'nullable|string|max:255',
            'portfolio_url' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->updateImage($request->file('photo'), $talent->photo, 'uploads/talents', 600, 800, 80, true);
        }

        $validated['is_international'] = $request->has('is_international');
        $validated['is_verified'] = $request->has('is_verified');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['status'] = $request->has('status');
        $validated['order'] = (Talent::max('order') ?? 0) + 1;

        $talent->update($validated);

        toastr()->success('Talent profile updated successfully!');
        return redirect()->route('admin.talents.index');
    }

    public function destroy(Talent $talent): RedirectResponse
    {
        $this->deleteImage($talent->photo);
        $talent->delete();

        toastr()->success('Talent profile deleted successfully!');
        return back();
    }
}
