<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Warung Soto Vokasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css'])

    <style>
        @keyframes float {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }

            100% {
                transform: translateY(0px) rotate(0deg);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float 8s ease-in-out infinite;
            animation-delay: 2s;
        }

        .animate-float-slow {
            animation: float 10s ease-in-out infinite;
            animation-delay: 1s;
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-green-900 to-green-600 min-h-screen flex items-center justify-center relative overflow-hidden">

    <div class="absolute top-10 left-10 opacity-20 animate-float mix-blend-overlay">
        <svg width="150" height="150" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"
            class="filter blur-sm">
            <path d="M2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12H2Z" />
            <path d="M6 8C6 8 7 4 10 4" stroke="white" stroke-width="2" stroke-linecap="round" />
            <path d="M14 8C14 8 15 4 18 4" stroke="white" stroke-width="2" stroke-linecap="round" />
        </svg>
    </div>

    <div class="absolute top-1/3 right-20 opacity-20 animate-float-delayed mix-blend-overlay">
        <svg width="180" height="180" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5"
            xmlns="http://www.w3.org/2000/svg" class="filter blur-md">
            <path d="M11 2C11 2 7 2 7 7C7 10 9 12 11 12V22" stroke-linecap="round" />
            <path d="M17 2V22" stroke-linecap="round" />
            <path d="M14 2V12" stroke-linecap="round" />
            <path d="M20 2V12C20 12 20 12 20 12" stroke-linecap="round" />
        </svg>
    </div>

    <div class="absolute -bottom-10 left-32 opacity-25 animate-float-slow mix-blend-overlay">
        <svg width="120" height="120" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"
            class="filter blur-sm">
            <circle cx="12" cy="12" r="10" />
            <path d="M12 12L19 12" stroke="#166534" stroke-width="1" />
            <path d="M12 12L12 5" stroke="#166534" stroke-width="1" />
            <path d="M12 12L5 12" stroke="#166534" stroke-width="1" />
            <path d="M12 12L12 19" stroke="#166534" stroke-width="1" />
        </svg>
    </div>


    <div
        class="relative bg-white/90 backdrop-blur-xl rounded-2xl p-8 shadow-2xl w-full max-w-md z-10 border border-white/40">

        <div class="text-center mb-8">
            <div class="flex justify-center items-center mb-4">
                <span class="text-5xl drop-shadow-md"></span>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 tracking-wide">Admin Login</h1>
            <p class="text-gray-500 text-sm mt-2">Masuk untuk mengelola Warung Soto Vokasi</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded text-sm">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.login.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-gray-700 font-semibold mb-2 ml-1 text-sm">EMAIL</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input type="email" name="email"
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition bg-gray-50 text-gray-800"
                        placeholder="admin@sotovokasi.com" required>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2 ml-1 text-sm">PASSWORD</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>

                    <input type="password" name="password" id="passwordInput"
                        class="w-full pl-10 pr-12 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition bg-gray-50 text-gray-800"
                        placeholder="••••••••" required>

                    <button type="button" onclick="togglePassword()"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-green-600 transition focus:outline-none">
                        <svg id="eyeOpen" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg id="eyeClosed" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.057 10.057 0 01-1.564 3.029m-5.858-.908l-3-3m7-7l-3 3" />
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit"
                class="w-full py-3 rounded-xl bg-green-700 hover:bg-green-800 text-white font-bold tracking-wide shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                Sign In
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex items-center justify-center space-x-2 text-sm text-gray-500">
                <span class="text-green-600 font-semibold mr-1">Demo:</span>
                <span>superadmin@warung-soto.com</span>
                <span>|</span>
                <span>password123</span>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('passwordInput');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            }
        }
    </script>
</body>

</html>
