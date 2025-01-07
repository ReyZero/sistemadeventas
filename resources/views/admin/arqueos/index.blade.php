@extends('adminlte::page')



@section('content_header')
<h1>Bienvenido a Arqueos de Caja<b style="color:#1E90FF;"></b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">

@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title">Arqueos Registrados</h3>
                <div class="card-tools">
                    @if($arqueoAbierto)
                    <a href="{{url('admin/arqueos/reporte')}}" target="_blank" class="btn btn-danger" style="background-color: #007BFF; color:white;"><i class="fa fa-file-pdf"> </i> Reporte de Arqueo de Cajas</a>

                    <div style="background-color: #28a745; color: white; padding: 10px; border-radius: 5px; text-align: center; font-weight: bold;">
                        <i class="fas fa-cash-register"></i> Caja Abierta
                    </div>
                    @else
                    <a href="{{url('admin/arqueos/reporte')}}" target="_blank" class="btn btn-danger" style="background-color: #007BFF; color:white;"><i class="fa fa-file-pdf"> </i> Reporte de Arqueo de Cajas</a>

                    <a href="{{url('admin/arqueos/create')}}" class="btn btn-danger" style="background-color: warning ; color:white;"><i class="fa fa-cash-register"></i> Abrir Caja</a>

                    @endif


                </div>
            </div>
            <div class="card-body">
                <table id="tablausuario" class="table table-striped table-bordered table-hover table-sm">
                    <thead class="thead-light">
                        <tr style="text-align: center;">
                            <th scope="col">Nro</th>
                            <th scope="col">Fecha Apertura</th>
                            <th scope="col">Monto Inicial</th>
                            <th scope="col">Fecha Cierre</th>
                            <th scope="col">Monto Final</th>
                            <th scope="col">Observaciones</th>
                            <th scope="col">Movimientos de Caja</th>

                            <th scope="col" style="text-align:center;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contador = 1;
                        ?>
                        @foreach ($arqueos as $arqueo )
                        <tr style="text-align: center;">
                            <td style="text-align: center;">{{$contador++}}</td>
                            <td>{{ \Carbon\Carbon::parse($arqueo->fecha_apertura)->format('d/m/Y,  H:i:s') }}</td>
                            <td>${{number_format($arqueo->monto_inicial,0,',','.')}}</td>
                            <td>{{$arqueo->fecha_cierre}}</td>
                            <td>${{number_format($arqueo->monto_final,0 ,',','.')}}</td>
                            <td>{{$arqueo->observaciones}}</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <b>Ingresos</b>
                                        $ {{number_format($arqueo->total_ingresos,0,',','.')}}
                                    </div>
                                    <div class="col-md-6">
                                        <b>Egresos</b>
                                        $ {{number_format($arqueo->total_egresos,0,',','.')}}
                                    </div>
                                </div>
                            </td>

                            <td style="text-align:center;">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{url('/admin/arqueos',$arqueo->id)}}" class="btn btn-success btn-sm" title="ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{url('admin/arqueos/'.$arqueo->id.'/edit')}}" type="button" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-pencil"></i></a>
                                    <a href="{{url('admin/arqueos/'.$arqueo->id.'/ingreso-egreso')}}" type="button" class="btn btn-primary btn-sm" title="Ingreso / Egreso"><i class="fas fa-balance-scale"></i></a>
                                    <a href="{{url('admin/arqueos/'.$arqueo->id.'/cierre')}}" type="button" class="btn btn-dark btn-sm" title="Cierre de caja"><i class="fas fa-lock"></i>
                                    </a>

                                    <form action="{{ url('/admin/arqueos', $arqueo->id) }}" method="post" id="miFormulario{{$arqueo->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <!-- Usamos type="button" para evitar que el formulario se envíe inmediatamente -->
                                        <button type="button" class="btn btn-danger btn-sm" title="Eliminar" id="deleteBtn{{$arqueo->id}}" style="border-radius:0px 5px 5px 0px">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    <script>
                                        // Usamos un event listener para asegurar que el código se ejecute después de que el DOM se haya cargado
                                        document.addEventListener('DOMContentLoaded', function() {
                                            // Añadir un event listener a cada botón de eliminación
                                            const deleteButton = document.getElementById('deleteBtn{{$arqueo->id}}');

                                            deleteButton.addEventListener('click', function(event) {
                                                event.preventDefault(); // Prevenir que el formulario se envíe inmediatamente

                                                Swal.fire({
                                                    title: '¿Desea ELIMINAR esta CAJA?',
                                                    text: 'LA ELIMINACIÓN DE ESTA CAJA TAMBIÉN ELIMINARÁ DE FORMA PERMANENTE TODOS LOS MOVIMIENTOS ASOCIADOS A ELLA. ¡POR FAVOR, PROCEDA CON PRECAUCIÓN!!!',
                                                    icon: 'question',
                                                    showDenyButton: true,
                                                    confirmButtonText: 'Eliminar',
                                                    confirmButtonColor: '#a5161d',
                                                    denyButtonColor: '#270a0a',
                                                    denyButtonText: 'Cancelar',
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        // Si el usuario confirma, enviar el formulario manualmente
                                                        var form = document.getElementById('miFormulario{{$arqueo->id}}');
                                                        form.submit(); // Enviar el formulario
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
<script>
    $('#tablausuario').DataTable({
        "pageLength": 2,
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