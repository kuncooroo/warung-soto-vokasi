@extends('layouts.admin')
{{-- Sesuaikan dengan nama layout utamamu --}}

@section('title', 'Hasil Pencarian')
@section('header', 'Hasil Pencarian')

@section('content')
    <div class="space-y-6">
        <p class="text-gray-600">Menampilkan hasil untuk: <span class="font-bold text-gray-800">"{{ $keyword }}"</span>
        </p>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                📦 Produk Ditemukan ({{ $products->count() }})
            </h3>
            @if ($products->count() > 0)
                <ul class="divide-y divide-gray-100">
                    @foreach ($products as $product)
                        <li class="py-3 flex justify-between hover:bg-gray-50 px-2 rounded">
                            <span>{{ $product->name }}</span>
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                class="text-sm text-green-600 font-semibold">Lihat &rarr;</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-400 text-sm italic">Tidak ada produk ditemukan.</p>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
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
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="text-sm text-green-600 font-semibold">Detail &rarr;</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-400 text-sm italic">Tidak ada user ditemukan.</p>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
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

                            <a href="{{ route('admin.orders.show', $order->id) }}"
                                class="text-sm bg-green-50 text-green-600 py-1 px-3 rounded-lg font-semibold hover:bg-green-100 transition">
                                Cek Order &rarr;
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-400 text-sm italic">Tidak ada order dengan nomor atau nama tersebut.</p>
            @endif
        </div>
    </div>
@endsection
