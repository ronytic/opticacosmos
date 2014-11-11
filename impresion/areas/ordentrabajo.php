<?php
include_once("../../login/check.php");
include_once("../pdfs.php");
$titulo=$idioma['DatosPaciente'];

$Cod=$_GET['Cod'];
include_once("../../class/optica.php");
$optica=new optica;
$opt=$optica->mostrarRegistro($Cod);
$opt=array_shift($opt);

include_once("../../class/paciente.php");
$paciente=new paciente;
$pac=$paciente->mostrarPaciente($opt['CodPaciente']);
$pac=array_shift($pac);

include_once("../../class/producto.php");
$producto=new producto;

$prod1=$producto->mostrarTodoRegistro("CodProducto=".$opt['CodProducto1']);
$prod1=array_shift($prod1);

$prod2=$producto->mostrarTodoRegistro("CodProducto=".$opt['CodProducto2']);
$prod2=array_shift($prod2);

$prod3=$producto->mostrarTodoRegistro("CodProducto=".$opt['CodProducto3']);
$prod3=array_shift($prod3);

$prod4=$producto->mostrarTodoRegistro("CodProducto=".$opt['CodProducto4']);
$prod4=array_shift($prod4);

include_once("../../class/usuario.php");
$usuario=new usuario;
$datosUsuario=$usuario->mostrarDatos($opt['CodUsuario']);
$datosUsuario=array_shift($datosUsuario);

class PDF extends PPDF{
	function CuadroCuerpo($txtAncho,$txt,$relleno=0,$align="L",$borde=1,$tam=9,$tipo=""){
		$this->Fuente($tipo,$tam);
		$this->Cell($txtAncho,5,utf8_decode($txt),$borde,0,$align,$relleno);	
	}
	function Fuente($tipo="B",$tam=10){
		$this->SetFillColor(234,234,234);
		$this->SetFont("Arial",$tipo,$tam);	
	}
}
$pdf=new PDF("P","mm",array(298,208));
$pdf->SetAutoPageBreak(0,0);
$pdf->Fuente("");
$pdf->AddPage();
$x=0;
$pdf->SetXY($x+110,43);
$pdf->CuadroCuerpo(30,fecha2Str($opt['FechaRegistro']),0,"C");

$pdf->SetXY($x+25,51);
$pdf->CuadroCuerpo(110,$pac['Paterno']." ".$pac['Materno']." ".$pac['Nombres'],0,"C",1,11);

$pdf->SetXY($x+25,60);
$pdf->CuadroCuerpo(110,$datosUsuario['Paterno']." ".$datosUsuario['Materno']." ".$datosUsuario['Nombres'],0,"C",1,11);
//Lejos OD
$pdf->SetXY($x+24,79);
$pdf->CuadroCuerpo(19,$opt['LODEsferico'],0,"C",1,11);
$pdf->SetXY($x+43,79);
$pdf->CuadroCuerpo(19,$opt['LODCilindrico'],0,"C",1,11);
$pdf->SetXY($x+62,79);
$pdf->CuadroCuerpo(19,$opt['LODEje'],0,"C",1,11);
$pdf->SetXY($x+81,79);
$pdf->CuadroCuerpo(19,$opt['LODPrisma'],0,"C",1,11);
$pdf->SetXY($x+100,79);
$pdf->CuadroCuerpo(19,$opt['LODBase'],0,"C",1,11);
$pdf->SetXY($x+119,79);
$pdf->CuadroCuerpo(19,$opt['LODAdd'],0,"C",1,11);

//Lejos OI
$pdf->SetXY($x+24,86);
$pdf->CuadroCuerpo(19,$opt['LOIEsferico'],0,"C",1,11);
$pdf->SetXY($x+43,86);
$pdf->CuadroCuerpo(19,$opt['LOICilindrico'],0,"C",1,11);
$pdf->SetXY($x+62,86);
$pdf->CuadroCuerpo(19,$opt['LOIEje'],0,"C",1,11);
$pdf->SetXY($x+81,86);
$pdf->CuadroCuerpo(19,$opt['LOIPrisma'],0,"C",1,11);
$pdf->SetXY($x+100,86);
$pdf->CuadroCuerpo(19,$opt['LOIBase'],0,"C",1,11);
$pdf->SetXY($x+119,86);
$pdf->CuadroCuerpo(19,$opt['LOIAdd'],0,"C",1,11);

//Lejos OI
$pdf->SetXY($x+24,86);
$pdf->CuadroCuerpo(19,$opt['LOIEsferico'],0,"C",1,11);
$pdf->SetXY($x+43,86);
$pdf->CuadroCuerpo(19,$opt['LOICilindrico'],0,"C",1,11);
$pdf->SetXY($x+62,86);
$pdf->CuadroCuerpo(19,$opt['LOIEje'],0,"C",1,11);
$pdf->SetXY($x+81,86);
$pdf->CuadroCuerpo(19,$opt['LOIPrisma'],0,"C",1,11);
$pdf->SetXY($x+100,86);
$pdf->CuadroCuerpo(19,$opt['LOIBase'],0,"C",1,11);
$pdf->SetXY($x+119,86);
$pdf->CuadroCuerpo(19,$opt['LOIAdd'],0,"C",1,11);

//Cerca OD
$pdf->SetXY($x+24,92);
$pdf->CuadroCuerpo(19,$opt['CODEsferico'],0,"C",1,11);
$pdf->SetXY($x+43,92);
$pdf->CuadroCuerpo(19,$opt['CODCilindrico'],0,"C",1,11);
$pdf->SetXY($x+62,92);
$pdf->CuadroCuerpo(19,$opt['CODEje'],0,"C",1,11);
$pdf->SetXY($x+81,92);
$pdf->CuadroCuerpo(19,$opt[''],0,"C",1,11);
$pdf->SetXY($x+100,92);
$pdf->CuadroCuerpo(19,$opt[''],0,"C",1,11);
$pdf->SetXY($x+119,92);
$pdf->CuadroCuerpo(19,$opt[''],0,"C",1,11);

//Cerca OI
$pdf->SetXY($x+24,97);
$pdf->CuadroCuerpo(19,$opt['COIEsferico'],0,"C",1,11);
$pdf->SetXY($x+43,97);
$pdf->CuadroCuerpo(19,$opt['COICilindrico'],0,"C",1,11);
$pdf->SetXY($x+62,97);
$pdf->CuadroCuerpo(19,$opt['COIEje'],0,"C",1,11);
$pdf->SetXY($x+81,97);
$pdf->CuadroCuerpo(19,$opt['COIAltura'],0,"C",1,11);
$pdf->SetXY($x+100,97);
$pdf->CuadroCuerpo(19,$opt['COIDPLejos'],0,"C",1,11);
$pdf->SetXY($x+119,97);
$pdf->CuadroCuerpo(19,$opt['COIDPCerca'],0,"C",1,11);

//Armazon Lejos
$pdf->SetXY($x+35,104);
$pdf->CuadroCuerpo(100,$prod1['Nombre']." - ".($opt['Detalle1']),0,"L",1,11);
//Armazon Cerca
$pdf->SetXY($x+35,112);
$pdf->CuadroCuerpo(100,$prod2['Nombre']." - ".($opt['Detalle2']),0,"L",1,11);

//Armazon Lejos
$pdf->SetXY($x+35,120);
$pdf->CuadroCuerpo(85,$prod3['Nombre']." - ".($opt['Detalle3']),0,"L",1,11);
$pdf->SetXY($x+122,120);
$pdf->CuadroCuerpo(12,($opt['Vitrina3']),0,"R",1,11);
//Armazon Cerca
$pdf->SetXY($x+35,129);
$pdf->CuadroCuerpo(85,$prod4['Nombre']." - ".($opt['Detalle4']),0,"L",1,11);

$pdf->SetXY($x+122,129);
$pdf->CuadroCuerpo(12,($opt['Vitrina4']),0,"R",1,11);

//Monto Sus
$pdf->SetXY($x+94,145);
$pdf->CuadroCuerpo(20,($opt['TotalSus']),0,"R",1,11);
$pdf->SetXY($x+94,151);
$pdf->CuadroCuerpo(20,($opt['ACuentaSus']),0,"R",1,11);
$pdf->SetXY($x+94,156);
$pdf->CuadroCuerpo(20,($opt['SaldoSus']),0,"R",1,11);
$pdf->SetXY($x+94,161.5);
$pdf->CuadroCuerpo(20,($opt['DescuentoSus']),0,"R",1,11);
$pdf->SetXY($x+94,167);
$pdf->CuadroCuerpo(20,($opt['CobrarSus']),0,"R",1,11);

//Monto Bs
$pdf->SetXY($x+115,145);
$pdf->CuadroCuerpo(23,($opt['TotalBs']),0,"R",1,11);
$pdf->SetXY($x+115,151);
$pdf->CuadroCuerpo(23,($opt['ACuentaBs']),0,"R",1,11);
$pdf->SetXY($x+115,156);
$pdf->CuadroCuerpo(23,($opt['SaldoBs']),0,"R",1,11);
$pdf->SetXY($x+115,161.5);
$pdf->CuadroCuerpo(23,($opt['DescuentoBs']),0,"R",1,11);
$pdf->SetXY($x+115,167);
$pdf->CuadroCuerpo(23,($opt['CobrarBs']),0,"R",1,11);

//Fecha, Entrega, Telefono
$pdf->SetXY($x+35,178);
$pdf->CuadroCuerpo(30,fecha2Str($opt['FechaEntrega']),0,"C",1,11);
$pdf->SetXY($x+35,187);
$pdf->CuadroCuerpo(30,($opt['HoraEntrega']),0,"C",1,11);
$pdf->SetXY($x+35,195);
$pdf->CuadroCuerpo(30,($pac['Celular']),0,"C",1,11);



$x=148;
$pdf->SetXY($x+110,43);
$pdf->CuadroCuerpo(30,fecha2Str($opt['FechaRegistro']),0,"C");

$pdf->SetXY($x+25,51);
$pdf->CuadroCuerpo(110,$pac['Paterno']." ".$pac['Materno']." ".$pac['Nombres'],0,"C",1,11);

$pdf->SetXY($x+25,60);
$pdf->CuadroCuerpo(110,$datosUsuario['Paterno']." ".$datosUsuario['Materno']." ".$datosUsuario['Nombres'],0,"C",1,11);

//Lejos OD
$pdf->SetXY($x+24,79);
$pdf->CuadroCuerpo(19,$opt['LODEsferico'],0,"C",1,11);
$pdf->SetXY($x+43,79);
$pdf->CuadroCuerpo(19,$opt['LODCilindrico'],0,"C",1,11);
$pdf->SetXY($x+62,79);
$pdf->CuadroCuerpo(19,$opt['LODEje'],0,"C",1,11);
$pdf->SetXY($x+81,79);
$pdf->CuadroCuerpo(19,$opt['LODPrisma'],0,"C",1,11);
$pdf->SetXY($x+100,79);
$pdf->CuadroCuerpo(19,$opt['LODBase'],0,"C",1,11);
$pdf->SetXY($x+119,79);
$pdf->CuadroCuerpo(19,$opt['LODAdd'],0,"C",1,11);

//Lejos OI
$pdf->SetXY($x+24,86);
$pdf->CuadroCuerpo(19,$opt['LOIEsferico'],0,"C",1,11);
$pdf->SetXY($x+43,86);
$pdf->CuadroCuerpo(19,$opt['LOICilindrico'],0,"C",1,11);
$pdf->SetXY($x+62,86);
$pdf->CuadroCuerpo(19,$opt['LOIEje'],0,"C",1,11);
$pdf->SetXY($x+81,86);
$pdf->CuadroCuerpo(19,$opt['LOIPrisma'],0,"C",1,11);
$pdf->SetXY($x+100,86);
$pdf->CuadroCuerpo(19,$opt['LOIBase'],0,"C",1,11);
$pdf->SetXY($x+119,86);
$pdf->CuadroCuerpo(19,$opt['LOIAdd'],0,"C",1,11);

//Lejos OI
$pdf->SetXY($x+24,86);
$pdf->CuadroCuerpo(19,$opt['LOIEsferico'],0,"C",1,11);
$pdf->SetXY($x+43,86);
$pdf->CuadroCuerpo(19,$opt['LOICilindrico'],0,"C",1,11);
$pdf->SetXY($x+62,86);
$pdf->CuadroCuerpo(19,$opt['LOIEje'],0,"C",1,11);
$pdf->SetXY($x+81,86);
$pdf->CuadroCuerpo(19,$opt['LOIPrisma'],0,"C",1,11);
$pdf->SetXY($x+100,86);
$pdf->CuadroCuerpo(19,$opt['LOIBase'],0,"C",1,11);
$pdf->SetXY($x+119,86);
$pdf->CuadroCuerpo(19,$opt['LOIAdd'],0,"C",1,11);

//Cerca OD
$pdf->SetXY($x+24,92);
$pdf->CuadroCuerpo(19,$opt['CODEsferico'],0,"C",1,11);
$pdf->SetXY($x+43,92);
$pdf->CuadroCuerpo(19,$opt['CODCilindrico'],0,"C",1,11);
$pdf->SetXY($x+62,92);
$pdf->CuadroCuerpo(19,$opt['CODEje'],0,"C",1,11);
$pdf->SetXY($x+81,92);
$pdf->CuadroCuerpo(19,$opt[''],0,"C",1,11);
$pdf->SetXY($x+100,92);
$pdf->CuadroCuerpo(19,$opt[''],0,"C",1,11);
$pdf->SetXY($x+119,92);
$pdf->CuadroCuerpo(19,$opt[''],0,"C",1,11);

//Cerca OI
$pdf->SetXY($x+24,97);
$pdf->CuadroCuerpo(19,$opt['COIEsferico'],0,"C",1,11);
$pdf->SetXY($x+43,97);
$pdf->CuadroCuerpo(19,$opt['COICilindrico'],0,"C",1,11);
$pdf->SetXY($x+62,97);
$pdf->CuadroCuerpo(19,$opt['COIEje'],0,"C",1,11);
$pdf->SetXY($x+81,97);
$pdf->CuadroCuerpo(19,$opt['COIAltura'],0,"C",1,11);
$pdf->SetXY($x+100,97);
$pdf->CuadroCuerpo(19,$opt['COIDPLejos'],0,"C",1,11);
$pdf->SetXY($x+119,97);
$pdf->CuadroCuerpo(19,$opt['COIDPCerca'],0,"C",1,11);

//Cristales Lejos
$pdf->SetXY($x+35,104);
$pdf->CuadroCuerpo(100,$prod1['Nombre']." - ".($opt['Detalle1']),0,"L",1,11);
//Cristales Cerca
$pdf->SetXY($x+35,112);
$pdf->CuadroCuerpo(100,$prod2['Nombre']." - ".($opt['Detalle2']),0,"L",1,11);

//Armazon Lejos
$pdf->SetXY($x+35,120);
$pdf->CuadroCuerpo(85,$prod3['Nombre']." - ".($opt['Detalle3']),0,"L",1,11);
$pdf->SetXY($x+122,120);
$pdf->CuadroCuerpo(12,($opt['Vitrina3']),0,"R",1,11);
//Armazon Cerca
$pdf->SetXY($x+35,129);
$pdf->CuadroCuerpo(85,$prod4['Nombre']." - ".($opt['Detalle4']),0,"L",1,11);

$pdf->SetXY($x+122,129);
$pdf->CuadroCuerpo(12,($opt['Vitrina4']),0,"R",1,11);

//Monto Sus
$pdf->SetXY($x+94,145);
$pdf->CuadroCuerpo(20,($opt['TotalSus']),0,"R",1,11);
$pdf->SetXY($x+94,151);
$pdf->CuadroCuerpo(20,($opt['ACuentaSus']),0,"R",1,11);
$pdf->SetXY($x+94,156);
$pdf->CuadroCuerpo(20,($opt['SaldoSus']),0,"R",1,11);
$pdf->SetXY($x+94,161.5);
$pdf->CuadroCuerpo(20,($opt['DescuentoSus']),0,"R",1,11);
$pdf->SetXY($x+94,167);
$pdf->CuadroCuerpo(20,($opt['CobrarSus']),0,"R",1,11);

//Monto Bs
$pdf->SetXY($x+115,145);
$pdf->CuadroCuerpo(23,($opt['TotalBs']),0,"R",1,11);
$pdf->SetXY($x+115,151);
$pdf->CuadroCuerpo(23,($opt['ACuentaBs']),0,"R",1,11);
$pdf->SetXY($x+115,156);
$pdf->CuadroCuerpo(23,($opt['SaldoBs']),0,"R",1,11);
$pdf->SetXY($x+115,161.5);
$pdf->CuadroCuerpo(23,($opt['DescuentoBs']),0,"R",1,11);
$pdf->SetXY($x+115,167);
$pdf->CuadroCuerpo(23,($opt['CobrarBs']),0,"R",1,11);

//Fecha, Entrega, Telefono
$pdf->SetXY($x+35,178);
$pdf->CuadroCuerpo(30,fecha2Str($opt['FechaEntrega']),0,"C",1,11);
$pdf->SetXY($x+35,187);
$pdf->CuadroCuerpo(30,($opt['HoraEntrega']),0,"C",1,11);
$pdf->SetXY($x+35,195);
$pdf->CuadroCuerpo(30,($pac['Celular']),0,"C",1,11);

$pdf->Output();

?>