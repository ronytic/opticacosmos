<?php
include_once("bd.php");
class optica extends bd{
	var $tabla="optica";
    
    function cantidadVenta($Condicion){
        $this->campos=array("count(*) as Cantidad");
        return $this->mostrarTodoRegistro($Condicion);
    }
	
}
?>