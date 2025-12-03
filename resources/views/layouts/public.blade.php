<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Warung Soto Vokasi</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#D98718',
                        dark: '#383838',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    <nav class="bg-white py-6 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-12">

                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="font-serif text-4xl font-bold text-primary tracking-wide">
                        soto vokasi
                    </a>
                </div>

                <div class="hidden md:flex items-center gap-2 text-base font-medium">

                    <a href="{{ route('home') }}"
                        class="px-4 py-2 rounded-full transition-all duration-300 {{ request()->routeIs('home') ? 'bg-primary text-white' : 'text-gray-600 hover:bg-primary hover:text-white' }}">
                        Home
                    </a>
                    <a href="{{ route('about') }}"
                        class="px-4 py-2 rounded-full transition-all duration-300 {{ request()->routeIs('about') ? 'bg-primary text-white' : 'text-gray-600 hover:bg-primary hover:text-white' }}">
                        About Us
                    </a>
                    <a href="{{ route('menu') }}"
                        class="px-4 py-2 rounded-full transition-all duration-300 {{ request()->routeIs('menu') ? 'bg-primary text-white' : 'text-gray-600 hover:bg-primary hover:text-white' }}">
                        Menu
                    </a>
                    <a href="{{ route('testimonial') }}"
                        class="px-4 py-2 rounded-full transition-all duration-300 {{ request()->routeIs('testimonial') ? 'bg-primary text-white' : 'text-gray-600 hover:bg-primary hover:text-white' }}">
                        Testimoni
                    </a>
                    <a href="{{ route('faq') }}"
                        class="px-4 py-2 rounded-full transition-all duration-300 {{ request()->routeIs('faq') ? 'bg-primary text-white' : 'text-gray-600 hover:bg-primary hover:text-white' }}">
                        FAQ
                    </a>
                    <a href="{{ route('contact') }}"
                        class="px-4 py-2 rounded-full transition-all duration-300 {{ request()->routeIs('contact') ? 'bg-primary text-white' : 'text-gray-600 hover:bg-primary hover:text-white' }}">
                        Contact
                    </a>

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
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center gap-2 focus:outline-none transition group">

                                @if (Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                        alt="{{ Auth::user()->name }}"
                                        class="w-12 h-12 rounded-full object-cover shadow-sm border-2 border-transparent group-hover:border-orange-200 transition">
                                @else
                                    <div
                                        class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center font-bold text-lg shadow-sm group-hover:bg-orange-600 transition ring-2 ring-transparent group-hover:ring-orange-200">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                @endif

                                <svg class="w-3 h-3 text-gray-500 transition-transform duration-200"
                                    :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-100"
                                style="display: none;">

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
                    <button id="menu-btn" class="text-gray-800 hover:text-primary focus:outline-none">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 space-y-2 border-t pt-4 bg-white">
                <a href="{{ route('home') }}"
                    class="block px-4 py-2 rounded {{ request()->routeIs('home') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-primary hover:text-white' }}">Home</a>
                <a href="{{ route('about') }}"
                    class="block px-4 py-2 rounded {{ request()->routeIs('about') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-primary hover:text-white' }}">About
                    Us</a>
                <a href="{{ route('menu') }}"
                    class="block px-4 py-2 rounded {{ request()->routeIs('menu') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-primary hover:text-white' }}">Menu</a>
                <a href="{{ route('contact') }}"
                    class="block px-4 py-2 rounded {{ request()->routeIs('contact') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-primary hover:text-white' }}">Contact</a>

                <div class="border-t border-gray-100 my-2"></div>

                @guest
                    <a href="{{ route('login') }}"
                        class="block px-4 py-2 rounded text-gray-700 hover:bg-gray-100">Login</a>
                    <a href="{{ route('register') }}"
                        class="block px-4 py-2 rounded text-primary font-bold hover:bg-gray-100">Register</a>
                @endguest

                @auth
                    <div class="px-4 py-2 text-sm text-gray-500">Logged in as: <span
                            class="font-bold text-gray-800">{{ Auth::user()->name }}</span></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 rounded text-red-600 hover:bg-red-50">
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
                        <li><a href="{{ route('about') }}" class="hover:text-primary transition">About Us</a></li>
                        <li><a href="{{ route('menu') }}" class="hover:text-primary transition">Menu</a></li>
                        <li><a href="{{ route('testimonial') }}" class="hover:text-primary transition">Testimoni</a>
                        </li>
                        <li><a href="{{ route('faq') }}" class="hover:text-primary transition">FAQ</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-primary transition">Contact</a></li>
                    </ul>
                </div>

                <div class="md:col-span-4">
                    <h4 class="text-white font-bold text-lg mb-6">Hubungi Kami</h4>
                    <ul class="space-y-4 text-gray-300 text-sm leading-relaxed">
                        <li>
                            Jl. Veteran Jl. Cikampek No.15,<br>
                            Penanggungan, Kec. Klojen, Kota Malang,<br>
                            Jawa Timur 65113
                        </li>
                        <li>+62 8778 5711 752</li>
                        <li>sotovokasi@gmail.com</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-600 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">
                    &copy; 2025 Soto Vokasi. All Rights Reserved.
                </p>

                <div class="flex space-x-6">

                    <a href="#" class="text-gray-300 hover:text-primary transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12.04 2.25c-5.42 0-9.79 4.32-9.79 9.64 0 1.7.45 3.35 1.31 4.82l-1.39 5.08 5.23-1.36c1.42.78 3.01 1.19 4.64 1.19h.01c5.42 0 9.79-4.32 9.79-9.64 0-5.31-4.37-9.63-9.8-9.63Zm0 17.44h-.01c-1.43 0-2.83-.38-4.06-1.11l-.29-.17-3.1.81.82-3.01-.19-.31a7.93 7.93 0 0 1-1.23-4.29c0-4.38 3.63-7.94 8.08-7.94 4.45 0 8.08 3.56 8.08 7.94 0 4.38-3.63 7.94-8.1 7.94Zm4.47-5.89c-.24-.12-1.43-.71-1.65-.79-.22-.08-.38-.12-.54.12-.16.24-.62.79-.76.95-.14.16-.28.18-.52.06-.24-.12-1.03-.38-1.96-1.2-.73-.65-1.22-1.45-1.37-1.69-.14-.24-.02-.37.11-.49.11-.11.24-.28.36-.42.12-.14.16-.24.24-.4.08-.16.04-.3-.02-.42-.06-.12-.54-1.3-.74-1.78-.2-.48-.4-.41-.54-.42-.14-.01-.3-.01-.46-.01-.16 0-.42.06-.64.3-.22.24-.84.82-.84 2s.86 2.32.98 2.48c.12.16 1.68 2.68 4.11 3.75.57.25 1.02.39 1.37.5.58.19 1.11.16 1.53.1.47-.07 1.43-.58 1.63-1.14.2-.56.2-1.04.14-1.14-.06-.1-.22-.16-.46-.28Z" />
                        </svg>
                    </a>

                    <a href="#" class="text-gray-300 hover:text-primary transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            stroke-width="1.5">
                            <rect x="2.25" y="2.25" width="19.5" height="19.5" rx="5" ry="5">
                            </rect>
                            <path d="M12 7.5a4.5 4.5 0 1 0 4.5 4.5A4.505 4.505 0 0 0 12 7.5Z"></path>
                            <circle cx="17" cy="7" r="1.2" fill="currentColor"></circle>
                        </svg>
                    </a>

                    <a href="#" class="text-gray-300 hover:text-primary transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M22.5 12c0-5.799-4.701-10.5-10.5-10.5S1.5 6.201 1.5 12c0 5.238 3.861 9.57 8.925 10.351v-7.32H7.875v-3.03h2.55V9.651c0-2.518 1.493-3.906 3.78-3.906 1.095 0 2.238.195 2.238.195v2.46h-1.261c-1.243 0-1.63.772-1.63 1.562v1.875h2.775l-.444 3.03h-2.331v7.32C18.639 21.57 22.5 17.238 22.5 12Z" />
                        </svg>
                    </a>

                </div>

            </div>
        </div>
    </footer>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (menuBtn) {
            menuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
</body>

</html>
