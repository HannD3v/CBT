<x-app-layout :title="'Tambah Materi'" :activeMenu="'materials'">
    <div class="max-w-3xl mx-auto flex flex-col gap-6">
        <h1 class="text-2xl font-bold text-slate-900">Tambah Materi Baru</h1>
        <form method="POST" action="{{ route('materials.store') }}" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Kategori</label>
                <select name="category_id" class="w-full h-12 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Judul Materi</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full h-12 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Konten Materi</label>
                <textarea name="content" rows="12" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('content') }}</textarea>
                @error('content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex gap-3 pt-4 border-t border-slate-200">
                <button type="submit" class="flex-1 h-12 bg-blue-500 text-white font-semibold rounded-xl hover:bg-blue-600">Simpan Materi</button>
                <a href="{{ route('materials.index') }}" class="flex-1 h-12 bg-slate-100 text-slate-700 font-semibold rounded-xl hover:bg-slate-200 flex items-center justify-center">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>