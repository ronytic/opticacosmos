<?php
include_once("../../login/check.php");
include_once("../../class/usuario.php");
$usuario1=new usuario;
extract($_POST);
$CodUsuarioRegistro=$_SESSION['idusuario'];
$NivelRegistro=$_SESSION['nivel'];
$FechaRegistro=fecha2Str("",0);
$HoraRegistro=date("H:i:s");
$Valores=array(
				"Usuario"=>"'$Usuario'",
				"Pass"=>"'$Contrasena'",
				"Pass2"=>"'".md5($Contrasena)."'",
				"Nivel"=>"'$Nivel'",
				
				"Paterno"=>"'$Paterno'",
				"Materno"=>"'$Materno'",
				"Nombres"=>"'$Nombres'",
				"Ci"=>"'$Ci'",
				"Telefono"=>"'$Telefono'",
				"Celular"=>"'$Celular'",
				"Direccion"=>"'$Direccion'",
				"Observacion"=>"'$Observaciones'",
				
				"CodUsuarioRegistro"=>"'$CodUsuarioRegistro'",
				"NivelRegistro"=>"'$NivelRegistro'",
				"FechaRegistro"=>"'$FechaRegistro'",
				"HoraRegistro"=>"'$HoraRegistro'",
				"Idioma"=>"'es'",
				"Activo"=>"1"
);
//print_r($Valores);
$usuario1->insertarRegistro($Valores,0);

$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>