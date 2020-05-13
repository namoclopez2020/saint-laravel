<div class="form-group">
    <label for="nombre_almacen" >Nombre de la empresa:</label>
<input type="text" name="nombre" class="form-control form-control-sm" value="{{old('nombre',$provider->nombre ?? '')}}">
</div>
<div class="form-group">
    <label for="codigo_almacen" >Nombre del contacto:</label>
   <input type="text" name="representante" class="form-control form-control-sm" value="{{old('representante',$provider->representante ?? '')}} ">
</div>
<div class="form-group">
    <label for="codigo_almacen" >Numero de telefono:</label>
   <input type="text" name="telefono" class="form-control form-control-sm" value="{{old('telefono',$provider->telefono ?? '')}}">
</div>
<div class="form-group">
    <label for="codigo_almacen" >Direccion:</label>
   <input type="text" name="direccion" class="form-control form-control-sm" value="{{old('direccion',$provider->direccion ?? '')}}">
</div>
<div class="form-group">
    <label for="codigo_almacen" >RUC:</label>
   <input type="text" name="ruc" class="form-control form-control-sm" value="{{old('ruc',$provider->ruc ?? '')}}">
</div>

<div class="form-group">
    <button class="btn btn-primary btn-block">{{$btnText}}</button>
</div>