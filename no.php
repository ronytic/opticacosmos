<?php

?>
<script language="javascript" src="js/core/framework/jquery-2.0.3.min.js"></script>
<script language="javascript">
$(document).on("ready",function(){
    $("input[name=nombre]").focusout(function(){
        //alert($(this).val());
    });    
     //relationshipTemp = $('#TypeList option:selected').text();
     tb = $('input');
    
     tb.keydown(enter2tab);
   
   $(document).on("change","#listanombre",function(){
    alert("asd");    
   });
   $("input[name=nombre]").change(function(e) {
        alert("qwe");
    });
});
 function enter2tab(e) {
     
       if (e.keyCode == 13) {
           
           cb = parseInt($(this).attr('tabindex'));
    
           if ($(':input[tabindex=\'' + (cb + 1) + '\']') != null) {
               $(':input[tabindex=\'' + (cb + 1) + '\']').focus();
               $(':input[tabindex=\'' + (cb + 1) + '\']').select();
               e.preventDefault();
    
               return false;
           }
       }
   }
</script>
<input type="text" name="nombre" list="listanombre" autocomplete="off" tabindex="1">
<datalist id="listanombre">
    <option>Raul</option>
    <option>Ronald</option>
</datalist>
<input type="text" tabindex="2">