@extends('adminlte::page')



@section('content_header')
<h1>Bienvenido a Productos<b style="color:#A7C7E7;"> <!-- Cambié el color aquí --> </b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-outline card-primary"> <!-- Cambié el card a púrpura -->
            <div class="card-header">
                <h3 class="card-title">Productos Registradas</h3>
                <div class="card-tools">
                    <a href="{{url('admin/productos/create')}}" class="btn btn-8A2BE2" style="background-color: #4A90E2 ; color:white;"><i class="fa fa-plus"></i> Crear nuevo</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nro</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Código producto</th>
                            <th scope="col">Nombre producto</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Precio compra</th>
                            <th scope="col">Precio Venta</th>
                            <th scope="col">Imagen del producto</th>

                            <th scope="col" style="text-align:center;">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contador = 1;
                        ?>
                        @foreach ($productos as $producto)
                        <tr>
                            <td style="text-align:center; vertical-align:middle;">{{$contador++}}</td>
                            <td  style="text-align:center; vertical-align:middle;">{{$producto->categoria->nombre}}</td>
                            <td style="text-align:center; vertical-align:middle;">{{$producto->codigo}}</td>
                            <td style="text-align:center; vertical-align:middle;">{{$producto->nombre}}</td>
                            <td style="text-align:center; vertical-align:middle;">{{$producto->descripcion}}</td>
                            <td style="text-align:center;  vertical-align:middle; background-color:rgba(233, 231, 16, 0.15)">{{$producto->stock}}</td>
                            <td style="text-align:center; vertical-align:middle;">$ {{ number_format($producto->precio_compra, 0, ',', '.') }}</td>

                            <td style="text-align:center; vertical-align:middle;">$ {{number_format($producto->precio_venta, 0, ',', '.') }}</td>

                            <td style="text-align:center; vertical-align:middle;">
                                <img src="{{asset('storage/'.$producto->imagen)}}" alt="Imagen No Disponible" width="80px" style="border: 5px solid #00BC8C; box-shadow: 5px 0px 5px 0px #00BC8C;">
                            </td>

                            <td style="text-align:center; vertical-align:middle;">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{url('/admin/productos',$producto->id)}}" class="btn btn-success btn-sm" title="ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{url('admin/productos/'.$producto->id.'/edit')}}" type="button" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-pencil"></i></a>
                                    <form action="{{ url('/admin/productos', $producto->id) }}" method="post" id="miFormulario{{$producto->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" title="Eliminar" id="deleteBtn{{$producto->id}}" style="border-radius:0px 5px 5px 0px">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const deleteButton = document.getElementById('deleteBtn{{$producto->id}}');
                                            deleteButton.addEventListener('click', function(event) {
                                                event.preventDefault();

                                                Swal.fire({
                                                    title: '¿Desea ELIMINAR este registro?',
                                                    icon: 'question',
                                                    showDenyButton: true,
                                                    confirmButtonText: 'Eliminar',
                                                    denyButtonText: 'Cancelar',
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        var form = document.getElementById('miFormulario{{$producto->id}}');
                                                        form.submit();
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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