<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NRegistroDeposito";
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
    	<td class="der">Banco</td>
        <td colspan="2"><?php campo("CodBanco","select",$ban,"",1)?></td>
    </tr>
	
    <tr>
    	<td class="der">Número de Boleta</td>
        <td colspan="2"><?php campo("Nombres","text","","",1)?></td>
    </tr>
    <tr>
    	<td class="der">Glosa</td>
        <td colspan="2"><?php campo("Glosa","textarea")?></td>
    </tr>
    
    <tr>
        <td></td>
        <td class="">Monto en Bolivianos: <br><?php campo("MontoBolivianos","text","","",0)?></td>
    	<td class=""> Monto en Dolares:<br><?php campo("MontoDolares","text","","",0)?></td>

    </tr>
    <tr>
    	<td colspan="3">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>