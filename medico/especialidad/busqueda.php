<?php
include_once("../../login/check.php");
include_once("../../class/especialidad.php");
$especialidad=new especialidad;
extract($_POST);
$Nombre=$Nombre!=""?"Nombre LIKE '$Nombre%'":"Nombre LIKE '%'";

$condicion="$Nombre";
$esp=$especialidad->mostrarTodoRegistro($condicion,1,"Nombre");
$titulo=array(	"Nombre"=>$idioma['Nombre'],
				"Detalle"=>$idioma['Detalle'],
);
listadotabla($titulo,$esp,1,"ver.php","modificar.php","eliminar.php");
?>