<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;
use Illuminate\Support\Str;

class ProjectList extends Component
{
    public string $search = '';

    public array $filters = [
        'pendiente' => false,
        'en curso' => false,
        'completado' => false,
        'cancelado' => false,
    ];

    public function resetFilters()
    {
        $this->filters = array_map(fn () => false, $this->filters);
    }

    public function highlight($text)
    {
        if (!$this->search) return e($text);

        return preg_replace_callback('/(' . preg_quote($this->search, '/') . ')/i', function ($match) {
            return '<span class="bg-yellow-200 dark:bg-yellow-600 font-semibold">' . e($match[0]) . '</span>';
        }, e($text));
    }

    public function render()
    {
        $query = Project::with('creator');

        if (!empty($this->search)) {
            $search = Str::lower($this->search);

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(description) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(status) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('CAST(start_date AS CHAR) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('CAST(end_date AS CHAR) LIKE ?', ["%{$search}%"])
                    ->orWhereHas('creator', fn ($q2) =>
                        $q2->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                    );
            });
        }

        $activeFilters = array_keys(array_filter($this->filters));
        if ($activeFilters) {
            $query->whereIn('status', $activeFilters);
        }

        $projects = $query->latest()->get();

        return view('livewire.projects.project-list', [
            'projects' => $projects,
        ]);
    }
}

