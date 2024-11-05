@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Registro de un nuevo Rol<b style="color:#1E90FF;"></b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">

@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card card-outline card-orange">
            <div class="card-header">
                <h3 class="card-title">Ingrese los datos</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/admin/roles/create')}}" method="post">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nombre del Rol</label>
                                <input type="text" class="form-control" name="name" required value="{{old('name')}}">
                                @error('name')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr style="background-color: orange;">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-warning" style="background-color: #FD7E14; color:white;"><i class="fas fa-save"></i>  Registrar Rol</button>
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

@section('js')

@stop