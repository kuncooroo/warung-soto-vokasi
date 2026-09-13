@extends('layouts.public')

@section('title', 'Pesanan Saya')

@section('content')
    <section class="pt-16 pb-10 bg-white text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 mb-3">Pesanan Saya</h1>
            <p class="text-gray-500 text-lg">Pantau status pemesanan dan pembayaran Anda di sini.</p>
        </div>
    </section>

    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 px-4 py-3 rounded-lg bg-green-100 text-green-700 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @forelse ($orders as $order)
                <a href="{{ route('orders.show', $order->order_number) }}"
                    class="group block bg-white rounded-2xl shadow-sm hover:shadow-lg border border-gray-100 p-6 mb-4 transition-all duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-[#A9333A] bg-opacity-10 text-[#A9333A] flex items-center justify-center font-bold text-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 group-hover:text-[#A9333A] transition-colors">
                                    {{ $order->order_number }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $order->created_at->format('d M Y, H:i') }} ·
                                    {{ $order->items->sum('quantity') }} item
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="text-right">
                                <p class="text-xs text-gray-400 uppercase tracking-wide">Total</p>
                                <p class="font-bold text-[#A9333A]">
                                    {{ \App\Helpers\Helper::formatRupiah($order->total_amount) }}
                                </p>
                            </div>
                            <div class="flex flex-col items-end gap-1">
                                <x-status-badge :value="$order->payment_status" :variant="$order->payment_status" />
                                <x-status-badge :value="$order->order_status" :variant="$order->order_status" />
                            </div>
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-[#A9333A] group-hover:translate-x-1 transition-all"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            @empty
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                    <p class="text-6xl mb-4">🧾</p>
                    <h2 class="text-xl font-bold text-gray-900 mb-2">Belum ada pesanan</h2>
                    <p class="text-gray-500 mb-6">Yuk pesan soto favoritmu sekarang!</p>
                    <a href="{{ route('menu') }}"
                        class="inline-block px-8 py-3 rounded-full bg-[#A9333A] text-white font-bold hover:bg-[#8E2B32] transition shadow-lg">
                        Lihat Menu
                    </a>
                </div>
            @endforelse

            <div class="mt-8">
                {{ $orders->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection