@extends('layouts.admin')

@section('title', 'Daftar Pesanan')
@section('header', 'Daftar Pesanan')

@section('content')

<x-admin-page-header title="Kelola Pesanan" />

<div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
    <table class="admin-table w-full">
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
                    <x-status-badge :value="$order->payment_status" :variant="$order->payment_status" />
                </td>

                <td class="px-6 py-4">
                    <x-status-badge :value="$order->order_status" :variant="$order->order_status" />
                </td>

                <td class="px-6 py-4 text-center">
                    <a href="{{ route('admin.orders.show', $order->id) }}"
                        class="admin-action-view">
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
