<?php
include_once("../../login/check.php");
include_once("../pdfs.php");
$titulo=$idioma['DatosPaciente'];
function dec($num){
	return number_format($num,2);	
}
$Cod=$_GET['Cod'];
include_once("../../class/optica.php");
$optica=new optica;
$opt=$optica->mostrarRegistro($Cod);
$opt=array_shift($opt);

include_once("../../class/medico.php");
$medico=new medico;

include_once("../../class/paciente.php");
$paciente=new paciente;
$pac=$paciente->mostrarPaciente($opt['CodPaciente']);
$pac=array_shift($pac);

include_once("../../class/productotipo.php");
$productotipo=new productotipo;

include_once("../../class/producto.php");
$producto=new producto;

$prodtip1=$productotipo->mostrarTodoRegistro("CodProductoTipo=".$opt['CodProductoTipo1']);
$prodtip1=array_shift($prodtip1);

$prodtip2=$productotipo->mostrarTodoRegistro("CodProductoTipo=".$opt['CodProductoTipo2']);
$prodtip2=array_shift($prodtip2);

$prodtip3=$productotipo->mostrarTodoRegistro("CodProductoTipo=".$opt['CodProductoTipo3']);
$prodtip3=array_shift($prodtip3);

$prodtip4=$productotipo->mostrarTodoRegistro("CodProductoTipo=".$opt['CodProductoTipo4']);
$prodtip4=array_shift($prodtip4);


$prod1=$producto->mostrarTodoRegistro("CodProducto=".$opt['CodProducto1']);
$prod1=array_shift($prod1);

$prod2=$producto->mostrarTodoRegistro("CodProducto=".$opt['CodProducto2']);
$prod2=array_shift($prod2);

$prod3=$producto->mostrarTodoRegistro("CodProducto=".$opt['CodProducto3']);
$prod3=array_shift($prod3);

$prod4=$producto->mostrarTodoRegistro("CodProducto=".$opt['CodProducto4']);
$prod4=array_shift($prod4);

$med=$medico->mostrarRegistro($opt['CodMedico']);
$med=array_shift($med);

include_once("../../class/usuario.php");
$usuario=new usuario;
$datosUsuario=$usuario->mostrarDatos($opt['CodUsuarioEmitido']);
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
    function CuadroCuerpoMulti($txtAncho,$txt,$relleno=0,$align="L",$borde=1,$tam=9,$tipo=""){
        $this->Fuente($tipo,$tam);
        $this->MultiCell($txtAncho,3.5,utf8_decode($txt),$borde,$align,$relleno);	
    }
}
$borde=0;
$pdf=new PDF("P","mm",array(298,208));
$pdf->SetAutoPageBreak(0,0);
$pdf->Fuente("");
$pdf->AddPage();
$x=0;
$TipoDoc="Archivo";

$pdf->SetXY($x+25,35);
$pdf->CuadroCuerpo(30,$TipoDoc,0,"L",$borde,11);


$pdf->SetXY($x+70,5);
$pdf->CuadroCuerpo(60,"Dr(a). ".mayuscula($med['Nombres']." ".$med['Paterno']." ".$med['Materno']),0,"L",$borde,10);
$pdf->SetXY($x+80,10);
$pdf->CuadroCuerpo(60,$opt['CodOptica']." - ".$opt['NumeroBoleta'],0,"C",$borde,10);

$pdf->SetXY($x+108,40);
$pdf->CuadroCuerpo(30,fecha2Str($opt['FechaEmitido']),0,"C",$borde,11);
$pdf->SetXY($x+108,43);
$pdf->CuadroCuerpo(30,($opt['HoraEmitido']),0,"C",$borde,10);

$pdf->SetXY($x+25,47);
$pdf->CuadroCuerpo(110,mayuscula($pac['Nombres']." ".$pac['Paterno']." ".$pac['Materno']." "),0,"C",$borde,12);

$pdf->SetXY($x+25,56);
$pdf->CuadroCuerpo(110,mayuscula($datosUsuario['Nombres']." ".$datosUsuario['Paterno']." ".$datosUsuario['Materno'])." ",0,"C",$borde,12);
//Lejos OD
$pdf->SetXY($x+21,76);
$pdf->CuadroCuerpo(19,$opt['LODEsferico'],0,"C",$borde,11);
$pdf->SetXY($x+40,76);
$pdf->CuadroCuerpo(19,$opt['LODCilindrico'],0,"C",$borde,11);
$pdf->SetXY($x+59,76);
$pdf->CuadroCuerpo(19,$opt['LODEje'],0,"C",$borde,11);
$pdf->SetXY($x+78,76);
$pdf->CuadroCuerpo(19,$opt['LODPrisma'],0,"C",$borde,11);
$pdf->SetXY($x+97,76);
$pdf->CuadroCuerpo(19,$opt['LODBase'],0,"C",$borde,11);
$pdf->SetXY($x+116,76);
$pdf->CuadroCuerpo(19,$opt['LODAdd'],0,"C",$borde,11);

//Lejos OI
$pdf->SetXY($x+21,81);
$pdf->CuadroCuerpo(19,$opt['LOIEsferico'],0,"C",$borde,11);
$pdf->SetXY($x+40,81);
$pdf->CuadroCuerpo(19,$opt['LOICilindrico'],0,"C",$borde,11);
$pdf->SetXY($x+59,81);
$pdf->CuadroCuerpo(19,$opt['LOIEje'],0,"C",$borde,11);
$pdf->SetXY($x+78,81);
$pdf->CuadroCuerpo(19,$opt['LOIPrisma'],0,"C",$borde,11);
$pdf->SetXY($x+97,81);
$pdf->CuadroCuerpo(19,$opt['LOIBase'],0,"C",$borde,11);
$pdf->SetXY($x+116,81);
$pdf->CuadroCuerpo(19,$opt['LOIAdd'],0,"C",$borde,11);
/*
//Lejos OI
$pdf->SetXY($x+24,86);
$pdf->CuadroCuerpo(19,$opt['LOIEsferico'],0,"C",$borde,11);
$pdf->SetXY($x+43,86);
$pdf->CuadroCuerpo(19,$opt['LOICilindrico'],0,"C",$borde,11);
$pdf->SetXY($x+62,86);
$pdf->CuadroCuerpo(19,$opt['LOIEje'],0,"C",$borde,11);
$pdf->SetXY($x+81,86);
$pdf->CuadroCuerpo(19,$opt['LOIPrisma'],0,"C",$borde,11);
$pdf->SetXY($x+100,86);
$pdf->CuadroCuerpo(19,$opt['LOIBase'],0,"C",$borde,11);
$pdf->SetXY($x+119,86);
$pdf->CuadroCuerpo(19,$opt['LOIAdd'],0,"C",$borde,11);
*/
//Cerca OD
$pdf->SetXY($x+21,90);
$pdf->CuadroCuerpo(19,$opt['CODEsferico'],0,"C",$borde,11);
$pdf->SetXY($x+40,90);
$pdf->CuadroCuerpo(19,$opt['CODCilindrico'],0,"C",$borde,11);
$pdf->SetXY($x+59,90);
$pdf->CuadroCuerpo(19,$opt['CODEje'],0,"C",$borde,11);
$pdf->SetXY($x+78,90);
$pdf->CuadroCuerpo(19,$opt[''],0,"C",$borde,11);
$pdf->SetXY($x+97,90);
$pdf->CuadroCuerpo(19,$opt[''],0,"C",$borde,11);
$pdf->SetXY($x+116,90);
$pdf->CuadroCuerpo(19,$opt[''],0,"C",$borde,11);

//Cerca OI
$pdf->SetXY($x+21,94);
$pdf->CuadroCuerpo(19,$opt['COIEsferico'],0,"C",$borde,11);
$pdf->SetXY($x+40,94);
$pdf->CuadroCuerpo(19,$opt['COICilindrico'],0,"C",$borde,11);
$pdf->SetXY($x+59,94);
$pdf->CuadroCuerpo(19,$opt['COIEje'],0,"C",$borde,11);
$pdf->SetXY($x+78,94);
$pdf->CuadroCuerpo(19,$opt['COIAltura'],0,"C",$borde,11);
$pdf->SetXY($x+97,94);
$pdf->CuadroCuerpo(19,$opt['COIDPLejos'],0,"C",$borde,11);
$pdf->SetXY($x+116,94);
$pdf->CuadroCuerpo(19,$opt['COIDPCerca'],0,"C",$borde,11);

//Armazon Lejos
$pdf->SetXY($x+35,102);
$pdf->CuadroCuerpoMulti(100,$prodtip1['Nombre']." - ".$prod1['Nombre']." - ".utf8_decode(mb_strtoupper($opt['Detalle1'],"utf8")),0,"L",$borde,11);
//Armazon Cerca
$pdf->SetXY($x+35,110);
$pdf->CuadroCuerpoMulti(100,$prodtip2['Nombre']." - ".$prod2['Nombre']." - ".utf8_decode(mb_strtoupper($opt['Detalle2'],"utf8")),0,"L",$borde,11);

//Armazon Lejos
$pdf->SetXY($x+35,118);
$pdf->CuadroCuerpoMulti(85,$prodtip3['Nombre']." - ".$prod3['Nombre']." - ".utf8_decode(mb_strtoupper($opt['Detalle3'],"utf8")),0,"L",$borde,11);
$pdf->SetXY($x+122,118);
$pdf->CuadroCuerpo(12,($opt['Vitrina3']),0,"R",$borde,11);
//Armazon Cerca
$pdf->SetXY($x+35,127);
$pdf->CuadroCuerpoMulti(85,$prodtip4['Nombre']." - ".$prod4['Nombre']." - ".utf8_decode(mb_strtoupper($opt['Detalle4'],"utf8")),0,"L",$borde,11);

$pdf->SetXY($x+122,127);
$pdf->CuadroCuerpo(12,($opt['Vitrina4']),0,"R",$borde,11);


//Observaciones
$pdf->SetXY($x+16,142);
$pdf->CuadroCuerpoMulti(65,mb_strtoupper($opt['Observaciones'],"utf8"),0,"L",0,11);

//Monto Sus
$pdf->SetXY($x+89,141);
$pdf->CuadroCuerpo(20,dec($opt['TotalSus']),0,"R",$borde,11);
$pdf->SetXY($x+89,147);
$pdf->CuadroCuerpo(20,dec($opt['ACuentaSus']),0,"R",$borde,11);
$pdf->SetXY($x+89,153);
$pdf->CuadroCuerpo(20,dec($opt['SaldoSus']),0,"R",$borde,11);
$pdf->SetXY($x+89,159);
$pdf->CuadroCuerpo(20,dec($opt['DescuentoSus']),0,"R",$borde,11);
$pdf->SetXY($x+89,165);
$pdf->CuadroCuerpo(20,dec($opt['SaldoSus']),0,"R",$borde,11);

//Monto Bs
$pdf->SetXY($x+110,141);
$pdf->CuadroCuerpo(23,dec($opt['TotalBs']),0,"R",$borde,11);
$pdf->SetXY($x+110,147);
$pdf->CuadroCuerpo(23,dec($opt['ACuentaBs']),0,"R",$borde,11);
$pdf->SetXY($x+110,153);
$pdf->CuadroCuerpo(23,dec($opt['SaldoBs']),0,"R",$borde,11);
$pdf->SetXY($x+110,159);
$pdf->CuadroCuerpo(23,dec($opt['DescuentoBs']),0,"R",$borde,11);
$pdf->SetXY($x+110,165);
$pdf->CuadroCuerpo(23,dec($opt['SaldoBs']),0,"R",$borde,11);

//Fecha, Entrega, Telefono
$pdf->SetXY($x+35,174);
$pdf->CuadroCuerpo(30,fecha2Str($opt['FechaEntrega']),0,"C",$borde,11);
$pdf->SetXY($x+35,183);
$pdf->CuadroCuerpo(30,($opt['HoraEntrega']),0,"C",$borde,11);
$pdf->SetXY($x+35,191);
$pdf->CuadroCuerpo(30,($pac['Telefono']." ".$pac['Celular']),0,"C",$borde,11);



$x=154;
$TipoDoc="Cliente";

$pdf->SetXY($x+25,35);
$pdf->CuadroCuerpo(30,$TipoDoc,0,"L",$borde,11);


$pdf->SetXY($x+70,5);
$pdf->CuadroCuerpo(60,"Dr(a). ".mayuscula($med['Nombres']." ".$med['Paterno']." ".$med['Materno']),0,"L",$borde,10);
$pdf->SetXY($x+80,10);
$pdf->CuadroCuerpo(60,$opt['CodOptica']." - ".$opt['NumeroBoleta'],0,"C",$borde,10);

$pdf->SetXY($x+108,40);
$pdf->CuadroCuerpo(30,fecha2Str($opt['FechaEmitido']),0,"C",$borde,11);
$pdf->SetXY($x+108,43);
$pdf->CuadroCuerpo(30,($opt['HoraEmitido']),0,"C",$borde,10);

$pdf->SetXY($x+25,47);
$pdf->CuadroCuerpo(110,mayuscula($pac['Nombres']." ".$pac['Paterno']." ".$pac['Materno']." "),0,"C",$borde,12);

$pdf->SetXY($x+25,56);
$pdf->CuadroCuerpo(110,mayuscula($datosUsuario['Nombres']." ".$datosUsuario['Paterno']." ".$datosUsuario['Materno'])." ",0,"C",$borde,12);
//Lejos OD
$pdf->SetXY($x+21,76);
$pdf->CuadroCuerpo(19,$opt['LODEsferico'],0,"C",$borde,11);
$pdf->SetXY($x+40,76);
$pdf->CuadroCuerpo(19,$opt['LODCilindrico'],0,"C",$borde,11);
$pdf->SetXY($x+59,76);
$pdf->CuadroCuerpo(19,$opt['LODEje'],0,"C",$borde,11);
$pdf->SetXY($x+78,76);
$pdf->CuadroCuerpo(19,$opt['LODPrisma'],0,"C",$borde,11);
$pdf->SetXY($x+97,76);
$pdf->CuadroCuerpo(19,$opt['LODBase'],0,"C",$borde,11);
$pdf->SetXY($x+116,76);
$pdf->CuadroCuerpo(19,$opt['LODAdd'],0,"C",$borde,11);

//Lejos OI
$pdf->SetXY($x+21,81);
$pdf->CuadroCuerpo(19,$opt['LOIEsferico'],0,"C",$borde,11);
$pdf->SetXY($x+40,81);
$pdf->CuadroCuerpo(19,$opt['LOICilindrico'],0,"C",$borde,11);
$pdf->SetXY($x+59,81);
$pdf->CuadroCuerpo(19,$opt['LOIEje'],0,"C",$borde,11);
$pdf->SetXY($x+78,81);
$pdf->CuadroCuerpo(19,$opt['LOIPrisma'],0,"C",$borde,11);
$pdf->SetXY($x+97,81);
$pdf->CuadroCuerpo(19,$opt['LOIBase'],0,"C",$borde,11);
$pdf->SetXY($x+116,81);
$pdf->CuadroCuerpo(19,$opt['LOIAdd'],0,"C",$borde,11);
/*
//Lejos OI
$pdf->SetXY($x+24,86);
$pdf->CuadroCuerpo(19,$opt['LOIEsferico'],0,"C",$borde,11);
$pdf->SetXY($x+43,86);
$pdf->CuadroCuerpo(19,$opt['LOICilindrico'],0,"C",$borde,11);
$pdf->SetXY($x+62,86);
$pdf->CuadroCuerpo(19,$opt['LOIEje'],0,"C",$borde,11);
$pdf->SetXY($x+81,86);
$pdf->CuadroCuerpo(19,$opt['LOIPrisma'],0,"C",$borde,11);
$pdf->SetXY($x+100,86);
$pdf->CuadroCuerpo(19,$opt['LOIBase'],0,"C",$borde,11);
$pdf->SetXY($x+119,86);
$pdf->CuadroCuerpo(19,$opt['LOIAdd'],0,"C",$borde,11);
*/
//Cerca OD
$pdf->SetXY($x+21,90);
$pdf->CuadroCuerpo(19,$opt['CODEsferico'],0,"C",$borde,11);
$pdf->SetXY($x+40,90);
$pdf->CuadroCuerpo(19,$opt['CODCilindrico'],0,"C",$borde,11);
$pdf->SetXY($x+59,90);
$pdf->CuadroCuerpo(19,$opt['CODEje'],0,"C",$borde,11);
$pdf->SetXY($x+78,90);
$pdf->CuadroCuerpo(19,$opt[''],0,"C",$borde,11);
$pdf->SetXY($x+97,90);
$pdf->CuadroCuerpo(19,$opt[''],0,"C",$borde,11);
$pdf->SetXY($x+116,90);
$pdf->CuadroCuerpo(19,$opt[''],0,"C",$borde,11);

//Cerca OI
$pdf->SetXY($x+21,94);
$pdf->CuadroCuerpo(19,$opt['COIEsferico'],0,"C",$borde,11);
$pdf->SetXY($x+40,94);
$pdf->CuadroCuerpo(19,$opt['COICilindrico'],0,"C",$borde,11);
$pdf->SetXY($x+59,94);
$pdf->CuadroCuerpo(19,$opt['COIEje'],0,"C",$borde,11);
$pdf->SetXY($x+78,94);
$pdf->CuadroCuerpo(19,$opt['COIAltura'],0,"C",$borde,11);
$pdf->SetXY($x+97,94);
$pdf->CuadroCuerpo(19,$opt['COIDPLejos'],0,"C",$borde,11);
$pdf->SetXY($x+116,94);
$pdf->CuadroCuerpo(19,$opt['COIDPCerca'],0,"C",$borde,11);

//Armazon Lejos
$pdf->SetXY($x+35,102);
$pdf->CuadroCuerpoMulti(100,$prodtip1['Nombre']." - ".$prod1['Nombre']." - ".utf8_decode(mb_strtoupper($opt['Detalle1'],"utf8")),0,"L",$borde,11);
//Armazon Cerca
$pdf->SetXY($x+35,110);
$pdf->CuadroCuerpoMulti(100,$prodtip2['Nombre']." - ".$prod2['Nombre']." - ".utf8_decode(mb_strtoupper($opt['Detalle2'],"utf8")),0,"L",$borde,11);

//Armazon Lejos
$pdf->SetXY($x+35,118);
$pdf->CuadroCuerpoMulti(85,$prodtip3['Nombre']." - ".$prod3['Nombre']." - ".utf8_decode(mb_strtoupper($opt['Detalle3'],"utf8")),0,"L",$borde,11);
$pdf->SetXY($x+122,118);
$pdf->CuadroCuerpo(12,($opt['Vitrina3']),0,"R",$borde,11);
//Armazon Cerca
$pdf->SetXY($x+35,127);
$pdf->CuadroCuerpoMulti(85,$prodtip4['Nombre']." - ".$prod4['Nombre']." - ".utf8_decode(mb_strtoupper($opt['Detalle4'],"utf8")),0,"L",$borde,11);

$pdf->SetXY($x+122,127);
$pdf->CuadroCuerpo(12,($opt['Vitrina4']),0,"R",$borde,11);


//Observaciones
$pdf->SetXY($x+16,142);
$pdf->CuadroCuerpoMulti(65,mb_strtoupper($opt['Observaciones'],"utf8"),0,"L",0,11);

//Monto Sus
$pdf->SetXY($x+89,141);
$pdf->CuadroCuerpo(20,dec($opt['TotalSus']),0,"R",$borde,11);
$pdf->SetXY($x+89,147);
$pdf->CuadroCuerpo(20,dec($opt['ACuentaSus']),0,"R",$borde,11);
$pdf->SetXY($x+89,153);
$pdf->CuadroCuerpo(20,dec($opt['SaldoSus']),0,"R",$borde,11);
$pdf->SetXY($x+89,159);
$pdf->CuadroCuerpo(20,dec($opt['DescuentoSus']),0,"R",$borde,11);
$pdf->SetXY($x+89,165);
$pdf->CuadroCuerpo(20,dec($opt['SaldoSus']),0,"R",$borde,11);

//Monto Bs
$pdf->SetXY($x+110,141);
$pdf->CuadroCuerpo(23,dec($opt['TotalBs']),0,"R",$borde,11);
$pdf->SetXY($x+110,147);
$pdf->CuadroCuerpo(23,dec($opt['ACuentaBs']),0,"R",$borde,11);
$pdf->SetXY($x+110,153);
$pdf->CuadroCuerpo(23,dec($opt['SaldoBs']),0,"R",$borde,11);
$pdf->SetXY($x+110,159);
$pdf->CuadroCuerpo(23,dec($opt['DescuentoBs']),0,"R",$borde,11);
$pdf->SetXY($x+110,165);
$pdf->CuadroCuerpo(23,dec($opt['SaldoBs']),0,"R",$borde,11);

//Fecha, Entrega, Telefono
$pdf->SetXY($x+35,174);
$pdf->CuadroCuerpo(30,fecha2Str($opt['FechaEntrega']),0,"C",$borde,11);
$pdf->SetXY($x+35,183);
$pdf->CuadroCuerpo(30,($opt['HoraEntrega']),0,"C",$borde,11);
$pdf->SetXY($x+35,191);
$pdf->CuadroCuerpo(30,($pac['Telefono']." ".$pac['Celular']),0,"C",$borde,11);

$pdf->Output();

?>