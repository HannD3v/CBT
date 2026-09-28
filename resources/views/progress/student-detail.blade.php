<x-app-layout :title="'Detail Progress Siswa'" :activeMenu="'progress'">
    <div class="max-w-6xl mx-auto flex flex-col gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">{{ $student->name }}</h1>
                <p class="text-sm text-slate-600 mt-1">Username: {{ $student->username }} • Kelas: {{ $student->class->name }}</p>
            </div>
            <a href="{{ route('progress.index') }}" class="px-4 py-2 bg-slate-100 text-slate-700 text-sm font-semibold rounded-xl hover:bg-slate-200">← Kembali</a>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Materi Selesai</h2>
            @forelse($materialProgress as $progress)
                <div class="flex items-center justify-between p-3 border-b border-slate-100 last:border-0">
                    <p class="text-sm font-medium text-slate-900">{{ $progress->material->title }}</p>
                    <x-badge status="selesai" />
                </div>
            @empty
                <p class="text-sm text-slate-500">Belum ada materi selesai.</p>
            @endforelse
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Riwayat Quiz</h2>
            @forelse($quizAttempts as $attempt)
                <div class="flex items-center justify-between p-3 border-b border-slate-100 last:border-0">
                    <div>
                        <p class="text-sm font-medium text-slate-900">{{ $attempt->quiz->title }}</p>
                        <p class="text-xs text-slate-500">{{ $attempt->submitted_at?->format('d M Y, H:i') }}</p>
                    </div>
                    <span class="text-sm font-bold {{ ($attempt->score ?? 0) >= 70 ? 'text-green-600' : 'text-red-600' }}">Skor: {{ $attempt->score }}</span>
                </div>
            @empty
                <p class="text-sm text-slate-500">Belum ada riwayat quiz.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>