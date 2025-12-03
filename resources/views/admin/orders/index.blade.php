@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Daftar Pesanan</h2>

    <div class="bg-white shadow rounded-xl p-4">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-3">Order #</th>
                    <th class="py-3">Nama</th>
                    <th class="py-3">Total</th>
                    <th class="py-3">Pembayaran</th>
                    <th class="py-3">Status</th>
                    <th class="py-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orders as $order)
                <tr class="border-b">
                    <td class="py-3">{{ $order->order_number }}</td>
                    <td class="py-3">{{ $order->customer_name }}</td>
                    <td class="py-3 font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>

                    <td class="py-3">
                        @if ($order->payment_status == 'paid')
                        <span class="px-2 py-1 bg-green-100 text-green-600 rounded-lg text-xs">PAID</span>
                        @else
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-600 rounded-lg text-xs">PENDING</span>
                        @endif
                    </td>

                    <td class="py-3">
                        @php
                            $colors = [
                                'pending' => 'bg-gray-100 text-gray-600',
                                'processing' => 'bg-blue-100 text-blue-600',
                                'completed' => 'bg-green-100 text-green-600',
                                'cancelled' => 'bg-red-100 text-red-600',
                            ];
                        @endphp

                        <span class="px-2 py-1 rounded-lg text-xs {{ $colors[$order->order_status] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ ucfirst($order->order_status) }}
                        </span>
                    </td>

                    <td class="py-3">
                        <a href="{{ route('admin.orders.show', $order->id) }}" 
                           class="px-3 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700">
                           Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
