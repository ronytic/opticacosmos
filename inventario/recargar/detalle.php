<?php
include_once("../../login/check.php");
$folder="../../";
$Cod=$_GET['Cod'];
$titulo="NDetalleInventario";
include_once("../../class/producto.php");
$producto=new producto;
$pro=$producto->mostrarRegistro($Cod);
$pro=array_shift($pro);
include_once("../../class/productotipo.php");
$productotipo=new productotipo;
$protipo=$productotipo->mostrarRegistro($pro['CodProductoTipo']);
$protipo=array_shift($protipo);
//$pt=todolista($productotipo->mostrarTodoRegistro("",1,"Nombre"),"CodProductoTipo","Nombre","");
include_once("../../class/inventario.php");
$inventario=new inventario;
$inv=$inventario->mostrarTodoRegistro("CodProducto=".$Cod);

include_once("../../class/usuario.php");
$usuario=new usuario;


if(in_array( $_SESSION['Nivel'],array(1,2,3))){
    $sw=1;
}else{
    $sw=0;
}

include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
configuracion={todayBtn: false, endDate: "'0d'"};
</script>
<?php include_once($folder."cabecera.php");?>
<a href="listar.php" class="btn btn-xs">Volver</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tipo de Producto</th>
            <th>Producto</th>
            <th>Unidad</th>
        </tr>
    </thead>
    <tr>
        <td><?php echo $protipo['Nombre']?></td>
        <td><?php echo $pro['Nombre']?></td>
        <td><?php echo $pro['Unidad']?></td>
    </tr>
</table>

<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th width="50">N</th>
            <th width="50">Cantidad Recargada</th>
            <th width="50">Cantidad Stock</th>
            <th width="90">Fecha de Recarga</th>
            <th width="150">Empleado de Recarga</th>
            <th width="150">Observación de Recarga</th>
            
            <th width="90">Fecha de Modificación</th>
            <th width="150">Empleado de Modificación</th>
            <th width="150">Observación de Modificación</th>
            <th></th>
        </tr>
    </thead>
    <?php foreach($inv as $in){$i++;
        $CantidadTotal+=$in['Cantidad'];
        $CantidadStockTotal+=$in['CantidadStock'];
        $us=$usuario->mostrarDatos($in['CodUsuario']);
        $us=array_shift($us);
        
        $usm=$usuario->mostrarDatos($in['CodUsuarioModificacion']);
        $usm=array_shift($usm);
    ?>
        <tr>
            <td class="der"><?php echo $i?></td>
            <td class="der"><?php echo $in['Cantidad']?></td>
            <td class="der"><?php echo $in['CantidadStock']?></td>
            <td class=""><?php echo fecha2Str($in['FechaRegistro'])?>
                            <br>
                            <?php echo ($in['HoraRegistro'])?></td>
            <td><?php echo capitalizar($us['Paterno']." ".$us['Materno']." ".$us['Nombres'])?></td>
            <td class="der"><?php echo $in['Observacion']?></td>
            <td class=""><?php echo fecha2Str($in['FechaModificacion'])?>
                            <br>
                            <?php echo ($in['HoraModificacion'])?></td>
            <td><?php echo capitalizar($usm['Paterno']." ".$usm['Materno']." ".$usm['Nombres'])?></td>
            <td class=""><?php echo $in['ObservacionModificacion']?></td>
            
            <td>
                <?php 
                if($in['Cantidad']==$in['CantidadStock'] && $sw==1){
                ?>
                <a href="modificar.php?Cod=<?php echo $in['CodInventario']?>&CodProducto=<?php echo $Cod?>" class="btn btn-xs" title="Modificar">M</a>
                <?php    
                }?>
            </td>
        </tr>
    <?php    
    }?>
    <tr class="resaltar">
        <td class="der">Total</td>
        <td class="der"><?php echo $CantidadTotal?></td>
        <td class="der"><?php echo $CantidadStockTotal?></td>
        <td colspan="4"></td>
    </tr>
</table>
<form action="actualizar.php" method="post">
<?php campo("Cod","hidden",$Cod)?>

</form>
<?php include_once($folder."pie.php");?>