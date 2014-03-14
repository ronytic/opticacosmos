<?php
include_once("../../login/check.php");
include_once("../../class/especialidad.php");
$especialidad=new especialidad;
extract($_POST);
$Valores=array(	"Nombre"=>"'$Nombre'",
				"Detalle"=>"'$Detalle'",
);

$especialidad->actualizarRegistro($Valores,"CodEspecialidad=".$Cod);

$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>