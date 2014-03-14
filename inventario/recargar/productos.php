<?php
include_once("../../login/check.php");
$CodProductoTipo=$_POST['CodProductoTipo'];
include_once("../../class/producto.php");
$producto=new producto;
?>
<option value=""><?php echo $idioma['Seleccionar']?></option>
<?php
foreach($producto->mostrarTodoRegistro("CodProductoTipo=$CodProductoTipo",1,"Nombre") as $pro){
?>
<option value="<?php echo $pro['CodProducto']?>"><?php echo $pro['Nombre']?></option>
<?php	
}
?>