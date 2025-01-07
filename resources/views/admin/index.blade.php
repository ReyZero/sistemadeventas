@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Bienvenido <b style="color:#1E90FF;">{{$empresa->nombre_empresa}}</b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">

@stop

@section('content')
<div class="row">
    <!-- ROLES -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP" style="background: linear-gradient(135deg, #000000, #333333); border: 2px solid #00c0ef; border-radius: 10px; transition: all 0.3s ease;">
            <a href="{{ url('/admin/roles') }}" class="info-box-icon bg-info" style="color: #fff; border-radius: 50%; transition: background-color 0.3s ease;">
                <i class="fas fa-user-check"></i>
            </a>
            <div class="info-box-content">
                <span class="info-box-text" style="color: #fff;">Roles registrados</span>
                <span class="info-box-numbers" style="color: #fff;">{{ $total_roles }} roles</span>
            </div>
        </div>
    </div>


    <!-- PERMISOS -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP" style="background: linear-gradient(135deg, #4B0082, #6A5ACD); border: 3px solid #FFD700; border-radius: 12px; transition: all 0.3s ease;">
            <!-- Enlace con ícono y fondo dorado -->
            <a href="{{ url('/admin/permisos') }}" class="info-box-icon" style="color: #fff; background-color: #FFD700; border-radius: 50%; transition: background-color 0.3s ease; border: 3px solid #FFD700;">
                <i class="fas fa-key" style="color: #4B0082;"></i> <!-- Ícono con color personalizado -->
            </a>
            <div class="info-box-content">
                <span class="info-box-text" style="color: #fff;">Permisos configurados</span>
                <span class="info-box-numbers" style="color: #fff;">{{ $total_permisos }} permisos</span>
            </div>
        </div>
    </div>

    <!-- USUARIOS -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP" style="background: linear-gradient(135deg, #000000, #333333); border: 2px solid #28a745; border-radius: 10px; transition: all 0.3s ease;">
            <a href="{{ url('/admin/usuarios') }}" class="info-box-icon bg-success" style="color: #fff; border-radius: 50%; transition: background-color 0.3s ease;">
                <i class="fas fa-users"></i>
            </a>
            <div class="info-box-content">
                <span class="info-box-text" style="color: #fff;">Usuarios registrados</span>
                <span class="info-box-numbers" style="color: #fff;">{{ $total_usuarios }} usuarios</span>
            </div>
        </div>
    </div>

    <!-- CATEGORIAS -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP" style="background: linear-gradient(135deg, #000000, #333333); border: 2px solid #ffc107; border-radius: 10px; transition: all 0.3s ease;">
            <!-- Enlace con ícono y fondo amarillo -->
            <a href="{{ url('/admin/categorias') }}" class="info-box-icon" style="color: #fff; background-color: #ffc107; border-radius: 50%; transition: background-color 0.3s ease; border: 2px solid #ffc107;">
                <i class="fas fa-tags" style="color: #fff;"></i> <!-- Ícono blanco -->
            </a>
            <div class="info-box-content">
                <span class="info-box-text" style="color: #fff;">Categorias registrados</span>
                <span class="info-box-numbers" style="color: #fff;">{{ $total_categorias }} usuarios</span>
            </div>
        </div>
    </div>

    <!-- PRODUCTOS -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP" style="background: linear-gradient(135deg, #000000, #333333); border: 2px solid #FF7F50; border-radius: 10px; transition: all 0.3s ease;">
            <!-- Enlace con ícono y fondo coral -->
            <a href="{{ url('/admin/productos') }}" class="info-box-icon" style="color: #fff; background-color: #FF7F50; border-radius: 50%; transition: background-color 0.3s ease; border: 2px solid #FF7F50;">
                <i class="fas fa-list" style="color: #fff;"></i> <!-- Ícono blanco -->
            </a>
            <div class="info-box-content">
                <span class="info-box-text" style="color: #fff;">Productos registrados</span>
                <span class="info-box-numbers" style="color: #fff;">{{ $total_productos }} usuarios</span>
            </div>
        </div>
    </div>


    <!-- PROVEEDORES -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP" style="background: linear-gradient(135deg, #000000, #333333); border: 2px solid #FF0000; border-radius: 10px; transition: all 0.3s ease;">
            <!-- Enlace con ícono y fondo rojo -->
            <a href="{{ url('/admin/proveedores') }}" class="info-box-icon" style="color: #fff; background-color: #FF0000; border-radius: 50%; transition: background-color 0.3s ease; border: 2px solid #FF0000;">
                <i class="fas fa-truck-fast" style="color: #fff;"></i> <!-- Ícono blanco -->
            </a>
            <div class="info-box-content">
                <span class="info-box-text" style="color: #fff;">Proveedores registrados</span>
                <span class="info-box-numbers" style="color: #fff;">{{ $total_proveedores }} productos</span>
            </div>
        </div>
    </div>


    <!-- COMPRAS -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP" style="background: linear-gradient(135deg, #000000, #333333); border: 2px solid #007bff; border-radius: 10px; transition: all 0.3s ease;">
            <!-- Enlace con ícono y fondo azul -->
            <a href="{{ url('/admin/compras') }}" class="info-box-icon" style="color: #fff; background-color: #007bff; border-radius: 50%; transition: background-color 0.3s ease; border: 2px solid #007bff;">
                <i class="fas fa-shopping-cart" style="color: #fff;"></i> <!-- Ícono blanco -->
            </a>
            <div class="info-box-content">
                <span class="info-box-text" style="color: #fff;">Compras registradas</span>
                <span class="info-box-numbers" style="color: #fff;">{{ $total_compras }} compras</span>
            </div>
        </div>
    </div>

    <!-- CLIENTES -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP" style="background: linear-gradient(135deg, #000000, #333333); border: 2px solid #20B2AA; border-radius: 10px; transition: all 0.3s ease;">
            <!-- Enlace con ícono y fondo verde azulado -->
            <a href="{{ url('/admin/clientes') }}" class="info-box-icon" style="color: #fff; background-color: #20B2AA; border-radius: 50%; transition: background-color 0.3s ease; border: 2px solid #20B2AA;">
                <i class="fas fa-address-book" style="color: #fff;"></i> <!-- Ícono blanco -->
            </a>
            <div class="info-box-content">
                <span class="info-box-text" style="color: #fff;">Clientes registrados</span>
                <span class="info-box-numbers" style="color: #fff;">{{ $total_clientes}} clientes</span>
            </div>
        </div>
    </div>

    <!-- VENTAS -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP" style="background: linear-gradient(135deg, #000000, #333333); border: 2px solid #800080; border-radius: 10px; transition: all 0.3s ease;">
            <!-- Enlace con ícono y fondo morado -->
            <a href="{{ url('/admin/ventas') }}" class="info-box-icon" style="color: #fff; background-color: #800080; border-radius: 50%; transition: background-color 0.3s ease; border: 2px solid #800080;">
                <i class="fas fa-money-bill" style="color: #fff;"></i> <!-- Ícono blanco -->
            </a>
            <div class="info-box-content">
                <span class="info-box-text" style="color: #fff;">Ventas registradas</span>
                <span class="info-box-numbers" style="color: #fff;">{{ $total_ventas }} ventas</span>
            </div>
        </div>
    </div>

    <!-- ARQUEO -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP" style="background: linear-gradient(135deg, #000000, #4B5320); border: 2px solid #FFD700; border-radius: 10px; transition: all 0.3s ease;">
            <!-- Enlace con ícono y fondo dorado -->
            <a href="{{ url('/admin/arqueos') }}" class="info-box-icon" style="color: #fff; background-color: #FFD700; border-radius: 50%; transition: background-color 0.3s ease; border: 2px solid #FFD700;">
                <i class="fas fa-cash-register" style="color: #fff;"></i> <!-- Ícono blanco -->
            </a>
            <div class="info-box-content">
                <span class="info-box-text" style="color: #fff;">Arqueo registrado</span>
                <span class="info-box-numbers" style="color: #fff;">{{ $total_arqueos }} Arqueos de Cajas</span>
            </div>
        </div>
    </div>







</div>

<!-- LA GRAFICA -->
<div class="row">
    <div class="col-md-6">
        <div class="card  card-outline card-primary ">
            <div class="card-header">
                <h3>Total Cantidad de Ventas</h3>
            </div>
            <div class="card-body">
                <div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card  card-outline card-primary ">
            <div class="card-header">
                <h3>Total Costo de Ventas</h3>
            </div>
            <div class="card-body">
                <div>
                    <canvas id="myChart2"></canvas>
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
<!-- GRAFICA 1 -->
<?php
$meses = array_fill(1, 12, 0);
$suma_ventas = array_fill(1, 12, 0);
foreach ($total_ventas_grafico as $totalventagrafico) {
    $fecha = strtotime($totalventagrafico['fecha']);
    $mes= date('m',$fecha);

    $meses[(int)$mes]++;
    $suma_ventas[(int)$mes]+=$totalventagrafico['precio_total'];
}
$reporte_cantidad= implode(',',$meses);
$reporte_ventas= implode(',',$suma_ventas);

?>
<script>
    var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    var datos = [{{$reporte_cantidad}}];
    // Personalización de colores
    // Personalización de colores
    var coloresDeFondo = [
        'rgba(75, 192, 192, 0.5)', // Verde
        'rgba(54, 162, 235, 0.5)', // Azul
        'rgba(255, 206, 86, 0.5)', // Amarillo
        'rgba(255, 99, 132, 0.5)', // Rojo
        'rgba(153, 102, 255, 0.5)', // Morado
        'rgba(255, 159, 64, 0.5)', // Naranja
        'rgba(201, 203, 207, 0.5)' // Gris
    ];
    var coloresDeBorde = [
        'rgba(75, 192, 192, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(255, 99, 132, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(201, 203, 207, 1)'
    ];

    // Inicialización del gráfico
    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'line', // Tipo de gráfico
        data: {
            labels: meses,
            datasets: [{
                label: 'Cantidad de Ventas',
                data: datos,
                backgroundColor: coloresDeFondo, // Colores de fondo
                borderColor: coloresDeBorde, // Colores del borde
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: 'white' // Cambia el color del texto de la leyenda (label) a blanco
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: 'white' // Cambia el color del texto de los meses a blanco
                    }
                },
                y: {
                    beginAtZero: true, // Escala inicia en 0
                    ticks: {
                        color: 'white' // Opcional: cambia el color del texto del eje Y a blanco
                    }
                }
            }
        }
    });
</script>
<!-- GRAFICA 2 -->
<script>
    var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    var datos = [{{$reporte_ventas}}];
    // Personalización de colores
    // Personalización de colores
    var coloresDeFondo = [
        'rgba(75, 192, 192, 0.5)', // Verde
        'rgba(54, 162, 235, 0.5)', // Azul
        'rgba(255, 206, 86, 0.5)', // Amarillo
        'rgba(255, 99, 132, 0.5)', // Rojo
        'rgba(153, 102, 255, 0.5)', // Morado
        'rgba(255, 159, 64, 0.5)', // Naranja
        'rgba(201, 203, 207, 0.5)' // Gris
    ];
    var coloresDeBorde = [
        'rgba(75, 192, 192, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(255, 99, 132, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(201, 203, 207, 1)'
    ];

    // Inicialización del gráfico
    const ctx2 = document.getElementById('myChart2').getContext('2d');
    new Chart(ctx2, {
        type: 'bar', // Tipo de gráfico
        data: {
            labels: meses,
            datasets: [{
                label: 'Monto total de Ventas',
                data: datos,
                backgroundColor: coloresDeFondo, // Colores de fondo
                borderColor: coloresDeBorde, // Colores del borde
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: 'white' // Cambia el color del texto de la leyenda (label) a blanco
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: 'white' // Cambia el color del texto de los meses a blanco
                    }
                },
                y: {
                    beginAtZero: true, // Escala inicia en 0
                    ticks: {
                        color: 'white' // Opcional: cambia el color del texto del eje Y a blanco
                    }
                }
            }
        }
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