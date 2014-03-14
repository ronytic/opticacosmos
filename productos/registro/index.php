<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NRegistroNuevoProducto";
include_once("../../class/productotipo.php");
$productotipo=new productotipo;
$pt=todolista($productotipo->mostrarTodoRegistro("",1,"Nombre"),"CodProductoTipo","Nombre","");

include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
configuracion={todayBtn: false, endDate: "'0d'"};
</script>
<?php include_once($folder."cabecera.php");?>
<form action="guardar.php" method="post">
<table class="table table-hover">
    <tr>
    	<td class="der"><?php echo $idioma['Nombre'] ?></td>
        <td><?php campo("Nombre","text","","",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['UnidadMedida'] ?></td>
        <td><?php campo("Unidad","text","","",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['TipoProducto'] ?></td>
        <td><?php campo("CodProductoTipo","select",$pt,"",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Descripcion'] ?></td>
        <td><?php campo("Descripcion","textarea")?></td>
    </tr>
    <tr>
    	<td colspan="2">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>