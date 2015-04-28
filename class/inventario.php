<?php
include_once("bd.php");
class inventario extends bd{
	var $tabla="inventario";
    function cantidadStock($CodProducto){
        $this->campos=array("sum(CantidadStock) as CantidadStock,sum(Cantidad) as Cantidad");
        return $this->mostrarTodoRegistro("CodProducto=".$CodProducto);
    }
	
}
?>