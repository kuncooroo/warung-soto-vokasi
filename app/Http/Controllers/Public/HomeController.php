<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Testimoni;
use App\Models\Faq;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->limit(6)->get();
        $testimoni = Testimoni::where('is_approved', true)->get();
        $faqs = Faq::orderBy('order')->get();

        return view('public.home', compact('categories', 'products', 'testimoni', 'faqs'));
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
