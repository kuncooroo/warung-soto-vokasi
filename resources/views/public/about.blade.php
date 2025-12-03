@extends('layouts.public')

@section('title', 'Tentang Kami')

@section('content')
    <section class="bg-[#F9F9F9] py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">

                <div class="w-full lg:w-1/2 relative">
                    <div class="rounded-xl overflow-hidden shadow-lg">
                        <img src="{{ asset('images/about/about.jpg') }}" alt="Warung Soto Vokasi"
                            class="w-full h-[500px] object-cover">
                    </div>

                    <div
                        class="hidden md:block absolute -bottom-10 -right-10 bg-[#383838] text-white p-8 rounded-lg shadow-2xl max-w-sm z-10">
                        <h4 class="font-bold text-lg mb-6">Datang dan Kunjungi Kami</h4>

                        <ul class="space-y-5 text-sm">
                            <li class="flex items-start gap-4">
                                <svg class="w-5 h-5 mt-0.5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                <span class="text-gray-100 font-medium">+62 877 8571 1752</span>
                            </li>

                            <li class="flex items-start gap-4">
                                <svg class="w-5 h-5 mt-0.5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="text-gray-100 font-medium">sotovokasi@gmail.com</span>
                            </li>

                            <li class="flex items-start gap-4">
                                <svg class="w-5 h-5 mt-0.5 text-white flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-gray-100 leading-relaxed font-medium">
                                    Jl. Veteran Jl. Cikampek No.15, Penanggungan, Kec. Klojen, Kota Malang, Jawa Timur 65113
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="w-full lg:w-1/2 lg:pl-12 mt-12 lg:mt-0">
                    <h2 class="text-4xl lg:text-5xl font-serif font-bold mb-8 text-gray-900 leading-tight">
                        Cerita Hangat dari <br> Semangkuk Soto
                    </h2>

                    <p class="text-gray-600 mb-6 leading-relaxed text-lg">
                        Soto Vokasi lahir dari mimpi sederhana melestarikan resep otentik warisan keluarga.
                        Sejak 2020, kami berkomitmen menyajikan soto yang tidak hanya lezat, tetapi juga mampu
                        membangkitkan kenangan dan kehangatan dalam setiap mangkuknya.
                    </p>

                    <p class="text-gray-600 mb-10 leading-relaxed text-lg">
                        Kami percaya bahwa makanan enak berasal dari bahan-bahan terbaik dan hati yang tulus.
                        Datang dan cicipi sendiri perbedaannya.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section class="relative w-full h-[500px] bg-fixed bg-center bg-cover bg-no-repeat"
        style="background-image: url('{{ asset('images/about/about2.png') }}');">

        <div class="absolute inset-0 bg-black/60"></div>

        <div class="relative z-10 h-full flex items-center justify-center px-4">
            <h2
                class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white text-center leading-tight tracking-wide drop-shadow-lg">
                Dari ide sederhana <br class="hidden md:block">
                hingga menjadi favorit <br>
                di hati Anda.
            </h2>
        </div>
    </section>

    <section class="py-20 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

                <div class="flex items-start gap-5">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/about/resep.png') }}" alt="Resep Rahasia"
                            class="w-12 h-12 object-contain">
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Resep Rahasia</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Cita rasa otentik dari bahan pilihan dan bumbu rahasia warisan keluarga.
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-5">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/about/pesanan.png') }}" alt="Mudah Dipesan"
                            class="w-12 h-12 object-contain">
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Mudah Dipesan</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Tersedia di GoFood, GrabFood, & ShopeeFood. Pesan soto favorit Anda kapan saja.
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-5">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/about/kirim.png') }}" alt="Pengiriman Cepat"
                            class="w-12 h-12 object-contain">
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Pengiriman Cepat</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Driver kami siap mengantarkan pesanan Anda dalam kondisi hangat dan cepat sampai.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-[#F9F9F9] py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">

                <div class="w-full lg:w-1/2">
                    <h2 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 mb-3">
                        Sang Peracik Rasa
                    </h2>

                    <h3 class="text-xl font-serif text-[#D98718] mb-6">
                        Bapak Budi Santoso
                    </h3>

                    <p class="text-gray-600 leading-relaxed mb-10 text-lg">
                        Dengan pengalaman lebih dari satu dekade, Bapak Budi adalah hati dan jiwa dari dapur Soto Vokasi.
                        Kecintaannya pada kuliner tradisional menginspirasi kami untuk terus menjaga kualitas.
                    </p>

                    <div class="grid grid-cols-2 gap-6">
                        <div
                            class="border border-gray-200 rounded-xl p-8 text-center shadow-[0_2px_15px_rgba(0,0,0,0.03)] hover:shadow-lg transition duration-300">
                            <div class="text-4xl font-serif font-bold text-gray-900 mb-2">2</div>
                            <div class="text-sm text-gray-500 font-medium">Lokasi</div>
                        </div>

                        <div
                            class="border border-gray-200 rounded-xl p-8 text-center shadow-[0_2px_15px_rgba(0,0,0,0.03)] hover:shadow-lg transition duration-300">
                            <div class="text-4xl font-serif font-bold text-gray-900 mb-2">2010</div>
                            <div class="text-sm text-gray-500 font-medium">Didirikan</div>
                        </div>

                        <div
                            class="border border-gray-200 rounded-xl p-8 text-center shadow-[0_2px_15px_rgba(0,0,0,0.03)] hover:shadow-lg transition duration-300">
                            <div class="text-4xl font-serif font-bold text-gray-900 mb-2">4</div>
                            <div class="text-sm text-gray-500 font-medium">Anggota Staf</div>
                        </div>

                        <div
                            class="border border-gray-200 rounded-xl p-8 text-center shadow-[0_2px_15px_rgba(0,0,0,0.03)] hover:shadow-lg transition duration-300">
                            <div class="text-4xl font-serif font-bold text-gray-900 mb-2">100%</div>
                            <div class="text-sm text-gray-500 font-medium">Pelanggan Puas</div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-1/2">
                    <div class="relative h-[600px] rounded-2xl overflow-hidden shadow-xl">
                        <img src="{{ asset('images/about/about3.png') }}" alt="Bapak Hadi Santoso"
                            class="w-full h-full object-cover">
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
