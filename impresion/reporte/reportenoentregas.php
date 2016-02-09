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
include_once("../../class/usuario.php");
$usuario=new usuario;

if($_GET['CodUsuarioAsignado']==""){
	$idusuario=$_SESSION['CodUsuarioLog'];
}else{
	$idusuario=$_GET['CodUsuarioAsignado'];
}

$datosUsuario=$usuario->mostrarDatos($idusuario);
$datosUsuario=array_shift($datosUsuario);
$Apodo=$datosUsuario['Nick'];
$ApellidoPSis=$datosUsuario['Paterno'];
$ApellidoMSis=$datosUsuario['Materno'];
$NombresSis=$datosUsuario['Nombres'];
$FotoSis=$datosUsuario['Foto'];
$FechaIncio=$_GET['Desde'];
$FechaFinal=$_GET['Hasta'];


$ApellidoPSis="";
$ApellidoMSis="";
$NombresSis="Todos los usuarios";
$opt=$optica->MostrarTodoRegistro("FechaEntrega BETWEEN '$FechaIncio' and '$FechaFinal' and EstadoEntrega=0 and Emitido=1","1","FechaEntrega,NumeroBoleta");

//$opt=$optica->MostrarTodoRegistro("FechaRegistro BETWEEN '$FechaIncio' and '$FechaFinal' and CodUsuario=$idusuario and EstadoEntrega=0","","FechaRegistro,NumeroBoleta");

$titulo="Planilla de Trabajos No Entregados";
class PDF extends PPDF{
	function Cabecera(){
		global $ApellidoPSis,$ApellidoMSis,$NombresSis,$TC;
		$this->CuadroCabecera(25,"Reporte de:",80,$ApellidoPSis." ".$ApellidoMSis." ".$NombresSis);
		$this->CuadroCabecera(10,"T/C:",60,$TC);
		$this->Pagina();
		$this->Ln();
		$this->TituloCabecera(10,"N",8);
		$this->TituloCabecera(15,"N Orden",8);
		$this->TituloCabecera(20,"FechaIngreso",8);
		$this->TituloCabecera(15,"HIngreso",8);

		$this->TituloCabecera(40,"Cliente",8);
		/*$this->TituloCabecera(25,"Tipo Cristal",8);
		$this->TituloCabecera(35,"Armazon",8);
		$this->TituloCabecera(25,"Tipo Cristal",8);
		$this->TituloCabecera(35,"Armazon",8);*/
		$this->TituloCabecera(15,"Monto Bs",8);
		$this->TituloCabecera(15,"ACta Bs",8);
		$this->TituloCabecera(15,"ACta \$us",8);
		$this->TituloCabecera(20,"Saldo a Cobrar",8);
		$this->TituloCabecera(20,"F Entrega",8);
		$this->TituloCabecera(35,"Observación",8);
		$this->TituloCabecera(35,"Usuario",8);
	}
}
$pdf=new PDF("L","mm","letter");
$pdf->AddPage();




$pdf->SetWidths(array(10,15,20,15,40,15,15,15,20,20,35,35));
$pdf->Fuente("",9);
$pdf->SetAligns(array("R","C","","R","L","R","R","R","R","R"));
$TTotalBs=0;
$contadorUsuario=0;
foreach($opt as $o){
	if($contadorUsuario!=$idusuario){
		//$i=0;
		$contadorUsuario=$idusuario;
	}
	$i++;
	$idusuario=$o['CodUsuarioEmitido'];
	$datosUsuario=$usuario->mostrarDatos($idusuario);
	$datosUsuario=array_shift($datosUsuario);

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

	
	$TTotalBs+=$TotalBs;
	$TACuentaBs+=$ACuentaBs;
	$TACuentaSus+=$ACuentaSus;
	$TSaldoBs+=$SaldoBs;
	$TDescuentoBs+=$DescuentoBs;
	$TCobrarBs+=$CobrarBs;
	
	$datos=array($i,
			$o['NumeroBoleta'],
			fecha2Str($o['FechaEmitido'])." ".$o['HoraEmitido'],
			$o['HoraEmitido'],
			utf8_decode(mb_strtoupper($pac['Paterno']." ".$pac['Materno']." ".$pac['Nombres'],"utf8"))." Cel: ".$pac['Celular'],
			//$prod1['Nombre']." - ".$o['Detalle1'],
			//$prod2['Nombre']." - ".$o['Detalle2'],
			//$prod3['Nombre']." - ".$o['Detalle3'],
			//$prod4['Nombre']." - ".$o['Detalle4'],
			$TotalBs,
			$ACuentaBs,
			$ACuentaSus,
			$SaldoBs,
			fecha2Str($o['FechaEntrega']),
			
			utf8_decode(mb_strtoupper($o['Observaciones'],"utf8")),
			utf8_decode(mb_strtoupper($datosUsuario['Paterno']." ".$datosUsuario['Materno']." ".$datosUsuario['Nombres'],"utf8")),
			
	);
	$pdf->Row($datos);	
}
	$TTotalBs=number_format($TTotalBs,2,".","");
	$TAcuentaBs=number_format($TACuentaBs,2,".","");
	$TACuentaSus=number_format($TACuentaSus,2,".","");
	$TSaldoBs=number_format($TSaldoBs,2,".","");
	$TDescuentoBs=number_format($TDescuentoBs,2,".","");
	$TCobrarBs=number_format($TCobrarBs,2,".","");
	$pdf->Fuente("B",9);
	$pdf->CuadroCuerpo(100,"Total",0,"R",0,9,"B");
	$pdf->CuadroCuerpo(15,$TTotalBs,1,"R",1,9,"B");
	$pdf->CuadroCuerpo(15,$TAcuentaBs,1,"R",1,9,"B");
	$pdf->CuadroCuerpo(15,$TACuentaSus,1,"R",1,9,"B");
	$pdf->CuadroCuerpo(20,$TSaldoBs,1,"R",1,9,"B");
	$pdf->Output("Reporte.pdf","I");
?>