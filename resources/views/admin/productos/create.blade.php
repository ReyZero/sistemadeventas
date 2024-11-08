@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Registro de un nuevo Producto<b style="color:#1E90FF;"></b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">

@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Ingrese los datos</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/admin/productos/create')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="role">Categorías</label><b style="color: crimson;"> *</b>
                                        <select name="categoria_id" id="" class="form-control">
                                            <option value="" disabled selected>Seleccione una Categoría</option>
                                            @foreach ($categorias as $categoria)
                                            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="codigo">Código Producto</label><b style="color: crimson;"> *</b>
                                        <input type="text" class="form-control" name="codigo" required value="{{old('codigo')}}">
                                        @error('codigo')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombre del Producto</label><b style="color: crimson;"> *</b>
                                        <input type="text" class="form-control" name="nombre" required value="{{old('nombre')}}">
                                        @error('nombre')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label><b style="color: crimson;"> </b>
                                        <textarea name="descripcion" class="form-control" cols="30" row="3" id="" placeholder="Indique descripción"></textarea>
                                        @error('descripcion')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="row"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="stock">Stock</label><b style="color: crimson;"> *</b>
                                        <input type="number" class="form-control" name="stock" required value="0">
                                        @error('stock')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="stock_minimo">Stock Mínimo</label><b style="color: crimson;"> *</b>
                                        <input type="number" class="form-control" name="stock_minimo" required value="0">
                                        @error('stock_minimo')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="stock_maximo">Stock Máximo</label><b style="color: crimson;"> *</b>
                                        <input type="number" class="form-control" name="stock_maximo" required value="0">
                                        @error('stock_maximo')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="precio_compra">Precio de Compra</label><b style="color: crimson;"> *</b>
                                        <input type="text" class="form-control" name="precio_compra" required value="{{old('precio_compra')}}">
                                        @error('precio_compra')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="precio_venta">Precio de Venta</label><b style="color: crimson;"> *</b>
                                        <input type="text" class="form-control" name="precio_venta" required value="{{old('precio_venta')}}">
                                        @error('precio_venta')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="fecha_ingreso">Fecha de Ingreso</label><b style="color: crimson;"> *</b>
                                        <input type="date" class="form-control" name="fecha_ingreso" required value="{{ old('fecha_ingreso', now()->toDateString()) }}">
                                        @error('fecha_ingreso')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!--IMAGEN-->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="logo">Logotipo Producto</label><b style="color: crimson;"> </b>
                                <input type="file" id="file" name="imagen" class="form-control" accept=".jpg, .jpeg, .png">
                                @error('imagen')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                                <br>
                                <center><output id="list"></output></center>
                                <script>
                                    function archivo(evt) {
                                        var files = evt.target.files;
                                        //obteniendo la imagen
                                        for (var i = 0, f; f = files[i]; i++) {
                                            //solo que sean imagenes
                                            if (!f.type.match('image.*')) {
                                                continue;
                                            }
                                            var reader = new FileReader();
                                            reader.onload = (function(theFile) {
                                                return function(e) {
                                                    //instertamos la imagen
                                                    document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="70%" title="', escape(theFile.name), '"/>'].join('');
                                                };
                                            })(f);
                                            reader.readAsDataURL(f);
                                        }
                                    }
                                    document.getElementById('file').addEventListener('change', archivo, false)
                                </script>
                            </div>

                        </div>
                    </div>

                    <hr style="background-color: #00BC8C;">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" style="background-color: success; color:white;"><i class="fas fa-save"></i> Registrar Producto</button>
                                <a href="{{url('/admin/productos')}}" type="submit" class="btn btn-secondary" style="background-color: secondary; color:white;"><i class="fas fa-undo"></i> volver</a>
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