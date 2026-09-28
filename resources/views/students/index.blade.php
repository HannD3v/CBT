<x-app-layout :title="'Kelola Siswa'" :activeMenu="'students'">
    <div class="flex flex-col gap-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-slate-900">Kelola Siswa</h1>
            <a href="{{ route('students.create') }}" class="px-5 py-3 bg-blue-500 text-white font-semibold text-sm rounded-xl hover:bg-blue-600">Tambah Siswa</a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="text-left px-6 py-4 text-sm font-semibold text-slate-700">Nama</th>
                            <th class="text-left px-6 py-4 text-sm font-semibold text-slate-700">Username</th>
                            <th class="text-left px-6 py-4 text-sm font-semibold text-slate-700">Kelas</th>
                            <th class="text-center px-6 py-4 text-sm font-semibold text-slate-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr class="border-b border-slate-100 last:border-0">
                                <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $student->name }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $student->username }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $student->class->name }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <form method="POST" action="{{ route('students.reset-password', $student) }}">
                                            @csrf
                                            <button class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-lg hover:bg-yellow-200">Reset Password</button>
                                        </form>
                                        <form method="POST" action="{{ route('students.destroy', $student) }}" onsubmit="return confirm('Yakin hapus siswa ini?')">
                                            @csrf @method('DELETE')
                                            <button class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-lg hover:bg-red-200">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-sm text-slate-500">Belum ada data siswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($students->hasPages())
                <div class="px-6 py-4 border-t border-slate-200">
                    {{ $students->links('pagination.tailwind-custom') }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>