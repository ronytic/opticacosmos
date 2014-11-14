<?php  
include_once("../../login/check.php");
if (!empty($_GET)) {
	$nombre="talonario";
	include_once '../../class/'.$nombre.'.php';
	${$nombre}=new $nombre;
	$Cod=$_GET['Cod'];
	${$nombre}->eliminarRegistro("CodTalonario=".$Cod);
}
?>