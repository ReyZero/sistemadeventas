@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Modificar registro de Usuario<b style="color:#1E90FF;"></b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">

@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Datos Registrados</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/admin/usuarios',$usuario->id)}}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Nombre del Rol</label>
                                <select name="role" id="" class="form-control">
                                    <option value="" disabled selected>Seleccione un ROL</option>
                                    @foreach ($roles as $role )
                                    <option value="{{$role->name}}" {{$role->name==$usuario->roles->pluck('name')->implode(', ') ?'selected':''}}>{{$role->name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Nombre del Usuario</label><b style="color: crimson;"> *</b>
                                @if ($usuario->name ==='Admin')
                                <input type="text" class="form-control" required value="{{$usuario->name}}" disabled>
                                <input type="text" class="form-control" name="name" required value="{{$usuario->name}}" hidden>
                                @else
                                <input type="text" class="form-control" name="name" required value="{{$usuario->name}}">
                                @endif

                                @error('name')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Correo Electronico</label><b style="color: crimson;"> *</b>
                                <input type="email" class="form-control" name="email" required value="{{$usuario->email}}">
                                @error('email')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password">Indique Contraseña</label><b style="color: crimson;"> </b>
                                <input type="password" class="form-control" name="password" value="{{old('password')}}">
                                @error('password')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password_confirmation">Repita Contraseña</label><b style="color: crimson;"> </b>
                                <input type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}">
                                @error('password_confirmation')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr style="background-color: #00BC8C;">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" style="background-color: success; color:white;"><i class="fas fa-save"></i> Modificar usuario</button>
                                <a href="{{url('/admin/usuarios')}}" type="submit" class="btn btn-secondary" style="background-color: secondary; color:white;"><i class="fas fa-undo"></i> volver</a>
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