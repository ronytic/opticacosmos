var l=0;
$(document).on("ready",function(){
    aumentarregistro(event)
	$(document).on("click","#aumentar",aumentarregistro)
    $(document).on("click",".eliminar",eliminarregistro)
    $(document).on("change",".monto",sumar)
    $(document).on("change","#cancelado",calculardevuelto)
    $("input[type=text],select,div.chosen-container").keydown(enter2tab);
});
function aumentarregistro(e){
    e.preventDefault();
    l++;
    $.post("registro.php",{"l":l},function(data){
        $("#marca").before(data);
        //$(".der").numeric({allow:'.'});

        $("#cancelado").attr("tabindex",l*2+5)
        $("#observacion").attr("tabindex",l*2+6)
        $("#guardar").attr("tabindex",l*2+7)
    });
}
function sumar(){
    var total=0
    var monto=0;
    $(".monto").each(function(index, element) {
        monto=parseFloat($(element).val());
        $(element).val(monto.toFixed(2))
        total+=monto
    });    
    
    $("#total").val(total.toFixed(2))
    calculardevuelto()
}
function calculardevuelto(){
    var total=$("#total").val();
    var cancelado=parseFloat($("#cancelado").val());
    $("#cancelado").val(cancelado.toFixed(2))
    var montodevuelto=total-cancelado;
    $("#montodevuelto").val(montodevuelto.toFixed(2))
}
function eliminarregistro(e){
    e.preventDefault();
    var linea=$(this).attr("rel");
    $(".f"+linea).remove();
}