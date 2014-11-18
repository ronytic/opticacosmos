<?php include_once("../../login/check.php");
$titulo="NPedidoOptica";
$CodPaciente=$_GET['CodPaciente'];
include_once("../../class/paciente.php");
$paciente=new paciente;
$pac=$paciente->mostrarPaciente($CodPaciente);
$pac=array_shift($pac);

include_once("../../class/especialidad.php");
$especialidad=new especialidad;
$esp=todolista($especialidad->mostrarTodoRegistro("",1,"Nombre"),"CodEspecialidad","Nombre","",1);

include_once("../../class/productotipo.php");
$productotipo=new productotipo;
$protipoc=todolista($productotipo->mostrarTodoRegistro("Categoria='Cristales'",1,"Nombre"),"CodProductoTipo","Nombre","",1);


$protipoa=todolista($productotipo->mostrarTodoRegistro("Categoria='Armazon'",1,"Nombre"),"CodProductoTipo","Nombre","",1);

//print_r($protipoa);

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
$(document).on("ready",function(){
	$("#TotalBs,#ACuentaBs,#ACuentaSus,#DescuentoBs").change(function(e) {
		if($("#TotalBs").val()==""){
			$("#TotalBs").val('0')	
		}
		if($("#ACuentaBs").val()==""){
			$("#ACuentaBs").val('0')	
		}
		if($("#ACuentaSus").val()==""){
			$("#ACuentaSus").val('0')	
		}
       var TotalBs=parseFloat($("#TotalBs").val()); 
	   var ACuentaBs=parseFloat($("#ACuentaBs").val()); 
	   var ACuentaSus=parseFloat($("#ACuentaSus").val()); 
	   
	   //alert(TotalBs);
	   //alert(ACuentaSus*TC);
	   TotalAcuentaSus=parseFloat(ACuentaSus*TC);
	   var SaldoBs=parseFloat(TotalBs-(ACuentaBs+TotalAcuentaSus));
	   /*alert(TotalBs);
	   alert(ACuentaBs);
	   alert(TotalAcuentaSus);
	   alert(SaldoBs)*/
	   SaldosCobrarBs=SaldoBs.toFixed(2);
	   $("#TotalAcuentaSus").val(TotalAcuentaSus);
	   $("#SaldoBs").val(SaldosCobrarBs);
	   
    });
	$("#CodEspecialidad").change(function(e) {
        obtenerMedico();
    });
	$("#CodProductoTipo1").change(function(e) {
        obtenerProducto1();
    });
	$("#CodProductoTipo2").change(function(e) {
        obtenerProducto2();
    });
	$("#CodProductoTipo3").change(function(e) {
        obtenerProducto3();
    });
	$("#CodProductoTipo4").change(function(e) {
        obtenerProducto4();
    });
	obtenerMedico();
	obtenerProducto1();
	obtenerProducto2();
	obtenerProducto3();
	obtenerProducto4();
	
	$("a[rel=popupmodal]").click(function(e) {
		
        e.preventDefault();
		
		$("#registromedico").modal();
		$("#Paterno").focus();
    });
	$("#GuardarMedico").click(function(e) {
		e.preventDefault();
		var tablaformulario= $("#tablaformulario").serialize();
		//alert(tablaformulario);
		$.ajax({
		  url: '../../medico/registro/guardar.php',
		  type: 'POST',
		  async: true,
		  data: tablaformulario+"&modal=1",
		  success: procesaRespuesta,
		});
        
    });
	$("#formularioguardar").on("submit",function(e){
		if(Habilitado==1){
			if(!confirm("¿Esta Seguro de Guardar esta Boleta?")){
				e.preventDefault();	
			}
		}else{
			e.preventDefault();		
		}
	});
	$("#NumeroBoleta").change(function(e){
		e.preventDefault();
		var NumeroBoleta=$("#NumeroBoleta").val();
		$.post("verificarboleta.php",{'NumeroBoleta':NumeroBoleta},procesaNumeroBoleta);
	});
});
function procesaNumeroBoleta(data){
	if(data!=""){
		$("#mensajeboleta").html("<ul>"+data+"</ul>");
		$("#NumeroBoleta").focus();	
		Habilitado=0;
	}else{
		$("#mensajeboleta").html("");
		Habilitado=1;
	}
	
}
function procesaRespuesta(data){
	obtenerMedico(data)
	$("#tablaformulario").reset();
	$("#registromedico").modal('hide');
}
function obtenerMedico(datos){
	
	var CodEspecialidad=$("#CodEspecialidad").val();
	$.post("obtenermedico.php",{'CodEspecialidad':CodEspecialidad},function(data){
		$("#CodMedico").html(data)	
		if(typeof(datos) != "undefined"){
			//alert(datos);
			$("#CodMedico").val(datos)
		}
	});
}
function obtenerProducto1(){
	var CodProductoTipo1=$("#CodProductoTipo1").val();
	$.post("obtenerproducto.php",{'CodProductoTipo':CodProductoTipo1},function(data){
		$("#CodProducto1").html(data)	
	});
}
function obtenerProducto2(){
	var CodProductoTipo2=$("#CodProductoTipo2").val();
	$.post("obtenerproducto.php",{'CodProductoTipo':CodProductoTipo2},function(data){
		$("#CodProducto2").html(data)	
	});
}
function obtenerProducto3(){
	var CodProductoTipo3=$("#CodProductoTipo3").val();
	$.post("obtenerproducto.php",{'CodProductoTipo':CodProductoTipo3},function(data){
		$("#CodProducto3").html(data)	
	});
}
function obtenerProducto4(){
	var CodProductoTipo4=$("#CodProductoTipo4").val();
	$.post("obtenerproducto.php",{'CodProductoTipo':CodProductoTipo4},function(data){
		$("#CodProducto4").html(data)	
	});
}

</script>
<?php include_once($folder."cabecera.php");?>
<div class="col-sm-12">
	<div class="widget-box">
    	<div class="widget-header widget-header-flat"><h4><?php echo $idioma['DatosPaciente'] ?></h4></div>
        <div class="widget-body">
        	<div class="widget-main">
            	<table class="table table-bordered ">
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
        	<form action="guardaroptica.php" method="post" id="formularioguardar">
            <?php campo("CodPaciente","hidden",$CodPaciente,"",1)?>
            <?php campo("TC","hidden",$TC,"",1)?>
            <table class="table table-bordered table-striped">
            	<tr>
                	<td><?php echo $idioma['FechaPedido']?><br><?php campo("Fecha","text",fecha2Str(),"fecha",1,"",0,array("readonly"=>"readonly","disabled"=>"disabled"))?></td>
                    <td><?php echo $idioma['FechaEntrega']?><br><?php campo("FechaEntrega","text",fecha2Str(),"fechali",1,"",0)?></td>
                    <td><?php echo $idioma['HoraEntrega']?><br><?php campo("HoraEntrega","time",date("H:i"),"hora",1)?></td>
                    <td colspan="2"><?php echo $idioma['Recepcion']?><br><?php campo("Recepcion","text",$NombresSis." ".$ApellidoPSis." ".$ApellidoMSis,"col-sm-12",1,"",0,array("readonly"=>"readonly"))?></td>
                    
                </tr>
            </table>
            <table class="table table-bordered table-striped">
            	<tr><td colspan="2"><strong><?php echo $idioma['DatosMedico']?></strong></td></tr>
            	<tr>
                	<td>
                    	<?php echo 'Especialidad'?><br><?php campo("CodEspecialidad","select",$esp,"col-sm-12",1)?>
                    	
                    </td>
                    <td>
                    	<?php echo $idioma['Medico']?><br><?php campo("CodMedico","select",array(),"col-sm-12",1,"",0,array("data-placeholder"=>"Seleccione..."))?>
                    	<a class="btn btn-xs btn-danger" href="#" rel="popupmodal"><?php echo $idioma['RegistrarNuevoMedico']?></a>
                    </td>
                </tr>
            </table>
            
			<table class="table table-bordered table-striped">
            	<thead>
                </thead>
                <tr>
                	<td colspan="3"><?php echo $idioma['NumeroBoleta']?>
                    <br><?php campo("NumeroBoleta","number","","col-sm-12 der",1,0,1,array("pattern"=>"[0-9]*","title"=>$idioma['SoloNumeros']))?>
                    <div class="alert alert-danger" id="mensajeboleta"></div>
                    </td>
                </tr>
            	
                <tr>
                	<td colspan="7"><strong><?php echo $idioma['Lejos'] ?></strong></td>
                </tr>
                <tr>
                	<td><strong>O.D.</strong></td>
                	<td><?php echo 'Esférico'?><br><?php campo("LODEsferico","text","","col-sm-12",0)?></td>
                    <td><?php echo 'Cilíndrico'?><br><?php campo("LODCilindrico","text","","col-sm-12",0)?></td>
                    <td><?php echo 'Eje'?><br><?php campo("LODEje","text","","col-sm-12",0)?></td>
                    <td><?php echo 'Prisma'?><br><?php campo("LODPrisma","text","","col-sm-12",0)?></td>
                    <td><?php echo 'Base'?><br><?php campo("LODBase","text","","col-sm-12",0)?></td>
                    <td><?php echo 'ADD'?><br><?php campo("LODAdd","text","","col-sm-12",0)?></td>
                </tr>
                <tr>
                	<td><strong>O.I.</strong></td>
                	<td><?php echo 'Esférico'?><br><?php campo("LOIEsferico","text","","col-sm-12",0)?></td>
                    <td><?php echo 'Cilíndrico'?><br><?php campo("LOICilindrico","text","","col-sm-12",0)?></td>
                    <td><?php echo 'Eje'?><br><?php campo("LOIEje","text","","col-sm-12",0)?></td>
                    <td><?php echo 'Prisma'?><br><?php campo("LOIPrisma","text","","col-sm-12",0)?></td>
                    <td><?php echo 'Base'?><br><?php campo("LOIBase","text","","col-sm-12",0)?></td>
                    <td><?php echo 'ADD'?><br><?php campo("LOIAdd","text","","col-sm-12",0)?></td>
                </tr>
                <tr>
                	<td colspan="7"><strong><?php echo $idioma['Cerca'] ?></strong></td>
                </tr>
                <tr>
                	<td><strong>O.D.</strong></td>
                	<td><?php echo 'Esférico'?><br><?php campo("CODEsferico","text","","col-sm-12",0)?></td>
                    <td><?php echo 'Cilíndrico'?><br><?php campo("CODCilindrico","text","","col-sm-12",0)?></td>
                    <td><?php echo 'Eje'?><br><?php campo("CODEje","text","","col-sm-12",0)?></td>
                    
                </tr>
                <tr>
                	<td><strong>O.I.</strong></td>
                	<td><?php echo 'Esférico'?><br><?php campo("COIEsferico","text","","col-sm-12",0)?></td>
                    <td><?php echo 'Cilíndrico.'?><br><?php campo("COICilindrico","text","","col-sm-12",0)?></td>
                    <td><?php echo 'Eje'?><br><?php campo("COIEje","text","","col-sm-12",0)?></td>
                    <td><?php echo 'Altura'?><br><?php campo("COIAltura","text","","col-sm-12",0)?></td>
                    <td><?php echo 'DP Lejos'?><br><?php campo("COIDPLejos","text","","col-sm-12",0)?></td>
                    <td><?php echo 'DP Cerca'?><br><?php campo("COIDPCerca","text","","col-sm-12",0)?></td>
                </tr>
                <tr>
                	<td colspan="2">
						<strong><?php echo $idioma['Cristales']?></strong><br>	
                    	<?php echo $idioma['TipoProducto']?><br><?php campo("CodProductoTipo1","select",$protipoc,"col-sm-12",1,"",0,array("rel"=>1))?>
                    </td>
                    <td colspan="2"><br>
                        <?php echo $idioma['Producto']?><br><?php campo("CodProducto1","select","","col-sm-12",1,"",0,array("rel"=>1))?>
                    </td>
                    <td colspan="3"><br>
                    	<?php echo $idioma['Detalle']?><br><?php campo("Detalle1","text","","col-sm-12",0)?>
                    	
                    </td>
                </tr>
                <tr>
                	<td colspan="2">
						<strong><?php echo $idioma['Cristales']?></strong><br>	
                    	<?php echo $idioma['TipoProducto']?><br><?php campo("CodProductoTipo2","select",$protipoc,"col-sm-12",1,"",0,array("rel"=>2))?>
                    </td>
                    <td colspan="2"><br>
                        <?php echo $idioma['Producto']?><br><?php campo("CodProducto2","select","","col-sm-12",1,"",0,array("rel"=>2))?>
                    </td>
                    <td colspan="3"><br>
                    	<?php echo $idioma['Detalle']?><br><?php campo("Detalle2","text","","col-sm-12",0)?>
                    	
                    </td>
                </tr>
                <tr>
                	<td colspan="2">
						<strong><?php echo $idioma['ArmLejos']?></strong><br>	
                    	<?php echo $idioma['TipoProducto']?><br><?php campo("CodProductoTipo3","select",$protipoa,"col-sm-12",1,"",0,array("rel"=>3))?>
                    </td>
                    <td colspan="2"><br>
                        <?php echo $idioma['Producto']?><br><?php campo("CodProducto3","select","","col-sm-12",1,"",0,array("rel"=>3))?>
                    </td>
                    <td colspan="2"><br>
                    	<?php echo $idioma['Detalle']?><br><?php campo("Detalle3","text","","col-sm-12",0)?>
                    	
                    </td>
                    <td colspan="1"><br>
                    	<?php echo $idioma['Vitrina']?><br><?php campo("Vitrina3","text","","col-sm-12",0)?>
                    	
                    </td>
                </tr>
                <tr>
                	<td colspan="2">
						<strong><?php echo $idioma['ArmCerca']?></strong><br>	
                    	<?php echo $idioma['TipoProducto']?><br><?php campo("CodProductoTipo4","select",$protipoa,"col-sm-12",1,"",0,array("rel"=>4))?>
                    </td>
                    <td colspan="2"><br>
                        <?php echo $idioma['Producto']?><br><?php campo("CodProducto4","select","","col-sm-12 cp4",1,"",0,array("rel"=>4))?>
                    </td>
                    <td colspan="2"><br>
                    	<?php echo $idioma['Detalle']?><br><?php campo("Detalle4","text","","col-sm-12",0)?>
                    	
                    </td>
                    <td colspan="1"><br>
                    	<?php echo $idioma['Vitrina']?><br><?php campo("Vitrina4","text","","col-sm-12",0)?>
                    	
                    </td>
                </tr>
                <tr>
                	<td colspan="7"><?php echo $idioma['Observaciones']?><br><?php campo("Observaciones","textarea","","col-sm-12",0)?></td>
                </tr>
            </table>
            
            <table class="table table-bordered table-striped">
            	<tr><td colspan="6"><strong><?php echo $idioma['Pago']?> - T/C: <?php echo $TC?></strong></td></tr>
            	<tr class="danger">
                	<td colspan="1"><?php echo $idioma['PrecioTotal']?><br><?php campo("TotalBs","text","0","col-sm-12 der",1)?></td>
                    <td colspan="1"><?php echo $idioma['ACuenta']?> Bs<br><?php campo("ACuentaBs","text","0","col-sm-12 der",1)?></td>
                    <td colspan="1"><?php echo $idioma['ACuenta']?> $us<br><?php campo("ACuentaSus","text","0","col-sm-12 der",1)?><br><?php campo("TotalAcuentaSus","text","0","col-sm-12 der",0,"",0,array("readonly"=>"readonly"))?>Bs</td>
                    
                    <td colspan="1"><?php echo $idioma['SaldoCobrar']?> Bs<br><?php campo("SaldoBs","text","0","col-sm-12 der",1,"",0,array("readonly"=>"readonly"))?></td>
                </tr>
                
                <tr>
                	<td colspan="6"><div class="alert alert-danger"><?php echo $idioma['NotaOpticaGuardar'] ?></div><br><?php campo("Area","submit",$idioma['Registrar'],"btn btn-success")?></td>
                </tr>
            </table>
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