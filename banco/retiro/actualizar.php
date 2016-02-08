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

$bancoretiro->actualizarRegistro($Valores,"CodBancoRetiro=".$Cod);

$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>