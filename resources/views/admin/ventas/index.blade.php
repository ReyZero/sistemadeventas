@extends('adminlte::page')



@section('content_header')
<h1>Bienvenido a Ventas<b style="color:A7C7E7;"> <!-- Cambié el color aquí --> </b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card card-outline card-warning" style="background-color:#F39C12;  height: 1px; border: none;"> <!-- Cambié el card a púrpura -->
            <div class="card-header">
                <h3 class="card-title">Ventas Registradas</h3>
                <div class="card-tools">
                    <a href="{{url('admin/ventas/reporte')}}" target="_blank" class="btn btn-danger" style="background-color: #007BFF; color:white;"><i class="fa fa-file-pdf"> </i> Reporte de Ventas</a>

                    @if($arqueoAbierto)

                    <a href="{{url('admin/ventas/create')}}" class="btn btn-warning" style="background-color: warning ; color:white;"><i class="fa fa-plus"></i> Crear nuevo</a>
                    @else
                    <a href="{{url('admin/arqueos/create')}}" class="btn btn-danger" style="background-color: warning ; color:white;"><i class="fa fa-cash-register"></i> Abrir Caja</a>

                    @endif

                </div>
            </div>
            <div class="card-body">
                <table id="mitabla" class="table table-striped table-bordered table-hover table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nro</th>
                            <th scope="col">Fecha de ventas</th>

                            <th scope="col">Precio total de la venta</th>
                            <th scope="col">Productos</th>
                            <th scope="col" style="text-align:center;">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contador = 1;
                        ?>
                        @foreach ($ventas as $venta)
                        <tr>
                            <td style="text-align:center; vertical-align:middle;">{{$contador++}}</td>
                            <td style="text-align:center; vertical-align:middle;">
                                {{ \Carbon\Carbon::parse($venta->fecha)->format('d-m-Y') }}
                            </td>

                            <td style="text-align:center; vertical-align:middle;">
                                $ {{ number_format(($venta->precio_total), 0, ',', '.') }}
                            </td>
                            <td>
                                <ul>
                                    @foreach ($venta->detalleVenta as $detalle )
                                    <li>{{$detalle->producto->nombre.' - '.$detalle->cantidad.' Unidades'}}</li>
                                    @endforeach
                                </ul>
                            </td>


                            <td style="text-align:center; vertical-align:middle;">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{url('/admin/ventas/pdf',$venta->id)}}" target="_blank" class="btn btn-primary btn-sm" title="Comprobante venta"><i class="fas fa-print"></i></a>
                                    <a href="{{url('/admin/ventas',$venta->id)}}" class="btn btn-success btn-sm" title="ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{url('admin/ventas/'.$venta->id.'/edit')}}" type="button" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-pencil"></i></a>
                                    <form action="{{ url('/admin/ventas', $venta->id) }}" method="post" id="miFormulario{{$venta->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" title="Eliminar" id="deleteBtn{{$venta->id}}" style="border-radius:0px 5px 5px 0px">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const deleteButton = document.getElementById('deleteBtn{{$venta->id}}');
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
                                                        var form = document.getElementById('miFormulario{{$venta->id}}');
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