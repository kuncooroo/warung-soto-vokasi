@extends('layouts.profil')

@section('title', 'Edit Profil')

@section('content')


    <!-- Main Content -->
    <section class="py-16 bg-[#F9F9F9]">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Sidebar - User Info Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-8">
                        <!-- Card Header dengan Gradient -->
                        <div class="bg-gradient-to-br from-[#D98718] to-[#b87314] p-8 text-center relative overflow-hidden">
                            <div class="absolute inset-0 opacity-10">
                                <svg class="w-full h-full" viewBox="0 0 100 100" fill="white">
                                    <circle cx="10" cy="10" r="2"/>
                                    <circle cx="30" cy="20" r="1.5"/>
                                    <circle cx="50" cy="10" r="2"/>
                                    <circle cx="70" cy="25" r="1"/>
                                    <circle cx="90" cy="15" r="1.5"/>
                                    <circle cx="20" cy="40" r="1"/>
                                    <circle cx="80" cy="50" r="2"/>
                                    <circle cx="40" cy="60" r="1.5"/>
                                    <circle cx="60" cy="70" r="1"/>
                                    <circle cx="15" cy="80" r="1.5"/>
                                    <circle cx="85" cy="85" r="1"/>
                                </svg>
                            </div>
                            
                            <div class="relative z-10">
                                <!-- Avatar Preview -->
                                <div class="inline-block relative mb-4">
                                    @if (auth()->user()->avatar)
                                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                                             alt="Avatar" 
                                             class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-xl">
                                    @else
                                        <div class="w-24 h-24 rounded-full bg-white border-4 border-white shadow-xl flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <!-- Status Badge -->
                                    <div class="absolute bottom-0 right-0 w-7 h-7 bg-green-500 border-4 border-white rounded-full"></div>
                                </div>
                                
                                <h3 class="text-white font-bold text-xl mb-1">
                                    {{ auth()->user()->name }}
                                </h3>
                                <p class="text-white/80 text-sm">
                                    {{ auth()->user()->email }}
                                </p>
                            </div>
                        </div>
                        
                        <!-- Card Body -->
                        <div class="p-6 space-y-3">
                            <div class="flex items-center text-gray-600 text-sm">
                                <svg class="w-5 h-5 mr-3 text-[#D98718]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                {{ auth()->user()->phone ?? 'Belum diisi' }}
                            </div>
                            
                            <div class="flex items-start text-gray-600 text-sm">
                                <svg class="w-5 h-5 mr-3 text-[#D98718] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="leading-relaxed">{{ auth()->user()->address ?? 'Belum diisi' }}</span>
                            </div>
                            
                            <div class="pt-4 border-t border-gray-100">
                                <p class="text-xs text-gray-400">Member sejak</p>
                                <p class="text-sm text-gray-700 font-medium">{{ auth()->user()->created_at->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Profile Information Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white p-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-xl bg-[#D98718]/10 flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-[#D98718]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">Informasi Profil</h2>
                                    <p class="text-sm text-gray-500 mt-0.5">Perbarui informasi akun dan foto profil Anda</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Password Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white p-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-xl bg-[#D98718]/10 flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">Ubah Password</h2>
                                    <p class="text-sm text-gray-500 mt-0.5">Pastikan akun Anda menggunakan password yang kuat</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Delete Account Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="border-b border-red-100 bg-gradient-to-r from-red-50 to-white p-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">Hapus Akun</h2>
                                    <p class="text-sm text-gray-500 mt-0.5">Hapus akun Anda secara permanen</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
