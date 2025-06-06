<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Projects\ProjectList;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Ruta para el dashboard (vacío o con widgets)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Ruta para la vista de proyectos
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
