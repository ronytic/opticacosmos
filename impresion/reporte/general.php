<?php
include_once("../../login/check.php");
include_once("../pdf.php");
include_once("../../class/optica.php");
$optica=new optica;

include_once("../../class/gasto.php");
$gasto=new gasto;

include_once("../../class/banco.php");
$banco=new banco;
include_once("../../class/bancodeposito.php");
$bancodeposito=new bancodeposito;
include_once("../../class/bancoretiro.php");
$bancoretiro=new bancoretiro;

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
$pdf=new PDF("L","mm","letter");
$pdf->AddPage();
$pdf->ln();
$pdf->ln();
$pdf->ln();$pdf->ln();$pdf->ln();
/*INICIO VENTAS Y ENTREGAS*/
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
    $pdf->CuadroCuerpoPersonalizado(45,$ApellidoPSis." ".$NombresSis,1,"C",1,"B","9");
}
$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(20,"Fecha",1,"C",1,"B","9");
foreach($CodUsuarios as $CU){
    $pdf->CuadroCuerpoPersonalizado(15,"Ventas",1,"C",1,"B","9");
    $pdf->CuadroCuerpoPersonalizado(15,"Entregas",1,"C",1,"B","9");
    $pdf->CuadroCuerpoPersonalizado(15,"V+E",1,"C",1,"B","9");
}
$pdf->CuadroCuerpoPersonalizado(15,"SubTotal",1,"C",1,"B","9");
$pdf->CuadroCuerpoPersonalizado(15,"Gastos",1,"C",1,"B","9");
$pdf->CuadroCuerpoPersonalizado(15,"Total",1,"C",1,"B","9");
$pdf->ln();
$TotalMaximo=array();
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
        $pdf->CuadroCuerpoPersonalizado(15,number_format($ventas+$entregas,2,",",""),1,"R",1,"B","9");
        $subtotal+=$ventas+$entregas;
        $TotalMaximo['V'.$CU]+=$ventas;
        $TotalMaximo['E'.$CU]+=$entregas;
        $TotalMaximo['VE'.$CU]+=$ventas+$entregas;
    }
    $gasto->campos=array("SUM(`Monto`)  as Total");
    $g=$gasto->MostrarTodoRegistro("FechaGasto ='$Fecha'");
    $g=array_shift($g);
    $gas=$g['Total'];
    $total=$subtotal-$gas;
    $pdf->CuadroCuerpoPersonalizado(15,number_format($subtotal,2,",",""),1,"R",1,"B","9"); 
    $pdf->CuadroCuerpoPersonalizado(15,number_format($gas,2,",",""),0,"R",1,"","9"); 
    $pdf->CuadroCuerpoPersonalizado(15,number_format($total,2,",",""),1,"R",1,"B","9"); 
    $pdf->ln();
    $TotalMaximo['subtotal']+=$subtotal;
    $TotalMaximo['gasto']+=$gas;
    $TotalMaximo['total']+=$total;
}
$pdf->CuadroCuerpoPersonalizado(20,"Total",1,"C",1,"B","9");
foreach($TotalMaximo as $TM){
     $pdf->CuadroCuerpoPersonalizado(15,number_format($TM,2,",",""),1,"R",1,"B","9");  
}
$pdf->ln();
$pdf->ln();
/*FINAL DE  VENTAS Y ENTREGAS*/


/*INICIO BANCOS*/
$pdf->CuadroCuerpoPersonalizado(80,"Depositos y Retiros",0,"",0,"UB");
$pdf->ln();
$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(20,"",0,"C",0,"B","9");
$bancos=$banco->mostrarTodoRegistro("",1,"Nombre");
foreach($bancos as $b){
    $pdf->CuadroCuerpoPersonalizado(48,$b['Nombre']."-".$b['NumeroCuenta'],1,"C",1,"B","8");
}
$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(20,"Fecha",1,"C",1,"B","9");
foreach($bancos as $b){
    $pdf->CuadroCuerpoPersonalizado(12,"Mañana",1,"C",1,"B","8");
    $pdf->CuadroCuerpoPersonalizado(12,"Tarde",1,"C",1,"B","8");
    $pdf->CuadroCuerpoPersonalizado(12,"Retiro",1,"C",1,"B","8");
    $pdf->CuadroCuerpoPersonalizado(12,"Subtotal",1,"C",1,"B","8");
}
$pdf->CuadroCuerpoPersonalizado(12,"Total",1,"C",1,"B","9");
$pdf->ln();
$TotalMaximo=array();
for($fi=strtotime($FechaInicio);$fi<=strtotime($FechaFinal);$fi=$fi+86400){
    $Fecha=(date("Y-m-d",$fi));
    $pdf->CuadroCuerpoPersonalizado(20,fecha2Str($Fecha),1,"C",1,"","9");
    $total=0;
    foreach($bancos as $b){
        $subtotal=0;
        $bancodeposito->campos=array("SUM(`Monto`)  as Total");
        $bm=$bancodeposito->MostrarTodoRegistro("FechaDeposito = '$Fecha' and `Turno`= 'M'and CodBanco=".$b['CodBanco'],"","");
        $bm=array_shift($bm);
        $manana=$bm['Total'];
        $bancodeposito->campos=array("SUM(`Monto`)  as Total");
        $bt=$bancodeposito->MostrarTodoRegistro("FechaDeposito = '$Fecha' and `Turno`= 'T' and CodBanco=".$b['CodBanco'],"","");
        $bt=array_shift($bt);
        $tarde=$bt['Total'];
        
        $bancoretiro->campos=array("SUM(`Monto`)  as Total");
        $br=$bancoretiro->MostrarTodoRegistro("FechaRetiro ='$Fecha' and CodBanco=".$b['CodBanco']);
        $br=array_shift($br);
        $ret=$br['Total'];
        $subtotal+=$manana+$tarde-$ret;
        $pdf->CuadroCuerpoPersonalizado(12,number_format($manana,2,",",""),0,"R",1,"","8"); 
        $pdf->CuadroCuerpoPersonalizado(12,number_format($tarde,2,",",""),0,"R",1,"","8"); 
        $pdf->CuadroCuerpoPersonalizado(12,number_format($ret,2,",",""),0,"R",1,"","8"); 
        $pdf->CuadroCuerpoPersonalizado(12,number_format($subtotal,2,",",""),1,"R",1,"B","8"); 
        $total+=$subtotal;
        $TotalMaximo['M'.$b['CodBanco']]+=$manana;
        $TotalMaximo['T'.$b['CodBanco']]+=$tarde;
        $TotalMaximo['R'.$b['CodBanco']]+=$ret;
        $TotalMaximo['ST'.$b['CodBanco']]+=$subtotal;
    }
    $pdf->CuadroCuerpoPersonalizado(12,number_format($total,2,",",""),1,"R",1,"B","8"); 
    $pdf->ln();

    $TotalMaximo['total']+=$total;
}
$pdf->CuadroCuerpoPersonalizado(20,"Total",1,"C",1,"B","9");
foreach($TotalMaximo as $TM){
     $pdf->CuadroCuerpoPersonalizado(12,number_format($TM,2,",",""),1,"R",1,"B","8");  
}
/*FINAL DE  BANCO DEPOSITO*/
$pdf->Output("Reporte.pdf","I");
?>