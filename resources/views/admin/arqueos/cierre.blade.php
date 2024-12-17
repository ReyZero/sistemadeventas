@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>ARQUEOS / CIERRE DE CAJA<b style="color:#6164DC;"></b></h1>
<hr style="background-color: #6164DC; height: 1px; border: none;">

@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title">Ingrese los datos</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/admin/arqueos/create_cierre')}}" method="post">
                    @csrf
                    <input type="id" value="{{$arqueo->id}}" name="id" hidden>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="fecha_apertura">Fecha de Apertura</label><b style="color: crimson;"> </b>
                                <input type="datetime-local" class="form-control" name="fecha_apertura" value="{{$arqueo->fecha_apertura, old('fecha_apertura')}}" disabled>
                                @error('fecha_apertura')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="monto_inicial">Monto Inicial</label><b style="color: crimson;"> </b>
                                <input type="text" class="form-control" name="monto_inicial" disabled value="{{$arqueo->monto_inicial, old('monto_inicial')}}">
                                @error('monto_inicial')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="fecha_cierre">Fecha de Cierre</label><b style="color: crimson;"> </b>
                                <input type="datetime-local" class="form-control" name="fecha_cierre" value="{{ old('fecha_cierre')}}">
                                @error('fecha_cierre')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="monto_final">Monto Final</label><b style="color: crimson;"> </b>
                                <input type="text" class="form-control" name="monto_final"  value="{{ old('monto_final')}}">
                                @error('monto_final')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

            </div>
            <hr style="background-color: #335476;">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger" style="background-color: danger; color:white;"><i class="fas fa-lock"></i> Cerrar Caja</button>
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