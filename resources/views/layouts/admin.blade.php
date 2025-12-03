<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Warung Soto Vokasi</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="bg-[#FAFAFB] text-gray-700">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-white hidden md:flex md:flex-col justify-between shadow-sm z-20">
            <div>
                <div class="h-20 flex items-center px-8">
                    <h1 class="text-2xl font-bold text-gray-800">
                        Soto<span class="text-green-500">.</span>Vokasi
                    </h1>
                </div>

                <nav class="mt-4 px-4 space-y-2">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>

                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition-colors duration-200 group
                       {{ request()->routeIs('admin.dashboard') ? 'bg-green-50 text-green-600 font-semibold' : 'text-gray-500 hover:text-green-600 hover:bg-green-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.orders.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition-colors duration-200 group
                        {{ request()->routeIs('admin.orders.*') ? 'bg-green-50 text-green-600 font-semibold' : 'text-gray-500 hover:text-green-600 hover:bg-green-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6M5 7h14l-1.5 12a2 2 0 01-2 1.75H8.5a2 2 0 01-2-1.75L5 7z" />
                        </svg>
                        Order
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition-colors duration-200 group
                        {{ request()->routeIs('admin.users.*') ? 'bg-green-50 text-green-600 font-semibold' : 'text-gray-500 hover:text-green-600 hover:bg-green-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        User
                    </a>

                    <a href="{{ route('admin.categories.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition-colors duration-200 group
                       {{ request()->routeIs('admin.categories.*') ? 'bg-green-50 text-green-600 font-semibold' : 'text-gray-500 hover:text-green-600 hover:bg-green-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                        Kategori
                    </a>

                    <a href="{{ route('admin.products.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition-colors duration-200 group
                       {{ request()->routeIs('admin.products.*') ? 'bg-green-50 text-green-600 font-semibold' : 'text-gray-500 hover:text-green-600 hover:bg-green-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Produk
                    </a>

                    <a href="{{ route('admin.testimoni.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition-colors duration-200 group
                       {{ request()->routeIs('admin.testimoni.*') ? 'bg-green-50 text-green-600 font-semibold' : 'text-gray-500 hover:text-green-600 hover:bg-green-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                            </path>
                        </svg>
                        Testimoni
                    </a>

                    <a href="{{ route('admin.faqs.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition-colors duration-200 group
                       {{ request()->routeIs('admin.faqs.*') ? 'bg-green-50 text-green-600 font-semibold' : 'text-gray-500 hover:text-green-600 hover:bg-green-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        FAQ
                    </a>

                    <a href="{{ route('admin.contact.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition-colors duration-200 group
                       {{ request()->routeIs('admin.contact.*') ? 'bg-green-50 text-green-600 font-semibold' : 'text-gray-500 hover:text-green-600 hover:bg-green-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        Pesan Masuk
                    </a>

                    @if (session()->get('admin_role') === 'superadmin')
                        <div class="pt-4 mt-2 border-t border-gray-100">
                            <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Superadmin
                            </p>
                            <a href="{{ route('admin.admins.index') }}"
                                class="flex items-center px-4 py-3 rounded-xl transition-colors duration-200 group
                           {{ request()->routeIs('admin.admins.*') ? 'bg-green-50 text-green-600 font-semibold' : 'text-gray-500 hover:text-green-600 hover:bg-green-50' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                Kelola Admin
                            </a>
                        </div>
                    @endif
                </nav>
            </div>

            <div class="p-4">
                <div class="bg-green-500 rounded-2xl p-4 text-white relative overflow-hidden shadow-lg">
                    <div class="absolute -right-4 -top-4 w-16 h-16 bg-white opacity-20 rounded-full"></div>
                    <div class="absolute right-8 bottom-0 w-8 h-8 bg-white opacity-20 rounded-full"></div>

                    <div class="relative z-10 flex items-center gap-3 mb-3">
                        <div
                            class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-green-600 font-bold text-lg">
                            {{ substr(\App\Helpers\Helper::getAdminName(), 0, 1) }}
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-xs text-green-100">Login sebagai</p>
                            <h4 class="font-semibold text-sm truncate">{{ \App\Helpers\Helper::getAdminName() }}</h4>
                        </div>
                    </div>

                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full bg-white text-green-600 py-2 rounded-xl text-sm font-semibold shadow hover:bg-gray-50 transition">
                            Logout Sekarang
                        </button>
                    </form>
                </div>
                <p class="text-center text-xs text-gray-400 mt-4">&copy; 2024 Warung Soto Vokasi</p>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-hidden">

            <header class="bg-white h-20 flex items-center justify-between px-8 shadow-sm z-10">
                <div class="flex items-center w-1/3">
                    <div class="relative w-full max-w-md">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <input type="text"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-100 rounded-xl leading-5 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            placeholder="Cari data disini...">
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <div class="flex items-center space-x-4">
                        <button
                            class="p-2 bg-green-50 text-green-600 rounded-xl relative hover:bg-green-100 transition">
                            <span
                                class="absolute top-2 right-2 h-2 w-2 rounded-full bg-red-500 border-2 border-white"></span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                </path>
                            </svg>
                        </button>
                        <button class="p-2 bg-gray-50 text-gray-500 rounded-xl hover:bg-gray-100 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center gap-3 pl-6 border-l border-gray-100">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-gray-800">Halo,
                                {{ \App\Helpers\Helper::getAdminName() }}</p>
                            <p class="text-xs text-gray-500">Admin</p>
                        </div>
                        <div
                            class="h-10 w-10 rounded-full bg-gray-200 border-2 border-white shadow-sm overflow-hidden">
                            <svg class="h-full w-full text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-[#FAFAFB] p-8">

                <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-1">@yield('header')</h2>
                        <p class="text-gray-500 text-sm">Selamat datang kembali di Admin Warung Soto Vokasi!</p>
                    </div>

                    <div
                        class="bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100 flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span>{{ date('d M Y') }}</span>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm leading-5 font-medium text-red-800">Terdapat kesalahan:</h3>
                                <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('success'))
                    <div
                        class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r shadow-sm flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm leading-5 font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <div class="bg-transparent">
                    @yield('content')
                </div>

            </main>
        </div>
    </div>
</body>

</html>
