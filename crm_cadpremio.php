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
	
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets\plugins\jquery-ui\themes\base\minified\jquery-ui.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />

	
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/isotope/isotope.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/lightbox/css/lightbox.css" rel="stylesheet" />
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>



	
</head>
<body>
	
	<script type="text/javascript"> 


		function excluir(id){

			window.location ="crm_excluir_premio.php?prm=" + id;

		}

		function inativar(id){
			
			window.location ="crm_excluir_premio.php?sts=" + id;
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


		<div id="content" class="content">

<?php if (in_array('66', $idrota)) { ?>
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="crm_debitop.php"><span class="label label-success">Novo Cadastro</span></a></li>
				
			</ol>	
<?php } ?>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Cadastro de Prêmios </h1>
			<!-- end page-header -->
			<!-- CONFIRMAÇÃO ENVIO -->
			<?php 

			if(isset($_GET["res"])){ 

				$resposta = $_GET["res"];
				if($resposta == 1){ ?>

					<div class="alert alert-success fade in m-b-15">
						<strong><font><font>Sucesso! </font></font></strong><font><font>
							Solicitação de resgate enviada.
						</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
					</div>
				<?php } else { ?>
					<div class="alert alert-danger fade in m-b-15">
						<strong><font><font>Erro! </font></font></strong><font><font>
							Solicitação de resgate não enviada, saldo insuficiente.
						</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
					</div>
				<?php }}  



				if(isset($_GET["ex"])){ 

					$resposta = $_GET["ex"];
					if($resposta == 1){ ?>

						<div class="alert alert-success fade in m-b-15">
							<strong><font><font>Sucesso! </font></font></strong><font><font>
								Prêmio excluído.
							</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
						</div>
					<?php } else { ?>
						<div class="alert alert-danger fade in m-b-15">
							<strong><font><font>Erro! </font></font></strong><font><font>
								Prêmio não excluído.
							</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
						</div>
					<?php }}  
					if(isset($_GET["in"])){ 

						$resposta = $_GET["in"];
						if($resposta == 1){ ?>

							<div class="alert alert-success fade in m-b-15">
								<strong><font><font>Sucesso! </font></font></strong><font><font>
									Prêmio inativado.
								</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
							</div>
						<?php } else { ?>
							<div class="alert alert-danger fade in m-b-15">
								<strong><font><font>Erro! </font></font></strong><font><font>
									Prêmio não inativado.
								</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
							</div>
						<?php }}  

						if(isset($_GET["cad"])){ 

							$resposta = $_GET["cad"];
							if($resposta == 1){ ?>

								<div class="alert alert-success fade in m-b-15">
									<strong><font><font>Sucesso! </font></font></strong><font><font>
										Prêmio cadastrado.
									</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
								</div>
							<?php }else{ ?> 
								<div class="alert alert-danger fade in m-b-15">
									<strong><font><font>Erro! </font></font></strong><font><font>
										Prêmio não cadastrado.
									</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
								</div>

							<?php } } ?>


							<!-- FIM CONFIRMAÇÃO ENVIO -->
							<?php if(isset($_GET["edt"])){ 

								$resposta = $_GET["edt"];
								if($resposta == 2){ ?>



									<div class="alert alert-success fade in m-b-15">
										<strong><font><font>Sucesso! </font></font></strong><font><font>
											Prêmio editado.
										</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
									</div>
								<?php } else{ ?> 
									<div class="alert alert-danger fade in m-b-15">
										<strong><font><font>Erro! </font></font></strong><font><font>
											Prêmio não editado.
										</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
									</div>

								<?php } } ?>


								<div id="options" class="m-b-10">
									<span class="gallery-option-set" id="filter" data-option-key="filter">
										<a href="#show-all" class="btn btn-default btn-xs active" data-option-value="*">
											Show All
										</a>

										<?php 
										include "conexao.php";
										
										if ($idgrupo_acesso == 5 || $idgrupo_acesso == 9 || $idgrupo_acesso == 6 || $idgrupo_acesso == 11 || $idgrupo_acesso == 13) { //Administrador
									$querypremio = "SELECT * FROM empreendimento INNER JOIN empreendimento_cadastro ON idempreendimento_cadastro = empreendimento_cadastro_id INNER JOIN empreendimento_imob ON empreendimento_cadastro_id = empreendimento_id";
										$execpremio = mysqli_query($db, $querypremio) or die("Impossível listar prêmios no momento!");
										$cont = 0;

							} else {

										$queryloc = "SELECT imob_id FROM cliente WHERE idcliente = $imobiliaria_idimobiliaria";

										$execloc = mysqli_query($db, $queryloc) or die("Erro ao selecionar empreendimentos.");
										$loc = mysqli_fetch_assoc($execloc);
										$imobid = $loc["imob_id"];

										$querypremio = "SELECT * FROM empreendimento INNER JOIN empreendimento_cadastro ON idempreendimento_cadastro = empreendimento_cadastro_id INNER JOIN empreendimento_imob ON empreendimento_cadastro_id = empreendimento_id where imobiliaria_id = '$imobid'";
										$execpremio = mysqli_query($db, $querypremio) or die("Impossível listar prêmios no momento!");
										$cont = 0; }


										while ($aux = mysqli_fetch_assoc($execpremio)) {


											$idemp  = $aux["idempreendimento_cadastro"];
											$nomeemp  = $aux["descricao_empreendimento"];


											?>							

											<a href="#gallery-group-<?php echo $idemp; ?>" class="btn btn-default btn-xs" data-option-value=".gallery-group-<?php echo $idemp ;?>">
												<?php echo $nomeemp; ?>
											</a>

										<?php } mysqli_close(); ?>
									</span>
								</div>

								<div id="gallery" class="gallery">
									<?php 
									include "conexao.php";


									 if (in_array('66', $idrota)) { 
									$querypremio = "SELECT * FROM crm_premio";
								} else {$querypremio = "SELECT * FROM crm_premio WHERE crm_statuspremio = '1'";
}
									$execpremio = mysqli_query($db, $querypremio) or die("Impossível listar prêmios no momento!");
									$cont = 0;
									while ($aux = mysqli_fetch_assoc($execpremio)) {

										$idpremio = $aux["crm_idpremio"];
										$titulo = utf8_encode($aux["crm_titulopremio"]);
										$valor  = $aux["crm_vlrpremio"];
										$desc   = utf8_encode($aux["crm_descricaopremio"]);
										$foto   = $aux["crm_fotopremio"];
										$grupo  = $aux["crm_empid"];
										$ativo 	= $aux["crm_statuspremio"];
										$estrela = $aux["crm_estrelaspremio"];

										$pedidoquery = "SELECT crm_statusresgate AS stsresgate, crm_dataresgate AS datar, crm_idresgate AS idr FROM crm_resgate WHERE crm_codproduto = $idpremio AND crm_corretorid = $imobiliaria_idimobiliaria ORDER BY idr desc";

										$execpedido = mysqli_query($db, $pedidoquery);
										$buscapedido = mysqli_fetch_assoc($execpedido);
										$aux = $buscapedido["stsresgate"];
										$datar = $buscapedido["datar"];
										$idr   = $buscapedido["idr"];
										?>

										<div class="image gallery-group-<?php echo $grupo ?>">
											<div class="image-inner">
												<a id="imgresgate" name="imgresgate[]" href="#" data-lightbox="gallery-group-<?php echo $grupo;?>">
													<img src="<?php echo $foto ?>" alt="" />
												</a>
												<?php if ($aux == 0) {

												} elseif ($aux == 1) { ?>
													<p class="image-caption">
												<span style="">Aguardando Aprovação.</span>
												</p>
												<?php } elseif ($aux == 2) { ?>
												<p class="image-caption">
												<span style="">Resgate Aprovado</span><br>
												<span>para: <?php echo $datar ?></span>
												</p>
											<?php } else { ?>
												<p class="image-caption">
												<span style="">Resgate Reprovado.</span>
												</p>
											<?php } ?>
											</div>
											<form action="crm_salvaresgate.php" method="POST" id="pcard" name="pcard">
												<div class="image-info">
													<h5 class="title"><?php echo $titulo ?> </h5>

													<div class="pull-right">
														<h4><small>Pt$</small> <?php echo $valor ?></h4>
													</div>

													<div class="rating">

														<?php for ($i=0; $i < $estrela; $i++) { 

															?><span class="star active"></span><?php

														} 
														$estrela = 5 - $estrela;

														for ($i=0; $i < $estrela; $i++) {

															?><span class="star"></span><?php

														} 
														?>



													</div>
													<div class="desc">
														<?php echo $desc ?>
													</div>

<?php if (in_array('66', $idrota)) { ?>
													<?php if (in_array('61', $idrota)) { ?>

														<a href="#" onclick="javascript: if (confirm('Você realmente deseja excluir este cadastro?')) excluir(<?php echo "$idpremio"; ?>)"><span class="label label-danger">Excluir</span></a>
													<?php } ?> 
													<a href="crm_debitop_editar.php?edit=<?php echo $idpremio ?>"><span class="label label-warning">Editar</span></a>
													<a href="#" onclick="javascript: if (confirm('Você realmente deseja inativar este cadastro?')) inativar(<?php echo "$idpremio"; ?>)"><span class="label label-inverse">Inativar</span></a>
													<?php } ?>
													<input type="hidden" name="hinteresse" value="<?php echo $grupo ?>">
													<input type="hidden" name="hresgate[]" id="hresgate" value="<?php echo $idr ?>">
													<input type="hidden" name="hcorretor" value="<?php echo $imobiliaria_idimobiliaria ?>">
													<input type="hidden" name="hvlr" value="<?php echo $valor ?>">
													<input type="hidden" name="hdescricao" value="<?php echo $desc ?>">
													<input type="hidden" name="hpremio" value="<?php echo $idpremio ?>">
													<div class="pull-right">
														<button onclick="javascript: if (confirm('Você realmente deseja resgatar este prêmio?')){ document.btresgate.submit();}" name="btresgate" class="btn btn-sm btn-primary">Resgatar</button>	
													</div>

												</div>
											</form>
										</div>

										<?php
									}
									?>
								</div>	

							</div>

							<!-- begin scroll to top btn -->
							<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
							<!-- end scroll to top btn -->
						</div>
						<!-- end page container -->


						<!-- ================== BEGIN BASE JS ================== -->


						<!-- ================== END PAGE LEVEL JS ================== -->

						<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
						<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
						<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
						<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/isotope/jquery.isotope.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/lightbox/js/lightbox.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/gallery.demo.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	
	
	<script type="text/javascript">
		document.getElementById('menucrm').style.display="block";
	</script>
	<script>
		$(document).ready(function() {
			App.init();
			Gallery.init();
		});
	</script>
</body>


</html>

