@extends('layouts.admin')

@section('title', 'Edit Galeri')

@section('content')
    <x-admin-page-header title="Edit Galeri" />

    <x-admin-form-card>
        <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="form-label">Gambar Saat Ini</label>
                <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->caption ?? 'Galeri' }}"
                    class="rounded-lg border border-gray-200 shadow-sm max-h-40 object-cover">
            </div>

            <div>
                <label class="form-label">Ganti Gambar</label>
                <input type="file" name="image" class="form-input" accept="image/*">
                <p class="form-help">Kosongkan jika tidak ingin mengganti gambar.</p>
            </div>

            <div>
                <label class="form-label">Keterangan</label>
                <input type="text" name="caption" class="form-input" value="{{ old('caption', $gallery->caption) }}"
                    placeholder="Contoh: Suasana ramai jam makan siang">
            </div>

            <div class="flex items-end pb-2">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ $gallery->is_active ? 'checked' : '' }}
                        class="w-5 h-5 text-green-600 rounded border-gray-300 focus:ring-green-500">
                    <span class="ml-2 text-gray-700 font-medium">Galeri Aktif (tampil di publik)</span>
                </label>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">
                    Update Galeri
                </button>
                <a href="{{ route('admin.galleries.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </x-admin-form-card>
@endsection