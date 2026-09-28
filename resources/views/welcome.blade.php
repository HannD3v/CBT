<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JoyLish - Joyful English Platform</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 antialiased" style="font-family: 'Inter', sans-serif;">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-14 py-5 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center">
                        <span class="text-white text-base font-bold">JL</span>
                    </div>
                    <div class="flex flex-col gap-0.5">
                        <h2 class="text-neutral-800 text-base font-bold">JoyLish</h2>
                        <p class="text-gray-500 text-xs">Joyful English Platform</p>
                    </div>
                </div>
                <a href="{{ route('login') }}" class="px-5 py-2.5 bg-indigo-100 rounded-[10px] text-blue-500 text-sm font-bold hover:bg-indigo-200 transition-colors">
                    Masuk
                </a>
            </div>
        </header>

        <main class="flex-1">
            <div class="max-w-7xl mx-auto px-20 py-20 flex items-center gap-14">
                <div class="flex-1 flex flex-col gap-10">
                    <div class="flex flex-col gap-5">
                        <h1 class="text-neutral-800 text-5xl font-extrabold leading-[50.40px]" style="font-family: 'Inter', sans-serif;">
                            Belajar Bahasa Inggris Tanpa Kertas, Lebih Menyenangkan!
                        </h1>
                        <p class="text-gray-500 text-base leading-6">
                            Selamat datang di JoyLish, platform eksklusif ekskul Joyful English. Akses materi interaktif, kerjakan quiz seru, kirim tugas formative writing & speaking, serta pantau progres belajarmu secara real-time dari satu tempat yang rapi.
                        </p>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1 p-4 bg-white rounded-xl border border-slate-200 flex flex-col gap-2.5">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <span class="text-neutral-800 text-sm font-bold">Materi Interaktif</span>
                        </div>

                        <div class="flex-1 p-4 bg-white rounded-xl border border-slate-200 flex flex-col gap-2.5">
                            <div class="w-10 h-10 bg-violet-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                            <span class="text-neutral-800 text-sm font-bold">Quiz & Tes</span>
                        </div>

                        <div class="flex-1 p-4 bg-white rounded-xl border border-slate-200 flex flex-col gap-2.5">
                            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-orange-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </div>
                            <span class="text-neutral-800 text-sm font-bold">Tugas Formative</span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="inline-flex px-6 py-3 bg-blue-500 rounded-xl text-white text-sm font-bold hover:bg-blue-600 transition-colors shadow-lg shadow-blue-500/20">
                            Masuk ke Aplikasi
                        </a>
                    </div>
                </div>

                <div class="w-[480px] h-[460px] bg-white rounded-3xl border border-slate-200 flex justify-center items-center overflow-hidden shrink-0">
                    <img class="w-full h-full object-cover" src="https://placehold.co/480x460/e0f2fe/1e40af?text=JoyLish+Platform" alt="JoyLish Hero">
                </div>
            </div>
        </main>
    </div>
</body>
</html>
