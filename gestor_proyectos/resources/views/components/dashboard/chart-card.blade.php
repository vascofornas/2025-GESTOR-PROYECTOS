@props(['title'])

<div class="bg-white dark:bg-zinc-800 p-4 rounded-xl shadow border dark:border-zinc-700">
    <h2 class="text-lg font-semibold mb-4">{{ $title }}</h2>
    <div class="relative h-64">
        {{ $slot }}
    </div>
</div>
