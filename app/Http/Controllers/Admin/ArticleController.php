<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    use ImageUploadTrait;

    public function index(Request $request): View
    {
        $query = Article::orderBy('order', 'asc')->orderBy('id', 'asc');
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        $articles = $query->paginate(30);
        $type = $request->type ?? 'all';
        return view('admin.articles.index', compact('articles', 'type'));
    }

    public function reorder(Request $request): \Illuminate\Http\JsonResponse
    {
        $orderList = $request->input('order', []);
        foreach ($orderList as $index => $id) {
            Article::where('id', $id)->update(['order' => $index + 1]);
        }
        return response()->json(['success' => true, 'message' => 'Articles reordered successfully!']);
    }

    public function create(Request $request): View
    {
        $selectedType = $request->type ?? 'director';
        return view('admin.articles.create', compact('selectedType'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:director,artist,opinion',
            'author_name' => 'required|string|max:255',
            'author_role' => 'nullable|string|max:255',
            'author_image' => 'nullable|image|max:5120',
            'image' => 'nullable|image|max:5120',
            'content' => 'required|string',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . time();

        if ($request->hasFile('author_image')) {
            $validated['author_image'] = $this->uploadImage($request->file('author_image'), 'uploads/authors', 300, 300, 80, true);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'), 'uploads/articles', 900, 500);
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['status'] = $request->has('status');
        $validated['order'] = (Article::max('order') ?? 0) + 1;

        Article::create($validated);

        toastr()->success('Article published successfully!');
        return redirect()->route('admin.articles.index', ['type' => $validated['type']]);
    }

    public function edit(Article $article): View
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:director,artist,opinion',
            'author_name' => 'required|string|max:255',
            'author_role' => 'nullable|string|max:255',
            'author_image' => 'nullable|image|max:5120',
            'image' => 'nullable|image|max:5120',
            'content' => 'required|string',
        ]);

        if ($request->hasFile('author_image')) {
            $validated['author_image'] = $this->updateImage($request->file('author_image'), $article->author_image, 'uploads/authors', 300, 300, 80, true);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $this->updateImage($request->file('image'), $article->image, 'uploads/articles', 900, 500);
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['status'] = $request->has('status');
        $validated['order'] = (Article::max('order') ?? 0) + 1;

        $article->update($validated);

        toastr()->success('Article updated successfully!');
        return redirect()->route('admin.articles.index', ['type' => $article->type]);
    }

    public function destroy(Article $article): RedirectResponse
    {
        $this->deleteImage($article->image);
        $this->deleteImage($article->author_image);
        $article->delete();

        toastr()->success('Article deleted successfully!');
        return back();
    }
}
