<x-app-layout :title="'Buat Quiz Baru'" :activeMenu="'quizzes'">
    <div class="max-w-2xl mx-auto flex flex-col gap-6">
        <h1 class="text-2xl font-bold text-slate-900">Buat Quiz Baru</h1>
        <form method="POST" action="{{ route('quizzes.store') }}" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Judul Quiz</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full h-12 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Tipe Quiz</label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="type" value="quiz" class="w-5 h-5 text-blue-500" @checked(old('type') === 'quiz' || !old('type'))>
                        <span class="text-sm font-medium text-slate-700">Quiz Biasa</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="type" value="diagnostic" class="w-5 h-5 text-blue-500" @checked(old('type') === 'diagnostic')>
                        <span class="text-sm font-medium text-slate-700">Diagnostic Test</span>
                    </label>
                </div>
                @error('type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Materi Terkait (Opsional)</label>
                <select name="material_id" class="w-full h-12 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tidak terkait materi tertentu</option>
                    @foreach($materials as $material)
                        <option value="{{ $material->id }}" @selected(old('material_id') == $material->id)>{{ $material->title }}</option>
                    @endforeach
                </select>
                @error('material_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex gap-3 pt-4 border-t border-slate-200">
                <button type="submit" class="flex-1 h-12 bg-blue-500 text-white font-semibold rounded-xl hover:bg-blue-600">Buat Quiz</button>
                <a href="{{ route('quizzes.index') }}" class="flex-1 h-12 bg-slate-100 text-slate-700 font-semibold rounded-xl hover:bg-slate-200 flex items-center justify-center">Batal</a>
            </div>
        </form>
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
            <p class="text-sm text-blue-700">💡 Setelah quiz dibuat, Anda akan diarahkan ke halaman detail untuk menambahkan soal.</p>
        </div>
    </div>
</x-app-layout>