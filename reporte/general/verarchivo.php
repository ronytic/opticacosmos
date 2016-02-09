<?php
include_once("../../login/check.php");
$folder="../../";
$Desde=fecha2Str($_POST['Desde'],0);
$Hasta=fecha2Str($_POST['Hasta'],0);
$url="../../impresion/reporte/general.php?Desde=".$Desde."&Hasta=".$Hasta;
?>
<a href="<?php echo $url?>" class="btn btn-xs btn-warning" target="_blank"><?php echo $idioma['AbrirOtraVentana']?></a><br />
<iframe src="<?php echo $url?>" width="100%" height="700" frameborder="1"></iframe>