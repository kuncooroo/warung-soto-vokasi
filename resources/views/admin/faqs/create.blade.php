@extends('layouts.admin')

@section('title', 'Tambah FAQ')

@section('content')
    <x-admin-page-header title="Tambah FAQ Baru" />

    <x-admin-form-card>
        <form action="{{ route('admin.faqs.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="form-label">Pertanyaan</label>
                <input type="text" name="question" class="form-input"
                    placeholder="Tulis pertanyaan..." required>
            </div>

            <div>
                <label class="form-label">Jawaban</label>
                <textarea name="answer" class="form-textarea" rows="8"
                    placeholder="Tulis jawaban lengkap..." required></textarea>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">
                    Simpan FAQ
                </button>
                <a href="{{ route('admin.faqs.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </x-admin-form-card>
@endsection
