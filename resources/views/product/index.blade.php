@extends('layouts.layout')

@section('title','Productos')
    
@section('content')
<div class="container mt-4 pt-4">
    <div class="row">
        <div class="col-11 col-md-8 col-lg-10 mx-auto">
           <div class="card">
                <div class="card-header text-primary h3">
                   Lista de productos
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="myTable" style="width:100%">
                            <thead class="bg-primary text-light">
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Codigo</th>
                                <th>Fecha agregado</th>
                                <th>Es Serial</th>
                                <th>Unidad de medida</th>
                                <th>Fraccion</th>
                                <th>Stock</th>
                                <th>Stock minimo</th>
                                <th>Categoria</th>
                                <th>Almacen</th>
                                <th>Costos</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                                @forelse ($product as $itemProduct)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td> {{$itemProducto->nombre}} </td>
                                        <td> {{$itemProducto->codigo}} </td>
                                        <td> {{$itemProducto->created_at}} </td>
                                        <td> {{$itemProducto->es_serial ? 'Sí': 'No' }} </td>
                                        <td> {{$itemProducto->medida_paq}} / {{$itemProducto->medida_und}} </td>
                                        <td> {{ is_null($itemProducto->fraccion) ? 'Sin fracción' : $itemProducto->fraccion }} </td>
                                        <td></td>
                                        <td> {{$itemProducto->categorie->nombre}} </td>
                                        <td> {{$itemProducto->warehouse->nombre}} </td>
                                        <td></td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a class="btn btn-info" href="#" data-toggle="modal" data-target="#myModalmostrar" onclick="mostrar('<?php echo $producto['id_producto']?>','<?php echo urlencode($producto['nombre_producto']) ?>')"> &nbsp;&nbsp;+ info&nbsp;&nbsp;</a>
                                
                                                <a href="delete_almacen.php?id=<?php echo (int)$producto['id_producto'];?>"  class="btn  btn-danger ml-3"  >
                                                    <span class=" fa fa-trash"> </span>
                                                </a>
                                        

                                            </div>
                                        </td>
                                    
                                    </tr>
                                    
                                @empty
                                            
                                @endforelse
                                        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection