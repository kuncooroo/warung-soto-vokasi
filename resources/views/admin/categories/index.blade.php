@extends('layouts.admin')

@section('title', 'Kategori')
@section('header', 'Daftar Kategori')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-xl font-bold text-gray-800">Kelola Kategori</h3>
    
    <a href="{{ route('admin.categories.create') }}" 
       class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition shadow-sm flex items-center gap-2">
        <span>+</span> Tambah Kategori
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
    <table class="w-full">
        <thead class="bg-green-600 text-white">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Nama</th>
                <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Deskripsi</th>
                <th class="px-6 py-4 text-center text-sm font-semibold tracking-wide">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($categories as $category)
            <tr class="hover:bg-green-50 transition duration-150">
                <td class="px-6 py-4 font-semibold text-gray-800">{{ $category->name }}</td>
                <td class="px-6 py-4 text-gray-600 text-sm">{{ $category->description ?? '-' }}</td>
                <td class="px-6 py-4 text-center">
                    <div class="flex justify-center items-center space-x-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" 
                           class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-md text-xs font-bold hover:bg-yellow-200 transition">
                            Edit
                        </a>
                        
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onclick="return confirm('Yakin hapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-3 py-1 bg-red-100 text-red-700 rounded-md text-xs font-bold hover:bg-red-200 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-8 text-center text-gray-500 bg-gray-50">
                    <div class="flex flex-col items-center justify-center">
                        <span class="text-2xl mb-2">📂</span>
                        <p>Belum ada kategori yang ditambahkan.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection