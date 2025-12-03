@extends('layouts.public')

@section('title', $product->name)

@section('content')
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Image -->
            <div>
                @if($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow-lg">
                @else
                <div class="w-full h-96 bg-gray-300 rounded-lg flex items-center justify-center text-6xl">🍜</div>
                @endif
            </div>

            <!-- Details -->
            <div>
                <h1 class="text-4xl font-bold text-primary mb-4">{{ $product->name }}</h1>

                <div class="flex items-center gap-4 mb-6">
                    <span class="text-3xl font-bold text-accent">{{ \App\Helpers\Helper::formatRupiah($product->price) }}</span>
                    @if($product->is_halal)
                    <span class="bg-green-100 text-green-800 px-4 py-2 rounded-lg font-semibold">✓ Halal</span>
                    @endif
                </div>

                <p class="text-gray-600 mb-2">Kategori: <span class="font-semibold">{{ $product->category->name }}</span></p>

                <div class="bg-white p-6 rounded-lg shadow mb-6">
                    <h3 class="text-xl font-bold text-primary mb-4">Deskripsi</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                </div>

                @if($product->ingredients)
                <div class="bg-white p-6 rounded-lg shadow mb-6">
                    <h3 class="text-xl font-bold text-primary mb-4">Bahan-bahan</h3>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $product->ingredients }}</p>
                </div>
                @endif

                <a href="{{ route('menu') }}" class="btn-primary">← Kembali ke Menu</a>
            </div>
        </div>
    </div>
</section>
@endsection