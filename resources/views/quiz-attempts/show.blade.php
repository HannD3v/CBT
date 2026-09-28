<x-app-layout :title="'Pengerjaan Quiz'" :activeMenu="'quizzes'">
    <div class="max-w-4xl mx-auto flex flex-col gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <h1 class="text-2xl font-bold text-slate-900">{{ $attempt->quiz->title }}</h1>
            <p class="text-sm text-slate-600 mt-1">Total Soal: {{ $attempt->quiz->questions->count() }}</p>
        </div>

        <form method="POST" action="{{ route('quiz-attempts.submit', $attempt) }}" class="space-y-6">
            @csrf
            @foreach($attempt->quiz->questions as $index => $question)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full mb-3">Soal {{ $index + 1 }}</span>
                    <p class="text-lg font-medium text-slate-900 mb-4">{{ $question->question_text }}</p>
                    <div class="space-y-3">
                        @foreach($question->answers as $answer)
                            <label class="flex items-center gap-3 p-4 border border-slate-200 rounded-xl cursor-pointer hover:border-blue-300 hover:bg-blue-50 transition">
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}" class="w-4 h-4 text-blue-500" required>
                                <span class="text-sm text-slate-700">{{ $answer->answer_text }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <button type="submit" onclick="return confirm('Yakin submit jawaban?')" class="w-full h-14 bg-blue-500 text-white font-semibold rounded-xl hover:bg-blue-600 text-lg">Submit Jawaban</button>
            </div>
        </form>
    </div>
</x-app-layout>