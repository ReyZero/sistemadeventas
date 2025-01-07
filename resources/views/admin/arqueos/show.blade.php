@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Datos Registrados |ARQUEO DE CAJA<b style="color:#1E90FF;"></b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">

@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title">Datos Registrados</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="fecha_apertura">Fecha de Apertura</label><b style="color: crimson;"> </b>
                            <P>{{$arqueo->fecha_apertura}}</P>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="monto_inicial">Monto Inicial</label><b style="color: crimson;"> </b>
                            <p>$ {{number_format($arqueo->monto_inicial,0,',','.')}}</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="fecha_cierre">Fecha de Cierre</label><b style="color: crimson;"> </b>
                            <P>{{$arqueo->fecha_cierre}}</P>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="monto_final">Monto Final</label><b style="color: crimson;"> </b>
                            <p>${{number_format($arqueo->monto_final,0,',','.')}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observaciones">observaciones</label><b style="color: crimson;"> </b>
                                <p>{{$arqueo->observaciones}}</p>
                            </div>
                        </div>

                    </div>
                </div>

                <hr style="background-color: #E74C3C;">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="form-group">
                            <a href="{{url('/admin/arqueos')}}" type="submit" class="btn btn-secondary" style="background-color: secondary; color:white;"><i class="fas fa-undo"></i> volver</a>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- INGRESOS -->
    <div class="col-md-4">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">INGRESOS</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm table-striped table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Nro</th>
                            <th>Detalle</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contador = 1;
                        $suma_monto = 0;
                        ?>
                        @foreach ($movimientos as $movimiento )
                        @if ($movimiento->tipo=='INGRESO')
                        @php
                        $suma_monto +=$movimiento->monto;
                        @endphp
                        <tr style="text-align: center;">
                            <td>{{$contador++}}</td>
                            <td>{{$movimiento->descripcion}}</td>
                            <td>$ {{number_format($movimiento->monto,0,',','.')}}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    <tfoother>
                        <tr>
                            <td colspan="2" style="text-align: ;"><b>Total:</b></td>
                            <td style="text-align: center;"><b>$ {{number_format( $suma_monto,0,',','.')}}</b></td>
                        </tr>
                    </tfoother>
                </table>

                <hr style="background-color: #00BC8C;">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="form-group">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- EGRESOS -->
    <div class="col-md-4">
        <div class="card card-outline card-warning">
            <div class="card-header">
                <h3 class="card-title">EGRESOS</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm table-striped table-hover">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Nro</th>
                            <th>Detalle</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contador = 1;
                        $suma_monto = 0;
                        ?>
                        @foreach ($movimientos as $movimiento )
                        @if ($movimiento->tipo=='EGRESO')
                        @php
                        $suma_monto +=$movimiento->monto;
                        @endphp
                        <tr style="text-align: center;">
                            <td>{{$contador++}}</td>
                            <td>{{$movimiento->descripcion}}</td>
                            <td>$ {{number_format($movimiento->monto,0,',','.')}}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    <tfoother>
                        <tr>
                            <td colspan="2" ><b>Total:</b></td>
                            <td style="text-align: center;"><b>$ {{number_format( $suma_monto,0,',','.')}}</b></td>
                            
                        </tr>
                    </tfoother>
                </table>

                <hr style="background-color: #F39C12;">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="form-group">


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

@stop