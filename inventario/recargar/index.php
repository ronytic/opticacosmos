<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NRecargaInventario";


include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
var l=0;
$(document).on("ready",function(){
$(document).on("click",".aumentar",aumentarregistro)
	function eliminarregistro(e){
		e.preventDefault();
		if(confirm(MensajeEliminarRegistro)){
			$(this).parent().parent().remove();
		}
	}
	aumentarregistro(event);
	function aumentarregistro(e){
		e.preventDefault();
		l++;
		$.post("registro.php",{"l":l},function(data){
			$("#senal").before(data);
			//$(".der").numeric({allow:'.'});
		});
	}
	$(document).on("change",".CodProductoTipo",function(){
		var CodProductoTipo=$(this).val()
		var Linea=$(this).attr("rel");
		$.post("productos.php",{"CodProductoTipo":CodProductoTipo},function(data){
			$(".CodProducto[rel="+Linea+"]").html(data);	
			$(document).on("change",".CodProducto");
		});
	})
	$(document).on("change",".CodProducto",function(){
		var CodProducto=$(this).val()
		//alert(CodProducto);
		var Linea=$(this).attr("rel");
		$.post("unidad.php",{"CodProducto":CodProducto},function(data){
			//alert(data);
			$(".Unidad[rel="+Linea+"]").html(data);	
		});
	})
	
});
</script>
<?php include_once($folder."cabecera.php");?>
<form action="guardar.php" method="post" class="formularioconfirmacion" data-mensaje="¿Seguro que Desea de Recargar estos Productos?">
<table class="table table-bordered table-hover table table-striped table-bordered table-hover">
	<thead>
    	<tr>
        	<th colspan="4"><?php echo $idioma['FechaRegistro']?>: <?php echo fecha2Str();?></th>
        </tr>
    	<tr>
        	<th width="50">N</th>
            <th class="col-xs-6"><?php echo $idioma['Producto']?></th>
            <th width="200"><?php echo $idioma['Cantidad']?></th>
            <th><?php echo $idioma['Observacion']?></th>
        </tr>
    </thead>
    <tr id="senal">
    	<td colspan="2"><a class="btn btn-xs btn-warning aumentar"><?php echo $idioma['Aumentar']?></a></td>
    	<td colspan="2">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>