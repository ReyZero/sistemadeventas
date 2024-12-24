@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Editar Permiso <b style="color:#6A5ACD;"></b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card card-outline card-purple"> <!-- Color distintivo púrpura -->
            <div class="card-header" style="background-color: #6A5ACD; color: white;"> <!-- Fondo púrpura -->
                <h3 class="card-title">Modificar los datos</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/permisos/'.$permiso->id) }}" method="post">
                    @csrf
                    @method('PUT') <!-- Método para indicar actualización -->
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nombre del Permiso</label><b style="color: crimson;">  *</b>
                                <input type="text" class="form-control" name="name" required value="{{ old('name', $permiso->name) }}" style="border-color: #6A5ACD;">
                                @error('name')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr style="background-color: #6A5ACD;"> <!-- Separador púrpura -->
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" style="background-color: #5A9BD4; color:white;">
                                    <i class="fas fa-save"></i> Actualizar Cambios
                                </button>
                                <a href="{{url('/admin/permisos')}}" class="btn btn-secondary" style="background-color: #6C757D; color:white;">
                                    <i class="fas fa-undo"></i> Volver
                                </a>
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
<style>
    .form-control:focus {
        border-color: #6A5ACD;
        box-shadow: 0 0 5px rgba(106, 90, 205, 0.5);
    }
</style>
@stop

<!--PRELOAD PERSONALIZADO-->
@section('preloader')
<div class="text-center">
    <!-- Logo o ícono de carga de tecnología -->
    <div class="mb-4">
        <i class="fas fa-4x fa-spin fa-cogs text-primary"></i> <!-- Icono de engranaje (tecnológico) -->
    </div>

    <!-- Texto de carga -->
    <h4 class="mt-4 text-dark">Cargando tu sistema de permisos</h4>
    <p class="text-muted">Preparando las mejores configuraciones para ti...</p>

    <!-- Barra de progreso -->
    <div class="progress mt-3" style="height: 10px;">
        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 70%; background-color: #6A5ACD;"></div>
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
