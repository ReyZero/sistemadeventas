@extends('adminlte::page')


@section('content_header')
<h1>Modificar rol : <span style="text-decoration: underline;">{{$role->name}}</span><b style="color:warning;"></b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">

@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card card-outline card-warning">
            <div class="card-header">
                <h3 class="card-title">Ingrese los datos</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/admin/roles',$role->id)}}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nombre del Rol</label>
                                <input type="text" class="form-control" name="name" required value="{{$role->name}}">
                                @error('name')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr style="background-color: #F39C12;">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-warning" style="background-color: warning; color:white;"><i class="fas fa-save"></i> Modiciar Rol</button>
                                <a href="{{url('/admin/roles')}}" type="submit" class="btn btn-secondary" style="background-color: secondary; color:white;"><i class="fas fa-undo"></i> volver</a>
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