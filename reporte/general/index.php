<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NReporteGeneral";
$tiporeporte=array("Ventas"=>"Ventas","EntregaTrabajos"=>"Entrega de Trabajos");
if(in_array($_SESSION['Nivel'],array(1,2,3,4))){
	$tiporeporte['NoEntregados']="No Entregados";
}
include_once("../../class/usuario.php");
$usuario=new usuario;
$us2=todolista($usuario->mostrarUsuarios("Nivel!=1"),"CodUsuario","Paterno,Materno,Nombres"," ");

include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
//configuracion={todayBtn: false, endDate: "'+7day'"};
$(document).on("ready",function(){

});
</script>
<?php include_once($folder."cabecera.php");?>
<div class="widget-header widget-header-flat"><h4><?php echo $idioma['CriterioBusqueda']?></h4></div>
<div class="widget-body widget-main">
<form action="verarchivo.php" method="post" class="formulario">
<table class="table table-hover table-bordered">
	<tr>
    	<th><?php echo $idioma['Desde'] ?></th>
        <th><?php echo $idioma['Hasta'] ?></th>
    </tr>
	<tr>
    	
        <td><?php campo("Desde","text",fecha2Str(),"fecha",1,"",0)?></td>
        <td><?php campo("Hasta","text",fecha2Str(""),"fecha",1,"",0)?></td>
        <td colspan="2">
        	<?php campo("","submit",$idioma['Buscar'],"btn btn-info",1,"",1)?>
        </td>
    </tr>
</table>
</form>
</div>
<div class="widget-header widget-header-flat"><h4><i class="icon-print"></i><?php echo $idioma['Reporte']?></h4></div>
<div class="widget-body widget-main" id="respuestaformulario">
</div>
<?php include_once($folder."pie.php");?>