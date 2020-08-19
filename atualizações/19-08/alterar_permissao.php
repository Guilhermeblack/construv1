<?php
include "conexao.php";
//error_reporting(0);
//ini_set(“display_errors”, 0 );
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
	
		function sanitizeString($str) {
			$str = preg_replace('/[áàãâä]/u', 'a', $str);
			$str = preg_replace('/[éèêë]/u', 'e', $str);
			$str = preg_replace('/[íìîï]/u', 'i', $str);
			$str = preg_replace('/[óòõôö]/u', 'o', $str);
			$str = preg_replace('/[úùûü]/u', 'u', $str);
			$str = preg_replace('/[ç]/u', 'c', $str);
			$str = preg_replace('/[ÁÀÃÂÄ]/u', 'A', $str);
			$str = preg_replace('/[ÉÈÊË]/u', 'E', $str);
			$str = preg_replace('/[ÍÌÎÏ]/u', 'I', $str);
			$str = preg_replace('/[ÓÒÔÕÖ]/u', 'O', $str);
			$str = preg_replace('/[ÚÙÛÜ]/u', 'U', $str);
			$str = preg_replace('/[Ç]/u', 'C', $str);
			return $str;
		}

		//Script para inserir ou deletar rotas passadas por parametros

		if(isset($_GET["rota"])){

			$rota = $_GET["rota"];
			$idgrupo = $_GET["idgrupo"];

			//Divido o parametro rota, obtendo todas as rotas passadas
			$rota = explode(",", $rota);
			

			//Deleta todas as rotas pertecentes ao $idgrupo da tabela grupo_rotas
			$query = "SELECT * FROM grupo_rota";
			$executa_query = mysqli_query ($db, $query);

			while($busca_query = mysqli_fetch_assoc($executa_query)){
				$remove_rota_grupo = mysqli_query($db,"DELETE FROM grupo_rota WHERE idgrupo = $idgrupo");
			}

			//Insere as rotas habilitadas na tabela grupo_rotas

			for($i = 0 ; $i < count($rota); $i++){
				$aux = $i;
				$rota[$aux] = addslashes($rota[$aux]);
				$insere_rota_grupo = mysqli_query($db,"INSERT INTO grupo_rota(idgrupo, idrota) values ($idgrupo,$rota[$aux])");
			}

		}

	 ?>

	<script type="text/javascript">

		function retorna_pagina_grupo(){
			//Script para voltar para a página de grupo de acesso quando feito o cadastro
			//alert("123");
			var url = window.location.href.toString();
			var aux = url.indexOf("&rota");
			if(aux !== -1){
				url = url.split("alterar", 1);
				window.location.href = url+"relatorio_grupos.php";
			}

		}

		function habilita_checkBox(){

			//retorna_pagina_grupo();

			// Função para habilitar apenas os checkBox referentes ao perfil do usuário
			var rotas_usuario = new Array();

			$(".escondidinho").each(function(){
				rotas_usuario.push($(this).text());
			});

			$("[type=checkbox]").each(function(){
				if($.inArray($(this).attr("id"), rotas_usuario) !== -1){
					$(this).attr('checked', true );
				}else{
					$(this).attr('checked', false );
				}

			});

		}

		function arruma_url(){
			var url = window.location.href.toString();

			url = url.split("&rota=", 1);

			return url;

		}

		function registra_rota(){

			//Função para identificar as rotas marcadas ou desmarcadas e passa-las por parametro GET

			var rotas_usuario = new Array();
			var rotas_habilitadas = new Array();

			$(".escondidinho").each(function(){
				rotas_usuario.push($(this).text());
			});

			$("[type=checkbox]").each(function(){
				if($(this).attr("checked") == "checked"){
					rotas_habilitadas.push($(this).attr("id"));
				}
			});


			/*
			var rotas_desmarcadas = rotas_usuario.filter(function(element, index, array){
				if(rotas_habilitadas.indexOf(element) == -1)
					return element;
			});


			var rotas_marcadas = rotas_habilitadas.filter(function(element, index, array){
				if(rotas_usuario.indexOf(element) == -1)
					return element;
			});
			*/

			//Arrumo a URL e seto os parametros GET
			window.location.href = arruma_url()+"&rota="+rotas_habilitadas+"&ok=1";
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
								$titulo = $busca_query['titulo'];

								//If para mostrar todas as opções principais
								/*
									Menu CLiente = 1						Contatos do Site = 43
									Financeiro = 4							Ocorrências = 47
									Locação / Venda = 15					Documentos = 48
									Empreendimentos = 22					Imobiliaria = 53
									Gestão de Vendas = 24				CRM = 54
									Projetos = 32							Relatórios = 66
									Configurações = 33
									Pendencias = 42
								*/

								if($idrotas == 1 || $idrotas == 4 || $idrotas == 22 || $idrotas == 32 || $idrotas == 33 ||
									$idrotas == 47 || $idrotas == 48 ||$idrotas == 66 || $idrotas == 85
									|| $idrotas == 87){
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
																  		<input type="checkbox" class="form-check-input" id="4" checked>
																  		Financeiro
																  	</li>
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

														
														case 22:
															?>
																<ul class="list-group">
																		<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="22" checked>
																  		 Empreendimentos
																  	</li>
																 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="23" checked>
																  		Cadastrar Empreendimentos
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
																  		<input type="checkbox" class="form-check-input" id="1" checked>
																  		Cliente (Menu)
																  	</li>
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
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="44" checked>
																  		Alterar dados Clientes
																  	</li>
																 </ul>
															<?php
															break;
														case 66:
															?>
																<ul class="list-group">
																	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="66" checked>
																  		Relatório (menu)
																  	</li>
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
																  		<input type="checkbox" class="form-check-input" id="72" checked>
																  		Extrato Clientes
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
																  		<input type="checkbox" class="form-check-input" id="84" checked>
																  		Aniversariantes
																  	</li>
																 </ul>
															<?php
															break;
															case 85:
															?>
																<ul class="list-group">
																 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="85" checked>
																  		Planilhas de cadastro
																  	</li>
																 </ul>
															<?php
															break;
															case 86:
															?>
																<ul class="list-group">
																 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="86" checked>
																  		Email Automatico
																  	</li>
																 </ul>
															<?php
															break;
															case 87:
															?>
																<ul class="list-group">
																	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="87" checked>
																  		Construcao
																  	</li>
																 	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="88" checked>
																  		Orçamento
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="89" checked>
																  		Insumos
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="90" checked>
																  		Plano de Conta
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="91" checked>
																  		Cotação
																  	</li>
																  	<li class="list-group-item">
																  		<input type="checkbox" class="form-check-input" id="92" checked>
																  		Ordem Compra
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
				habilita_checkBox();
			}
		);
	</script>
	<div hidden>
			<?php 
				include "conexao.php";
				$idgrupo = $_GET["idgrupo"];

				//imprime uma lista invisivel com todas as rotas do usuarios selecionado
				$query = "SELECT grupo_rota.idgrupo, grupo_rota.idrota, rotas.titulo FROM grupo_rota INNER JOIN rotas ON grupo_rota.idrota = rotas.idrotas where grupo_rota.idgrupo = $idgrupo";
				
				$aux1 = mysqli_query ($db,$query) or die ("Erro ao listar rotas");
				while ($auxiliar = mysqli_fetch_assoc($aux1)) {
					$idrota = $auxiliar['idrota'];
					$titulo = $auxiliar['titulo'];

					?>
					<span class="escondidinho"><?php echo $idrota ?></span>
					<?php
				}
			?>
	</div>
</body>

</html>
