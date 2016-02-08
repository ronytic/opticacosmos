<?php
include_once("../../login/check.php");
include_once("../../class/bancodepositario.php");
$bancodepositario=new bancodepositario;
extract($_POST);
//print_r($_POST);
$Valores=array(	"Nombres"=>"'$Nombres'",
				"Paterno"=>"'$Paterno'",
                "Materno"=>"'$Materno'",
				"Celular"=>"'$Celular'",
);
$bancodepositario->insertarRegistro($Valores);

$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>