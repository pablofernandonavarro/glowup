<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth')->name('home');

// Rutas de dashboard normal para usuarios
Route::middleware(['auth'])->group(function () {
    Route::redirect('dashboard', '/')->name('dashboard');

    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

// Rutas de administrador
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('usuarios', function () {
        return view('admin.usuarios.index');
    })->name('usuarios.index');

    Route::get('usuarios/crear', function () {
        return view('admin.usuarios.create');
    })->name('usuarios.create');

    Route::get('usuarios/{id}/editar', function ($id) {
        return view('admin.usuarios.edit', ['id' => $id]);
    })->name('usuarios.edit');
});

// Rutas de usuarios autenticados
Route::middleware(['auth'])->group(function () {
    Route::get('datos', function () {
        return view('datos');
    })->name('datos');

    Route::get('graficos', function () {
        return view('graficos');
    })->name('graficos');

    Route::get('historial', function () {
        return view('historial');
    })->name('historial');

    Route::get('ayuda', function () {
        return view('ayuda');
    })->name('ayuda');

    Route::view('perfil', 'perfil')->name('perfil');
});

// Servir fotos de perfil (alternativa al symlink storage en Windows)


require __DIR__.'/auth.php';
