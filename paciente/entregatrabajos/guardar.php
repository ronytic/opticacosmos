<?php
include_once("../../login/check.php");
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/
include_once("../../class/optica.php");
$optica=new optica;

$opt=$optica->mostrarTodoRegistro("NumeroBoleta='$NumeroBoleta'");
$opt=array_shift($opt);


//print_r($_SESSION);

extract($_POST);

$CodUsuario=$_SESSION['CodUsuarioLog'];
$NivelUsuario=$_SESSION['Nivel'];
$Fecha=date("Y-m-d");
$Hora=date("H:i:s");

$valores=array("FechaEntregaReal"=>"'$Fecha'","HoraEntregaReal"=>"'$Hora'","EstadoEntrega"=>"1","CodUsuarioEntrega"=>"'$CodUsuario'","NivelEntrega"=>"'$NivelUsuario'","NombreEntrega"=>"'$Recepcion'");
$optica->actualizarRegistro($valores,"CodOptica=$CodOptica");

$Nuevo=0;
$Listar=0;
$Botones=array("index.php"=>"Entregar de Trabajos");
$folder="../../";
$Mensajes[]=$idioma["GuardadoCorrectamente"];
include_once("../../resultado.php");
?>