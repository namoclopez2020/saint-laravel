@csrf
<div class="form-group">
    <label for="nombre_almacen" >Nombre:</label>
    <input type="text" name="nombre" class="form-control form-control-sm" value="{{old('nombre',$client->nombre ?? '')}}">
</div>
<div class="form-group">
    <label for="codigo_almacen" >Teléfono:</label>
    <input type="text" name="telefono" class="form-control form-control-sm" value="{{old('telefono',$client->telefono ?? '')}}">
</div>
<div class="form-group">
    <label for="codigo_almacen" >Dirección:</label>
    <input type="text" name="direccion" class="form-control form-control-sm" value="{{old('direccion',$client->direccion ?? '')}}">
</div>
<div class="form-group">
    <label for="codigo_almacen" >Email:</label>
    <input type="email" name="email" class="form-control form-control-sm" value="{{old('email',$client->email ?? '')}}">
</div>
<div class="form-group">
    <label for="tipo_doc" >Seleccione tipo de documento:</label>
    <select name="documento_id" class="form-control" id="tipo_doc" onchange="elegir_documento()">
        @forelse ($documento as $itemDocumento)
        <option value="{{$itemDocumento->id}}"
            @isset($client)
            @if ($itemDocumento->id == $client->id)
            selected
        @endif 
         
            @endisset
            
          
            >{{$itemDocumento->documento}}</option>
        @empty
            
        @endforelse
        
        
    </select>    

</div>
<div class="form-group" id="numero_doc">
<label for="codigo_almacen" >Numero de documento:</label>
 <input type="text" name="nro_documento" class="form-control form-control-sm" value="{{old('nro_documento',$client->nro_documento ?? '')}}">
</div>
<div class="form-group">
    <label for="codigo_almacen" >Pedidos:</label>
   <input type="text" name="pedidos" class="form-control form-control-sm" value="{{old('pedidos',$client->pedidos ?? '')}}">
</div>
<div class="form-group">
    <label for="codigo_almacen" >Crédito:</label>
   <input type="number" name="credito_max" class="form-control form-control-sm" value="{{old('credito_max',$client->credito_max ?? '')}}">
</div>
<div class="form-group">
<button class="btn btn-primary btn-block" >{{$btnText}}</button>
</div>