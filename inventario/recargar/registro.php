<?php
include_once("../../login/check.php");
$l=$_POST['l'];
include_once("../../class/productotipo.php");
$productotipo=new productotipo;
$pt=todolista($productotipo->mostrarTodoRegistro("",1,"Nombre"),"CodProductoTipo","Nombre","");
?>
<tr>
	<td class="der"><?php echo $l ?></td>
    <td><?php campo("p[$l][CodProductoTipo]","select",$pt,"col-xs-12 CodProductoTipo",0,"","",array("rel"=>"$l"))?><br>
    	<?php campo("p[$l][CodProducto]","select","","col-xs-12 CodProducto",0,"","",array("rel"=>"$l"))?>
    </td>
    <td><?php campo("p[$l][Cantidad]","number","0","der col-xs-12 Cantidad",1,"","",array("rel"=>"$l","min"=>0))?>
    	<div class="Unidad centrar" rel="<?php echo $l?>"></div>
    </td>
    <td><?php campo("p[$l][Observacion]","textarea","","col-xs-12 Observacion",0,"","",array("rel"=>"$l","rows"=>4))?></td>
</tr>