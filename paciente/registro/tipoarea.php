<?php
include_once("../../login/check.php");
$Area=$_POST['Area'];
$CodPaciente=$_POST['CodPaciente'];
switch($Area){
	case 'Optica':{$archivo="../areas/optica.php?CodPaciente=".$CodPaciente;}break;	
}
header("Location:".$archivo);
?>