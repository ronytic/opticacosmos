<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NRegistroNuevoPaciente";
include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
configuracion={todayBtn: false, endDate: "'0d'"};
</script>
<?php include_once($folder."cabecera.php");?>
<form action="guardar.php" method="post">
<table class="table table-hover">
	<tr>
    	<td class="der"><?php echo $idioma['ApellidoPaterno'] ?></td>
        <td><?php campo("Paterno","text","","",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['ApellidoMaterno'] ?></td>
        <td><?php campo("Materno","text","","",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Nombres'] ?></td>
        <td><?php campo("Nombres","text","","",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Ci'] ?></td>
        <td><?php campo("Ci","text","","",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Telefono'] ?></td>
        <td class=""><?php campo("Telefono","text","")?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Celular'] ?></td>
        <td><?php campo("Celular","text","","",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['FechaNacimiento'] ?></td>
        <td><?php campo("FechaNac","text","","fecha")?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Direccion'] ?></td>
        <td><?php campo("Direccion","text","","col-xs-12",1,"","",array("maxlength"=>250))?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Observaciones'] ?></td>
        <td><?php campo("Observaciones","textarea")?></td>
    </tr>
    <tr>
    	<td colspan="2">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>