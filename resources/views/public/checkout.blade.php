@extends('layouts.public')

@section('title', 'Checkout')

@section('content')

    <section class="pt-20 pb-10 bg-white text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-5xl md:text-6xl font-serif font-bold text-gray-900 mb-4">Checkout Pesanan</h1>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto leading-relaxed">
                Periksa kembali pesanan Anda dan lengkapi data pengiriman.
            </p>
        </div>
    </section>

    <section class="pb-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <form id="checkout-form" action="{{ route('order.store') }}" method="POST">
                @csrf

                <div
                    class="bg-gray-50 rounded-2xl p-6 mb-8 flex flex-col md:flex-row justify-between items-center shadow-sm border border-gray-100">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 font-serif">Ringkasan Keranjang</h2>
                        <p class="text-sm text-gray-500 mt-1 tracking-wide">{{ count($items) }} items dalam keranjang</p>
                    </div>
                    <div class="mt-4 md:mt-0 text-right">
                        <p class="text-sm text-gray-500 mb-1 tracking-wide">Total yang harus dibayar</p>
                        <span class="text-3xl font-bold text-[#A9333A] font-serif">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                        <div class="text-xs text-green-600 font-semibold mt-1">
                            {{ date('d M Y') }}
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-2 space-y-6">

                        <div class="bg-gray-50 rounded-2xl p-8 shadow-sm border border-gray-100">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6 font-serif">Detail Pesanan</h3>

                            <div class="space-y-6">
                                @foreach ($items as $item)
                                    <div class="flex gap-6 items-start bg-white p-4 rounded-2xl border border-gray-100">

                                        <div
                                            class="w-24 h-24 flex-shrink-0 overflow-hidden rounded-xl border border-gray-200">
                                            @if ($item['product']->image)
                                                <img src="{{ asset($item['product']->image) }}"
                                                    alt="{{ $item['product']->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div
                                                    class="w-full h-full bg-gray-50 flex items-center justify-center text-4xl">
                                                    🍜
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex-1">
                                            <h5 class="text-lg font-bold text-gray-900 font-serif">
                                                {{ $item['product']->name }}</h5>
                                            <p class="text-sm text-gray-500 mt-1 tracking-wide">Jumlah: {{ $item['qty'] }}
                                            </p>
                                            <p class="font-bold text-[#A9333A] mt-2">
                                                Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                            </p>
                                        </div>

                                        <div class="hidden md:block">
                                            <span
                                                class="text-xs font-semibold text-orange-600 bg-orange-100 px-3 py-1 rounded-full flex items-center gap-1">
                                                Pending
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">

                        <div class="bg-gray-50 rounded-2xl p-8 shadow-sm border border-gray-100">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6 font-serif">Alamat Pengiriman</h3>

                            <div class="space-y-5">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2 tracking-wide">Penerima</label>
                                    <input type="text" name="customer_name" value="{{ $user->name }}"
                                        class="w-full px-4 py-3 rounded-full bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A9333A] focus:border-transparent transition placeholder-gray-400"
                                        required placeholder="Nama Lengkap">
                                </div>

                                <div class="grid grid-cols-1 gap-5">
                                    <div>
                                        <label
                                            class="block text-sm font-bold text-gray-700 mb-2 tracking-wide">Email</label>
                                        <input type="email" name="customer_email" value="{{ $user->email }}"
                                            class="w-full px-4 py-3 rounded-full bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A9333A] focus:border-transparent transition placeholder-gray-400"
                                            required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2 tracking-wide">No.
                                            HP</label>
                                        <input type="text" name="customer_phone" value="{{ $user->phone ?? '' }}"
                                            class="w-full px-4 py-3 rounded-full bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A9333A] focus:border-transparent transition placeholder-gray-400"
                                            required placeholder="08...">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2 tracking-wide">Alamat
                                        Lengkap</label>
                                    <textarea name="customer_address" rows="3"
                                        class="w-full px-4 py-3 rounded-xl bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A9333A] focus:border-transparent transition placeholder-gray-400"
                                        required placeholder="Jalan, No Rumah, Kota, Kode Pos">{{ $user->address ?? '' }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2 tracking-wide">Catatan
                                        (Opsional)</label>
                                    <textarea name="notes" rows="2"
                                        class="w-full px-4 py-3 rounded-xl bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A9333A] focus:border-transparent transition placeholder-gray-400"
                                        placeholder="Pesan tambahan untuk penjual"></textarea>
                                </div>
                            </div>

                            <input type="hidden" name="items"
                                value="{{ json_encode(
                                    array_map(
                                        fn($i) => [
                                            'product_id' => $i['product']->id,
                                            'quantity' => $i['qty'],
                                        ],
                                        $items,
                                    ),
                                ) }}">
                        </div>

                        <div class="bg-white rounded-2xl p-8 shadow-sm border-2 border-gray-100">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 font-serif">Rincian Pembayaran</h3>

                            <div class="space-y-3 text-sm text-gray-600 pb-6 mb-6 border-b border-dashed border-gray-200">
                                @foreach ($items as $item)
                                    <div class="flex justify-between">
                                        <span class="truncate pr-4">{{ $item['product']->name }}
                                            (x{{ $item['qty'] }})
                                        </span>
                                        <span class="font-medium text-gray-900">Rp
                                            {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                                    </div>
                                @endforeach

                                <div class="flex justify-between pt-2">
                                    <span>Biaya Pengiriman</span>
                                    <span class="font-medium text-green-600">Gratis</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center mb-8">
                                <span class="text-lg font-bold text-gray-900">Total Akhir</span>
                                <span class="text-2xl font-bold text-[#A9333A] font-serif">
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>

                            <button type="submit"
                                class="w-full py-4 bg-[#A9333A] text-white font-bold rounded-full shadow-lg hover:bg-[#8E2B32] transition transform hover:-translate-y-1">
                                Bayar Sekarang
                            </button>

                            <p class="text-xs text-center text-gray-400 mt-4 flex justify-center items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                                Transaksi Aman & Terenkripsi
                            </p>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </section>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('checkout-form');
            const payButton = form.querySelector('button[type="submit"]');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                const originalText = payButton.innerText;
                payButton.disabled = true;
                payButton.innerText = 'Memproses...';

                try {
                    const formData = new FormData(form);
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        throw new Error(result.message || 'Terjadi kesalahan saat memproses pesanan');
                    }

                    if (result.success && result.snap_token) {
                        window.snap.pay(result.snap_token, {
                            onSuccess: function(result) {
                                window.location.href = '/orders/success/' + result.order_id;
                            },

                            onPending: function(result) {


                                console.log('Menunggu pembayaran...', result);
                                window.location.href =
                                    '/orders';
                            },

                            onError: function(result) {
                                alert("Pembayaran gagal!");
                                payButton.disabled = false;
                                payButton.innerText = originalText;
                            },


                            onClose: function() {



                                window.location.href =
                                    '/orders';
                            }
                        });
                    } else {
                        alert('Gagal mendapatkan token pembayaran.');
                        payButton.disabled = false;
                        payButton.innerText = originalText;
                    }

                } catch (error) {
                    console.error(error);
                    alert('Error: ' + error.message);
                    payButton.disabled = false;
                    payButton.innerText = originalText;
                }
            });
        });
    </script>
@endsection
