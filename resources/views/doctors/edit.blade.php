<?php
use Illuminate\Support\Str;
?>

@extends('layouts.panel')

@section('styles')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar Médico</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/medicos') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-chevron-left"></i> Regresar
                    </a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <div class="card-body">

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Por favor!</strong> {{ $error }}
                        </div>
                    @endforeach
                @endif

                <form action="{{ url('/medicos/' . $doctor->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nombre del doctor</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name) }}">
                    </div>

                    <div class="form-group">
                        <label for="specialties">Especialidades</label>
                        <select name="specialties[]" id="specialties" class="form-control selectpicker"
                            data-style="btn-primary" title="Seleccionar especialidades" required multiple>

                            @foreach ($specialties as $specialty)
                                <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $doctor->email) }}">
                    </div>

                    <div class="form-group">
                        <label for="DPI">DPI</label>
                        <input type="text" name="DPI" class="form-control" value="{{ old('DPI', $doctor->DPI) }}">
                    </div>

                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" name="address" class="form-control"
                            value="{{ old('address', $doctor->address) }}">
                    </div>

                    <div class="form-group">
                        <label for="phone">Teléfono / Móvil</label>
                        <input type="text" name="phone" class="form-control"
                            value="{{ old('phone', $doctor->phone) }}">
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" name="role" class="form-control" readonly required value="doctor">
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="text" name="password" class="form-control">

                        <small class="text-warning">Solo llene el campo si desea cambiar la contraseña</small>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Guardar cambios</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(() => {});
        $('#specialties').selectpicker('val', @json($specialty_ids));
    </script>
@endsection
