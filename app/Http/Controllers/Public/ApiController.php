<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function products(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        return response()->json([
            'success' => true,
            'message' => 'Success',
            'data' => $query->get()
        ]);
    }

    public function product(Product $product)
    {
        return response()->json([
            'success' => true,
            'message' => 'Success',
            'data' => $product->load('category')
        ]);
    }

    public function categories()
    {
        return response()->json(Category::all());
    }

    public function testimonials()
    {
        return response()->json(Testimoni::where('is_approved', true)->get());
    }

    public function faqs()
    {
        return response()->json(Faq::orderBy('order')->get());
    }

    public function search(Request $request)
    {
        $search = $request->query('q');
        $category = $request->query('category');

        $query = Product::with('category');

        if ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        }

        if ($category) {
            $query->where('category_id', $category);
        }

        return response()->json([
            'success' => true,
            'message' => 'Success',
            'data' => $query->get()
        ]);
    }
}