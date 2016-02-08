<?php
include_once("../../login/check.php");
$folder="../../";
$Cod=$_GET['Cod'];
$titulo="NModificarGasto";
include_once("../../class/gasto.php");
$gasto=new gasto;
$gas=$gasto->mostrarRegistro($Cod);
$gas=array_shift($gas);



include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
configuracion={todayBtn: false, endDate: "'0d'"};
</script>
<?php include_once($folder."cabecera.php");?>
<form action="actualizar.php" method="post">
<?php campo("Cod","hidden",$Cod)?>
<table class="table table-hover">
    <tr>
    	<td class="der">Fecha del Gasto</td>
        <td colspan="2"><?php campo("FechaGasto","date",$gas['FechaGasto'],"",1,"","",array("max"=>0))?></td>
    </tr>
    <tr>
    	<td class="der">Detalle</td>
        <td colspan="2"><?php campo("Detalle","textarea",$gas['Detalle'],"","1","","",array("cols"=>40,"rows"=>5))?></td>
    </tr>
    
    <tr>
        <td class="der">Monto del Gasto</td>
        <td class=""><?php campo("Monto","text",$gas['Monto'],"der",1,"","",array("min"=>0,"step"=>"0.1"))?></td>


    </tr>
    <tr>
    	<td colspan="3">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>