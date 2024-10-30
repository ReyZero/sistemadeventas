<select name="ciudad" id="select_ciudades" class="form-control">
    <option value="" disabled selected>Seleccione . . .</option>
    @foreach ($ciudades as $ciudade)
    <option value="{{ $ciudade->id }}">{{ $ciudade->name }}</option>
    @endforeach
</select>