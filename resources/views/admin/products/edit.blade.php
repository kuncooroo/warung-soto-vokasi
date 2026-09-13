@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
    <x-admin-page-header title="Edit Produk" />

    <x-admin-form-card>
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="form-label">Nama Produk</label>
                <input type="text" name="name" class="form-input"
                    value="{{ $product->name }}" required>
            </div>

            <div>
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-textarea" rows="5" required>{{ $product->description }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="price" step="1000" class="form-input"
                        value="{{ $product->price }}" required>
                </div>
                <div>
                    <label class="form-label">Stok (kosongkan jika tidak terbatas)</label>
                    <input type="number" name="stock" min="0" class="form-input"
                        value="{{ $product->stock }}">
                </div>
                <div>
                    <label class="form-label">Gambar</label>
                    <input type="file" name="image" class="form-input" accept="image/*">

                    @if ($product->image)
                        <div class="mt-3 flex items-center gap-3 p-3 border rounded-lg bg-gray-50">
                            <img src="{{ asset($product->image) }}" class="w-16 h-16 rounded object-cover">
                            <span class="text-sm text-gray-500">Gambar saat ini</span>
                        </div>
                    @endif
                </div>
                <div class="flex items-end pb-2">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}
                            class="w-5 h-5 text-green-600 rounded border-gray-300 focus:ring-green-500">
                        <span class="ml-2 text-gray-700 font-medium">Produk Aktif (tampil di menu)</span>
                    </label>
                </div>
            </div>

            <div>
                <label class="form-label">Bahan-bahan</label>
                <textarea name="ingredients" class="form-textarea" rows="3">{{ $product->ingredients }}</textarea>
            </div>

            <div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="is_halal" value="1" {{ $product->is_halal ? 'checked' : '' }}
                        class="w-5 h-5 text-green-600 rounded border-gray-300 focus:ring-green-500">
                    <span class="ml-2 text-gray-700 font-medium">Produk Halal</span>
                </label>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">
                    Update Produk
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </x-admin-form-card>
@endsection
