@props(['title', 'labels' => [], 'values' => [], 'color' => 'teal'])

<div class="bg-white dark:bg-zinc-800 rounded-xl p-4 shadow border dark:border-zinc-700">
    <h2 class="font-semibold mb-4">{{ $title }}</h2>
    <div class="relative h-64">
        <canvas
            x-data
            x-init="new Chart($el, {
                type: 'bar',
                data: {
                    labels: @js($labels),
                    datasets: [{
                        label: '{{ $title }}',
                        data: @js($values),
                        backgroundColor: @js(is_array($color) ? $color : array_fill(0, count($values), $color)),
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            })"
            class="absolute inset-0 w-full h-full"
        ></canvas>
    </div>
</div>
