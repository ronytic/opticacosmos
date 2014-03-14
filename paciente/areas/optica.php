<?php include_once("../../login/check.php");
$titulo="NPedidoOptica";
$CodPaciente=$_GET['CodPaciente'];
include_once("../../class/paciente.php");
$paciente=new paciente;
$pac=$paciente->mostrarPaciente($CodPaciente);
$pac=array_shift($pac);

$areas=array("Optica"=>$idioma["Optica"]);
$folder="../../";
$NoRevisar=1;
?>
<?php include_once($folder."cabecerahtml.php");?>
<script language="javascript">
$(document).on("ready",function(){
	$("#Total,#ACuenta").change(function(e) {
       var Total=$("#Total").val(); 
	   var ACuenta=$("#ACuenta").val(); 
	   var Saldo=Total-ACuenta;
	   $("#Saldo").val(Saldo);
    });
});
</script>
<?php include_once($folder."cabecera.php");?>
<div class="col-sm-12">
	<div class="widget-box">
    	<div class="widget-header widget-header-flat"><h4><?php echo $idioma['DatosPaciente'] ?></h4></div>
        <div class="widget-body">
        	<div class="widget-main">
            	<table class="table table-bordered">
                	<thead>
                    	<tr>
                        	<th><?php echo $idioma['ApellidoPaterno'] ?></th>
                            <th><?php echo $idioma['ApellidoMaterno'] ?></th>
                            <th><?php echo $idioma['Nombres'] ?></th>
                            <th><?php echo $idioma['Ci'] ?></th>
                            <th><?php echo $idioma['Telefono'] ?></th>
                            <th><?php echo $idioma['Celular'] ?></th>
                            <th><?php echo $idioma['FechaNacimiento'] ?></th>
                        </tr>
                    </thead>
                    <tr>
                    	<td><?php echo $pac['Paterno']?></td>
                        <td><?php echo $pac['Materno']?></td>
                        <td><?php echo $pac['Nombres']?></td>
                        <td><?php echo $pac['Ci']?></td>
                        <td><?php echo $pac['Telefono']?></td>
                        <td><?php echo $pac['Celular']?></td>
                        <td><?php echo fecha2Str($pac['FechaNac'])?></td>
                    </tr>
                    <tr>
                    	<td colspan="5"><strong><?php echo $idioma['Direccion'] ?>: </strong><?php echo $pac['Direccion']?></td>
                    </tr>
                </table>
                <a onClick="javascript:history.back();" class="btn btn-xs"><?php echo $idioma['VolverSeleccionar']?></a>
            </div>
        </div>
        
        <div class="widget-header widget-header-flat"><h4><?php echo $idioma['OrdenTrabajo']?></h4></div>
        <div class="widget-body widget-main">
        	<form action="guardaroptica.php" method="post">
            <?php campo("CodPaciente","hidden",$CodPaciente,"",1)?>
			<table class="table table-bordered table-striped">
            	<thead>
                </thead>
                <tr>
                	<td><?php echo $idioma['NumeroBoleta']?><br><?php campo("NumeroBoleta","text","","col-sm-12",1)?></td>
                </tr>
            	<tr>
                	<td><?php echo $idioma['FechaPedido']?><br><?php campo("Fecha","text",fecha2Str(),"fecha",1)?></td>
                    <td><?php echo $idioma['FechaEntrega']?><br><?php campo("FechaEntrega","text",fecha2Str(),"fecha",1)?></td>
                    <td><?php echo $idioma['HoraEntrega']?><br><?php campo("HoraEntrega","time","","hora",1)?></td>
                    <td colspan="2"><?php echo $idioma['Recepcion']?><br><?php campo("Recepcion","text",$NombresSis." ".$ApellidoPSis." ".$ApellidoMSis,"col-sm-12",1)?></td>
                    
                </tr>
                <tr>
               		<td colspan="2"><?php echo $idioma['Cristales']?><br><?php campo("Cristales","text","","col-sm-12",1)?></td>
                    <td colspan="3"><?php echo $idioma['Armazon']?><br><?php campo("Armazon","text","","col-sm-12",1)?></td>
                </tr>
                <tr>
                	<td colspan="2"><?php echo 'Organicos'?><br><?php campo("Organicos","text","","col-sm-12",1)?></td>
                    <td><?php echo'Tinte'?><br><?php campo("Tinte","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Uv'?><br><?php campo("Uv","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Pcr'?><br><?php campo("Pcr","text","","col-sm-12",1)?></td>
                </tr>
                <tr>
                	<td colspan="5"><strong><?php echo $idioma['Lejos'] ?></strong></td>
                </tr>
                <tr>
                	<td><?php echo 'O.D. Est'?><br><?php campo("LOdEst1","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Cil.'?><br><?php campo("LCil1","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Eje'?><br><?php campo("LEje1","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Base'?><br><?php campo("LBase1","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Dip'?><br><?php campo("LDip1","text","","col-sm-12",1)?>mm</td>
                </tr>
                <tr>
                	<td><?php echo 'O.D. Est'?><br><?php campo("LOdEst2","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Cil.'?><br><?php campo("LCil2","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Eje'?><br><?php campo("LEje2","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Base'?><br><?php campo("LBase2","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Dip'?><br><?php campo("LDip2","text","","col-sm-12",1)?>mm</td>
                </tr>
                <tr>
                	<td colspan="5"><strong><?php echo $idioma['Cerca'] ?></strong></td>
                </tr>
                <tr>
                	<td><?php echo 'O.D. Est'?><br><?php campo("COdEst1","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Cil.'?><br><?php campo("CCil1","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Eje'?><br><?php campo("CEje1","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Base'?><br><?php campo("CBase1","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Dip'?><br><?php campo("CDip1","text","","col-sm-12",1)?>mm</td>
                </tr>
                <tr>
                	<td><?php echo 'O.D. Est'?><br><?php campo("COdEst2","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Cil.'?><br><?php campo("CCil2","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Eje'?><br><?php campo("CEje2","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Base'?><br><?php campo("CBase2","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Dip'?><br><?php campo("CDip2","text","","col-sm-12",1)?>mm</td>
                </tr>
                <tr>
                	<td><?php echo 'Bifocales'?><br><?php campo("Bifocales","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Otros'?><br><?php campo("Otros","text","","col-sm-12",1)?></td>
                    <td><?php echo 'Alt'?><br><?php campo("Alt","text","","col-sm-12",1)?>mm</td>
                    <td><?php echo 'Ad+'?><br><?php campo("Ad","text","","col-sm-12",1)?></td>
                </tr>
                <tr>
                	<td colspan="2"><?php echo $idioma['Doctor']?><br><?php campo("Doctor","text","","col-sm-12",1)?></td>
                    <td colspan="1"><?php echo $idioma['Precio']?><br><?php campo("Precio","text","","col-sm-12",1)?></td>
                    <td colspan="2"><?php echo $idioma['Estuche']?><br><?php campo("Estuche","text","","col-sm-12",1)?></td>
                </tr>
                <tr class="danger">
                	<td colspan="2"><?php echo $idioma['PrecioTotal']?><br><?php campo("Total","text","0","col-sm-12",1)?></td>
                    <td colspan="2"><?php echo $idioma['ACuenta']?><br><?php campo("ACuenta","text","0","col-sm-12",1)?></td>
                    <td colspan="2"><?php echo $idioma['Saldo']?><br><?php campo("Saldo","text","0","col-sm-12",1)?></td>
                </tr>
                <tr>
                	<td colspan="5"><?php echo $idioma['Observaciones']?><br><?php campo("Observaciones","textarea","","col-sm-12",1)?></td>
                </tr>
                <tr>
                	<td colspan="5"><div class="alert alert-danger"><?php echo $idioma['NotaOpticaGuardar'] ?></div><br><?php campo("Area","submit",$idioma['Registrar'],"btn btn-success")?></td>
                </tr>
            </table>
			</form>
        </div>
    </div>
</div>
<?php include_once($folder."pie.php");?>