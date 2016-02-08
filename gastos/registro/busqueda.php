<?php
include_once("../../login/check.php");
include_once("../../class/gasto.php");
$gasto=new gasto;


extract($_POST);

$condicion="(FechaGasto BETWEEN '$FechaGastoDesde' and '$FechaGastoHasta') ";
$dep=$gasto->mostrarTodoRegistro($condicion,1,"FechaGasto,FechaRegistro,HoraRegistro");
$total=0;
foreach($dep as $d){$i++;
	
	$datos[$i]['CodGasto']=$d['CodGasto'];
	$datos[$i]['FechaGasto']=fecha2Str($d['FechaGasto']);
	$datos[$i]['Detalle']=$d['Detalle'];
	$datos[$i]['Monto']=array('Valor'=>$d['Monto'],'class'=>"der resaltar");
	$total+=$d['Monto'];
}
$i++;
$datos[$i]['CodDeposito']="";
$datos[$i]['EstiloFila']="resaltar success";
$datos[$i]['Detalle']=array('Valor'=>"Total",'class'=>"der","colspan"=>1);
$datos[$i]['Monto']=array('Valor'=>$total,'class'=>"der");

    
$titulo=array(	"FechaGasto"=>"Fecha del Gasto",
				"Detalle"=>"Detalle",
				"Monto"=>"Monto del Gasto",
);
if(in_array($_SESSION['Nivel'],array(1,2,3,4,5))){
    $modificar="modificar.php";
}
if(in_array($_SESSION['Nivel'],array(1,2,3,4))){
    $eliminar="eliminar.php";
}
listadotabla($titulo,$datos,1,"",$modificar,$eliminar);
?>