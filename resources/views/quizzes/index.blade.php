<x-app-layout :title="'Daftar Quiz'" :activeMenu="'quizzes'">
    <div class="flex flex-col gap-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-slate-900">Daftar Quiz</h1>
            @if(auth()->user()->role === 'pembina')
                <a href="{{ route('quizzes.create') }}" class="px-5 py-3 bg-blue-500 text-white font-semibold text-sm rounded-xl hover:bg-blue-600">Buat Quiz</a>
            @endif
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="text-left px-6 py-4 text-sm font-semibold text-slate-700">Judul Quiz</th>
                            <th class="text-left px-6 py-4 text-sm font-semibold text-slate-700">Materi Terkait</th>
                            <th class="text-center px-6 py-4 text-sm font-semibold text-slate-700">Tipe</th>
                            <th class="text-center px-6 py-4 text-sm font-semibold text-slate-700">Soal</th>
                            <th class="text-center px-6 py-4 text-sm font-semibold text-slate-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quizzes as $quiz)
                            <tr class="border-b border-slate-100 last:border-0">
                                <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $quiz->title }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $quiz->material?->title ?? '-' }}</td>
                                <td class="px-6 py-4 text-center"><span class="px-2 py-1 text-xs font-semibold rounded-full {{ $quiz->type === 'diagnostic' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">{{ ucfirst($quiz->type) }}</span></td>
                                <td class="px-6 py-4 text-center text-sm text-slate-600">{{ $quiz->questions->count() }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('quizzes.show', $quiz) }}" class="px-3 py-1 bg-blue-50 text-blue-600 text-xs font-semibold rounded-lg hover:bg-blue-100">Lihat Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-sm text-slate-500">Belum ada quiz.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($quizzes->hasPages())
                <div class="px-6 py-4 border-t border-slate-200">
                    {{ $quizzes->links('pagination.tailwind-custom') }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>