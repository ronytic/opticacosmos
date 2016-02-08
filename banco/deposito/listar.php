<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NBusquedaBoletasMedicas";
include_once("../../class/depositario.php");
$depositario=new depositario;
$depo=todolista($depositario->mostrarTodoRegistro("",1,"Nombres,Paterno,Materno"),"CodDepositario","Nombres","",1);
$depo['%']="Todos";
include_once("../../class/banco.php");
$banco=new banco;
$bancos=todolista($banco->mostrarTodoRegistro("",1,"Nombre"),"CodBanco","Nombre","",1);
$bancos['%']="Todos";
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
                        <label>Fecha del Deposito</label>
                        <br>
                        Desde:<?php campo("FechaDepositoDesde","date",fecha2Str("",0),"",1,"","",array("max"=>0))?>
                        Hasta: <?php campo("FechaDepositoHasta","date",fecha2Str("",0),"",1,"","",array("max"=>0))?>
                    </div>
                    <div class="col-sm-3">
                        <label>Banco</label>
                        <br>
                        <?php campo("CodBanco","select",$bancos,"","","","","","%")?>
                    </div>
                    <div class="col-sm-3">
                        <label>Depositario</label>
                        <br>
                        <?php campo("CodDepositario","select",$depo,"","","","","","%")?>
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