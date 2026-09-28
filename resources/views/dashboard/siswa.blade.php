<x-app-layout :title="'Dashboard Siswa'" :activeMenu="'dashboard'">
    <div class="flex flex-col gap-8 h-full">
        <!-- Hero Text -->
        <div class="flex flex-col gap-4">
            <h1 class="text-3xl font-bold text-neutral-800 leading-tight">
                Belajar Bahasa Inggris tanpa kertas, lebih mudah diikuti.
            </h1>
            <p class="text-base text-gray-500">
                JoyLish membantu kamu mengakses materi, mengerjakan quiz, menyelesaikan tugas, dan memantau progress belajar dalam satu tempat.
            </p>
        </div>

        <!-- Pilihan Utama -->
        <div class="flex flex-col gap-4">
            <h2 class="text-base font-bold text-neutral-800">Pilihan Utama</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('materials.index') }}" class="flex flex-col justify-between px-5 pt-5 pb-9 bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-slate-200">
                    <div class="w-12 h-12 bg-indigo-100 rounded-xl flex flex-col justify-center items-center mb-4">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <h3 class="text-base font-semibold text-neutral-800">Materi</h3>
                        <p class="text-xs text-gray-500">Pelajari materi Bahasa Inggris</p>
                    </div>
                </a>

                <a href="{{ route('quizzes.index') }}" class="flex flex-col justify-between h-40 p-5 bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-slate-200">
                    <div class="w-12 h-12 bg-violet-100 rounded-xl flex flex-col justify-center items-center mb-4">
                        <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <h3 class="text-base font-semibold text-neutral-800">Quiz & Diagnostic Test</h3>
                        <p class="text-xs text-gray-500">Uji pemahaman kamu</p>
                    </div>
                </a>

                <a href="#" class="flex flex-col justify-between p-5 bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-slate-200">
                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex flex-col justify-center items-center mb-4">
                        <svg class="w-5 h-5 text-orange-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <h3 class="text-base font-semibold text-neutral-800">Formative Assessment</h3>
                        <p class="text-xs text-gray-500">Kerjakan tugas writing & speaking</p>
                    </div>
                </a>

                <a href="{{ route('progress.index') }}" class="flex flex-col justify-between p-5 bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-slate-200">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex flex-col justify-center items-center mb-4">
                        <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <h3 class="text-base font-semibold text-neutral-800">Progress</h3>
                        <p class="text-xs text-gray-500">Lihat perkembangan belajarmu</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="flex flex-col gap-3.5">
            <h2 class="text-base font-bold text-neutral-800">Aktivitas Terbaru</h2>
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 flex flex-col overflow-hidden">
                @if($stats['completed_quizzes'] > 0 || $stats['completed_materials'] > 0)
                    @php $first = true; @endphp
                    @foreach($recentMaterials as $material)
                        @if(!$first)<div class="h-px bg-slate-200"></div>@endif
                        <div class="px-5 py-4 flex justify-between items-center {{ $first ? 'bg-neutral-100' : '' }}">
                            <div class="w-96 flex flex-col gap-[3px]">
                                <h4 class="text-sm font-medium text-neutral-800">Materi: {{ $material->title }}</h4>
                                <p class="text-xs text-gray-500">Dipelajari baru-baru ini</p>
                            </div>
                            <x-badge status="dipelajari" />
                        </div>
                        @php $first = false; @endphp
                    @endforeach

                    @foreach($recentQuizzes as $quiz)
                        @if(!$first)<div class="h-px bg-slate-200"></div>@endif
                        <div class="px-5 py-4 flex justify-between items-center">
                            <div class="w-96 flex flex-col gap-[3px]">
                                <h4 class="text-sm font-medium text-neutral-800">Quiz: {{ $quiz->title }}</h4>
                                <p class="text-xs text-gray-500">Tersedia • {{ $quiz->questions->count() ?? 0 }} soal</p>
                            </div>
                            <x-badge status="belum" />
                        </div>
                        @php $first = false; @endphp
                    @endforeach
                @else
                    <!-- Hardcoded mock -->
                    <div class="px-5 py-4 bg-neutral-100 flex justify-between items-center">
                        <div class="w-96 flex flex-col gap-[3px]">
                            <h4 class="text-sm font-medium text-neutral-800">Quiz: Grammar Dasar</h4>
                            <p class="text-xs text-gray-500">Skor 85 · 2 hari lalu</p>
                        </div>
                        <x-badge status="selesai" />
                    </div>
                    <div class="h-px bg-slate-200"></div>
                    <div class="px-5 py-4 flex justify-between items-center">
                        <div class="w-96 flex flex-col gap-[3px]">
                            <h4 class="text-sm font-medium text-neutral-800">Formative: Descriptive Text</h4>
                            <p class="text-xs text-gray-500">Menunggu penilaian pembina</p>
                        </div>
                        <x-badge status="menunggu-nilai" />
                    </div>
                    <div class="h-px bg-slate-200"></div>
                    <div class="px-5 py-4 flex justify-between items-center">
                        <div class="w-96 flex flex-col gap-[3px]">
                            <h4 class="text-sm font-medium text-neutral-800">Materi: Simple Present Tense</h4>
                            <p class="text-xs text-gray-500">Dipelajari kemarin</p>
                        </div>
                        <x-badge status="dipelajari" />
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>