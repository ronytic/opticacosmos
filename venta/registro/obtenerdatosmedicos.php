<?php
include_once("../../login/check.php");
extract($_POST);
include_once("../../class/medico.php");
$medico=new medico;
$med=$medico->mostrarTodoRegistro("$Dato='$Valor'",1,"$Dato");
foreach($med as $m){
    ?>
    <option value="<?php echo $m[$DatoO]?>"><?php echo $m['Paterno']." ".$m['Materno']." ".$m['Nombres']?></option>
    <?php
}
?>
