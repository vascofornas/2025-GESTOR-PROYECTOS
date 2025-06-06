@props(['title', 'labels' => [], 'values' => [], 'colors' => []])

<div class="bg-white dark:bg-zinc-800 rounded-xl p-4 shadow border dark:border-zinc-700">
    <h2 class="font-semibold mb-4">{{ $title }}</h2>
    <canvas x-data x-init="new Chart($el, {
        type: 'doughnut',
        data: {
            labels: @js($labels),
            datasets: [{
                data: @js($values),
                backgroundColor: @js($colors),
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    })" class="w-full h-64"></canvas>
</div>
