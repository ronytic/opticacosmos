<?php
include_once("../../login/check.php");
$folder="../../";
$Cod=$_GET['Cod'];
$titulo="NModificarDatosUsuario";
$nivelusuario=array("2"=>"Gerente","3"=>"Administrador","4"=>"Secretaria","5"=>"Vendedor");
include_once("../../class/usuario.php");
$usuario1=new usuario;
$pac=$usuario1->mostrarRegistro($Cod);
$pac=array_shift($pac);
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
    	<td class="der"><?php echo $idioma['Usuario'] ?></td>
        <td><?php campo("Usuario","text",$pac['Usuario'],"",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Contrasena'] ?></td>
        <td><?php campo("Contrasena","password",$pac['Pass'],"",1)?></td>
    </tr>
    
    <tr>
    	<td class="der"><?php echo $idioma['NivelUsuario'] ?></td>
        <td><?php campo("Nivel","select",$nivelusuario,"",1,"","","",$pac['Nivel'])?></td>
    </tr>

	<tr>
    	<td class="der"><?php echo $idioma['ApellidoPaterno'] ?></td>
        <td><?php campo("Paterno","text",$pac['Paterno'],"",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['ApellidoMaterno'] ?></td>
        <td><?php campo("Materno","text",$pac['Materno'],"",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Nombres'] ?></td>
        <td><?php campo("Nombres","text",$pac['Nombres'],"",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Ci'] ?></td>
        <td><?php campo("Ci","text",$pac['Ci'],"",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Telefono'] ?></td>
        <td class=""><?php campo("Telefono","text",$pac['Telefono'])?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Celular'] ?></td>
        <td><?php campo("Celular","text",$pac['Celular'],"",1)?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Direccion'] ?></td>
        <td><?php campo("Direccion","text",$pac['Direccion'],"col-xs-12",1,"","",array("maxlength"=>250))?></td>
    </tr>
    <tr>
    	<td class="der"><?php echo $idioma['Observaciones'] ?></td>
        <td><?php campo("Observaciones","textarea",$pac['Observacion'])?></td>
    </tr>
    <tr>
    	<td colspan="2">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>