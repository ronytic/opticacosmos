$(document).on("ready",inicio);
var RedirigirLogin=0;

function inicio(){
	
	$(document).on('submit','form.formulario', function(e) {
		e.preventDefault(); // prevent native submit
		var percent=$("#respuestaformulario")
    	$(this).ajaxSubmit({
        	target: '#respuestaformulario',
			beforeSend: function() {
				//status.empty();
				var percentVal = '0%';
				//bar.width(percentVal)
				percent.html(percentVal+'<div class="progress"><div class="bar" style="width: '+percentVal+';"></div></div>');
			},
			uploadProgress: function(event, position, total, percentComplete) {
				var percentVal = percentComplete + '%';
				//bar.width(percentVal)
				percent.html(percentVal+'<div class="progress"><div class="bar" style="width: '+percentVal+';"></div></div>');
			},
			complete: function(xhr) {
			//bar.width("100%");
			//percent.html("100%");
			$("#respuestaformulario").html(xhr.responseText);
			//$("table").stickyTableHeaders();
			//$("table.inicio").stickyTableHeaders('destroy');
			}
    	})
		//$('html, body').animate({scrollTop:$("#respuestaformulario").position().top-200},300);
		 
	});
	$(document).on("submit",".formularioconfirmacion",function(e){
		if(!confirm($(this).attr("data-mensaje"))){
			e.preventDefault();
		}
	});
	$("#respuestaformulario").on("click",".eliminar",function(e){
		var direccion=$(this).attr("href");
		e.preventDefault();
		e.stopPropagation();
		if(confirm(DeseaEliminarRegistro)){
			$.post(direccion,function(){
				$("form.formulario").submit();	
			});
		}
		return false;
	});
	$("#respuestaformulario").on("click",".modificar",function(e){
		//var direccion=$(this).attr("href");
		if(confirm(DeseaModificarRegistro)){
			return true;
		}else{
			return false;
		}
	});

	/*Gestionar Tabla*/
	//$(window).trigger('resize.stickyTableHeaders');
	//$("table:not(.inicio)").stickyTableHeaders();
	/*Fin Gestionar Tabla*/
	
	//Al INICIO
	$("table").stickyTableHeaders();
	$("table.inicio").stickyTableHeaders('destroy');
	$('ul.r-listado li a').tooltip();
	$('span[title]').tooltip();
	$('a[title]').tooltip({'placement':'bottom'});
	
	$('div[title]:not(.lateral)').tooltip({'placement':'bottom'});
	$('div.lateral').tooltip({'placement':'right'});
	$('a[data-rel="tooltip"]').tooltip();
	//FIN de INICIO
	
	if (typeof configuracion != "undefined"){
		var config = $.extend({}, {autoclose:true,format: "dd-mm-yyyy",todayBtn: "linked"}, configuracion);
	}else{
		var config={autoclose:true,format: "dd-mm-yyyy",todayBtn: "linked"};
	}
	//$('.hora').timepicker('setTime', '12:48 AM');
	$('.fecha').datepicker(config).mask('99-99-9999');	
	$('.FechaRangoIdependiente').datepicker({
    	todayBtn: "linked"
	}).find("input").mask('99-99-9999');
	
	
	$('.FechaRango').daterangepicker({
      ranges: {
         'Hoy': [moment(), moment()],
         'Ayer': [moment().subtract('days', 1), moment().subtract('days', 1)],
         'Últimos 7 Días': [moment().subtract('days', 6), moment()],
         'Últimos 30 Días': [moment().subtract('days', 29), moment()],
         'Este Mes': [moment().startOf('month'), moment().endOf('month')],
         'El Mes Pasado': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
      },
	  maxDate:moment(),
      startDate: moment(),
      endDate: moment()
    });
	
	$(document).ajaxStart(function() {
      	$("#contenedorcargando").fadeIn('fast');  
    }).ajaxStop(function() {
	
    }).ajaxSuccess(function(event, XMLHttpRequest, ajaxOptions) {
		$("#contenedorcargando").fadeOut('slow');
		/*Redirigir por falta de Login*/
		if(RedirigirLogin){
			window.location.href=folder;	
		}
		/*Fin de Redirigir*/
        //$("input[type=date]").datepicker({changeMonth: true,changeYear: true,yearRange:"c-100:c+10"});
		$('.fecha').datepicker({autoclose:true})
		

		/*Gestionar Tabla*/
		//$(window).trigger('resize.stickyTableHeaders');
		//alert($("table:not(.inicio)").length);
		//$("table.inicio").css({"background-color":"red","box-shadow":"3px 3px 3px green"});
		//$("table").stickyTableHeaders();
		//$(window).trigger('resize.stickyTableHeaders');
		//$("table.inicio").stickyTableHeaders('destroy');
		
		/*Fin Gestionar Tabla*/
		
		$('span[title]').tooltip();
		
		$('body').tooltip({selector: '[title]','placement':'bottom'});
		
		$('input[title]').tooltip({'placement':'bottom'});
		$('div[title]:not(.lateral)').tooltip({'placement':'bottom'});
		$('div.lateral').tooltip({'placement':'right'});
		$('a[data-rel="tooltip"]').tooltip();
		
		//pestañas horizontales corregir
		$('.tabbable a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
			$(window).resize();
		})	

    });
	
	
	$(document).on('click','.enlacepost',function(e){
		e.preventDefault();
		var dest=$(this).attr("href")!=""?$(this).attr("href"):$(this).attr("data-destino");
		var mensaje=$(this).attr("data-mensaje");
		var resp=$(this).attr("data-respuesta");
		var campos=$(this).attr("data-campos");
		if(mensaje!=""){
			if(confirm(mensaje)){
				$.post(dest,campos,function(data){$(resp).html(data)})
			}
		}else{
			$.post(dest,campos,function(data){$(resp).html(data)})
		}
	});
	$(document).on('click','#actualizarventana',function(e){
		location.reload();	
	});
	

	/*Exportar Excel*/
	$(document).on('click','#exportarexcel',function(e){
		e.preventDefault();
		var tabla=$(this).next().clone();
		if(!(tabla.find("thead:eq(0)")).length){
			tabla=$(this).next().next().clone();
		}
		tabla.find("thead:eq(0)").remove();
		//alert(tabla.find("thead").html().remove());
		var html='<table border="1">'+tabla.html()+'</table>';
		//return false;
		while (html.indexOf('á') != -1) html = html.replace('á', '&aacute;');
		while (html.indexOf('é') != -1) html = html.replace('é', '&eacute;');
		while (html.indexOf('í') != -1) html = html.replace('í', '&iacute;');
		while (html.indexOf('ó') != -1) html = html.replace('ó', '&oacute;');
		while (html.indexOf('ú') != -1) html = html.replace('ú', '&uacute;');
		while (html.indexOf('ñ') != -1) html = html.replace('ñ', '&ntilde;');
		while (html.indexOf('º') != -1) html = html.replace('º', '&ordm;');
		/*window.open('data:application/vnd.ms-excel;Content-Disposition:attachment;file=export_filename.xls;name=hebe.xls,' +encodeURIComponent(html));
    e.preventDefault();
		//$.post(folder+"exportar/excel.php",{'dataexcel':datos},function(data){$("#respuestaexcel").html(data)});		*/
		//getting values of current time for generating the file name
        var dt = new Date();
        var day = dt.getDate();
        var month = dt.getMonth() + 1;
        var year = dt.getFullYear();
        var hour = dt.getHours();
        var mins = dt.getMinutes();
        var postfix = day + "." + month + "." + year + "_" + hour + "." + mins;
        //creating a temporary HTML link element (they support setting file names)
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
       // var table_div = $(this).next("table");
        var table_html = html.replace(/ /g, '%20');
        a.href = data_type + ', ' + table_html;
        //setting the file name
        a.download = TituloDocumento+'_' + postfix + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
	});
	/*Fin de Exportar Excel*/
	/*
	$(window).scroll(function(e) {
        //alert($(this).scrollTop());
    });*/
	
	/*Notificaciones*/
	$('#noti').click(function(e){e.preventDefault();}).popover({title:$("#noti").attr('data-titulo')+$('#noticerrar').html(),html : true,placement:'bottom',content:$('#cuerponotificacion').html()})
	$(document).on("click",'#cerrarnoti',function(e){
		e.preventDefault();
		$('#noti').popover('hide');
	}); 
}
function cargandoG(destino){
	$(destino).html('<img src="'+folder+'imagenes/cargador/cargador.gif"/>');
}
function sacarIniciales(texto){
	iniciales="";
	datos=texto.split(' ');
	for(i=0;i<datos.length;i++){
		d=(datos[i]).split('');
		iniciales+=d[0];
	}
	return iniciales.toUpperCase();
}
jQuery.fn.reset = function () {
  $(this).each (function() { this.reset(); });
}