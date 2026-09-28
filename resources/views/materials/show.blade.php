<x-app-layout :title="'Detail Materi'" :activeMenu="'materials'">
    <div class="max-w-4xl mx-auto flex flex-col gap-6">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
            <span class="inline-block px-3 py-1 bg-blue-50 text-blue-600 text-xs font-semibold rounded-full mb-3">{{ $material->category->name }}</span>
            <h1 class="text-3xl font-bold text-slate-900 mb-2">{{ $material->title }}</h1>
            <p class="text-sm text-slate-600">Dibuat oleh: {{ $material->creator->name }}</p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
            <div class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">{!! e($material->content) !!}</div>
        </div>

        @if($material->quizzes->count())
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                <h2 class="text-xl font-semibold text-slate-900 mb-4">Quiz Terkait</h2>
                <div class="space-y-3">
                    @foreach($material->quizzes as $quiz)
                        <a href="{{ route('quizzes.show', $quiz) }}" class="flex justify-between items-center p-4 border border-slate-200 rounded-xl hover:border-blue-300 hover:bg-blue-50 transition">
                            <div>
                                <p class="font-semibold text-slate-900">{{ $quiz->title }}</p>
                                <p class="text-sm text-slate-600">{{ $quiz->questions->count() }} soal</p>
                            </div>
                            <span class="text-blue-600 font-medium text-sm">Mulai →</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        @if(auth()->user()->role === 'pembina')
            <div class="flex gap-3">
                <a href="{{ route('materials.edit', $material) }}" class="flex-1 h-12 flex items-center justify-center bg-blue-500 text-white font-semibold rounded-xl hover:bg-blue-600">Edit Materi</a>
                <form method="POST" action="{{ route('materials.destroy', $material) }}" onsubmit="return confirm('Yakin hapus materi ini?')" class="flex-1">
                    @csrf @method('DELETE')
                    <button class="w-full h-12 bg-red-100 text-red-700 font-semibold rounded-xl hover:bg-red-200">Hapus Materi</button>
                </form>
            </div>
        @endif

        <div>
            <a href="{{ route('materials.index') }}" class="text-sm text-blue-600 hover:text-blue-700">← Kembali ke Daftar Materi</a>
        </div>
    </div>
</x-app-layout>