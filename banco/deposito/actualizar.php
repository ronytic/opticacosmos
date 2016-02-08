<?php
include_once("../../login/check.php");
include_once("../../class/bancodeposito.php");
$deposito=new deposito;
extract($_POST);
$Valores=array("FechaDeposito"=>"'$FechaDeposito'",
				"CodBanco"=>"'$CodBanco'",
				"CodDepositario"=>"'$CodDepositario'",
				"Turno"=>"'$Turno'",
				"NBoleta"=>"'$NBoleta'",
				"Glosa"=>"'$Glosa'",
				"Monto"=>"'$Monto'",
);

$deposito->actualizarRegistro($Valores,"CodDeposito=".$Cod);
$Listar=0;
$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>