@extends('layouts.admin')

@section('title', 'Produk')
@section('header', 'Daftar Produk')

@section('content')
    <x-admin-page-header title="Kelola Produk" actionUrl="{{ route('admin.products.create') }}" actionLabel="Tambah Produk" />

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <table class="admin-table w-full">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Gambar</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Nama</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Kategori</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Harga</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Stok</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Status</th>
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
                            @if ($product->stock === null)
                                <span class="text-xs font-medium text-gray-400 bg-gray-100 px-2 py-1 rounded-full">Tidak terbatas</span>
                            @elseif ($product->stock === 0)
                                <span class="text-xs font-medium text-red-600 bg-red-100 px-2 py-1 rounded-full">Habis</span>
                            @else
                                <span class="text-xs font-medium text-gray-700 bg-gray-100 px-2 py-1 rounded-full">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <x-status-badge :value="$product->is_active ? 'active' : 'inactive'"
                                :variant="$product->is_active ? 'active' : 'inactive'" />
                        </td>
                        <td class="px-6 py-4">
                            <x-status-badge :value="$product->is_halal ? 'halal' : 'not-halal'" :variant="$product->is_halal ? 'halal' : 'not-halal'" />
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center space-x-2">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                    class="admin-action-edit">
                                    Edit
                                </a>

                                <x-confirm-delete id="delete-product-{{ $product->id }}" action="{{ route('admin.products.destroy', $product) }}" title="Hapus Produk" message="Yakin hapus produk ini? Tindakan ini tidak dapat dibatalkan." />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500 bg-gray-50">
                            <x-empty-state title="Belum ada produk" message="Belum ada produk yang ditambahkan." icon="product" />
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
