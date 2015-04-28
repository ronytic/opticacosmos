<?php
include_once("../../login/check.php");
include_once("../../class/inventario.php");
$inventario=new inventario;
extract($_POST);

$CodUsuarioModificacion=$_SESSION['CodUsuarioLog'];
$FechaModificacion=date("Y-m-d");
$HoraModificacion=date("H:i:s");
$Valores=array("Cantidad"=>"'$CantidadNueva'",
				"CantidadStock"=>"'$CantidadNueva'",
				"CodUsuarioModificacion"=>"'$CodUsuarioModificacion'",
				"FechaModificacion"=>"'$FechaModificacion'",
                "HoraModificacion"=>"'$HoraModificacion'",
                "CantidadAnterior"=>"'$Cantidad'",
                "CantidadStockAnterior"=>"'$CantidadStock'",
                "CantidadStockNuevo"=>"'$CantidadNueva'",
                "ObservacionModificacion"=>"'$ObservacionModificacion'",
);
//print_r($Valores);
$inventario->actualizarRegistro($Valores,"Codinventario=".$Cod);
header("Location:detalle.php?Cod=$CodProducto");
$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>