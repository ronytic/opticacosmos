<?php
include_once("../../login/check.php");
include_once("../../class/productotipo.php");
$productotipo=new productotipo;
extract($_POST);
$Nombre=$Nombre!=""?"Nombre LIKE '$Nombre%'":"Nombre LIKE '%'";
$condicion="$Nombre";
$pac=$productotipo->mostrarTodoRegistro($condicion,1,"Nombre");
$titulo=array(	
				"Nombre"=>$idioma['Nombre'],
				"Descripcion"=>$idioma['Descripcion'],
				"Categoria"=>$idioma['Categoria'],
);
listadotabla($titulo,$pac,1,"ver.php","modificar.php","eliminar.php");
?>