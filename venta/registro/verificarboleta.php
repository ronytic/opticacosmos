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
	$val['datos']="<li>El Número de Boleta ya fue Emitido</li>";	
}
$opt=$optica->mostrarTodoRegistro("NumeroBoleta='$NumeroBoleta' and CodUsuarioBoleta!=$CodUsuarioLog");

if(count($opt)){
	$val['datos'].="<li>El Número de Boleta Esta Asignado para otro Usuario</li>";	
}

$opt=$optica->mostrarTodoRegistro("NumeroBoleta='$NumeroBoleta'");

if(count($opt)==0){
	$val['datos'].="<li>El Talonario que desea registrar... no esta asignado para su uso</li>";
}
if($val['datos']!=""){
    $val['datos'].="<li> Nº $NumeroBoleta</li>";
    $val['alerta']="danger";
    $val['habilitado']=0;
    $val['BotonEnviar']="Revise los Datos antes de Guardar";
}else{
    $val['datos']="<li>Número de Boleta Valida - Nº $NumeroBoleta</li>";
    $val['alerta']="success";
    $val['habilitado']=1;
    $val['BotonEnviar']="Registrar";
}
echo json_encode($val);
//$opt=array_shift($opt);
//print_r($opt);
?>
