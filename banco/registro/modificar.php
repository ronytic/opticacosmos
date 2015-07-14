<?php
include_once("../../login/check.php");
$folder="../../";
$Cod=$_GET['Cod'];
$titulo="NModificarDatosBanco";
include_once("../../class/banco.php");
$banco=new banco;
$ban=$banco->mostrarRegistro($Cod);
$ban=array_shift($ban);
if($ban['TipoCuenta']=="Bolivianos"){
    $bol=array("checked"=>"checked");
}else{
    $dol=array("checked"=>"checked");
}
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
    	<td class="der">Nombre del Banco</td>
        <td><?php campo("Nombre","text",$ban['Nombre'],"",1,"","",array("size"=>"30"))?></td>
    </tr>
    <tr>
    	<td class="der">Número de Cuenta</td>
        <td><?php campo("NumeroCuenta","text",$ban['NumeroCuenta'],"",0,"","",array("size"=>"50"))?></td>
    </tr>
    <tr>
    	<td class="der">Tipo de Cuenta</td>
        <td><label>Bolivianos <?php campo("TipoCuenta","radio","Bolivianos","",0,"","",$bol)?></label> - <label>Dolares <?php campo("TipoCuenta","radio","Dolares","",0,"","",$dol)?></label></td>
    </tr>
    <tr>
    	<td colspan="2">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>