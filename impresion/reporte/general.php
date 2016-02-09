<?php
include_once("../../login/check.php");
include_once("../pdf.php");
include_once("../../class/optica.php");
$optica=new optica;


if(!defined("Config")){
	include_once("../../class/config.php");
}
if(!isset($config)){
	$config=new config;
}
$TC=$config->mostrarConfig("TC",1);
include_once("../../class/usuario.php");
$usuario=new usuario;



$FechaInicio=$_GET['Desde'];
$FechaFinal=$_GET['Hasta'];
$optica->campos=array("CodUsuarioEmitido");
$opt=$optica->MostrarTodoRegistro("(FechaEmitido BETWEEN '2016-02-01' and '2016-02-06')  and `Anulado`= 0 GROUP BY CodUsuarioEmitido","","");
$CodUsuarios=array();
foreach($opt as $o){
    array_push($CodUsuarios,$o['CodUsuarioEmitido']);
}
$optica->campos=array("CodUsuarioEntrega");
$opt=$optica->MostrarTodoRegistro("(FechaEntregaReal BETWEEN '2016-02-01' and '2016-02-06')  and `Anulado`= 0 GROUP BY CodUsuarioEntrega","","");
foreach($opt as $o){
    array_push($CodUsuarios,$o['CodUsuarioEntrega']);
}

$CodUsuarios=(array_unique($CodUsuarios));
//echo strtotime("2016-02-08")-strtotime("2016-02-07");
//86400
$titulo="Reporte General";
class PDF extends PPDF{
	function Cabecera(){
		global $FechaInicio,$FechaFinal,$NombresSis,$TC;
		$this->CuadroCabecera(25,"Fecha Desde:",30,fecha2Str($FechaInicio));
        $this->CuadroCabecera(25,"Fecha Hasta:",30,fecha2Str($FechaFinal));
		$this->CuadroCabecera(10,"T/C:",20,$TC);
		$this->Pagina();
	}
}
$pdf=new PDF("P","mm","letter");
$pdf->AddPage();

$pdf->CuadroCuerpoPersonalizado(80,"Ventas y Entregas",0,"",0,"UB");
$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(20,"",0,"C",0,"B","9");
foreach($CodUsuarios as $CU){
    $datosUsuario=$usuario->mostrarDatos($CU);
    $datosUsuario=array_shift($datosUsuario);
    $Apodo=$datosUsuario['Nick'];
    $ApellidoPSis=$datosUsuario['Paterno'];
    $ApellidoMSis=$datosUsuario['Materno'];
    $NombresSis=$datosUsuario['Nombres'];
    $FotoSis=$datosUsuario['Foto'];
    $pdf->CuadroCuerpoPersonalizado(30,$ApellidoPSis." ".$NombresSis,1,"C",1,"B","9");
}
$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(20,"Fecha",1,"C",1,"B","9");
foreach($CodUsuarios as $CU){
    $pdf->CuadroCuerpoPersonalizado(15,"Ventas",1,"C",1,"B","9");
    $pdf->CuadroCuerpoPersonalizado(15,"Entregas",1,"C",1,"B","9");
}
$pdf->CuadroCuerpoPersonalizado(15,"SubTotal",1,"C",1,"B","9");
$pdf->CuadroCuerpoPersonalizado(15,"Gastos",1,"C",1,"B","9");
$pdf->CuadroCuerpoPersonalizado(15,"Total",1,"C",1,"B","9");
$pdf->ln();
//echo $FechaInicio;
//echo $FechaFinal;

for($fi=strtotime($FechaInicio);$fi<=strtotime($FechaFinal);$fi=$fi+86400){
    $Fecha=(date("Y-m-d",$fi));
    $pdf->CuadroCuerpoPersonalizado(20,fecha2Str($Fecha),1,"C",1,"","9");
    $subtotal=0;
    foreach($CodUsuarios as $CU){
        $optica->campos=array("SUM(`ACuentaBs`+`TotalAcuentaSus`)  as Total");
        $optv=$optica->MostrarTodoRegistro("FechaEmitido = '$Fecha' and `Anulado`= 0 and CodUsuarioEmitido=$CU","","");
        $optv=array_shift($optv);
        $ventas=$optv['Total'];
        $optica->campos=array("SUM(`SaldoBs`)  as Total");
        $opte=$optica->MostrarTodoRegistro("FechaEntregaReal = '$Fecha' and `Anulado`= 0 and CodUsuarioEntrega=$CU","","");
        $opte=array_shift($opte);
        $entregas=$opte['Total'];
        
        $pdf->CuadroCuerpoPersonalizado(15,number_format($ventas,2,",",""),0,"R",1,"","9"); 
        $pdf->CuadroCuerpoPersonalizado(15,number_format($entregas,2,",",""),0,"R",1,"","9"); 
        $subtotal+=$ventas+$entregas;
    }
    $pdf->CuadroCuerpoPersonalizado(15,number_format($subtotal,2,",",""),1,"R",1,"B","9"); 
    $pdf->ln();
}


$pdf->Output("Reporte.pdf","I");
exit();































$pdf->SetWidths(array(15,20,30,25,25,25,25,15,15,15,15,30));
$pdf->Fuente("",9);
$pdf->SetAligns(array("R","R","","","","","","R","R","R","R","L","R"));

$TTotalBs=0;
foreach($opt as $o){
	$pac=$paciente->MostrarRegistro($o['CodPaciente']);
	$pac=array_shift($pac);
	$prod1=$producto->MostrarRegistro($o['CodProducto1']);
	$prod1=array_shift($prod1);
	
	$prod2=$producto->MostrarRegistro($o['CodProducto2']);
	$prod2=array_shift($prod2);
	
	$prod3=$producto->MostrarRegistro($o['CodProducto3']);
	$prod3=array_shift($prod3);
	
	$prod4=$producto->MostrarRegistro($o['CodProducto4']);
	$prod4=array_shift($prod4);
	
	$prodtipo=$productotipo->MostrarRegistro($o['CodProductoTipo']);
	$prodtipo=array_shift($prodtipo);
	
	$TotalBs=number_format($o['TotalBs'],2,".","");
	$ACuentaBs=number_format($o['ACuentaBs'],2,".","");
	$ACuentaSus=number_format($o['ACuentaSus'],2,".","");
	$SaldoBs=number_format($o['SaldoBs'],2,".","");
	$DescuentoBs=number_format($o['DescuentoBs'],2,".","");
	$CobrarBs=number_format($o['CobrarBs'],2,".","");
	
	$TTotalBs+=$TotalBs;
	$TACuentaBs+=$ACuentaBs;
	$TACuentaSus+=$ACuentaSus;
	$TSaldoBs+=$SaldoBs;
	$TDescuentoBs+=$DescuentoBs;
	$TCobrarBs+=$CobrarBs;
	
	$datos=array($o['NumeroBoleta'],
			fecha2Str($o['FechaEmitido'])." ".$o['HoraEmitido'],
			utf8_decode(mb_strtoupper($pac['Paterno']." ".$pac['Materno']." ".$pac['Nombres'],"utf8")),
			utf8_decode(mb_strtoupper($prod1['Nombre']." - ".$o['Detalle1'],"utf8")),
			utf8_decode(mb_strtoupper($prod2['Nombre']." - ".$o['Detalle2'],"utf8")),
			utf8_decode(mb_strtoupper($prod3['Nombre']." - ".$o['Detalle3'],"utf8")),
			utf8_decode(mb_strtoupper($prod4['Nombre']." - ".$o['Detalle4'],"utf8")),
			$TotalBs,
			$ACuentaBs,
			$ACuentaSus,
			$SaldoBs,
			utf8_decode(mb_strtoupper($o['Observaciones'],"utf8"))
	);
	$pdf->Row($datos);	
}
	$TTotalBs=number_format($TTotalBs,2,".","");
	$TACuentaBs=number_format($TACuentaBs,2,".","");
	$TACuentaSus=number_format($TACuentaSus,2,".","");
	$TSaldoBs=number_format($TSaldoBs,2,".","");
	$TDescuentoBs=number_format($TDescuentoBs,2,".","");
	$TCobrarBs=number_format($TCobrarBs,2,".","");
	$pdf->Fuente("B",9);
	$pdf->CuadroCuerpo(165,"Total",0,"R",0,9,"B");
	$pdf->CuadroCuerpo(15,$TTotalBs,1,"R",1,9,"B");
	$pdf->CuadroCuerpo(15,$TACuentaBs,1,"R",1,9,"B");
	$pdf->CuadroCuerpo(15,$TACuentaSus,1,"R",1,9,"B");
	$pdf->CuadroCuerpo(15,$TSaldoBs,1,"R",1,9,"B");

$pdf->Output("Reporte.pdf","I");
?>