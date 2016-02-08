<?php
include_once("../../login/check.php");
include_once("../../class/optica.php");
include_once("../../class/paciente.php");
include_once("../../class/medico.php");
$optica=new optica;
$paciente=new paciente;
$medico=new medico;
extract($_POST);
/*echo "<pre>";
print_r($_POST);
echo "</pre>";
exit();*/
$Ci=trim($Ci);
$Paterno=trim(mb_strtolower($Paterno,"utf8"));
$Materno=trim(mb_strtolower($Materno,"utf8"));
$Nombres=trim(mb_strtolower($Nombres,"utf8"));
$Celular=trim(mb_strtolower($Celular,"utf8"));
$pac=$paciente->mostrarTodoRegistro("Paterno='$Paterno' and Materno='$Materno' and Nombres='$Nombres'");
//echo count($pac);
if(count($pac)){//Actualizar Datos de Paciente 
    $valorespaciente=array(
              "Ci"=>"'$Ci'",
              "Paterno"=>"'$Paterno'",
              "Materno"=>"'$Materno'",
              "Nombres"=>"'$Nombres'",
              "Celular"=>"'$Celular'"              
        );
     $paciente->actualizarRegistro($valorespaciente,"Paterno='$Paterno' and Materno='$Materno' and Nombres='$Nombres'");   
     $pac=array_shift($pac);
     $CodPaciente=$pac['CodPaciente']; 
}else{//Insertar Nuevo  Paciente
    $valorespaciente=array(
              "Ci"=>"'$Ci'",
              "Paterno"=>"'$Paterno'",
              "Materno"=>"'$Materno'",
              "Nombres"=>"'$Nombres'",
              "Celular"=>"'$Celular'"              
        );
     $paciente->insertarRegistro($valorespaciente);  
     $CodPaciente=$paciente->ultimo();
}
//echo $CodPaciente;


$PaternoMedico=trim(mb_strtolower($PaternoMedico,"utf8"));
$MaternoMedico=trim(mb_strtolower($MaternoMedico,"utf8"));
$NombresMedico=trim(mb_strtolower($NombresMedico,"utf8"));
$CelularMedico=trim(mb_strtolower($CelularMedico,"utf8"));

$med=$medico->mostrarTodoRegistro("Paterno='$PaternoMedico' and Paterno='$PaternoMedico' and Paterno='$PaternoMedico' ");
if(count($med)){//Actualizar Datos de Paciente 
    $valoresmedico=array(
              "Paterno"=>"'$PaternoMedico'",
              "Materno"=>"'$MaternoMedico'",
              "Nombres"=>"'$NombresMedico'",
            
        );
        $med=array_shift($med);
     $CodMedico=$med['CodMedico']; 
     $CodEspecialidad=$med['CodEspecialidad'];
     $medico->actualizarRegistro($valoresmedico,"CodMedico='$CodMedico'");   
     
}else{//Insertar Nuevo  Paciente
    $valoresmedico=array(
              "Paterno"=>"'$PaternoMedico'",
              "Materno"=>"'$MaternoMedico'",
              "Nombres"=>"'$NombresMedico'",
              "Celular"=>"'$Celular'",
              "CodEspecialidad"=>"'1'"
                          
        );
     $medico->insertarRegistro($valoresmedico);  
     $CodMedico=$medico->ultimo();
}
//echo $CodPaciente;





$opt=$optica->mostrarTodoRegistro("NumeroBoleta='$NumeroBoleta'");
if($NumeroBoleta=="")
{
	$Mensajes[]="Debe de Introducir un Número de Boleta para poder registrar";	
    $Botones=array("index.php"=>"Registrar Nuevamente ");
}else{
	
	$CodProductoTipo1=$CodProductoTipo1!=""?$CodProductoTipo1:'0';
	$CodProductoTipo2=$CodProductoTipo2!=""?$CodProductoTipo2:'0';
	$CodProductoTipo3=$CodProductoTipo3!=""?$CodProductoTipo3:'0';
	$CodProductoTipo4=$CodProductoTipo4!=""?$CodProductoTipo4:'0';
	$CodProducto1=$CodProducto1!=""?$CodProducto1:'0';
	$CodProducto2=$CodProducto2!=""?$CodProducto2:'0';
	$CodProducto3=$CodProducto3!=""?$CodProducto3:'0';
	$CodProducto4=$CodProducto4!=""?$CodProducto4:'0';
	
//$opt=array_shift($opt);
//print_r($opt);
//exit();
$CodUsuarioEmitido=$_SESSION['CodUsuarioLog'];
$NivelEmitido=$_SESSION['Nivel'];
$FechaEmitido=date("Y-m-d");
$HoraEmitido=date("H:i:s");
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
                "TotalAcuentaSus"=>"'$TotalAcuentaSus'",
				"SaldoBs"=>"'$SaldoBs'",
				"TC"=>"'$TC'",
                
                
				"CodUsuarioEmitido"=>"'$CodUsuarioEmitido'",
				"NivelEmitido"=>"'$NivelEmitido'",
                "FechaEmitido"=>"'$FechaEmitido'",
                "HoraEmitido"=>"'$HoraEmitido'",
                "Emitido"=>"'1'",
				
);

/*echo "<pre>";
print_r($Valores);
echo "</pre>";*/
$optica->actualizarRegistro($Valores,"NumeroBoleta='$NumeroBoleta'");
$opt=$optica->mostrarTodoRegistro("NumeroBoleta='$NumeroBoleta'");
$opt=array_shift($opt);
$Botones=array("boleta.php?CodOptica=".$opt['CodOptica']=>$idioma["ImprimirBoleta"]);
$Mensajes[]=$idioma["GuardadoCorrectamente"];
//header("Location:boleta.php?CodOptica=".$opt['CodOptica']);
}

$ArchivoNuevo="../registro/listar.php";
$Listar=0;
$Nuevo=0;
$NoRevisar=1;

$folder="../../";
//include_once("../../resultado.php");
?>
<?php
//include_once("../../login/check.php");
$NoRevisar=1;
$folder="../../";
$Cod=$opt['CodOptica'];
if($Cod==""){
	$Cod=$_GET['Cod'];	
}
$titulo="NVerBoletaOrdenTrabajo";
$url="../../impresion/optica/ordentrabajo".$UbicacionReporte.".php?Cod=".$Cod;
include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
configuracion={todayBtn: "", endDate: "'0d'"};
</script>
<?php include_once($folder."cabecera.php");?>
<div class="col-sm-12">
	<div class="widget-box">
    	<div class="widget-header widget-header-flat"><h4><?php echo $idioma['Reporte'] ?></h4></div>
        <div class="widget-body">
        	<div class="widget-main">
                <ul class="list-unstyled">
                	<?php foreach($Mensajes as $m){?>
                	<li><i class="icon-angle-right bigger-110"></i><?php echo $m ?></li>
                    <?php }?>
                </ul>
                <hr class="separador">
            	<a href="<?php echo $url?>" class="btn btn-success btn-xs" target="_blank"><?php echo "Ver Boleta en Otra Ventana"?></a>
                <a href="<?php echo $folder?>factura/venta/?Cod=<?php echo $Cod?>" class="btn btn-danger">Facturar</a>
                <hr>
            	<iframe src="<?php echo $url?>" width="100%" height="735" frameborder="1"></iframe>
			</div>
		</div>
	</div>
</div>
<?php include_once($folder."pie.php");?>