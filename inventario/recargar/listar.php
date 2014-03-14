<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NBusquedaInventario";
include_once("../../class/productotipo.php");
$productotipo=new productotipo;
include_once("../../class/producto.php");
$producto=new producto;
$tp=todolista($productotipo->mostrarTodoRegistro("",1,"Nombre"),"CodProductoTipo","Nombre","",1);
$pro=todolista($producto->mostrarTodoRegistro("",1,"Nombre"),"CodProducto","Nombre","",1);
$sino=array("1"=>$idioma["Si"],"0"=>$idioma['No']);
include_once($folder."cabecerahtml.php");
?>
<?php include_once($folder."cabecera.php");?>

<div class="col-sm-12">
	<div class="widget-box">
    	<div class="widget-header widget-header-flat"><h4><?php echo $idioma[$titulo]?>- <?php echo $idioma['CriterioBusqueda']?></h4></div>
        <div class="widget-body">
        	<div class="widget-main">
            	<div class="main row">
                	<form action="busqueda.php" method="post" class="formulario">
                    
                    
                    <!--<div class="col-sm-3">
                        <label><?php echo $idioma['TipoProducto'] ?></label>
                        <br>
                        <?php campo("CodProductoTipo","select",$tp,"")?>
                    </div>-->
                    <div class="col-sm-3">
                        <label><?php echo $idioma['Producto'] ?></label>
                        <br>
                        <?php campo("CodProducto","select",$pro,"")?>
                    </div>
                    <div class="col-sm-3">
                        <label><?php echo $idioma['EnExistencia'] ?></label>
                        <br>
                        <?php campo("EnExistencia","select",$sino,"col-xs-12",1)?>
                    </div>
                    <div class="col-sm-3">
                        <label><?php echo $idioma['Observacion'] ?></label>
                        <br>
                        <?php campo("Observacion","text","","col-xs-12")?>
                    </div>
                    <div class="col-sm-3">
                    	<br>
                        <?php campo("","submit",$idioma['Buscar'],"btn btn-success col-xs-12")?>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="widget-box">
    	<div class="widget-header widget-header-flat"><h4><?php echo $idioma['Resultado']?></h4></div>
        <div class="widget-body">
        	<div class="widget-main">
            	<div class="main" id="respuestaformulario">
                </div>
            </div>
        </div>
    </div>
</div>




<?php include_once($folder."pie.php");?>