<?php

namespace App\Http\Controllers\admin;

use App\Models\Area;
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
            $dealers = Dealer::with('area')->latest()->get();

            return view('admin.dealers.index', compact('dealers'));
        } catch (\Exception $e) {
            Log::error('Error loading dealer index page: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'An unexpected error occurred.');
        }
    }

    public function view()
    {
        try {
            $dealers = Dealer::with('area')->where('status', 'a')->latest()->get();
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
            $areas = Area::orderBy('name')->get();
            return view('admin.dealers.create', compact('dealers', 'areas'));
        } catch (\Exception $e) {
            Log::error('Error displaying create dealer page: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading the form.');
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'org_name' => 'required|string|max:255',
            'area_id' => 'nullable|exists:areas,id',
            'owner_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:2000',
        ]);

        try {
            Dealer::create([
                'org_name' => $request->org_name,
                'area_id' => $request->area_id,
                'owner_name' => $request->owner_name,
                'phone' => $request->phone,
                'address' => $request->address,
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
            $areas = Area::all();

            return view('admin.dealers.edit', compact('dealer', 'areas'));
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
                'org_name' => 'required|string|max:255',
                'area_id' => 'nullable|exists:areas,id',
                'owner_name' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:2000',
            ]);

            $dealer->update([
                'org_name' => $request->org_name,
                'area_id' => $request->area_id,
                'owner_name' => $request->owner_name,
                'phone' => $request->phone,
                'address' => $request->address,
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
