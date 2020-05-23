<?php 

function documento ($tipo_documento){
    switch ($tipo_documento) {
        case 1:
            $documento ="DNI";
            break;
        case 2:
            $documento ="Cedula";
            break;
        case 3:
            $documento ="RUC";
            break;
        case 4:
            $documento ="Sin documento";
            break;
    }
    return $documento;
}

function estado ($estado){
  if($estado){
      return "Vigente";
  }
  else{
      return "En espera";
  }
}

function stock($stock_paq,$stock_und,$medida_paq,$medida_und){

    if($stock_und=="" && $stock_paq==""){
        return "Sin compras registradas";
    }
    $string ="";
    if($medida_paq !=""){
        $string =  $stock_paq." ".$medida_paq." / ";
    }
    $string .= $stock_und." ".$medida_und;

    return $string;

}

function stock_minimo($stock_paq,$stock_und,$medida_paq,$medida_und){

    $string ="";
    if($medida_paq !=""){
        $string =  $stock_paq." ".$medida_paq." / ";
    }
    $string .= $stock_und." ".$medida_und;

    return $string;
}

function costos($costo_anterior,$costo_actual,$costo_promedio){
    $string = $costo_anterior."<br>".$costo_actual."<br>".$costo_promedio;
    return $string;
}

function pago($tipo_pago){
    switch ($tipo_pago) {
        case 1:
            $pago ="Efectivo";
            break;
        case 2:
            $pago ="Cheque";
            break;
        case 3:
            $pago ="Transferencia Bancaria";
            break;
        case 4:
            $pago ="Credito";
            break;
    }
    return $pago;
}