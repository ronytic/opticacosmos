<?php
include_once("../../login/check.php");
include_once("../../class/bancoretiro.php");
$bancoretiro=new bancoretiro;
include_once("../../class/banco.php");
$banco=new banco;

extract($_POST);

$condicion="(FechaRetiro BETWEEN '$FechaRetiroDesde' and '$FechaRetiroHasta') and CodBanco LIKE '$CodBanco'";
$dep=$bancoretiro->mostrarTodoRegistro($condicion,1,"FechaRegistro,HoraRegistro");
$total=0;
foreach($dep as $d){$i++;
	$ban=$banco->mostrarRegistro($d['CodBanco']);
	$ban=array_shift($ban);
	$datos[$i]['CodBancoRetiro']=$d['CodBancoRetiro'];
	$datos[$i]['FechaDeposito']=fecha2Str($d['FechaDeposito']);
	$datos[$i]['Banco']=$ban['Nombre']." N.C.: ".$ban['NumeroCuenta'];
	$datos[$i]['NBoleta']=$d['NBoleta'];
	$datos[$i]['Monto']=array('Valor'=>$d['Monto'],'class'=>"der resaltar");
	$datos[$i]['Glosa']=$d['Glosa'];
	$total+=$d['Monto'];
}
$i++;
$datos[$i]['CodDeposito']="";
$datos[$i]['EstiloFila']="resaltar success";
$datos[$i]['NBoleta']=array('Valor'=>"Total",'class'=>"der","colspan"=>1);
$datos[$i]['Monto']=array('Valor'=>$total,'class'=>"der");

    
$titulo=array(	"FechaDeposito"=>"Fecha del Retiro",
				"Banco"=>"Banco",
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