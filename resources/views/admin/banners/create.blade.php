@extends('layouts.admin')

@section('title', 'Tambah Banner')

@section('content')
    <x-admin-page-header title="Tambah Banner Baru" />

    <x-admin-form-card>
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="form-label">Halaman</label>
                <select name="page" class="form-select" required>
                    <option value="home" {{ old('page') === 'testimonial' ? '' : 'selected' }}>Beranda (Home)</option>
                    <option value="testimonial" {{ old('page') === 'testimonial' ? 'selected' : '' }}>Testimoni</option>
                </select>
                <p class="form-help">Banner halaman Beranda dan Testimoni dapat diganti dari sini.</p>
            </div>

            <div>
                <label class="form-label">Judul</label>
                <input type="text" name="title" class="form-input" value="{{ old('title') }}"
                    placeholder="Contoh: Kelezatan Otentik, Disajikan Hangat.">
            </div>

            <div>
                <label class="form-label">Sub Judul</label>
                <textarea name="subtitle" class="form-textarea" rows="3"
                    placeholder="Contoh: Temukan cita rasa soto warisan yang tak terlupakan di Soto Vokasi.">{{ old('subtitle') }}</textarea>
            </div>

            <div>
                <label class="form-label">Gambar Latar</label>
                <input type="file" name="background_image" class="form-input" accept="image/*">
                <p class="form-help">Rekomendasi ukuran lebar: 1920px (maks. 5MB).</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="form-label">Teks Tombol</label>
                    <input type="text" name="button_text" class="form-input" value="{{ old('button_text') }}"
                        placeholder="Contoh: Explore Menu">
                </div>
                <div>
                    <label class="form-label">Link Tombol</label>
                    <input type="url" name="button_url" class="form-input" value="{{ old('button_url') }}"
                        placeholder="Contoh: /menu">
                </div>
            </div>

            <div class="flex items-end pb-2">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked
                        class="w-5 h-5 text-green-600 rounded border-gray-300 focus:ring-green-500">
                    <span class="ml-2 text-gray-700 font-medium">Banner Aktif (tampil di publik)</span>
                </label>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">
                    Simpan Banner
                </button>
                <a href="{{ route('admin.banners.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </x-admin-form-card>
@endsection