@extends('layouts.admin')

@section('title', 'FAQ')
@section('header', 'Kelola FAQ')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h3 class="text-xl font-bold text-gray-800">Daftar FAQ</h3>

        <a href="{{ route('admin.faqs.create') }}"
            class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition shadow-sm flex items-center gap-2">
            <span>+</span> Tambah FAQ
        </a>
    </div>

    <div class="space-y-4">
        @forelse($faqs as $faq)
            <div
                class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-green-500 hover:shadow-md transition duration-200">
                <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                    <div class="flex-1">
                        <h4 class="font-bold text-lg text-gray-800 flex items-center gap-2">
                            <span class="text-green-600">Q:</span> {{ $faq->question }}
                        </h4>
                        <div class="mt-3 text-gray-600 leading-relaxed bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <span class="font-bold text-gray-400 mr-1">A:</span> {{ $faq->answer }}
                        </div>
                    </div>

                    <div class="flex items-center gap-2 flex-shrink-0">
                        <a href="{{ route('admin.faqs.edit', $faq) }}"
                            class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-md text-xs font-bold hover:bg-yellow-200 transition">
                            Edit
                        </a>

                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline"
                            onclick="return confirm('Yakin hapus FAQ ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-3 py-1 bg-red-100 text-red-700 rounded-md text-xs font-bold hover:bg-red-200 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white p-12 rounded-xl shadow-sm text-center border border-gray-100">
                <p class="text-gray-500 mt-2">Belum ada FAQ yang ditambahkan.</p>
            </div>
        @endforelse
    </div>
@endsection
