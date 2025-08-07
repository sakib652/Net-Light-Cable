<?php

namespace App\Http\Controllers\admin;

use App\Models\Management;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class ManagementController extends Controller
{
    public function index()
    {
        try {
            $management = Management::latest()->get();
            return view('admin.management.index', compact('management'));
        } catch (\Exception $e) {
            Log::error('Error occurred while loading the management index page: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }

    public function view(Request $request)
    {
        try {
            $type = $request->query('type', 'management');

            if (!in_array($type, ['management', 'employee'])) {
                $type = 'management';
            }

            $management = Management::where('status', 'a')
                ->where('type', $type)
                ->latest()
                ->get();

            return view('frontend.pages.our-team', compact('management', 'type'));
        } catch (\Exception $e) {
            Log::error('Error fetching management: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'An error occurred while fetching the management. Please try again later.');
        }
    }


    public function create()
    {
        try {
            $management = Management::latest()->get();
            return view('admin.management.create', compact('management'));
        } catch (\Exception $e) {
            Log::error('Error displaying create management page: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while trying to load the create management page. Please try again later.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:management,email',
            'type' => 'required|in:management,employee',
            'facebook_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
        ]);

        try {
            $imagePath = 'uploads/no_images/no-image.png';

            if ($request->hasFile('image')) {
                $imageFile = $request->file('image');
                $imageName = now()->format('Ymd') . rand(1000, 9999) . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('uploads/management'), $imageName);
                $imagePath = 'uploads/management/' . $imageName;
            }

            Management::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'image' => $imagePath,
                'phone' => $request->phone,
                'email' => $request->email,
                'type' => $request->type,
                'facebook_link' => $request->facebook_link,
                'linkedin_link' => $request->linkedin_link,
                'twitter_link' => $request->twitter_link,
                'ip_address' => $request->ip(),
                'status' => 'a',
            ]);

            return redirect()->route('management.create')->with('success', 'Member created successfully.');
        } catch (\Exception $e) {
            Log::error('Error occurred while creating management member: ' . $e->getMessage());
            return back()->with('error', 'An unexpected error occurred while creating the management member. Please try again later.');
        }
    }

    public function edit($id)
    {
        try {
            $management = Management::findOrFail($id);
            return view('admin.management.edit', compact('management'));
        } catch (\Exception $e) {
            Log::error('Error fetching management member for editing: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching the management member. Please try again later.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $management = Management::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'phone' => 'nullable|string|max:255',
                'email' => 'nullable|email|unique:management,email,' . $id,
                'type' => 'required|in:management,employee',
            ]);

            $imagePath = $management->image;

            if ($request->hasFile('image')) {
                if (
                    $management->image &&
                    $management->image !== 'uploads/no_images/no-image.png' &&
                    file_exists(public_path($management->image))
                ) {
                    unlink(public_path($management->image));
                }

                $imageFile = $request->file('image');
                $imageName = now()->format('Ymd') . rand(1000, 9999) . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('uploads/management'), $imageName);
                $imagePath = 'uploads/management/' . $imageName;
            }

            $management->update([
                'name' => $request->name,
                'designation' => $request->designation,
                'image' => $imagePath,
                'phone' => $request->phone,
                'email' => $request->email,
                'type' => $request->type,
                'status' => $management->status,
                'facebook_link' => $request->facebook_link,
                'linkedin_link' => $request->linkedin_link,
                'twitter_link' => $request->twitter_link,
            ]);

            return redirect()->route('management.create')->with('success', 'Member updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error occurred while updating management member: ' . $e->getMessage());
            return back()->with('error', 'An unexpected error occurred while updating the management member. Please try again later.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $management = Management::findOrFail($id);

            $request->validate([
                'status' => 'required|in:a,d',
            ]);

            $management->status = $request->status;
            $management->save();

            return back()->with('success', 'Member status updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error occurred while updating management member status: ' . $e->getMessage());
            return back()->with('error', 'An unexpected error occurred while updating the status. Please try again later.');
        }
    }

    public function destroy($id)
    {
        try {
            $management = Management::findOrFail($id);

            if ($management->image && file_exists(public_path($management->image))) {
                unlink(public_path($management->image));
            }

            $management->delete();

            return redirect()->route('management.create')->with('success', 'Management member deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error occurred while deleting management member with ID ' . $id . ': ' . $e->getMessage());
            return redirect()->route('management.create')->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }
}
