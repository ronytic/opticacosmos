<?php
include_once("../../login/check.php");
include_once("../../class/bancodeposito.php");
$bancodeposito=new bancodeposito;
extract($_POST);
$Valores=array("FechaDeposito"=>"'$FechaDeposito'",
				"CodBanco"=>"'$CodBanco'",
				"CodDepositario"=>"'$CodDepositario'",
				"Turno"=>"'$Turno'",
				"NBoleta"=>"'$NBoleta'",
				"Glosa"=>"'$Glosa'",
				"Monto"=>"'$Monto'",
);

$bancodeposito->actualizarRegistro($Valores,"CodBancoDeposito=".$Cod);

$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>