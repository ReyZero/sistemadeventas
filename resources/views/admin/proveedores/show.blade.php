@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Antecedende del Proveedor<b style="color:#1E90FF;"></b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">

@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Datos Registrados</h3>
            </div>
            <div class="card-body">
                 
                    

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="empresa">Nombre Empresa</label><b style="color: crimson;"> </b>
                                        <p>{{$proveedor->empresa}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label><b style="color: crimson;"> </b>
                                        <p>{{$proveedor->direccion}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono Empresa</label><b style="color: crimson;"> </b>
                                        <p>{{$proveedor->direccion}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Correo Electronico</label><b style="color: crimson;"> </b>
                                        <p>{{$proveedor->direccion}}</p>
                                    </div>                                     
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombre Proveedor</label><b style="color: crimson;"> </b>
                                        <p>{{$proveedor->direccion}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="celular">Celular Contacto</label><b style="color: crimson;"> </b>
                                        <p>{{$proveedor->celular}}</p>
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                   
                    </div>

                    <hr style="background-color: #00BC8C;">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="form-group">
                                
                                <a href="{{url('/admin/proveedores')}}" type="submit" class="btn btn-secondary" style="background-color: secondary; color:white;"><i class="fas fa-undo"></i> volver</a>
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