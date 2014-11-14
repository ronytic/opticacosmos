<?php
include_once("../../login/check.php");
$folder="../../";
$CodMedico=$_POST['CodMedico'];
$Desde=fecha2Str($_POST['Desde'],0);
$Hasta=fecha2Str($_POST['Hasta'],0);
$ReporteCompleto=$_POST['ReporteCompleto'];
//print_r($_POST);

$Archivo="reporte";
$url="../../impresion/reporte/$Archivo.php?Desde=".$Desde."&Hasta=".$Hasta."&CodMedico=".$CodMedico."&ReporteCompleto=".$ReporteCompleto;
?>
<a href="<?php echo $url?>" class="btn btn-xs btn-warning" target="_blank"><?php echo $idioma['AbrirOtraVentana']?></a><br />
<iframe src="<?php echo $url?>" width="100%" height="700" frameborder="1"></iframe>