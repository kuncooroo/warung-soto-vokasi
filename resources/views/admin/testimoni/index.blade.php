@extends('layouts.admin')

@section('title', 'Testimoni')
@section('header', 'Kelola Testimoni')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="card p-4 bg-blue-50">
            <p class="text-gray-600 text-sm">Total Testimoni</p>
            <h3 class="text-2xl font-bold text-primary">{{ $testimoni->count() }}</h3>
        </div>
        <div class="card p-4 bg-green-50">
            <p class="text-gray-600 text-sm">Disetujui</p>
            <h3 class="text-2xl font-bold text-green-600">{{ $testimoni->where('is_approved', true)->count() }}</h3>
        </div>
        <div class="card p-4 bg-yellow-50">
            <p class="text-gray-600 text-sm">Menunggu</p>
            <h3 class="text-2xl font-bold text-yellow-600">{{ $testimoni->where('is_approved', false)->count() }}</h3>
        </div>
    </div>

    <div class="space-y-4">
        @forelse($testimoni as $item)
            <div
                class="bg-white p-6 rounded-2xl shadow-sm flex flex-col md:flex-row gap-4 border-l-4 {{ $item->is_approved ? 'border-green-500' : 'border-yellow-500' }}">

                <div class="flex-shrink-0">
                    @if ($item->image)
                        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}"
                            class="w-12 h-12 rounded-full object-cover">
                    @else
                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-xl">
                            👤
                        </div>
                    @endif
                </div>

                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <h5 class="font-bold text-gray-800 text-sm">{{ $item->name }}</h5>
                            <p class="text-xs text-gray-400 mb-2">
                                {{ $item->email }} • {{ $item->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    <p class="text-xs text-gray-500 mb-3 leading-relaxed italic">
                        "{{ $item->message }}"
                    </p>

                    <div class="flex text-yellow-400 text-xs items-center">
                        @for ($i = 0; $i < $item->rating; $i++)
                            <span>★</span>
                        @endfor
                        <span class="text-gray-400 ml-2 text-xs">({{ $item->rating }}.0)</span>
                    </div>
                </div>

                <div class="flex md:flex-col gap-2 items-center justify-center md:border-l md:pl-4 md:w-32 flex-shrink-0">
                    @if (!$item->is_approved)
                        <form action="{{ route('admin.testimoni.approve', $item) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit"
                                class="w-full px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-xs font-bold shadow-sm transition">
                                ✓ Setujui
                            </button>
                        </form>
                    @else
                        <span
                            class="w-full px-3 py-2 bg-green-100 text-green-700 rounded-lg text-xs font-bold text-center border border-green-200">
                            Terpublis
                        </span>
                    @endif

                    <form action="{{ route('admin.testimoni.reject', $item) }}" method="POST" class="w-full"
                        onclick="return confirm('Hapus testimoni ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 text-xs font-bold border border-red-200 transition">
                            ✕ Hapus
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <div class="bg-white p-8 rounded-2xl shadow-sm text-center">
                <p class="text-gray-500">Belum ada data testimoni.</p>
            </div>
        @endforelse
    </div>
@endsection
