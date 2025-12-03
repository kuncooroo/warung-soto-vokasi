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

            <div class="bg-gray-50 rounded-2xl p-8 lg:p-12 shadow-sm border border-gray-100">

                <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center font-serif">Kirim Pesan</h3>

                @if (session('success'))
                    <div
                        class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 tracking-wide">Nama
                                Lengkap</label>
                            <input type="text" name="name"
                                class="w-full px-4 py-3 rounded-full bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A9333A] focus:border-transparent transition placeholder-gray-400"
                                placeholder="John Doe" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 tracking-wide">Email</label>
                            <input type="email" name="email"
                                class="w-full px-4 py-3 rounded-full bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A9333A] focus:border-transparent transition placeholder-gray-400"
                                placeholder="john@example.com" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2  tracking-wide">No.
                                Telepon</label>
                            <input type="text" name="phone"
                                class="w-full px-4 py-3 rounded-full bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A9333A] focus:border-transparent transition placeholder-gray-400"
                                placeholder="0812xxxx" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2  tracking-wide">Subjek</label>
                            <input type="text" name="subject"
                                class="w-full px-4 py-3 rounded-full bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A9333A] focus:border-transparent transition placeholder-gray-400"
                                placeholder="Topik Pesan" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 tracking-wide">Pesan</label>
                        <textarea name="message" rows="6"
                            class="w-full px-4 py-3 rounded-xl bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A9333A] focus:border-transparent transition placeholder-gray-400"
                            placeholder="Tulis pesan Anda di sini..." required></textarea>
                    </div>

                    <div class="text-center pt-4">
                        <button type="submit"
                            class="inline-block w-full md:w-auto px-10 py-4 bg-[#A9333A] text-white font-bold rounded-full">
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection
