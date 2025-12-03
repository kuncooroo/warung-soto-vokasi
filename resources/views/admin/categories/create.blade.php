@extends('layouts.admin')

@section('title', 'Tambah Kategori')
@section('header', 'Tambah Kategori Baru')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-8 w-full border border-gray-100">
    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Nama Kategori</label>
            <input type="text" name="name" 
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition" 
                   placeholder="Masukkan nama kategori..."
                   required>
        </div>

        <div>
            <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Deskripsi</label>
            <textarea name="description" 
                      class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition" 
                      rows="5"
                      placeholder="Masukkan deskripsi kategori (opsional)..."></textarea>
        </div>

        <div class="flex gap-4 pt-4 border-t border-gray-100">
            <button type="submit" class="px-6 py-2.5 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 transition shadow-sm hover:shadow-md">
                Simpan Kategori
            </button>
            
            <a href="{{ route('admin.categories.index') }}" class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg font-bold hover:bg-gray-50 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection