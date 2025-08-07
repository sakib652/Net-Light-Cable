<?php

namespace App\Http\Controllers\admin;

use App\Models\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CounterController extends Controller
{
    // public function create()
    // {
    //     try {
    //         $counters = Counter::latest()->get();
    //         return view('admin.counters.create', compact('counters'));
    //     } catch (\Exception $e) {
    //         Log::error('Error displaying create counter page: ' . $e->getMessage());
    //         return back()->with('error', 'An error occurred while trying to load the create counter page. Please try again later.');
    //     }
    // }

    public function create(?Counter $counter = null)
    {
        try {
            $counters = Counter::latest()->get();
            return view('admin.counters.create', compact('counters', 'counter'));
        } catch (\Exception $e) {
            Log::error('Error displaying create counter page: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while trying to load the create counter page. Please try again later.');
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|integer',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            Counter::create([
                'title' => $request->title,
                'value' => $request->value,
                'icon' => $request->icon,
                'ip_address' => $request->ip(),
            ]);


            return redirect()->route('counters.create')->with('success', 'Counter created successfully.');
        } catch (\Exception $e) {
            Log::error('Error occurred while creating counter: ' . $e->getMessage());
            return back()->with('error', 'An unexpected error occurred while creating the counter. Please try again later.');
        }
    }

    // public function edit($id)
    // {
    //     try {
    //         $counter = Counter::findOrFail($id);
    //         return view('admin.counters.edit', compact('counter'));
    //     } catch (\Exception $e) {
    //         Log::error('Error fetching counter for editing: ' . $e->getMessage());
    //         return back()->with('error', 'An error occurred while fetching the counter. Please try again later.');
    //     }
    // }

    public function edit($id)
    {
        try {
            $counter = Counter::findOrFail($id);
            $counters = Counter::latest()->get();
            return view('admin.counters.create', compact('counter', 'counters'));
        } catch (\Exception $e) {
            Log::error('Error fetching counter for editing: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching the counter. Please try again later.');
        }
    }

    public function update(Request $request, $id)
    {

        try {
            $counter = Counter::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'value' => 'required|integer',
                'icon' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $counter->update([
                'title' => $request->title,
                'value' => $request->value,
                'icon' => $request->icon,
            ]);


            return redirect()->route('counters.create')->with('success', 'Counter updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error occurred while updating counter: ' . $e->getMessage());
            return back()->with('error', 'An unexpected error occurred while updating the counter. Please try again later.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $counter = Counter::findOrFail($id);

            $request->validate([
                'status' => 'required|in:a,d',
            ]);

            $counter->status = $request->status;
            $counter->save();

            return back()->with('success', 'Counter status updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error occurred while updating counter status: ' . $e->getMessage());
            return back()->with('error', 'An unexpected error occurred while updating the status. Please try again later.');
        }
    }


    public function destroy($id)
    {
        try {
            $counter = Counter::findOrFail($id);
            $counter->delete();

            return redirect()->route('counters.create')->with('success', 'Counter deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error occurred while deleting counter with ID ' . $id . ': ' . $e->getMessage());
            return redirect()->route('admin.counters.index')->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }
}
