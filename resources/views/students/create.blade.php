<x-app-layout :title="'Tambah Siswa'" :activeMenu="'students'">
    <div class="max-w-2xl mx-auto flex flex-col gap-6">
        <h1 class="text-2xl font-bold text-slate-900">Tambah Siswa Baru</h1>
        <form method="POST" action="{{ route('students.store') }}" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full h-12 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" class="w-full h-12 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('username')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Kelas</label>
                <select name="class_id" class="w-full h-12 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Kelas</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" @selected(old('class_id') == $class->id)>{{ $class->name }}</option>
                    @endforeach
                </select>
                @error('class_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Password (Opsional)</label>
                <input type="password" name="password" class="w-full h-12 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-slate-500 mt-1">Kosongkan untuk password default: password123</p>
                @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex gap-3 pt-4 border-t border-slate-200">
                <button type="submit" class="flex-1 h-12 bg-blue-500 text-white font-semibold rounded-xl hover:bg-blue-600">Simpan Siswa</button>
                <a href="{{ route('students.index') }}" class="flex-1 h-12 bg-slate-100 text-slate-700 font-semibold rounded-xl hover:bg-slate-200 flex items-center justify-center">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>