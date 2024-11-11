@extends('adminlte::page')



@section('content_header')
<h1>Bienvenido a Proveedores<b style="color:A7C7E7;"> <!-- Cambié el color aquí --> </b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card card-outline card-primary" style="background-color:#008000;  height: 1px; border: none;"> <!-- Cambié el card a púrpura -->
            <div class="card-header">
                <h3 class="card-title">Proveedores Registradas</h3>
                <div class="card-tools">
                    <a href="{{url('admin/proveedores/create')}}" class="btn btn-008000" style="background-color: #008000 ; color:white;"><i class="fa fa-plus"></i> Crear nuevo</a>
                </div>
            </div>
            <div class="card-body">
                <table id="mitabla" class="table table-striped table-bordered table-hover table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nro</th>
                            <th scope="col">Empresa</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Correo Eletronico</th>
                            <th scope="col">Nombre Proveedor</th>
                            <th scope="col">Celular Contacto</th>


                            <th scope="col" style="text-align:center;">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contador = 1;
                        ?>
                        @foreach ($proveedores as $proveedore)
                        <tr>
                            <td style="text-align:center; vertical-align:middle;">{{$contador++}}</td>
                            <td style="text-align:center; vertical-align:middle;">{{$proveedore->empresa}}</td>
                            <td style="text-align:center; vertical-align:middle;">{{$proveedore->direccion}}</td>
                            <td style="text-align:center; vertical-align:middle;">{{$proveedore->telefono}}</td>
                            <td style="text-align:center; vertical-align:middle;">{{$proveedore->email}}</td>
                            <td style="text-align:center; vertical-align:middle;">{{$proveedore->nombre}}</td>
                            
                            <td style="text-align:center; vertical-align:middle;">
                                <!-- Enlace a WhatsApp con icono -->
                                <a href="https://wa.me/{{$empresa->codigo_postal."".$proveedore->celular}}" target="_blank" class="btn btn-success"><i class="fab fa-whatsapp" ></i>
                                {{$empresa->codigo_postal."".$proveedore->celular}}
                                </a>
                                 
                            </td>




                            <td style="text-align:center; vertical-align:middle;">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{url('/admin/proveedores',$proveedore->id)}}" class="btn btn-success btn-sm" title="ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{url('admin/proveedores/'.$proveedore->id.'/edit')}}" type="button" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-pencil"></i></a>
                                    <form action="{{ url('/admin/proveedores', $proveedore->id) }}" method="post" id="miFormulario{{$proveedore->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" title="Eliminar" id="deleteBtn{{$proveedore->id}}" style="border-radius:0px 5px 5px 0px">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const deleteButton = document.getElementById('deleteBtn{{$proveedore->id}}');
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
                                                        var form = document.getElementById('miFormulario{{$proveedore->id}}');
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