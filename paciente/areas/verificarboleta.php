<?php
include_once("../../login/check.php");
$NumeroBoleta=$_POST['NumeroBoleta'];
include_once("../../class/optica.php");
$optica=new optica;

include_once("../../class/talonario.php");
$talonario=new talonario;

$opt=$optica->mostrarTodoRegistro("NumeroBoleta='$NumeroBoleta'");

$CodUsuarioLog=$_SESSION['CodUsuarioLog'];
$tal=$talonario->mostrarTodoRegistro("CodUsuarioAsignado=$CodUsuarioLog and $NumeroBoleta BETWEEN Minimo and Maximo");

if(count($opt)){
	echo "<li>El Número de Boleta ya fue registrado</li>";	
}
if(count($tal)==0){
	echo "<li>El Talonario que desea registrar... no esta asignado para su uso</li>";
}
//$opt=array_shift($opt);
//print_r($opt);
?>
