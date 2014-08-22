<?php
include_once("../../login/check.php");
$CodProductoTipo=$_POST['CodProductoTipo'];
include_once("../../class/producto.php");
$producto=new producto;
$prod=$producto->mostrarTodoRegistro("CodProductoTipo=$CodProductoTipo",1,"Nombre");
$data='';
foreach($prod as $p){
	$data.="<option value=\"".$p['CodProducto']."\">".$p['Nombre']."</option>";
}
echo $data;
?>
