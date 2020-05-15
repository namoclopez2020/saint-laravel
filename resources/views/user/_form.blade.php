@csrf
<div class="form-group">
    <label for="nombre_almacen" >Nombre:</label>
    <input type="text" name="name" class="form-control form-control-sm" value="{{old('name',$user->name ?? '')}}">
</div>
<div class="form-group">
    <label for="codigo_almacen" >Email:</label>
    <input type="email" name="email" class="form-control form-control-sm" value="{{old('email',$user->email ?? '')}}">
</div>
<div class="form-group">
    <label for="tipo_doc" >Seleccione rol:</label>
    <select name="role" class="form-control" >
        @forelse ($role as $itemRole)
        <option value="{{$itemRole->id}}"
            @isset($user)
            @if ($itemRole->id == $user->role)
            selected
        @endif 
         
            @endisset
            
          
            >{{$itemRole->name}}</option>
        @empty
            
        @endforelse
        
        
    </select>    

</div>

