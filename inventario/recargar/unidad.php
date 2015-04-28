<?php
include_once("../../login/check.php");
$CodProducto=$_POST['CodProducto'];
include_once("../../class/producto.php");
$producto=new producto;
$pro=$producto->mostrarRegistro($CodProducto);
$pro=array_shift($pro);

include_once("../../class/inventario.php");
$inventario=new inventario;
$reg=$inventario->cantidadStock($CodProducto);
$reg=array_shift($reg);
$CantidadStock=$reg['CantidadStock'];
$Cantidad=$reg['Cantidad'];


$datos=array("Unidad"=>$pro['Unidad'],
              "CantidadStock"=>$CantidadStock." ".$pro['Unidad'],
              "Cantidad"=>$Cantidad." ".$pro['Unidad'],
            );
            
echo json_encode($datos);
?>