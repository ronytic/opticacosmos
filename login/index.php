<?php
include_once("../class/config.php");
//include_once("../class/anuncioslogin.php");
$idiomano=0;
if($_COOKIE['Idioma']=="" || empty($_COOKIE['Idioma'])){
	include_once("../idioma/es.php");	
}else{
	if(file_exists("../idioma/".$_COOKIE['Idioma'].".php")){
		include_once("../idioma/".$_COOKIE['Idioma'].".php");
	}else{
		$idiomano=1;
		include_once("../idioma/es.php");	
	}
}
//$anuncioslogin=new anuncioslogin;
$config=new config;
$TituloSistema=$config->mostrarConfig("TituloSistema",1);
$Titulo=$config->mostrarConfig("Titulo",1);
$sigla=$config->mostrarConfig("Sigla",1);
$LogoInicio=$config->mostrarConfig("LogoInicio",1);
$LogoIcono=$config->mostrarConfig("LogoIcono",1);
$NombreUnidadLogin=$config->mostrarConfig("NombreUnidadLogin",1);
$TipoUnidadLogin=$config->mostrarConfig("TipoUnidadLogin",1);
$ActualizacionNavegador=$config->mostrarConfig("ActualizacionNavegador",1);
$CodigoAdicionalSistemaLogin=$config->mostrarConfig("CodigoAdicionalSistemaLogin",1);
$CodigoSeguimientoSistema=$config->mostrarConfig("CodigoSeguimientoSistema",1);
$Telefono=$config->mostrarConfig("Telefono",1);
$folder="../";
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8" />
		<title>.:: <?php echo $idioma['TituloSistema']?>::.</title>

		<meta name="description" content="Sistema Desarrollado por Ronald Nina Layme">
		<meta name="author" content="Sistema Desarrollado por Ronald Nina Layme">
        
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

		<link href="<?php echo $folder?>css/core/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo $folder?>css/core/font-awesome.min.css" />
		<link rel="shortcut icon" href="../imagenes/logos/<?php echo $LogoIcono?>" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="<?php echo $folder?>css/core/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- fonts -->

		<link rel="stylesheet" href="<?php echo $folder?>css/core/ace-fonts.css" />

		<!-- ace styles -->
        <link rel="stylesheet" href="css/inicio.css">
		<link rel="stylesheet" href="<?php echo $folder?>css/core/ace.min.css" />
		<link rel="stylesheet" href="<?php echo $folder?>css/core/ace-rtl.min.css" />

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo $folder?>js/core/framework/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>
        
		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo $folder?>css/core/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="<?php echo $folder?>js/core/adicionales/html5shiv.js"></script>
		<script src="<?php echo $folder?>js/core/adicionales/respond.min.js"></script>
		<![endif]-->
        <script type="text/javascript" language="javascript" src="js/login.js"></script>
        <script language="javascript" type="text/javascript">
			RedirigirLogin=1;
			var AyudaTitulo="<?php echo $idioma['AyudaTitulo']?>";
		</script>

	</head>

	<body class="login-layout" style="background-image:url(../imagenes/fondos/<?php echo rand(7,14)?>.jpg);background-size:cover;">
    <div id="header">
        <h3 class="name-title"><?php echo $TituloSistema;?></h3>
        <h1 class="name-title">
           <?php echo $Titulo;?>
        </h1>
    </div>
    <div class="login">
        <div class="titulo">Acceso</div>
        <hr>
            <?php if(isset($_GET['error'])){?>
            <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <small><?php echo $idioma['DatosErroneos']?></small>
            </div>
            <?php }?>
            <?php if(isset($_GET['incompleto'])){?>
            <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <small><?php echo $idioma['NoDatos']?></small>
            </div>
            <?php }?>
        <form action="login.php" method="post" id="login">
            <input type="hidden" name="u" value="<?php echo $_GET['u'];?>" />
            <label class="block clearfix">
                <span class="block input-icon input-icon-right">
                <input type="text" name="usuario" id="usuario" class="form-control" placeholder="<?php echo $idioma['Usuario'] ?>" /><i class="icon-user"></i>
                </span>
            </label>
    
            <label class="block clearfix">
                <span class="block input-icon input-icon-right">
                <input type="password" name="pass" id="pass"  class="form-control" placeholder="<?php echo $idioma['Contraseña'] ?>" /><i class="icon-lock"></i>
                </span>
            </label>
            <button type="submit" class="pull-right btn btn-sm btn-primary">
            <i class="icon-key"></i><?php echo $idioma['Ingresar'] ?> 
            </button>
            <small class="pull-left">Sistema Desarrollado por <br><a href="http://fb.com/ronaldnina/" class="" target="_blank" title="Cel: 73230568">Ronald Nina Layme <br>Cel: 73230568</a></small>
            
        </form>
    </div>
    <div class="creditos"><small>Todos los Derechos Reservados &copy; 2014 - <?php echo date("Y")?></small></div>

		<script src="<?php echo $folder?>js/core/framework/bootstrap.min.js"></script>
		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo $folder?>js/core/adicionales/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?php echo $folder?>js/core/adicionales/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

	</body>
</html>