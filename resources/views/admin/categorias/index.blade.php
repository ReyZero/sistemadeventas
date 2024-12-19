@extends('adminlte::page')



@section('content_header')
<h1>Bienvenido a Categorias<b style="color:#8A2BE2;"> <!-- Cambié el color aquí --> </b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-outline card-purple"> <!-- Cambié el card a púrpura -->
            <div class="card-header">
                <h3 class="card-title">Categorias Registradas</h3>
                <div class="card-tools">
                    <a href="{{url('admin/categorias/reporte')}}" target="_blank" class="btn btn-danger" style="background-color: #007BFF; color:white;"><i class="fa fa-file-pdf"> </i> Reporte de Categorias</a>
                    <a href="{{url('admin/categorias/create')}}" class="btn btn-8A2BE2" style="background-color: #8A2BE2 ; color:white;"><i class="fa fa-plus"></i> Crear nuevo</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nro</th>
                            <th scope="col">Nombre de la Categoria</th>
                            <th scope="col">Descripción</th>
                            <th scope="col" style="text-align:center;">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contador = 1;
                        ?>
                        @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{$contador++}}</td>
                            <td>{{$categoria->nombre}}</td>
                            <td>{{$categoria->descripcion}}</td>

                            <td style="text-align:center;">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{url('/admin/categorias',$categoria->id)}}" class="btn btn-success btn-sm" title="ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{url('admin/categorias/'.$categoria->id.'/edit')}}" type="button" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-pencil"></i></a>
                                    <form action="{{ url('/admin/categorias', $categoria->id) }}" method="post" id="miFormulario{{$categoria->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" title="Eliminar" id="deleteBtn{{$categoria->id}}" style="border-radius:0px 5px 5px 0px">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const deleteButton = document.getElementById('deleteBtn{{$categoria->id}}');
                                            deleteButton.addEventListener('click', function(event) {
                                                event.preventDefault();

                                                Swal.fire({
                                                    title: '¿Desea ELIMINAR este registro? Si eliminas este CATEGORIA, los productos se ELIMINARAN',
                                                    icon: 'question',
                                                    showDenyButton: true,
                                                    confirmButtonText: 'Eliminar',
                                                    denyButtonText: 'Cancelar',
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        var form = document.getElementById('miFormulario{{$categoria->id}}');
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