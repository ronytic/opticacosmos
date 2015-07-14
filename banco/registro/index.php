<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="RegistroBanco";
include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
configuracion={todayBtn: "", endDate: "'0d'"};
</script>
<?php include_once($folder."cabecera.php");?>
<form action="guardar.php" method="post">
<table class="table table-hover">
	<tr>
    	<td class="der">Nombre del Banco</td>
        <td><?php campo("Nombre","text","","",1,"","",array("size"=>"30"))?></td>
    </tr>
    <tr>
    	<td class="der">Número de Cuenta</td>
        <td><?php campo("NumeroCuenta","text","","",0,"","",array("size"=>"50"))?></td>
    </tr>
    <tr>
    	<td class="der">Tipo de Cuenta</td>
        <td><label>Bolivianos <?php campo("TipoCuenta","radio","Bolivianos","",0,"","",array("size"=>"50"))?></label> - <label>Dolares <?php campo("TipoCuenta","radio","Dolares","",0,"","",array("size"=>"50"))?></label></td>
    </tr>
    <tr>
    	<td colspan="2">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>