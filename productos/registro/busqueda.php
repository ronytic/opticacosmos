<?php
include_once("../../login/check.php");
include_once("../../class/producto.php");
include_once("../../class/productotipo.php");
$producto=new producto;
$productotipo=new productotipo;
extract($_POST);

$Nombre=$Nombre!=""?"Nombre LIKE '$Nombre%'":"Nombre LIKE '%'";
$Unidad=$Unidad!=""?"Unidad LIKE '$Unidad%'":"Unidad LIKE '%'";
$CodProductoTipo=$CodProductoTipo!=""?"CodProductoTipo LIKE '$CodProductoTipo%'":"CodProductoTipo LIKE '%'";
$condicion=" $Nombre and $Unidad and $CodProductoTipo";
$pro=$producto->mostrarTodoRegistro($condicion,1,"Nombre");
foreach($pro as $p){$i++;
	$pt=$productotipo->mostrarRegistro($p['CodProductoTipo']);
	$pt=array_shift($pt);
	$datos[$i]['CodProducto']=$p['CodProducto'];

	$datos[$i]['Nombre']=$p['Nombre'];
	$datos[$i]['Unidad']=$p['Unidad'];
	$datos[$i]['Descripcion']=$p['Descripcion'];
	$datos[$i]['CodProductoTipo']=$pt['Nombre'];
}

$titulo=array(
				"Nombre"=>$idioma['Nombre'],
				"Unidad"=>$idioma['UnidadMedida'],
				"Descripcion"=>$idioma['Descripcion'],
				"CodProductoTipo"=>$idioma['TipoProducto'],
);
listadotabla($titulo,$datos,1,"ver.php","modificar.php","eliminar.php");
?>