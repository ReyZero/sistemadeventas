@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Detalle del rol<b style="color:#2CABB0;"></b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">

@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Datos Registrados</h3>
            </div>
            <div class="card-body">


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Nombre del Rol</label>
                            <p>{{$role->name}}</p>
                        </div>
                    </div>
                </div>
                <hr style="background-color: #00BC8C;">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="form-group">
                            <a href="{{url('/admin/roles')}}" type="submit" class="btn btn-secondary" style="background-color: secondary; color:white;"><i class="fas fa-undo"></i> volver</a>
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

@section('js')

@stop