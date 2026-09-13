<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->filled('stock') ? (int) $request->stock : null;
        $product->is_active = $request->boolean('is_active', true);
        $product->slug = Str::slug($request->name);
        $product->ingredients = $request->ingredients;
        $product->is_halal = $request->is_halal ?? true;

        if ($request->hasFile('image')) {
            $product->image = $this->storeImage($request);
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->filled('stock') ? (int) $request->stock : null;
        $product->is_active = $request->boolean('is_active', false);
        $product->slug = Str::slug($request->name);
        $product->ingredients = $request->ingredients;
        $product->is_halal = $request->is_halal ?? true;

        if ($request->hasFile('image')) {
            $product->image = $this->storeImage($request);
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus');
    }

    private function storeImage(Request $request): string
    {
        $image = $request->file('image');
        $imageName = Str::random(24) . '.' . $this->extFromMime($image->getMimeType());
        $image->move(public_path('images/products'), $imageName);
        return 'images/products/' . $imageName;
    }

    private function extFromMime(?string $mime): string
    {
        return match ($mime) {
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            default => 'jpg',
        };
    }
}