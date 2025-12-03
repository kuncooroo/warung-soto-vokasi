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
