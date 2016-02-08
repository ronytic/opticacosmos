<?php
include_once("../../login/check.php");
include_once("../../class/bancodeposito.php");
$deposito=new deposito;
include_once("../../class/banco.php");
$banco=new banco;
include_once("../../class/depositario.php");
$depositario=new depositario;

extract($_POST);

$condicion="(FechaDeposito BETWEEN '$FechaDepositoDesde' and '$FechaDepositoHasta') and CodBanco LIKE '$CodBanco' and CodDepositario LIKE '$CodDepositario'";
$dep=$deposito->mostrarTodoRegistro($condicion,1,"FechaRegistro,HoraRegistro");
foreach($dep as $d){$i++;
	$ban=$banco->mostrarRegistro($d['CodBanco']);
	$ban=array_shift($ban);
    $dep=$depositario->mostrarRegistro($d['CodDepositario']);
	$dep=array_shift($dep);
	$datos[$i]['CodDeposito']=$d['CodDeposito'];
	$datos[$i]['FechaDeposito']=fecha2Str($d['FechaDeposito']);
	$datos[$i]['Banco']=$ban['Nombre']." N.C.: ".$ban['NumeroCuenta'];
	$datos[$i]['Depositario']=$dep['Nombres']." ".$dep['Paterno'];
	$datos[$i]['Turno']=$d['Turno'];
	$datos[$i]['NBoleta']=$d['NBoleta'];
	$datos[$i]['Monto']=array('Valor'=>$d['Monto'],'class'=>"der resaltar");
	$datos[$i]['Glosa']=$d['Glosa'];
	
}
$i++;
$datos[$i]['CodDeposito']="";
$datos[$i]['EstiloFila']="resaltar success";
$datos[$i]['NBoleta']=array('Valor'=>"Total",'class'=>"der","colspan"=>1);
$datos[$i]['Monto']=array('Valor'=>$d['Monto'],'class'=>"der");

    
$titulo=array(	"FechaDeposito"=>"Fecha del Deposito",
				"Banco"=>"Banco",
				"Depositario"=>"Depositario",
				"Turno"=>"Turno",
				"NBoleta"=>"NBoleta",
				"Monto"=>"Monto Depositado",
				"Glosa"=>"Glosa",
);
if(in_array($_SESSION['Nivel'],array(1,2,3,4,5))){
    $modificar="modificar.php";
}
if(in_array($_SESSION['Nivel'],array(1,2,3,4))){
    $eliminar="eliminar.php";
}
listadotabla($titulo,$datos,1,"",$modificar,$eliminar);
?>