<?php
include_once("../../login/check.php");
$Ci=$_POST['Ci'];
include_once("../../class/paciente.php");
$paciente=new paciente;
$pac=$paciente->mostrarTodoRegistro("Ci='$Ci'",1,"Paterno,Materno,Nombres");
$pac=array_shift($pac);

echo json_encode($pac);
?>
