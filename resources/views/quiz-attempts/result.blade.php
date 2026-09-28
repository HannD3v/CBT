<x-app-layout :title="'Hasil Quiz'" :activeMenu="'quizzes'">
    <div class="max-w-4xl mx-auto flex flex-col gap-6">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-8 rounded-2xl shadow-lg text-center text-white">
            <h1 class="text-3xl font-bold mb-2">Hasil Quiz</h1>
            <p class="text-lg opacity-90 mb-6">{{ $attempt->quiz->title }}</p>
            <div class="inline-block bg-white/20 backdrop-blur-sm px-12 py-6 rounded-2xl">
                <p class="text-sm opacity-80 mb-1">Skor Anda</p>
                <p class="text-6xl font-bold">{{ $attempt->score }}</p>
                <p class="text-lg opacity-90 mt-1">dari 100</p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
            <h2 class="text-xl font-semibold text-slate-900 mb-6">Pembahasan</h2>
            <div class="space-y-6">
                @foreach($attempt->answers as $index => $attemptAnswer)
                    <div class="border rounded-xl p-6 {{ $attemptAnswer->is_correct ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }}">
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-3 py-1 bg-slate-700 text-white text-xs font-semibold rounded-full">Soal {{ $index + 1 }}</span>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $attemptAnswer->is_correct ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}">{{ $attemptAnswer->is_correct ? '✓ Benar' : '✗ Salah' }}</span>
                        </div>
                        <p class="text-lg font-medium text-slate-900 mb-4">{{ $attemptAnswer->question->question_text }}</p>
                        <p class="text-sm font-semibold text-slate-700 mb-1">Jawaban Anda:</p>
                        <div class="p-3 rounded-lg {{ $attemptAnswer->is_correct ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            <p class="text-sm">{{ $attemptAnswer->answer->answer_text }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('dashboard.siswa') }}" class="flex-1 h-12 bg-blue-500 text-white font-semibold rounded-xl hover:bg-blue-600 flex items-center justify-center">Kembali ke Dashboard</a>
            <a href="{{ route('quizzes.index') }}" class="flex-1 h-12 bg-slate-100 text-slate-700 font-semibold rounded-xl hover:bg-slate-200 flex items-center justify-center">Lihat Quiz Lainnya</a>
        </div>
    </div>
</x-app-layout>