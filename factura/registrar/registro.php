<?php
include_once("../../login/check.php");
$l=$_POST['l'];
?>
<tr class="f<?php echo $l?>">
    <td class="der"><?php echo $l?></td>
    <td colspan="2"><input type="text" value="<?php echo ""?>" required class="col-sm-12" name="df[<?php echo $l?>][Detalle]" tabindex="<?php echo $l*2+3?>"></td>
    <td><input type="text" value="0.00" required class="der col-sm-12 monto" name="df[<?php echo $l?>][Monto]" tabindex="<?php echo $l*2+4?>"></td>
    <td><a href="#" class="btn btn-xs btn-info eliminar" rel="<?php echo $l?>"><i class="icon-remove"></i></a></td>
</tr>
<script language="javascript">
$("input,select,div.chosen-container").keydown(enter2tab);
</script>