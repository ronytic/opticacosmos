<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NRegistroDepositario";
include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
configuracion={todayBtn: "", endDate: "'0d'"};
</script>
<?php include_once($folder."cabecera.php");?>
<form action="guardar.php" method="post">
<table class="table table-hover">
	<tr>
    	<td class="der">Nombres</td>
        <td><?php campo("Nombres","text","","",1,"","",array("size"=>"30"))?></td>
    </tr>
	<tr>
    	<td class="der">Apellido Paterno</td>
        <td><?php campo("Paterno","text","","",1,"","",array("size"=>"30"))?></td>
    </tr>
    <tr>
    	<td class="der">Apellido Materno</td>
        <td><?php campo("Materno","text","","",1,"","",array("size"=>"30"))?></td>
    </tr>
    <tr>
    	<td class="der">Celular</td>
        <td><?php campo("Celular","text","","",1,"","",array("size"=>"30"))?></td>
    </tr>
    <tr>
    	<td colspan="2">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>