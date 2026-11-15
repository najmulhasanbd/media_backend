<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CastingCall;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CastingCallController extends Controller
{
    public function index(): View
    {
        $calls = CastingCall::orderBy('order', 'asc')->orderBy('id', 'asc')->paginate(30);
        return view('admin.casting_calls.index', compact('calls'));
    }

    public function reorder(Request $request): \Illuminate\Http\JsonResponse
    {
        $orderList = $request->input('order', []);
        foreach ($orderList as $index => $id) {
            CastingCall::where('id', $id)->update(['order' => $index + 1]);
        }
        return response()->json(['success' => true, 'message' => 'Casting calls reordered successfully!']);
    }

    public function create(): View
    {
        return view('admin.casting_calls.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'project_type' => 'nullable|string|max:100',
            'roles' => 'nullable|string|max:255',
            'requirements' => 'nullable|string',
            'deadline' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'status' => 'required|string|in:open,closed',
        ]);

        $validated['order'] = (CastingCall::max('order') ?? 0) + 1;
        CastingCall::create($validated);

        toastr()->success('Casting call created successfully!');
        return redirect()->route('admin.casting-calls.index');
    }

    public function edit(CastingCall $castingCall): View
    {
        return view('admin.casting_calls.edit', compact('castingCall'));
    }

    public function update(Request $request, CastingCall $castingCall): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'project_type' => 'nullable|string|max:100',
            'roles' => 'nullable|string|max:255',
            'requirements' => 'nullable|string',
            'deadline' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'status' => 'required|string|in:open,closed',
        ]);

        $castingCall->update($validated);

        toastr()->success('Casting call updated successfully!');
        return redirect()->route('admin.casting-calls.index');
    }

    public function destroy(CastingCall $castingCall): RedirectResponse
    {
        $castingCall->delete();
        toastr()->success('Casting call deleted successfully!');
        return back();
    }
}
