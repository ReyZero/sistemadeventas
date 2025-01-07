@extends('adminlte::page')



@section('content_header')
<h1>Bienvenido CLIENTES<b style="color:#1E90FF;"></b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">

@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card card-outline card-red">
            <div class="card-header">
                <h3 class="card-title">Clientes Registrado</h3>
                <div class="card-tools">
                <a href="{{url('admin/clientes/reporte')}}" target="_blank" class="btn btn-danger" style="background-color: #007BFF; color:white;"><i class="fa fa-file-pdf"> </i> Reporte de Clientes</a>

                    <a href="{{url('admin/clientes/create')}}" class="btn btn-danger" style="background-color: red; color:white;"><i class="fa fa-plus"></i> Crear nuevo</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover table-sm" id="mitabla">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nro</th>
                            <th scope="col">nombre cliente</th>
                            <th scope="col">NIT /codigo Cliente</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Correo Electronico</th>


                            <th scope="col" style="text-align:center;">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contador = 1;
                        ?>
                        @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{$contador++}}</td>
                            <td>{{$cliente->nombre_cliente}}</td>
                            <td>{{$cliente->nit_codigo}}</td>
                            <td>{{$cliente->telefono}}</td>
                            <td>{{$cliente->email}}</td>
                            <td style="text-align:center;">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{url('/admin/clientes',$cliente->id)}}" class="btn btn-success btn-sm" title="ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{url('admin/clientes/'.$cliente->id.'/edit')}}" type="button" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-pencil"></i></a>
                                    <form action="{{ url('/admin/clientes', $cliente->id) }}" method="post" id="miFormulario{{$cliente->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <!-- Usamos type="button" para evitar que el formulario se envíe inmediatamente -->
                                        <button type="button" class="btn btn-danger btn-sm" title="Eliminar" id="deleteBtn{{$cliente->id}}" style="border-radius:0px 5px 5px 0px">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    <script>
                                        // Usamos un event listener para asegurar que el código se ejecute después de que el DOM se haya cargado
                                        document.addEventListener('DOMContentLoaded', function() {
                                            // Añadir un event listener a cada botón de eliminación
                                            const deleteButton = document.getElementById('deleteBtn{{$cliente->id}}');

                                            deleteButton.addEventListener('click', function(event) {
                                                event.preventDefault(); // Prevenir que el formulario se envíe inmediatamente

                                                Swal.fire({
                                                    title: '¿Desea ELIMINAR este registro?',
                                                    text: '',
                                                    icon: 'question',
                                                    showDenyButton: true,
                                                    confirmButtonText: 'Eliminar',
                                                    confirmButtonColor: '#a5161d',
                                                    denyButtonColor: '#270a0a',
                                                    denyButtonText: 'Cancelar',
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        // Si el usuario confirma, enviar el formulario manualmente
                                                        var form = document.getElementById('miFormulario{{$cliente->id}}');
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
    $('#mitabla').DataTable({
        "pageLength": 5,
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