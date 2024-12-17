@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Registro de un nuevo Arqueo<b style="color:#1E90FF;"></b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">

@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title">Ingrese los datos</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/admin/arqueos',$arqueo->id)}}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="fecha_apertura">Fecha de Apertura</label><b style="color: crimson;"> *</b>
                                <input type="datetime-local" class="form-control" name="fecha_apertura" required value="{{$arqueo->fecha_apertura, old('fecha_apertura')}}">
                                @error('fecha_apertura')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="monto_inicial">Monto Inicial</label><b style="color: crimson;"> </b>
                                <input type="number" class="form-control" name="monto_inicial" value="{{$arqueo->monto_inicial,   old('monto_inicial')}}">
                                @error('monto_inicial')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observaciones">observaciones</label><b style="color: crimson;"> </b>
                                <input type="text" class="form-control" name="observaciones" value="{{$arqueo->observaciones ,old('observaciones')}}">
                                @error('observaciones')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <hr style="background-color: #00BC8C;">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger" style="background-color: danger; color:white;"><i class="fas fa-save"></i> Modificar Arqueo</button>
                                <a href="{{url('/admin/arqueos')}}" type="submit" class="btn btn-secondary" style="background-color: secondary; color:white;"><i class="fas fa-undo"></i> volver</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')

@stop
<!--PRELOAD PERSONALIZAOD-->
@section('preloader')
<div class="text-center">
    <!-- Logo o ícono de carga de tecnología -->
    <div class="mb-4">
        <i class="fas fa-4x fa-spin fa-cogs text-primary"></i> <!-- Icono de engranaje (tecnológico) -->
    </div>

    <!-- Texto de carga -->
    <h4 class="mt-4 text-dark">Cargando tu tienda de tecnología</h4>
    <p class="text-muted">Estamos preparando los mejores productos para ti...</p>

    <!-- Barra de progreso (opcional para mejorar el efecto visual) -->
    <div class="progress mt-3" style="height: 10px;">
        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 70%"></div>
    </div>
</div>
@stop
@section('js')

@stop