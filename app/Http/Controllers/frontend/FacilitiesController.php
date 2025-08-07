<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class FacilitiesController extends Controller
{
    public function view()
    {
        try {
            return view('frontend.pages.facilities');
        } catch (\Exception $e) {
            Log::error('Error fetching facilities: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'An error occurred while fetching the facilities. Please try again later.');
        }
    }
}
