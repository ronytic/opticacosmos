<?php
include_once("../../login/check.php");
include_once("../pdf.php");
$titulo=$idioma['DatosTipoProducto'];
class PDF extends PPDF{
		
}
$Cod=$_GET['Cod'];
include_once("../../class/productotipo.php");
$productotipo=new productotipo;
$pt=$productotipo->mostrarRegistro($Cod);
$pt=array_shift($pt);
//print_r($pt);
$pdf=new PDF;
$pdf->AddPage();
$pdf->Mostrar(array(
		$idioma["Nombre"]=>$pt['Nombre'],
		$idioma["Descripcion"]=>$pt['Descripcion'],
		$idioma["Categoria"]=>$pt['Categoria'],
	)
);
$pdf->Output();
?>