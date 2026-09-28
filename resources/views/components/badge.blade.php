@props(['status' => 'selesai'])

@php
$colors = [
    'selesai'        => 'bg-green-100 text-green-700',
    'menunggu'       => 'bg-amber-100 text-yellow-700',
    'menunggu-nilai' => 'bg-amber-100 text-yellow-700',
    'dipelajari'     => 'bg-indigo-100 text-blue-600',
    'sedang'         => 'bg-indigo-100 text-blue-600',
    'belum'          => 'bg-slate-100 text-gray-500',
];

$labels = [
    'selesai'        => 'Selesai',
    'menunggu'       => 'Menunggu Nilai',
    'menunggu-nilai' => 'Menunggu Nilai',
    'dipelajari'     => 'Dipelajari',
    'sedang'         => 'Sedang',
    'belum'          => 'Belum',
];
@endphp

<span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium {{ $colors[$status] ?? 'bg-slate-100 text-slate-700' }}">
    {{ $labels[$status] ?? ucfirst($status) }}
</span>
