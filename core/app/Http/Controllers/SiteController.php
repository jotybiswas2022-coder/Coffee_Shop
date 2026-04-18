<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\setting;
use App\Models\Slider;

class SiteController extends Controller
{
    // Homepage
    function index()
    {
        $settings = Setting::first();
        $currency = $settings?->currency ?? '৳';
        $slider = Slider::latest()->first();
        $products = Product::all();
        $categories = Category::all(); 
        return view('frontend.index', compact('products', 'categories', 'settings', 'currency', 'slider'));
    }

    // Product detail page
    function item($id)
    {

        $product = Product::findOrFail($id);

        $otherProducts = Product::where('category_id', $product->category_id)
                                ->where('id', '!=', $id)
                                ->inRandomOrder()
                                ->limit(8)
                                ->get();

        return view('frontend.product.index', compact('product', 'otherProducts'));
    }

    function list($id)
    {
        $settings = setting::first();
        $currency = $settings->currency;
        $products = Product::where('category_id', $id)->get();
        return view('frontend.product.list', compact('products', 'settings', 'currency'));
    }
}