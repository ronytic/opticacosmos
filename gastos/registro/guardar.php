<?php
include_once("../../login/check.php");
include_once("../../class/gasto.php");
$gasto=new gasto;
extract($_POST);
$Valores=array("FechaGasto"=>"'$FechaGasto'",
				"Detalle"=>"'$Detalle'",
				"Monto"=>"'$Monto'",
);
$gasto->insertarRegistro($Valores);

$Mensajes[]="Gasto Registrado Correctamente";
$folder="../../";
include_once("../../resultado.php");
?>