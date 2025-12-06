@extends('layouts.profil')

@section('title', 'Edit Profil')

@section('content')
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-6xl mx-auto px-4">

            <div class="bg-white rounded-3xl shadow-md border border-gray-100 p-8 mb-10">
                <div class="flex flex-col md:flex-row md:items-center gap-8">

                    <div class="relative w-32 h-32">
                        <div class="w-32 h-32 rounded-full overflow-hidden shadow-lg border-4 border-white bg-gray-100">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-5xl font-bold text-primary">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <span
                            class="absolute bottom-2 right-2 w-5 h-5 bg-green-500 border-2 border-white rounded-full"></span>
                    </div>

                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                        <p class="text-gray-500">{{ $user->email }}</p>

                        <div class="flex flex-wrap gap-5 mt-5 text-sm">
                            <div class="flex items-center gap-2 text-gray-600">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                {{ $user->phone ?? 'No. HP belum diisi' }}
                            </div>

                            <div class="flex items-center gap-2 text-gray-600">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $user->address ?? 'Alamat belum diisi' }}
                            </div>

                            <div class="flex items-center gap-2 text-gray-600">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Bergabung: {{ $user->created_at->format('d M Y') }}
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="flex gap-4 mb-8 border-b border-gray-200 pb-3 text-sm font-medium">
                <a href="#profil" class="tab-link active text-primary">Profil</a>
                <a href="#password" class="tab-link text-gray-500 hover:text-primary">Password</a>
                <a href="#security" class="tab-link text-gray-500 hover:text-primary">Keamanan</a>
            </div>

            <div id="profil" class="tab-content">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <h2 class="text-xl font-bold mb-4">Informasi Profil</h2>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div id="password" class="tab-content hidden">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <h2 class="text-xl font-bold mb-4">Ubah Password</h2>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div id="security" class="tab-content hidden">
                <div class="bg-white rounded-3xl shadow-sm border border-red-100 p-8">
                    <h2 class="text-xl font-bold text-red-600 mb-4">Hapus Akun</h2>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>

    <script>
        const tabs = document.querySelectorAll('.tab-link');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('text-primary', 'active'));
                contents.forEach(c => c.classList.add('hidden'));

                tab.classList.add('text-primary', 'active');
                document.querySelector(tab.getAttribute('href')).classList.remove('hidden');
            });
        });
    </script>
@endsection
