@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar especialidad</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/especialidades') }}" class="btn btn-sm btn-success">
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

                <form action="{{ url('/especialidades/' . $specialty->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nombre de la especialidad</label>
                        <input type="text" name="name" class="form-control" required
                            value="{{ old('name', $specialty->name) }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Descripción de la especialidad</label>
                        <input type="text" name="description" class="form-control"
                            value="{{ old('description', $specialty->description) }}">
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Guardar especialidad</button>
                </form>

            </div>
        </div>
    </div>
@endsection
