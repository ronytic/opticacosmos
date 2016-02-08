<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NReporteIngreso";
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
	$(document).on("submit",".formularioRevisar",function(e){
		
		if(!confirm("¿Esta Seguro de entregar este trabajo?")){
			e.preventDefault();	
		}
	});
});
</script>
<?php include_once($folder."cabecera.php");?>
<div class="widget-header widget-header-flat"><h4><?php echo $idioma['EntregasTrabajo']?></h4></div>
<div class="widget-body widget-main">
<form action="verarchivo.php" method="post" class="formulario">
<table class="table table-hover table-bordered">
	<tr>
    	<?php if(in_array($_SESSION['Nivel'],array(1,2,3,4))){?>
    	<th><?php echo $idioma['Empleado'] ?></th>
        <?php }?>
    	<th><?php echo $idioma['Desde'] ?></th>
        <th><?php echo $idioma['Hasta'] ?></th>
        <th><?php echo $idioma['TipoReporte'] ?></th>
    </tr>
	<tr>
    	<?php if(in_array($_SESSION['Nivel'],array(1,2,3,4))){?>
        <td><?php campo("CodUsuarioAsignado","select",$us2,"",1)?></td>
        <?php }?>
        <td><?php campo("Desde","text",fecha2Str(),"fecha",1,"",0)?></td>
        <td><?php campo("Hasta","text",fecha2Str(""),"fecha",1,"",0)?></td>
        <td><?php campo("TipoReporte","select",$tiporeporte,"",1,"",0)?></td>
        <td colspan="2">
        	<?php campo("","submit",$idioma['Buscar'],"btn btn-info",1,"",1)?>
        </td>
    </tr>
</table>
</form>
</div>
<div class="widget-header widget-header-flat"><h4><?php echo $idioma['DetallesBoleta']?></h4></div>
<div class="widget-body widget-main" id="respuestaformulario">
</div>
<?php include_once($folder."pie.php");?>