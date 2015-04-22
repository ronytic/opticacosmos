<?php include_once("../../login/check.php");
$titulo="NMensajeRespuesta";
$folder="../../";
?>
<?php include_once($folder."cabecerahtml.php");?>
<?php include_once($folder."cabecera.php");?>

<div class="col-sm-12">
	<div class="widget-box">
    	<div class="widget-header widget-header-flat"><h4><?php echo $idioma['Mensajes'] ?></h4></div>
        <div class="widget-body">
        	<div class="widget-main">
            	<ul class="list-unstyled">
                	<?php foreach($Mensajes as $m){?>
                	<li><i class="icon-angle-right bigger-110"></i><?php echo $m ?></li>
                    <?php }?>
                </ul>

				<hr>
                <?php if($Nuevo==1){?>
                <a href="<?php echo "index.php"?>" class="btn btn-info"><?php echo $idioma['Nuevo']?></a>
                <?php }?>
                <?php if($Listar==1){?>
                <a href="<?php echo "listar.php"?>" class="btn btn-success"><?php echo $idioma['Listar']?></a>
                <?php }?>
                
                <?php 
				if(!empty($Botones)){
					foreach($Botones as $btnk=>$btnv){
						if(is_array($btnv)){
							$valor=$btnv[0];
							$clase=$btnv[1];	
						}else{
							$valor=$btnv;
							$clase="";	
						}
					?>
					<a href="<?php echo $btnk?>" class="btn <?php echo $clase?>"><?php echo $valor?></a>
					<?php 
					}
				}?>
            </div>
        	
        </div>
    </div>
</div>
<?php include_once($folder."pie.php");?>