@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Datos Registrados     | CATEGORIAS<b style="color:#1E90FF;"></b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">

@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Datos Registrados</h3>
            </div>
            <div class="card-body">
                

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Nombre de la categoría</label>
                                <P>{{$categoria->nombre}}</P>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Descripción</label><b style="color: crimson;">  </b>
                                <p>{{$categoria->descripcion}}</p>
                            </div>
                        </div>
                     
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password">Fecha y hora de Registro</label><b style="color: crimson;">  </b>
                                <p>{{$categoria->created_at}}</p>
                            </div>
                        </div>
                    
                    </div>
                    <hr style="background-color: #00BC8C;">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="form-group">
                               
                                <a href="{{url('/admin/categorias')}}" type="submit" class="btn btn-secondary" style="background-color: secondary; color:white;"><i class="fas fa-undo"></i> volver</a>
                            </div>
                        </div>
                    </div>
                
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