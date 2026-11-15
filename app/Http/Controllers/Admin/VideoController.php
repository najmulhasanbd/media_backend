<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class VideoController extends Controller
{
    use ImageUploadTrait;

    public function index(): View
    {
        $videos = Video::orderBy('order', 'asc')->orderBy('id', 'asc')->paginate(30);
        return view('admin.videos.index', compact('videos'));
    }

    public function reorder(Request $request): \Illuminate\Http\JsonResponse
    {
        $orderList = $request->input('order', []);
        foreach ($orderList as $index => $id) {
            Video::where('id', $id)->update(['order' => $index + 1]);
        }
        return response()->json(['success' => true, 'message' => 'Videos reordered successfully!']);
    }

    public function create(): View
    {
        return view('admin.videos.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'director' => 'nullable|string|max:255',
            'client' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:50',
            'youtube_url' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $this->uploadImage($request->file('thumbnail'), 'uploads/videos', 800, 450);
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['status'] = $request->has('status');
        $validated['order'] = (Video::max('order') ?? 0) + 1;

        Video::create($validated);

        toastr()->success('Video added successfully!');
        return redirect()->route('admin.videos.index');
    }

    public function edit(Video $video): View
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'director' => 'nullable|string|max:255',
            'client' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:50',
            'youtube_url' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $this->updateImage($request->file('thumbnail'), $video->thumbnail, 'uploads/videos', 800, 450);
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['status'] = $request->has('status');
        $validated['order'] = (Video::max('order') ?? 0) + 1;

        $video->update($validated);

        toastr()->success('Video updated successfully!');
        return redirect()->route('admin.videos.index');
    }

    public function destroy(Video $video): RedirectResponse
    {
        $this->deleteImage($video->thumbnail);
        $video->delete();

        toastr()->success('Video deleted successfully!');
        return back();
    }
}
