<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ApplicationController extends Controller
{
    use ImageUploadTrait;

    public function index(Request $request): View
    {
        $query = Application::latest();
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $applications = $query->paginate(15);
        return view('admin.applications.index', compact('applications'));
    }

    public function show(Application $application): View
    {
        return view('admin.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, Application $application): RedirectResponse
    {
        $request->validate(['status' => 'required|in:pending,shortlisted,approved,rejected']);
        $application->update(['status' => $request->status]);

        toastr()->success('Application status updated successfully!');
        return back();
    }

    public function destroy(Application $application): RedirectResponse
    {
        $this->deleteImage($application->photo);
        $application->delete();

        toastr()->success('Application deleted successfully!');
        return redirect()->route('admin.applications.index');
    }
}
