@extends('layouts.admin')

@section('title', 'Hasil Pencarian')
@section('header', 'Hasil Pencarian')

@section('content')
    <x-admin-page-header title="Hasil Pencarian" />

    <div class="space-y-6">
        <p class="text-gray-600">Menampilkan hasil untuk: <span class="font-bold text-gray-800">"{{ $keyword }}"</span>
        </p>

        <x-admin-form-card>
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                📦 Produk Ditemukan ({{ $products->count() }})
            </h3>
            @if ($products->count() > 0)
                <ul class="divide-y divide-gray-100">
                    @foreach ($products as $product)
                        <li class="py-3 flex justify-between hover:bg-gray-50 px-2 rounded">
                            <span>{{ $product->name }}</span>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="admin-action-edit">
                                Lihat &rarr;
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <x-empty-state title="Tidak ada produk ditemukan" message="Tidak ada produk yang cocok dengan kata kunci pencarian." icon="product" />
            @endif
        </x-admin-form-card>

        <x-admin-form-card>
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                👤 User Ditemukan ({{ $users->count() }})
            </h3>
            @if ($users->count() > 0)
                <ul class="divide-y divide-gray-100">
                    @foreach ($users as $user)
                        <li class="py-3 flex justify-between hover:bg-gray-50 px-2 rounded">
                            <div>
                                <p class="font-medium text-gray-800">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $user->email }}</p>
                            </div>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="admin-action-view">
                                Detail &rarr;
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <x-empty-state title="Tidak ada user ditemukan" message="Tidak ada user yang cocok dengan kata kunci pencarian." icon="user" />
            @endif
        </x-admin-form-card>

        <x-admin-form-card>
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                🛒 Order Ditemukan ({{ $orders->count() }})
            </h3>
            @if ($orders->count() > 0)
                <ul class="divide-y divide-gray-100">
                    @foreach ($orders as $order)
                        <li class="py-3 flex justify-between items-center hover:bg-gray-50 px-2 rounded">
                            <div>
                                <span class="font-mono font-bold text-green-600 block">
                                    #{{ $order->order_number }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ $order->customer_name }} - Rp
                                    {{ number_format($order->total_amount, 0, ',', '.') }}
                                </span>
                            </div>

                            <a href="{{ route('admin.orders.show', $order->id) }}" class="admin-action-view">
                                Cek Order &rarr;
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <x-empty-state title="Tidak ada order ditemukan" message="Tidak ada order dengan nomor atau nama tersebut." icon="order" />
            @endif
        </x-admin-form-card>
    </div>
@endsection
