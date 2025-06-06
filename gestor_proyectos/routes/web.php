<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Projects\ProjectList;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// 👉 Esta ruta carga el componente ProjectList como dashboard
Route::get('dashboard', ProjectList::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 👉 Esta es la nueva ruta que usaremos en el menú lateral para la vista de Proyectos
Route::get('proyectos', ProjectList::class)
    ->middleware(['auth', 'verified'])
    ->name('projects.index');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
