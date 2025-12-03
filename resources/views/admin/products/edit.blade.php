@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('header', 'Edit Produk')

@section('content')
    <div class="bg-white rounded-xl shadow-sm p-8 w-full border border-gray-100">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Nama Produk</label>
                <input type="text" name="name"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition"
                    value="{{ $product->name }}" required>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Kategori</label>
                <select name="category_id"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition bg-white"
                    required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Deskripsi</label>
                <textarea name="description"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition"
                    rows="5" required>{{ $product->description }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Harga (Rp)</label>
                    <input type="number" name="price" step="1000"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition"
                        value="{{ $product->price }}" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Gambar</label>
                    <input type="file" name="image"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                        accept="image/*">

                    @if ($product->image)
                        <div class="mt-3 flex items-center gap-3 p-3 border rounded-lg bg-gray-50">
                            <img src="{{ asset($product->image) }}" class="w-16 h-16 rounded object-cover">
                            <span class="text-sm text-gray-500">Gambar saat ini</span>
                        </div>
                    @endif
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Bahan-bahan</label>
                <textarea name="ingredients"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition"
                    rows="3">{{ $product->ingredients }}</textarea>
            </div>

            <div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="is_halal" value="1" {{ $product->is_halal ? 'checked' : '' }}
                        class="w-5 h-5 text-green-600 rounded border-gray-300 focus:ring-green-500">
                    <span class="ml-2 text-gray-700 font-medium">Produk Halal</span>
                </label>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit"
                    class="px-6 py-2.5 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 transition shadow-sm hover:shadow-md">
                    Update Produk
                </button>
                <a href="{{ route('admin.products.index') }}"
                    class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg font-bold hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
