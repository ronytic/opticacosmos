<?php
include_once("fpdf_protection.php");
	if(!defined("Config")){
		include_once("../../class/config.php");
	}
	if(!isset($config)){
		$config=new config;
	}
	$cnf=$config->mostrarConfig("Titulo");
	$title=$cnf['Valor'];
	$cnf=$config->mostrarConfig("Gestion");
	$gestion=$cnf['Valor'];
	$cnf=$config->mostrarConfig("Lema");
	$lema=$cnf['Valor'];
	$cnf=$config->mostrarConfig("Logo");
	$logo=$cnf['Valor'];
	class PPDF extends FPDF_Protection{
		var $ancho=176;
		function Header(){
			global $idioma;
			$this->SetTitle(utf8_decode("Sistema de Administración de Clinica"),true);
			$this->SetAuthor(utf8_decode("Sistema de Administración de Clinica Desarrollado por Ronald Nina Layme. Cel: 73230568 - www.facebook.com/ronaldnina"),true);
			$this->SetSubject(utf8_decode("Sistema de Administración de Clinica por Ronald Nina Layme. Cel: 73230568 - www.facebook.com/ronaldnina"),true);
			$this->SetCreator(utf8_decode("Sistema de Administración de Clinica por Ronald Nina Layme. Cel: 73230568 - www.facebook.com/ronaldnina"),true);
			$this->SetProtection(array('print'));
			if($this->CurOrientation=="P"){$this->ancho=176;}else{$this->ancho=246;}
			$this->SetLeftMargin(18);
			$this->SetAutoPageBreak(true,15);
			global $title,$gestion,$titulo,$logo,$idioma;
			$fecha=capitalizar(strftime("%A, %d ")).$idioma['De'].capitalizar(strftime(" %B ")).$idioma['De'].strftime(" %Y");
			
			$this->Image("../../imagenes/logos/".$logo,10,10,20,20);
			$this->Fuente("",10);
			$this->SetXY(34,12);
			$this->Cell(70,4,utf8_decode($title),0,0,"L");
			$this->Fuente("B",8);
			$this->SetXY(34,16);
			$this->Cell(70,4,utf8_decode($gestion),0,0,"L");
			$this->ln(10);	
			$this->Fuente("B",18);
			$this->Cell($this->ancho,4,utf8_decode($titulo.$this->orientation),0,5,"C");
			$this->ln(5);
			$this->CuadroCabecera(30,$idioma['FechaReporte'].": ",20,utf8_encode($fecha));
			$this->ln(5);
			if(in_array("Cabecera",get_class_methods($this))){
				$this->Cabecera();	
			}
			$this->ln();
			
			$this->Cell($this->ancho,0,"",1,1);
			$this->Ln(0.1);
		}
		function Pagina(){
			global $idioma;
			$this->AliasNbPages();
			$this->CuadroCabecera(15,$idioma['Pagina'].":",20,$this->PageNo()." ".$idioma['De']." {nb}");
		}
		function Fuente($tipo="B",$tam=10){
			$this->SetFillColor(234,234,234);
			$this->SetFont("Arial",$tipo,$tam);	
		}
		function CuadroCabecera($txt1Ancho,$txt1,$txt2Ancho,$txt2){
			$this->Fuente("B");
			$this->Cell($txt1Ancho,4,utf8_decode($txt1),0,0,"L");
			$this->Fuente("");
			$this->Cell($txt2Ancho,4,utf8_decode($txt2),0,0,"L");
		}
		function TituloCabecera($txtAncho,$txt,$tam=10,$borde=1,$align="C"){
			$this->Fuente("B",$tam);
			$this->Cell($txtAncho,4,utf8_decode($txt),$borde,0,$align);	
		}
		function CuadroCuerpo($txtAncho,$txt,$relleno=0,$align="L",$borde=0,$tam=9,$tipo=""){
			$this->Fuente($tipo,$tam);
			$this->Cell($txtAncho,5,utf8_decode($txt),$borde,0,$align,$relleno);	
		}
		function CuadroCuerpoMulti($txtAncho,$txt,$relleno=0,$align="L",$borde=0,$tam=9,$tipo=""){
			$this->Fuente($tipo,$tam);
			$this->MultiCell($txtAncho,5,utf8_decode($txt),$borde,$align,$relleno);	
		}
		function CuadroCuerpoPersonalizado($txtAncho,$txt,$relleno=0,$align="L",$borde=0,$tipo="",$tam=10){
			$this->Fuente($tipo,$tam);
			$this->Cell($txtAncho,5,utf8_decode($txt),$borde,0,$align,$relleno);	
		}
		function CuadroCuerpoResaltar($txtAncho,$txt,$relleno=0,$align="L",$borde=0,$resaltar=2){
			$this->Fuente("");
			switch($resaltar){
				//case 1:{$this->SetFillColor(179,179,179);}break;
				//case 2:{$this->SetFillColor(135,135,135);}break;
				case 2:{$this->SetFillColor(190,190,190);}break;
				case 1:{$this->SetFillColor(210,210,210);}break;
			}
			$this->Cell($txtAncho,5,utf8_decode($txt),$borde,0,$align,$relleno);	
		}
		function CuadroNombre($txtAncho,$Paterno,$Materno,$Nombres,$Full=0,$relleno){
			if($Full){
				$this->CuadroCuerpo($txtAncho,ucwords($Paterno." ".$Materno." ".$Nombres),$relleno);
			}else{
				$Nombre=array_shift(explode(" ",$Nombres));
				$this->CuadroCuerpo($txtAncho,ucwords($Paterno." ".$Materno." ".$Nombre),$relleno);
			}		
		}
		function CuadroNombreSeparado($txtAnchoP,$Paterno,$txtAnchoM,$Materno,$txtAnchoN,$Nombres,$Full,$relleno){
			if($Full){
				$this->CuadroCuerpo($txtAnchoP,ucwords($Paterno),$relleno);
				$this->CuadroCuerpo($txtAnchoM,ucwords($Materno),$relleno);
				$this->CuadroCuerpo($txtAnchoN,ucwords($Nombres),$relleno);
			}else{
				$Nombre=array_shift(explode(" ",$Nombres));
				$this->CuadroCuerpo($txtAnchoP,ucwords($Paterno),$relleno);
				$this->CuadroCuerpo($txtAnchoM,ucwords($Materno),$relleno);
				$this->CuadroCuerpo($txtAnchoN,ucwords($Nombre),$relleno);
			}
		}
		function Linea(){
			$this->Cell($this->ancho,0,"",1,1);
			$this->Ln();	
		}
		function Mostrar($valores,$ancho1=50,$ancho2=70,$alto=6){
			foreach($valores as $k=>$v){
				$this->CuadroCuerpo($ancho1,$k,0,"",0,"","B");
				$this->CuadroCuerpo($ancho2,$v,0,"",0,"","");
				$this->ln($alto);
			}
		}
		function Footer()
		{	global $lema,$idioma;
			//$this->Cell($this->ancho,0,"",1,1);
			
			// Posición: a 1,5 cm del final
			$this->SetY(-15);
			// Arial italic 8
			
			// Número de página
			$this->Fuente("I",7.5);
			$this->Cell($this->ancho,0,"",1,1);
			$this->Cell(50,4,utf8_decode($idioma['ReporteGenerado']).": ".date('d-m-Y H:i:s'),0,0,"L");
			$this->Fuente("I",8);
			$this->Cell((round(($this->ancho-50)/2)-10),4,utf8_decode($lema),0,0,"C");
			$this->Fuente("I",7);
			
			
			if($this->CurOrientation=="P"){
				$this->Cell((round(($this->ancho-50)/2)+10),3,utf8_decode($idioma['TituloSistema'].""),0,0,"R");
				$this->ln();
				$this->Cell((round(($this->ancho-50)/2)+40),3,"",0,0,"R");
				$this->Cell((round(($this->ancho-50)/2)+10),3,"Desarrollado por Ronald Nina",0,0,"R");
			}else{
				$this->Cell((round(($this->ancho-50)/2)+10),4,utf8_decode($idioma['TituloSistema']." - Desarrollado por Ronald Nina"),0,0,"R");	
			}
			
			//$this->Cell(60,4,utf8_decode($idioma['ReporteGenerado']).": ".date('d-m-Y H:i:s'),0,0,"R");
			
			if(in_array("Pie",get_class_methods($this))){
				$this->Pie();	
			}
		}
	}
?>