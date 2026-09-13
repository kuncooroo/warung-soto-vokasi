@extends('layouts.public')

@section('title', 'Hubungi Kami')

@section('content')
    <section class="pt-20 pb-10 bg-white text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-5xl md:text-6xl font-serif font-bold text-gray-900 mb-4">Hubungi Kami</h1>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto leading-relaxed">
                Kami senang mendengar dari Anda. Sampaikan kritik, saran, atau pertanyaan Anda.
            </p>
        </div>
    </section>

    <section class="pb-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#A9333A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Alamat Kios
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Jl. Veteran Jl. Cikampek No.15, Penanggungan,<br>
                        Kec. Klojen, Kota Malang, Jawa Timur 65113
                    </p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654z" />
                        </svg>
                        Chat Langsung
                    </h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Lebih cepat via WhatsApp: <strong>+62 8778 5711 752</strong>
                    </p>
                    <a href="https://wa.me/6287785711752?text={{ urlencode('Halo Warung Soto Vokasi, saya ingin bertanya.') }}"
                        target="_blank"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-green-600 text-white font-bold hover:bg-green-700 transition shadow-md text-sm">
                        Chat WhatsApp
                    </a>
                </div>
            </div>

            <div class="bg-gray-50 rounded-2xl p-8 lg:p-12 shadow-sm border border-gray-100">

                <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center font-serif">Kirim Pesan</h3>

                <x-toast type="success" :message="session('success')" />

                @if ($errors->any())
                    <x-toast type="error">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </x-toast>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label-bold">Nama
                                Lengkap</label>
                            <input type="text" name="name" class="form-input-public" placeholder="John Doe" required>
                        </div>
                        <div>
                            <label class="form-label-bold">Email</label>
                            <input type="email" name="email" class="form-input-public" placeholder="john@example.com"
                                required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label-bold">No.
                                Telepon</label>
                            <input type="text" name="phone" class="form-input-public" placeholder="0812xxxx" required>
                        </div>
                        <div>
                            <label class="form-label-bold">Subjek</label>
                            <input type="text" name="subject" class="form-input-public" placeholder="Topik Pesan"
                                required>
                        </div>
                    </div>

                    <div>
                        <label class="form-label-bold">Pesan</label>
                        <textarea name="message" rows="6" class="form-textarea"
                            placeholder="Tulis pesan Anda di sini..." required></textarea>
                    </div>

                    <div class="text-center pt-4">
                        <button type="submit" class="btn-primary-public w-full md:w-auto">
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection
