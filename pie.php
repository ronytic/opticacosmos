<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->

						</div><!-- /.row -->

		<hr>
						<footer>
							<p class="pull-left"><?php echo $idioma['TituloSistema']?> - <?php echo $Sigla;?> &copy; <?php echo $idioma['DerechosReservados']?> 2014 - <?php echo date("Y");?></p>
							<p class="pull-right"><?php echo $idioma['DesarrolladoPor'];?>: <a href="http://fb.com/ronaldnina" class="enlacepie" target="_blank" title="Cel: 73230568">Ronald Nina Layme</a> </p>
						</footer>
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->
				<?php /*
				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="icon-cog bigger-150"></i>
					</div>

					<div class="ace-settings-box" id="ace-settings-box">
						<div>
							<div class="pull-left">
								<select id="skin-colorpicker" class="hide">
									<option data-skin="default" value="#438EB9">#438EB9</option>
									<option data-skin="skin-1" value="#222A2D">#222A2D</option>
									<option data-skin="skin-2" value="#C6487E">#C6487E</option>
									<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
								</select>
							</div>
							<span>&nbsp; Choose Skin</span>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
							<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
							<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
							<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
							<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
							<label class="lbl" for="ace-settings-add-container">
								Inside
								<b>.container</b>
							</label>
						</div>
					</div>
				</div><!-- /#ace-settings-container -->
				<?php */?>
			</div><!-- /.main-container-inner -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->


		
		
				



<script language="javascript">
	var TituloDocumento="<?php echo $idioma[$titulo]?>";
	var DeseaEliminarRegistro="<?php echo $idioma["DeseaEliminarRegistro"]?>";
	var DeseaModificarRegistro="<?php echo $idioma["DeseaModificarRegistro"]?>";
	var folder="<?php echo $folder?>";
	var mensajeg=Array();
	mensajeg['EliminarRegistro']="<?php echo $idioma['EliminarRegistro']?>";
	var DispositivoMovil=0;

</script>
<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?php echo $folder;?>js/core/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="<?php echo $folder;?>js/core/framework/bootstrap.min.js"></script>
<script src="<?php echo $folder;?>js/core/framework/typeahead-bs2.min.js"></script>

		
<script src="<?php echo $folder;?>js/core/plugins/jquery.form.js" language="javascript"></script>
<script src="<?php echo $folder;?>js/core/plugins/jquery.maskedinput.min.js" language="javascript"></script>
<script src="<?php echo $folder;?>js/core/plugins/jquery.stickytableheaders.min.js" language="javascript"></script>	

<link rel="stylesheet" href="<?php echo $folder;?>css/core/datepicker.css" />
<link rel="stylesheet" href="<?php echo $folder;?>css/core/bootstrap-timepicker.css" />
<link rel="stylesheet" href="<?php echo $folder;?>css/core/daterangepicker.css" />

<script src="<?php echo $folder;?>js/core/plugins/date-time/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $folder;?>js/core/plugins/date-time/bootstrap-timepicker.min.js"></script>
<script src="<?php echo $folder;?>js/core/plugins/date-time/moment.min.js"></script>
<script src="<?php echo $folder;?>js/core/plugins/date-time/daterangepicker.min.js"></script>

<script src="<?php echo $folder;?>js/core/cargadortotal.js?<?php echo rand()?>" language="javascript"></script>

<!-- ace scripts -->

		<script src="<?php echo $folder;?>js/core/ace-elements.min.js"></script>

		<script src="<?php echo $folder;?>js/core/ace.min.js"></script>

</body>
</html>