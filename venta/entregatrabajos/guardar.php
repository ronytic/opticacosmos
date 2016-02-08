<?php
include_once("../../login/check.php");
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/
include_once("../../class/optica.php");
$optica=new optica;

$opt=$optica->mostrarTodoRegistro("NumeroBoleta='$NumeroBoleta'");
$opt=array_shift($opt);


//print_r($_SESSION);

extract($_POST);

$CodUsuario=$_SESSION['CodUsuarioLog'];
$NivelUsuario=$_SESSION['Nivel'];
$Fecha=date("Y-m-d");
$Hora=date("H:i:s");

$valores=array("FechaEntregaReal"=>"'$Fecha'","HoraEntregaReal"=>"'$Hora'","EstadoEntrega"=>"1","CodUsuarioEntrega"=>"'$CodUsuario'","NivelEntrega"=>"'$NivelUsuario'","NombreEntrega"=>"'$Recepcion'");
$optica->actualizarRegistro($valores,"CodOptica=$CodOptica");

$Nuevo=0;
$Listar=0;
$Botones=array("index.php"=>"Entregar Otro Trabajo");
$folder="../../";
$Mensajes[]=$idioma["GuardadoCorrectamente"];
//include_once("../../resultado.php");
?>
<?php
//include_once("../../login/check.php");
$NoRevisar=1;
$folder="../../";
$Cod=$opt['CodOptica'];
if($Cod==""){
	$Cod=$_GET['Cod'];	
}
$titulo="NMensajeRespuesta";

include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
configuracion={todayBtn: "", endDate: "'0d'"};
</script>
<?php include_once($folder."cabecera.php");?>
<div class="col-sm-12">
	<div class="widget-box">
    	<div class="widget-header widget-header-flat"><h4><?php echo $idioma['Mensaje'] ?></h4></div>
        <div class="widget-body">
        	<div class="widget-main">
                <ul class="list-unstyled">
                	<?php foreach($Mensajes as $m){?>
                	<li><i class="icon-angle-right bigger-110"></i><?php echo $m ?></li>
                    <?php }?>
                </ul>
                <hr class="separador">
            	<a href="./" class="btn btn-success " target="">Entregar Otro Trabajo</a>
                <a href="<?php echo $folder?>factura/entrega/?Cod=<?php echo $Cod?>" class="btn btn-danger">Facturar</a>
                <hr>
            	
			</div>
		</div>
	</div>
</div>
<?php include_once($folder."pie.php");?>