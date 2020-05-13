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