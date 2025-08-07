<?php

namespace App\Http\Controllers\frontend;

use App\Models\Client;
use App\Models\Slider;
use App\Models\AboutUs;
use App\Models\Counter;
use App\Models\Gallery;
use App\Models\Message;
use App\Models\Product;
use App\Models\Category;
use App\Models\Management;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        try {
            $sliders = Slider::where('status', 'a')->latest()->get();
            $message = Message::first();
            $aboutUs = AboutUs::first();
            $counters = Counter::where('status', 'a')->latest()->get();
            $category = Category::where('status', 'a')->latest()->get();
            $categories = Category::where('status', 'a')->latest()->get();
            $products = Product::with(['category', 'client'])->where('status', 'a')->latest()->take(8)->get();
            $clients = Client::where('status', 'a')->get();
            $certificate = Certificate::where('status', 'a')->latest()->take(4)->get();
            $galleryImages = Gallery::where('type', 'image')->where('status', 'a')->take(7)->get();
            $videos = Gallery::where('type', 'video')->where('status', 'a')->take(7)->get();
            $management = Management::where('status', 'a')->take(4)->get();
            return view('frontend.pages.home', compact('sliders', 'message', 'aboutUs', 'counters', 'management', 'category', 'categories', 'clients', 'certificate', 'products', 'galleryImages', 'videos'));
        } catch (\Exception $e) {
            Log::error('Error fetching sliders: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'There was an error loading the sliders. Please try again later.');
        }
    }
}
