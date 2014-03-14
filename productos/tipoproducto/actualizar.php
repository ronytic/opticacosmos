<?php
include_once("../../login/check.php");
include_once("../../class/productotipo.php");
$productotipo=new productotipo;
extract($_POST);
$Valores=array(	"Nombre"=>"'$Nombre'",
				"Descripcion"=>"'$Descripcion'",
);
$productotipo->actualizarRegistro($Valores,"CodProductoTipo=".$Cod);

$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>