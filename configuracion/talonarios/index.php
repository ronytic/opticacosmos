<?php
include_once("../../login/check.php");
$folder="../../";
include_once("../../class/usuario.php");
$usuario=new usuario;
$us2=$usuario->mostrarUsuarios("Nivel!=1");
//echo "<pre>";
//print_r($us2);

$us2=todolista($usuario->mostrarUsuarios("Nivel!=1"),"CodUsuario","Paterno,Materno,Nombres"," ");
$titulo="NRegistroNuevoTalonario";
include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
configuracion={todayBtn: "", endDate: "'0d'"};
</script>
<?php include_once($folder."cabecera.php");?>
<form action="guardar.php" method="post">
<table class="table table-hover">
	<tr>
    	<td class="der"><?php echo $idioma['Usuario'] ?></td>
        <td><?php campo("CodUsuarioAsignado","select",$us2,"",1)?></td>
    </tr>	
	<tr>
    	<td class="der"><?php echo $idioma['Minimo'] ?></td>
        <td><?php campo("Minimo","number","","",1)?></td>
    </tr>
	<tr>
    	<td class="der"><?php echo $idioma['Maximo'] ?></td>
        <td><?php campo("Maximo","number","","",1)?></td>
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