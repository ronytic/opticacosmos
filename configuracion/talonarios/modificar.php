<?php
include_once("../../login/check.php");
$folder="../../";
$Cod=$_GET['Cod'];
$titulo="NModificarDatosPaciente";
include_once("../../class/especialidad.php");
$especialidad=new especialidad;
$esp=$especialidad->mostrarRegistro($Cod);
$esp=array_shift($esp);
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
    	<td class="der"><?php echo $idioma['NombreEspecialidad'] ?></td>
        <td><?php campo("Nombre","text",$esp['Nombre'],"",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Detalle'] ?></td>
        <td><?php campo("Detalle","textarea",$esp['Detalle'])?></td>
    </tr>
    <tr>
    	<td colspan="2">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>