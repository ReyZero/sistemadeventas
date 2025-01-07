<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Productos / Sistema de Ventas</title>
    <style>
        /* Estilo general del cuerpo */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(to right, #2384C6, #6DD5FA);
            color: #333;
            position: relative;
            padding-top: 60px; /* Espacio para el encabezado */
        }

        /* Encabezado compacto */
        .header {
            padding: 10px;
            background: #003D73;
            color: white;
            text-align: center;
            font-size: 16px;
            position: relative;
            z-index: 1000;
            display: block; /* Mostrar siempre en la primera página */
        }

        .header-logo {
            height: 40px;
            border-radius: 5px;
        }

        .header-content {
            text-align: center;
            margin-top: 10px;
        }

        .header-content small {
            font-size: 10px;
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

        .footer .page-number {
            font-size: 12px;
        }

        /* Contenido principal */
        .content {
            margin: 0 20px 60px 20px;
        }

        h2 {
            text-align: center;
            color: #003D73;
            margin-bottom: 20px;
            font-size: 20px;
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
            width: 95%;
            margin: 0 auto 1rem auto;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .table-bordered th,
        .table-bordered td {
            padding: 8px;
            font-size: 12px;
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

        /* Asegurarse de que el encabezado solo se vea en la primera página */
        @media print {
            .header {
                display: block; /* Mostrar en la primera página */
            }

            .footer {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
            }

            /* Eliminar el encabezado en páginas posteriores */
            body {
                padding-top: 20px;
            }

            .header:not(:first-of-type) {
                display: none;
            }

            /* Número de página en el pie de página */
            .footer .page-number:before {
                content: "Página " counter(page);
            }

            /* Configuración para páginas */
            @page {
                margin-top: 80px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('storage/' . $empresa->logo) }}" alt="logo" class="header-logo">
        <div class="header-content">
            <h1>REPORTE DE PRODUCTOS</h1>
            <small>{{ $empresa->nombre_empresa }} | Tel: {{ $empresa->telefono }}</small>
        </div>
    </div>
    <br>
    <div class="content">
        <h2>Reporte de Productos del Sistema</h2>
        <hr>

        <p></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">Nro</th>
                    <th width="15%">Nombre Producto</th>
                    <th width="25%">Descripción</th>
                    <th width="10%">Stock</th>
                    <th width="10%">Precio Compra</th>
                    <th width="10%">Precio Venta</th>
                    <th width="10%">Fecha ingreso</th>
                </tr>
            </thead>
            <tbody>
                @php $contador = 1; @endphp
                @foreach ($productos as $producto)
                <tr>
                    <td>{{ $contador++ }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{$producto->stock}}</td>
                    <td>${{number_format($producto->precio_compra,0,',','.')}}</td>
                    <td>${{number_format($producto->precio_venta,0,',', '.')}}</td>
                    <td>{{ \Carbon\Carbon::parse($producto->fecha_ingreso)->format('d/m/Y') }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <div class="footer">
        <b><small class="page-number"></small></b>
    </div>
</body>

</html>
