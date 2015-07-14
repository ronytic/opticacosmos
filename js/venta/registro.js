$(document).on("ready",function(){
	$("#TotalBs,#ACuentaBs,#ACuentaSus,#DescuentoBs").keyup(function(e) {
		if($("#TotalBs").val()==""){
			$("#TotalBs").val('0')	
		}
		if($("#ACuentaBs").val()==""){
			$("#ACuentaBs").val('0')	
		}
		if($("#ACuentaSus").val()==""){
			$("#ACuentaSus").val('0')	
		}
		TotalBs=0;
		
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
    $("#NumeroBoleta").change(cambioBoleta);
	$("#NumeroBoleta").keyup(cambioBoleta);
    
    function cambioBoleta(e){
		e.preventDefault();
		var NumeroBoleta=$("#NumeroBoleta").val();
		$.post("verificarboleta.php",{'NumeroBoleta':NumeroBoleta},procesaNumeroBoleta,"json");
	}
    $("input[name=Ci]").change(function(e) {
        var  Ci=$(this).val();
        $.post("obtenerdatospaciente.php",{"Ci":Ci},function(data){
            $("input[name=Paterno]").val(data.Paterno);
            $("input[name=Materno]").val(data.Materno);
            $("input[name=Nombres]").val(data.Nombres);
            $("input[name=Celular]").val(data.Celular);
        },"json");
    });
    
    $("input[name=NombresMedico]").change(function(e) {
        var Valor=$(this).val();
        $.post("obtenerdatosmedicos.php",{'Dato':"Nombres","Valor":Valor,"DatoO":"Paterno"},function(data){
            $("#PaternosMedicos").html(data);
        });
    });
    
    $("input[name=PaternoMedico]").change(function(e) {
        var Valor=$(this).val();
        $.post("obtenerdatosmedicos.php",{'Dato':"Paterno","Valor":Valor,"DatoO":"Materno"},function(data){
            $("#MaternoMedicos").html(data);
        });
    });
    $("input[name=MaternoMedico]").change(function(e) {
        var Valor=$(this).val();
        $.post("obtenerdatosmedicos.php",{'Dato':"Materno","Valor":Valor,"DatoO":"Nombres"},function(data){
            //$("#NombresMedicos").html(data);
        });
    });
    
    $("input,select,div.chosen-container").keydown(enter2tab);
    
    $("*").on('keydown', null, 'ctrl+0', enviarformulario);
});
function enviarformulario(){
    $("#formularioguardar").submit()
}
function procesaNumeroBoleta(data){
	$("#mensajeboleta").html("<ul>"+data.datos+"</ul>");
    $("#mensajeboleta").removeClass("alert-sucess alert-danger").addClass("alert-"+data.alerta);
    Habilitado=data.habilitado;
    $("#BotonEnviar").val(data.BotonEnviar).removeClass("btn-success btn-danger").addClass("btn-"+data.alerta);
	
    if(Habilitado){
        window.onbeforeunload = function exitAlert() 
        { 
            var textillo = "Los datos que no se han guardado se perderan."; 
            return textillo; 
        } 
    }else{
        
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
