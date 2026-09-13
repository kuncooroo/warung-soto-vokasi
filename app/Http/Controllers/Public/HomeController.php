<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Testimoni;
use App\Models\Faq;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->where('is_active', true)->limit(6)->get();
        $testimoni = Testimoni::where('is_approved', true)->get();
        $faqs = Faq::orderBy('order')->get();
        $banner = Banner::active()->where('page', 'home')->latest('id')->first();

        return view('public.home', compact('categories', 'products', 'testimoni', 'faqs', 'banner'));
    }

    public function about()
    {
        return view('public.about');
    }

    public function faq()
    {
        $faqs = Faq::orderBy('order')->get(); 
        return view('public.faq', compact('faqs'));
    }
}
