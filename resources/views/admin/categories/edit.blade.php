@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
    <x-admin-page-header title="Edit Kategori" />

    <x-admin-form-card>
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="name" class="form-input"
                    value="{{ $category->name }}" required>
            </div>

            <div>
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-textarea" rows="5">{{ $category->description }}</textarea>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">
                    Update Kategori
                </button>

                <a href="{{ route('admin.categories.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </x-admin-form-card>
@endsection