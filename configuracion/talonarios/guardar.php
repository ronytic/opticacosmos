<?php
include_once("../../login/check.php");
include_once("../../class/talonario.php");
$talonario=new talonario;
include_once("../../class/optica.php");
    $optica=new optica;
extract($_POST);
$op=$optica->mostrarTodoRegistro("NumeroBoleta=$Minimo Or NumeroBoleta=$Maximo");
if(count($op)>0){
   $Mensajes[]=$idioma["TalonarioYaRegistrado"]; 
}
else{
    $Valores=array(	"CodUsuarioAsignado"=>"'$CodUsuarioAsignado'",
                    "Minimo"=>"'$Minimo'",
                    "Maximo"=>"'$Maximo'",
                    "Descripcion"=>"'$Descripcion'",
    );
    $talonario->insertarRegistro($Valores);
    
    
    
    for($i=$Minimo;$i<=$Maximo;$i++){
        $Valores=array(	"CodUsuarioBoleta"=>"'$CodUsuarioAsignado'",
                        "NumeroBoleta"=>"'$i'",
                        "Emitido"=>"'0'",
                        "Anulado"=>"'0'",
                        "EstadoEntrega"=>"'0'",
        );
        $optica->insertarRegistro($Valores);
    }
    
    
    $Mensajes[]=$idioma["GuardadoCorrectamente"];
}
$folder="../../";
include_once("../../resultado.php");
?>