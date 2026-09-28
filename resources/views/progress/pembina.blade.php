<x-app-layout :title="'Rekap Progress Siswa'" :activeMenu="'progress'">
    <div class="max-w-7xl mx-auto flex flex-col gap-6">
        <h1 class="text-2xl font-bold text-slate-900">Rekap Progress Siswa</h1>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-700">Nama Siswa</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-700">Kelas</th>
                        <th class="text-center px-6 py-4 text-sm font-semibold text-slate-700">Materi Selesai</th>
                        <th class="text-center px-6 py-4 text-sm font-semibold text-slate-700">Quiz Selesai</th>
                        <th class="text-center px-6 py-4 text-sm font-semibold text-slate-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr class="border-b border-slate-100 last:border-0">
                            <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $student->name }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $student->class->name }}</td>
                            <td class="px-6 py-4 text-center text-sm text-slate-700">{{ $student->materialProgress->count() }}</td>
                            <td class="px-6 py-4 text-center text-sm text-slate-700">{{ $student->quizAttempts->count() }}</td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('progress.student', $student) }}" class="px-3 py-1 bg-blue-50 text-blue-600 text-xs font-semibold rounded-lg hover:bg-blue-100">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-sm text-slate-500">Belum ada data siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if($students->hasPages())
                <div class="px-6 py-4 border-t border-slate-200">
                    {{ $students->links('pagination.tailwind-custom') }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>