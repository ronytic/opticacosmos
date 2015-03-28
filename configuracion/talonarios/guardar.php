<?php
include_once("../../login/check.php");
include_once("../../class/talonario.php");
$talonario=new talonario;
extract($_POST);
$Valores=array(	//"CodUsuarioAsignado"=>"'$CodUsuarioAsignado'",
				"Minimo"=>"'$Minimo'",
				"Maximo"=>"'$Maximo'",
				"Descripcion"=>"'$Descripcion'",
);
$talonario->insertarRegistro($Valores);

$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>