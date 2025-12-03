@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Detail Pesanan #{{ $order->id }}</h2>
            <a href="{{ url()->previous() }}" class="text-sm text-gray-500 hover:text-gray-700 underline transition">
                &larr; Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="font-semibold text-gray-700">Daftar Produk</h3>
                    </div>
                    
                    <div class="p-0">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 text-gray-600 font-medium text-sm uppercase tracking-wider">
                                <tr>
                                    <th class="px-6 py-3">Produk</th>
                                    <th class="px-6 py-3 text-center">Qty</th>
                                    <th class="px-6 py-3 text-right">Harga Satuan</th>
                                    <th class="px-6 py-3 text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($order->items as $item)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $item->product->name }}</td>
                                        <td class="px-6 py-4 text-center">{{ $item->quantity }}</td>
                                        <td class="px-6 py-4 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right font-medium">
                                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-700">Total Pembayaran</td>
                                    <td class="px-6 py-4 text-right font-bold text-lg text-green-600">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                
                <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                    <h3 class="font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Pemesan</h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <span class="block text-gray-500 text-xs uppercase">Nama Pelanggan</span>
                            <span class="font-medium text-gray-900">{{ $order->customer_name }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500 text-xs uppercase">Nomor Telepon</span>
                            <span class="font-medium text-gray-900">{{ $order->phone }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500 text-xs uppercase">Alamat Pengiriman</span>
                            <span class="font-medium text-gray-900 leading-relaxed">{{ $order->address }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                    <h3 class="font-semibold text-gray-700 mb-4 border-b pb-2">Update Status</h3>
                    
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status Pembayaran</label>
                                <select name="payment_status" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 transition">
                                    <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Dibayar (Paid)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status Pesanan</label>
                                <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 transition">
                                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Diproses</option>
                                    <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                    <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </div>

                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg shadow transition duration-200 flex justify-center items-center gap-2">
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection