<?php
include_once("../../login/check.php");
$folder="../../";
$Cod=$_GET['Cod'];
$titulo="NModificarDepositario";
include_once("../../class/bancodepositario.php");
$bancodepositario=new bancodepositario;
$dep=$bancodepositario->mostrarRegistro($Cod);
$dep=array_shift($dep);

include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
configuracion={todayBtn: "", endDate: "'0d'"};
</script>
<?php include_once($folder."cabecera.php");?>
<form action="actualizar.php" method="post">
<?php campo("Cod","hidden",$Cod)?>
<table class="table table-hover">
	<tr>
    	<td class="der">Nombres</td>
        <td><?php campo("Nombres","text",$dep['Nombres'],"",1,"","",array("size"=>"30"))?></td>
    </tr>
	<tr>
    	<td class="der">Apellido Paterno</td>
        <td><?php campo("Paterno","text",$dep['Paterno'],"",1,"","",array("size"=>"30"))?></td>
    </tr>
    <tr>
    	<td class="der">Apellido Materno</td>
        <td><?php campo("Materno","text",$dep['Materno'],"",1,"","",array("size"=>"30"))?></td>
    </tr>
    <tr>
    	<td class="der">Celular</td>
        <td><?php campo("Celular","text",$dep['Celular'],"",1,"","",array("size"=>"30"))?></td>
    </tr>
    <tr>
    	<td colspan="2">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>