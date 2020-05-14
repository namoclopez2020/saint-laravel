@csrf
<div class="form-group">
    <label for="nombre_almacen" >Nombre:</label>
    <input type="text" name="name" class="form-control form-control-sm" value="{{old('nombre',$client->nombre ?? '')}}">
</div>
<div class="form-group">
    <label for="codigo_almacen" >Email:</label>
    <input type="email" name="email" class="form-control form-control-sm" value="{{old('email',$client->email ?? '')}}">
</div>
<div class="form-group">
    <label for="tipo_doc" >Seleccione rol:</label>
    <select name="role" class="form-control" >
        @forelse ($role as $itemRole)
        <option value="{{$itemRole->id}}"
            @isset($client)
            @if ($itemRole->id == $client->id)
            selected
        @endif 
         
            @endisset
            
          
            >{{$itemRole->name}}</option>
        @empty
            
        @endforelse
        
        
    </select>    

</div>
<div class="form-group">
    <label for="codigo_almacen" >Contraseña:</label>
   <input type="password" name="password" class="form-control form-control-sm" >
</div>
