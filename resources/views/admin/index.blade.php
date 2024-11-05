@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Bienvenido <b style="color:#1E90FF;">{{$empresa->nombre_empresa}}</b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">

@stop

@section('content')
<p></p>
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