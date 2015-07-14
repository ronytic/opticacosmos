<?php
include_once("../../login/check.php");
include_once("../../class/banco.php");
$banco=new banco;
extract($_POST);
//print_r($_POST);
$Valores=array(	"Nombre"=>"'$Nombre'",
				"NumeroCuenta"=>"'$NumeroCuenta'",
                "TipoCuenta"=>"'$TipoCuenta'",
);
$banco->insertarRegistro($Valores);

$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>