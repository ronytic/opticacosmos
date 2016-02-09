<?php

		//Usuario: 1,2,4,5
		$datosUsuario=$usuario->mostrarDatos($CodUsuario);
		$datosUsuario=array_shift($datosUsuario);
		$Apodo=$datosUsuario['Nick'];
		$ApellidoPSis=$datosUsuario['Paterno'];
		$ApellidoMSis=$datosUsuario['Materno'];
		$NombresSis=$datosUsuario['Nombres'];
		$FotoSis=$datosUsuario['Foto'];
?>
<script language="javascript">
$(document).on("ready",function(){
    $(".formulario *").change(function(e){
        $(".formulario").submit();
    });
});
</script>
</head>

<body>
	<div id="contenedorcargando"><img src="<?php echo $folder?>imagenes/cargador/cargador.gif"></div>
	<div class="navbar navbar-default" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left" >
					<a href="<?php echo $folder?>" class="navbar-brand">
						<div style="margin-left:10px">
							<img src="<?php echo $folder?>imagenes/logos/logo.png" height="30">
                            <span class="cabecera2"><?php echo $TituloSistema?></span>
							<span class="cabecera1"><?php echo $Titulo?></span> -
                            <span class="cabecera2"><?php echo capitalizar($UbicacionReporte)?></span>
                            
						</div>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->

				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
                    	<?php /* ?>
						<li class="grey">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-tasks"></i>
								<span class="badge badge-grey">4</span>
							</a>

							<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="icon-ok"></i>
									4 Tasks to complete
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">Software Update</span>
											<span class="pull-right">65%</span>
										</div>

										<div class="progress progress-mini ">
											<div style="width:65%" class="progress-bar "></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">Hardware Upgrade</span>
											<span class="pull-right">35%</span>
										</div>

										<div class="progress progress-mini ">
											<div style="width:35%" class="progress-bar progress-bar-danger"></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">Unit Testing</span>
											<span class="pull-right">15%</span>
										</div>

										<div class="progress progress-mini ">
											<div style="width:15%" class="progress-bar progress-bar-warning"></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">Bug Fixes</span>
											<span class="pull-right">90%</span>
										</div>

										<div class="progress progress-mini progress-striped active">
											<div style="width:90%" class="progress-bar progress-bar-success"></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										See tasks with details
										<i class="icon-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="purple">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-bell-alt icon-animated-bell"></i>
								<span class="badge badge-important">8</span>
							</a>

							<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="icon-warning-sign"></i>
									8 Notifications
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-pink icon-comment"></i>
												New Comments
											</span>
											<span class="pull-right badge badge-info">+12</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<i class="btn btn-xs btn-primary icon-user"></i>
										Bob just signed up as an editor ...
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-success icon-shopping-cart"></i>
												New Orders
											</span>
											<span class="pull-right badge badge-success">+8</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-info icon-twitter"></i>
												Followers
											</span>
											<span class="pull-right badge badge-info">+11</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										See all notifications
										<i class="icon-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="green">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-envelope icon-animated-vertical"></i>
								<span class="badge badge-success">5</span>
							</a>

							<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="icon-envelope-alt"></i>
									5 Messages
								</li>

								<li>
									<a href="#">
										<img src="assets/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Alex:</span>
												Ciao sociis natoque penatibus et auctor ...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>a moment ago</span>
											</span>
										</span>
									</a>
								</li>

								<li>
									<a href="#">
										<img src="assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Susan:</span>
												Vestibulum id ligula porta felis euismod ...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>20 minutes ago</span>
											</span>
										</span>
									</a>
								</li>

								<li>
									<a href="#">
										<img src="assets/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Bob:</span>
												Nullam quis risus eget urna mollis ornare ...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>3:15 pm</span>
											</span>
										</span>
									</a>
								</li>

								<li>
									<a href="inbox.html">
										See all messages
										<i class="icon-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>
						<?php */?>
						<li class="gray">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<!--<img class="nav-user-photo" src="<?php echo $folder?>imagenes/usuarios/<?php echo $FotoSis?>" title="<?php echo $NombresSis." ".$ApellidoPSis?>" alt="<?php echo $NombresSis." ".$ApellidoPSis?>" />-->
								<span class="user-info">
									<small><?php echo $idioma['Bienvenido']?>,</small>
									<?php echo $NombresSis ?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<?php /*?>
                                <li>
									<a href="#">
										<i class="icon-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="#">
										<i class="icon-user"></i>
										Profile
									</a>
								</li><?php */?>

								<li class="divider"></li>

								<li>
									<a href="<?php echo $folder?>login/logout.php">
										<i class="icon-off"></i>
										<?php echo $idioma['SalirSistema']?>
									</a>
								</li>
							</ul>
						</li>
                        <li class="purple">
							<a href="<?php echo $folder?>login/logout.php">
								<i class="icon-off"></i>
								<?php  echo $idioma['Salir']?>
							</a>
					</ul><!-- /.ace-nav -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
		</div>
    
    	<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>

				<div class="sidebar" id="sidebar">
					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
					</script>

					<div class="sidebar-shortcuts" id="sidebar-shortcuts">
						<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
							<button class="btn btn-success">
								<i class="icon-signal"></i>
							</button>

							<button class="btn btn-info">
								<i class="icon-pencil"></i>
							</button>

							<button class="btn btn-warning">
								<i class="icon-group"></i>
							</button>

							<button class="btn btn-danger">
								<i class="icon-cogs"></i>
							</button>
						</div>

						<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
							<span class="btn btn-success"></span>

							<span class="btn btn-info"></span>

							<span class="btn btn-warning"></span>

							<span class="btn btn-danger"></span>
						</div>
					</div><!-- #sidebar-shortcuts -->

					<ul class="nav nav-list">
                        <li class="<?php echo $rmenu=="/"?'active':''?>"><a href="<?php echo $folder;?>index.php"><i class="icon-home"></i><span> <?php echo $idioma['Inicio']?></span></a>
                        </li>
                        <?php
                        	foreach($menu->mostrar($Nivel,"Lateral") as $m){
								$subm=$submenu->mostrar($Nivel,$m['CodMenu']);
								?>
                                <li class=" <?php if ($rmenu==$m['Url']){$textomenu=$idioma[$m['Nombre']];echo'active open';}?>">
                                	<a href="#" class="<?php echo count($subm)?'dropdown-toggle':''?>">
                                    	<i class="<?php echo $m['Imagen'];?> "></i>
                                        <span class="menu-text"> <?php echo $idioma[$m['Nombre']];?></span>
                                        <?php if(count($subm)){?>
                                        <b class="arrow icon-angle-down"></b>
                                        <?php }?>
                                    </a>
            					<?php 
								
								if(count($subm)){
									?>
									<ul class="submenu">
									<?php
									foreach($subm as $sm){
										$UrlInternet="";
										if($sm['Internet']=="1" && $Internet==0){
											$UrlInternet="redirigir.php";	
										}
										//echo $m['Url'].$rsubmenu;
										?>
                                        
                                        <li class="<?php if($rmenu.$rsubmenu==$m['Url'].$sm['Url']){$textosubmenu=$idioma[$sm['Nombre']];echo 'active';}?>"> 
                                        	<a href="<?php echo $folder;?><?php echo $m['Url'];?><?php echo $sm['Url'];?><?php echo $UrlInternet?>">
                                            
                                            <i class="icon-double-angle-right"></i>
                                            <?php if($sm['Nuevo']=="1"){?><i class="icon-eye-open"></i><?php }?>
                                            <?php echo $idioma[$sm['Nombre']];?>
                                            
                                            </a>
                                        </li>
                                        <?php		
									}
									?>
                                    </ul>
                                    <?php
								}
								?>                    
                        	</li>
                            <?php
							}
						?>

					</ul>
<div class="sidebar-collapse" id="sidebar-collapse">
	<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
</div>
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
    </script>
</div>

<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="<?php echo $folder;?>"><?php echo $idioma['Inicio'] ?></a>
            </li>
            <li class="active"><?php echo $textomenu!=""?$textomenu." >":''?></li>
        </ul><!-- .breadcrumb -->

        <?php /*?><div class="nav-search" id="nav-search">
            <form class="form-search">
                <span class="input-icon">
                    <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                    <i class="icon-search nav-search-icon"></i>
                </span>
            </form>
        </div><!-- #nav-search -->
		<?php */?>
    </div>

    <div class="page-content">
        <div class="page-header">
            <h1>
            	<?php echo $idioma[$titulo];?>
                <?php //echo $textomenu!=""?$textomenu." >":''?>
                <small>
                    <!--<i class="icon-double-angle-right"></i>-->
                    <?php// echo $idioma[$titulo];?>
                </small>
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->