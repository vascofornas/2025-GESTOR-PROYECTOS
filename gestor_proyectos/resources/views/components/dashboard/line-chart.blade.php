@props(['title', 'labels' => [], 'values' => [], 'color' => 'rgba(59, 130, 246, 1)']) {{-- azul-500 --}}

<div class="bg-white dark:bg-zinc-800 rounded-xl p-4 shadow border dark:border-zinc-700">
    <h2 class="font-semibold mb-4">{{ $title }}</h2>

    <div style="height: 300px;">
        <canvas x-data x-init="new Chart($el, {
            type: 'line',
            data: {
                labels: @js($labels),
                datasets: [{
                    label: '{{ $title }}',
                    data: @js($values),
                    borderColor: '{{ $color }}',
                    backgroundColor: '{{ $color }}',
                    fill: false,
                    tension: 0.3,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        })" class="w-full h-full"></canvas>
    </div>
</div>
