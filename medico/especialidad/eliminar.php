<?php  
include_once("../../login/check.php");
if (!empty($_GET)) {
	$nombre="especialidad";
	include_once '../../class/'.$nombre.'.php';
	${$nombre}=new $nombre;
	$Cod=$_GET['Cod'];
	${$nombre}->eliminarRegistro("CodEspecialidad=".$Cod);
}
?>