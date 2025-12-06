@extends('layouts.public')

@section('title', 'Beranda')

@section('content')

    <section class="relative h-[600px] flex items-center justify-center text-center bg-gray-900">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/home/slider.png') }}" alt="Background Warung"
                class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-black/5"></div>
        </div>

        <div class="relative z-10 max-w-4xl px-4 text-white mt-10">
            <h1 class="text-5xl md:text-6xl font-serif font-bold mb-6 leading-tight tracking-wide">
                Kelezatan Otentik,<br>Disajikan Hangat.
            </h1>

            <p class="text-lg md:text-xl text-gray-200 mb-10 max-w-2xl mx-auto font-light leading-relaxed">
                Temukan cita rasa soto warisan yang tak terlupakan di Soto Vokasi.
            </p>

            <a href="{{ route('menu') }}"
                class="inline-block bg-[#D98718] hover:bg-[#b87314] text-white text-base font-bold py-3 px-10 rounded-full transition duration-300 shadow-lg transform hover:-translate-y-1">
                Explore Menu
            </a>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-gray-800 mb-4">Temukan Menu Kami</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">Pilihan menu favorit terbaik kami yang siap memanjakan lidah
                    Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($products->take(4) as $product)
                    <div
                        class="bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group shadow-sm">

                        <div class="relative h-64 w-full overflow-hidden">
                            @if ($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            @else
                                <div class="w-full h-full bg-gray-50 flex items-center justify-center text-6xl">
                                    🍜
                                </div>
                            @endif

                            <div
                                class="absolute bottom-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-lg shadow-sm">
                                <span class="text-[#D32F2F] font-bold text-sm">
                                    {{ \App\Helpers\Helper::formatRupiah($product->price) }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <h3
                                class="text-xl font-bold text-gray-900 mb-2 line-clamp-1 group-hover:text-[#D32F2F] transition-colors">
                                {{ $product->name }}
                            </h3>

                            <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2">
                                {{ $product->description }}
                            </p>

                            <a href="{{ route('menu') }}"
                                class="w-full py-2.5 rounded-xl bg-gray-50 text-gray-800 font-semibold text-sm hover:bg-[#D32F2F] hover:text-white transition-colors duration-300 text-center block">
                                Pesan Sekarang
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

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
                        <ul class="space-y-4 text-sm text-gray-300">
                            <li class="flex items-start gap-4">
                                <svg class="w-5 h-5 mt-0.5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                <span>+62 877 8571 1752</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <svg class="w-5 h-5 mt-0.5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span>sotovokasi@gmail.com</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <svg class="w-5 h-5 mt-0.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="leading-relaxed">Jl. Veteran Jl. Cikampek No.15, Penanggungan, Kec. Klojen,
                                    Kota Malang, Jawa Timur 65113</span>
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

                    <a href="{{ route('about') }}"
                        class="inline-block border border-gray-800 text-gray-800 font-medium py-3 px-8 rounded-full hover:bg-gray-800 hover:text-white transition duration-300">
                        More About Us
                    </a>
                </div>

            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-12">
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 leading-tight">
                    Kami juga menawarkan <br>
                    layanan unik untuk acara Anda
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <div class="group cursor-pointer">
                    <div class="overflow-hidden rounded-2xl mb-5">
                        <img src="{{ asset('images/home/catering.avif') }}" alt="Catering"
                            class="w-full h-64 object-cover group-hover:scale-110 transition duration-700">
                    </div>
                    <h3 class="font-bold text-xl text-gray-900 mb-2">Catering</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Layanan catering profesional untuk berbagai acara kantor atau rumahan.
                    </p>
                </div>

                <div class="group cursor-pointer">
                    <div class="overflow-hidden rounded-2xl mb-5">
                        <img src="{{ asset('images/home/ultah.png') }}" alt="Ulang Tahun"
                            class="w-full h-64 object-cover group-hover:scale-110 transition duration-700">
                    </div>
                    <h3 class="font-bold text-xl text-gray-900 mb-2">Ulang Tahun</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Rayakan momen spesial dengan hidangan soto yang menghangatkan suasana.
                    </p>
                </div>

                <div class="group cursor-pointer">
                    <div class="overflow-hidden rounded-2xl mb-5">
                        <img src="{{ asset('images/home/pernikahan.avif') }}" alt="Pernikahan"
                            class="w-full h-64 object-cover group-hover:scale-110 transition duration-700">
                    </div>
                    <h3 class="font-bold text-xl text-gray-900 mb-2">Pernikahan</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Menu prasmanan soto otentik untuk tamu undangan di hari bahagia Anda.
                    </p>
                </div>

                <div class="group cursor-pointer">
                    <div class="overflow-hidden rounded-2xl mb-5">
                        <img src="{{ asset('images/home/hajatan.avif') }}" alt="Hajatan"
                            class="w-full h-64 object-cover group-hover:scale-110 transition duration-700">
                    </div>
                    <h3 class="font-bold text-xl text-gray-900 mb-2">Hajatan</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Solusi praktis dan lezat untuk acara syukuran dan kumpul keluarga.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50 overflow-hidden">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 relative z-10">
            <div class="text-center">
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-gray-800 mb-4">Apa Kata Mereka ?</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">Umpan balik asli dari pelanggan tepercaya kami.</p>
            </div>
        </div>

        @php
            $originalItems = $testimoni instanceof \Illuminate\Support\Collection ? $testimoni->toArray() : $testimoni;
            $originalCount = count($originalItems);
        @endphp

        @if ($originalCount > 0)
            @php
                $multiplier = $originalCount < 4 ? 5 : 3;
                $loopedItems = [];
                for ($i = 0; $i < $multiplier; $i++) {
                    $loopedItems = array_merge($loopedItems, $originalItems);
                }
                $totalLoopedCount = count($loopedItems);
            @endphp

            <div x-data="{
                activeSlide: {{ $multiplier == 5 ? $originalCount * 2 : $originalCount }},
                originalCount: {{ $originalCount }},
                totalItems: {{ $totalLoopedCount }},
                isMobile: window.innerWidth < 768,
                isAnimating: false,
                disableTransition: false,
                autoplayInterval: null,
            
                init() {
                    window.addEventListener('resize', () => {
                        this.isMobile = window.innerWidth < 768;
                    });
            
                    this.startAutoplay();
                },
            
                startAutoplay() {
                    this.autoplayInterval = setInterval(() => {
                        this.next();
                    }, 4000);
                },
            
                stopAutoplay() {
                    clearInterval(this.autoplayInterval);
                },
            
                next() {
                    if (this.isAnimating) return;
                    this.isAnimating = true;
            
                    this.activeSlide++;
            
                    setTimeout(() => {
                        if (this.activeSlide >= this.totalItems - this.originalCount) {
                            this.disableTransition = true; 
                            this.activeSlide = this.activeSlide - this.originalCount; 
            
                            this.$nextTick(() => {
                                setTimeout(() => { this.disableTransition = false; }, 50);
                            });
                        }
                        this.isAnimating = false;
                    }, 700);
                },
            
                prev() {
                    if (this.isAnimating) return;
                    this.isAnimating = true;
            
                    this.activeSlide--;
            
                    setTimeout(() => {
                        if (this.activeSlide < this.originalCount) {
                            this.disableTransition = true;
                            this.activeSlide = this.activeSlide + this.originalCount; // Maju 1 set
            
                            this.$nextTick(() => {
                                setTimeout(() => { this.disableTransition = false; }, 50);
                            });
                        }
                        this.isAnimating = false;
                    }, 700);
                },
            
                goToSlide(index) {
                    let offset = {{ $multiplier == 5 ? 2 : 1 }};
                    this.activeSlide = index + (this.originalCount * offset);
                    this.stopAutoplay();
                    this.startAutoplay();
                }
            }" @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()"
                class="relative w-full group">

                <button @click="prev()"
                    class="absolute left-4 md:left-10 top-1/2 -translate-y-1/2 z-40 w-12 h-12 md:w-14 md:h-14 flex items-center justify-center rounded-full bg-white/90 backdrop-blur-sm border border-gray-200 text-gray-700 shadow-lg hover:bg-[#D98718] hover:text-white hover:scale-110 hover:border-[#D98718] transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>

                <button @click="next()"
                    class="absolute right-4 md:right-10 top-1/2 -translate-y-1/2 z-40 w-12 h-12 md:w-14 md:h-14 flex items-center justify-center rounded-full bg-white/90 backdrop-blur-sm border border-gray-200 text-gray-700 shadow-lg hover:bg-[#D98718] hover:text-white hover:scale-110 hover:border-[#D98718] transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>

                <div class="w-full overflow-visible py-10">

                    <div class="flex items-center will-change-transform"
                        :class="disableTransition ? 'transition-none duration-0' :
                            'transition-transform duration-700 ease-[cubic-bezier(0.2,0.8,0.2,1)]'"
                        :style="isMobile
                            ?
                            'transform: translateX(calc(50% - ' + (activeSlide * 100) + '% - 50%))' :
                            'transform: translateX(calc(50% - ' + (activeSlide * 30) + '% - 15%))'">

                        @foreach ($loopedItems as $index => $item)
                            @php
                                $itemObj = (object) $item;
                            @endphp

                            <div class="flex-shrink-0 px-3 md:px-6 transition-all duration-700 ease-in-out"
                                :class="{
                                    'w-[85vw] md:w-[30vw] scale-100 opacity-100 z-30': activeSlide ===
                                        {{ $index }},
                                    'w-[85vw] md:w-[30vw] scale-[0.85] opacity-60 blur-[1px] grayscale-[50%] z-10 cursor-pointer hover:opacity-100 hover:grayscale-0': activeSlide !==
                                        {{ $index }}
                                }"
                                @click="goToSlide({{ $index % $originalCount }})">

                                <div class="bg-white rounded-3xl overflow-hidden h-full flex flex-col relative transition-all duration-300 group/card
                                        border border-gray-100 hover:scale-[1.02] hover:-translate-y-2 hover:shadow-2xl hover:border-[#D98718]/50"
                                    :class="activeSlide === {{ $index }} ? 'shadow-2xl ring-1 ring-gray-100' :
                                        'shadow-sm'">

                                    <div
                                        class="bg-gradient-to-b from-gray-50 to-white p-8 pb-4 flex flex-col items-center justify-center text-center">
                                        <div class="relative">
                                            <div
                                                class="relative z-10 transition-transform duration-300 group-hover/card:scale-110">
                                                @if (isset($itemObj->image) && $itemObj->image)
                                                    <img src="{{ asset($itemObj->image) }}" alt="{{ $itemObj->name }}"
                                                        class="w-24 h-24 rounded-full object-cover shadow-lg border-[5px] border-white">
                                                @else
                                                    <div
                                                        class="w-24 h-24 rounded-full bg-white shadow-lg border-[5px] border-gray-50 flex items-center justify-center text-4xl text-gray-300">
                                                        <span>☻</span>
                                                    </div>
                                                @endif
                                            </div>
                                    
                                        </div>

                                        <div class="mt-6 transition-colors duration-300">
                                            <h4 class="text-xl font-bold text-gray-900 group-hover/card:text-[#D98718]">
                                                {{ $itemObj->name }}
                                            </h4>
                                            <p class="text-xs text-gray-400 font-bold  tracking-widest mt-1">Pelanggan</p>
                                        </div>
                                    </div>

                                    <div class="px-8 pb-8 pt-2 flex flex-col items-center flex-grow bg-white">
                                        <div class="flex space-x-1 mb-6">
                                            @for ($i = 0; $i < 5; $i++)
                                                <svg class="w-5 h-5 {{ $i < $itemObj->rating ? 'text-yellow-400' : 'text-gray-200' }}"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                        </div>
                                        <p class="text-gray-600 text-center leading-relaxed text-base">
                                            "{{ Str::limit($itemObj->message, 150) }}"
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <div x-show="originalCount > 1" x-cloak class="flex justify-center items-center mt-4 space-x-3 pb-8">
                    <template x-for="(item, index) in Array.from({ length: originalCount })">
                        <button @click="goToSlide(index)"
                            class="rounded-full transition-all duration-300 focus:outline-none"
                            :class="(activeSlide % originalCount) === index ? 'w-10 h-2 bg-[#D98718]' :
                                'w-2 h-2 bg-gray-300 hover:bg-gray-400'"
                            aria-label="Go to slide">
                        </button>
                    </template>
                </div>

            </div>
        @else
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center py-12 text-gray-500 bg-white rounded-xl border border-dashed border-gray-300">
                    Belum ada testimoni.
                </div>
            </div>
        @endif
    </section>

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            overflow-x: hidden;
        }
    </style>
@endsection
