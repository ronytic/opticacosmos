<?php
include_once("../../login/check.php");
include_once("../../class/optica.php");
$optica=new optica;
extract($_POST);
$Valores=array("CodPaciente"=>"'$CodPaciente'",
				"NumeroBoleta"=>"'$NumeroBoleta'",
				"Fecha"=>"'".fecha2Str($Fecha,0)."'",
				"FechaEntrega"=>"'".fecha2Str($FechaEntrega,0)."'",
				"HoraEntrega"=>"'$HoraEntrega'",
				"Recepcion"=>"'$Recepcion'",
				"Cristales"=>"'$Cristales'",
				"Armazon"=>"'$Armazon'",
				"Organicos"=>"'$Organicos'",
				"Tinte"=>"'$Tinte'",
				"Uv"=>"'$Uv'",
				"Pcr"=>"'$Pcr'",
				
				"LOdEst1"=>"'$LOdEst1'",
				"LCil1"=>"'$LCil1'",
				"LEje1"=>"'$LEje1'",
				"LBase1"=>"'$LBase1'",
				"LDip1"=>"'$LDip1'",
				"LOdEst2"=>"'$LOdEst2'",
				"LCil2"=>"'$LCil2'",
				"LEje2"=>"'$LEje2'",
				"LBase2"=>"'$LBase2'",
				"LDip2"=>"'$LDip2'",
				
				"COdEst1"=>"'$COdEst1'",
				"CCil1"=>"'$CCil1'",
				"CEje1"=>"'$CEje1'",
				"CBase1"=>"'$CBase1'",
				"CDip1"=>"'$CDip1'",
				"COdEst2"=>"'$COdEst2'",
				"CCil2"=>"'$CCil2'",
				"CEje2"=>"'$CEje2'",
				"CBase2"=>"'$CBase2'",
				"CDip2"=>"'$CDip2'",
				
				"Bifocales"=>"'$Bifocales'",
				"Otros"=>"'$Otros'",
				"Alt"=>"'$Alt'",
				"Ad"=>"'$Ad'",
				"Doctor"=>"'$Doctor'",
				"Precio"=>"'$Precio'",
				"Estuche"=>"'$Estuche'",
				
				"Total"=>"'$Total'",
				"ACuenta"=>"'$ACuenta'",
				"Saldo"=>"'$Saldo'",
				
				"Observaciones"=>"'$Observaciones'",
				
);
//$optica->insertarRegistro($Valores);
$ArchivoNuevo="../registro/listar.php";
$Listar=0;
$NoRevisar=1;
$Mensajes[]=$idioma["GuardadoCorrectamente"];
$folder="../../";
include_once("../../resultado.php");
?>