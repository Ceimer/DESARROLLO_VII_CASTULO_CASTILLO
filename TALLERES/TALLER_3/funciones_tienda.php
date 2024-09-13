<?php
function calcular_descuento($total_compra){
    if($total_compra < 100){ 
        echo "no hay descuento";
    }
    elseif($total_compra >= 100 && $total_compra <= 500){

        $descuento = ($total_compra*0.05)- $total_compra;
        //echo "aplica un descuento del 5%, precio final = " . ($total_compra*0.05);
    }
    elseif($total_compra > 501 && $total_compra <= 1000){

        $descuento =($total_compra*0.10)- $total_compra;
        //echo "aplica un descuento del 10%, precio final = " . ($total_compra*0.10);
    }    
    elseif($total_compra > 1000){
        
        $descuento = ($total_compra*0.15)- $total_compra;
        //echo "aplica un descuento del 15%, precio final = " . ($total_compra*0.15);
    }
    return $descuento;
}

function aplicar_impuestos($subtotal){
    $impuesto= ($subtotal * 0.07) + $subtotal;
    return $impuesto;    
}

function calcular_total($subtotal, $descuento, $impuesto) {
   $total= $subtotal- $descuento + $impuesto;
   return $total;
}

?>