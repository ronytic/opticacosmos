<?php
include_once("../../login/check.php");
include_once("../pdf.php");
$titulo=$idioma['DatosEspecialidad'];
class PDF extends PPDF{
		
}
$Cod=$_GET['Cod'];
include_once("../../class/especialidad.php");
$especialidad=new especialidad;
$esp=$especialidad->mostrarRegistro($Cod);
$esp=array_shift($esp);

$pdf=new PDF;
$pdf->AddPage();
$pdf->Mostrar(array(
		$idioma["Nombre"]=>$esp['Nombre'],
		$idioma["Detalle"]=>$esp['Detalle'],
	)
);
$pdf->Output();
?>