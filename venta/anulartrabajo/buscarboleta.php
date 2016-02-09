<?php
include_once("../../login/check.php");
include_once("../../class/optica.php");
include_once("../../class/paciente.php");
include_once("../../class/medico.php");
$optica=new optica;
$paciente=new paciente;
$medico=new medico;
$NumeroBoleta=$_POST['NumeroBoleta'];

$opt=$optica->mostrarTodoRegistro("NumeroBoleta='$NumeroBoleta' and Emitido=1");
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
    <thead ><tr class="centrar"><th>Fecha de Ingreso</th><th>Número de Boleta</th><th>Ingresado Por</th><th>Datos Paciente</th><th>Fecha de Entrega</th></tr></thead>
    <tr class="centrar"><td><?php echo fecha2Str($opt['FechaEmitido'])." ".$opt['HoraEmitido']?></td><td class="centrar"><?php echo ($opt['NumeroBoleta'])?></td><td><?php echo ($opt['Recepcion'])?></td><td><?php echo capitalizar($pac['Paterno'])?> <?php echo capitalizar($pac['Materno'])?> <?php echo capitalizar($pac['Nombres'])?></td><td><?php echo fecha2Str($opt['FechaEntrega'])." ".$opt['HoraEntrega']?></td></tr>
    </table>

    <table class="table table-bordered table-striped">
    <thead><tr class="centrar"><th>Monto Total</th><th>A Cuenta Bs</th><th>A Cuenta $us	 - T.C. <?php echo ($opt['TC'])?></th><th>Saldo a Cobrar</th></tr></thead>
    <tr class=" centrar"><td><?php echo ($opt['TotalBs'])?></td><td><?php echo ($opt['ACuentaBs'])?></td><td>$ <?php echo ($opt['ACuentaSus'])?> = Bs <?php echo ($opt['TotalAcuentaSus'])?></td><td><?php echo $opt['SaldoBs']?></td></tr>
    </table>

    <?php if($opt['EstadoEntrega']==1){
        ?>
        <div class="alert alert-danger"><center><h4>ESTA BOLETA YA FUE ENTREGADO</h4></center>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="centrar">
                    <th>Entregado Por</th>
                    <th>Fecha de Entrega</th>
                    <th>Hora de Entrega</th>
                </tr>
            </thead>
            <tr class="centrar">
                <td><?php echo $opt['NombreEntrega']?></td>
                <td><?php echo fecha2Str($opt['FechaEntregaReal'])?></td>
                <td><?php echo $opt['HoraEntregaReal']?></td>
            </tr>
        </table>
        </div>
        <?php
    }else{?>

        
        <div class="alert alert-success"><strong>EL NÚMERO DE BOLETA YA FUE EMITIDO Y NO FUE RECOGIDO</strong></div>
<?php }?>


<?php }else{
    $opt=$optica->mostrarTodoRegistro("NumeroBoleta='$NumeroBoleta'");
    $opt=array_shift($opt);
	if($opt['Anulado']==1){
        echo '<div class="alert alert-warning"><strong>El Número de la Boleta fue Anulada</strong></div>';   
    }else{
        echo '<div class="alert alert-warning"><strong>El Número de la Boleta no fue Emitida</strong></div>';	
    }
}?>
<form action="guardar.php" method="post" onSubmit="" id="formularioRevisar">
            <input type="hidden" name="CodOptica" value="<?php echo $opt['CodOptica']?>">
            <input type="hidden" name="NumeroBoleta" value="<?php echo $NumeroBoleta?>">
            <table class="table table-bordered">
            <thead><tr class="centrar"><th>Fecha que Será Anulado</th><th>Será Anulado Por</th><th>Confirmar Contraseña</th></tr></thead>
            <tr class="info centrar">
                <td><input type="text" class="fecha form-control" value="<?php echo date("d-m-Y")?>" readonly name="Fecha"></td>
                <td>
                <?php campo("Recepcion","text",$NombresSis." ".$ApellidoPSis." ".$ApellidoMSis,"col-sm-12 form-control",1,"",0,array("readonly"=>"readonly"))?>
                
                </td>
                <td><input type="password" name="contrasena" id="contrasena" class="form-control" autocomplete=""></td>
            </tr>
            </table>
            <div class="alert alert-danger">Por Revise si usted es el usuario que esta Registrando la ANULACIÓN  del Trabajo.</div>
            <input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>" autofocus  id="guardar">
</form>
<script language="javascript">
var SaldoBs=<?php echo $opt['SaldoBs']!=""?$opt['SaldoBs']:0;?>;
var Pass="<?php echo $_SESSION['Pass'];?>";
$("#contrasena").focus();
$("*").on('keydown', null, 'ctrl+0', enviarformulario);

function enviarformulario(){
    //alert("asd");
    $("#formularioRevisar").submit()
}
</script>