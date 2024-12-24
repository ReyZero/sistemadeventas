@extends('adminlte::page')

@section('title', 'Asignar Permisos')

@section('content_header')
<h1>Asignar Permisos al rol: <b>{{$rol->name}}</b></h1>
<hr style="background-color: #6A5ACD; height: 2px; border: none;">
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12"> <!-- Expandido a 12 columnas -->
        <div class="card card-outline card-teal"> <!-- Estilo distintivo en verde azulado -->
            <div class="card-header" style="background-color: #20B2AA; color: white;">
                <h3 class="card-title">Permisos Registrados para: <b>{{$rol->name}}</b></h3>
            </div>
            <div class="card-body">
                <!-- Checkbox para seleccionar/deseleccionar todos -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="selectAll">
                    <label class="form-check-label" for="selectAll">Seleccionar/Deseleccionar todos</label>
                </div>

                <!-- Lista de permisos en múltiples columnas -->
                <div class="row">
                    @foreach ($permisos as $index => $permiso)
                    <div class="col-md-4"> <!-- Tres columnas por fila -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permisos[]" value="{{$permiso->name}}">
                            <label class="form-check-label">{{$permiso->name}}</label>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Botón Guardar -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-teal"><i class="fas fa-save"></i> Guardar permisos asignados</button>
                    <a href="{{url('/admin/roles')}}" type="submit" class="btn btn-secondary" style="background-color: secondary; color:white;"><i class="fas fa-undo"></i> volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .btn-teal {
        background-color: #20B2AA;
        color: white;
        border-radius: 5px;
    }

    .btn-teal:hover {
        background-color: #1E90FF;
        color: white;
    }

    .form-check-label {
        margin-left: 5px;
    }
</style>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('input[name="permisos[]"]');

        // Escuchar el evento 'change' en el checkbox "Seleccionar/Deseleccionar todos"
        selectAllCheckbox.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked; // Marcar o desmarcar todos según el estado del principal
            });
        });
    });
</script>
@stop