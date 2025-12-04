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
    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-primary hover:text-primary-dark transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        <span class="font-semibold text-lg">Kembali ke Home</span>
    </a>
</div>

                <div class="hidden md:flex items-center gap-2 text-base font-medium">

                   
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
