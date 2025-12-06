<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Warung Soto Vokasi</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 flex flex-col min-h-screen font-sans text-gray-800">

    <nav class="bg-white py-6 sticky top-0 z-50 shadow-sm" x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-12">

                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}"
                        class="font-serif text-4xl font-bold text-primary tracking-wide hover:opacity-90 transition">
                        soto vokasi
                    </a>
                </div>

                <div class="hidden md:flex items-center gap-2 text-base font-medium">
                    @php
                        $navLinks = [
                            ['route' => 'home', 'label' => 'Home'],
                            ['route' => 'about', 'label' => 'About Us'],
                            ['route' => 'menu', 'label' => 'Menu'],
                            ['route' => 'testimonial', 'label' => 'Testimoni'],
                            ['route' => 'faq', 'label' => 'FAQ'],
                            ['route' => 'contact', 'label' => 'Contact'],
                        ];
                    @endphp

                    @foreach ($navLinks as $link)
                        <a href="{{ route($link['route']) }}"
                            class="px-4 py-2 rounded-full transition-all duration-300 {{ request()->routeIs($link['route']) ? 'bg-primary text-white' : 'text-gray-600 hover:bg-primary hover:text-white' }}">
                            {{ $link['label'] }}
                        </a>
                    @endforeach

                    <div class="h-6 w-px bg-gray-300 mx-2"></div>

                    @guest
                        <a href="{{ route('login') }}"
                            class="px-5 py-2 text-gray-600 hover:text-primary font-semibold transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="px-5 py-2 rounded-full bg-primary text-white hover:bg-[#b87314] transition shadow-md">
                            Register
                        </a>
                    @endguest

                    @auth
                        <div class="relative" x-data="{ dropdownOpen: false }">
                            <button @click="dropdownOpen = !dropdownOpen"
                                class="flex items-center gap-2 focus:outline-none transition group">
                                @if (Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                        class="w-12 h-12 rounded-full object-cover shadow-sm border-2 border-transparent group-hover:border-orange-200 transition">
                                @else
                                    <div
                                        class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center font-bold text-lg shadow-sm group-hover:bg-orange-600 transition ring-2 ring-transparent group-hover:ring-orange-200">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                @endif

                                <svg class="w-3 h-3 text-gray-500 transition-transform duration-200"
                                    :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-100"
                                style="display: none;" x-cloak>

                                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50">
                                    <p class="text-sm font-semibold text-gray-700 truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>

                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition">
                                    Profile Saya
                                </a>

                                <div class="border-t border-gray-100 my-1"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>

                <div class="md:hidden flex items-center">
                    <button @click="mobileOpen = !mobileOpen"
                        class="text-gray-800 hover:text-primary focus:outline-none p-2" aria-label="Toggle Menu">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="mobileOpen" x-cloak stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div x-show="mobileOpen" x-collapse
                class="md:hidden mt-4 pb-4 space-y-2 border-t border-gray-100 pt-4 bg-white" x-cloak>

                @foreach ($navLinks as $link)
                    <a href="{{ route($link['route']) }}"
                        class="block px-4 py-2 rounded font-medium {{ request()->routeIs($link['route']) ? 'bg-primary text-white' : 'text-gray-700 hover:bg-primary hover:text-white' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach

                <div class="border-t border-gray-100 my-2"></div>

                @guest
                    <a href="{{ route('login') }}"
                        class="block px-4 py-2 rounded text-gray-700 hover:bg-gray-100 font-medium">Login</a>
                    <a href="{{ route('register') }}"
                        class="block px-4 py-2 rounded text-primary font-bold hover:bg-gray-100">Register</a>
                @endguest

                @auth
                    <div class="px-4 py-2 text-sm text-gray-500 bg-gray-50 rounded-lg mx-2 mb-2">
                        Logged in as: <span class="font-bold text-gray-800">{{ Auth::user()->name }}</span>
                    </div>
                    <a href="{{ route('profile.edit') }}"
                        class="block px-4 py-2 rounded text-gray-700 hover:bg-gray-100 font-medium mb-1">
                        Profile Saya
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 rounded text-red-600 hover:bg-red-50 font-medium">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-dark text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mb-12">

                <div class="md:col-span-5 pr-8">
                    <h3 class="font-serif text-3xl font-bold text-primary mb-6">soto vokasi</h3>
                    <p class="text-gray-300 text-sm leading-relaxed mb-4">
                        Menghadirkan kehangatan resep soto otentik yang diwariskan dari generasi ke generasi. Setiap
                        mangkuk adalah cerita, setiap suapan adalah kenangan.
                    </p>
                </div>

                <div class="md:col-span-3">
                    <h4 class="text-white font-bold text-lg mb-6">Navigasi</h4>
                    <ul class="space-y-4 text-gray-300 text-sm">
                        @foreach ($navLinks as $link)
                            @if ($link['route'] !== 'home')
                                <li><a href="{{ route($link['route']) }}"
                                        class="hover:text-primary transition">{{ $link['label'] }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="md:col-span-4">
                    <h4 class="text-white font-bold text-lg mb-6">Hubungi Kami</h4>
                    <ul class="space-y-4 text-gray-300 text-sm leading-relaxed">
                        <li class="flex gap-3 items-start">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Jl. Veteran Jl. Cikampek No.15,<br>Penanggungan, Kec. Klojen,<br>Kota Malang, Jawa
                                Timur 65113</span>
                        </li>
                        <li class="flex gap-3 items-center">
                            <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>+62 8778 5711 752</span>
                        </li>
                        <li class="flex gap-3 items-center">
                            <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>sotovokasi@gmail.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-600 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">
                    &copy; {{ date('Y') }} Soto Vokasi. All Rights Reserved.
                </p>

                <div class="flex space-x-6">
                    <a href="https://wa.me/6287785711752" target="_blank"
                        class="text-gray-300 hover:text-primary transition transform hover:scale-110"
                        aria-label="WhatsApp">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.463 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.084 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-primary transition transform hover:scale-110"
                        aria-label="Instagram">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.069-4.85.069-3.204 0-3.584-.012-4.849-.069-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.069-1.644-.069-4.849 0-3.204.013-3.583.069-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-primary transition transform hover:scale-110"
                        aria-label="Facebook">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>

                </div>
            </div>
        </div>
    </footer>
</body>

</html>
