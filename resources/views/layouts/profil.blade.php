<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Warung Soto Vokasi</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap">

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    <nav class="bg-white py-6 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}"
                        class="font-serif text-4xl font-bold text-primary tracking-wide hover:opacity-90 transition">
                        soto vokasi
                    </a>
                </div>

                <div class="hidden md:flex items-center gap-6">
                    @auth
                        <div class="relative" x-data="{ open: false }">

                            <button @click="open = !open" class="flex items-center focus:outline-none">

                                @if (Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                        class="w-12 h-12 rounded-full object-cover shadow-md border-2 border-white ring-2 ring-orange-200 hover:ring-orange-300 transition">
                                @else
                                    <div
                                        class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center font-bold text-lg shadow-md border-2 border-white ring-2 ring-orange-200 hover:ring-orange-300 transition">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                @endif

                                <svg class="w-4 h-4 text-gray-600 ml-2 transition-transform duration-200"
                                    :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-0 mt-3 w-60 bg-white rounded-xl shadow-lg border border-gray-100 py-3 z-50">

                                <div class="px-4 pb-3 border-b border-gray-100">
                                    <p class="text-sm font-semibold text-gray-900 truncate">
                                        {{ Auth::user()->name }}
                                    </p>
                                    <p class="text-xs text-gray-500 truncate">
                                        {{ Auth::user()->email }}
                                    </p>
                                </div>

                                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-b-lg transition">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth

                </div>

                <button id="menu-btn" class="md:hidden text-gray-600 hover:text-gray-800 focus:outline-none">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

            </div>

            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 space-y-2 border-t pt-4 bg-white">
                <a href="{{ route('home') }}"
                    class="block px-4 py-2 rounded {{ request()->routeIs('home') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-primary hover:text-white' }}">
                    Home
                </a>

                <a href="{{ route('about') }}"
                    class="block px-4 py-2 rounded {{ request()->routeIs('about') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-primary hover:text-white' }}">
                    About Us
                </a>

                <a href="{{ route('menu') }}"
                    class="block px-4 py-2 rounded {{ request()->routeIs('menu') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-primary hover:text-white' }}">
                    Menu
                </a>

                <a href="{{ route('contact') }}"
                    class="block px-4 py-2 rounded {{ request()->routeIs('contact') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-primary hover:text-white' }}">
                    Contact
                </a>

                <div class="border-t border-gray-100 my-2"></div>

                @guest
                    <a href="{{ route('login') }}" class="block px-4 py-2 rounded text-gray-700 hover:bg-gray-100">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="block px-4 py-2 rounded text-primary font-bold hover:bg-gray-100">
                        Register
                    </a>
                @endguest

                @auth
                    <div class="px-4 py-2 text-sm text-gray-500">
                        Logged in as:
                        <span class="font-bold text-gray-800">{{ Auth::user()->name }}</span>
                    </div>
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

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (menuBtn) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>

</body>

</html>
