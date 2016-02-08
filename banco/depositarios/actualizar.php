<?php
include_once("../../login/check.php");
include_once("../../class/bancodepositario.php");
$bancodepositario=new bancodepositario;
extract($_POST);
$Valores=array(	"Nombres"=>"'$Nombres'",
				"Paterno"=>"'$Paterno'",
                "Materno"=>"'$Materno'",
				"Celular"=>"'$Celular'",
);;

$bancodepositario->actualizarRegistro($Valores,"CodBancoDepositario=".$Cod);

$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>