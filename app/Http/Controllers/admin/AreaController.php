<?php

namespace App\Http\Controllers\admin;

use App\Models\Area;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    public function index()
    {
        try {
            $areas = Area::latest()->get();
            return view('admin.areas.index', compact('areas'));
        } catch (\Exception $e) {
            Log::error('Error occurred while loading the areas index page: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }

    public function create(?Area $area = null)
    {
        try {
            $areas = Area::latest()->get();
            return view('admin.areas.create', compact('areas', 'area'));
        } catch (\Exception $e) {
            Log::error('Error displaying create areas page: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while trying to load the create areas page. Please try again later.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {

            Area::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'ip_address' => $request->ip(),
            ]);

            return redirect()->route('areas.create')->with('success', 'Area created successfully.');
        } catch (\Exception $e) {
            Log::error('Error occurred while creating area: ' . $e->getMessage());
            return back()->with('error', 'An unexpected error occurred while area the category. Please try again later.');
        }
    }

    public function edit($id)
    {
        try {
            $area = Area::findOrFail($id);
            $areas = Area::latest()->get();
            return view('admin.areas.create', compact('area', 'areas'));
        } catch (\Exception $e) {
            Log::error('Error fetching category for editing: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching the category. Please try again later.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $area = Area::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $area->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);

            return redirect()->route('areas.create')->with('success', 'Area updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error occurred while updating area: ' . $e->getMessage());
            return back()->with('error', 'An unexpected error occurred while updating the area. Please try again later.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $area = Area::findOrFail($id);

            $request->validate([
                'status' => 'required|in:a,d',
            ]);

            $area->status = $request->status;
            $area->save();

            return back()->with('success', 'Area status updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error occurred while updating area status: ' . $e->getMessage());
            return back()->with('error', 'An unexpected error occurred while updating the status. Please try again later.');
        }
    }

    public function destroy($id)
    {
        try {
            $area = Area::findOrFail($id);

            $area->delete();

            return redirect()->route('areas.create')->with('success', 'Area deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error occurred while deleting area with ID ' . $id . ': ' . $e->getMessage());
            return redirect()->route('categories.create')->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }
}
