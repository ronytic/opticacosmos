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
						"Entregado"=>"Entregado",
						"TotalBs"=>$idioma['Total'],
						"ACuentaBs"=>$idioma['ACuenta'],
						"ACuentaSus"=>$idioma['ACuenta']." $",
						"SaldoBs"=>$idioma['Saldo']
						);
		if($NumeroBoleta==""){
			//echo "Hola";
			$NumeroBoleta="%";
		}
        /*echo $Desde;
        echo $Hasta;*/
		//$opt=$optica->mostrarTodoRegistro("CodPaciente=".$CodPaciente." and NumeroBoleta LIKE '$NumeroBoleta' and FechaEmitido BETWEEN '".($Desde)."' and '".($Hasta)."' ",1,"FechaRegistro,NumeroBoleta");
		$opt=$optica->mostrarTodoRegistro("CodPaciente=".$CodPaciente." and NumeroBoleta LIKE '$NumeroBoleta%'",1,"FechaRegistro,NumeroBoleta");
		//print_r($opt);
        
        foreach($opt as $o){$i++;
            $datos[$i]['CodOptica']=$o['CodOptica'];
            $datos[$i]['NumeroBoleta']=$o['NumeroBoleta'];
            $datos[$i]['FechaEmitido']=$o['FechaEmitido'];
            $datos[$i]['FechaEntrega']=$o['FechaEntrega'];
            $datos[$i]['HoraEntrega']=$o['HoraEntrega'];
            $datos[$i]['Recepcion']=$o['Recepcion'];
            $datos[$i]['Entregado']=$o['EstadoEntrega']?'Si':'No';
			$datos[$i]['TotalBs']=$o['TotalBs'];
            $datos[$i]['ACuentaBs']=$o['ACuentaBs'];
            $datos[$i]['ACuentaSus']=$o['ACuentaSus'];
            $datos[$i]['SaldoBs']=$o['SaldoBs'];
            $datos[$i]['CodOptica']=$o['CodOptica'];
        }
		listadoTabla($titulos,$datos,1,"boleta.php","","",array("../../venta/registro/"=>"Registrar Nueva Orden"));

		

?>