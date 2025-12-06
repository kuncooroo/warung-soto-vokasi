@extends('layouts.admin')

@section('title', 'Daftar Pesanan')
@section('header', 'Daftar Pesanan')

@section('content')

<div class="mb-6 flex justify-between items-center">
    <h3 class="text-xl font-bold text-gray-800">Kelola Pesanan</h3>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
    <table class="w-full">
        <thead class="bg-green-600 text-white">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Order #</th>
                <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Nama</th>
                <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Total</th>
                <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Pembayaran</th>
                <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Status</th>
                <th class="px-6 py-4 text-center text-sm font-semibold tracking-wide">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
            @foreach ($orders as $order)
            <tr class="hover:bg-green-50 transition duration-150">

                <td class="px-6 py-4 font-semibold text-gray-800">
                    {{ $order->order_number }}
                </td>

                <td class="px-6 py-4 text-gray-700">
                    {{ $order->customer_name }}
                </td>

                <td class="px-6 py-4 font-bold text-gray-900">
                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                </td>

                <td class="px-6 py-4">
                    @if ($order->payment_status == 'paid')
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-md text-xs font-bold">
                            PAID
                        </span>
                    @else
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-md text-xs font-bold">
                            PENDING
                        </span>
                    @endif
                </td>

                <td class="px-6 py-4">
                    @php
                        $colors = [
                            'pending' => 'bg-gray-100 text-gray-600',
                            'processing' => 'bg-blue-100 text-blue-600',
                            'completed' => 'bg-green-100 text-green-600',
                            'cancelled' => 'bg-red-100 text-red-600',
                        ];
                    @endphp

                    <span class="px-3 py-1 rounded-md text-xs font-bold {{ $colors[$order->order_status] ?? 'bg-gray-100 text-gray-600' }}">
                        {{ ucfirst($order->order_status) }}
                    </span>
                </td>

                <td class="px-6 py-4 text-center">
                    <a href="{{ route('admin.orders.show', $order->id) }}"
                        class="px-3 py-1 bg-green-600 text-white rounded-md text-xs font-semibold hover:bg-green-700 transition shadow-sm">
                        Detail
                    </a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="px-6 py-4 bg-gray-50">
        {{ $orders->links() }}
    </div>
</div>

@endsection
