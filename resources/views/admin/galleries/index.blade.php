@extends('layouts.admin')

@section('title', 'Galeri')
@section('header', 'Kelola Galeri Website')

@section('content')
    <x-admin-page-header title="Daftar Galeri" actionUrl="{{ route('admin.galleries.create') }}" actionLabel="Tambah Galeri" />

    <div class="space-y-4">
        @forelse($galleries as $gallery)
            <div
                class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-200 flex flex-col sm:flex-row sm:items-center gap-4">
                <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->caption ?? 'Galeri' }}"
                    class="w-full sm:w-40 h-32 rounded-lg object-cover border border-gray-200 shadow-sm flex-shrink-0">

                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <x-status-badge :value="$gallery->is_active ? 'active' : 'inactive'"
                            :variant="$gallery->is_active ? 'active' : 'inactive'" />
                        <span class="text-xs text-gray-400 font-medium">Urutan: {{ $gallery->order }}</span>
                    </div>
                    <p class="font-semibold text-gray-800 truncate">{{ $gallery->caption ?? 'Tanpa keterangan' }}</p>
                </div>

                <div class="flex items-center gap-2 flex-shrink-0">
                    <div class="flex flex-col gap-1 mr-1">
                        <form action="{{ route('admin.galleries.move', [$gallery, 'up']) }}" method="POST">
                            @csrf
                            <button type="submit" title="Naik" {{ $loop->first ? 'disabled' : '' }}
                                class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-admin-600 disabled:opacity-30 disabled:cursor-not-allowed transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                </svg>
                            </button>
                        </form>
                        <form action="{{ route('admin.galleries.move', [$gallery, 'down']) }}" method="POST">
                            @csrf
                            <button type="submit" title="Turun" {{ $loop->last ? 'disabled' : '' }}
                                class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-admin-600 disabled:opacity-30 disabled:cursor-not-allowed transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <a href="{{ route('admin.galleries.edit', $gallery) }}" class="admin-action-edit">
                        Edit
                    </a>

                    <x-confirm-delete id="delete-gallery-{{ $gallery->id }}" action="{{ route('admin.galleries.destroy', $gallery) }}" title="Hapus Galeri" message="Yakin hapus gambar galeri ini?" />
                </div>
            </div>
        @empty
            <x-empty-state title="Belum ada galeri" message="Belum ada gambar galeri yang ditambahkan." icon="image" />
        @endforelse
    </div>
@endsection