@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Detalla de la Compra<b style="color:#1E90FF;"></b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">

@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Datos Registrados</h3>
            </div>
            <div class="card-body">

                @csrf

                <div class="row">
                    <div class="col-md-8">

                        <div class="row">
                            <table class="table table-sm table-striped table-bordered table-hover">
                                <thead>
                                    <tr style="background-color: #28a745; color: #ffffff;">
                                        <th>Nro</th>
                                        <th>Código</th>
                                        <th>Cantidad</th>
                                        <th>Nombre</th>
                                        <th>Costo Unitario</th>
                                        <th>Total</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $cont = 1;
                                    $total_cantidad = 0;
                                    $total_compra = 0; ?>
                                    @foreach ($compra->detalles as $detalle )

                                    <tr>
                                        <td style="text-align: center;">{{$cont++}}</td>
                                        <td style="text-align: center;">{{$detalle->producto->codigo}}</td>
                                        <td style="text-align: center;">{{$detalle->cantidad}}</td>
                                        <td style="text-align: center;">{{$detalle->producto->nombre}}</td>
                                        <td style="text-align: center;">
                                            $ {{ number_format($detalle->precio_compra, 0, ',', '.') }}
                                        </td>
                                        <td style="text-align: center;">
                                            $ {{ number_format($costo = $detalle->cantidad * $detalle->producto->precio_compra, 0, ',', '.') }}
                                        </td>

                                    </tr>
                                    @php
                                    $total_cantidad += $detalle->cantidad;
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
                                <label>Nombre proveedor</label>
                                <input type="text" class="form-control" value="{{ $compra->detalles->first()->proveedor->empresa }}" disabled id="id_proveedor" name="proveedor_id">
                            </div>



                        </div>
                        <hr style="background-color: #C0C0C0; height: 1px; border: none;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha">Fecha Compra</label><b style="color: crimson;"> </b>
                                    <input type="date" class="form-control" name="fecha" required value="{{$compra->fecha}}" disabled>
                                    @error('fecha')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="comprobante">Comprobante</label><b style="color: crimson;"> </b>
                                    <input type="text" class="form-control" name="comprobante" required value="{{$compra->comprobante}}">
                                    @error('comprobante')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="text-align: center;">
                                    <label for="precio_total">Precio Total</label><b style="color: crimson;"> </b>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$ </span>
                                        </div>
                                        <input type="text" style="text-align: center; background-color: #3c8dbc; border: 1px solid #8da5b8;" value="{{number_format($total_compra,0,',','.')}}" class="form-control" name="precio_total" disabled required value="">
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

                        <a href="{{url('/admin/compras')}}" type="submit" class="btn btn-secondary" style="background-color: secondary; color:white;"><i class="fas fa-undo"></i> volver</a>
                    </div>
                </div>
            </div>

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