<div class="container">
    <div class="row mb-3">
       
    </div>
    <hr>
    <div class="card">
        <div class="card-header h4">Lista de productos</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="myTable2" style="width:100%"> 
                    <thead class="bg-light">
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Costo</th>
                       
                    </thead>
                    <tbody>
                   @forelse ($buy->details as $itemDetail)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td> {{$itemDetail->product->nombre}} </td>
                            <td> {{$itemDetail->cant_paq}} {{$itemDetail->cant_und}} </td>
                            <td> {{$itemDetail->costo}} </td>
                        </tr>
                   @empty
                       
                   @endforelse
                   
                   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- pagos -->
<div class="container">
    <div class="row mb-3">
       
    </div>
    <hr>
    <div class="card">
        <div class="card-header h4">Pagos</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="myTable2" style="width:100%"> 
                    <thead class="bg-light">
                        <th>#</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Método de pago</th>
                       
                    </thead>
                    <tbody>
                    @forelse ($buy->payments as $itemPayment)
                        <tr>
                            <td> {{$itemPayment->id}} </td>
                            <td> {{$itemPayment->monto_pagado}} </td>
                            <td> {{$itemPayment->created_at->format('d-m-Y G:i:s')}} </td>
                            <td> {{$itemPayment->user->name}} </td>
                            <td> {{pago($itemPayment->metodo_pago)}} </td>
                        </tr>
                        
                    @empty
                        
                    @endforelse
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
