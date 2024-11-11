@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')
@inject('preloaderHelper', 'JeroenNoten\LaravelAdminLte\Helpers\PreloaderHelper')

@section('adminlte_css')
@stack('css')
@yield('css')

<!-- CSS adicional -->
<style>
    /* Hover effect for ROLES */
    .info-box .info-box-icon.bg-info:hover {
        background-color: #17a2b8 !important;
        /* Color info para el hover */
        transform: scale(1.1);
        /* Aumenta ligeramente el tamaño del icono */
    }

    /* Hover effect for USUARIOS */
    .info-box .info-box-icon.bg-success:hover {
        background-color: #28a745 !important;
        /* Color success para el hover */
        transform: scale(1.1);
        /* Aumenta ligeramente el tamaño del icono */
    }

    /* Hover effect for CATEGORIAS */
    .info-box .info-box-icon.bg-warning:hover {
        background-color: #ffc107 !important;
        /* Color warning para el hover */
        transform: scale(1.1);
        /* Aumenta ligeramente el tamaño del icono */
    }

    /* Hover effect for PRODUCTOS */
    .info-box .info-box-icon.bg-warning:hover {
        background-color: #FF7F50 !important;
        /* Color Coral para el hover */
        transform: scale(1.1);
        /* Aumenta ligeramente el tamaño del icono */
    }

    /* Hover effect for PROVEEDORES */
    .info-box .info-box-icon.bg-warning:hover {
        background-color: #FF6347 !important;
        /* Color Coral para el hover */
        transform: scale(1.1);
        /* Aumenta ligeramente el tamaño del icono */
    }

    /* Estilo para los iconos para que el hover se vea bien */
    .info-box .info-box-icon {
        transition: background-color 0.3s ease, transform 0.3s ease;
        /* Suaviza el cambio de color y tamaño */
    }

    .zoomP {
        /*Aumentamos el ancho y el alto durante 2 segundos */
        transition: width 1.1s, height 1.1s, transform 1.1s;
        -moz-transition: width 1.1s, height 1.1s, -moz-transform 1.1s;
        -webkit-transition: width 1.1s, height 1.1s, -webkit-transform 1.1s;
        -o-transition: width 1.1s, height 1.1s, -moz-transform 1.1s;
        border: 1px solid #c0c0c0;
        box-shadow: #c0c0c0 0px 5px 5px 0px;
    }

    .zoomP:hover {
        /*Transdoermamos el elemento al pasar el mouse por encima al doble de tamaño */
        transform: scale(1.05);
        -webkit-transform: scale(1.05);
        transform: scale(1.05);
    }
</style>
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
<div class="wrapper">

    {{-- Preloader Animation (fullscreen mode) --}}
    @if($preloaderHelper->isPreloaderEnabled())
    @include('adminlte::partials.common.preloader')
    @endif

    {{-- Top Navbar --}}
    @if($layoutHelper->isLayoutTopnavEnabled())
    @include('adminlte::partials.navbar.navbar-layout-topnav')
    @else
    @include('adminlte::partials.navbar.navbar')
    @endif

    {{-- Left Main Sidebar --}}
    @if(!$layoutHelper->isLayoutTopnavEnabled())
    @include('adminlte::partials.sidebar.left-sidebar')
    @endif

    {{-- Content Wrapper --}}
    @empty($iFrameEnabled)
    @include('adminlte::partials.cwrapper.cwrapper-default')
    @else
    @include('adminlte::partials.cwrapper.cwrapper-iframe')
    @endempty

    {{-- Footer --}}
    @hasSection('footer')
    @include('adminlte::partials.footer.footer')
    @endif

    {{-- Right Control Sidebar --}}
    @if($layoutHelper->isRightSidebarEnabled())
    @include('adminlte::partials.sidebar.right-sidebar')
    @endif

</div>
@stop

@section('adminlte_js')
@stack('js')
@yield('js')
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