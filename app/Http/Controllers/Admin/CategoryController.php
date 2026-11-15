<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('talents')->orderBy('id', 'asc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'type' => 'nullable|string|max:50',
        ]);

        $slugBase = !empty($validated['slug']) ? $validated['slug'] : $validated['name'];
        $generatedSlug = Str::slug($slugBase);
        if (empty($generatedSlug)) {
            $generatedSlug = 'cat-' . time();
        }
        $validated['slug'] = $generatedSlug;
        $validated['type'] = $validated['type'] ?? 'talent';
        $validated['status'] = $request->has('status');

        Category::create($validated);

        toastr()->success('Category created successfully!');
        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'type' => 'nullable|string|max:50',
        ]);

        $slugBase = !empty($validated['slug']) ? $validated['slug'] : $validated['name'];
        $generatedSlug = Str::slug($slugBase);
        if (empty($generatedSlug)) {
            $generatedSlug = 'cat-' . $category->id;
        }
        $validated['slug'] = $generatedSlug;
        $validated['type'] = $validated['type'] ?? 'talent';
        $validated['status'] = $request->has('status');

        $category->update($validated);

        toastr()->success('Category updated successfully!');
        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        toastr()->success('Category deleted successfully!');
        return redirect()->route('admin.categories.index');
    }
}
