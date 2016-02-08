<?php
include_once("../../login/check.php");
include_once("../../class/talonario.php");
$talonario=new talonario;

include_once("../../class/usuario.php");
$usuario=new usuario;

extract($_POST);
//print_r($_POST);
$CodUsuarioAsignado=$CodUsuarioAsignado!=""?"CodUsuarioAsignado LIKE '$CodUsuarioAsignado'":"CodUsuarioAsignado LIKE '%'";

$condicion="$CodUsuarioAsignado";
$tal=$talonario->mostrarTodoRegistro($condicion,1,"FechaRegistro,Minimo,Maximo");

foreach($tal as $t){$i++;
    $us=$usuario->mostrarDatos($t['CodUsuarioAsignado']);
    $us=array_shift($us);
    $datos[$i]['CodTalonario']=$t['CodTalonario']; 
    $datos[$i]['Empleado']=$us['Nombres']." ".$us['Paterno'].$us['Materno']; 
    $datos[$i]['Minimo']=$t['Minimo']; 
    $datos[$i]['Maximo']=$t['Maximo']; 
    $datos[$i]['Descripcion']=$t['Descripcion']; 
    $datos[$i]['FechaRegistro']=$t['FechaRegistro']; 
}
$titulo=array(	"Empleado"=>"Empleado",
				"Minimo"=>$idioma['Desde'],
				"Maximo"=>$idioma['Hasta'],
				"Descripcion"=>$idioma['Descripcion'],
				"FechaRegistro"=>$idioma['FechaRegistro'],
);
listadotabla($titulo,$datos,1,"","","");
?>