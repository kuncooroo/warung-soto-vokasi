@extends('layouts.public')

@section('title', 'FAQ')

@section('content')

    <section class="pt-24 pb-12 bg-white text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-6xl md:text-7xl font-serif text-gray-900 mb-4 tracking-tight">FAQ</h1>
            <p class="text-gray-500 text-sm md:text-base max-w-xl mx-auto font-light">
                Temukan jawaban atas pertanyaan yang sering diajukan.
            </p>
        </div>
    </section>

    <section class="pb-32 bg-white min-h-[50vh]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">

            <div class="space-y-4">

                @forelse($faqs as $faq)
                    <div
                        class="faq-item border border-gray-400 rounded-lg overflow-hidden bg-white transition-all duration-300 hover:border-gray-600">

                        <button type="button"
                            class="faq-toggle w-full flex justify-between items-start px-6 py-5 text-left focus:outline-none bg-white hover:bg-gray-50 transition-colors cursor-pointer">
                            <span class="text-lg font-medium text-gray-800 pr-4 font-sans leading-tight">
                                {{ $faq->question }}
                            </span>

                            <span
                                class="icon-wrapper transform transition-transform duration-300 flex-shrink-0 text-gray-900 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>

                        <div
                            class="faq-content-wrapper h-0 overflow-hidden transition-all duration-300 ease-in-out opacity-0">
                            <div
                                class="bg-gray-50 px-6 pb-6 pt-2 text-gray-600 leading-relaxed text-sm md:text-base border-t border-gray-200">
                                {!! nl2br(e($faq->answer)) !!}
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="text-center py-12 border border-dashed border-gray-300 rounded-lg">
                        <p class="text-gray-500">Belum ada pertanyaan yang tersedia.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.faq-toggle');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const wrapper = this.nextElementSibling;
                    const icon = this.querySelector('.icon-wrapper');

                    const isOpen = wrapper.style.height && wrapper.style.height !== '0px';

                    if (isOpen) {
                        wrapper.style.height = '0px';
                        wrapper.classList.remove('opacity-100');
                        wrapper.classList.add('opacity-0');
                        icon.classList.remove('rotate-180');
                        this.classList.remove('bg-gray-50');

                    } else {
                        const contentHeight = wrapper.scrollHeight + "px";
                        wrapper.style.height = contentHeight;
                        wrapper.classList.remove('opacity-0');
                        wrapper.classList.add('opacity-100');
                        icon.classList.add('rotate-180');
                        this.classList.add('bg-gray-50');
                    }
                });
            });
        });
    </script>

@endsection
