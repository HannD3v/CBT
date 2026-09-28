{{-- Navbar atas: logo kiri, user info + logout kanan --}}
<header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-6">
    <div class="flex items-center gap-4">
        <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
            </svg>
        </div>
        <span class="text-blue-500 text-lg font-bold">Joyful English</span>
    </div>

    <div class="flex items-center gap-4">
        <span class="text-gray-500 text-xs font-medium">
            {{ auth()->user()->name }} · 
            @if(auth()->user()->role === 'pembina')
                Pembina
            @else
                {{ auth()->user()->class->name ?? 'Siswa' }}
            @endif
        </span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-4 py-2 bg-white rounded-lg border border-slate-200 text-neutral-800 text-xs font-medium hover:bg-slate-50 transition-colors">
                Logout
            </button>
        </form>
    </div>
</header>
