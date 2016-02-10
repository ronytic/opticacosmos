<?php include_once("../../login/check.php");
$titulo="NRegistroFactura";

$CodPaciente=$_GET['CodPaciente'];
$CodUsuarioLog=$_SESSION['CodUsuarioLog'];

include_once("../../class/optica.php");
$optica=new optica;
$opt=$optica->mostrarTodoRegistro("CodOptica=".$_GET['Cod'],1,"");
$opt=array_shift($opt);

/*include_once("../../class/paciente.php");
$paciente=new paciente;
$pacientes=$paciente->mostrarTodoRegistro("",1,"Paterno,Materno,Nombres");

$pac=$paciente->mostrarTodoRegistro("CodPaciente=".$opt['CodPaciente'],1,"Paterno,Materno,Nombres");*/



include_once("../../class/config.php");
$config=new config;
$TC=$config->mostrarConfig("TC",1);

$folder="../../";
$NoRevisar=1;
?>
<?php include_once($folder."cabecerahtml.php");?>
<script language="javascript">
var TC=parseFloat(<?php echo $TC?>);
var Habilitado=0;

</script>
<script language="javascript" src="../../js/factura/registro.js?<?php echo rand()?>"></script>
<?php include_once($folder."cabecera.php");?>
<div class="col-sm-12">
	<div class="widget-box">
        <div class="widget-header widget-header-flat"><h4>Datos de la Factura</h4></div>
        <div class="widget-body widget-main">
        	<form action="guardarfactura.php" method="post" autocomplete="off">
                <table class="table table-bordered">
                    <tr class="resaltar">
                        <td>
                            Fecha:<br>
                            <input type="date" value="<?php echo fecha2Str("",0)?>" required name="FechaFactura" tabindex="1" autofocus>
                        </td>
                        <td>
                            Número de Factura:<br>
                            <input type="text" value="<?php echo ""?>" required class="der col-sm-11" name="NFactura" tabindex="2">
                        </td>
                        <td>
                            Número de Referencia:<br>
                            <input type="text" value="<?php echo ""?>" required readonly class="der col-sm-11" name="NReferencia">
                        </td>
                    </tr>
                    <tr class="resaltar">
                        <td colspan="2">
                            Señores:<br>
                            <input type="text" value="<?php echo ""?>" required class="col-sm-11" name="Senor" tabindex="3">
                        </td>
                        <td>
                            NIT:<br>
                            <input type="text" value="<?php echo ""?>" required class="col-sm-11" name="Nit" tabindex="4">
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered table-striped">
                    <thead><th width="50">N</th><th colspan="2">Detalle</th><th width="150">Monto</th><th width="50"></th></thead>
                    <tr class="resaltar success" id="marca">
                        <td><a href="" class="btn btn-success btn-xs" id="aumentar"><i class="icon-plus"></i></a></td>
                        <td class="der" colspan="2">Total:</td>
                        <td><input type="text" name="Total" readonly class="der resaltar" value="0.00" id="total"></td>
                    </tr>
                    <tr class="resaltar info">
                        <td rowspan="2"></td>
                        <td class="resaltar" rowspan="2">Observación:<br><input type="text" name="Observacion" id="observacion" class="col-sm-12"></td>
                        <td class="der" width="150">Cancelado:</td>
                        <td><input type="text" name="Cancelado" class="der resaltar" value="0.00" id="cancelado"></td>
                    </tr>
                    <tr class="resaltar warning">

                        <td class="der">Monto Devuelto:</td>
                        <td><input type="text" name="MontoDevuelto" class="der resaltar" value="0.00" readonly id="montodevuelto"></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <center>
                                <a href="#" class="btn btn-info btn-xs">Cancelar</a>
                                <input type="submit" value="Guardar" class="btn btn-success" id="guardar">
                            </center>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
	</div>
</div>

<?php include_once($folder."pie.php");?>