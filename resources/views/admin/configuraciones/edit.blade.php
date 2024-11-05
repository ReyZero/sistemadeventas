@extends('adminlte::page')


@section('content_header')
<h1>Configuraciones / Editar <b style="color:#1E90FF;"> </b></h1>
<hr style="background-color: #C0C0C0; height: 1px; border: none;">

@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        {{-- Card Box --}}
        <div class="card card-outline card-success" style="box-shadow:5px 0px 5px 0px #00BC8C;">


            <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                <h3 class="card-title float-none">
                    <b>Datos Registrados</b>
                </h3>
            </div>
            {{-- Card Body --}}
            <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '')}}">
                <form action="{{url('/admin/configuracion',$empresa->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="logo">LOGO EMPRESA</label><b style="color: crimson;">*</b>
                                <input type="file" id="file" name="logo" class="form-control" accept=".jpg, .jpeg, .png" >
                                @error('logo')
                                <small style="color:red;">{{$message}}</small>
                                @enderror
                                <br>
                                <center><output id="list">
                                        <img src="{{asset('storage/'.$empresa->logo)}}" alt="logo" width="70%" style="border: 5px solid #00BC8C; box-shadow: 5px 0px 5px 0px #00BC8C;">
                                    </output></center>
                                <script>
                                    function archivo(evt) {
                                        var files = evt.target.files;
                                        //obteniendo la imagen
                                        for (var i = 0, f; f = files[i]; i++) {
                                            //solo que sean imagenes
                                            if (!f.type.match('image.*')) {
                                                continue;
                                            }
                                            var reader = new FileReader();
                                            reader.onload = (function(theFile) {
                                                return function(e) {
                                                    //instertamos la imagen
                                                    document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="70%" title="', escape(theFile.name), '"/>'].join('');
                                                };
                                            })(f);
                                            reader.readAsDataURL(f);
                                        }
                                    }
                                    document.getElementById('file').addEventListener('change', archivo, false)
                                </script>
                            </div>
                        </div>
                        {{-- Primera Fila --}}
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pais">País</label>
                                        <select name="pais" id="select_pais" class="form-control">
                                            <option value="" disabled selected>Seleccione un país</option>
                                            @foreach ($paises as $paise)
                                            <option value="{{ $paise->id }}" {{$empresa->pais==$paise->id ? 'selected':''}}>{{ $paise->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label for="departamento">Estado/Provincia/región</label>
                                    <select name="departamento" id="select_departamento_2" class="form-control">
                                        @foreach ($departamentos as $departamento )
                                        <option value=" {{$departamento->id}}" {{$empresa->departamento == $departamento->id ? 'selected':''}}>{{$departamento->name}}</option>
                                        @endforeach
                                    </select>
                                    <div id="respuesta_pais"></div>
                                </div>
                                <div class="col-md-4">
                                    <label for="ciudad">Ciudad</label>
                                    <select name="ciudad" id="select_ciudad_2" class="form-control">
                                        @foreach ($ciudades as $ciudade )
                                        <option value=" {{$ciudade->id}}" {{$empresa->ciudad == $ciudade->id ? 'selected':''}}>{{$ciudade->name}}</option>
                                        @endforeach
                                    </select>
                                    <div id="respuesta_estado"></div>
                                </div>
                            </div>
                            {{--segunda fila--}}
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="nombre_empresa">Nombre de la Empresa</label><b style="color: crimson;">*</b>
                                    <input type="text" value="{{$empresa->nombre_empresa}}" class="form-control" name="nombre_empresa" placeholder="Nombre de la empresa" required>
                                    @error('nombre_empresa')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="tipo_empresa">Tipo de la Empresa</label><b style="color: crimson;">*</b>
                                    <input type="text" class="form-control" name="tipo_empresa" placeholder="de que tipo es su empresa" required value="{{$empresa->tipo_empresa}}">
                                    @error('tipo_empresa')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pais">RUT</label><b style="color: crimson;">*</b>
                                        <input type="text" placeholder="Ingrese rut ..." name="nit" class="form-control" required value="{{$empresa->nit}}">
                                        @error('nit')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="mondeda">Moneda</label><b style="color: crimson;">*</b>
                                    <select name="moneda" id="moneda" class="form-control">
                                        <option value="" disabled selected>Seleccione . . .</option>
                                        @foreach ($monedas as $moneda)
                                        <option value="{{ $moneda->id }}" {{$empresa->moneda == $moneda->id ? 'selected':''}}>{{ $moneda->symbol }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{--Tercera fila--}}

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="nombre_impuesto">Nombre del Impuesto</label><b style="color: crimson;">*</b>
                                    <input type="text" class="form-control" name="nombre_impuesto" placeholder="Nombre impuesto" required value="{{$empresa->nombre_impuesto}}">
                                    @error('nombre_impuesto')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cantidad_impuesto">Porcentaje</label><b style="color: crimson;">*</b>
                                        <input type="number" placeholder="impuesto %" name="cantidad_impuesto" class="form-control" required value="{{$empresa->cantidad_impuesto}}">
                                        @error('cantidad_impuesto')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="telefono">Teléfono</label><b style="color: crimson;">*</b>
                                    <input type="text" class="form-control" name="telefono" placeholder="Ingrese teléfono de la empresa" required value="{{$empresa->telefono}}">
                                    @error('telefono')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>



                                <div class="col-md-4">
                                    <label for="correo">Correo de la Empresa</label><b style="color: crimson;">*</b>
                                    <input type="email" class="form-control" name="correo" placeholder="Correo Empresa" required value="{{$empresa->correo}}">
                                    @error('correo')
                                    <small style="color:red;">{{$message}}</small>
                                    @enderror
                                </div>


                            </div>
                            {{--Cuarta fila--}}

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="direccion">Dirección de la Empresa</label><b style="color: crimson;">*</b>
                                        <input id="pac-input" class="form-control" name="direccion" type="text" placeholder="Buscar..." required value="{{$empresa->direccion}}">
                                        @error('direccion')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror


                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codigo_postal">Código Postal</label><b style="color: crimson;">*</b>
                                        <select name="codigo_postal" id="" class="form-control">
                                            <option value="" disabled selected>código postal</option>
                                            @foreach ($paises as $paise)
                                            <option value="{{ $paise->phone_code }}" {{$empresa->codigo_postal == $paise->phone_code ? 'selected':''}}>{{ $paise->phone_code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            {{--Quinta fila--}}
                            <div class="col-md-4 mx-auto">
                                <button type="submit" class="btn btn-lg btn-success btn-block">Modificar Antecedentes de Empresa</button>
                            </div>



                        </div>
                    </div>

                </form>
            </div>

            {{-- Card Footer --}}
            @hasSection('auth_footer')
            <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
                @yield('auth_footer')
            </div>
            @endif

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
<!--consulta de pais-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#select_pais').on('change', function() {
        var id_pais = $('#select_pais').val(); // Define la variable aquí

        if (id_pais) {
            $.ajax({
                url: "{{ url('/admin/configuracion/pais/') }}" + '/' + id_pais,
                type: "GET",
                success: function(data) {
                    $('#select_departamento_2').css('display', 'none');
                    $('#respuesta_pais').html(data); // Modifica el contenido
                }
            });
        } else {
            alert('Debes escoger un país');
        }
    });
</script>

<!--consulta de estado prvincia etc-->
<script>
    $(document).on('change', '#select_estado', function() {
        var id_estado = $(this).val();
        //alert(id_estado);
        if (id_estado) {
            $.ajax({
                url: "{{ url('/admin/configuracion/estado/') }}" + '/' + id_estado,
                type: "GET",
                success: function(data) {
                    $('#select_ciudad_2').css('display','none');
                    $('#respuesta_estado').html(data); // Modifica el contenido
                }
            });
        } else {
            alert('Debes escoger un estado');
        }
    });
</script>
<!--valida el guardado
<script>
    $('form').on('submit', function(e) {
        e.preventDefault(); // Previene el comportamiento por defecto del formulario
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response.success); // Muestra el mensaje de éxito
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                alert('Errores: ' + JSON.stringify(errors)); // Muestra errores de validación
            }
        });
    });
</script>-->
@stop