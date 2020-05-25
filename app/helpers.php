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

function sumar_stock($cantidad_paq,$cantidad_und,$usa_empaque,$stock_und,$stock_paq,$unidades_por_caja){
	
  if($usa_empaque):

    $total_und_BD = ($stock_paq*$unidades_por_caja)+$stock_und;
    $total_und_funcion = ($cantidad_paq*$unidades_por_caja)+$cantidad_und;
    
    $numerico=$total_und_BD+$total_und_funcion;
    $paq=(int)($numerico/$unidades_por_caja);
    $und=$numerico%$unidades_por_caja;
  else:
    $paq=0;
    $und=$stock_und+$cantidad_und;
  endif;

  return $paq."/".$und;
  
}
function actualizar_costos($costo_actual,$costo_promedio,$costo_compra,$usa_empaque,$cantidad_und,$cantidad_paq,$fraccion){
    	$costo_anterior = $costo_actual;
		if($usa_empaque){
		 $unidades_totales = $cantidad_und+($cantidad_paq)*$fraccion;
		 $costo_actual=(double)$costo_compra/(double)$unidades_totales;
		 
		}
		else{
		$costo_actual = (double)$costo_compra/(double)$cantidad_und;
		}
		$costo_promedio =((double)$costo_anterior+(double)$costo_actual)/2;
		
	return $costo_anterior."/".$costo_actual."/".$costo_promedio;
}

function cantidad ($medida_paq,$medida_und,$paq,$und){
    $string = "";
    if($paq == 0){
        $string = $und." ".$medida_und;
    }
    else{
        $string = $paq." ".$medida_paq." / ".$und." ".$medida_und;
    }
    return $string;
}

function status_compra ($status){
    switch ($status) {
        case true:
              $string = "<span class='badge badge-pill badge-success'>Pagado</span>";
           break;
        case false:
            $string = "<span class='badge badge-pill badge-warning'>Parcial</span>";
        break;
    }
    return $string;
}

function resta($n1,$n2){
    return $n1-$n2;
}