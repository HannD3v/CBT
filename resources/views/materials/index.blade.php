<x-app-layout :title="'Materi Belajar'" :activeMenu="'materials'">
    <div class="flex flex-col gap-6">
        <!-- Header -->
        <div class="flex justify-between items-end">
            <div class="flex-1 flex flex-col gap-1.5">
                <h1 class="text-neutral-800 text-2xl font-bold leading-8">Materi Belajar</h1>
                <p class="text-gray-500 text-sm leading-5">Pelajari modul Bahasa Inggris sesuai urutan dan kategori yang kamu butuhkan.</p>
            </div>
            @if(auth()->user()->role === 'pembina')
                <a href="{{ route('materials.create') }}" class="px-5 py-2.5 bg-blue-500 text-white font-bold text-sm rounded-xl hover:bg-blue-600 transition-colors">
                    Tambah Materi
                </a>
            @endif
        </div>

        <!-- Filter & Counter Bar -->
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-2.5">
                <form method="GET" action="{{ route('materials.index') }}" class="w-56">
                    <div class="relative">
                        <select name="category_id" onchange="this.form.submit()" class="w-full px-3.5 py-2.5 bg-white rounded-xl border border-slate-200 text-neutral-800 text-xs font-medium appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected((string) request('category_id') === (string) $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </form>
                <span class="px-2.5 py-[5px] bg-indigo-100 rounded-full text-blue-600 text-xs font-semibold">
                    {{ $materials->total() ?? $materials->count() }} materi
                </span>
            </div>
            <p class="text-gray-500 text-xs">Materi hanya dapat dibaca oleh siswa</p>
        </div>

        {{-- Tampilan saat materi tersedia --}}
        @if($materials->count())
            <div class="flex flex-col gap-3">
                <h2 class="text-neutral-800 text-base font-bold">Semua Materi</h2>
                
                <div class="flex flex-col gap-3">
                    @foreach($materials as $material)
                        @php
                            $catIcons = [
                                'Grammar'   => ['bg' => 'bg-green-100',   'icon' => 'text-green-700'],
                                'Vocabulary'=> ['bg' => 'bg-indigo-100',  'icon' => 'text-blue-500'],
                                'Reading'   => ['bg' => 'bg-orange-100', 'icon' => 'text-orange-700'],
                                'Writing'   => ['bg' => 'bg-violet-100', 'icon' => 'text-violet-600'],
                                'Listening' => ['bg' => 'bg-rose-100',    'icon' => 'text-rose-500'],
                            ];
                            $cfg = $catIcons[$material->category->name] ?? ['bg' => 'bg-slate-100', 'icon' => 'text-gray-500'];
                        @endphp
                        <a href="{{ route('materials.show', $material) }}" class="p-4 bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all flex items-center gap-4">
                            <div class="w-12 h-12 {{ $cfg['bg'] }} rounded-xl flex items-center justify-center shrink-0">
                                @if($material->category->name === 'Grammar')
                                    <svg class="w-5 h-5 {{ $cfg['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                @elseif($material->category->name === 'Vocabulary')
                                    <svg class="w-5 h-5 {{ $cfg['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                    </svg>
                                @elseif($material->category->name === 'Reading')
                                    <svg class="w-5 h-5 {{ $cfg['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                @elseif($material->category->name === 'Writing')
                                    <svg class="w-5 h-5 {{ $cfg['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 {{ $cfg['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1 flex flex-col gap-[5px]">
                                <h3 class="text-neutral-800 text-base font-semibold">{{ $material->title }}</h3>
                                <p class="text-gray-500 text-xs leading-4">{{ $material->category->name }} · Modul Pembelajaran</p>
                            </div>
                            <x-badge status="dipelajari" />
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $materials->withQueryString()->links('pagination.tailwind-custom') }}
                </div>
            </div>
        {{-- Tampilan saat materi kosong --}}
        @else
            <div class="flex flex-col items-center justify-center py-10">
                <div class="w-full max-w-sm flex flex-col gap-3">
                    <div class="px-5 py-7 bg-white rounded-2xl border border-slate-200 flex flex-col items-center text-center gap-2.5 shadow-sm">
                        <div class="w-11 h-11 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-neutral-800 text-sm font-bold">Belum ada materi tersedia</h3>
                        <p class="text-gray-500 text-xs">Materi baru dari pembina akan tampil di sini.</p>
                    </div>

                    <div class="p-4 bg-indigo-100 rounded-xl flex flex-col gap-1.5">
                        <h4 class="text-blue-600 text-xs font-bold">Urutan belajar disarankan</h4>
                        <p class="text-gray-500 text-xs leading-4">Mulai dari Grammar, lanjutkan Vocabulary, lalu praktikkan lewat Speaking.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>