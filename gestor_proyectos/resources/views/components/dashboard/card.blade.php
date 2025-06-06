@props([
    'title',
    'value' => 0,
    'color' => 'gray',
])

@php
    $colors = [
        'red' => 'bg-red-100 text-red-800',
        'orange' => 'bg-orange-100 text-orange-800',
        'green' => 'bg-green-100 text-green-800',
        'yellow' => 'bg-yellow-100 text-yellow-800',
        'gray' => 'bg-gray-100 text-gray-800',
    ];
@endphp

<div class="rounded-xl border border-neutral-200 bg-white p-4 shadow dark:border-neutral-700 dark:bg-neutral-900">
    <div class="text-sm font-semibold text-neutral-500 dark:text-neutral-400">
        {{ $title }}
    </div>
    <div class="mt-2 text-3xl font-bold {{ $colors[$color] ?? $colors['gray'] }} inline-block px-3 py-1 rounded-lg">
        {{ $value }}
    </div>
</div>
