<div class="p-6 space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Proyectos</h1>
        <a href="#"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            <span>Nuevo proyecto</span>
        </a>
    </div>

    <!-- Campo de búsqueda -->
    <div class="flex justify-center mt-4">
        <input
            type="text"
            wire:model="search"
            wire:keyup="$refresh"
            placeholder="Buscar proyectos..."
            class="w-full md:w-1/2 px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:ring focus:ring-blue-200 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
        >
    </div>

    <!-- Filtros por estado centrados -->
    <div class="flex justify-center flex-wrap gap-2 mb-4 mt-4">
        <button
            wire:click="resetFilters"
            class="px-3 py-1.5 rounded-full text-sm font-medium
                {{ collect($filters)->contains(true) ? 'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200' : 'bg-blue-600 text-white' }}
                hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600 transition">
            Todos
        </button>

        @foreach (['pendiente', 'en curso', 'completado', 'cancelado'] as $estado)
            <button
                wire:click="$toggle('filters.{{ $estado }}')"
                class="px-3 py-1.5 rounded-full text-sm font-medium
                    {{ $filters[$estado] ?? false
                        ? 'bg-blue-600 text-white'
                        : 'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200' }}
                    hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600 transition">
                {{ ucfirst($estado) }}
            </button>
        @endforeach
    </div>

    <div class="overflow-x-auto rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200 bg-white dark:bg-gray-900">
            <thead class="bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Descripción</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Inicio</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Fin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Publicado por</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                @forelse ($projects as $project)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {!! $this->highlight($project->name) !!}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                            {!! $this->highlight(Str::limit($project->description, 60)) !!}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $colors = [
                                  'pendiente' => 'bg-red-100 text-red-700',
        'en curso' => 'bg-blue-100 text-blue-700',
        'completado' => 'bg-green-100 text-green-700',
        'cancelado' => 'bg-gray-100 text-gray-700',
                                ];
                                $estado = strtolower($project->status);
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colors[$estado] ?? 'bg-gray-100 text-gray-800' }}">
                                {!! $this->highlight(ucfirst($project->status)) !!}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {!! $this->highlight(\Carbon\Carbon::parse($project->start_date)->format('d-m-Y')) !!}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {!! $this->highlight(\Carbon\Carbon::parse($project->end_date)->format('d-m-Y')) !!}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {!! $this->highlight($project->creator?->name ?? '—') !!}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                            <a href="#" class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded bg-blue-100 text-blue-800 hover:bg-blue-200 dark:bg-blue-800 dark:text-white dark:hover:bg-blue-700 transition">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-1.5a2.121 2.121 0 010 3l-7.5 7.5H6v-3.232l7.5-7.5a2.121 2.121 0 013-0z" />
                                </svg>
                                Editar
                            </a>
                            <a href="#" class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded bg-red-100 text-red-800 hover:bg-red-200 dark:bg-red-800 dark:text-white dark:hover:bg-red-700 transition">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Eliminar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No hay proyectos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
