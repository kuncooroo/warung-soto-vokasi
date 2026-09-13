@extends('layouts.admin')

@section('title', 'Kategori')
@section('header', 'Daftar Kategori')

@section('content')
<x-admin-page-header title="Kelola Kategori" actionUrl="{{ route('admin.categories.create') }}" actionLabel="Tambah Kategori" />

<div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
    <table class="admin-table w-full">
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
                           class="admin-action-edit">
                            Edit
                        </a>
                        
                        <x-confirm-delete id="delete-category-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category) }}" title="Hapus Kategori" message="Yakin hapus kategori ini?" />
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-8 text-center text-gray-500 bg-gray-50">
                    <x-empty-state title="Belum ada kategori" message="Belum ada kategori yang ditambahkan." icon="category" />
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
