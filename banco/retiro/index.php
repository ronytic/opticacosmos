<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NRegistroRetiro";
include_once("../../class/banco.php");
$banco=new banco;
$ban=todolista($banco->mostrarTodoRegistro("",1,"Nombre"),"CodBanco","Nombre,NumeroCuenta,TipoCuenta"," - ");

include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
configuracion={todayBtn: false, endDate: "'0d'"};
</script>
<?php include_once($folder."cabecera.php");?>
<form action="guardar.php" method="post">
<table class="table table-hover">
    <tr>
    	<td class="der">Fecha del Deposito</td>
        <td colspan="2"><?php campo("FechaRetiro","date",fecha2Str("",0),"",1,"","",array("max"=>0))?></td>
    </tr>
    <tr>
    	<td class="der">Banco</td>
        <td colspan="2"><?php campo("CodBanco","select",$ban,"col-sm-10",1,"","")?></td>
    </tr>

    <tr>
    	<td class="der">Número de Boleta</td>
        <td colspan="2"><?php campo("NBoleta","text","","",1)?></td>
    </tr>
    <tr>
    	<td class="der">Glosa</td>
        <td colspan="2"><?php campo("Glosa","textarea","",0,"","","",array("cols"=>40,"rows"=>5))?></td>
    </tr>
    
    <tr>
        <td class="der">Monto Depositado</td>
        <td class=""><?php campo("Monto","number","0","der",1,"","",array("min"=>0))?></td>


    </tr>
    <tr>
    	<td colspan="3">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>