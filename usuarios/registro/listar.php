<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NBusquedaPacientes";
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
                    <div class="col-sm-3">
                        <label><?php echo $idioma['ApellidoPaterno'] ?></label>
                        <br>
                        <?php campo("Paterno","text","","col-xs-12","","",1)?>
                    </div>
                    <div class="col-sm-3">
                        <label><?php echo $idioma['ApellidoMaterno'] ?></label>
                        <br>
                        <?php campo("Materno","text","","col-xs-12")?>
                    </div>
                    <div class="col-sm-3">
                        <label><?php echo $idioma['Nombres'] ?></label>
                        <br>
                        <?php campo("Nombres","text","","col-xs-12")?>
                    </div>
                    <div class="col-sm-3">
                        <label><?php echo $idioma['Ci'] ?></label>
                        <br>
                        <?php campo("Ci","text","","col-xs-12")?>
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