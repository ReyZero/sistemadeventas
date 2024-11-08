@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Registro del Producto<b style="color:#1E90FF;"></b></h1>
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
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="role">Categorías</label><b style="color: crimson;"> </b>
                                    <p>{{$producto->categoria->nombre }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigo">Código Producto</label><b style="color: crimson;"> </b>
                                    <p>{{$producto->codigo}}</p>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre del Producto</label><b style="color: crimson;"> </b>
                                    <p>{{$producto->nombre}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label><b style="color: crimson;"> </b>
                                    <p>{{$producto->descripcion}}</p>
                                </div>
                                <div class="row"></div>
                            </div>
                        </div>
                        <div class="row" style="text-align:center;">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="stock">Stock</label><b style="color: crimson;"> </b>
                                    <p  style="background-color:rgba(233, 231, 16, 0.15)">{{$producto->stock}}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="stock_minimo">Stock Mínimo</label><b style="color: crimson;"> </b>
                                    <p>{{$producto->stock_minimo}}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="stock_maximo">Stock Máximo</label><b style="color: crimson;"> </b>
                                    <p>{{$producto->stock_maximo}}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="precio_compra">Precio de Compra</label><b style="color: crimson;"> </b>
                                    <p>$ {{number_format($producto->precio_compra, 0, ',', '.')}}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="precio_venta">Precio de Venta</label><b style="color: crimson;"> </b>
                                    <p>$ {{number_format($producto->precio_venta, 0, ',', '.')}}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="fecha_ingreso">Fecha de Ingreso</label><b style="color: crimson;"> </b>
                                    <p>{{ \Carbon\Carbon::parse($producto->fecha_ingreso)->format('m-d-Y') }}</p>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!--IMAGEN-->
                    <div class="col-md-3">
                        <div class="form-group" style="text-align:center;">
                            <label for="logo">Logotipo Producto</label><b style="color: crimson;"> </b>
                            <img src="{{asset('storage/'.$producto->imagen)}}" alt="Imagen No Disponible" width="70%" style="border: 5px solid #00BC8C; box-shadow: 5px 0px 5px 0px #00BC8C;">
                        </div>

                    </div>
                </div>

                <hr style="background-color: #00BC8C;">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="form-group">

                            <a href="{{url('/admin/productos')}}" type="submit" class="btn btn-secondary" style="background-color: secondary; color:white;"><i class="fas fa-undo"></i> volver</a>
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
        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 40%"></div>
    </div>
</div>
@stop
@section('js')

@stop