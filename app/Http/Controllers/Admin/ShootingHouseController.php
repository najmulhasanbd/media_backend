<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShootingHouse;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ShootingHouseController extends Controller
{
    use ImageUploadTrait;

    public function index(): View
    {
        $houses = ShootingHouse::orderBy('order', 'asc')->orderBy('id', 'asc')->paginate(30);
        return view('admin.shooting_houses.index', compact('houses'));
    }

    public function reorder(Request $request): \Illuminate\Http\JsonResponse
    {
        $orderList = $request->input('order', []);
        foreach ($orderList as $index => $id) {
            ShootingHouse::where('id', $id)->update(['order' => $index + 1]);
        }
        return response()->json(['success' => true, 'message' => 'Shooting houses reordered successfully!']);
    }

    public function create(): View
    {
        return view('admin.shooting_houses.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'rent' => 'nullable|string|max:100',
            'contact' => 'nullable|string|max:100',
            'facilities' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'), 'uploads/houses', 1200, 800);
        }

        $validated['status'] = $request->has('status');
        $validated['order'] = (ShootingHouse::max('order') ?? 0) + 1;

        ShootingHouse::create($validated);

        toastr()->success('Shooting house added successfully!');
        return redirect()->route('admin.shooting-houses.index');
    }

    public function edit(ShootingHouse $shootingHouse): View
    {
        return view('admin.shooting_houses.edit', compact('shootingHouse'));
    }

    public function update(Request $request, ShootingHouse $shootingHouse): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'rent' => 'nullable|string|max:100',
            'contact' => 'nullable|string|max:100',
            'facilities' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->updateImage($request->file('image'), $shootingHouse->image, 'uploads/houses', 1200, 800);
        }

        $validated['status'] = $request->has('status');
        $validated['order'] = (ShootingHouse::max('order') ?? 0) + 1;

        $shootingHouse->update($validated);

        toastr()->success('Shooting house updated successfully!');
        return redirect()->route('admin.shooting-houses.index');
    }

    public function destroy(ShootingHouse $shootingHouse): RedirectResponse
    {
        $this->deleteImage($shootingHouse->image);
        $shootingHouse->delete();

        toastr()->success('Shooting house deleted successfully!');
        return back();
    }
}
