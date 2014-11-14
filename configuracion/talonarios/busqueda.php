<?php
include_once("../../login/check.php");
include_once("../../class/talonario.php");
$talonario=new talonario;
extract($_POST);
$CodUsuarioAsignado=$CodUsuarioAsignado!=""?"CodUsuarioAsignado LIKE '$CodUsuarioAsignado'":"CodUsuarioAsignado LIKE '%'";

$condicion="$CodUsuarioAsignado";
$tal=$talonario->mostrarTodoRegistro($condicion,1,"Minimo,Maximo");
$titulo=array(	
				"Minimo"=>$idioma['Minimo'],
				"Maximo"=>$idioma['Maximo'],
				"Descripcion"=>$idioma['Descripcion'],
);
listadotabla($titulo,$tal,1,"","","eliminar.php");
?>