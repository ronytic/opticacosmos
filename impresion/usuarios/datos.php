<?php
include_once("../../login/check.php");
include_once("../pdf.php");
$titulo=$idioma['DatosUsuario'];
class PDF extends PPDF{
		
}
$Cod=$_GET['Cod'];
include_once("../../class/usuario.php");
$usuario=new usuario;
$pac=$usuario->mostrarRegistro($Cod);
$pac=array_shift($pac);

$pdf=new PDF;
$pdf->AddPage();
$pdf->Mostrar(array(
		$idioma["Usuario"]=>$pac['Usuario'],
		
		$idioma["Contrasena"]=>"******",
		
		$idioma["Paterno"]=>$pac['Paterno'],
		$idioma["Materno"]=>$pac['Materno'],
		$idioma["Nombres"]=>$pac['Nombres'],
		$idioma["Ci"]=>$pac['Ci'],
		$idioma["Telefono"]=>$pac['Telefono'],
		$idioma["Celular"]=>$pac['Celular'],
		$idioma["Direccion"]=>$pac['Direccion'],
		$idioma["Observaciones"]=>$pac['Observacion'],
	)
);
$pdf->Output();
?>