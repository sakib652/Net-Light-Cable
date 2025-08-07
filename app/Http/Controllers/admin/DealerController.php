<?php

namespace App\Http\Controllers\admin;

use App\Models\Dealer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class DealerController extends Controller
{

    public function index()
    {
        try {
            $dealers = Dealer::latest()->get();
            return view('admin.dealers.index', compact('dealers'));
        } catch (\Exception $e) {
            Log::error('Error loading dealer index page: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')->with('error', 'An unexpected error occurred.');
        }
    }

    public function view()
    {
        try {
            $dealers = Dealer::where('status', 'a')->latest()->get();
            return view('frontend.pages.dealers', compact('dealers'));
        } catch (\Exception $e) {
            Log::error('Error fetching dealers: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'An error occurred while fetching the dealer. Please try again later.');
        }
    }


    public function create()
    {
        try {
            $dealers = Dealer::latest()->get();
            return view('admin.dealers.create', compact('dealers'));
        } catch (\Exception $e) {
            Log::error('Error displaying create dealer page: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading the form.');
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
        ]);

        try {

            Dealer::create([
                'name' => $request->name,
                'description' => $request->description,
                'ip_address' => $request->ip(),
                'status' => 'a',
            ]);

            return redirect()->route('dealer.create')->with('success', 'Dealer created successfully.');
        } catch (\Exception $e) {
            Log::error('Error storing dealer: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while saving the dealer.');
        }
    }

    public function edit($id)
    {
        try {
            $dealer = Dealer::findOrFail($id);

            return view('admin.dealers.edit', compact('dealer'));
        } catch (\Exception $e) {
            Log::error('Error loading dealer edit form: ' . $e->getMessage());
            return back()->with('error', 'Could not load dealer.');
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $dealer = Dealer::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:2000',
            ]);

            $dealer->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return redirect()->route('dealer.create')->with('success', 'Dealer updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating dealer: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while updating.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $dealer = Dealer::findOrFail($id);

            $request->validate([
                'status' => 'required|in:a,d',
            ]);

            $dealer->status = $request->status;
            $dealer->save();

            return back()->with('success', 'Status updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating dealer status: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while updating status.');
        }
    }

    public function destroy($id)
    {
        try {
            $dealer = Dealer::findOrFail($id);

            $dealer->delete();

            return redirect()->route('dealer.create')->with('success', 'Dealer deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting dealer: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while deleting.');
        }
    }
}