@extends('adminlte::master')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
@php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
@php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('adminlte_css')
@stack('css')
@yield('css')
@stop

@section('classes_body'){{ ($auth_type ?? 'login') . '-page' }}@stop

@section('body')
<div class="container">
    <br>
    {{-- Logo --}}

    <img src="{{ asset('/images/logotipo1.png') }}" alt="Venta de insumos y Servicios" width="250px" style="display: block; margin: 0 auto; opacity: 0.6;">
    <div class="row">
        <div class="col-md-12">
            {{-- Card Box --}}
            <div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}" style="box-shadow:5px 0px 5px 0px #cccccc;">


                <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                    <h3 class="card-title float-none text-center">
                        <b>Registro de una nueva Empresa</b>
                    </h3>
                </div>


                {{-- Card Body --}}
                <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '')}}">
                    <form action="{{url('/crear-empresa/create')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="logo">LOGO EMPRESA</label><b style="color: crimson;">*</b>
                                    <input type="file" id="file" name="logo" class="form-control" accept=".jpg, .jpeg, .png" required>
                                    @error('logo')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    <br>
                                    <center><output id="list"></output></center>
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
                                                <option value="{{ $paise->id }}">{{ $paise->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <label for="departamento">Estado/Provincia/región</label>
                                        <div id="respuesta_pais"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="ciudad">Ciudad</label>
                                        <div id="respuesta_estado"></div>
                                    </div>
                                </div>
                                {{--segunda fila--}}
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="nombre_empresa">Nombre de la Empresa</label><b style="color: crimson;">*</b>
                                        <input type="text" class="form-control" name="nombre_empresa" placeholder="Nombre de la empresa" required value="{{old('nombre_empresa')}}">
                                        @error('nombre_empresa')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tipo_empresa">Tipo de la Empresa</label><b style="color: crimson;">*</b>
                                        <input type="text" class="form-control" name="tipo_empresa" placeholder="de que tipo es su empresa" required value="{{old('tipo_empresa')}}">
                                        @error('tipo_empresa')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="pais">RUT</label><b style="color: crimson;">*</b>
                                            <input type="text" placeholder="Ingrese rut ..." name="nit" class="form-control" required value="{{old('nit')}}">
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
                                            <option value="{{ $moneda->id }}">{{ $moneda->symbol }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--Tercera fila--}}

                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="nombre_impuesto">Nombre del Impuesto</label><b style="color: crimson;">*</b>
                                        <input type="text" class="form-control" name="nombre_impuesto" placeholder="Nombre impuesto" required value="{{old('nombre_impuesto')}}">
                                        @error('nombre_impuesto')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="cantidad_impuesto">Porcentaje</label><b style="color: crimson;">*</b>
                                            <input type="number" placeholder="impuesto %" name="cantidad_impuesto" class="form-control" required value="{{old('cantidad_impuesto')}}">
                                            @error('cantidad_impuesto')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="telefono">Teléfono</label><b style="color: crimson;">*</b>
                                        <input type="text" class="form-control" name="telefono" placeholder="Ingrese teléfono de la empresa" required value="{{old('telefono')}}" >
                                        @error('telefono')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                    </div>



                                    <div class="col-md-4">
                                        <label for="correo">Correo de la Empresa</label><b style="color: crimson;">*</b>
                                        <input type="email" class="form-control" name="correo" placeholder="Correo Empresa" required value="{{old('correo')}}" >
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
                                            <input id="pac-input" class="form-control" name="direccion" type="text" placeholder="Buscar..." required value="{{old('direccion')}}" >
                                            @error('direccion')
                                        <small style="color:red;">{{$message}}</small>
                                        @enderror
                                            <br>
                                            <div id="map" style="width: 100%;height: 400px"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="codigo_postal">Código Postal</label><b style="color: crimson;">*</b>
                                            <select name="codigo_postal" id="" class="form-control">
                                                <option value="" disabled selected>código postal</option>
                                                @foreach ($paises as $paise)
                                                <option value="{{ $paise->phone_code }}" >{{ $paise->phone_code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                {{--Quinta fila--}}
                                <div class="col-md-4 mx-auto">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">Crear Empresa</button>
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



</div>
@stop

@section('adminlte_js')
@stack('js')
@yield('js')
<script src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_KEY')}}&libraries=places&callback=initAutocomplete"
    async defer></script>

<script>
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
            // Coordenadas de Monterrey, N.L., México
            center: {
                lat: 25.685088,
                lng: -100.327482
            }, //{lat: -33.8688, lng: 151.2195},
            zoom: 13,
            mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input); // determina la posicion

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            /*
             * Para fines de minimizar las adecuaciones debido a que es este una demostración de adaptación mínima de código, se reemplaza forEach por some.
             */
            // places.forEach(function(place) {
            places.some(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
                // some interrumpe su ejecución en cuanto devuelve un valor verdadero (true)
                return true;
            });
            map.fitBounds(bounds);
        });
    }
</script>

<!--consulta de pais-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#select_pais').on('change', function() {
        var id_pais = $('#select_pais').val(); // Define la variable aquí

        if (id_pais) {
            $.ajax({
                url: "{{ url('/crear-empresa/pais/') }}" + '/' + id_pais,
                type: "GET",
                success: function(data) {
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
                url: "{{ url('/crear-empresa/estado/') }}" + '/' + id_estado,
                type: "GET",
                success: function(data) {
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