<?php
include_once("../../login/check.php");
$folder="../../";
$CodUsuarioAsignado=$_POST['CodUsuarioAsignado'];
$Desde=fecha2Str($_POST['Desde'],0);
$Hasta=fecha2Str($_POST['Hasta'],0);
//print_r($_POST);
switch($_POST['TipoReporte']){
	case 'Ventas':{$Archivo="reporteingreso";}break;
	case 'EntregaTrabajos':{$Archivo="reporteentregas";}break;
	case 'NoEntregados':{$Archivo="reportenoentregas";}break;
	
}
$url="../../impresion/reporte/$Archivo.php?Desde=".$Desde."&Hasta=".$Hasta."&CodUsuarioAsignado=".$CodUsuarioAsignado;
?>
<a href="<?php echo $url?>" class="btn btn-xs btn-warning" target="_blank"><?php echo $idioma['AbrirOtraVentana']?></a><br />
<iframe src="<?php echo $url?>" width="100%" height="835" frameborder="1"></iframe>