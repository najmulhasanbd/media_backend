<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class NoticeController extends Controller
{
    public function index(): View
    {
        $notices = Notice::orderBy('order', 'asc')->orderBy('id', 'asc')->paginate(30);
        return view('admin.notices.index', compact('notices'));
    }

    public function reorder(Request $request): \Illuminate\Http\JsonResponse
    {
        $orderList = $request->input('order', []);
        foreach ($orderList as $index => $id) {
            Notice::where('id', $id)->update(['order' => $index + 1]);
        }
        return response()->json(['success' => true, 'message' => 'Notices reordered successfully!']);
    }

    public function create(): View
    {
        return view('admin.notices.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'nullable|string|max:100',
            'description' => 'required|string',
        ]);

        $validated['is_pinned'] = $request->has('is_pinned');
        $validated['status'] = $request->has('status');
        $validated['order'] = (Notice::max('order') ?? 0) + 1;

        Notice::create($validated);

        toastr()->success('Notice created successfully!');
        return redirect()->route('admin.notices.index');
    }

    public function edit(Notice $notice): View
    {
        return view('admin.notices.edit', compact('notice'));
    }

    public function update(Request $request, Notice $notice): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'nullable|string|max:100',
            'description' => 'required|string',
        ]);

        $validated['is_pinned'] = $request->has('is_pinned');
        $validated['status'] = $request->has('status');
        $validated['order'] = (Notice::max('order') ?? 0) + 1;

        $notice->update($validated);

        toastr()->success('Notice updated successfully!');
        return redirect()->route('admin.notices.index');
    }

    public function destroy(Notice $notice): RedirectResponse
    {
        $notice->delete();
        toastr()->success('Notice deleted successfully!');
        return back();
    }
}
