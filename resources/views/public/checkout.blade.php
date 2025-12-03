@extends('layouts.public')

@section('title', 'Checkout')

@section('content')

<section class="pt-24 pb-16 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4">

        <h2 class="text-4xl font-serif font-bold text-gray-900 mb-10 text-center">
            Checkout Pesanan
        </h2>

        <form id="checkout-form" action="{{ route('order.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf

            <!-- LEFT COLUMN: Customer Data -->
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow">

                <h3 class="text-xl font-bold mb-4 text-gray-800">Data Pemesan</h3>

                <div class="space-y-4">

                    <div>
                        <label class="font-semibold text-gray-700">Nama Lengkap</label>
                        <input type="text" name="customer_name" value="{{ $user->name }}"
                            class="w-full mt-1 p-3 border rounded-lg" required>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-700">Email</label>
                        <input type="email" name="customer_email" value="{{ $user->email }}"
                            class="w-full mt-1 p-3 border rounded-lg" required>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-700">Nomor Telepon</label>
                        <input type="text" name="customer_phone" value="{{ $user->phone ?? '' }}"
                            class="w-full mt-1 p-3 border rounded-lg" required>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-700">Alamat Lengkap</label>
                        <textarea name="customer_address" rows="3" class="w-full mt-1 p-3 border rounded-lg" required>{{ $user->address ?? '' }}</textarea>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-700">Catatan (opsional)</label>
                        <textarea name="notes" rows="3" class="w-full mt-1 p-3 border rounded-lg"></textarea>
                    </div>

                </div>

                <input type="hidden" name="items" value="{{ json_encode(
                    array_map(fn($i) => [
                        'product_id' => $i['product']->id,
                        'quantity' => $i['qty']
                    ], $items)
                ) }}">
            </div>

            <!-- RIGHT COLUMN: Summary -->
            <div class="bg-white p-6 rounded-2xl shadow">

                <h3 class="text-xl font-bold mb-4 text-gray-800">Rangkuman Pesanan</h3>

                <div class="divide-y">

                    @foreach ($items as $item)
                    <div class="py-3 flex justify-between">
                        <div>
                            <p class="font-semibold">{{ $item['product']->name }}</p>
                            <p class="text-sm text-gray-500">{{ $item['qty'] }}x</p>
                        </div>
                        <span class="font-bold text-[#A9333A]">
                            Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                        </span>
                    </div>
                    @endforeach

                </div>

                <div class="border-t pt-4 mt-4">
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total</span>
                        <span class="text-[#A9333A]">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-[#A9333A] text-white py-3 mt-6 rounded-xl font-bold hover:bg-[#8E2B32] transition">
                    Bayar Sekarang
                </button>

            </div>

        </form>

    </div>
</section>

@endsection
