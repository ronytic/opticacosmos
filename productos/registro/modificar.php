<?php
include_once("../../login/check.php");
$folder="../../";
$Cod=$_GET['Cod'];
$titulo="NModificarDatosProducto";
include_once("../../class/producto.php");
$producto=new producto;
$pro=$producto->mostrarRegistro($Cod);
$pro=array_shift($pro);
include_once("../../class/productotipo.php");
$productotipo=new productotipo;
$pt=todolista($productotipo->mostrarTodoRegistro("",1,"Nombre"),"CodProductoTipo","Nombre","");
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
    	<td class="der"><?php echo $idioma['Nombre'] ?></td>
        <td><?php campo("Nombre","text",$pro['Nombre'],"",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['UnidadMedida'] ?></td>
        <td><?php campo("Unidad","text",$pro['Unidad'],"",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['TipoProducto'] ?></td>
        <td><?php campo("CodProductoTipo","select",$pt,"",1,"","","",$pro['CodProductoTipo'])?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Descripcion'] ?></td>
        <td><?php campo("Descripcion","textarea",$pro['Descripcion'])?></td>
    </tr>
    <tr>
    	<td colspan="2">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>