<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Arqueos de Caja / Sistema de Ventas</title>
    <style>
        /* Estilo general del cuerpo */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(to right, #2384C6, #6DD5FA);
            color: #333;
            position: relative;
        }

        /* Encabezado */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background: #003D73;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .header table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-logo {
            border-radius: 5px;
        }

        .header td {
            vertical-align: middle;
            padding: 5px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            color: white;
        }

        .header h4 {
            margin: 5px 0 0;
            font-size: 12px;
            color: #FFD700;
        }

        /* Pie de página */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40px;
            background: #003D73;
            color: white;
            text-align: center;
            line-height: 40px;
            font-size: 14px;
            box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.2);
        }

        /* Contenido principal */
        .content {
            margin: 150px 20px 60px 20px;
            padding-bottom: 60px;
        }

        h2 {
            text-align: center;
            color: #003D73;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        hr {
            border: none;
            height: 2px;
            background: #003D73;
            margin-bottom: 20px;
        }

        /* Estilo de la tabla */
        .table {
            width: 100%;
            margin-bottom: 1rem;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .table-bordered {
            border: none;
        }

        .table-bordered th,
        .table-bordered td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .table-bordered thead th {
            background-color: #2384C6;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        .table-bordered tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .table-bordered tbody tr:nth-child(even) {
            background-color: #eef7fd;
        }

        .table-bordered tbody tr:hover {
            background-color: #d5e8ff;
        }

        /* Estilo para la tabla anidada */
        .nested-table {
            width: 90%;
            margin: 10px auto;
            border-collapse: collapse;
            background: #f5f5f5;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .nested-table th,
        .nested-table td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .nested-table thead th {
            background-color: #6DD5FA;
            color: #003D73;
            font-weight: bold;
        }

        .nested-table tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .nested-table tbody tr:nth-child(even) {
            background-color: #f0f8ff;
        }

        .page-number:before {
            content: "Página " counter(page);
        }
    </style>
</head>

<body>
    <div class="header">
        <table>
            <tr>

                <td style="text-align: left; width: 20%;">
                    <img src="{{public_path('storage/'.$empresa->logo)}}" alt="logo" width="80px" class="header-logo">
                </td>

                <td style="text-align: center; width: 60%;">
                    <h1>REPORTE DE ARQUEOS DE CAJA</h1>
                </td>

            </tr>
            <tr>
                <td colspan="3" style="text-align: center; font-size: 10pt; padding-top: 10px;">
                    {{$empresa->nombre_empresa}} | {{$empresa->tipo_empresa}}<br>
                    {{$empresa->correo}} | Tel: {{$empresa->telefono}}
                </td>
            </tr>
        </table>
    </div>
    <br>
    <br>
    <div class="content">
        <h2>Reporte de Arqueos de Caja</h2>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">Nro</th>
                    <th width="10$">Fecha Apertura</th>
                    <th width="10%">Monto Inicial</th>
                    <th width="10%">Fecha Cierre</th>
                    <th width="10%">Monto Final</th>
                    <th width="10%">Movimientos</th>
                    <th width="10%">Descripción</th>

                    <th width="20%">Fecha y hora de creación</th>
                </tr>
            </thead>
            <tbody>
                @php
                $contador=1;

                @endphp
                <!-- Aquí se genera dinámicamente el contenido de la tabla -->
                @foreach ($arqueos as $arqueo)
                @php
                @endphp
                <tr>
                    <td> {{$contador++}} </td>
                    <td> {{ \Carbon\Carbon::parse($arqueo->fecha_apertura)->format('d/m/Y')}} </td>
                    <td>$ {{number_format($arqueo->monto_inicial,0,',','.')}}</td>
                    <td> {{ \Carbon\Carbon::parse($arqueo->fecha_cierre)->format('d/m/Y')}} </td>
                    <td>$ {{number_format($arqueo->monto_final,0,',','.')}}</td>
                    <td>
                        <table class="nested-table">
                            <thead>
                                <tr>
                                    <th>Ingresos</th>
                                    <th>Egresos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>$ {{number_format($arqueo->total_ingresos,0,',','.')}}</td>
                                    <td>$ {{number_format($arqueo->total_egresos,0,',','.')}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>{{$arqueo->descripcion}}</td>
                    <td>{{ $arqueo->created_at->format('d/m/Y H:i:s') }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="footer">
        <b><small class="page-number"></small></b>
    </div>
</body>

</html>