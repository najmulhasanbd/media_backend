<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FaqController extends Controller
{
    public function index(): View
    {
        $faqs = Faq::orderBy('order', 'asc')->orderBy('id', 'asc')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function reorder(Request $request): \Illuminate\Http\JsonResponse
    {
        $orderList = $request->input('order', []);
        foreach ($orderList as $index => $id) {
            Faq::where('id', $id)->update(['order' => $index + 1]);
        }
        return response()->json(['success' => true, 'message' => 'FAQs reordered successfully!']);
    }

    public function create(): View
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
        ]);

        $validated['status'] = $request->has('status');
        $validated['order'] = (Faq::max('order') ?? 0) + 1;

        Faq::create($validated);

        toastr()->success('FAQ created successfully!');
        return redirect()->route('admin.faqs.index');
    }

    public function edit(Faq $faq): View
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
        ]);

        $validated['status'] = $request->has('status');

        $faq->update($validated);

        toastr()->success('FAQ updated successfully!');
        return redirect()->route('admin.faqs.index');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();
        toastr()->success('FAQ deleted successfully!');
        return redirect()->route('admin.faqs.index');
    }
}
