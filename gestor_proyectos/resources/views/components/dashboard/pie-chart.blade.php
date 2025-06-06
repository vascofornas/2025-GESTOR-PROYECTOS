@props([
    'title' => '',
    'labels' => [],
    'values' => [],
    'colors' => [],
])

<div class="bg-white dark:bg-zinc-800 rounded-xl shadow border dark:border-zinc-700 p-4">
    <h2 class="font-semibold mb-4">{{ $title }}</h2>

    <div class="relative h-64">
        <canvas
            x-data
            x-init="new Chart($el, {
                type: 'pie',
                data: {
                    labels: @js($labels),
                    datasets: [{
                        data: @js($values),
                        backgroundColor: @js(count($colors) ? $colors : ['#f87171', '#fbbf24', '#34d399', '#60a5fa']),
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: getComputedStyle(document.documentElement).getPropertyValue('--tw-text-opacity') ? 'white' : 'black'
                            }
                        },
                    },
                }
            })"
        ></canvas>
    </div>
</div>

