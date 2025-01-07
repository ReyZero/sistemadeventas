@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Registrar nueva Compra<b style="color:#1E90FF;"></b></h1>
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
                <form action="{{url('/admin/compras/create')}}" id="form_compra" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad</label><b style="color: crimson;"> *</b>
                                        <input type="number" class="form-control" id="cantidad" name="cantidad" required value="1" style="text-align: center; background-color: rgba(233, 231, 16, 0.15);">
                                        @error('cantidad')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="codigo">Código</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                        </div>
                                        <input id="codigo" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div style="height: 32px;"></div>
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-search"></i></button>
                                        <!-- #boton de buscar -->

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Listado de productos</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!--TABLA DE PRODUCTOS-->

                                                        <table id="mitabla" class="table table-striped table-bordered table-hover table-sm table-responsive">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th scope="col">Nro</th>
                                                                    <th scope="col" style="text-align: center;">Agregar a compra</th>
                                                                    <th scope="col">Categoría</th>
                                                                    <th scope="col">Código producto</th>
                                                                    <th scope="col">Nombre producto</th>
                                                                    <th scope="col">Descripción</th>
                                                                    <th scope="col">Stock</th>
                                                                    <th scope="col">Precio compra</th>
                                                                    <th scope="col">Precio Venta</th>
                                                                    <th scope="col">Imagen del producto</th>



                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $contador = 1;
                                                                ?>
                                                                @foreach ($productos as $producto)
                                                                <tr>
                                                                    <td style="text-align:center; vertical-align:middle;">{{$contador++}}</td>
                                                                    <td style="text-align:center; vertical-align:middle;">
                                                                        <button type="button" class=" btn btn-info seleccionar-btn" data-id="{{$producto->codigo}}"><i class="fas fa-shopping-cart"> </i>Seleccionar</button>
                                                                    </td>
                                                                    <td style="text-align:center; vertical-align:middle;">{{$producto->categoria->nombre}}</td>
                                                                    <td style="text-align:center; vertical-align:middle;">{{$producto->codigo}}</td>
                                                                    <td style="text-align:center; vertical-align:middle;">{{$producto->nombre}}</td>
                                                                    <td style="text-align:center; vertical-align:middle;">{{$producto->descripcion}}</td>
                                                                    <td style="text-align:center;  vertical-align:middle; background-color:rgba(233, 231, 16, 0.15)">{{$producto->stock}}</td>
                                                                    <td style="text-align:center; vertical-align:middle;">$ {{ number_format($producto->precio_compra, 0, ',', '.') }}</td>

                                                                    <td style="text-align:center; vertical-align:middle;">$ {{number_format($producto->precio_venta, 0, ',', '.') }}</td>

                                                                    <td style="text-align:center; vertical-align:middle;">
                                                                        <img src="{{asset('storage/'.$producto->imagen)}}" alt="Imagen No Disponible" width="80px" style="border: 5px solid #00BC8C; box-shadow: 5px 0px 5px 0px #00BC8C;">
                                                                    </td>
                                                                    <!---
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
-->
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="{{url('/admin/productos/create')}}" class="btn btn-success" type="button"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <table class="table table-sm table-striped table-bordered table-hover">
                                    <thead>
                                        <tr style="background-color: #28a745; color: #ffffff;">
                                            <th>Nro</th>
                                            <th>Código</th>
                                            <th>Cantidad</th>
                                            <th>Nombre</th>
                                            <th>Costo</th>
                                            <th>Total</th>
                                            <th style="text-align: center;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $cont = 1;
                                        $total_cantidad = 0;
                                        $total_compra = 0; ?>
                                        @foreach ($tmp_compras as $tmp_compra )

                                        <tr>
                                            <td style="text-align: center;">{{$cont++}}</td>
                                            <td style="text-align: center;">{{$tmp_compra->producto->codigo}}</td>
                                            <td style="text-align: center;">{{$tmp_compra->cantidad}}</td>
                                            <td style="text-align: center;">{{$tmp_compra->producto->nombre}}</td>
                                            <td style="text-align: center;">
                                                $ {{ number_format($tmp_compra->producto->precio_compra, 0, ',', '.') }}
                                            </td>
                                            <td style="text-align: center;">
                                                $ {{ number_format($costo = $tmp_compra->cantidad * $tmp_compra->producto->precio_compra, 0, ',', '.') }}
                                            </td>
                                            <td style="text-align: center;">
                                                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{$tmp_compra->id}}" title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @php
                                        $total_cantidad += $tmp_compra->cantidad;
                                        $total_compra+=$costo ;
                                        @endphp

                                        @endforeach
                                    </tbody>
                                    <tfooter>
                                        <tr style="background-color: #e8f5e9; color: #333333;">
                                            <td colspan="2" style="text-align: right;"><b>Total Cantidad Productos: </b></td>
                                            <td style="text-align: center;">
                                                <b>{{$total_cantidad}}</b>
                                            </td>
                                            <td colspan="2" style="text-align: right;"><b>Total de la Compra: </b></td>
                                            <td style="text-align: center;">
                                                <b>$ {{number_format($total_compra,0,',','.')}}</b>
                                            </td>
                                        </tr>
                                    </tfooter>

                                </table>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-info " data-toggle="modal" data-target="#exampleModal_proveedor"><i class="fas fa-search"></i> Buscar Proveedores</button>
                                    <div class="form-group">
                                        <div style="height: 32px;"></div>

                                        <!-- #boton de buscar -->

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal_proveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Listado de Proveedores</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!--TABLA DE PRODUCTOS-->

                                                        <table id="mitabla2" class="table table-striped table-bordered table-hover table-sm table-responsive">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th scope="col">Nro</th>
                                                                    <th scope="col" style="text-align: center;">Acción</th>
                                                                    <th scope="col">Empresa</th>
                                                                    <th scope="col">Teléfono</th>
                                                                    <th scope="col">Nombre Contacto</th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $contador = 1;
                                                                ?>
                                                                @foreach ($proveedores as $proevedore)
                                                                <tr>
                                                                    <td style="text-align:center; vertical-align:middle;">{{$contador++}}</td>
                                                                    <td style="text-align:center; vertical-align:middle;">
                                                                        <button type="button" class=" btn btn-info seleccionar-btn-proveedor" data-id="{{$proevedore->id}}" data-empresa="{{$proevedore->empresa}}"><i class="fas fa-truck-fast"> </i> Seleccionar</button>
                                                                    </td>
                                                                    <td style="text-align:center; vertical-align:middle;">{{$proevedore->empresa}}</td>
                                                                    <td style="text-align:center; vertical-align:middle;">{{$proevedore->telefono}}</td>
                                                                    <td style="text-align:center; vertical-align:middle;">{{$proevedore->nombre}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control"  id="empresa_proveedor" name="empresa_proveedor" required>
                                    <input type="text" class="form-control" readonly id="id_proveedor" name="proveedor_id" hidden>

                                </div>
                            </div>
                            <hr style="background-color: #C0C0C0; height: 1px; border: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha">Fecha Compra</label><b style="color: crimson;"> *</b>
                                        <input type="date" class="form-control" name="fecha" required value="{{ old('fecha', now()->toDateString())}}">
                                        @error('fecha')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="comprobante">Comprobante</label><b style="color: crimson;"> *</b>
                                        <input type="text" class="form-control" name="comprobante" required value="{{old('comprobante')}}">
                                        @error('comprobante')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="text-align: center;">
                                        <label for="precio_total">Precio Total</label><b style="color: crimson;"> *</b>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$ </span>
                                            </div>
                                            <input type="text" style="text-align: center; background-color: #3c8dbc; border: 1px solid #8da5b8;"
                                                class="form-control" name="precio_total" required
                                                value="{{number_format($total_compra,0,',','.')}}">

                                            @error('precio_total')
                                            <small style="color:red;">{{$message}}</small>
                                            @enderror
                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

            </div>

            <hr style="background-color: #00BC8C;">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" style="background-color: success; color:white;"><i class="fas fa-shopping-cart"></i> Registrar Compra</button>
                        <a href="{{url('/admin/compras')}}" type="submit" class="btn btn-secondary" style="background-color: secondary; color:white;"><i class="fas fa-undo"></i> volver</a>
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
<script>
    /*SELECCIONAR PROVEEDOR*/
    $('.seleccionar-btn-proveedor').click(function() {
        var id_proveedor = $(this).data('id');
        var empresa = $(this).data('empresa');
        //alert(id_proveedor);
        //alert(empresa);


        $('#empresa_proveedor').val(empresa);
        $('#id_proveedor').val(id_proveedor);
        $('#exampleModal_proveedor').modal('hide');

    });

    /*SELECCIONAR PRODUCTO*/
    $('.seleccionar-btn').click(function() {
        var id_producto = $(this).data('id')
        //alert(id_producto);
        $('#codigo').val(id_producto);
        $('#exampleModal').modal('hide');
        $('#exampleModal').on('hidden.bs.modal', function() {
            $('#codigo').focus();
        });
    });


    /*Eliminar productos*/
    $('.delete-btn').click(function() {
        var id = $(this).data('id');
        if (id) {
            $.ajax({
                url: "{{url('/admin/compras/create/tmp')}}/" + id,
                type: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    _method: 'DELETE',
                },
                success: function(response) {
                    // Verificar si el if está en minúsculas
                    if (response.success) {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "No se eliminó el producto",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                    } else {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "¡Producto eliminado!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                    }
                },
                error: function(error) {
                    alert("Error en la solicitud");
                }
            });
        }
    });




    $('#codigo').focus();
    $('#form_compra').on('keypress', function(e) {
        if (e.keyCode === 13) {
            e.preventDefault();
        }
    });

    $('#codigo').on('keyup', function(e) {
        if (e.which === 13) {
            var codigo = $(this).val();
            var cantidad = $('#cantidad').val();
            //alert(codigo);
            if (codigo.length > 0) {
                $.ajax({
                    url: "{{route('admin.compras.tmp_compras')}}",
                    method: 'POST',
                    data: {
                        _token: '{{csrf_token()}}',
                        codigo: codigo,
                        cantidad: cantidad
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Se registró el producto",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            location.reload();
                        } else {
                            alert('No se encotro al producto');
                        }
                    },
                    error: function(error) {
                        alert(error);
                    }
                });
            }
        }
    });
</script>
<script>
    //Mi tabla 1
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

    //Mi tabla 2
    $('#mitabla2').DataTable({
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
@stop