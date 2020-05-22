<div class="table-responsive">
    <table class="table">
    <tr>
        <th class='text-center'>CODIGO</th>
        <th class='text-center'>CANT.</th>
        <th>DESCRIPCION</th>
        <th class='text-right'>COSTO</th>
        
        <th></th>
    </tr>
    @forelse ($tmp_compra as $itemTmp)
    <tr>
        <td class='text-center'> {{$itemTmp->product->codigo}} </td>
        <td class='text-center'> {{$itemTmp->cantidad_paq}} {{$itemTmp->cantidad_und}} </td>
        <td> {{$itemTmp->product->nombre}} </td>
        <td class='text-right'> {{$itemTmp->costo_compra}} </td>
        
    <td class='text-center'><a href="#" onclick="eliminar('{{$itemTmp->id}}')"><i class="fa fa-trash"></i></a></td>
    </tr>	 
    @empty
        
    @endforelse
    	
      
    <tr>
        <td class='text-right' colspan=4>SUBTOTAL </td>
        <td class='text-right'></td>
        <td></td>
    </tr>
    <tr>	
        <td class='text-right' colspan=4></td>
        <td class='text-right'></td>
        <td></td>
    </tr>
    <tr>
        <td class='text-right' colspan=4>TOTAL </td>
        <td class='text-right'></td>
        <td></td>
    </tr>
    
    </table>
    </div>