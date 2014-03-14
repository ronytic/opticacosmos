<?php
include_once("../../login/check.php");
$CodProducto=$_POST['CodProducto'];
include_once("../../class/producto.php");
$producto=new producto;
$pro=$producto->mostrarRegistro($CodProducto);
$pro=array_shift($pro);
echo $pro['Unidad'];
?>