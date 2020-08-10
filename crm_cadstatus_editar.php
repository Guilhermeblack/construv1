<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8" />
	<title>Immobile | Business</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/animate.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/multiple-select.css" rel="stylesheet"/>
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<script type="text/javascript"> 

	$("#horas").mask("00:00");

		function excluir(){

			document.nome.action = "crm_excluirstatus.php";
			document.nome.submit();

		}

	</script>

	

	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
		<!-- begin #header -->
		
		<?php 
		include "topo.php";
		//echo $_SERVER['HTTP_REFERER']; 

		 ?>


		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			
			<!-- begin page-header -->
			<h1 class="page-header">CRM | Immoblie</h1>
			<!-- end page-header -->
			
			<!-- CONFIRMAÇÃO ENVIO -->
			<?php if(isset($_GET["cad"])){ 

				$resposta = $_GET["cad"];
				if($resposta == 1){ ?>

					<div class="alert alert-success fade in m-b-15">
						<strong><font><font>Sucesso! </font></font></strong><font><font>
							Dados cadastrados.
						</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
					</div>
				<?php }else{ ?> 
					<div class="alert alert-danger fade in m-b-15">
						<strong><font><font>Erro! </font></font></strong><font><font>
							Seus dados não foram cadastrados.
						</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
					</div>

				<?php } } elseif (isset($_GET["stt"])) {

					$resposta = $_GET["stt"];
			if ($resposta == 1) { ?> 

				<div class="alert alert-danger fade in m-b-12">
					<strong><font><font>Erro! </font></font></strong><font><font>
						Este status não pode ser excluído.
					</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
				</div>
<?php } elseif ($resposta == 2) { ?>
		
			<div class="alert alert-success fade in m-b-12">
					<strong><font><font>Concluído! </font></font></strong><font><font>
						Status excluído com sucesso.
					</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
				</div>

<?php }
					
				} ?>


				<!-- FIM CONFIRMAÇÃO ENVIO -->
<?php 
			$iid = $_GET["id"];

			include "conexao.php";
			$query_slide = mysqli_query($db,"SELECT * FROM crm_status WHERE crm_idstatus = $iid ") or die ("Erro ao listar grupo dos clientes, tente mais tarde");

    while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

    	$id          = $buscar_slide["crm_idstatus"];
    	$desc          = $buscar_slide["crm_status"];
    	$cor          = $buscar_slide["crm_cor"];
    	$dias          = $buscar_slide["crm_diasatt"];
    	$horas          = $buscar_slide["crm_horasatt"];
    	$funil          = $buscar_slide["crm_funil"];
    	$posicao          = $buscar_slide["crm_posicaofunil"];
    	$pts 			= $buscar_slide["crm_pontostatus"];
    	
}
    ?> 

				<!-- begin row -->
				<div class="row">
					<!-- begin col-2 -->

					<!-- end col-2 -->
					<!-- begin col-10 -->
					<div class="col-md-6">
						<div class="panel panel-inverse m-b-0">
							<div class="panel-heading">
								<div class="panel-heading-btn">
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
								</div>
								<h4 class="panel-title">Cadastro Status</h4>
							</div>
							<div class="panel-body">
								<form action="crm_salvastatus.php?edit=<?php echo $id ?>" method="POST">


		
									<div id="wizard">									

										<!-- begin wizard step-3 -->
										<div>
											<fieldset>

												<div class="row">
													


													<div class="col-md-4">
														<div class="form-group">
															<label>Nome do Status</label>
															<input type="text" name="nome_status" placeholder="Atendimento" class="form-control" required="" value="<?php echo $desc ?>" />
															
														</div>
														
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>Dias Att</label>
															<input type="number" min="0" id="data" placeholder="0" name="timerd" class="form-control" required="" value="<?php echo $dias ?>" />
															
														</div>
														
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>Tempo Att</label>
															<input type="text" placeholder="00:00" name="timert" id="horas" class="form-control" required="" value="<?php echo $horas ?>" />
															
														</div>
														
													</div>
													<div class="col-md-12">
														<div class="input-group">
															<input class="form-control" name="cadcor" data-id="color-palette-1" value="<?php echo $cor ?>"/>
															<div class="input-group-btn">
																<a class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tint"></i></a>
																<ul class="dropdown-menu dropdown-menu-right">
																	<li><div id="color-palette-1"></div></li>
																</ul>
															</div>
														</div>
														
													</div>

													<div class="col-md-4">
	<div class="form-group">
		<label>Antecessor:</label>
		<select style="width: 100%" multiple="multiple" name="status[]" id="select">

			<?php

			include "conexao.php";

			$query_amigo = "SELECT * FROM crm_status";                      
			$executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar status");
			
			

                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                	$ids             = $buscar_amigo['crm_idstatus'];
                	$nomes            = $buscar_amigo["crm_status"];             

                	?>
                	<option value="<?php echo "$ids" ?>" <?php 
                	
            $query_amigo2 = "SELECT * FROM crm_statusvinculo WHERE crm_idstatus = $iid";
            $executa_query2 = mysqli_query ($db, $query_amigo2) or die ("Erro ao listar status");
                	while ($buscar_amigo2 = mysqli_fetch_assoc($executa_query2)) {
                		$idv 	=$buscar_amigo2["crm_idant"];
                		$id2 = $buscar_amigo2["crm_idstatus"];
                		
                	
                	if ($ids == $idv) { ?> selected <?php } } ?>> 
                	<?php echo "$nomes" ?> 
                </option>
                <?php } ?>


            </select>
        </div>
    </div>

    <div class="col-md-4" style="padding-left: 25px;">
    	
    	<div class="form-group">
    		<label>Pontos:</label>
    		<input type="number" id="pts" placeholder="0" name="pts" class="form-control" required value="<?php echo $pts ?>" />
    	</div>
    </div>    

												
												</div>
<div class="col-md-6">
													<button type="submit" class="btn btn-sm btn-primary">Editar</button>
												</div>
											</fieldset>





										</div>
										<!-- end wizard step-3 -->



									</div>
								</form>


							</div>

						</div>


					</div>
					<!-- end col-10 -->



					<!-- end row -->

					<!-- begin row -->


<!-- end col-10 -->
</div>



</div>
<!-- end #content -->

<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->

</div>
<!-- end page container -->
<script src="https://immobilebusiness.com.br/admin/assets/js/multiple-select.js"></script>
    <script>
        $('#select').multipleSelect();
    </script>

<!-- ================== BEGIN BASE JS ================== -->
<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="https://immobilebusiness.com.br/admin/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="https://immobilebusiness.com.br/admin/assets/crossbrowserjs/respond.min.js"></script>
		<script src="https://immobilebusiness.com.br/admin/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/masked-input/masked-input.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/password-indicator/js/password-indicator.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-daterangepicker/moment.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/js/select2.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-show-password/bootstrap-show-password.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/clipboard/clipboard.min.js"></script>
	<script src="jswill/form-plugins.demo.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>

	<script src="https://immobilebusiness.com.br/admin/assets/plugins/switchery/switchery.min.js"></script>
<script src="https://immobilebusiness.com.br/admin/assets/js/form-slider-switcher.demo.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
<script type="text/javascript"> 

	document.getElementById('menucrm').style.display="block";

</script>
	<script>
		$(document).ready( function() {
   $(".funilfill").change(function () {
           /* Configura a requisição AJAX */
           var value = $(this).val();

           var action = $(this).is(':checked') ? '1' : '0';
           var fila = $("#"+value).val(); 
           $.ajax({
                url : 'crm_preenchefunil.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: "value="+value+"&action="+action+"&fila="+fila,/* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                  alert('Success');
            if (msg != 'success') {
                alert('Fail');
            }
                                      
                }
           });   
   return false;    
   })
});




		$(document).ready(function() {
			App.init();
			FormPlugins.init();
			FormSliderSwitcher.init();
			
					});
	</script>

</body>


</html>
