<?php
include_once("../../login/check.php");
include_once("../../class/optica.php");
//print_r($_POST);
extract($_POST);
$optica=new optica;
		$titulos=array("NumeroBoleta"=>$idioma["NumeroBoleta"],
						"FechaEmitido"=>"Fecha de Emisión",
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
		$opt=$optica->mostrarTodoRegistro("CodPaciente=".$CodPaciente." and NumeroBoleta LIKE '$NumeroBoleta' and FechaEmitido BETWEEN '".($Desde)."' and '".($Hasta)."' ",1,"FechaRegistro,NumeroBoleta");
		//print_r($opt);
		listadoTabla($titulos,$opt,1,"boleta.php","","","",array("CodOptica"=>"asd"));

		

?>