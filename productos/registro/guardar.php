<?php
include_once("../../login/check.php");
include_once("../../class/producto.php");
$producto=new producto;
extract($_POST);
$Valores=array("Nombre"=>"'$Nombre'",
				"Unidad"=>"'$Unidad'",
				"CodProductoTipo"=>"'$CodProductoTipo'",
				"Descripcion"=>"'$Descripcion'",
				
);
$producto->insertarRegistro($Valores);

$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>