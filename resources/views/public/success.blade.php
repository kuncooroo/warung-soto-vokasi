@extends('layouts.public')

@section('title', 'Pembayaran Berhasil')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 text-center">
                <!-- Success Icon -->
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6 animate-bounce">
                    <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                
                <h1 class="text-3xl font-bold text-gray-900 font-serif mb-2">Pembayaran Berhasil!</h1>
                <p class="text-gray-500 mb-8">Terima kasih! Pesanan Anda telah kami terima dan sedang diproses.</p>

                <!-- Order Details Card -->
                <div class="bg-gray-50 rounded-xl p-6 mb-8 text-left max-w-lg mx-auto border border-gray-100">
                    <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-200">
                        <span class="text-gray-600">No. Order</span>
                        <span class="font-bold text-gray-900 tracking-wide">{{ $order->order_number }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-600">Tanggal</span>
                        <span class="font-medium text-gray-900">{{ $order->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-600">Status</span>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 capitalize">
                            {{ $order->payment_status ?? 'Dibayar' }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                        <span class="text-gray-900 font-bold">Total Pembayaran</span>
                        <span class="text-2xl font-bold text-[#A9333A] font-serif">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('orders.show', $order->order_number) }}" 
                       class="inline-flex justify-center items-center px-8 py-3 border border-transparent text-base font-bold rounded-full text-white bg-[#A9333A] hover:bg-[#8E2B32] transition transform hover:-translate-y-1 shadow-lg">
                        Lihat Status Pesanan
                    </a>
                    <a href="{{ route('menu') }}" 
                       class="inline-flex justify-center items-center px-8 py-3 border border-gray-300 text-base font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 transition">
                        Kembali Belanja
                    </a>
                </div>
            </div>
            
            <div class="bg-gray-50 p-4 text-center text-sm text-gray-500 border-t border-gray-100">
                Bukti pembayaran telah dikirim ke email <strong>{{ $order->customer_email }}</strong>
            </div>
        </div>
    </div>
</div>
@endsection