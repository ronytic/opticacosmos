<?php
include_once("../../login/check.php");
include_once("../../class/config.php");
$config=new config;
extract($_POST);

$config->actualizarConfig(array("Valor"=>"'$TC'"),"TC");
$config->actualizarConfig(array("Valor"=>"'$Lema'"),"Lema");
$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
$Nuevo=0;
$Listar=0;
$Botones=array("index.php"=>$idioma['Modificar']." ".$idioma['Configuracion']);
include_once("../../resultado.php");
?>
