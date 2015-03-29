<?php
include_once("../../login/check.php");
$NumeroBoleta=$_POST['NumeroBoleta'];
include_once("../../class/optica.php");
$optica=new optica;

include_once("../../class/talonario.php");
$talonario=new talonario;

$CodUsuarioLog=$_SESSION['CodUsuarioLog'];

$opt=$optica->mostrarTodoRegistro("NumeroBoleta='$NumeroBoleta' and Emitido=1 ");

if(count($opt)){
	echo "<li>El Número de Boleta ya fue Emitido</li>";	
}
$opt=$optica->mostrarTodoRegistro("NumeroBoleta='$NumeroBoleta' and CodUsuarioBoleta!=$CodUsuarioLog");

if(count($opt)){
	echo "<li>El Número de Boleta Esta Asignado para otro Usuario</li>";	
}

$opt=$optica->mostrarTodoRegistro("NumeroBoleta='$NumeroBoleta'");

if(count($opt)==0){
	echo "<li>El Talonario que desea registrar... no esta asignado para su uso</li>";
}
//$opt=array_shift($opt);
//print_r($opt);
?>
