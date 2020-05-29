@extends('layouts.layout')
@section('title','Seriales')
@section('content')
<div class="container mt-4 pt-4">
    <div class="row">
    <div class="col-12 col-md-5">
    <div class="card">
    <div class="card-header">Agregar Serial</div>
    <div class="card-body">
    <form action="agregar_serial.php" method="POST">
    <div class="form-group">
    <input type="text" class="form-control" name="serial_number">
    </div>
    <div class="form-group">
    <button type="submit" class="btn btn-success btn-block" name="agregar_serial">Agregar</button>
    </div>
    </form>
    </div>
    </div>
    </div>
    <div class="col-12 col-md-7">
        <div class="card">
             <div class="card-header">
             Lista de Seriales de "<?php echo $nombre_producto?>"
             </div>
             <div class="card-body">
             <div class="row mb-4">
             <div class="col-12">
             <div class="form-group">
             <select class='form-control input-sm' id="lote" onchange="elegir_lote()">
                                        <option value="">Elegir lote</option>
                                        <?php foreach($lotes as $lot):?>
                                        <option value="<?php echo $lot['id_detalle']?>"<?php echo ($lote==$lot['id_detalle']) ? 'selected' : '' ?>><?php echo $lot['fecha']." -- ".$lot['estado']?></option>
                                        <?php endforeach;?>
                                    </select>
             </div>
                                    
             </div>
             </div>
             <div class="table-responsive">
             <table id="myTable">
             <thead>
             <th>Serial</th>
             <th>Estado</th>
             <th>Lote</th>
             </thead>
             <tbody>
             <?php foreach($all_seriales as $serial):?>
             <tr>
             <td><?php echo $serial['serial_number']?></td>
             <td><?php echo $serial['status']?></td>
             <td><?php echo $serial['fecha']?></td>
             </tr>
             <?php endforeach;?>
             </tbody>
             </table>
             </div>
             </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('scripts')
    
@endsection