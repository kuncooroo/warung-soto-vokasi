@extends('layouts.public')

@section('title', 'Detail Pesanan')

@section('content')
    <section class="pt-16 pb-10 bg-white text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 mb-3">Detail Pesanan</h1>
            <p class="text-gray-500 text-lg">{{ $order->order_number }}</p>
        </div>
    </section>

    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <div>
                        <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        <p class="font-bold text-gray-900">{{ $order->order_number }}</p>
                    </div>
                    <div class="flex gap-2">
                        <x-status-badge :value="$order->payment_status" :variant="$order->payment_status" />
                        <x-status-badge :value="$order->order_status" :variant="$order->order_status" />
                    </div>
                </div>

                <div id="payment-status-alert"
                    class="hidden mb-6 px-4 py-3 rounded-lg bg-yellow-100 text-yellow-800 text-sm font-medium">
                    Menunggu konfirmasi pembayaran, halaman akan ter-update otomatis...
                    <svg class="inline-block w-4 h-4 ml-2 align-middle animate-spin text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                </div>

                <div class="divide-y divide-gray-100">
                    @foreach ($order->items as $item)
                        <div class="py-4 flex justify-between gap-4">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $item->product->name ?? 'Produk' }}</p>
                                <p class="text-sm text-gray-500">{{ $item->quantity }}x
                                    {{ \App\Helpers\Helper::formatRupiah($item->price) }}</p>
                            </div>
                            <p class="font-semibold text-gray-900">
                                {{ \App\Helpers\Helper::formatRupiah($item->subtotal) }}
                            </p>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-200 pt-4 flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Total Pembayaran</span>
                    <span class="text-2xl font-bold text-[#A9333A] font-serif">
                        {{ \App\Helpers\Helper::formatRupiah($order->total_amount) }}
                    </span>
                </div>

                @if ($order->payment_method)
                    <div class="mt-4 pt-4 border-t border-gray-100 text-sm text-gray-500">
                        Metode pembayaran: <span class="font-medium text-gray-700">{{ $order->payment_method }}</span>
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                <h2 class="font-bold text-gray-900 mb-3">Informasi Pengiriman</h2>
                <p class="font-semibold text-gray-800">{{ $order->customer_name }}</p>
                <p class="text-gray-500 text-sm">{{ $order->customer_phone }}</p>
                <p class="text-gray-500 text-sm leading-relaxed mt-2">{{ $order->customer_address }}</p>
                @if ($order->notes)
                    <p class="text-gray-500 text-sm mt-3">Catatan: {{ $order->notes }}</p>
                @endif
            </div>

            <div class="flex flex-col sm:flex-row gap-4">
                @if ($order->payment_status === 'pending')
                    <a href="{{ route('menu') }}"
                        class="inline-flex justify-center items-center px-6 py-3 rounded-full bg-[#A9333A] text-white font-bold hover:bg-[#8E2B32] transition shadow-lg">
                        Kembali Belanja
                    </a>
                @endif
                <a href="{{ route('orders.index') }}"
                    class="inline-flex justify-center items-center px-6 py-3 rounded-full border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition">
                    Kembali ke Daftar Pesanan
                </a>
                <a href="https://wa.me/6287785711752?text={{ urlencode('Halo, saya ingin bertanya tentang pesanan ' . $order->order_number) }}"
                    class="inline-flex justify-center items-center px-6 py-3 rounded-full border border-green-300 text-green-700 font-medium hover:bg-green-50 transition">
                    Chat WhatsApp
                </a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const orderNumber = @json($order->order_number);
        const statusUrl = @json(route('order.status', $order->order_number));

        let attempts = 0;
        const maxAttempts = 120;

        function pollPaymentStatus() {
            if (attempts >= maxAttempts) return;

            fetch(statusUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.payment_status === 'completed') {
                        window.location.href = @json(route('orders.success', $order->order_number));
                        return;
                    }
                })
                .catch(() => {})
                .finally(() => {
                    attempts++;
                });
        }

        function updatePending() {
            const badge = document.getElementById('payment-status-alert');
            if (badge) badge.classList.remove('hidden');
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (@json($order->payment_status) === 'pending') {
                updatePending();
                setInterval(pollPaymentStatus, 5000);
                pollPaymentStatus();
            }
        });
    </script>
@endpush