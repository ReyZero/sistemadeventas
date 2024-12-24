@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Detalle del Permiso<b style="color:#483D8B;"></b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card card-outline card-primary"> <!-- Color distintivo azul oscuro -->
            <div class="card-header" style="background-color: #483D8B; color: white;"> <!-- Fondo azul oscuro -->
                <h3 class="card-title">Datos Registrados</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name" style="color:rgb(147, 133, 236);">Nombre del Permiso</label> <!-- Texto visible -->
                            <p style="font-weight: bold; color: #F8F9FA;">{{$permiso->name}}</p> <!-- Contraste claro -->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name" style="color:rgb(147, 133, 236);">Fecha de Creacón</label> <!-- Texto visible -->
                            <p style="font-weight: bold; color: #F8F9FA;">{{\Carbon\Carbon::parse($permiso->created_at)->format('d/m/y H:i:s')}}</p> <!-- Contraste claro -->
                        </div>
                    </div>
                </div>
                <hr style="background-color: rgb(147, 133, 236);"> <!-- Separador azul oscuro -->
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="form-group">
                            <a href="{{url('/admin/permisos')}}" class="btn btn-secondary" style="background-color: #6C757D; color:white;">
                                <i class="fas fa-undo"></i> Volver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .card-header {
        text-align: center;
    }
</style>
@stop

@section('js')
<!-- Scripts adicionales opcionales -->
@stop