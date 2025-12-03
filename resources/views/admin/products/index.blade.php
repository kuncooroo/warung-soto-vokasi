@extends('layouts.admin')

@section('title', 'Produk')
@section('header', 'Daftar Produk')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h3 class="text-xl font-bold text-gray-800">Kelola Produk</h3>

        <a href="{{ route('admin.products.create') }}"
            class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition shadow-sm flex items-center gap-2">
            <span>+</span> Tambah Produk
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <table class="w-full">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Gambar</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Nama</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Kategori</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Harga</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Halal</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                    <tr class="hover:bg-green-50 transition duration-150">

                        <td class="px-6 py-4">
                            @if ($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                    class="w-16 h-16 rounded-lg object-cover border border-gray-200 shadow-sm">
                            @else
                                <div
                                    class="w-16 h-16 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 border border-gray-200">
                                    <span class="text-2xl">🍜</span>
                                </div>
                            @endif
                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $product->name }}</td>
                        <td class="px-6 py-4 text-gray-600 text-sm">{{ $product->category->name }}</td>
                        <td class="px-6 py-4 text-gray-800 font-medium">
                            {{ \App\Helpers\Helper::formatRupiah($product->price) }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold {{ $product->is_halal ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $product->is_halal ? '✓ Halal' : '✗ Tidak' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center space-x-2">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                    class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-md text-xs font-bold hover:bg-yellow-200 transition">
                                    Edit
                                </a>

                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline"
                                    onclick="return confirm('Yakin hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-100 text-red-700 rounded-md text-xs font-bold hover:bg-red-200 transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500 bg-gray-50">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-2xl mb-2">🍲</span>
                                <p>Belum ada produk yang ditambahkan.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
