<?php
include_once("../../login/check.php");
include_once("../../class/banco.php");
$banco=new banco;
extract($_POST);
$Nombre=$Nombre!=""?"Nombre LIKE '$Nombre%'":"Nombre LIKE '%'";

$condicion="$Nombre";
$esp=$banco->mostrarTodoRegistro($condicion,1,"Nombre");
$titulo=array(	"Nombre"=>$idioma['Nombre'],
				"NumeroCuenta"=>$idioma['NumeroCuenta'],
                "TipoCuenta"=>$idioma['TipoCuenta'],
);
listadotabla($titulo,$esp,1,"","modificar.php","eliminar.php");
?>