<?php
include_once("bd.php");
class inventario extends bd{
	var $tabla="inventario";
    function cantidadStock($CodProducto){
        $this->campos=array("count(CantidadStock) as CantidadStock,count(Cantidad) as Cantidad");
        return $this->mostrarTodoRegistro("CodProducto=".$CodProducto);
    }
	
}
?>