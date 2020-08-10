<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

if(isset($_POST["content"])){

	$content = $_POST["content"];

	include "conexao.php";

	$inserir = "UPDATE parceiros SET conteudo = '$content'";
	$executa_inserir = mysqli_query($db, $inserir);
}



?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" /> <!-- TESTE DE ACENTOS -->
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
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE CSS ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/summernote/summernote.css" rel="stylesheet" />
	<!-- ================== END PAGE CSS ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>


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
					Seus dados foram enviados.
				</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
			</div>
			<?php }else{ ?> 
			<div class="alert alert-danger fade in m-b-15">
				<strong><font><font>Erro! </font></font></strong><font><font>
				Seus dados não foram enviados.
			</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
		</div>

		<?php } } ?>


		<!-- FIM CONFIRMAÇÃO ENVIO -->

		

		<!-- begin row -->
		<div class="row">
			<!-- begin col-2 -->

			<!-- end col-2 -->
			<!-- begin col-10 -->
			<div class="col-md-12">
				<div class="panel panel-inverse m-b-0">
					<div class="panel-heading">
						<div class="panel-heading-btn">
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
						</div>
						<h4 class="panel-title">Cadastro Lead</h4>
					</div>
					<div class="panel-body">
						<form action="crm_salvaattform.php" method="POST">
							<div id="wizard">									
								<!-- begin wizard step-1 -->
								<div>
									<fieldset>
										<legend class="pull-left width-full">Identificação</legend>
										<!-- begin row -->
										<div class="row">
											<!-- begin col-4 -->
											<div class="col-md-4">
												<div class="form-group">
													<label>Nome</label>
													<input type="text" name="primeironome" placeholder="Nome do Lead" class="form-control" required="" />
												</div>
											</div>
											<!-- end col-4 -->
											<!-- VALUE É O TOKEN PARA CADA ORIGEM -->
											<input type="hidden" name="origemfil" value="2">

											<!-- begin col-4 -->
											<div class="col-md-4">
												<div class="form-group">
													<label>E-mail</label>
													<input type="text" name="email" placeholder="Email do Lead" class="form-control" required="" />
												</div>
											</div>
											<!-- end col-4 -->
											<!-- begin col-6 -->
											<div class="col-md-4">
												<div class="form-group">
													<label>CEP</label>
													<input type="text" id="cep" name="cep" placeholder="99999-999" required="" class="form-control" />
												</div>
											</div>

										</div>
										<div class="row">
											<!-- begin col-6 -->
											<div class="col-md-6">
												<div class="form-group">
													<label>Telefone Celular</label>
													<input type="text" name="celular" placeholder="(16)99999-9999" required="" class="form-control" />
												</div>
											</div>
											<!-- end col-6 -->
											<!-- begin col-6 -->
											<div class="col-md-6">
												<div class="form-group">
													<label>Telefone Fixo</label>
													<input type="text" name="fixo" placeholder="(16)3333-3333" class="form-control" />
												</div>
											</div>
											<!-- end col-6 -->
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<!-- LATITUDE -->
												<div class="controls">
													<input type="hidden" name="lat" id="lat" class="form-control">
													<input type="hidden" name="rua" id="rua" class="form-control">
													<input type="hidden" name="cidade" id="cidade" class="form-control">
													<input type="hidden" name="bairro" id="bairro" class="form-control">
													<input type="hidden" name="lon" id="lon" class="form-control">
													<input type="hidden" name="imobiliaria_idimobiliaria" class="form-control" value="<?php echo $imobiliaria_idimobiliaria ; ?>">
													<input type="hidden" name="status" class="form-control" value="20">

												</div>
											</div>
										</div>
										<!-- end col-4 -->
									</fieldset>
								</div>
								<!-- end wizard step-1 -->

								<!-- begin wizard step-3 -->
								<div>
									<fieldset>

										<div class="row">

											<br/>                                                                                               
											<div class="form-group">
												<div class="col-md-9">
													<button type="submit" class="btn btn-sm btn-primary">Enviar</button>	
													<!-- #modal-dialog -->

												</div>
											</div>
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
		</div>
		<!-- end row -->
	</div>
	<!-- end #content -->

	<!-- begin theme-panel -->

	<!-- end theme-panel -->

	<!-- begin scroll to top btn -->
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- end scroll to top btn -->
</div>
<!-- end page container -->

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
		<script src="https://immobilebusiness.com.br/admin/assets/plugins/summernote/summernote.min.js"></script>
		<script src="https://immobilebusiness.com.br/admin/assets/js/form-summernote.demo.min.js"></script>
		<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
		<!-- ================== END PAGE LEVEL JS ================== -->
<script type="text/javascript"> 

	document.getElementById('menucrm').style.display="block";

</script>
		<script>
			$(document).ready( function() {
				/* Executa a requisição quando o campo CEP perder o foco */
				$('#cep').blur(function(){
					/* Configura a requisição AJAX */
					$.ajax({
						url : 'crm_consultarcep.php', /* URL que será chamada */ 
						type : 'GET', /* Tipo da requisição */ 
						data: 'cep=' + $('#cep').val(), /* dado que será enviado via POST */
						dataType: 'json', /* Tipo de transmissão */
						success: function(data){
							if(data.sucesso == 1){
								$('#lat').val(data.lat);
								$('#lon').val(data.lon);
								$('#rua').val(data.rua);
								$('#bairro').val(data.bairro);
								$('#cidade').val(data.cidade);
								
							}
						}
					});  
					return false;    
				})
			});

			
			$(document).ready(function() {
				App.init();
				FormSummernote.init();
			});
		</script>

	</body>


	</html>
