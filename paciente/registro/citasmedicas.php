<?php include_once("../../login/check.php");
$titulo="NCitasMedicas";
$Cod=$_GET['Cod'];
include_once("../../class/paciente.php");
$paciente=new paciente;
$pac=$paciente->mostrarPaciente($Cod);
$pac=array_shift($pac);

$areas=array("Optica"=>$idioma["Optica"]);
$folder="../../";
?>
<?php include_once($folder."cabecerahtml.php");?>
<script language="javascript">
$(document).on("ready",function(){
	
	
	
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
                </table>
                <a onClick="javascript:history.back();" class="btn btn-xs"><?php echo $idioma['VolverSeleccionarPaciente']?></a>
            </div>
        </div>
        
        <div class="widget-header widget-header-flat"><h4><?php echo $idioma['NuevaCitaMedica']?></h4></div>
        <div class="widget-body widget-main">
        	<form action="tipoarea.php" method="post">
            <?php campo("CodPaciente","hidden",$Cod)?>
			<table class="table table-bordered">
            	<thead>
                	<tr>
						<th><?php echo $idioma['Area'] ?></th>
                        <th></th>
                    </tr>
                </thead>
            	<tr>
                	<td><?php campo("Area","select",$areas,"",1)?></td>
                    <td><?php campo("","submit",$idioma['RegistrarNuevaCita'],"btn btn-success")?></td>
                </tr>
            </table>
			</form>
        </div>
        <div class="widget-header widget-header-flat"><h4><?php echo $idioma['CitasMedicas']?></h4></div>
        <div class="widget-body widget-main">
        	<div class="">
                <form action="../areas/listado.php" method="post" class="formulario">
                	<?php campo("CodPaciente","hidden",$Cod,"",0)?>
                	<div class="col-sm-4">
                        <div class="input-daterange input-group FechaRangoIdependiente">
                            <label><?php echo $idioma['Desde']?></label>
                            <input type="text" class="input-sm form-control" name="Desde" value="<?php echo fecha2Str(); ?>" />
                            <span class="input-group-addon"></span>
                            <label><?php echo $idioma['Hasta']?></label>
                            <input type="text" class="input-sm form-control" name="Hasta" value="<?php echo fecha2Str(); ?>"/>
                  			
                        </div>
                    </div>
                    <div class="col-sm-2">
                    <label><?php echo $idioma['NumeroBoleta']?></label>
                            <input type="text" class="input-sm form-control" name="NumeroBoleta" value=""/>        
                    </div>  
                    <div class="col-sm-2">
                    	<label ><?php echo $idioma['Area']?></label><br>
                    	<?php campo("Area","select",$areas,"",0)?>
                    </div>
                    <div class="col-sm-4"><br>	
                    	<?php campo("","submit",$idioma['Buscar'],"btn btn-success")?>
                    </div>
                    <div class="clearfix"></div>
                    
                </form>

                
           
            <hr>
            <div class="" id="respuestaformulario"></div>
        </div>
    </div>
</div>
<?php include_once($folder."pie.php");?>