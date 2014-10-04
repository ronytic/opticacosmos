<?php
include_once("../../login/check.php");
include_once("../../class/usuario.php");
$usuario1=new usuario;
extract($_POST);
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

$usuario1->actualizarRegistro($Valores,"CodUsuario=".$Cod);

$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>