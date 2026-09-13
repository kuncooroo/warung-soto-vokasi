@extends('layouts.admin')

@section('title', 'FAQ')
@section('header', 'Kelola FAQ')

@section('content')
    <x-admin-page-header title="Daftar FAQ" actionUrl="{{ route('admin.faqs.create') }}" actionLabel="Tambah FAQ" />

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
                        <div class="flex flex-col gap-1 mr-1">
                            <form action="{{ route('admin.faqs.move', [$faq, 'up']) }}" method="POST">
                                @csrf
                                <button type="submit" title="Naik" {{ $loop->first ? 'disabled' : '' }}
                                    class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-admin-600 disabled:opacity-30 disabled:cursor-not-allowed transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                    </svg>
                                </button>
                            </form>
                            <form action="{{ route('admin.faqs.move', [$faq, 'down']) }}" method="POST">
                                @csrf
                                <button type="submit" title="Turun" {{ $loop->last ? 'disabled' : '' }}
                                    class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-admin-600 disabled:opacity-30 disabled:cursor-not-allowed transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <a href="{{ route('admin.faqs.edit', $faq) }}"
                            class="admin-action-edit">
                            Edit
                        </a>

                        <x-confirm-delete id="delete-faq-{{ $faq->id }}" action="{{ route('admin.faqs.destroy', $faq) }}" title="Hapus FAQ" message="Yakin hapus FAQ ini?" />
                    </div>
                </div>
            </div>
        @empty
            <x-empty-state title="Belum ada FAQ" message="Belum ada FAQ yang ditambahkan." icon="faq" />
        @endforelse
    </div>
@endsection
