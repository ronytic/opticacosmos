<?php
include_once("../../login/check.php");
include_once("../pdf.php");
include_once("../../class/optica.php");
$optica=new optica;
include_once("../../class/paciente.php");
$paciente=new paciente;
include_once("../../class/producto.php");
$producto=new producto;
include_once("../../class/productotipo.php");
$productotipo=new productotipo;

if(!defined("Config")){
	include_once("../../class/config.php");
}
if(!isset($config)){
	$config=new config;
}
$TC=$config->mostrarConfig("TC",1);
include_once("../../class/medico.php");
$medico=new medico;

	$CodMedico=$_GET['CodMedico'];

//print_r($_GET);
//echo $idusuario;
$datosUsuario=$medico->mostrarTodoRegistro("CodMedico=".$CodMedico);
$datosUsuario=array_shift($datosUsuario);
$ApellidoP=$datosUsuario['Paterno'];
$ApellidoM=$datosUsuario['Materno'];
$Nombres=$datosUsuario['Nombres'];
$Telefono=$datosUsuario['Telefono'];
$Celular=$datosUsuario['Celular'];
$Porcentaje=$datosUsuario['Porcentaje'];

$FechaIncio=$_GET['Desde'];
$FechaFinal=$_GET['Hasta'];
$ReporteCompleto=$_GET['ReporteCompleto'];
$opt=$optica->MostrarTodoRegistro("FechaRegistro BETWEEN '$FechaIncio' and '$FechaFinal' and CodMedico=$CodMedico","","FechaRegistro,NumeroBoleta");

$titulo="Planilla de Ingreso Médico";
class PDF extends PPDF{
	function Cabecera(){
		global $ApellidoP,$ApellidoM,$Nombres,$Telefono,$ReporteCompleto,$Celular,$FechaIncio,$FechaFinal;
		$this->CuadroCabecera(30,"Reporte de: ",60,"Dr. ".$ApellidoP." ".$ApellidoM." ".$Nombres);
		$this->CuadroCabecera(20,"Teléfono: ",40,"".$Telefono." - ".$Celular);
		$this->Pagina();
		$this->Ln();
		$this->CuadroCabecera(35,"Rango de Fechas: ",60,fecha2Str($FechaIncio)."   -   ".fecha2Str($FechaFinal));
		$this->Ln();
		$this->TituloCabecera(10,"N",8);
		
		$this->TituloCabecera(20,"FechaIngreso",8);
		$this->TituloCabecera(40,"Cliente",8);
		if($ReporteCompleto==1){
			$this->TituloCabecera(20,"Total Optica",8);
			$this->TituloCabecera(20,"Desc. Optica",8);
		}
		$this->TituloCabecera(20,"Total",8);
		$this->TituloCabecera(20,"Porcentaje",8);
		//$this->TituloCabecera(20,"Total",8);
		
	}
}
$pdf=new PDF("P","mm","letter");
$pdf->AddPage();




$pdf->SetWidths(array(10,20,40,20,20,20,20,20));
$pdf->Fuente("",9);
$pdf->SetAligns(array("R","R","","R","R","R","R","R","R","R","L","L","L"));
$TTotalBs=0;
foreach($opt as $o){$i++;
	$pac=$paciente->MostrarRegistro($o['CodPaciente']);
	$pac=array_shift($pac);

	
	
	$TotalBs=number_format($o['TotalBs'],2,".","");
	$DescuentoOptica=number_format($TotalBs*(30/100),2,".","");
	
	
	$TotalBsConOptica=number_format($TotalBs-$DescuentoOptica,2,".","");
	
	$DescuentoMedico=number_format($TotalBsConOptica*($Porcentaje/100),2,".","");
	$TotalMedico=number_format($TotalBsConOptica-$DescuentoMedico,2,".","");
	
	$TTotalBs+=$TotalBs;
	$TDescuentoOptica+=$DescuentoOptica;
	$TTotalBsConOptica+=$TotalBsConOptica;
	$TDescuentoMedico+=$DescuentoMedico;
	$TTotalMedico+=$TotalMedico;

	
	
	if($ReporteCompleto==1){
		$datos=array($i,
			fecha2Str($o['FechaRegistro'])." ".$o['HoraRegistro'],
			$pac['Paterno']." ".$pac['Materno']." ".$pac['Nombres'],
			
			$TotalBs,
			$DescuentoOptica,
			
			$TotalBsConOptica,
			
			$DescuentoMedico,
			//$TotalMedico
		);
	}else{
		$datos=array($i,
			fecha2Str($o['FechaRegistro']),
			$pac['Paterno']." ".$pac['Materno']." ".$pac['Nombres'],
			
			
			
			$TotalBsConOptica,
			
			$DescuentoMedico,
			//$TotalMedico
		);	
	}
	
	$pdf->Row($datos);	
}



	$TTotalBs=number_format($TTotalBs,2,".","");
	$TDescuentoOptica=number_format($TDescuentoOptica,2,".","");
	$TTotalBsConOptica=number_format($TTotalBsConOptica,2,".","");
	$TDescuentoMedico=number_format($TDescuentoMedico,2,".","");
	$TTotalMedico=number_format($TTotalMedico,2,".","");

	$pdf->Fuente("B",9);
	$pdf->CuadroCuerpo(70,"Total",0,"R",0,9,"B");
	
	if($ReporteCompleto==1){
	$pdf->CuadroCuerpo(20,$TTotalBs,1,"R",1,9,"B");
	$pdf->CuadroCuerpo(20,$TDescuentoOptica,1,"R",1,9,"B");
	}
	$pdf->CuadroCuerpo(20,$TTotalBsConOptica,1,"R",1,9,"B");
	$pdf->CuadroCuerpo(20,$TDescuentoMedico,1,"R",1,9,"B");
	//$pdf->CuadroCuerpo(20,$TTotalMedico,1,"R",1,9,"B");

$pdf->Output("Reporte.pdf","I");
?>