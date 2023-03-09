<?php
use Illuminate\Support\Str;
?>

@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Registrar nueva cita</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-chevron-left"></i> Regresar
                    </a>
                </div>
            </div>



        </div>
        <div class="table-responsive">
            <div class="card-body">

                {{-- Mensaje de información --}}
                @if (session('notification'))
                    <div class="alert alert-success" role="alert">
                        {{ session('notification') }}
                    </div>
                @endif

                {{-- Mensaje de errores --}}
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Por favor!</strong> {{ $error }}
                        </div>
                    @endforeach
                @endif

                <form action="{{ url('/reservarcitas') }}" method="POST">
                    @csrf

                    {{-- especialidad y doctores --}}
                    <div class="form-row">
                        {{-- Especialidad --}}
                        <div class="form-group col-md-6">
                            <label for="specialty">Especialidad</label>
                            <select name="specialty_id" id="specialty" class="form-control">
                                <option value="">Seleccionar especialidad</option>
                                @foreach ($specialties as $specialty)
                                    <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- doctores --}}
                        <div class="form-group col-md-6">
                            <label for="doctor">Médico</label>
                            <select required name="doctor_id" id="doctor" class="form-control">

                            </select>
                        </div>
                    </div>

                    {{-- Fecha --}}
                    <div class="form-group">
                        <label for="date">Fecha</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker" name="scheduled_date" id="date"
                                placeholder="Seleccionar fecha" type="text" value="{{ date('Y-m-d') }}"
                                data-date-format="yyyy-mm-dd" data-date-start-date="{{ date('Y-m-d') }}"
                                data-date-end-date="+30d">
                        </div>
                    </div>

                    {{-- Horario de atención --}}
                    <div class="form-group">
                        <label for="hours">Hora de atención</label>
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <h4 class="m-3" id="titleMorning"></h4>
                                    <div id="hoursMorning">
                                        <mark><small class="text-warning display-5">Seleccione un médico y una fecha para
                                                visualizar los horarios disponibles</small></mark>
                                    </div>
                                </div>

                                <div class="col">
                                    <h4 class="m-3" id="titleAfternoon"></h4>
                                    <div id="hoursAfternoon"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Button Radio --}}
                    <div class="form-group">
                        <label>Tipo de consulta</label>
                        <div class="custom-control custom-radio mb-3 mt-3">
                            <input class="custom-control-input" type="radio" name="type" id="type1"
                                value="Consulta" checked>
                            <label class="custom-control-label" for="type1">
                                Consulta
                            </label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                            <input class="custom-control-input" type="radio" name="type" id="type2" value="Examen">
                            <label class="custom-control-label" for="type2">
                                Examen
                            </label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input class="custom-control-input" type="radio" name="type" id="type3"
                                value="Operación">
                            <label class="custom-control-label" for="type3">
                                Operación
                            </label>
                        </div>
                    </div>

                    {{-- Descripción de síntomas --}}
                    <div class="form-group">
                        <label for="description">Síntomas</label>
                        <textarea name="description" id="descrition" type="text" class="form-control" cols="30" rows="10"
                            placeholder="Describa sus síntomas" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ asset('./js/appointments/create.js') }}"></script>
@endsection
