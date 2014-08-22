<?php
include_once("../../login/check.php");
$CodEspecialidad=$_POST['CodEspecialidad'];
include_once("../../class/medico.php");
$medico=new medico;
$med=$medico->mostrarTodoRegistro("CodEspecialidad=$CodEspecialidad",1,"Paterno,Materno,Nombres");
$data='';
foreach($med as $m){
	$data.="<option value=\"".$m['CodMedico']."\">".$m['Paterno']." ".$m['Materno']." ".$m['Nombres']."</option>";
}
echo $data;
?>
