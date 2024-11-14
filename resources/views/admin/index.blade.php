@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Bienvenido <b style="color:#1E90FF;">{{$empresa->nombre_empresa}}</b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">

@stop

@section('content')
<div class="row">
    <!-- ROLES -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP" style="background: linear-gradient(135deg, #000000, #333333); border: 2px solid #00c0ef; border-radius: 10px; transition: all 0.3s ease;">
            <a href="{{ url('/admin/roles') }}" class="info-box-icon bg-info" style="color: #fff; border-radius: 50%; transition: background-color 0.3s ease;">
                <i class="fas fa-user-check"></i>
            </a>
            <div class="info-box-content">
                <span class="info-box-text" style="color: #fff;">Roles registrados</span>
                <span class="info-box-numbers" style="color: #fff;">{{ $total_roles }} roles</span>
            </div>
        </div>
    </div>

    <!-- USUARIOS -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP" style="background: linear-gradient(135deg, #000000, #333333); border: 2px solid #28a745; border-radius: 10px; transition: all 0.3s ease;">
            <a href="{{ url('/admin/usuarios') }}" class="info-box-icon bg-success" style="color: #fff; border-radius: 50%; transition: background-color 0.3s ease;">
                <i class="fas fa-users"></i>
            </a>
            <div class="info-box-content">
                <span class="info-box-text" style="color: #fff;">Usuarios registrados</span>
                <span class="info-box-numbers" style="color: #fff;">{{ $total_usuarios }} usuarios</span>
            </div>
        </div>
    </div>

    <!-- CATEGORIAS -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP" style="background: linear-gradient(135deg, #000000, #333333); border: 2px solid #ffc107; border-radius: 10px; transition: all 0.3s ease;">
            <!-- Enlace con ícono y fondo amarillo -->
            <a href="{{ url('/admin/categorias') }}" class="info-box-icon" style="color: #fff; background-color: #ffc107; border-radius: 50%; transition: background-color 0.3s ease; border: 2px solid #ffc107;">
                <i class="fas fa-tags" style="color: #fff;"></i> <!-- Ícono blanco -->
            </a>
            <div class="info-box-content">
                <span class="info-box-text" style="color: #fff;">Categorias registrados</span>
                <span class="info-box-numbers" style="color: #fff;">{{ $total_categorias }} usuarios</span>
            </div>
        </div>
    </div>

    <!-- PRODUCTOS -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP" style="background: linear-gradient(135deg, #000000, #333333); border: 2px solid #FF7F50; border-radius: 10px; transition: all 0.3s ease;">
            <!-- Enlace con ícono y fondo coral -->
            <a href="{{ url('/admin/productos') }}" class="info-box-icon" style="color: #fff; background-color: #FF7F50; border-radius: 50%; transition: background-color 0.3s ease; border: 2px solid #FF7F50;">
                <i class="fas fa-list" style="color: #fff;"></i> <!-- Ícono blanco -->
            </a>
            <div class="info-box-content">
                <span class="info-box-text" style="color: #fff;">Productos registrados</span>
                <span class="info-box-numbers" style="color: #fff;">{{ $total_productos }} usuarios</span>
            </div>
        </div>
    </div>


    <!-- PROVEEDORES -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP" style="background: linear-gradient(135deg, #000000, #333333); border: 2px solid #FF0000; border-radius: 10px; transition: all 0.3s ease;">
            <!-- Enlace con ícono y fondo rojo -->
            <a href="{{ url('/admin/proveedores') }}" class="info-box-icon" style="color: #fff; background-color: #FF0000; border-radius: 50%; transition: background-color 0.3s ease; border: 2px solid #FF0000;">
                <i class="fas fa-truck-fast" style="color: #fff;"></i> <!-- Ícono blanco -->
            </a>
            <div class="info-box-content">
                <span class="info-box-text" style="color: #fff;">Proveedores registrados</span>
                <span class="info-box-numbers" style="color: #fff;">{{ $total_proveedores }} productos</span>
            </div>
        </div>
    </div>

    <!-- COMPRAS -->
    <!-- COMPRAS -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP" style="background: linear-gradient(135deg, #000000, #333333); border: 2px solid #007bff; border-radius: 10px; transition: all 0.3s ease;">
            <!-- Enlace con ícono y fondo azul -->
            <a href="{{ url('/admin/compras') }}" class="info-box-icon" style="color: #fff; background-color: #007bff; border-radius: 50%; transition: background-color 0.3s ease; border: 2px solid #007bff;">
                <i class="fas fa-shopping-cart" style="color: #fff;"></i> <!-- Ícono blanco -->
            </a>
            <div class="info-box-content">
                <span class="info-box-text" style="color: #fff;">Compras registradas</span>
                <span class="info-box-numbers" style="color: #fff;">{{ $total_proveedores }} compras</span>
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
@if ((($mensaje=Session::get('mensaje')) &&(($icono=Session::get('icono')))))
<script>
    Swal.fire({
        position: "top-end",
        icon: "{{$icono}}",
        title: "{{$mensaje}}",
        showConfirmButton: false,
        timer: 2500
    });
</script>
@endif

@stop