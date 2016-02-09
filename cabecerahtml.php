<?php include_once("login/check.php");
include_once("funciones/url.php");
/*Sacar Url*/
$url_separada=(separar_url($directory,url_sub()));
$url_modulo=array_shift($url_separada)."/";
$url_separada=implode("/",$url_separada);
/*Fin Sacar Url*/
include_once("class/menu.php");
include_once("class/submenu.php");
$menu=new menu;
$submenu=new submenu;
$mv=$menu->verificar($url_modulo,$_SESSION['Nivel']);
if($url_modulo!="/" && !isset($NoRevisar)){//Si no es el index revisar si tiene el permiso adecuado para ingresar al Sistema
	if(!count($mv)){
		header("Location:".url_base().$directory."login/?u=".$_SERVER['PHP_SELF']);
	}else{
		$mv=array_shift($mv);
		if($mv['SubMenu']){
			if(!count($submenu->verificar($url_separada,$_SESSION['Nivel']))){
				header("Location:".url_base().$directory."login/?u=".$_SERVER['PHP_SELF']);
			}
		}
	}
}

/*Agenda de Actividades*/
//include_once("class/agendaactividades.php");
//$agendaac=new agendaactividades;
//$cant=$agendaac->cantidadActividades();
//$cantagendaactividades=array_shift($cant);

/*Fin de Cantidad de Actividades*/
/*Notitifaciones*/
/*include_once("class/notificaciones.php");
$notificacionesi=new notificaciones;
$noti1=$notificacionesi->listarmensajes($_SESSION['Nivel'],1);
$noti2=$notificacionesi->listarmensajes($_SESSION['Nivel'],2);
$noti3=$notificacionesi->listarmensajes($_SESSION['Nivel'],3);*/
/*Fin de Notificaciones*/
?>
<?php
/*Codigo para ver qen que menu nos encontramos*/
$rurl=str_replace("index.php","",$_SERVER['SCRIPT_NAME']);
$rurl=str_replace("/".$directory,"",$rurl);
$rurl=explode("/",$rurl);
$rmenu=array_shift($rurl)."/";

$rsubmenu=implode("/",$rurl);
//echo $rmenu;
$textomenu="";
$textosubmenu="";
$urlSubMenu=explode("/",$rsubmenu);
$urlSubMenu=$urlSubMenu[0]."/";

//echo $urlSubMenu;
/*Fin de Obtenemos para el Menu*/
$Nivel=$_SESSION['Nivel'];
$CodUsuario=$_SESSION['CodUsuarioLog'];
if($Nivel==7||$Nivel==6){
	//header("Location:internet/alumno/");	
}
include_once("class/config.php");

include_once("class/usuario.php");

$config=new config;
if(!isset($usuario)){
	$usuario=new usuario;
}
$TituloSistema=$config->mostrarConfig("TituloSistema",1);
$Titulo=$config->mostrarConfig("Titulo",1);
$LogoInicio=$config->mostrarConfig("LogoInicio",1);
$LogoIcono=$config->mostrarConfig("LogoIcono",1);
$Sigla=$config->mostrarConfig("Sigla",1);
$Gestion=$config->mostrarConfig("Gestion",1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8" />
		<title><?php echo $idioma['TituloSistema']?></title>

		<meta name="description" content="Sistema Desarrollado por Ronald Nina Layme">
		<meta name="author" content="Sistema Desarrollado por Ronald Nina Layme">

		<!-- Inicio: Version Mobile -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fin: Version Mobile -->
        
        <!-- Inicio: Icono -->
        <link rel="shortcut icon" href="<?php echo $folder;?>imagenes/logos/<?php echo $LogoIcono?>" />
        <!-- Fin: Icono -->
        
		<!-- basic styles -->

		<link href="<?php echo $folder;?>css/core/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo $folder;?>css/core/font-awesome.min.css" />
        <link rel="stylesheet" href="<?php echo $folder;?>css/core/chosen.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="<?php echo $folder;?>css/core/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- fonts -->

		<link rel="stylesheet" href="<?php echo $folder;?>css/core/ace-fonts.css" />

		<!-- ace styles -->

		<link rel="stylesheet" href="<?php echo $folder;?>css/core/ace.min.css" />
		<link rel="stylesheet" href="<?php echo $folder;?>css/core/ace-rtl.min.css" />
		<link rel="stylesheet" href="<?php echo $folder;?>css/core/ace-skins.min.css" />
        <link id="bootstrap-style" href="<?php echo $folder;?>css/estilo.css" rel="stylesheet">

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo $folder;?>css/core/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->

		<script src="<?php echo $folder;?>js/core/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="<?php echo $folder;?>js/core/adicionales/html5shiv.js"></script>
		<script src="<?php echo $folder;?>js/core/adicionales/respond.min.js"></script>
		<![endif]-->


	<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo $folder;?>js/core/framework/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>
