@extends('layouts.admin')

@section('title', 'Tambah Galeri')

@section('content')
    <x-admin-page-header title="Tambah Galeri Baru" />

    <x-admin-form-card>
        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="form-label">Gambar</label>
                <input type="file" name="image" class="form-input" accept="image/*" required>
                <p class="form-help">Gambar akan tampil di halaman testimoni/gallery (maks. 5MB).</p>
            </div>

            <div>
                <label class="form-label">Keterangan</label>
                <input type="text" name="caption" class="form-input" value="{{ old('caption') }}"
                    placeholder="Contoh: Suasana ramai jam makan siang">
            </div>

            <div class="flex items-end pb-2">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked
                        class="w-5 h-5 text-green-600 rounded border-gray-300 focus:ring-green-500">
                    <span class="ml-2 text-gray-700 font-medium">Galeri Aktif (tampil di publik)</span>
                </label>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">
                    Simpan Galeri
                </button>
                <a href="{{ route('admin.galleries.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </x-admin-form-card>
@endsection