<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NRegistroDeposito";
include_once("../../class/banco.php");
$banco=new banco;
$ban=todolista($banco->mostrarTodoRegistro("",1,"Nombre"),"CodBanco","Nombre,NumeroCuenta,TipoCuenta"," - ");

include_once("../../class/depositario.php");
$depositario=new depositario;
$dep=todolista($depositario->mostrarTodoRegistro("",1,"Paterno,Materno,Nombres"),"CodDepositario","Paterno,Materno,Nombres"," ");

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
    	<td class="der">Depositario</td>
        <td colspan="2"><?php campo("CodDepositario","select",$dep,"",1)?></td>
    </tr>
    <tr>
    	<td class="der">Número de Boleta</td>
        <td colspan="2"><?php campo("Nombres","text","","",1)?></td>
    </tr>
    <tr>
    	<td class="der">Glosa</td>
        <td colspan="2"><?php campo("Glosa","textarea","",0,"","","",array("cols"=>40,"rows"=>5))?></td>
    </tr>
    
    <tr>
        <td class="der">Monto Depositado</td>
        <td class=""><?php campo("Monto","number","","",0)?></td>


    </tr>
    <tr>
    	<td colspan="3">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>