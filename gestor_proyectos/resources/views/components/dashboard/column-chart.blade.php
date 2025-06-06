@props(['data'])

<div
    x-data="{
        chart: null,
        init() {
            if (this.chart) {
                this.chart.destroy(); // ✅ Evita duplicado
            }

            this.chart = new ApexCharts(this.$refs.chart, {
                chart: {
                    type: 'bar',
                    height: 250,
                },
                series: [{
                    name: 'Proyectos',
                    data: {{ json_encode($data['values']) }},
                }],
                xaxis: {
                    categories: {{ json_encode($data['labels']) }},
                },
                colors: ['#22c55e', '#9ca3af'], // ✅ Verde y gris, coherente con los estados
            });

            this.chart.render();
        }
    }"
    x-init="init"
>
    <div x-ref="chart"></div>
</div>

