<x-app-layout :title="'Ganti Password'" :activeMenu="'dashboard'">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-slate-900 mb-6">Ganti Password</h1>
        <form method="POST" action="{{ route('password.change') }}" class="bg-white p-8 rounded-2xl shadow-sm space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Password Saat Ini</label>
                <input type="password" name="current_password" class="w-full h-12 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('current_password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Password Baru</label>
                <input type="password" name="password" class="w-full h-12 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full h-12 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 h-12 bg-blue-500 text-white font-semibold rounded-xl hover:bg-blue-600">Simpan</button>
                <a href="{{ route('dashboard.siswa') }}" class="flex-1 h-12 bg-slate-100 text-slate-700 font-semibold rounded-xl hover:bg-slate-200 flex items-center justify-center">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>