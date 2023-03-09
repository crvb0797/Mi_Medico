<?php

use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\SpecialtyController;
use App\Http\Controllers\Api\HorarioController as ApiHorarioController;
use App\Http\Controllers\Api\SpecialtyController as ApiSpecialtyController;
use App\Http\Controllers\Doctor\HorarioController;
use App\Http\Controllers\Patient\AppoimentController;
use App\Http\Controllers\Patient\AppointmentController;
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

Route::middleware(['auth', 'doctor'])->group(function () {
    Route::get('/horario', [HorarioController::class, 'edit']);
    Route::post('/horario', [HorarioController::class, 'store']);
});


Route::middleware('auth')->group(function () {
    Route::get('/reservarcitas/create', [AppointmentController::class, 'create']);
    Route::post('/reservarcitas', [AppointmentController::class, 'store']);
    Route::get('/reservarcitas', [AppointmentController::class, 'index']);


    /* JSON */
    Route::get('/especialidades/{specialty}/medicos', [ApiSpecialtyController::class, 'doctors']);
    Route::get('/horario/horas', [ApiHorarioController::class, 'hours']);
});
