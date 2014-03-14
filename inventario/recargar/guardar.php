<?php
include_once("../../login/check.php");
include_once("../../class/inventario.php");
$inventario=new inventario;
include_once("../../class/producto.php");
$producto=new producto;

extract($_POST);
$Mensajes[]=$idioma["GuardadoCorrectamente"];
$Mensajes[]="<h4><strong>".$idioma['Productos']."</strong></h4>";
foreach($p as $pro){
	/*echo "<pre>";
	print_r($pro);
	echo "</pre>";
	
	echo "$CodProducto";*/
	extract($pro);
	$Valores=array("CodProducto"=>"'$CodProducto'",
					"Cantidad"=>"'$Cantidad'",
					"CantidadStock"=>"'$Cantidad'",
					"PrecioUnitario"=>"'$PrecioUnitario'",
					"Observacion"=>"'$Observacion'",
	);
	$pr=$producto->mostrarRegistro($CodProducto);
	$pr=array_shift($pr);
	$Mensajes[]=$pr['Nombre']." - Cantidad: ".$Cantidad;
	//$inventario->insertarRegistro($Valores);
}



$folder="../../";
include_once("../../resultado.php");
?>