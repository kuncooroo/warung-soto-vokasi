@extends('layouts.admin')

@section('title', 'Detail Pesanan')
@section('header', 'Detail Pesanan')

@section('content')
    <x-admin-page-header title="Detail Pesanan #{{ $order->id }}" />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 space-y-6">
            <x-admin-form-card title="Daftar Produk">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-right">Harga Satuan</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach ($order->items as $item)
                            <tr>
                                <td class="font-semibold text-gray-800">
                                    {{ $item->product->name }}
                                </td>
                                <td class="text-center">
                                    {{ $item->quantity }}
                                </td>
                                <td class="text-right text-gray-700">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </td>
                                <td class="text-right font-bold text-gray-900">
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot class="bg-green-50">
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-700">
                                Total Pembayaran
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-lg text-green-700">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </x-admin-form-card>
        </div>

        <div class="space-y-6">

            <x-admin-form-card title="Informasi Pemesan">
                <div class="space-y-3 text-sm">
                    <div>
                        <span class="block text-gray-500 text-xs uppercase">Nama Pelanggan</span>
                        <span class="font-semibold text-gray-900">{{ $order->customer_name }}</span>
                    </div>

                    <div>
                        <span class="block text-gray-500 text-xs uppercase">Nomor Telepon</span>
                        <span class="font-semibold text-gray-900">{{ $order->customer_phone }}</span>
                    </div>

                    <div>
                        <span class="block text-gray-500 text-xs uppercase">Alamat Pengiriman</span>
                        <span class="font-semibold text-gray-900 leading-relaxed">{{ $order->customer_address }}</span>
                    </div>
                </div>
            </x-admin-form-card>

            <x-admin-form-card title="Update Status">
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">

                        <div>
                            <label class="form-label">Status Pembayaran</label>
                            <select name="payment_status" class="form-select">
                                <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $order->payment_status == 'completed' ? 'selected' : '' }}>Lunas</option>
                                @if ($order->payment_status === 'failed')
                                    <option value="failed" selected>Gagal</option>
                                @endif
                            </select>
                        </div>

                        <div>
                            <label class="form-label">Status Pesanan</label>
                            <select name="status" class="form-select">
                                <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>
                                    Diproses</option>
                                <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>
                                    Selesai</option>
                                <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>
                                    Dibatalkan</option>
                            </select>
                        </div>

                        <button type="submit" class="btn-primary w-full">
                            Simpan Perubahan
                        </button>

                    </div>
                </form>
            </x-admin-form-card>

        </div>
    </div>
@endsection
