<?php
include_once("../../login/check.php");
include_once("../../class/bancoretiro.php");
$bancoretiro=new bancoretiro;
extract($_POST);
$Valores=array("FechaRetiro"=>"'$FechaRetiro'",
				"CodBanco"=>"'$CodBanco'",
				
				"NBoleta"=>"'$NBoleta'",
				"Glosa"=>"'$Glosa'",
				"Monto"=>"'$Monto'",
);
$bancoretiro->insertarRegistro($Valores);

$Mensajes[]="Retiro Guardado Correctamente";
$folder="../../";
include_once("../../resultado.php");
?>