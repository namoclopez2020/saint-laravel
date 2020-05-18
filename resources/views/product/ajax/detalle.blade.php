<div class="container">
    <div class="row mb-3">
        <div class="col-12"><text class="text-info h3">Producto: " <text class="text-secondary"> {{$product->nombre}} </text>"</text></div>
    </div>
    <hr>
    <div class="card">
        <div class="card-header h4">Lista de proveedores</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="myTable2" style="width:100%"> 
                    <thead class="bg-light">
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Representante</th>
                        <th>RUC</th>
                    </thead>
                    <tbody>
                        @forelse ($product->provider as $itemProvider)
                            <tr>
                                <td> {{$itemProvider->nombre}} </td>
                                <td> {{$itemProvider->telefono}} </td>
                                <td> {{$itemProvider->direccion}}  </td>
                                <td> {{$itemProvider->representante}}  </td>
                                <td> {{$itemProvider->ruc}}  </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--lotes -->
<div class="container">
    <div class="card">
        <div class="card-header h3">Lotes existentes</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="myTable"> 
                    <thead class="bg-light">
                        <th>#</th>
                        <th>Numero de compra</th>
                        <th>Cantidad</th>
                        <th>Fecha agregado</th>
                        <th>Proveedor</th>
                        <th>Estado</th>
                       
                    </thead>
                    <tbody>
                       @forelse ($product->batches as $itemBatch)
                           <tr>
                               <td> {{$loop->iteration}} </td>
                               <td> {{$itemBatch->buy_id}} </td>
                               <td> {{ stock($itemBatch->paq,$itemBatch->und,$product->medida_paq,$product->medida_und) }} </td>
                               <td> {{$itemBatch->created_at->diffForHumans()}} </td>
                               <td> {{$itemBatch->provider->nombre}} </td>
                               <td> {{estado($itemBatch->estado)}} </td>
                           </tr>
                       @empty
                           
                       @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>