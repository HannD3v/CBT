<x-app-layout :title="'Dashboard Pembina'" :activeMenu="'dashboard'">
    <div class="flex flex-col gap-6">
        <div>
            <p class="text-sm font-medium text-blue-600">Joyful English</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-900">Dashboard Pembina</h1>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200">
                <p class="text-sm text-slate-600">Total Siswa</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ $stats['total_students'] }}</p>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200">
                <p class="text-sm text-slate-600">Total Materi</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ $stats['total_materials'] }}</p>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200">
                <p class="text-sm text-slate-600">Total Quiz</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ $stats['total_quizzes'] }}</p>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200">
                <p class="text-sm text-slate-600">Total Challenge</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ $stats['total_challenges'] }}</p>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200">
                <p class="text-sm text-slate-600">Submission Pending</p>
                <p class="mt-1 text-3xl font-bold text-orange-600">{{ $stats['pending_submissions'] }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200">
                <h2 class="text-lg font-semibold text-slate-900">Kelas Terdaftar</h2>
            </div>
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-6 py-3 text-sm font-semibold text-slate-700">Kelas</th>
                        <th class="text-left px-6 py-3 text-sm font-semibold text-slate-700">Jumlah Siswa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $class)
                        <tr class="border-t border-slate-200">
                            <td class="px-6 py-3 text-sm text-slate-900">{{ $class->name }}</td>
                            <td class="px-6 py-3 text-sm text-slate-600">{{ $class->students_count }} siswa</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-200">
                <h2 class="text-lg font-semibold text-slate-900">Quiz Attempts Terbaru</h2>
            </div>
            <div class="p-6 space-y-3">
                @forelse($recentAttempts as $attempt)
                    <div class="flex items-center justify-between p-4 border border-slate-200 rounded-xl">
                        <div>
                            <p class="font-medium text-slate-900">{{ $attempt->user->name }}</p>
                            <p class="text-sm text-slate-600">{{ $attempt->quiz->title }}</p>
                        </div>
                        <span class="text-lg font-bold {{ ($attempt->score ?? 0) >= 70 ? 'text-green-600' : 'text-red-600' }}">{{ $attempt->score ?? '-' }}</span>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada quiz attempts.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>