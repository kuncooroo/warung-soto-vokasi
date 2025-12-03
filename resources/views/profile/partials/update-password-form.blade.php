<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold text-gray-700 mb-2">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    Password Saat Ini
                </span>
            </label>
            <div class="relative">
                <input id="update_password_current_password" 
                       name="current_password" 
                       type="password" 
                       class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D32F2F] focus:border-[#D32F2F] transition-all duration-300 text-gray-900" 
                       autocomplete="current-password" 
                       placeholder="Masukkan password saat ini" />
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- New Password -->
        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-gray-700 mb-2">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    Password Baru
                </span>
            </label>
            <div class="relative">
                <input id="update_password_password" 
                       name="password" 
                       type="password" 
                       class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D32F2F] focus:border-[#D32F2F] transition-all duration-300 text-gray-900" 
                       autocomplete="new-password" 
                       placeholder="Masukkan password baru (min. 8 karakter)" />
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path>
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            <p class="mt-2 text-xs text-gray-500 flex items-center">
                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Gunakan kombinasi huruf besar, kecil, angka dan simbol
            </p>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Konfirmasi Password Baru
                </span>
            </label>
            <div class="relative">
                <input id="update_password_password_confirmation" 
                       name="password_confirmation" 
                       type="password" 
                       class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#D32F2F] focus:border-[#D32F2F] transition-all duration-300 text-gray-900" 
                       autocomplete="new-password" 
                       placeholder="Ulangi password baru" />
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Security Tips Card -->
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-bold text-blue-900 mb-2">Tips Keamanan Password</h4>
                    <ul class="text-xs text-blue-800 space-y-1">
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mr-1.5 mt-0.5 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Minimal 8 karakter, lebih panjang lebih baik
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mr-1.5 mt-0.5 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Kombinasi huruf besar, kecil, angka, dan simbol
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mr-1.5 mt-0.5 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Hindari informasi pribadi yang mudah ditebak
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mr-1.5 mt-0.5 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Gunakan password yang berbeda untuk setiap akun
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
            <div class="flex items-center gap-3">
                <button type="submit"
                    class="inline-flex items-center px-6 py-3 bg-[#D32F2F] hover:bg-[#b71c1c] text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5 focus:ring-4 focus:ring-[#D32F2F]/20">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Password
                </button>

                @if (session('status') === 'password-updated')
                    <div x-data="{ show: true }" 
                         x-show="show" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-90"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-90"
                         x-init="setTimeout(() => show = false, 3000)"
                         class="flex items-center px-4 py-2 bg-green-50 border border-green-200 text-green-700 rounded-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium">Password berhasil diubah!</span>
                    </div>
                @endif
            </div>
        </div>
    </form>
</section>
