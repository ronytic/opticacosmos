<?php
include_once("../../login/check.php");
$folder="../../";
$Cod=$_GET['Cod'];
$titulo="NModificarTipoProducto";
include_once("../../class/productotipo.php");
$productotipo=new productotipo;
$pt=$productotipo->mostrarRegistro($Cod);
$pt=array_shift($pt);
$categoria=array("Cristales"=>"Cristales","Armazon"=>"Armazon","Otros"=>"Otros");
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
        <td><?php campo("Nombre","text",$pt['Nombre'],"",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Descripcion'] ?></td>
        <td><?php campo("Descripcion","textarea",$pt['Descripcion'])?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Categoria'] ?></td>
        <td><?php campo("Categoria","select",$categoria,"",1,"",0,"",$pt['Categoria'])?></td>
    </tr>
    <tr>
    	<td colspan="2">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>