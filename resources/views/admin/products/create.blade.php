@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('header', 'Tambah Produk Baru')

@section('content')
    <div class="bg-white rounded-xl shadow-sm p-8 w-full border border-gray-100">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Nama Produk</label>
                <input type="text" name="name"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition"
                    placeholder="Contoh: Soto Ayam Lamongan" required>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Kategori</label>
                <select name="category_id"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition bg-white"
                    required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Deskripsi</label>
                <textarea name="description"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition"
                    rows="5" required></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Harga (Rp)</label>
                    <input type="number" name="price" step="1000"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition"
                        required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Gambar</label>
                    <input type="file" name="image"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                        accept="image/*">
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Bahan-bahan</label>
                <textarea name="ingredients"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition"
                    rows="3"></textarea>
            </div>

            <div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="is_halal" value="1" checked
                        class="w-5 h-5 text-green-600 rounded border-gray-300 focus:ring-green-500">
                    <span class="ml-2 text-gray-700 font-medium">Produk Halal</span>
                </label>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit"
                    class="px-6 py-2.5 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 transition shadow-sm hover:shadow-md">
                    Simpan Produk
                </button>
                <a href="{{ route('admin.products.index') }}"
                    class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg font-bold hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
