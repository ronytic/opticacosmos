<?php
include_once("../../login/check.php");
include_once("../../class/optica.php");
include_once("../../class/paciente.php");
include_once("../../class/medico.php");
$optica=new optica;
$paciente=new paciente;
$medico=new medico;
$NumeroBoleta=$_POST['NumeroBoleta'];

$opt=$optica->mostrarTodoRegistro("NumeroBoleta='$NumeroBoleta'");
$cantidad=$opt;
$opt=array_shift($opt);

$med=$medico->mostrarRegistro($opt['CodMedico']);
$med=array_shift($med);
$pac=$paciente->mostrarRegistro($opt['CodPaciente']);
$pac=array_shift($pac);


//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
include_once("../../class/usuario.php");
$usuario=new usuario;
$datosUsuario=$usuario->mostrarDatos($_SESSION['CodUsuarioLog']);
$datosUsuario=array_shift($datosUsuario);
$Apodo=$datosUsuario['Nick'];
$ApellidoPSis=$datosUsuario['Paterno'];
$ApellidoMSis=$datosUsuario['Materno'];
$NombresSis=$datosUsuario['Nombres'];
$FotoSis=$datosUsuario['Foto'];
?>
<?php if(count($cantidad)){?>
<table class="table table-bordered table-striped">
<thead><tr><th>Fecha de Ingreso</th><th>Orden</th><th>Ingresado Por</th><th>Datos Paciente</th><th>Fecha de Entrega</th></tr></thead>
<tr><td><?php echo fecha2Str($opt['FechaRegistro'])?></td><td><?php echo ($opt['NumeroBoleta'])?></td><td><?php echo ($opt['Recepcion'])?></td><td><?php echo $pac['Paterno']?> <?php echo $pac['Materno']?> <?php echo $pac['Nombres']?></td><td><?php echo fecha2Str($opt['FechaEntrega'])?></td></tr>
</table>

<table class="table table-bordered table-striped">
<thead><tr><th>Monto</th><th>A Cuenta Bs</th><th>A Cuenta $us	</th><th>Saldo</th></tr></thead>
<tr class="success"><td><?php echo ($opt['TotalBs'])?></td><td><?php echo ($opt['ACuentaBs'])?></td><td><?php echo ($opt['ACuentaSus'])?></td><td><?php echo $opt['SaldoBs']?></td></tr>
</table>


<div class="widget-header widget-header-flat"><h4><?php echo $idioma['DatosEntregaTrabajo']?></h4></div>
<div class="widget-body widget-main" id="">

<form action="guardar.php" method="post" onSubmit="" class="formularioRevisar">
<input type="hidden" name="CodOptica" value="<?php echo $opt['CodOptica']?>">
<table class="table table-bordered table-striped">
<thead><tr><th>Fecha de Entrega</th><th>Entregado Por</th><th>Saldo a Cancelar</th></tr></thead>
<tr class="info">
	<td><input type="text" class="fecha" value="<?php echo date("d-m-Y")?>" readonly></td>
    <td><?php campo("Recepcion","text",$NombresSis." ".$ApellidoPSis." ".$ApellidoMSis,"col-sm-12",1,"",0,array("readonly"=>"readonly"))?></td>
    <td><input type="text" name="MontoCobrar" value="<?php echo ($opt['SaldoBs'])?>" autofocus readonly class="der resaltar" ></td>
    
</tr>
<tr>
	
	<td colspan="3">
    <div class="alert alert-danger">Por Revise si usted es el usuario que esta Registrando la Entrega del Trabajo, Posteriormente no se podrá Modificar.</div>
    <input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
</tr>
</table>
</form>

</div>
<?php }else{
	echo $idioma["BoletaNoEncontrada"];	
}?>