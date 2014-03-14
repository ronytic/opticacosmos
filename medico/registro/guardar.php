<?php
include_once("../../login/check.php");
include_once("../../class/medico.php");
$medico=new medico;
extract($_POST);
$Valores=array("Paterno"=>"'$Paterno'",
				"Materno"=>"'$Materno'",
				"Nombres"=>"'$Nombres'",
				"Ci"=>"'$Ci'",
				"Telefono"=>"'$Telefono'",
				"Celular"=>"'$Celular'",
				"FechaNac"=>"'".fecha2Str($FechaNac,0)."'",
				"CodEspecialidad"=>"'$CodEspecialidad'",
				"Observaciones"=>"'$Observaciones'",
);
$medico->insertarRegistro($Valores);

$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>