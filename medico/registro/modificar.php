<?php
include_once("../../login/check.php");
$folder="../../";
$Cod=$_GET['Cod'];
$titulo="NModificarDatosMedico";
include_once("../../class/medico.php");
$medico=new medico;
$med=$medico->mostrarRegistro($Cod);
$med=array_shift($med);
include_once("../../class/especialidad.php");
$especialidad=new especialidad;
$esp=todolista($especialidad->mostrarTodoRegistro("",1,"Nombre"),"CodEspecialidad","Nombre","");
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
    	<td class="der"><?php echo $idioma['ApellidoPaterno'] ?></td>
        <td><?php campo("Paterno","text",$med['Paterno'],"",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['ApellidoMaterno'] ?></td>
        <td><?php campo("Materno","text",$med['Materno'],"",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Nombres'] ?></td>
        <td><?php campo("Nombres","text",$med['Nombres'],"",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Ci'] ?></td>
        <td><?php campo("Ci","text",$med['Ci'],"",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Telefono'] ?></td>
        <td class=""><?php campo("Telefono","text",$med['Telefono'])?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Celular'] ?></td>
        <td><?php campo("Celular","text",$med['Celular'],"",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['FechaNacimiento'] ?></td>
        <td><?php campo("FechaNac","text",fecha2Str($med['FechaNac']),"fecha")?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Especialidad'] ?></td>
        <td><?php campo("CodEspecialidad","select",$esp,"",1,"",0,"",$med['CodEspecialidad'])?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Observaciones'] ?></td>
        <td><?php campo("Observaciones","textarea",$med['Observaciones'])?></td>
    </tr>
    <tr>
    	<td colspan="2">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>