<?php
include_once("../../login/check.php");
include_once("../pdf.php");
$titulo=$idioma['DatosMedico'];
class PDF extends PPDF{
		
}
$Cod=$_GET['Cod'];
include_once("../../class/medico.php");
$medico=new medico;
include_once("../../class/especialidad.php");
$especialidad=new especialidad;
$med=$medico->mostrarRegistro($Cod);
$med=array_shift($med);

$esp=$especialidad->mostrarRegistro($med['CodEspecialidad']);
$esp=array_shift($esp);

$pdf=new PDF;
$pdf->AddPage();
$pdf->Mostrar(array(
		$idioma["Paterno"]=>$med['Paterno'],
		$idioma["Materno"]=>$med['Materno'],
		$idioma["Nombres"]=>$med['Nombres'],
		$idioma["Ci"]=>$med['Ci'],
		$idioma["Telefono"]=>$med['Telefono'],
		$idioma["Celular"]=>$med['Celular'],
		$idioma["FechaNacimiento"]=>fecha2Str($med['FechaNac']),
		$idioma["Especialidad"]=>$esp['Nombre'],
		$idioma["Observaciones"]=>$med['Observaciones'],
	)
);
$pdf->Output();
?>