@props(['activeMenu' => 'dashboard'])

<aside class="w-60 bg-white border-r border-slate-200 fixed h-screen flex flex-col">
    <div class="px-5 py-6 border-b border-slate-200">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="text-white text-base font-bold">JL</span>
            </div>
            <div>
                <h2 class="text-base font-bold text-neutral-800">JoyLish</h2>
                <p class="text-xs text-gray-500">Joyful english platform</p>
            </div>
        </div>
    </div>

    <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
        @if(auth()->user()->role === 'pembina')
            <a href="{{ route('dashboard.pembina') }}" 
               class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors
                     {{ $activeMenu === 'dashboard' ? 'bg-indigo-100 text-neutral-800 font-semibold' : 'text-gray-500 hover:bg-slate-50' }}">
                <svg class="w-5 h-5 {{ $activeMenu === 'dashboard' ? 'text-blue-500' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span class="text-sm">Dashboard</span>
            </a>

            <a href="{{ route('students.index') }}" 
               class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors
                     {{ $activeMenu === 'students' ? 'bg-indigo-100 text-neutral-800 font-semibold' : 'text-gray-500 hover:bg-slate-50' }}">
                <svg class="w-5 h-5 {{ $activeMenu === 'students' ? 'text-blue-500' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <span class="text-sm">Kelola Siswa</span>
            </a>

            <a href="{{ route('materials.index') }}" 
               class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors
                     {{ $activeMenu === 'materials' ? 'bg-indigo-100 text-neutral-800 font-semibold' : 'text-gray-500 hover:bg-slate-50' }}">
                <svg class="w-5 h-5 {{ $activeMenu === 'materials' ? 'text-blue-500' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <span class="text-sm">Materi</span>
            </a>

            <a href="{{ route('quizzes.index') }}" 
               class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors
                     {{ $activeMenu === 'quizzes' ? 'bg-indigo-100 text-neutral-800 font-semibold' : 'text-gray-500 hover:bg-slate-50' }}">
                <svg class="w-5 h-5 {{ $activeMenu === 'quizzes' ? 'text-violet-600' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                <span class="text-sm">Quiz</span>
            </a>

            <a href="#" 
               class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors
                     {{ $activeMenu === 'formative' ? 'bg-indigo-100 text-neutral-800 font-semibold' : 'text-gray-500 hover:bg-slate-50' }}">
                <svg class="w-5 h-5 {{ $activeMenu === 'formative' ? 'text-orange-700' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                </svg>
                <span class="text-sm">Formative</span>
            </a>

            <a href="{{ route('progress.index') }}" 
               class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors
                     {{ $activeMenu === 'progress' ? 'bg-indigo-100 text-neutral-800 font-semibold' : 'text-gray-500 hover:bg-slate-50' }}">
                <svg class="w-5 h-5 {{ $activeMenu === 'progress' ? 'text-green-700' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="text-sm">Progress</span>
            </a>
        @else
            <a href="{{ route('dashboard.siswa') }}" 
               class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors
                     {{ $activeMenu === 'dashboard' ? 'bg-indigo-100 text-neutral-800 font-semibold' : 'text-gray-500 hover:bg-slate-50' }}">
                <svg class="w-5 h-5 {{ $activeMenu === 'dashboard' ? 'text-blue-500' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span class="text-sm">Dashboard</span>
            </a>

            <a href="{{ route('materials.index') }}" 
               class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors
                     {{ $activeMenu === 'materials' ? 'bg-indigo-100 text-neutral-800 font-semibold' : 'text-gray-500 hover:bg-slate-50' }}">
                <svg class="w-5 h-5 {{ $activeMenu === 'materials' ? 'text-blue-500' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <span class="text-sm">Materi</span>
            </a>

            <a href="{{ route('quizzes.index') }}" 
               class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors
                     {{ $activeMenu === 'quizzes' ? 'bg-indigo-100 text-neutral-800 font-semibold' : 'text-gray-500 hover:bg-slate-50' }}">
                <svg class="w-5 h-5 {{ $activeMenu === 'quizzes' ? 'text-violet-600' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                <span class="text-sm">Quiz</span>
            </a>

            <a href="#" 
               class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors
                     {{ $activeMenu === 'formative' ? 'bg-indigo-100 text-neutral-800 font-semibold' : 'text-gray-500 hover:bg-slate-50' }}">
                <svg class="w-5 h-5 {{ $activeMenu === 'formative' ? 'text-orange-700' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                </svg>
                <span class="text-sm">Formative</span>
            </a>

            <a href="{{ route('progress.index') }}" 
               class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors
                     {{ $activeMenu === 'progress' ? 'bg-indigo-100 text-neutral-800 font-semibold' : 'text-gray-500 hover:bg-slate-50' }}">
                <svg class="w-5 h-5 {{ $activeMenu === 'progress' ? 'text-green-700' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="text-sm">Progress</span>
            </a>
        @endif
    </nav>

    <div class="p-4 border-t border-slate-200">
        <a href="#" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-500 hover:bg-slate-50 transition-colors w-full">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span class="text-sm font-semibold text-neutral-800">Pengaturan</span>
        </a>
    </div>
</aside>
