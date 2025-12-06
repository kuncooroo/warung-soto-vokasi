@extends('layouts.admin')

@section('title', 'Detail Pesanan')
@section('header', 'Detail Pesanan')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h3 class="text-xl font-bold text-gray-800">Detail Pesanan #{{ $order->id }}</h3>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">

                <div class="bg-green-600 px-6 py-4 border-b border-green-700">
                    <h3 class="font-semibold text-white">Daftar Produk</h3>
                </div>

                <table class="w-full">
                    <thead class="bg-green-50 text-green-700 font-semibold text-sm uppercase tracking-wide">
                        <tr>
                            <th class="px-6 py-3 text-left">Produk</th>
                            <th class="px-6 py-3 text-center">Jumlah</th>
                            <th class="px-6 py-3 text-right">Harga Satuan</th>
                            <th class="px-6 py-3 text-right">Total</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach ($order->items as $item)
                            <tr class="hover:bg-green-50 transition">
                                <td class="px-6 py-4 font-semibold text-gray-800">
                                    {{ $item->product->name }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ $item->quantity }}
                                </td>
                                <td class="px-6 py-4 text-right text-gray-700">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-gray-900">
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
            </div>
        </div>

        <div class="space-y-6">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Pemesan</h3>

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
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-700 mb-4 border-b pb-2">Update Status</h3>

                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Pembayaran</label>
                            <select name="payment_status"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-600 focus:ring-green-600 transition">
                                <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Dibayar
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Pesanan</label>
                            <select name="status"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-600 focus:ring-green-600 transition">
                                <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>
                                    Diproses</option>
                                <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>
                                    Selesai</option>
                                <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>
                                    Dibatalkan</option>
                            </select>
                        </div>

                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition duration-200">
                            Simpan Perubahan
                        </button>

                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
