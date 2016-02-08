<?php
include_once("../../login/check.php");
include_once("../../class/gasto.php");
$gasto=new gasto;
extract($_POST);
$Valores=array("FechaGasto"=>"'$FechaGasto'",
				"Detalle"=>"'$Detalle'",
				"Monto"=>"'$Monto'",
);

$gasto->actualizarRegistro($Valores,"CodGasto=".$Cod);

$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>