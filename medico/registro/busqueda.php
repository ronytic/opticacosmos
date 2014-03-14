<?php
include_once("../../login/check.php");
include_once("../../class/medico.php");
include_once("../../class/especialidad.php");
$medico=new medico;
$especialidad=new especialidad;
extract($_POST);
$Paterno=$Paterno!=""?"Paterno LIKE '$Paterno%'":"Paterno LIKE '%'";
$Materno=$Materno!=""?"Materno LIKE '$Materno%'":"Materno LIKE '%'";
$Nombres=$Nombres!=""?"Nombres LIKE '$Nombres%'":"Nombres LIKE '%'";
$Ci=$Ci!=""?"Ci LIKE '$Ci%'":"Ci LIKE '%'";
$CodEspecialidad=$CodEspecialidad!=""?"CodEspecialidad LIKE '$CodEspecialidad'":"CodEspecialidad LIKE '%'";

$condicion="$Paterno and $Materno and $Nombres and $Ci and $CodEspecialidad";
$med=$medico->mostrarTodoRegistro($condicion,1,"Paterno,Materno,Nombres,Ci");
foreach($med as $m){$i++;
	$esp=$especialidad->mostrarRegistro($m['CodEspecialidad']);
	$esp=array_shift($esp);
	$datos[$i]['CodMedico']=$m['CodMedico'];
	$datos[$i]['Paterno']=$m['Paterno'];
	$datos[$i]['Materno']=$m['Materno'];
	$datos[$i]['Nombres']=$m['Nombres'];
	$datos[$i]['Ci']=$m['Ci'];
	$datos[$i]['Especialidad']=$esp['Nombre'];
}
$titulo=array(	"Paterno"=>$idioma['Paterno'],
				"Materno"=>$idioma['Materno'],
				"Nombres"=>$idioma['Nombres'],
				"Ci"=>$idioma['Ci'],
				"Especialidad"=>$idioma['Especialidad'],
);
listadotabla($titulo,$datos,1,"ver.php","modificar.php","eliminar.php");
?>