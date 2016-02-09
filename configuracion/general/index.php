<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NConfiguracionSistema";


include_once("../../class/config.php");
$config=new config;
$TC=$config->mostrarConfig("TC",1);
$Lema=$config->mostrarConfig("Lema",1);
include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
configuracion={todayBtn: "", endDate: "'0d'"};
</script>
<?php include_once($folder."cabecera.php");?>
<form action="guardar.php" method="post">
<table class="table tablestriped table-hover table-bordered">
    <thead>
        <tr>
            <th></th>
            <th></th>
        </tr>
    </thead>
	<tr class="warning">
    	<td class="der"><?php echo $idioma['TasaCambio'] ?></td>
        <td><?php campo("TC","text",$TC,"",1)?></td>
    </tr>
    <tr class="">
    	<td class="der"><?php echo $idioma['Lema'] ?></td>
        <td><?php campo("Lema","text",$Lema,"",1,"",0,array("size"=>50))?></td>
    </tr>
    <tr>
    	<td colspan="2">
        	<?php campo("","submit",$idioma['Guardar'],"btn btn-info","")?>
        </td>
    </tr>
</table>
</form>
<?php include_once($folder."pie.php");?>