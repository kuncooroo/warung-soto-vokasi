@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
    <x-admin-page-header title="Tambah Produk Baru" />

    <x-admin-form-card>
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="form-label">Nama Produk</label>
                <input type="text" name="name" class="form-input"
                    placeholder="Contoh: Soto Ayam Lamongan" required>
            </div>

            <div>
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-textarea" rows="5" required></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="price" step="1000" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Stok (kosongkan jika tidak terbatas)</label>
                    <input type="number" name="stock" min="0" class="form-input"
                        placeholder="Contoh: 50">
                </div>
                <div>
                    <label class="form-label">Gambar</label>
                    <input type="file" name="image" class="form-input" accept="image/*">
                </div>
                <div class="flex items-end pb-2">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked
                            class="w-5 h-5 text-green-600 rounded border-gray-300 focus:ring-green-500">
                        <span class="ml-2 text-gray-700 font-medium">Produk Aktif (tampil di menu)</span>
                    </label>
                </div>
            </div>

            <div>
                <label class="form-label">Bahan-bahan</label>
                <textarea name="ingredients" class="form-textarea" rows="3"></textarea>
            </div>

            <div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="is_halal" value="1" checked
                        class="w-5 h-5 text-green-600 rounded border-gray-300 focus:ring-green-500">
                    <span class="ml-2 text-gray-700 font-medium">Produk Halal</span>
                </label>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">
                    Simpan Produk
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </x-admin-form-card>
@endsection
