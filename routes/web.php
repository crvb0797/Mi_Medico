<?php

use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\SpecialtyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::middleware(['auth', 'admin'])->group(function () {
    /* Especialidades */
    Route::get('/especialidades', [SpecialtyController::class, 'index']);
    Route::get('/especialidades/create', [SpecialtyController::class, 'create']);
    Route::get('/especialidades/{specialty}/edit', [SpecialtyController::class, 'edit']);
    Route::post('/especialidades', [SpecialtyController::class, 'sendData']);
    Route::put('/especialidades/{specialty}', [SpecialtyController::class, 'update']);
    Route::delete('/especialidades/{specialty}', [SpecialtyController::class, 'destroy']);

    /* Médicos */
    Route::resource('medicos', DoctorController::class);

    /* Pacientes */
    Route::resource('pacientes', PatientController::class);
});
