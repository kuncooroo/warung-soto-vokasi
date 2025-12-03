<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
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

        $products = $query->paginate(8);

        $categories = Category::all();

        return view('public.menu', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        return view('public.product-detail', compact('product'));
    }

    public function apiIndex(Request $request)
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

    public function apiShow(Product $product)
    {
        return response()->json([
            'success' => true,
            'message' => 'Success',
            'data' => $product->load('category')
        ]);
    }

    public function apiSearch(Request $request)
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
