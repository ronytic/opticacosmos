<?php
include_once("../../login/check.php");
$folder="../../";
$Cod=$_GET['Cod'];
$titulo="NModificarInventario";

include_once("../../class/inventario.php");
$inventario=new inventario;
$inv=$inventario->mostrarRegistro($Cod);
$inv=array_shift($inv);

include_once("../../class/producto.php");
$producto=new producto;
$pro=$producto->mostrarRegistro($inv['CodProducto']);
$pro=array_shift($pro);

include_once("../../class/productotipo.php");
$productotipo=new productotipo;
$protipo=$productotipo->mostrarRegistro($pro['CodProductoTipo']);
$protipo=array_shift($protipo);
//$pt=todolista($productotipo->mostrarTodoRegistro("",1,"Nombre"),"CodProductoTipo","Nombre","");


include_once("../../class/usuario.php");
$usuario=new usuario;


if(in_array( $_SESSION['Nivel'],array(1,2,3))){
    $sw=1;
}else{
    $sw=0;
}

$us=$usuario->mostrarDatos($inv['CodUsuario']);
$us=array_shift($us);

include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
configuracion={todayBtn: false, endDate: "'0d'"};
</script>
<?php include_once($folder."cabecera.php");?>
<a href="detalle.php?Cod=<?php echo $inv['CodProducto']?>" class="btn btn-xs">Volver</a>
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
<h4>Datos Actuales de Inventario</h4>
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th width="50">Cantidad Recargada</th>
            <th width="50">Cantidad Stock</th>
            <th width="90">Fecha de Recarga</th>
            <th width="250">Empleado de Recarga</th>
            <th width="350">Observación de Recarga</th>
            
        </tr>
    </thead>
        <tr>
            <td class="der"><?php echo $inv['Cantidad']?></td>
            <td class="der"><?php echo $inv['CantidadStock']?></td>
            <td class=""><?php echo fecha2Str($inv['FechaRegistro'])?>
                            <br>
                            <?php echo ($inv['HoraRegistro'])?></td>
            <td><?php echo capitalizar($us['Paterno']." ".$us['Materno']." ".$us['Nombres'])?></td>
            <td class="der"><?php echo $inv['Observacion']?></td>
            
        </tr>
</table>
<form action="actualizar.php" method="post">
<?php campo("CodProducto","hidden",$inv['CodProducto'])?>
<?php campo("Cod","hidden",$Cod)?>
<?php campo("Cantidad","hidden",$inv['Cantidad'])?>
<?php campo("CantidadStock","hidden",$inv['CantidadStock'])?>
<h4>Datos Nuevos a Actualizar a Inventario</h4>
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th width="250">Nueva Cantidad de Stock</th>
            <th width="550">Observación de la Modificación</th>
            <th width="250"></th>
        </tr>
    </thead>
        <tr>
            <td class=""><?php campo("CantidadNueva","number","","form-control der",1,"0",1,array("min"=>0))?></td>

            <td class=""><?php campo("ObservacionModificacion","textarea","","form-control",1)?></td>
            <td><?php campo("","submit","Modificar","btn btn-success")?></td>
        </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>