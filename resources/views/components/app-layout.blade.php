@props(['title' => null, 'activeMenu' => 'dashboard'])
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'JoyLish - Joyful English Platform' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="flex min-h-screen">
        <x-sidebar :activeMenu="$activeMenu" />
        <div class="flex-1 ml-60">
            <x-navbar />
            <main class="p-8">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
                        @foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
