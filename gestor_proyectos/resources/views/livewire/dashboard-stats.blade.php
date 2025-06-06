<div class="space-y-6">
    <h1 class="text-2xl font-bold">Panel de control</h1>

    <!-- Tarjetas resumen -->
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <x-dashboard.card title="Total de proyectos" value="{{ $total }}" />
        <x-dashboard.card title="Pendientes" value="{{ $pendiente }}" color="red" />
        <x-dashboard.card title="En curso" value="{{ $enCurso }}" color="orange" />
        <x-dashboard.card title="Completados" value="{{ $completado }}" color="green" />
        <x-dashboard.card title="Cancelados" value="{{ $cancelado }}" color="yellow" />
    </div>

    <!-- Gráfico: Proyectos por estado -->
   <x-dashboard.pie-chart
    title="Proyectos por estado"
    :labels="$porEstadoChartData['labels']"
    :values="$porEstadoChartData['values']"
    :colors="$porEstadoChartData['colors']"
/>


    <!-- Gráfico: Proyectos creados por mes -->
<x-dashboard.line-chart
    :labels="$porMesChartData['labels']"
    :values="$porMesChartData['values']"
    :color="$porMesChartData['color']"
    title="Proyectos creados por mes"
/>


    <!-- Gráfico: Proyectos por usuario -->
    <x-dashboard.bar-chart
    :labels="$porUsuarioChartData['labels']"
    :values="$porUsuarioChartData['values']"
    :color="$porUsuarioChartData['color']"
    title="Proyectos por usuario"
/>

 
