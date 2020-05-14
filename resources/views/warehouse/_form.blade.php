<div class="form-group">
    <label for="nombre_almacen" >Nombre del almacen:</label>
<input type="text" name="nombre" class="form-control form-control-sm" value="{{old('nombre',$warehouse->nombre ?? '')}}">
</div>
<div class="form-group">
    <label for="codigo_almacen" >Codigo:</label>
   <input type="text" name="codigo" class="form-control form-control-sm" value="{{old('codigo',$warehouse->codigo ?? '')}} ">
</div>
<div class="form-group">
    <label for="sucursal_almacen" >Seleccione sucursal:</label>
    <select name="office_id" class="form-control">
        @forelse ($office as $itemOffice)
            <option value="{{$itemOffice->id}}"
             @if ($warehouse->office_id == $itemOffice->id)
                 selected
             @endif   
                >{{$itemOffice->nombre}}</option>
        @empty
            
        @endforelse
     </select>
</div>

<div class="form-group">
    <button class="btn btn-primary btn-block">{{$btnText}}</button>
</div>