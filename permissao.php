<?php
include "conexao.php";
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html>
<!--<![endif]-->

<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
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
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<?php  

		//Script para inserir o grupo de acesso na tabela grupo e as rotas pertencentes na tabela grupo_rota

		if(isset($_GET["grupoAcesso"])){

			$grupoAcesso = $_GET["grupoAcesso"];
			$rotas = $_GET["rotas"];

			//Divido o parametro rota, obtendo todas as rotas passadas
			$rotas = explode(",", $rotas);

			//Insere no banco de dados e recupera o id do registro
			$insere_grupo = mysqli_query($db,"INSERT INTO grupo (titulo_grupo) values ('$grupoAcesso')");
			$idgrupo = mysqli_insert_id($db);

			for($i = 0 ; $i <= count($rotas); $i++){
				$insere_rota_grupo = mysqli_query($db,"INSERT INTO grupo_rota(idgrupo, idrota) values ('$idgrupo','$rotas[$i]')");
			}
		}

	 ?>

	<script type="text/javascript">

		function checkbox(){

			//Função para desmarcar todos os checkBox da pagina
			$("[type=checkbox]").each(function(){
				$(this).attr('checked', false );
			
			});
		}

		function arruma_url(){

			var url = window.location.href.toString();

			url = url.split("?", 1);

			return url;

		}

		function retorna_pagina_grupo(){
			//Script para voltar para a página de grupo de acesso quando feito o cadastro
			//alert("123");
			var url = window.location.href.toString();
			var aux = url.indexOf("?rotas");
			if(aux !== -1){
				url = url.split("permissao", 1);
				window.location.href = url+"relatorio_grupos.php";
			}

		}

		function registra_rota(){

			//Função para identificar as rotas marcadas ou desmarcadas e passa-las por parametro GET

			var grupo_acesso = $("#grupoAcesso").val();
			if(grupo_acesso ==""){
				alert("Preencha o campo campo!");
				return ;
			}

			var rotas_habilitadas = new Array();

			$("[type=checkbox]").each(function(){
				if($(this).attr("checked") == "checked"){
					rotas_habilitadas.push($(this).attr("id"));
				}
			});


			//Arrumo a URL e seto os parametros GET
			window.location.href = arruma_url()+"?rotas="+rotas_habilitadas+"&grupoAcesso="+grupo_acesso+"&ok=1";
		}
	</script>
</head>
<body>

<!-- begin #page-loader -->
<div id="page-loader" class="fade"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
	
	<?php include "topo.php"; ?>

	<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin breadcrumb -->

		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header">Permissão de Acesso</h1>
		<!-- end page-header -->
		<?php 

			//Função para mostrar uma div de sucesso de cadastro.

			if(isset($_GET["ok"])){ ?>
				<div class="alert alert-success fade in m-b-15">
					<strong><font>Sucesso!</font></strong>

					<font>
						Suas alterações foram salvas.
					</font>

					<span class="close" data-dismiss="alert" ><font>X</font></span>

				</div>
			<?php } 

		?>
			<!-- begin row -->
		<div class="row">

			<!-- begin col-10 -->
			<div class="col-md-12">
				
				<div class="panel panel-inverse">
					<div class="panel-heading">
						<div class="panel-heading-btn">
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
						</div>
						<h3 class="panel-title">Nome do Grupo de Acesso</h3>
					</div>
					<div class="panel-body">
						<div class="panel-title">
							<input type="text" id="grupoAcesso" name="titulo_grupo" class="form-control" placeholder="Nome Grupo de Acesso" required>
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<div class="panel-group" id="accordion">
						<?php

							include "conexao.php";

							$idgrupo = $_GET["idgrupo"];

							//Recupera todas as rotas do banco de dados e lista todas na tela
							$query = "SELECT * FROM rotas";

							$executa_query = mysqli_query ($db,$query) or die ("Erro ao listar rotas");

							$cont = 1000;

							while ($busca_query = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

								$idrotas = $busca_query['idrotas'];
								$titulo = utf8_encode($busca_query['titulo']);

								//If para mostrar todas as opções principais
								/*
									Menu CLiente = 1						Contatos do Site = 43
									Financeiro = 4							Ocorrências = 47
									Locação / Venda = 15					Documentos = 48
									Empreendimentos = 22					Imobiliaria = 53
									Gestão de Vendas = 24					CRM = 54
									Projetos = 32							Relatórios = 66
									Configurações = 33
									Pendencias = 42
								*/

								if($idrotas == 1 || $idrotas == 4 || $idrotas == 15 || $idrotas == 22 || $idrotas == 24 || $idrotas == 32 || $idrotas == 33 ||
									$idrotas == 42 || $idrotas == 43 || $idrotas == 47 || $idrotas == 48 || $idrotas == 53 || $idrotas == 54 || $idrotas == 66){
									$cont++;
							?>
									<div class="panel panel-inverse overflow-hidden">
										<div class="panel-heading">
											<h3 class="panel-title">
												<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" <?php echo "href=#$cont"?> >
													<i class="fa fa-plus-circle pull-right"></i> 
													<?php  echo $titulo; ?>
												</a>
											</h3>
										</div>
										<div <?php echo "id=\"".$cont."\" " ?>  class="panel-collapse collapse" >
											<div class="panel-body" <?php echo "id=$idrotas"?>>
												<?php 
													switch ($idrotas) {
														case 54:
															?>
																<ul class="list-group">
																	<li class="list-group-item">
																		<input type="checkbox" class="form-check-input" id="55" checked>
																		CMR Status/Origem
																	</li>	
																	<li class="list-group-item">
																		<input type="checkbox" class="form-check-input" id="56" checked>
																		CRM Lista de LEADS
																	</li>	
																	<li class="list-group-item">
																		<input type="checkbox" class="form-check-input" id="57" checked>
																		CRM Mapa de Leads
																	</li>	
																	<li class="list-group-item">
																		<input type="checkbox" class="form-check-input" id="58" checked>
																		CRM Tratativa
																	</li>																		
																	<li class="list-group-item">
																		<input type="checkbox" class="form-check-input" id="59" checked>
																		CRM Cadastro Site
																	</li>
																	<li class="list-group-item">
																		<input type="checkbox" class="form-check-input" id="60" checked>
																		CRM editar LEAD
																	</li>
																	<li class="list-group-item">
																		<input type="checkbox" class="form-check-input" id="61" checked>
																		CRM excluir LEAD
																	</li>	
																	<li class="list-group-item">
																		<input type="checkbox" class="form-check-input" id="62" checked>
																		CRM Roleta de Cadastro
																	</li>
																	<li class="list-group-item">
																		<input type="checkbox" class="form-check-input" id="63" checked>
																		CRM Relatórios
																	</li>
																	<li class="list-group-item">
																		<input type="checkbox" class="form-check-input" id="65" checked>
																		CRM Equipe Imóveis
																	</li>																				
																</ul>	
															<?php
															break;
														case 42:
															?>
																<ul class="list-group">
																 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="42" checked>
																  		Pendencias
																  	</li>
																 </ul>
															<?php
															break;
														case 47:
															?>
																<ul class="list-group">
																 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="47" checked>
																  		Ocorrências
																  	</li>
																 </ul>
															<?php
															break;
														case 48:
															?>
																<ul class="list-group">
																 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="48" checked>
																  		Documentos
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="64" checked>
																  		Excluir Documentos
																  	</li>
																 </ul>
															<?php
															break;
														case 4:
															?>
																<ul class="list-group">
																 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="5" checked>
																  		A Pagar
																  	</li>
															  		<li class="list-group-item">
															  	 		<input type="checkbox" class="form-check-input" id="6" checked>
															  	 		Lançar a Pagar
															  	 	</li>
														  	 		<li class="list-group-item">
														  	 	 		<input type="checkbox" class="form-check-input" id="7" checked>
														  	 	 		Baixar a Pagar
														  	 	 	</li>
														  	 	 	<li class="list-group-item">
														  	 	 		<input type="checkbox" class="form-check-input" id="8" checked>
														  	 	 		A Receber
														  	 	 	</li>
														  	 	 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="9" checked>
																  		Lançar a Receber
																  	</li>
															  		<li class="list-group-item">
															  	 		<input type="checkbox" class="form-check-input" id="10" checked>
															  	 		Baixar a Recebr
															  	 	</li>
														  	 		<li class="list-group-item">
														  	 	 		<input type="checkbox" class="form-check-input" id="11" checked>
														  	 	 		Repasse
														  	 	 	</li>
														  	 	 	<li class="list-group-item">
														  	 	 		<input type="checkbox" class="form-check-input" id="12" checked>
														  	 	 		Lançar Repasse
														  	 	 	</li>
														  	 	 	<li class="list-group-item">
														  	 	 		<input type="checkbox" class="form-check-input" id="13" checked>
														  	 	 		Imposto
														  	 	 	</li>
														  	 	 	<li class="list-group-item">
														  	 	 		<input type="checkbox" class="form-check-input" id="14" checked>
														  	 	 		Lançar Impostos
														  	 	 	</li>
																 </ul>
															<?php
															break;
														case 43:
															?>
																<ul class="list-group">
																 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="43" checked>
																  		Contatos do Site
																  	</li>															  
																 </ul>
															<?php
															break;
														case 15:
															?>
																<ul class="list-group">
																 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="16" checked>
																  		Imóveis Locação
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="17" checked>
																  		Cadastrar Imóveis Locação
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="18" checked>
																  		Editar Imóveis Locação
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="19" checked>
																  		Excluir Imóveis Locação
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="20" checked>
																  		Contratos Locação
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="21" checked>
																  		Cadastrar Contratos Locação
																  	</li>
																 </ul>
															<?php
															break;
														case 53:
															?>
																<ul class="list-group">
																 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="52" checked>
																  		Excluir Lote
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="51" checked>
																  		Excluir Quadra
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="50" checked>
																  		Estornar Venda
																  	</li>
																 </ul>
															<?php
															break;
														case 22:
															?>
																<ul class="list-group">
																 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="23" checked>
																  		Cadastrar Empreendimentos
																  	</li>
																 </ul>
															<?php
															break;
														case 24:
															?>
																<ul class="list-group">
																 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="25" checked>
																  		Cadastrar Gestão de Vendas
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="26" checked>
																  		Configurar Gestão de Vendas
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="27" checked>
																  		Contratos Empreendimentos
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="28" checked>
																  		Cadastrar Contratos Empreendimentos
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="29" checked>
																  		Aprovar / Reprovar Contratos
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="30" checked>
																  		Espelho de Vendas
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="31" checked>
																  		Cadastrar Espelho de Vendas
																  	</li>
																 </ul>
															<?php
															break;
														case 33:
															?>
																<ul class="list-group">
																 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="33" checked>
																  		Configurações
																  	</li>
																 </ul>
															<?php
															break;
														case 32:
															?>
																<ul class="list-group">
																 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="32" checked>
																  		Projetos
																  	</li>
																 </ul>
															<?php
															break;
														case 1:
															?>
																<ul class="list-group">
																 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="2" checked>
																  		Cadastrar Cliente
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="3" checked>
																  		Editar Cliente
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="45" checked>
																  		Excluir Cliente
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="46" checked>
																  		Vincular Cadastro
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="49" checked>
																  		Ver todos Clientes
																  	</li>
																 </ul>
															<?php
															break;
														case 66:
															?>
																<ul class="list-group">
																 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="67" checked>
																  		Relatório de Vendas
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="68" checked>
																  		Contas a pagar
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="69" checked>
																  		Recebimentos
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="70" checked>
																  		Comissão
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="71" checked>
																  		Carta Cobrança
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="72" checked>
																  		Extrato Clientes
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="73" checked>
																  		Inadimplência Empreendimentos
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="74" checked>
																  		Inadimplência Locação
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="75" checked>
																  		Contratos Pendentes a Reajustar
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="76" checked>
																  		Contratos a Reajustar
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="77" checked>
																  		Tipo - Cadastro
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="78" checked>
																  		Clientes - Completo
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="79" checked>
																  		Imobiliárias
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="80" checked>
																  		Lotes
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="81" checked>
																  		Jurídico
																  	</li>
																  		<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="82" checked>
																  		DIMOB Empreendimentos
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="83" checked>
																  		DIMOB Locação
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="84" checked>
																  		Aniversariantes
																  	</li>
																 </ul>
															<?php
															break;
														default:
															break;
													}
												 ?>
											</div>
										</div>
									</div>
							<?php }
							
							}
						?>

					</div>
					<button class="btn btn-success" name="Teste" onclick="registra_rota();">Registrar</button>

					<!-- end col-6 -->
				</div>
				<!-- end row -->
			</div>
		</div>			

		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
</div>
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
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/table-manage-buttons.demo.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	


	<script>
		$(document).ready(function() {
			App.init();
			TableManageButtons.init();
			retorna_pagina_grupo();
			checkbox();
		});
	</script>
</body>

</html>