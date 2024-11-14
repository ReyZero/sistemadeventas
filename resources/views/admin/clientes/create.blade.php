@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Registro de Cliente<b style="color:#1E90FF;"></b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">

@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Ingrese los datos</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/admin/clientes/create')}}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre_cliente">nombre cliente </label><b style="color: crimson;"> *</b>
                                <input type="text" class="form-control" name="nombre_cliente" required value="{{old('nombre_cliente')}}">
                                @error('nombre_cliente')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nit_codigo">NIT /codigo Cliente</label><b style="color: crimson;"> *</b>
                                <input type="text" class="form-control" name="nit_codigo" required value="{{old('nit_codigo')}}">
                                @error('nit_codigo')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label><b style="color: crimson;"> *</b>
                                <input type="text" class="form-control" name="telefono" required value="{{old('telefono')}}">
                                @error('telefono')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Correo Electronico</label><b style="color: crimson;"> *</b>
                                <input type="email" class="form-control" name="email" required value="{{old('email')}}">
                                @error('email')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr style="background-color: #009670;">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" style="background-color: success; color:white;"><i class="fas fa-save"></i> Registrar Cliente</button>
                                <a href="{{url('/admin/clientes')}}" type="submit" class="btn btn-secondary" style="background-color: secondary; color:white;"><i class="fas fa-undo"></i> volver</a>
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