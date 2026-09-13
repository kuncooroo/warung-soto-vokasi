<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Warung Soto Vokasi</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50 flex flex-col min-h-screen font-sans text-gray-800">

    <nav class="bg-white py-6 sticky top-0 z-50 shadow-sm" x-data="{ mobileOpen: false }">
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

                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-3 w-60 bg-white rounded-xl shadow-lg border border-gray-100 py-3 z-50"
                                x-cloak>

                                <div class="px-4 pb-3 border-b border-gray-100">
                                    <p class="text-sm font-semibold text-gray-900 truncate">
                                        {{ Auth::user()->name }}
                                    </p>
                                    <p class="text-xs text-gray-500 truncate">
                                        {{ Auth::user()->email }}
                                    </p>
                                </div>

                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition">
                                    Profile Saya
                                </a>

                                <form method="POST" action="{{ route('logout') }}" class="mt-1">
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
                        class="text-gray-600 hover:text-primary focus:outline-none p-2" aria-label="Toggle Menu">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <a href="{{ route('home') }}"
                    class="block px-4 py-2 rounded font-medium {{ request()->routeIs('home') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-primary hover:text-white' }}">
                    Home
                </a>
                <a href="{{ route('about') }}"
                    class="block px-4 py-2 rounded font-medium {{ request()->routeIs('about') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-primary hover:text-white' }}">
                    About Us
                </a>
                <a href="{{ route('menu') }}"
                    class="block px-4 py-2 rounded font-medium {{ request()->routeIs('menu') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-primary hover:text-white' }}">
                    Menu
                </a>
                <a href="{{ route('contact') }}"
                    class="block px-4 py-2 rounded font-medium {{ request()->routeIs('contact') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-primary hover:text-white' }}">
                    Contact
                </a>

                <div class="border-t border-gray-100 my-2"></div>

                @guest
                    <a href="{{ route('login') }}" class="block px-4 py-2 rounded text-gray-700 hover:bg-gray-100 font-medium">Login</a>
                    <a href="{{ route('register') }}" class="block px-4 py-2 rounded text-primary font-bold hover:bg-gray-100">Register</a>
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

</body>

</html>
