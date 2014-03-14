<?php
include_once("../../login/check.php");
include_once("../pdf.php");
$titulo=$idioma['DatosPaciente'];
class PDF extends PPDF{
		
}
$Cod=$_GET['Cod'];
include_once("../../class/paciente.php");
$paciente=new paciente;
$pac=$paciente->mostrarPaciente($Cod);
$pac=array_shift($pac);

$pdf=new PDF;
$pdf->AddPage();
$pdf->Mostrar(array(
		$idioma["Paterno"]=>$pac['Paterno'],
		$idioma["Materno"]=>$pac['Materno'],
		$idioma["Nombres"]=>$pac['Nombres'],
		$idioma["Ci"]=>$pac['Ci'],
		$idioma["Telefono"]=>$pac['Telefono'],
		$idioma["Celular"]=>$pac['Celular'],
		$idioma["FechaNacimiento"]=>fecha2Str($pac['FechaNac']),
		$idioma["Direccion"]=>$pac['Direccion'],
		$idioma["Observaciones"]=>$pac['Observaciones'],
	)
);
$pdf->Output();
?>