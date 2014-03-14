<?php
include_once("../../login/check.php");
include_once("../pdf.php");
$titulo=$idioma['DatosProducto'];
class PDF extends PPDF{
		
}
$Cod=$_GET['Cod'];
include_once("../../class/producto.php");
$producto=new producto;
include_once("../../class/productotipo.php");
$productotipo=new productotipo;
$pro=$producto->mostrarRegistro($Cod);
$pro=array_shift($pro);

$pt=$productotipo->mostrarRegistro($pro['CodProductoTipo']);
$pt=array_shift($pt);

$pdf=new PDF;
$pdf->AddPage();
$pdf->Mostrar(array(
		$idioma["Nombre"]=>$pro['Nombre'],
		$idioma["UnidadMedida"]=>$pro['Unidad'],
		$idioma["TipoProducto"]=>$pt['Nombre'],
		$idioma["Descripcion"]=>$pro['Descripcion'],

		
	)
);
$pdf->Output();
?>