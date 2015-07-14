<?php
include_once("../../login/check.php");
$Ci=$_POST['Ci'];
$Ci=trim($Ci);
if($Ci!="0" && $Ci!="-" && $Ci!="--" && $Ci!="---"){
include_once("../../class/paciente.php");
$paciente=new paciente;
$pac=$paciente->mostrarTodoRegistro("Ci='$Ci'",1,"Paterno,Materno,Nombres");
$pac=array_shift($pac);
}else{
    $pac['Paterno']="";  
    $pac['Materno']="";  
    $pac['Nombres']="";  
    $pac['Ci']="";  
    $pac['Celular']="";    
}
echo json_encode($pac);
?>
