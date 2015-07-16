<?php
include_once("../../login/check.php");
include_once("../../class/depositario.php");
$depositario=new depositario;
extract($_POST);
//print_r($_POST);
$Valores=array(	"Nombres"=>"'$Nombres'",
				"Paterno"=>"'$Paterno'",
                "Materno"=>"'$Materno'",
				"Celular"=>"'$Celular'",
);
$depositario->insertarRegistro($Valores);

$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>