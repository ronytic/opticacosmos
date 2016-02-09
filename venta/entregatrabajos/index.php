<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NEntregaTrabajos";
$Pass=$_SESSION['Pass'];
include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
configuracion={todayBtn: false, endDate: "'0d'"};
$(document).on("ready",function(){
	$(document).on("submit","#formularioRevisar",function(e){
		var MontoCobrar=$("#MontoCobrar").val();
        var contrasena=$("#contrasena").val();
        if(SaldoBs!=MontoCobrar) {
            alert("El Monto Introducido es Distinto al Monto a Cobrar");
            e.preventDefault();	
        }else{
            if(Pass!=md5(contrasena)){
                alert("La Contraseña de Usuario es Incorrecto");
                e.preventDefault();	
            }else{
                if(!confirm("¿Esta Seguro de entregar este trabajo?")){
                    e.preventDefault();	
                }    
            }      
            
        }
	});
    //alert(md5("ryno"));
});
</script>
<?php include_once($folder."cabecera.php");
//print_r($_SESSION);
?>
<div class="widget-header widget-header-flat"><h4>Búsqueda de Boleta</h4></div>
<div class="widget-body widget-main">
<form action="buscarboleta.php" method="post" class="formulario">
<table class="table table-hover">
	<tr>
    	<td class="der"><?php echo $idioma['NumeroBoleta'] ?></td>
        <td><?php campo("NumeroBoleta","text","","der norequerido",1,"",1)?></td>
        <td colspan="1">
        	<?php campo("","submit",$idioma['Buscar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
</div>
<div class="widget-header widget-header-flat"><h4>Detalles de la Boleta</h4></div>
<div class="widget-body widget-main" id="respuestaformulario">
</div>
<?php include_once($folder."pie.php");?>