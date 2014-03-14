$(document).ready(function(){
	$("#usuario").focus();
	$("#login").submit(function(event){
		if($("#usuario").val()=="")
		{
			$("#usuario").focus();
			event.preventDefault();	
		}else if($("#pass").val()==""){
			$("#pass").focus();
			event.preventDefault();	
		}else{
			//$.pos($(this).attr("action"),{"usuario":$("#usuario").val(),"pass":$("pass").val()});
		}
		
	});
	$(".ayuda").click(function(e){e.preventDefault();}).popover({title:AyudaTitulo+$('#noticerrar').html(),html : true,placement:'bottom',content:$('#AyudaCuerpo').html()})
	$(document).on("click",'#cerrarnoti',function(e){
		e.preventDefault();
		$(".ayuda").popover('hide');
	});
});