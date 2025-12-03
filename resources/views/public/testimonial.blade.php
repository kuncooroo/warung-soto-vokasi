@extends('layouts.public')

@section('title', 'Testimoni')

@section('content')

    <section class="relative h-[600px] flex items-center justify-center text-center bg-gray-900">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/home/slider.avif') }}" alt="Background Warung"
                class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-black/60"></div>
        </div>

        <div class="relative z-10 max-w-4xl px-4 text-white mt-10">
            <h1 class="text-5xl md:text-6xl font-serif font-bold mb-6 leading-tight tracking-wide">
                Bagikan Testimoni Anda
            </h1>

            <p class="text-lg md:text-xl text-gray-200 mb-10 max-w-2xl mx-auto font-light leading-relaxed">
                Ceritakan pengalaman anda menikmati soto kami
            </p>

            <button onclick="openModal()"
                class="px-10 py-4 bg-[#A9333A] text-white font-bold rounded-full hover:bg-[#8e2b32] transition-all shadow-lg transform hover:-translate-y-1">
                Tulis Testimoni
            </button>
        </div>
    </section>

    <section class="py-10 bg-white">
        <div class="max-w-4xl mx-auto px-4">
            @if (session('success'))
                <div
                    class="p-6 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-4 shadow-sm">
                    <div class="bg-green-100 p-2 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg">Terima Kasih!</h4>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- GALLERY SECTION --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <span class="inline-block px-4 py-1.5 bg-red-50 text-[#A9333A] text-sm font-bold rounded-full mb-4 tracking-wide">
                    GALERI KAMI
                </span>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-gray-800 mb-4">Momen Bersama Pelanggan</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">Lihat kebahagiaan pelanggan kami saat menikmati Soto Vokasi</p>
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- Main Large Image -->
                <div class="col-span-2 row-span-2 h-[400px]">
    <div class="relative group overflow-hidden rounded-2xl h-full shadow-lg hover:shadow-2xl transition-all duration-300">
        <img src="{{ asset('images/gallery/fotopaknya.jpeg') }}" 
             alt="Gallery 1" 
             class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    </div>
</div>

                <!-- Small Images -->
                <div class="relative group overflow-hidden rounded-2xl h-48 shadow-lg hover:shadow-2xl transition-all duration-300">
                    <img src="{{ asset('images/gallery/makan.jpg') }}" 
                         alt="Gallery 2" 
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <div class="relative group overflow-hidden rounded-2xl h-48 shadow-lg hover:shadow-2xl transition-all duration-300">
                    <img src="{{ asset('images/gallery/grobak.webp') }}" 
                         alt="Gallery 3" 
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <div class="relative group overflow-hidden rounded-2xl h-48 shadow-lg hover:shadow-2xl transition-all duration-300">
                    <img src="{{ asset('images/gallery/soto_1.jpg') }}" 
                         alt="Gallery 4" 
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <div class="relative group overflow-hidden rounded-2xl h-48 shadow-lg hover:shadow-2xl transition-all duration-300">
                    <img src="{{ asset('images/gallery/paklek.jpeg') }}" 
                         alt="Gallery 5" 
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>


        </div>
    </section>

    {{-- DISPLAY EXISTING TESTIMONIALS (DATA DARI CONTROLLER) --}}
    @php
        $testimoniCount = $approvedTestimonials->count();
    @endphp

    @if ($testimoniCount > 0)
        <section class="py-20 bg-gray-50 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Header Section -->
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-serif font-bold text-gray-800 mb-4">Testimoni Pelanggan Kami</h2>
                    <p class="text-gray-500 max-w-2xl mx-auto">Lihat apa kata mereka tentang Soto Vokasi</p>
                </div>

                <!-- Featured Testimonial -->
                <div class="mb-16" x-data="{ current: 0, total: {{ min($testimoniCount, 3) }} }" x-init="setInterval(() => { current = (current + 1) % total }, 5000)">
                    <div class="relative max-w-5xl mx-auto">
                        @foreach ($approvedTestimonials->take(3) as $index => $item)
                            <div x-show="current === {{ $index }}"
                                 x-transition:enter="transition ease-out duration-500"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100"
                                 x-transition:leave="transition ease-in duration-300"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0"
                                 style="display: {{ $index === 0 ? 'block' : 'none' }}"
                                 class="bg-gradient-to-br from-[#A9333A] to-[#8e2b32] rounded-3xl p-8 md:p-12 shadow-2xl">
                                
                                <div class="flex flex-col md:flex-row items-center gap-8">
                                    <!-- Quote Icon -->
                                    <div class="flex-shrink-0">
                                        <svg class="w-16 h-16 text-white/30" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14.017 21v-3c0-1.105.895-2 2-2h3c.552 0 1-.448 1-1V9c0-.552-.448-1-1-1h-4c-.552 0-1 .448-1 1v2c0 .552-.448 1-1 1h-1V5h10v6c0 3.314-2.686 6-6 6h-2zM5.017 21v-3c0-1.105.895-2 2-2h3c.552 0 1-.448 1-1V9c0-.552-.448-1-1-1h-4c-.552 0-1 .448-1 1v2c0 .552-.448 1-1 1h-1V5h10v6c0 3.314-2.686 6-6 6h-2z"/>
                                        </svg>
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-grow text-center md:text-left">
                                        <p class="text-white text-xl md:text-2xl font-light leading-relaxed mb-6">
                                            "{{ $item->message }}"
                                        </p>
                                        <div class="flex items-center justify-center md:justify-start gap-1 mb-4">
                                            @for ($i = 0; $i < 5; $i++)
                                                <svg class="w-5 h-5 {{ $i < $item->rating ? 'text-yellow-300' : 'text-white/30' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>

                                    <!-- Customer Info -->
                                    <div class="flex-shrink-0 text-center">
                                        @if ($item->image)
                                            <img src="{{ asset($item->image) }}" alt="{{ $item->name }}"
                                                 class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-lg mx-auto mb-3">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($item->name) }}&background=fff&color=A9333A&size=200" alt="{{ $item->name }}"
                                                 class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-lg mx-auto mb-3">
                                        @endif
                                        <h4 class="text-white font-bold text-lg">{{ $item->name }}</h4>
                                        <p class="text-white/80 text-sm">Pelanggan</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Pagination Dots -->
                        @if ($approvedTestimonials->take(3)->count() > 1)
                            <div class="flex justify-center items-center gap-2 mt-6">
                                @foreach ($approvedTestimonials->take(3) as $index => $item)
                                    <button @click="current = {{ $index }}"
                                            class="transition-all duration-500"
                                            :class="current === {{ $index }} ? 'w-8 h-2 bg-[#A9333A]' : 'w-2 h-2 bg-gray-300 hover:bg-gray-400'"
                                            style="border-radius: 999px;">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Testimonial Cards Grid -->
                <div class="relative" x-data="{ page: 0, perPage: 3, items: @js($approvedTestimonials) }">
                    <!-- Navigation Buttons -->
                    <button @click="page = Math.max(0, page - 1)" 
                            x-show="page > 0"
                            class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-6 z-10 w-12 h-12 flex items-center justify-center rounded-full bg-white shadow-lg text-gray-600 hover:bg-[#A9333A] hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    <button @click="page = Math.min(Math.ceil(items.length / perPage) - 1, page + 1)" 
                            x-show="page < Math.ceil(items.length / perPage) - 1"
                            class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-6 z-10 w-12 h-12 flex items-center justify-center rounded-full bg-white shadow-lg text-gray-600 hover:bg-[#A9333A] hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    <!-- Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <template x-for="(item, index) in items.slice(page * perPage, (page + 1) * perPage)" :key="item.id || index">
                            <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                <!-- Title -->
                                <h3 class="text-xl font-bold text-gray-900 mb-3" 
                                    x-text="item.message.split(' ').slice(0, 2).join(' ') + '!'">
                                </h3>

                                <!-- Stars -->
                                <div class="flex gap-1 mb-4">
                                    <template x-for="star in 5" :key="star">
                                        <svg class="w-5 h-5" :class="star <= item.rating ? 'text-yellow-400' : 'text-gray-200'" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </template>
                                </div>

                                <!-- Message -->
                                <p class="text-gray-600 mb-6 line-clamp-3" x-text="item.message"></p>

                                <!-- Customer Info -->
                                <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                                    <img :src="item.image ? `{{ asset('') }}${item.image}` : 'https://ui-avatars.com/api/?name=' + encodeURIComponent(item.name) + '&background=f3f4f6&color=A9333A&size=80'"
                                         :alt="item.name"
                                         class="w-10 h-10 rounded-full object-cover">
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm" x-text="item.name"></h4>
                                        <p class="text-xs text-gray-500">Pelanggan</p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

            </div>
        </section>
    @endif

    <div id="testimonial-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">

        <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-gray-100">

                <button type="button" onclick="closeModal()"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 z-10">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">

                        <h3 class="text-2xl font-bold text-gray-900 mb-2 text-center font-serif" id="modal-title">
                            Formulir Testimoni
                        </h3>
                        <p class="text-gray-500 mb-6 text-center text-sm">Pendapat Anda sangat berarti bagi kami.</p>

                        @if ($errors->any())
                            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm text-left">
                                <p class="font-bold mb-1">Ada kesalahan input:</p>
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data"
                            class="space-y-5 text-left">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text" name="name"
                                        class="w-full px-4 py-2.5 rounded-lg bg-gray-50 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A9333A] transition"
                                        placeholder="John Doe" required value="{{ old('name') }}">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                                    <input type="email" name="email"
                                        class="w-full px-4 py-2.5 rounded-lg bg-gray-50 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A9333A] transition"
                                        placeholder="john@example.com" required value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-xl text-center border border-gray-200">
                                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Beri Penilaian</label>
                                <div class="flex justify-center gap-2" id="star-container">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer group relative">
                                            <input type="radio" name="rating" value="{{ $i }}" class="hidden"
                                                data-rating="{{ $i }}" required
                                                {{ old('rating') == $i ? 'checked' : '' }}>
                                            <span
                                                class="text-4xl rating-star transition-transform duration-200 block group-hover:scale-110"
                                                style="color: #cbd5e1;" data-rating="{{ $i }}">★</span>
                                        </label>
                                    @endfor
                                </div>
                                <p class="text-xs text-gray-400 mt-2 italic" id="rating-text">Klik bintang untuk menilai</p>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Cerita Anda</label>
                                <textarea name="message" rows="4"
                                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A9333A] resize-none"
                                    placeholder="Bagaimana pengalaman Anda?" required>{{ old('message') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Foto (Opsional)</label>
                                <input type="file" name="image"
                                    class="w-full px-4 py-2 rounded-lg bg-gray-50 border border-gray-300 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-[#A9333A]/10 file:text-[#A9333A] hover:file:bg-[#A9333A]/20 cursor-pointer"
                                    accept="image/*">
                            </div>

                            <div class="pt-2">
                                <button type="submit"
                                    class="w-full py-3 bg-[#A9333A] text-white font-bold rounded-lg hover:bg-[#8e2b32] transition-colors shadow-md">
                                    Kirim Testimoni
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('testimonial-modal');

        function openModal() {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                openModal();
            });
        @endif

        document.addEventListener('DOMContentLoaded', function() {
            const ratingStars = document.querySelectorAll('.rating-star');
            const starContainer = document.getElementById('star-container');
            const ratingText = document.getElementById('rating-text');
            let selectedRating = {{ old('rating', 0) }};

            const messages = ["Sangat Buruk", "Buruk", "Cukup", "Baik", "Sangat Baik!"];

            if (selectedRating > 0) {
                updateStars(selectedRating);
                ratingText.textContent = messages[selectedRating - 1];
                ratingText.style.color = '#A9333A';
                ratingText.style.fontWeight = 'bold';
            }

            ratingStars.forEach(star => {
                star.addEventListener('click', function() {
                    selectedRating = this.dataset.rating;
                    document.querySelector(`input[value="${selectedRating}"]`).checked = true;
                    updateStars(selectedRating);

                    ratingText.textContent = messages[selectedRating - 1];
                    ratingText.style.color = '#A9333A';
                    ratingText.style.fontWeight = 'bold';
                });

                star.addEventListener('mouseover', function() {
                    updateStars(this.dataset.rating);
                });
            });

            starContainer.addEventListener('mouseleave', function() {
                updateStars(selectedRating);
            });

            function updateStars(rating) {
                ratingStars.forEach(star => {
                    if (star.dataset.rating <= rating) {
                        star.textContent = '★';
                        star.style.color = '#FFD700';
                        star.style.textShadow = '0 0 5px rgba(255, 215, 0, 0.5)';
                    } else {
                        star.textContent = '☆';
                        star.style.color = '#cbd5e1';
                        star.style.textShadow = 'none';
                    }
                });
            }
        });
    </script>
@endsection