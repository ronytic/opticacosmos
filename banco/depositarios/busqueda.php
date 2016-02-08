<?php
include_once("../../login/check.php");
include_once("../../class/bancodepositario.php");
$bancodepositario=new bancodepositario;
extract($_POST);
$Nombres=$Nombres!=""?"Nombres LIKE '$Nombres%'":"Nombres LIKE '%'";
$Paterno=$Paterno!=""?"Paterno LIKE '$Paterno%'":"Paterno LIKE '%'";
$Materno=$Materno!=""?"Materno LIKE '$Materno%'":"Materno LIKE '%'";

$condicion="$Nombres and $Paterno and $Materno";
$dep=$bancodepositario->mostrarTodoRegistro($condicion,1,"Paterno,Materno,Nombres");
$titulo=array(	"Nombres"=>$idioma['Nombres'],
				"Paterno"=>$idioma['ApellidoPaterno'],
                "Materno"=>$idioma['ApellidoMaterno'],
				"Celular"=>$idioma['Celular'],
);
listadotabla($titulo,$dep,1,"","modificar.php","eliminar.php");
?>