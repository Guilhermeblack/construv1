<?php 
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	set_time_limit(0);

	include "protege_professor.php";

	ini_set("upload_max_filesize", "10M");
	ini_set("max_execution_time", "-1");
	ini_set("memory_limit", "-1");
	ini_set("realpath_cache_size", "-1");
	if (!isset($_SESSION)) {
	  session_start();
	}
?>

<?php 

	include "conexao.php";
		
	if(isset($_POST['envio'])){

		$nome = $_POST['nome'];
		$rua = $_POST['rua'];
		$numero = $_POST['numero'];
		$bairro = $_POST['bairro'];
		$cidade = $_POST['cidade'];

		$query = mysqli_query($db, "INSERT INTO `const_deposito`(`nome`, `rua`, `numero`, `bairro`, `cidade`) VALUES ('$nome', '$rua' ,'$numero', '$bairro', '$cidade')")or die(mysqli_error($db));

		unset($_POST);
		header("Refresh:0");
	}
	

?>

<!DOCTYPE html>

<html lang="pt-br">
<!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<title>Immobile business</title>
		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
		<meta content="" name="description" />
		<meta content="" name="author" />
		
		<!-- ================== BEGIN BASE CSS STYLE ================== -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
		<link href="css/tooltip.css" rel="stylesheet">
		<link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/animate.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />

		<!-- Botão ON/OF --->
		<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
		

		<!-- ================== END BASE CSS STYLE ================== -->
		
		<style type="text/css">
			thead.thead-dark > tr > th{
				color: #fff!important;
				background-color: #343a40!important;
				font-weight: normal!important;
			}

			thead > tr > th{
				vertical-align: center!important; 
				font-size: 13px!important;
				padding: 5px!important;
				font-weight: bold;
				text-transform: uppercase!important;
			}
			thead{
				vertical-align: middle;
			}


			th, td {
				vertical-align:middle!important;
				color: #000;
				padding: 5px ;
				margin: 0px ;
				text-align: left;
				border-bottom: 1px solid #000;
			}


			/* CSS para estilo da nav bar nas modals da pagina*/
			.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
			    color: #428bca!important;
			    cursor: default!important;
			    background-color: #fff!important;
			    border: 1px solid #ddd!important;
			    border-bottom-color: transparent!important;
			}

			.nav-tabs>li>a {
			    margin-right: 2px!important;
			    line-height: 1.42857143!important;
			    border: 1px solid #ddd!important;
			    border-radius: 4px 4px 0 0!important;
			}

			.nav-tabs{
				background-color: #FFF!important;
			}

			.nav>li>a {
			    position: relative!important;
			    display: block!important;
			    padding: 10px 15px!important;
			}
		</style>

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
			<?php include "topo.php";?>

			<div class="sidebar-bg"></div>
			<!-- end #sidebar -->
			
			<!-- begin #content -->
			<div id="content" class="content">
				<div class="panel panel-inverse">	
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-2" style="padding: 2px;">
								<h2 class="panel-title">Estoque de Material</h2>
							</div>
							<div class="col-md-6 ">
								<div class="row" style="padding: 0px!important;">
									<div class="form-group col-md-2" style="margin-bottom: 0px!important;">
										<label>
											<label style="color: #FFF; font-weight:100; font-size: x-small; text-transform: uppercase; ">Selecione o Depósito </label>
										</label>
									</div>
									<div class="col-md-10 form-group" style="margin-bottom: 0px!important;">
										<select class="form-control" id="select_deposito">
											<option value="-1">Selecione</option>
											<?php 
												include "conexao.php";

												$query = mysqli_query($db, "SELECT * FROM `const_deposito`")or die(mysqli_error($db));

												if(mysqli_num_rows($query) > 0){
													while ($assoc = mysqli_fetch_assoc($query)) {
											?>
														<option value="<?php echo $assoc['id'];?>" style="text-transform: uppercase;"><?php echo $assoc['nome'];?></option>
											<?php
													}
												}

											 ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4" >
								<a class="btn btn-sm btn-primary"  href="#modal-cad-estoque" data-toggle="modal">Cadastrar Depósito</a>
							</div>
						</div>
					</div>

					<div class="panel-body table-wrapper-scroll-y my-custom-scrollbar" >
						<div role="tabpanel">
		                    <!-- Nav tabs -->
		                    <ul class="nav nav-tabs " role="tablist">
		                        <li role="presentation" class="active"><a href="#saldo_material" aria-controls="saldo_material" role="tab" data-toggle="tab" style="font-weight: bold;">Saldo de Material</a></li>
		                        <li role="presentation"><a href="#lista_entrada" aria-controls="lista_entrada" role="tab" data-toggle="tab" style="font-weight: bold;">Lista de Entrada</a></li>
		                        <li role="presentation"><a href="#lista_saida" aria-controls="lista_saida" role="tab" data-toggle="tab" style="font-weight: bold;">Lista de Saida</a></li>
		                        <li role="presentation"><a href="#extravios" aria-controls="extravios" role="tab" data-toggle="tab" style="font-weight: bold;">Extravios</a></li>
		                    </ul>
		                    <!-- Tab panes -->
		                    <div class="tab-content">
		                        <div role="tabpanel" class="tab-pane active" id="saldo_material">
		                        	<div class="form-group" align="center">
		                        		<input class="form-control" id="saldo_material" type="text" placeholder="Pesquise Aqui ..." >
		                        	</div>
		                        	<div class="pre-scrollable">
		                        		<table class="table table-bordered table-responsive-md table-striped text-center" id="saldo_material">
		                        			<thead class="thead-dark">
		                        				<tr>
		                        					<th class="text-center">CODIGO</th>
		                        					<th class="text-center">NOME INSUMO</th>
		                        					<th class="text-center">QUANTIDADE</th>
		                        					<th class="text-center">EMPREENDIMENTO</th>
		                        					<th class="text-center">DATA ULTIMA ENTRADA</th>
		                        					<th class="text-center">Extravio</th>
		                        				</tr>
		                        			</thead>
		                        			<tbody id="saldo_material">
		                        				<tr class="hidden">
		                        					<td class="text-center"></td>
		                        					<td class="text-center"></td>
		                        					<td class="text-center"></td>
		                        					<td class="text-center"></td>
		                        					<td class="text-center"></td>
		                        					<td class="text-center"><a class="btn btn-sm btn-danger extravio_item">Extravio</a></td>
		                        				</tr>
		                        			</tbody>
		                        		</table>
		                        	</div>
		                        </div>

		                        <div role="tabpanel" class="tab-pane" id="lista_entrada" >
		                        	<div class="form-group" align="center">
		                        		<input class="form-control" id="lista_entrada" type="text" placeholder="Pesquise Aqui ..." >
		                        	</div>
		                        	<div class="pre-scrollable">
		                        		<table class="table table-bordered table-responsive-md table-striped text-center" id="lista_entrada">
		                        			<thead class="thead-dark">
		                        				<tr>
		                        					<th class="text-center">CODIGO</th>
		                        					<th class="text-center">NOME INSUMO</th>
		                        					<th class="text-center">QUANTIDADE</th>
		                        					<th class="text-center">EMPREENDIMENTO</th>
		                        					<th class="text-center">DATA ENTRADA</th>
		                        				</tr>
		                        			</thead>
		                        			<tbody id="lista_entrada">
		                        				<tr class="hidden">
		                        					<td class="text-center"></td>
		                        					<td class="text-center"></td>
		                        					<td class="text-center"></td>
		                        					<td class="text-center"></td>
		                        					<td class="text-center"></td>
		                        				</tr>
		                        			</tbody>
		                        		</table>
		                        	</div>
		                        </div>

		                        <div role="tabpanel" class="tab-pane" id="lista_saida" >
		                        	<div class="form-group" align="center">
		                        		<input class="form-control" id="lista_saida" type="text" placeholder="Pesquise Aqui ..." >
		                        	</div>
		                        	<div class="pre-scrollable">
		                        		<table class="table table-bordered table-responsive-md table-striped text-center" id="lista_saida">
		                        			<thead class="thead-dark">
		                        				<tr>
		                        					<th class="text-center">CODIGO</th>
		                        					<th class="text-center">NOME INSUMO</th>
		                        					<th class="text-center">QUANTIDADE</th>
		                        					<th class="text-center">EMPREENDIMENTO</th>
		                        					<th class="text-center">DATA SAIDA</th>
		                        				</tr>
		                        			</thead>
		                        			<tbody id="lista_saida">
		                        				<tr class="hidden">
		                        					<td class="text-center"></td>
		                        					<td class="text-center"></td>
		                        					<td class="text-center"></td>
		                        					<td class="text-center"></td>
		                        					<td class="text-center"></td>
		                        				</tr>
		                        			</tbody>
		                        		</table>
		                        	</div>
		                        </div>

		                        <div role="tabpanel" class="tab-pane" id="extravios" >
		                        	<div class="form-group" align="center">
		                        		<input class="form-control" id="extravios" type="text" placeholder="Pesquise Aqui ..." >
		                        	</div>
		                        	<div class="pre-scrollable">
		                        		<table class="table table-bordered table-responsive-md table-striped text-center" id="extravios">
		                        			<thead class="thead-dark">
		                        				<tr>
		                        					<th class="text-center">CODIGO</th>
		                        					<th class="text-center">NOME INSUMO</th>
		                        					<th class="text-center">QUANTIDADE</th>
		                        					<th class="text-center">EMPREENDIMENTO</th>
		                        					<th class="text-center">DATA</th>
		                        					<th class="text-center">MOTIVO</th>
		                        				</tr>
		                        			</thead>
		                        			<tbody id="extravios">
		                        				<tr class="hidden">
		                        					<td class="text-center"></td>
		                        					<td class="text-center"></td>
		                        					<td class="text-center"></td>
		                        					<td class="text-center"></td>
		                        					<td class="text-center"></td>
		                        					<td class="text-center"></td>
		                        				</tr>
		                        			</tbody>
		                        		</table>
		                        	</div>
		                        </div>
		                    </div>
		                </div>
	                </div>
						
					<div class="panel-footer">
						<div class="row" style="padding: 5px;">
							<a class="btn btn-sm btn-primary" id="solicitacao" href="#modal-solicitao-feita" data-toggle="modal">Solicitao Abertas</a>
						</div>
					</div>
				</div>
			</div>


			<button href="#modal-dialog" data-toggle="modal" data-target="#modal-dialog" class="hidden" id="dialog"></button>
			<div id="modal-dialog" class="modal fade" role="dialog">
			    <div class="modal-dialog">
			        <div class="modal-content" >
			            <div class="modal-header" id="dialog-header">
			                <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
			            </div>
			            <div class="modal-body" id="dialog-body" align="center">
			                <h4 class="modal-title" align="center" id="salvar">Salvo com sucesso!</h4>
			            </div>
			            <div class="modal-footer" id="dialog-footer">
			                <button type="button" class="btn btn-defaut" data-dismiss="modal" >Fechar</button>
			            </div>
			        </div>
			    </div>
			</div>

			<div id="modal-cad-estoque" class="modal fade" role="dialog">
			    <div class="modal-dialog">
			        <div class="modal-content" >
			            <div class="modal-header" id="dialog-header">
			            	<h3 class="modal-title" style="font-size: 16px; font-weight: bold; text-transform: uppercase;">Cadastro de Estoque</h3>
			                <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
			            </div>
			            <div class="modal-body" id="dialog-body" align="center">
			            	<form action="const_deposito.php" method="post">
			            		<div class="row">
			            			<div class="form-group col-md-12">
			            				<label for="email" style="font-size: 11px; font-weight: bold; text-transform: uppercase;">Nome Depósito: </label>
			            				<input type="text" class="form-control" name="nome" required>
			            			</div>
			            		</div>

			            		<div class="row">
			            			<div class="form-group col-md-6">
			            				<label for="info" style="font-size: 11px; font-weight: bold; text-transform: uppercase;">Rua: </label>
			            				<input type="text" class="form-control" name="rua" required>
			            			</div>

			            			<div class="form-group col-md-6">
			            				<label for="info" style="font-size: 11px; font-weight: bold; text-transform: uppercase;">Nº: </label>
			            				<input type="number" class="form-control" name="numero" required>
			            			</div>
			            		</div>

			            		<div class="row">
			            			<div class="form-group col-md-6">
			            				<label for="info" style="font-size: 11px; font-weight: bold; text-transform: uppercase;">Bairro: </label>
			            				<input type="text" class="form-control" name="bairro" required>
			            			</div>

			            			<div class="form-group col-md-6">
			            				<label for="info" style="font-size: 11px; font-weight: bold; text-transform: uppercase;">Cidade: </label>
			            				<input type="text" class="form-control" name="cidade" required>
			            			</div>
			            		</div>

			            		<div class="form-group">
			            			<input type="submit" value="Cadastrar" name="envio" class="btn btn-primary btn-sm">
			            		</div>

			            	</form>
			            </div>
			            
			        </div>
			    </div>
			</div>

			<div id="modal-solicitao-feita" class="modal fade" role="dialog">
			    <div class="modal-dialog modal-lg">
			        <div class="modal-content" >
			            <div class="modal-header">
			            	<h3 class="modal-title" style="text-align: center; text-transform: uppercase; font-weight: bold;">Solicitação de insumos</h3>
			                <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
			            </div>
			            <div class="modal-body">
			            	<div class="card-body">
			            		<div class="form-group" >
			            			<input class="form-control" id="input-solicitao-feita" type="text" placeholder="Pesquise Aqui ...">
			            		</div>

			            		<div id="table_oc" class="pre-scrollable">
			            			<table class="table table-bordered table-responsive-md text-center" id="table_solicitacao">
			            				<thead class="thead-dark" id="thead_solicitacao_feita">
			            					<tr>
			            						<th class="text-center" style="width: 10%;">Nº</th>
			            						<th class="text-center" style="width: 20%;">Usuário</th>
			            						<th class="text-center" style="width: 10%;">Data</th>
			            						<th class="text-center" style="width: 15%;">Situação</th>
			            						<th class="text-center" style="width: 15%;">Ação</th>
			            						<th class="text-center" style="width: 15%;">Ver</th>
			            						<th class="text-center" style="width: 15%;">Aprovar</th>
			            					</tr>
			            				</thead>
			            				<tbody id="tbody_solicitacao_feita">
			            					<tr class="hidden">
			            						<td style='text-align: center; padding: 5px;'>solicitacao</td>
			            						<td class="usuario" style='text-align: center;'>0</td>
			            						<td class="data_solicitacao" style='text-align: center;'>0</td>
			            						<td class="situacao" style='text-align: center;'>Situacao</td>
			            						<td class="acao" style='text-align: center;'></td>
			            						<td class="ver_solicitacao" style='text-align: center;'><a class="btn btn-info btn-sm" id="ver_solicitacao">Ver Solicitação</a></td>
			            						<td class="aprovar_solicitacao" style='text-align: center;'><a class="btn btn-success btn-sm aprovar_solicitacao">Despachar Materiais</a></td>
			            					</tr>
			            				</tbody>
			            			</table>
			            		</div>
			            	</div>
			            </div>
			            <div class="modal-footer" >
			                <button type="button" class="btn btn-defaut" data-dismiss="modal" >Fechar</button>
			            </div>
			        </div>
			    </div>
			</div>

			<div id="modal-lista-item-solicitacao" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content" >
			            <div class="modal-header">
			            	<h3 class="modal-title" style="text-align: center; text-transform: uppercase; font-weight: bold;">Solicitação de insumos</h3>
			                <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
			            </div>
			            <div class="modal-body">

			            	<div class="card-body">
			            		<div class="form-group" >
			            			<input class="form-control" id="input_solicitacao_item" type="text" placeholder="Pesquise Aqui ...">
			            		</div>

			            		<div id="table_oc" class="pre-scrollable">
			            			<table class="table table-bordered table-responsive-md text-center" id="table_solicitacao_item">
			            				<thead class="thead-dark" id="thead_solicitacao_item">
			            					<tr>
			            						<th class="text-center" style="width: 20%;">Solicitação</th>
			            						<th class="text-center" style="width: 60%;">Descrição</th>
			            						<th class="text-center" style="width: 20%;">Quantidade</th>
			            					</tr>
			            				</thead>
			            				<tbody id="tbody_solicitacao_item">
			            					<tr class="hidden">
			            						<td class="solicitacao" style='text-align: center;'>0</td>
			            						<td style='text-align: center; padding: 2px;'>Descricao</td>
			            						<td class="quantidade_solicitado" style='text-align: center;'>0</td>
			            					</tr>
			            				</tbody>
			            			</table>
			            		</div>
			            	</div>
			            </div>
			            <div class="modal-footer" >
			                <button type="button" class="btn btn-defaut" data-dismiss="modal" >Fechar</button>
			            </div>
			        </div>
				</div>
			</div>


			<!--- Modal para cancelar a solicitacao ---->
			<div id="cancela_solicitacao" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
						</div>
						<div class="modal-body"  align="center">
							<h4 class="modal-title" align="center">Digite o Motivo do Cancelamento !</h4>
							<textarea name="message" rows="5" cols="60" id="motivo_cancela"></textarea>
						</div>
						<div class="modal-footer" >
						    <button type="button" class="btn btn-danger" id='cancela_solicitacao_def' >Cancelar Solicitacao</button>
						</div>
					</div>
				</div>
			</div>

			<!--- Modal para Extravio de insumos ---->
			<div id="extravio_insumo" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
						</div>
						<div class="modal-body"  align="center">
							<div class="form-group">
								<label for="qnt_extravio" style="font-size: 16px;">Quantidade Extraviada</label>
								<input type="number" name="qnt_extravio" id="qnt_extravio" class="form-control" style="width: 70%;">
							</div>
							<div class="form-group">
								<h4 class="modal-title" align="center">Digite o Motivo do Extravio !</h4>
								<textarea name="message" rows="5" cols="60" id="extravio_insumo"></textarea>
							</div>
						</div>
						<div class="modal-footer" >
						    <button type="button" class="btn btn-danger" id='extravio_insumo_def' >Confirmar</button>
						</div>
					</div>
				</div>
			</div>

			<!--- Modal para despachar  a solicitacao ---->
			<div id="aprova_solicitacao" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
						</div>
						<div class="modal-body"  align="center">
							<h4 class="modal-title" align="center">Deseja realmente Aprovar essa solicitação?</h4>
						</div>
						<div class="modal-footer" >
						    <button type="button" class="btn btn-sm btn-success" id='aprova_solicitacao'>Aprovar Solicitacao</button>
						</div>
					</div>
				</div>
			</div>

			<div id="modal7" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
						</div>
						<div class="modal-body" id="salvar" align="center">
							<h4 class="modal-title" align="center" id="salvar">Salvo com sucesso!</h4>
						</div>
						<div class="modal-footer" id="footer_salvar">
						    <button type="button" class="btn btn-defaut" data-dismiss="modal" >Fechar</button>
						</div>
					</div>
				</div>
			</div>

			<a class="hidden" id="id_usuario" id-user="<?php echo ($imobiliaria_idimobiliaria); ?>"></a>
		</div>

		<div class="script">
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
			<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/ui-contextmenu/jquery.ui-contextmenu.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.30.2/jquery.fancytree-all-deps.js"></script>
			<script src="js/const_deposito.js"></script>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.30.2/skin-win7/ui.fancytree.min.css" />

		</div>

		<script>
		    $(document).ready(function() {
		        App.init();
		      	
		      	//Defino o tamanho da tabela de acordo com o tamanho da tela do usuario
		      	var aux = ($(window).height() - 200);
		      	$("div.table-wrapper-scroll-y").css('max-height', aux);
		      
		    });


	        
		</script>
		
	</body>
</html>