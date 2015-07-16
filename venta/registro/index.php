<?php include_once("../../login/check.php");
$titulo="NPedidoOptica";
$CodPaciente=$_GET['CodPaciente'];
$CodUsuarioLog=$_SESSION['CodUsuarioLog'];
include_once("../../class/paciente.php");
$paciente=new paciente;
$pacientes=$paciente->mostrarTodoRegistro("",1,"Paterno,Materno,Nombres");

include_once("../../class/medico.php");
$medico=new medico;
$medicos=$medico->mostrarTodoRegistro("",1,"Paterno,Materno,Nombres");

include_once("../../class/especialidad.php");
$especialidad=new especialidad;
$esp=todolista($especialidad->mostrarTodoRegistro("",1,"Nombre"),"CodEspecialidad","Nombre","",1);

include_once("../../class/productotipo.php");
$productotipo=new productotipo;
$protipoc=todolista($productotipo->mostrarTodoRegistro("Categoria='Cristales'",1,"Nombre"),"CodProductoTipo","Nombre","",1);


$protipoa=todolista($productotipo->mostrarTodoRegistro("Categoria='Armazon'",1,"Nombre"),"CodProductoTipo","Nombre","",1);

include_once("../../class/optica.php");
$optica=new optica;
$listaBoletas=$optica->mostrarTodoRegistro("CodUsuarioBoleta=$CodUsuarioLog and Anulado=0 and EstadoEntrega=0 and Emitido=0 and Anulado=0",1,"NumeroBoleta");

include_once("../../class/config.php");
$config=new config;
$TC=$config->mostrarConfig("TC",1);

$areas=array("Optica"=>$idioma["Optica"]);
$folder="../../";
$NoRevisar=1;
?>
<?php include_once($folder."cabecerahtml.php");?>
<script language="javascript">
var TC=parseFloat(<?php echo $TC?>);
var Habilitado=0;

</script>
<script language="javascript" src="../../js/venta/registro.js?<?php echo rand()?>"></script>
<?php include_once($folder."cabecera.php");?>
<div class="col-sm-12">
	<div class="widget-box">
    	
        
        <div class="widget-header widget-header-flat"><h4><?php echo $idioma['OrdenTrabajo']?></h4></div>
        <div class="widget-body widget-main">
        	<form action="guardaroptica.php" method="post" id="formularioguardar" autocomplete="off">

            <?php campo("TC","hidden",$TC,"",1)?>
            <table class="table table-bordered table-striped">
                <tr>
                	<td colspan="1" width="500">
                    <div class="alert alert-danger" id="mensajeboleta"></div>

                    <?php echo $idioma['NumeroBoleta']?>
                    <br><?php campo("NumeroBoleta","number","","col-sm-12 der",1,0,1,array("pattern"=>"[0-9]*","title"=>$idioma['SoloNumeros'],"min"=>0,"tabindex"=>1,"list"=>"talonarios"))?>
                    <datalist id="talonarios">
                        <?php foreach($listaBoletas as $lb){
                        ?>
                        <option class="der"><?php echo $lb['NumeroBoleta']?></option>
                        <?php    
                        }?>
                        
                    </datalist>
                    
                    </td>
                    <td class="centrar">Tasa de Cambio
                        <br>
                        <h3><?php echo $TC?></h3>
                        
                    </td>
                    <td><?php echo $idioma['FechaPedido']?><br><?php campo("Fecha","text",fecha2Str(),"fecha norequerido",1,"",0,array("readonly"=>"readonly","disabled"=>"disabled"))?></td>
                </tr>
            	<tr>
                    <td colspan="3"><?php echo $idioma['EmpleadoRecepcion']?><br><?php campo("Recepcion","text",$NombresSis." ".$ApellidoPSis." ".$ApellidoMSis,"col-sm-12 norequerido",1,"",0,array("readonly"=>"readonly"))?></td>
                    
                </tr>
            </table>
            
            <table class="table table-bordered table-striped">
            	<tr><td colspan="5"><strong><?php echo $idioma['DatosPaciente']?></strong></td></tr>
                <tr>
                    <th><?php echo $idioma['Ci'] ?>
                        <br>
                        <input type="text" name="Ci" tabindex="2" list="Cis" class="form-control">
                        <datalist id="Cis">
                        <?php foreach($pacientes as $p){?>
                            <option value="<?php echo $p['Ci']?>"><?php echo $p['Paterno']." ".$p['Materno']." ".$p['Nombres']?></option>
                        <?php }?>
                        </datalist>
                    </th>
                    <th><?php echo $idioma['Nombres'] ?>
                        <br>
                        <input type="text" name="Nombres" tabindex="3" list="Nombres" required class="form-control">
                    </th>
                    <th><?php echo $idioma['ApellidoPaterno'] ?>
                        <br>
                        <input type="text" name="Paterno" tabindex="4" list="Paternos" autocomplete="off" class="form-control">
                        
                    </th>
                    <th><?php echo $idioma['ApellidoMaterno'] ?>
                        <br>
                        <input type="text" name="Materno" tabindex="5" list="Maternos" class="form-control">
                    </th>
                    
                    
                    <th><?php echo $idioma['Celular'] ?>
                        <br>
                        <input type="text" name="Celular" tabindex="6" list="Celulares" class="form-control">
                    </th>
                </tr>
            </table>
            <table class="table table-bordered table-striped">
            	<tr><td colspan="4"><strong><?php echo $idioma['DatosMedico']?></strong></td></tr>
            	<tr>
                	<!--<td>
                    	<?php echo 'Especialidad'?><br><?php campo("CodEspecialidad","select",$esp,"col-sm-12",1,0,0,array("tabindex"=>7))?>
                    	
                    </td>
                    <td>
                    	<?php echo $idioma['Medico']?><br><?php campo("CodMedico","select",array(),"col-sm-12",1,"",0,array("data-placeholder"=>"Seleccione..."))?>
                    	<a class="btn btn-xs btn-danger" href="#" rel="popupmodal"><?php echo $idioma['RegistrarNuevoMedico']?></a>
                    </td>-->
                    <th><?php echo $idioma['Nombres'] ?>
                        <br>
                        <input type="text" name="NombresMedico" tabindex="7" list="NombresMedicos" required class="form-control">
                        <datalist id="NombresMedicos">
                        <?php foreach($medicos as $m){?>
                            <option value="<?php echo $m['Nombres']?>"><?php echo $m['Paterno']." ".$m['Materno']." ".$m['Nombres']?></option>
                        <?php }?>
                        </datalist>
                    </th>
                    <th><?php echo $idioma['ApellidoPaterno'] ?>
                        <br>
                        <input type="text" name="PaternoMedico" tabindex="8" list="PaternosMedicos" autocomplete="off" class="form-control">
                        <datalist id="PaternosMedicos">
                        <?php foreach($medicos as $m){?>
                            <option value="<?php echo $m['Paterno']?>"><?php echo $m['Paterno']." ".$m['Materno']." ".$m['Nombres']?></option>
                        <?php }?>
                        </datalist> 
                    </th>
                    <th><?php echo $idioma['ApellidoMaterno'] ?>
                        <br>
                        <input type="text" name="MaternoMedico" tabindex="9" list="MaternoMedicos" class="form-control" autocomplete="off">
                        <datalist id="MaternoMedicos">
                        <?php foreach($medicos as $m){?>
                            <option value="<?php echo $m['Materno']?>"><?php echo $m['Paterno']." ".$m['Materno']." ".$m['Nombres']?></option>
                        <?php }?>
                        </datalist>
                    </th>
                    
                    
                    <th><?php echo $idioma['Celular'] ?>
                        <br>
                        <input type="text" name="CelularMedico" tabindex="10" list="Celulares" class="form-control">
                    </th>
                </tr>
            </table>
            
			<table class="table table-bordered table-striped">
            	<thead>
                </thead>
                
                <tr>
                	<td><strong>O.D.</strong></td>
                	<td><?php echo 'Esférico'?><br><?php campo("LODEsferico","text","","col-sm-12",0,"","",array("tabindex"=>11))?></td>
                    <td><?php echo 'Cilíndrico'?><br><?php campo("LODCilindrico","text","","col-sm-12",0,"","",array("tabindex"=>12))?></td>
                    <td><?php echo 'Eje'?><br><?php campo("LODEje","text","","col-sm-12",0,"","",array("tabindex"=>13))?></td>
                    <td><?php echo 'Prisma'?><br><?php campo("LODPrisma","text","","col-sm-12",0,"","",array("tabindex"=>14))?></td>
                    <td><?php echo 'Base'?><br><?php campo("LODBase","text","","col-sm-12",0,"","",array("tabindex"=>15))?></td>
                    <td><?php echo 'ADD'?><br><?php campo("LODAdd","text","","col-sm-12",0,"","",array("tabindex"=>16))?></td>
                </tr>
                <tr>
                	<td><strong>O.I.</strong></td>
                	<td><?php echo 'Esférico'?><br><?php campo("LOIEsferico","text","","col-sm-12",0,"","",array("tabindex"=>17))?></td>
                    <td><?php echo 'Cilíndrico'?><br><?php campo("LOICilindrico","text","","col-sm-12",0,"","",array("tabindex"=>18))?></td>
                    <td><?php echo 'Eje'?><br><?php campo("LOIEje","text","","col-sm-12",0,"","",array("tabindex"=>19))?></td>
                    <td><?php echo 'Prisma'?><br><?php campo("LOIPrisma","text","","col-sm-12",0,"","",array("tabindex"=>20))?></td>
                    <td><?php echo 'Base'?><br><?php campo("LOIBase","text","","col-sm-12",0,"","",array("tabindex"=>21))?></td>
                    <td><?php echo 'ADD'?><br><?php campo("LOIAdd","text","","col-sm-12",0,"","",array("tabindex"=>22))?></td>
                </tr>
                <tr>
                	<td colspan="7"><strong><?php echo $idioma['Cerca'] ?></strong></td>
                </tr>
                <tr>
                	<td><strong>O.D.</strong></td>
                	<td><?php echo 'Esférico'?><br><?php campo("CODEsferico","text","","col-sm-12",0,"","",array("tabindex"=>23))?></td>
                    <td><?php echo 'Cilíndrico'?><br><?php campo("CODCilindrico","text","","col-sm-12",0,"","",array("tabindex"=>24))?></td>
                    <td><?php echo 'Eje'?><br><?php campo("CODEje","text","","col-sm-12",0,"","",array("tabindex"=>25))?></td>
                    
                </tr>
                <tr>
                	<td><strong>O.I.</strong></td>
                	<td><?php echo 'Esférico'?><br><?php campo("COIEsferico","text","","col-sm-12",0,"","",array("tabindex"=>26))?></td>
                    <td><?php echo 'Cilíndrico.'?><br><?php campo("COICilindrico","text","","col-sm-12",0,"","",array("tabindex"=>27))?></td>
                    <td><?php echo 'Eje'?><br><?php campo("COIEje","text","","col-sm-12",0,"","",array("tabindex"=>28))?></td>
                    <td><?php echo 'Altura'?><br><?php campo("COIAltura","text","","col-sm-12",0,"","",array("tabindex"=>29))?></td>
                    <td><?php echo 'DP Lejos'?><br><?php campo("COIDPLejos","text","","col-sm-12",0,"","",array("tabindex"=>30))?></td>
                    <td><?php echo 'DP Cerca'?><br><?php campo("COIDPCerca","text","","col-sm-12",0,"","",array("tabindex"=>31))?></td>
                </tr>
                <tr>
                	<td colspan="2">
						<strong><?php echo $idioma['Cristales']?> <?php echo $idioma['Lejos']?></strong><br>	
                    	<?php echo $idioma['TipoProducto']?><br><?php campo("CodProductoTipo1","select",$protipoc,"col-sm-12 noselect",0,"",0,array("rel"=>1,"tabindex"=>32))?>
                    </td>
                    <td colspan="2"><br>
                        <?php echo $idioma['Producto']?><br><?php campo("CodProducto1","select","","col-sm-12 noselect",0,"",0,array("rel"=>1,"tabindex"=>33))?>
                    </td>
                    <td colspan="3"><br>
                    	<?php echo $idioma['Detalle']?><br><?php campo("Detalle1","text","","col-sm-12",0,"","",array("tabindex"=>34))?>
                    	
                    </td>
                </tr>
                <tr>
                	<td colspan="2">
						<strong><?php echo $idioma['Cristales']?> <?php echo $idioma['Cerca']?></strong><br>	
                    	<?php echo $idioma['TipoProducto']?><br><?php campo("CodProductoTipo2","select",$protipoc,"col-sm-12 noselect",0,"",0,array("rel"=>2,"tabindex"=>35))?>
                    </td>
                    <td colspan="2"><br>
                        <?php echo $idioma['Producto']?><br><?php campo("CodProducto2","select","","col-sm-12 noselect",0,"",0,array("rel"=>2,"tabindex"=>36))?>
                    </td>
                    <td colspan="3"><br>
                    	<?php echo $idioma['Detalle']?><br><?php campo("Detalle2","text","","col-sm-12",0,"","",array("tabindex"=>37))?>
                    	
                    </td>
                </tr>
                <tr>
                	<td colspan="2">
						<strong><?php echo $idioma['ArmLejos']?></strong><br>	
                    	<?php echo $idioma['TipoProducto']?><br><?php campo("CodProductoTipo3","select",$protipoa,"col-sm-12 noselect",0,"",0,array("rel"=>3,"tabindex"=>38))?>
                    </td>
                    <td colspan="2"><br>
                        <?php echo $idioma['Producto']?><br><?php campo("CodProducto3","select","","col-sm-12 noselect",0,"",0,array("rel"=>3,"tabindex"=>39))?>
                    </td>
                    <td colspan="2"><br>
                    	<?php echo $idioma['Detalle']?><br><?php campo("Detalle3","text","","col-sm-12",0,"","",array("tabindex"=>40))?>
                    	
                    </td>
                    <td colspan="1"><br>
                    	<?php echo $idioma['Vitrina']?><br><?php campo("Vitrina3","text","","col-sm-12",0,"","",array("tabindex"=>41))?>
                    	
                    </td>
                </tr>
                <tr>
                	<td colspan="2">
						<strong><?php echo $idioma['ArmCerca']?></strong><br>	
                    	<?php echo $idioma['TipoProducto']?><br><?php campo("CodProductoTipo4","select",$protipoa,"col-sm-12 noselect",0,"",0,array("rel"=>4,"tabindex"=>42))?>
                    </td>
                    <td colspan="2"><br>
                        <?php echo $idioma['Producto']?><br><?php campo("CodProducto4","select","","col-sm-12 cp4 noselect",0,"",0,array("rel"=>4,"tabindex"=>43))?>
                    </td>
                    <td colspan="2"><br>
                    	<?php echo $idioma['Detalle']?><br><?php campo("Detalle4","text","","col-sm-12",0,"","",array("tabindex"=>44))?>
                    	
                    </td>
                    <td colspan="1"><br>
                    	<?php echo $idioma['Vitrina']?><br><?php campo("Vitrina4","text","","col-sm-12",0,"","",array("tabindex"=>45))?>
                    	
                    </td>
                </tr>
                <tr>
                	<td colspan="7"><?php echo $idioma['Observaciones']?><br><?php campo("Observaciones","text","","col-sm-12",0,"","",array("tabindex"=>46))?></td>
                </tr>
                <tr>
                    <td><?php echo $idioma['FechaEntrega']?><br><?php campo("FechaEntrega","date",fecha2Str("",0,"+1 day"),"fechal norequerido",1,"",0,array("tabindex"=>47))?></td>
                    <td><?php echo $idioma['HoraEntrega']?><br><?php campo("HoraEntrega","time",date("H:i"),"hora norequerido",1,"","",array("tabindex"=>48))?></td>
                </tr>
            </table>
            
            <table class="table table-bordered table-striped">
            	<tr><td colspan="6"><strong><?php echo $idioma['Pago']?> - T/C: <?php echo $TC?></strong></td></tr>
            	<tr class="danger">
                	<td colspan="1"><?php echo $idioma['PrecioTotal']?><br><?php campo("TotalBs","text","","col-sm-12 der norequerido",1,"","",array("tabindex"=>49))?></td>
                    <td colspan="1"><?php echo $idioma['ACuenta']?> Bs<br><?php campo("ACuentaBs","text","","col-sm-12 der norequerido",1,"",0,array("tabindex"=>50))?></td>
                    <td colspan="1"><?php echo $idioma['ACuenta']?> $us<br><?php campo("ACuentaSus","text","","col-sm-12 der norequerido",1,"",0,array("tabindex"=>51))?><br>Monto en Bs <?php campo("TotalAcuentaSus","text","0","col-sm-12 der norequerido",0,"",0,array("readonly"=>"readonly"))?></td>
                    
                    <td colspan="1"><?php echo $idioma['SaldoCobrar']?> Bs<br><?php campo("SaldoBs","text","0","col-sm-12 der norequerido",1,"",0,array("readonly"=>"readonly"))?>
                    	<hr class="separador">
                    	Tipo de pago:<br>
                        <label>Contado <input type="radio" name="TipoPago" value="Contado" checked></label>
                        <label>Credito <input type="radio" name="TipoPago" value="Credito"></label>
                    	<div class="cajacredito ocultar" >
                        Número de Cuotas:
                        <input type="number"  min="0" step="1" value="0" size="2" style="width:100px" class="der" name="NC">
                        <br>
                        Cuotas X Mes Bs:
                        <input type="number"  min="0" step="1" value="0" size="2" style="width:100px" class="der" name="CuotaMes" readonly>
                        </div>
                    </td>
                </tr>
                
                <tr>
                	<td colspan="6"></td>
                </tr>
            </table>
            <div class="alert alert-danger"><?php echo $idioma['NotaOpticaGuardar'] ?></div><br><?php campo("BotonEnviar","submit","Registrar","btn btn-success",0,"",0)?>
			</form>
        </div>
    </div>
</div>
<div id="registromedico" class="modal fade">
<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
        	<button type="button" class="close btn btn-xs btn-danger" data-dismiss="modal" ><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        	<h4 class="modal-title" id="myModalLabel"><?php echo $idioma['RegistrarNuevoMedico']?></h4>
     	</div>
    	<div class="modal-body">
        	<form id="tablaformulario">
			<table class="table table-hover" id="">
                <tr>
                    <td class="der"><?php echo $idioma['ApellidoPaterno'] ?></td>
                    <td><?php campo("Paterno","text","","",1,"",1)?></td>
                </tr>
                <tr>
                    <td class="der"><?php echo $idioma['ApellidoMaterno'] ?></td>
                    <td><?php campo("Materno","text","","",1)?></td>
                </tr>
                <tr>
                    <td class="der"><?php echo $idioma['Nombres'] ?></td>
                    <td><?php campo("Nombres","text","","",1)?></td>
                </tr>
                <tr>
                    <td class="der"><?php echo $idioma['Ci'] ?></td>
                    <td><?php campo("Ci","number","","",0)?></td>
                </tr>
                <tr>
                    <td class="der"><?php echo $idioma['Telefono'] ?></td>
                    <td class=""><?php campo("Telefono","text","")?></td>
                </tr>
                <tr>
                    <td class="der"><?php echo $idioma['Celular'] ?></td>
                    <td><?php campo("Celular","text","","",1)?></td>
                </tr>
                <tr>
                    <td class="der"><?php echo $idioma['Direccion'] ?></td>
                    <td><?php campo("Direccion","text","","",0,"",0,array("size"=>"25"))?></td>
                </tr>
            
                <tr>
                    <td class="der"><?php echo $idioma['Especialidad'] ?></td>
                    <td><?php campo("CodEspecialidad","select",$esp,"",1)?></td>
                </tr>
                <?php if(in_array($_SESSION['Nivel'],array(1,2,3,4))){?>
                <tr>
                    <td class="der"><?php echo $idioma['PorcentajePago'] ?></td>
                    <td><?php campo("Porcentaje","number","0","der",0,"",0,array("min"=>"0"))?>%</td>
                </tr>
                <?php }?>
                <tr>
                    <td class="der"><?php echo $idioma['Observaciones'] ?></td>
                    <td><?php campo("Observaciones","textarea")?></td>
                </tr>
            </table>
            </form>
        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $idioma['Cerrar']?></button>
        	<button type="button" class="btn btn-primary" id="GuardarMedico"><?php echo $idioma['Guardar']?></button>
        </div>
	</div>
  </div>
</div>
<?php include_once($folder."pie.php");?>