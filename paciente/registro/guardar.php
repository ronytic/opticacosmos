<?php
include_once("../../login/check.php");
include_once("../../class/paciente.php");
$paciente=new paciente;
extract($_POST);
$Valores=array("Paterno"=>"'$Paterno'",
				"Materno"=>"'$Materno'",
				"Nombres"=>"'$Nombres'",
				"Ci"=>"'$Ci'",
				"Telefono"=>"'$Telefono'",
				"Celular"=>"'$Celular'",
				"FechaNac"=>"'".fecha2Str($FechaNac,0)."'",
				"Direccion"=>"'$Direccion'",
				"Observaciones"=>"'$Observaciones'",
);
$paciente->insertarRegistro($Valores);
if($RedirigirListado==1){
	$id=$paciente->ultimo();
	header("Location:citasmedicas.php?Cod=".$id);
}
$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>