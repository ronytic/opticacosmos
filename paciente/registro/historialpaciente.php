<?php
include_once("../../login/check.php");
include_once("../../class/optica.php");
//print_r($_POST);
extract($_POST);
$optica=new optica;

switch($Area){
	case 'Optica':{
		$titulos=array("NumeroBoleta"=>$idioma["NumeroBoleta"],
						"FechaRegistro"=>$idioma['FechaRegistro'],
						"FechaEntrega"=>$idioma['FechaEntrega'],
						"HoraEntrega"=>$idioma['HoraEntrega'],
						
						//"Armazon"=>$idioma['Armazon'],
						"Recepcion"=>$idioma['Recepcion'],
						//"Doctor"=>$idioma['Doctor'],
						"TotalBs"=>$idioma['Total'],
						"ACuentaBs"=>$idioma['ACuenta'],
						"ACuentaSus"=>$idioma['ACuenta']." $",
						"SaldoBs"=>$idioma['Saldo']
						);
		if($NumeroBoleta==""){
			//echo "Hola";
			$NumeroBoleta="%";
		}
		$opt=$optica->mostrarTodoRegistro("CodPaciente=".$CodPaciente." and NumeroBoleta LIKE '$NumeroBoleta' and FechaRegistro BETWEEN '".fecha2Str($Desde,0)."' and '".fecha2Str($Hasta,0)."' ",1,"FechaRegistro,NumeroBoleta");
		//print_r($opt);
		echo "<h2>Optica</h2>";
		listadoTabla($titulos,$opt,1,"../areas/boleta.php","","","",array("CodOptica"=>"asd"));
	}break;
		
	default:{
		$titulos=array("NumeroBoleta"=>$idioma["NumeroBoleta"],
						"Fecha"=>$idioma['FechaPedido'],
						"FechaEntrega"=>$idioma['FechaEntrega'],
						"HoraEntrega"=>$idioma['HoraEntrega'],
						
						"Armazon"=>$idioma['Armazon'],
						"Recepcion"=>$idioma['Recepcion'],
						"Doctor"=>$idioma['Doctor'],
						"Total"=>$idioma['Total'],
						"ACuenta"=>$idioma['ACuenta'],
						"Saldo"=>$idioma['Saldo']
						);
		$opt=$optica->mostrarTodoRegistro("CodPaciente=".$CodPaciente." and Fecha BETWEEN '".fecha2Str($Desde,0)."' and '".fecha2Str($Hasta,0)."' ",1,"Fecha");
		//print_r($opt);
		echo "<h2>Optica</h2>";
		listadoTabla($titulos,$opt);
	}
}
?>