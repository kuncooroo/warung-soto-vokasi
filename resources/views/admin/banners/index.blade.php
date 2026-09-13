@extends('layouts.admin')

@section('title', 'Banner')
@section('header', 'Kelola Banner Website')

@section('content')
    <x-admin-page-header title="Daftar Banner" actionUrl="{{ route('admin.banners.create') }}" actionLabel="Tambah Banner" />

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <table class="admin-table w-full">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Preview</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Halaman</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Judul</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Sub Judul</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Tombol</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Status</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($banners as $banner)
                    <tr class="hover:bg-green-50 transition duration-150">
                        <td class="px-6 py-4">
                            <img src="{{ asset($banner->background_image) }}" alt="{{ $banner->title ?? 'Banner' }}"
                                class="w-40 h-16 rounded-lg object-cover border border-gray-200 shadow-sm">
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                                {{ $banner->page === 'home' ? 'Beranda' : 'Testimoni' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $banner->title ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-600 text-sm max-w-xs truncate">{{ $banner->subtitle ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-600 text-sm">
                            {{ $banner->button_text ? $banner->button_text . ' →' : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            <x-status-badge :value="$banner->is_active ? 'active' : 'inactive'"
                                :variant="$banner->is_active ? 'active' : 'inactive'" />
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center space-x-2">
                                <a href="{{ route('admin.banners.edit', $banner) }}" class="admin-action-edit">
                                    Edit
                                </a>

                                <x-confirm-delete id="delete-banner-{{ $banner->id }}" action="{{ route('admin.banners.destroy', $banner) }}" title="Hapus Banner" message="Yakin hapus banner ini? Halaman publik akan kembali ke banner bawaan." />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500 bg-gray-50">
                            <x-empty-state title="Belum ada banner" message="Belum ada banner yang ditambahkan." icon="image" />
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection