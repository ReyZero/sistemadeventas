<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #2384C6;
            font-size: 16pt;
            margin: 0;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table-bordered {
            border: 1px solid #ddd;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .table-bordered thead th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .header-logo {
            border: 3px solid #2384C6;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .highlight {
            background-color: #f0f8ff;
            font-weight: bold;
        }

        .details {
            border: 1px solid #2384C6;
            padding: 10px;
            border-radius: 8px;
            margin-top: 10px;
            background-color: #f9f9f9;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-style: italic;
            color: #555;
        }

        .divider {
            margin: 20px 0;
            border-top: 1px dashed #bbb;
        }
    </style>
    <title>Comprobante de venta</title>
</head>

<body>
    <table border="0" style="font-size: 9pt; width: 100%;">
        <tr>
            <td style="text-align: center;">
                <img src="{{public_path('storage/'.$empresa->logo)}}" alt="logo" width="100px" class="header-logo">
            </td>
            <td style="text-align: center; width: 480px;">
                <h1>COMPROBANTE DE VENTA</h1>
            </td>
            <td style="text-align: center;">
                <b>RUT:</b> {{$empresa->nit}} <br>
                <b>Nro Boleta:</b> {{$ventas->id}}<br>
                <h4 style="color: #555;">ORIGINAL</h4>
            </td>
        </tr>
    </table>

    <table border="0" style="font-size: 9pt; width: 100%; margin-top: 10px;">
        <tr>
            <td style="text-align: center;">
                {{$empresa->nombre_empresa}}<br>
                {{$empresa->tipo_empresa}}<br>
                {{$empresa->correo}}<br>
                Tel: {{$empresa->telefono}}
            </td>
        </tr>
    </table>

    <?php
    $fecha_db = $ventas->fecha;
    $fecha_formateada = date("d", strtotime($fecha_db)) . " de " .
        date("F", strtotime($fecha_db)) . " de " .
        date("Y", strtotime($fecha_db));
    $meses = [
        'January' => 'enero',
        'February' => 'febrero',
        'March' => 'marzo',
        'April' => 'abril',
        'May' => 'mayo',
        'June' => 'junio',
        'July' => 'julio',
        'August' => 'agosto',
        'September' => 'septiembre',
        'October' => 'octubre',
        'November' => 'noviembre',
        'December' => 'diciembre',
    ];
    $fecha_formateada = str_replace(array_keys($meses), array_values($meses), $fecha_formateada);
    ?>

    <div class="details">
        <table border="0" cellpadding="6" style="width: 100%;">
            <tr>
                <td><b>Fecha:</b> {{$fecha_formateada}}</td>
                <td><b>Nit/Rut:</b> {{$ventas->cliente->nit_codigo}}</td>
            </tr>
            <tr>
                <td colspan="2"><b>Sr(a):</b> {{$ventas->cliente->nombre_cliente}}</td>
            </tr>
        </table>
    </div>

    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="30px">Nro</th>
                <th width="120px">Productos</th>
                <th width="200px">Descripción</th>
                <th width="70px">Cantidad</th>
                <th width="100px">Precio Unitario</th>
                <th width="80px">Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @php
            $contador = 1;
            $subtotal = 0;
            $sumacantidad = 0;
            $sumpapreciounitario = 0;
            $sumasubtotal = 0;
            @endphp
            @foreach ($ventas->detalleVenta as $detalle)
            @php
            $sumacantidad += $detalle->cantidad;
            $sumpapreciounitario += $detalle->producto->precio_venta;
            $subtotal = $detalle->cantidad * $detalle->producto->precio_venta;
            $sumasubtotal += $subtotal;
            @endphp
            <tr>
                <td>{{$contador++}}</td>
                <td>{{$detalle->producto->nombre}}</td>
                <td>{{$detalle->producto->descripcion}}</td>
                <td>{{$detalle->cantidad}}</td>
                <td>{{$moneda->symbol . ' ' . number_format($detalle->producto->precio_venta,0,',','.')}}</td>
                <td>{{$moneda->symbol . ' ' . number_format($subtotal,0,',','.')}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" class="highlight">Total</td>
                <td class="highlight">{{$sumacantidad}}</td>
                <td class="highlight">{{$moneda->symbol . ' ' . number_format($sumpapreciounitario,0,',','.')}}</td>
                <td class="highlight">{{$moneda->symbol . ' ' . number_format($sumasubtotal,0,',','.')}}</td>
            </tr>
        </tbody>
    </table>

    <p style="margin-top: 20px;">
        <b>Monto a Cancelar:</b> {{$moneda->symbol . ' ' . number_format($ventas->precio_total,0,',','.')}}<br>
        <b>Son:</b> {{$literal}}
    </p>

    <div class="divider"></div>

    <p class="footer">
        <b>GRACIAS POR SU PREFERENCIA</b>
    </p>
</body>

</html>