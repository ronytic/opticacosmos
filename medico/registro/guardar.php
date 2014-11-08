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
				"Direccion"=>"'$Direccion'",
				"CodEspecialidad"=>"'$CodEspecialidad'",
				"Observaciones"=>"'$Observaciones'",
);
if(in_array($_SESSION['Nivel'],array(1,2,3,4))){
	$Valores["Porcentaje"]="'$Porcentaje'";
}
$medico->insertarRegistro($Valores);

$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>