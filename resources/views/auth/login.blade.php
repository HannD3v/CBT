<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JoyLish</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Left Panel: Hero Branding -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-500 to-blue-600 relative overflow-hidden">
            <!-- Ornamen Background -->
            <div class="absolute top-0 left-0 w-96 h-96 bg-blue-400/30 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-700/20 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
            
            <div class="relative z-10 flex flex-col justify-between p-12 w-full">
                <!-- Logo & Brand -->
                <div>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">JoyLish</h2>
                            <p class="text-white/70 text-xs">Joyful English Platform</p>
                        </div>
                    </div>
                </div>

                <!-- Center Content -->
                <div class="max-w-md">
                    <h1 class="text-4xl font-bold text-white mb-6 leading-tight">
                        Your English workspace awaits.
                    </h1>
                    <p class="text-white/85 text-sm leading-relaxed">
                        Masuk dengan akun yang telah dibuatkan untuk mengakses modul belajar, tes terintegrasi dengan pembina, dan memantau kemajuan belajarmu hari ini.
                    </p>
                </div>

                <!-- Footer -->
                <p class="text-white/60 text-xs">© JoyLish • SMKN 4 Kota Bogor</p>
            </div>
        </div>

        <!-- Right Panel: Login Form -->
        <div class="w-full lg:w-1/2 bg-white flex items-center justify-center p-8 lg:p-12">
            <div class="w-full max-w-md">
                <!-- Mobile Logo (visible only on mobile) -->
                <div class="lg:hidden mb-8 text-center">
                    <div class="inline-flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900">JoyLish</h2>
                    </div>
                </div>

                <!-- Form Header -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-2">Selamat Datang Kembali</h2>
                    <p class="text-sm text-slate-600">Silakan masuk untuk melanjutkan aktivitas belajarmu</p>
                </div>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Username Input -->
                    <div>
                        <label for="username" class="block text-sm font-semibold text-slate-900 mb-2">Username</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </span>
                            <input 
                                type="text" 
                                id="username"
                                name="username" 
                                value="{{ old('username') }}"
                                class="w-full h-12 pl-12 pr-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                placeholder="mizh.ihsanul"
                                autofocus>
                        </div>
                        @error('username')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-900 mb-2">Password</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </span>
                            <input 
                                type="password" 
                                id="password"
                                name="password"
                                class="w-full h-12 pl-12 pr-12 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                placeholder="••••••••••••">
                            <button 
                                type="button" 
                                onclick="togglePassword()"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
                                <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        class="w-full h-12 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-xl transition-colors shadow-lg shadow-blue-500/30">
                        Masuk Sekarang
                    </button>
                </form>

                <!-- Footer Links -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-blue-600 hover:text-blue-700 cursor-pointer">
                        Butuh bantuan masuk? Hubungi Administrator
                    </p>
                </div>

                <!-- Copyright (Mobile) -->
                <p class="text-center text-xs text-slate-400 mt-8">JoyLish • SMKN 4 Kota Bogor</p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        }
    </script>
</body>
</html>
