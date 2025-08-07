<?php

namespace App\Http\Controllers\admin;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class CertificateController extends Controller
{
    public function index()
    {
        try {
            $certificates = Certificate::latest()->get();
            return view('admin.certificates.index', compact('certificates'));
        } catch (\Exception $e) {
            Log::error('Error loading certificate index page: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Failed to load certificates. Try again later.');
        }
    }

    public function view()
    {
        try {
            $certificate = Certificate::where('status', 'a')->latest()->get();
            return view('frontend.pages.certificate', compact('certificate'));
        } catch (\Exception $e) {
            Log::error('Error fetching certificate: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'An error occurred while fetching the certificate. Please try again later.');
        }
    }


    public function create()
    {
        try {
            $certificates = Certificate::latest()->get();
            return view('admin.certificates.create', compact('certificates'));
        } catch (\Exception $e) {
            Log::error('Error loading create certificate page: ' . $e->getMessage());
            return back()->with('error', 'Failed to load create certificate form.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
        ]);

        try {
            $imagePath = 'uploads/no_images/no-image.png';

            if ($request->hasFile('image')) {
                $imageFile = $request->file('image');
                $imageName = now()->format('YmdHis') . rand(1000, 9999) . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('uploads/certificate'), $imageName);
                $imagePath = 'uploads/certificate/' . $imageName;
            }

            Certificate::create([
                'title' => $request->title,
                'image' => $imagePath,
                'description' => strip_tags($request->description),
                'ip_address' => $request->ip(),
                'status' => 'a',
            ]);

            return redirect()->route('certificate.create')->with('success', 'Certificate created successfully.');
        } catch (\Exception $e) {
            Log::error('Error storing certificate: ' . $e->getMessage());
            return back()->with('error', 'Failed to create certificate.');
        }
    }

    public function edit($id)
    {
        try {
            $certificate = Certificate::findOrFail($id);
            return view('admin.certificates.edit', compact('certificate'));
        } catch (\Exception $e) {
            Log::error('Error loading edit certificate form: ' . $e->getMessage());
            return back()->with('error', 'Certificate not found.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $certificate = Certificate::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'description' => 'nullable|string',
            ]);

            $imagePath = $certificate->image;

            if ($request->hasFile('image')) {
                if ($imagePath && $imagePath !== 'uploads/no_images/no-image.png' && file_exists(public_path($imagePath))) {
                    unlink(public_path($imagePath));
                }

                $imageFile = $request->file('image');
                $imageName = now()->format('YmdHis') . rand(1000, 9999) . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('uploads/certificate'), $imageName);
                $imagePath = 'uploads/certificate/' . $imageName;
            }

            $certificate->update([
                'title' => $request->title,
                'image' => $imagePath,
                'description' => strip_tags($request->description),
            ]);

            return redirect()->route('certificate.create')->with('success', 'Certificate updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating certificate: ' . $e->getMessage());
            return back()->with('error', 'Failed to update certificate.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $certificate = Certificate::findOrFail($id);

            $request->validate([
                'status' => 'required|in:a,d',
            ]);

            $certificate->status = $request->status;
            $certificate->save();

            return back()->with('success', 'Certificate status updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error occurred while updating certificate status: ' . $e->getMessage());
            return back()->with('error', 'An unexpected error occurred while updating the status. Please try again later.');
        }
    }

    public function destroy($id)
    {
        try {
            $certificate = Certificate::findOrFail($id);

            if ($certificate->image && $certificate->image !== 'uploads/no_images/no-image.png') {
                $imagePath = public_path($certificate->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $certificate->delete();

            return redirect()->route('certificate.create')->with('success', 'Certificate deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting certificate: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete certificate.');
        }
    }
}
