<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\User;
use Livewire\Component;

class DashboardStats extends Component
{
    public int $total = 0;
    public int $pendiente = 0;
    public int $enCurso = 0;
    public int $completado = 0;
    public int $cancelado = 0;

    public array $porEstadoChartData = [];
    public array $porMesChartData = [];
    public array $porUsuarioChartData = [];
    public array $completadoCanceladoChartData = [];
    public array $destacadosChartData = [];

    public function mount(): void
    {
        // Totales
        $this->total = Project::count();
        $this->pendiente = Project::where('status', 'pendiente')->count();
        $this->enCurso = Project::where('status', 'en curso')->count();
        $this->completado = Project::where('status', 'completado')->count();
        $this->cancelado = Project::where('status', 'cancelado')->count();

        // Gráfico de proyectos por estado (Pie)
   $this->porEstadoChartData = [
    'labels' => ['Pendiente', 'En curso', 'Completado', 'Cancelado'],
    'values' => [
        $this->pendiente,
        $this->enCurso,
        $this->completado,
        $this->cancelado,
    ],
     'colors' => ['#ef4444', '#60a5fa', '#22c55e', '#9ca3af'],
];



        // Gráfico de proyectos creados por mes (Línea)
 // Gráfico de proyectos creados por mes (Línea)
$this->porMesChartData = [
    'labels' => [],
    'values' => [],
    'color' => '#3B82F6', // Azul Tailwind
];

$proyectosPorMes = Project::whereNotNull('created_at')
    ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as mes, COUNT(*) as total")
    ->groupBy('mes')
    ->orderBy('mes')
    ->get();

foreach ($proyectosPorMes as $registro) {
    $this->porMesChartData['labels'][] = $registro->mes;
    $this->porMesChartData['values'][] = $registro->total;
}


        // Gráfico de proyectos por usuario (Barras)
       $this->porUsuarioChartData = [
    'labels' => [],
    'values' => [],
    'color' => '#14b8a6', // Teal de Tailwind
];


        $usuarios = User::withCount('projects')->orderByDesc('projects_count')->limit(5)->get();
        foreach ($usuarios as $usuario) {
            $this->porUsuarioChartData['labels'][] = $usuario->name;
            $this->porUsuarioChartData['values'][] = $usuario->projects_count;
        }

     

      
    }

    public function render()
    {
        return view('livewire.dashboard-stats');
    }
}
