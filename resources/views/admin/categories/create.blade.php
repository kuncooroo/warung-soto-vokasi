@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
    <x-admin-page-header title="Tambah Kategori Baru" />

    <x-admin-form-card>
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="name" class="form-input"
                    placeholder="Masukkan nama kategori..." required>
            </div>

            <div>
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-textarea" rows="5"
                    placeholder="Masukkan deskripsi kategori (opsional)..."></textarea>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">
                    Simpan Kategori
                </button>

                <a href="{{ route('admin.categories.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </x-admin-form-card>
@endsection