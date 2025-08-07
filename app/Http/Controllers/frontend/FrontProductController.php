<?php

namespace App\Http\Controllers\frontend;

use App\Models\Product;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class FrontProductController extends Controller
{

    public function productList()
    {
        $products = Product::where('status', 'a')->latest()->get();
        $pageTitle = 'All Products';
        $requestkeyword = null;
        return view('frontend.pages.product-list',  compact('products', 'pageTitle', 'requestkeyword'));
    }

    public function showClientWiseProduct($slug)
    {
        $client = Client::where('slug', $slug)->firstOrFail();
        $clientName = $client->name;
        $products = Product::where('client_id', $client->id)->get();
        $requestkeyword = $clientName;
        $isClientPage = true;

        return view('frontend.pages.product-list', compact('products', 'clientName', 'client', 'requestkeyword', 'isClientPage'));
    }

    public function show($slug)
    {
        try {
            $product = Product::with('client')->where('slug', $slug)->firstOrFail();
            $product->gallery_images = json_decode($product->gallery_images, true);

            return view('frontend.pages.product-details', compact('product'));
        } catch (\Exception $e) {
            Log::error('Error fetching product: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching the product. Please try again later.');
        }
    }

    public function searchProduct(Request $request)
    {
        $keyword = $request->input('search');

        if ($request->ajax()) {

            if (!empty($keyword)) {
                $products = Product::where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                    ->take(5)
                    ->get(['id', 'name', 'slug', 'thumbnail_image']);
                return response()->json($products);
            }
            return response()->json([]);
        } else {

            if (!empty($keyword)) {
                $products = Product::latest()
                    ->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                    ->paginate(10);
            } else {
                $products = collect();
            }

            return view('frontend.pages.product-list', [
                'products' => $products,
                'requestkeyword' => $keyword,
            ]);
        }
    }


    // public function showAll()
    // {
    //     try {
    //         $categories = Category::orderBy('name', 'asc')->get();
    //         return view('frontend.all-categories', compact('categories'));
    //     } catch (\Exception $e) {
    //         Log::error('Error fetching all categories: ' . $e->getMessage());
    //         return back()->with('error', 'An error occurred while fetching the categories. Please try again later.');
    //     }
    // }

    // public function quickView($slug)
    // {
    //     try {
    //         $product = Product::with(['category', 'subCategory', 'childCategory'])->where('slug', $slug)->firstOrFail();
    //         $randomProducts = Product::limit(12)->get();
    //         $productId = $product->id;

    //         return view('frontend.produnct-quick-view', compact('product', 'randomProducts', 'productId'));
    //     } catch (\Exception $e) {
    //         Log::error('Error fetching product: ' . $e->getMessage());
    //         return back()->with('error', 'An error occurred while fetching the product. Please try again later.');
    //     }
    // }


}
