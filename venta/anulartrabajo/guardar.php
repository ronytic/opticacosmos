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

$valores=array("FechaAnulado"=>"'$Fecha'","HoraAnulado"=>"'$Hora'","Anulado"=>"1","CodUsuarioAnulado"=>"'$CodUsuario'","NivelAnulado"=>"'$NivelUsuario'");
$optica->actualizarRegistro($valores,"NumeroBoleta=$NumeroBoleta");

$Nuevo=0;
$Listar=0;
$Botones=array("../../venta/registro/"=>"Realizar una Venta");
$folder="../../";
$Mensajes[]=$idioma["GuardadoCorrectamente"];
include_once("../../resultado.php");
exit();
?>