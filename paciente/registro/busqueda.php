<?php
include_once("../../login/check.php");
include_once("../../class/paciente.php");
$paciente=new paciente;
include_once("../../class/optica.php");
$optica=new optica;
extract($_POST);
$Paterno=$Paterno!=""?"Paterno LIKE '$Paterno%'":"Paterno LIKE '%'";
$Materno=$Materno!=""?"Materno LIKE '$Materno%'":"Materno LIKE '%'";
$Nombres=$Nombres!=""?"Nombres LIKE '$Nombres%'":"Nombres LIKE '%'";
$Ci=$Ci!=""?"Ci LIKE '$Ci%'":"Ci LIKE '%'";
$condicion="$Paterno and $Materno and $Nombres and $Ci";
$pac=$paciente->mostrarTodoRegistro($condicion,1,"Paterno,Materno,Nombres,Ci");
$titulo=array(	"Paterno"=>$idioma['Paterno'],
				"Materno"=>$idioma['Materno'],
				"Nombres"=>$idioma['Nombres'],
				"Ci"=>$idioma['Ci'],
				"CantidadTrabajos"=>"Trabajos Realizados"
);

foreach($pac as $p){$i++;
	$opt=$optica->mostrarTodoRegistro("CodPaciente=".$p['CodPaciente'],1,"");
	$cantidad=count($opt);
    $datos[$i]['Cod']=$p['CodPaciente'];
    $datos[$i]['Paterno']=capitalizar($p['Paterno']);
    $datos[$i]['Materno']=capitalizar($p['Materno']);
    $datos[$i]['Nombres']=capitalizar($p['Nombres']);
    $datos[$i]['Ci']=$p['Ci'];
	$datos[$i]['CantidadTrabajos']=$cantidad;
}
listadotabla($titulo,$datos,1,"ver.php","modificar.php","",array("historial.php"=>"Historia Clinica"));
?>