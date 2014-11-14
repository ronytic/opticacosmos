<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NReporteMedico";
$tiporeporte=array("1"=>"Si","0"=>"No");

include_once("../../class/medico.php");
$medico=new medico;
$us2=todolista($medico->mostrarTodoRegistro("",1,"Paterno,Materno,Nombres"),"CodMedico","Paterno,Materno,Nombres"," ");

include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
configuracion={todayBtn: false, endDate: "'0d'"};
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
    	
    	<th><?php echo $idioma['Medico'] ?></th>
        
    	<th><?php echo $idioma['Desde'] ?></th>
        <th><?php echo $idioma['Hasta'] ?></th>
        <th><?php echo $idioma['ReporteCompleto'] ?></th>
    </tr>
	<tr>
    	
        <td><?php campo("CodMedico","select",$us2,"",1)?></td>
        
        <td><?php campo("Desde","text",fecha2Str(),"fecha",1,"",1)?></td>
        <td><?php campo("Hasta","text",fecha2Str(),"fecha",1,"",1)?></td>
        <td><?php campo("ReporteCompleto","select",$tiporeporte,"",1,"",1)?></td>
        <td colspan="2">
        	<?php campo("","submit",$idioma['Buscar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
</div>
<div class="widget-header widget-header-flat"><h4><?php echo $idioma['DetallesBoleta']?></h4></div>
<div class="widget-body widget-main" id="respuestaformulario">
</div>
<?php include_once($folder."pie.php");?>