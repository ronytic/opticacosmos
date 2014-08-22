<?php
include_once("../../login/check.php");
$folder="../../";
$Cod=$_GET['CodOptica'];
$titulo="NVerBoletaOrdenTrabajo";
$url="../../impresion/areas/ordentrabajo.php?Cod=".$Cod;
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
            	<a onClick="javascript:history.back();" class="btn btn-xs"><?php echo $idioma['Volver']?></a>
            	<a href="<?php echo $url?>" class="btn btn-danger btn-xs" target="_blank"><?php echo $idioma['AbrirOtraVentana']?></a>
                
                <hr>
            	<iframe src="<?php echo $url?>" width="100%" height="700" frameborder="1"></iframe>
			</div>
		</div>
	</div>
</div>
<?php include_once($folder."pie.php");?>