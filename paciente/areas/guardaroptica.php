<?php
include_once("../../login/check.php");
include_once("../../class/optica.php");
$optica=new optica;
extract($_POST);
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
$Valores=array("CodPaciente"=>"'$CodPaciente'",
				
				//"Fecha"=>"'".fecha2Str($Fecha,0)."'",
				"FechaEntrega"=>"'".fecha2Str($FechaEntrega,0)."'",
				"HoraEntrega"=>"'$HoraEntrega'",
				"Recepcion"=>"'$Recepcion'",
				"CodEspecialidad"=>"'$CodEspecialidad'",
				"CodMedico"=>"'$CodMedico'",
				"NumeroBoleta"=>"'$NumeroBoleta'",
				
				"LODEsferico"=>"'$LODEsferico'",
				"LODCilindrico"=>"'$LODCilindrico'",
				"LODEje"=>"'$LODEje'",
				"LODPrisma"=>"'$LODPrisma'",
				"LODBase"=>"'$LODBase'",
				"LODAdd"=>"'$LODAdd'",
				
				"LOIEsferico"=>"'$LOIEsferico'",
				"LOICilindrico"=>"'$LOICilindrico'",
				"LOIEje"=>"'$LOIEje'",
				"LOIPrisma"=>"'$LOIPrisma'",
				"LOIBase"=>"'$LOIBase'",
				"LOIAdd"=>"'$LOIAdd'",
				
				"CODEsferico"=>"'$CODEsferico'",
				"CODCilindrico"=>"'$CODCilindrico'",
				"CODEje"=>"'$CODEje'",
				
				"COIEsferico"=>"'$COIEsferico'",
				"COICilindrico"=>"'$COICilindrico'",
				"COIEje"=>"'$COIEje'",
				"COIAltura"=>"'$COIAltura'",
				"COIDPLejos"=>"'$COIDPLejos'",
				"COIDPCerca"=>"'$COIDPCerca'",
				
				"CodProductoTipo1"=>"'$CodProductoTipo1'",
				"CodProducto1"=>"'$CodProducto1'",
				"Detalle1"=>"'$Detalle1'",
				
				"CodProductoTipo2"=>"'$CodProductoTipo2'",
				"CodProducto2"=>"'$CodProducto2'",
				"Detalle2"=>"'$Detalle2'",
				
				"CodProductoTipo3"=>"'$CodProductoTipo3'",
				"CodProducto3"=>"'$CodProducto3'",
				"Detalle3"=>"'$Detalle3'",
				"Vitrina3"=>"'$Vitrina3'",
				
				"CodProductoTipo4"=>"'$CodProductoTipo4'",
				"CodProducto4"=>"'$CodProducto4'",
				"Detalle4"=>"'$Detalle4'",
				"Vitrina4"=>"'$Vitrina4'",
				
				"Observaciones"=>"'$Observaciones'",
				
				"TotalBs"=>"'$TotalBs'",
				"ACuentaBs"=>"'$ACuentaBs'",
				"ACuentaSus"=>"'$ACuentaSus'",
				"SaldoBs"=>"'$SaldoBs'",
				"DescuentoBs"=>"'$DescuentoBs'",
				"CobrarBs"=>"'$CobrarBs'",
				
);
$optica->insertarRegistro($Valores);
$id=$optica->ultimo();
$Botones=array("boleta.php?CodOptica=$id"=>$idioma["ImprimirBoleta"]);
$ArchivoNuevo="../registro/listar.php";
$Listar=0;
$Nuevo=0;
$NoRevisar=1;
$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>