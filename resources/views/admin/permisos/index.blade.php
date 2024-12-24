@extends('adminlte::page')

@section('content_header')
<h1>Bienvenido PERMISOS<b style="color:#1E90FF;"></b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-outline card-purple"> <!-- Cambié el color de la tarjeta a un tono púrpura -->
            <div class="card-header" style="background-color: #6A5ACD; color: white;"> <!-- Fondo púrpura y texto blanco -->
                <h3 class="card-title">Permisos Registrados</h3>
                <div class="card-tools">
                    <!--<a href="{{url('admin/permisos/reporte')}}" target="_blank" class="btn btn-info" style="background-color: #5BC0DE; color:white;">
                        <i class="fa fa-file-pdf"></i> Reporte de Permisos -->
                    </a>
                    <a href="{{url('admin/permisos/create')}}" class="btn btn-success" style="background-color: #28A745; color:white;">
                        <i class="fa fa-plus"></i> Crear PERMISOS
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="mitabla" class="table table-striped table-bordered table-hover table-sm">
                    <thead class="thead-dark"> <!-- Fondo oscuro para destacar los encabezados -->
                        <tr>
                            <th scope="col">Nro</th>
                            <th scope="col">Nombre del Permiso</th>
                            <th scope="col" style="text-align:center;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador = 1; ?>
                        @foreach ($permisos as $permiso)
                        <tr>
                            <td>{{$contador++}}</td>
                            <td>{{$permiso->name}}</td>
                            <td style="text-align:center;">
                                <div class="btn-group" role="group">
                                    <a href="{{url('/admin/permisos',$permiso->id)}}" class="btn btn-primary btn-sm" title="Ver"> <i class="fas fa-eye"></i> </a>
                                    <a href="{{url('admin/permisos/'.$permiso->id.'/edit')}}" class="btn btn-warning btn-sm" title="Editar"> <i class="fas fa-pencil"></i> </a>

                                    <form action="{{ url('/admin/permisos', $permiso->id) }}" method="post" id="formPermiso{{$permiso->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" title="Eliminar" id="deletePermiso{{$permiso->id}}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const deleteBtn = document.getElementById('deletePermiso{{$permiso->id}}');
                                            deleteBtn.addEventListener('click', function(event) {
                                                event.preventDefault();
                                                Swal.fire({
                                                    title: '¿Desea ELIMINAR este permiso?',
                                                    icon: 'warning',
                                                    showDenyButton: true,
                                                    confirmButtonText: 'Eliminar',
                                                    confirmButtonColor: '#a5161d',
                                                    denyButtonText: 'Cancelar',
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        document.getElementById('formPermiso{{$permiso->id}}').submit();
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

@section('css')
<style>
    .thead-dark th {
        background-color: #343A40;
        color: white;
    }
</style>
@stop

@section('js')
<script>
    $('#mitabla').DataTable({
        "pageLength": 10,
        "language": {
            "emptyTable": "No hay Información para visualizar",
            "info": "Mostrando de _START_ a _END_ Entradas, de un total de _TOTAL_ entradas disponibles",
            "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ Entradas totales)",
            "infoPostFix": "",
            "thousands": "",
            "lengthMenu": "Mostrar  _MENU_  Entradas",
            "loadingRecords": "Cargando . . ",
            "processing": "Procesando. . . ",
            "search": "Buscar: ",
            "zeroRecords": "Sin resultados en la busqueda",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });
</script>


@if((($mensaje = Session::get('mensaje')) && (($icono = Session::get('icono'))))) <
    script>
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