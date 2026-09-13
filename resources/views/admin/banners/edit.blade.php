@extends('layouts.admin')

@section('title', 'Edit Banner')

@section('content')
    <x-admin-page-header title="Edit Banner" />

    <x-admin-form-card>
        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="form-label">Halaman</label>
                <select name="page" class="form-select" required>
                    <option value="home" {{ $banner->page === 'testimonial' ? '' : 'selected' }}>Beranda (Home)</option>
                    <option value="testimonial" {{ $banner->page === 'testimonial' ? 'selected' : '' }}>Testimoni</option>
                </select>
            </div>

            <div>
                <label class="form-label">Judul</label>
                <input type="text" name="title" class="form-input" value="{{ old('title', $banner->title) }}"
                    placeholder="Contoh: Kelezatan Otentik, Disajikan Hangat.">
            </div>

            <div>
                <label class="form-label">Sub Judul</label>
                <textarea name="subtitle" class="form-textarea" rows="3"
                    placeholder="Contoh: Temukan cita rasa soto warisan yang tak terlupakan di Soto Vokasi.">{{ old('subtitle', $banner->subtitle) }}</textarea>
            </div>

            <div>
                <label class="form-label">Gambar Latar Saat Ini</label>
                <img src="{{ asset($banner->background_image) }}" alt="{{ $banner->title ?? 'Banner' }}"
                    class="rounded-lg border border-gray-200 shadow-sm max-h-40 object-cover">
            </div>

            <div>
                <label class="form-label">Ganti Gambar Latar</label>
                <input type="file" name="background_image" class="form-input" accept="image/*">
                <p class="form-help">Kosongkan jika tidak ingin mengganti gambar.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="form-label">Teks Tombol</label>
                    <input type="text" name="button_text" class="form-input" value="{{ old('button_text', $banner->button_text) }}"
                        placeholder="Contoh: Explore Menu">
                </div>
                <div>
                    <label class="form-label">Link Tombol</label>
                    <input type="url" name="button_url" class="form-input" value="{{ old('button_url', $banner->button_url) }}"
                        placeholder="Contoh: /menu">
                </div>
            </div>

            <div class="flex items-end pb-2">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ $banner->is_active ? 'checked' : '' }}
                        class="w-5 h-5 text-green-600 rounded border-gray-300 focus:ring-green-500">
                    <span class="ml-2 text-gray-700 font-medium">Banner Aktif (tampil di publik)</span>
                </label>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">
                    Update Banner
                </button>
                <a href="{{ route('admin.banners.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </x-admin-form-card>
@endsection