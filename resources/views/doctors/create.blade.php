<?php
use Illuminate\Support\Str;
?>

@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Nuevo Médico</h3>
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

                <form action="{{ url('/medicos') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre del doctor</label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="DPI">DPI</label>
                        <input type="text" name="DPI" class="form-control" required value="{{ old('DPI') }}">
                    </div>

                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" name="address" class="form-control" required value="{{ old('address') }}">
                    </div>

                    <div class="form-group">
                        <label for="phone">Teléfono / Móvil</label>
                        <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}">
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" name="role" class="form-control" readonly required value="doctor">
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="text" name="password" class="form-control" required
                            value="{{ old('password', Str::random(8)) }}">
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Crear médico</button>
                </form>

            </div>
        </div>
    </div>
@endsection
