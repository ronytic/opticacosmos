<?php
include_once("../../login/check.php");
include_once("../../class/bancodeposito.php");
$bancodeposito=new bancodeposito;
extract($_POST);
$Valores=array("FechaDeposito"=>"'$FechaDeposito'",
				"CodBanco"=>"'$CodBanco'",
				"CodBancoDepositario"=>"'$CodBancoDepositario'",
				"Turno"=>"'$Turno'",
				"NBoleta"=>"'$NBoleta'",
				"Glosa"=>"'$Glosa'",
				"Monto"=>"'$Monto'",
);
$bancodeposito->insertarRegistro($Valores);

$Mensajes[]="Deposito Guardado Correctamente";
$folder="../../";
include_once("../../resultado.php");
?>