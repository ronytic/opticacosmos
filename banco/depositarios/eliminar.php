<?php  
include_once("../../login/check.php");
if (!empty($_GET)) {
	$nombre="bancodepositario";
	include_once '../../class/'.$nombre.'.php';
	${$nombre}=new $nombre;
	$Cod=$_GET['Cod'];
	${$nombre}->eliminarRegistro("CodBancoDepositario=".$Cod);
}
?>