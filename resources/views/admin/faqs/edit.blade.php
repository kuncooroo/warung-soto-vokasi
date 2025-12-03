@extends('layouts.admin')

@section('title', 'Edit FAQ')
@section('header', 'Edit FAQ')

@section('content')
    <div class="bg-white rounded-xl shadow-sm p-8 w-full border border-gray-100">
        <form action="{{ route('admin.faqs.update', $faq) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Pertanyaan</label>
                <input type="text" name="question"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition"
                    value="{{ $faq->question }}" required>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Jawaban</label>
                <textarea name="answer"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition"
                    rows="8" required>{{ $faq->answer }}</textarea>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit"
                    class="px-6 py-2.5 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 transition shadow-sm hover:shadow-md">
                    Update FAQ
                </button>
                <a href="{{ route('admin.faqs.index') }}"
                    class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg font-bold hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
