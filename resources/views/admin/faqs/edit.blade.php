@extends('layouts.admin')

@section('title', 'Edit FAQ')

@section('content')
    <x-admin-page-header title="Edit FAQ" />

    <x-admin-form-card>
        <form action="{{ route('admin.faqs.update', $faq) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="form-label">Pertanyaan</label>
                <input type="text" name="question" class="form-input"
                    value="{{ $faq->question }}" required>
            </div>

            <div>
                <label class="form-label">Jawaban</label>
                <textarea name="answer" class="form-textarea" rows="8" required>{{ $faq->answer }}</textarea>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">
                    Update FAQ
                </button>
                <a href="{{ route('admin.faqs.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </x-admin-form-card>
@endsection
