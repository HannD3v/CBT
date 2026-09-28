<x-app-layout :title="'Detail Quiz'" :activeMenu="'quizzes'">
    <div class="max-w-4xl mx-auto flex flex-col gap-6">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2">{{ $quiz->title }}</h1>
                <p class="text-sm text-slate-600">Tipe: <span class="font-semibold text-slate-900">{{ ucfirst($quiz->type) }}</span> • Materi: <span class="font-semibold text-slate-900">{{ $quiz->material?->title ?? '-' }}</span></p>
                <p class="text-sm text-slate-600 mt-1">Total Soal: <span class="font-semibold text-slate-900">{{ $quiz->questions->count() }}</span></p>
            </div>
            @if(auth()->user()->role === 'siswa')
                <form method="POST" action="{{ route('quiz-attempts.start', $quiz) }}">
                    @csrf
                    <button type="submit" class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-xl hover:bg-blue-600">Mulai Quiz</button>
                </form>
            @elseif(auth()->user()->role === 'pembina')
                <form method="POST" action="{{ route('quizzes.destroy', $quiz) }}" onsubmit="return confirm('Yakin hapus quiz ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-5 py-2.5 bg-red-100 text-red-700 text-sm font-semibold rounded-xl hover:bg-red-200">Hapus Quiz</button>
                </form>
            @endif
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
            <h2 class="text-xl font-semibold text-slate-900 mb-4">Daftar Soal</h2>
            @forelse($quiz->questions as $index => $question)
                <div class="border border-slate-200 rounded-xl p-4 mb-4 last:mb-0">
                    <p class="font-medium text-slate-900 mb-3">{{ $index + 1 }}. {{ $question->question_text }}</p>
                    <div class="space-y-2">
                        @foreach($question->answers as $aIndex => $answer)
                            <div class="flex items-center gap-3 p-3 rounded-lg {{ $answer->is_correct ? 'bg-green-50 border border-green-200' : 'bg-slate-50' }}">
                                <span class="w-6 h-6 flex items-center justify-center rounded-full text-xs font-semibold {{ $answer->is_correct ? 'bg-green-600 text-white' : 'bg-slate-300 text-slate-600' }}">{{ chr(65 + $aIndex) }}</span>
                                <span class="text-sm {{ $answer->is_correct ? 'font-semibold text-green-800' : 'text-slate-700' }}">{{ $answer->answer_text }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <p class="text-sm text-slate-500">Belum ada soal.</p>
            @endforelse
        </div>

        @if(auth()->user()->role === 'pembina')
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                <h2 class="text-xl font-semibold text-slate-900 mb-4">Tambah Soal Baru</h2>
                <form method="POST" action="{{ route('quizzes.questions.store', $quiz) }}" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Teks Soal</label>
                        <textarea name="question_text" rows="3" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Pilihan Jawaban</label>
                        <div class="space-y-3">
                            @for($i = 0; $i < 4; $i++)
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 flex items-center justify-center bg-slate-100 rounded-full text-sm font-semibold text-slate-700">{{ chr(65 + $i) }}</span>
                                    <input type="text" name="answers[{{ $i }}][answer_text]" class="flex-1 h-12 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Pilihan {{ chr(65 + $i) }}" required>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Jawaban Benar</label>
                        <div class="flex gap-4">
                            @for($i = 0; $i < 4; $i++)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="correct_answer" value="{{ $i }}" class="w-4 h-4 text-blue-500" @checked($i === 0)>
                                    <span class="text-sm font-medium text-slate-700">Pilihan {{ chr(65 + $i) }}</span>
                                </label>
                            @endfor
                        </div>
                    </div>
                    <button type="submit" class="w-full h-12 bg-blue-500 text-white font-semibold rounded-xl hover:bg-blue-600">Tambah Soal</button>
                </form>
            </div>
        @endif
    </div>
</x-app-layout>