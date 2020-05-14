<div class="form-group">
    <label for="nombre_almacen" >Nombre de la sucursal:</label>
<input type="text" name="nombre" class="form-control form-control-sm" value="{{old('nombre',$office->nombre ?? '')}}">
</div>
<div class="form-group">
    <label for="codigo_almacen" >Direccion:</label>
   <input type="text" name="direccion" class="form-control form-control-sm" value="{{old('direccion',$office->direccion ?? '')}} ">
</div>
<div class="form-group">
    <label for="codigo_almacen" >RUC O RIF:</label>
   <input type="text" name="ruc" class="form-control form-control-sm" value="{{old('ruc',$office->ruc ?? '')}}">
</div>
<div class="form-group">
    <label for="codigo_almacen" >Email:</label>
   <input type="email" name="email" class="form-control form-control-sm" value="{{old('email',$office->email ?? '')}}">
</div>
<div class="form-group">
    <label for="codigo_almacen" >Teléfono</label>
   <input type="text" name="telefono" class="form-control form-control-sm" value="{{old('telefono',$office->telefono ?? '')}}">
</div>

<div class="form-group">
    <button class="btn btn-primary btn-block">{{$btnText}}</button>
</div>