<div class="container">
       
    <form id="form_pago" method="POST">
    @csrf
    @method('PATCH')
    <div class="form-group">
    
         <label for="pago">Cantidad a pagar</label>
         <input type="hidden" class="form-control form-control-sm" name="maximo" id="maximo" value="{{resta($buy->costo_total_compra,$buy->pagado)}}"> 
         <input type="number" class="form-control form-control-sm" name="pago" id="pago" value="{{resta($buy->costo_total_compra,$buy->pagado)}}"> 
    </div>
    <div class="form-group">
    <label class="form-control-label">Medio de Pago</label>
                     
                         <select class='form-control input-sm form-control-sm' name="medio_pago" id="medio_pago">
                             <option value="1">Efectivo</option>
                             <option value="2">Cheque</option>
                             <option value="3">Transferencia bancaria</option>
                             
                         </select>
    </div>
    <div class="form-group mt-3">
    <button type="button" onclick="pagar('{{$buy->id}}')" class="btn btn-primary btn-sm btn-block">Pagar</button>
    </div>

    </form>

</div>