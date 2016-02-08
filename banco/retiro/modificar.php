<?php
include_once("../../login/check.php");
$folder="../../";
$Cod=$_GET['Cod'];
$titulo="NModificarRetiro";
include_once("../../class/bancoretiro.php");
$bancoretiro=new bancoretiro;
$depo=$bancoretiro->mostrarRegistro($Cod);
$depo=array_shift($depo);

include_once("../../class/banco.php");
$banco=new banco;
$ban=todolista($banco->mostrarTodoRegistro("",1,"Nombre"),"CodBanco","Nombre,NumeroCuenta,TipoCuenta"," - ");

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
    	<td class="der">Fecha del Retiro</td>
        <td colspan="2"><?php campo("FechaRetiro","date",$depo['FechaRetiro'],"",1,"","",array("max"=>0))?></td>
    </tr>
    <tr>
    	<td class="der">Banco</td>
        <td colspan="2"><?php campo("CodBanco","select",$ban,"col-sm-10",1,"","","",$depo['CodBanco'])?></td>
    </tr>
    <tr>
    	<td class="der">Número de Boleta</td>
        <td colspan="2"><?php campo("NBoleta","text",$depo['NBoleta'],"",1)?></td>
    </tr>
    <tr>
    	<td class="der">Glosa</td>
        <td colspan="2"><?php campo("Glosa","textarea",$depo['Glosa'],0,"","","",array("cols"=>40,"rows"=>5))?></td>
    </tr>
    
    <tr>
        <td class="der">Monto Depositado</td>
        <td class=""><?php campo("Monto","number",$depo['Monto'],"der",1,"","",array("min"=>0))?></td>


    </tr>
    <tr>
    	<td colspan="3">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>