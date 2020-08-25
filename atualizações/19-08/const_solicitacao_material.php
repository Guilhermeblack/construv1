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
			/* custom alignment (set by 'renderColumns'' event) */

			@media screen and (max-width: 600px) {
				a.panel-baixo{
					display: inherit!important;
					float: none!important;
					margin-bottom: 15px!important;
				}

				input#tema{
					display: none!important;
				}

				div.toggle{
					display: none!important;
				}

				span.fancytree-title{
					width: 60%!important;
					font-size: 8px!important;

				}

				tr.nao-orcado > td#tree{
					background-color: #FFF!important;
				}

				tr.nao-orcado > td#tree > span > span.fancytree-title{
					color: #cc0000!important;
				}

				td#id{
					display: none!important;
				}

				th#id{
					display: none!important;
				}

				table#tree > thead > tr > th{
					vertical-align: center!important; 
					font-size: 8px!important;
					padding: 2px!important;
					font-weight: bold!important;
					text-transform: uppercase!important;

				}

				table#tree td > input{
					width: 100%!important;
				}
			}

			.alignCenter {
				text-align: center;
			}

			span{
				font-family: Arial, Helvetica, sans-serif;
			}

			input{
				width: 100%;
			}

			input.estorou{
				color: #ff3547!important;
			}

			th, td {
				padding: 0px !important;
				margin: 0px !important;
				text-align: left;
				border-bottom: 1px solid #000;
			}

			tr.pai > td#tree > span {
				font-weight: bold;
				text-transform: uppercase;
			}

			tr > td#tree> span {
				text-transform: capitalize;
			}

			label {
				font-weight: bold;
				font-size: 15px;
				text-transform: uppercase;
			}

			.panel-title{
				font-size: 16px !important;
			}

			.modal-title{
				text-transform: uppercase;
				font-size: 16px !important;
			}

			.my-custom-scrollbar {
				position: relative;
				overflow: auto;
			}
			.table-wrapper-scroll-y {
				display: block;
			}

			span.erro{
				color: #ff3547 !important;
			}

			span.glyphicon-ok{
				color: #388e3c;
			}

			span.glyphicon-folder-open{
				color: #eeae4a;
			}

			tr:not(.pai) > td#tree > span.fancytree-node > span.fancytree-title{
				max-width: 80%;
				font-size: 11px;
			}
			thead.thead-dark > tr > th{
				color: #fff!important;
				background-color: #343a40!important;
				font-weight: normal!important;
				font-size: 11px!important;
				vertical-align: middle;
			}

			thead > tr > th{
				vertical-align: center; 
				font-size: 13px!;
				padding: 5px!important;
				font-weight: bold;
				text-transform: uppercase;
			}

			thead{
				vertical-align: middle;
			}

			td{
				vertical-align:middle!important;
				color: #000;
			}

			td.indisponivel{
				background-color: #ffc107!important;
			}

			tbody#tbody_solicitacao > tr > td {
				padding: 5px!important;
			}

			tbody#tbody_solicitacao_feita > tr > td{
				padding: 5px!important;
			}

			td.estorou{
				color: #FFF!important;
				background-color: #ff3547!important;
				font-weight: bold;
			}

			td.zerado{
				background-color: #F48024!important;
			}

			td.maior_estoque{
				background-color: #9de1fe!important;
			}

			h2.tracking-in-contract-bck {
				-webkit-animation: tracking-in-contract-bck 2s cubic-bezier(0.215, 0.610, 0.355, 1.000) both;
				animation: tracking-in-contract-bck 2s cubic-bezier(0.215, 0.610, 0.355, 1.000) both;

			}

			tr.nao-orcado > td#tree{
				color: #cc0000!important;
				background-color: #ffc107;
			}

			body{
				padding-right: 0px!important;
			}
		</style>

		<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
		<!-- ================== END BASE JS ================== -->
	</head>
	<body  style="padding-right: 0px!important;">
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

				<h3 class="page-header">Gerenciamento de Materiais</h3>

				<div class="panel panel-inverse">	
					<div class="panel-heading">
						<div class="row">

							<div class="col-md-2"></div>
							
							<div class="col-md-4" id="empre">
								<div class="row">
									<div class="col-md-3">
										<label for='empre' style="color: #FFF; font-weight:100; font-size: x-small; text-transform: uppercase; ">Selecione o Empreendimento</label>
									</div>
									<div class="col-md-9">
										<select class="form-control" id="empre">
											<option value="-1" editable="0">Selecione</option>
											<?php 
												include "conexa.php";

												$query = mysqli_query($db, "SELECT * FROM `empreendimento_cadastro`")or die(mysqli_error($db));

												if(mysqli_num_rows($query)){
													while ($assoc = mysqli_fetch_assoc($query)) {
														?>
															<option value="<?php echo $assoc['idempreendimento_cadastro'] ?>"><?php echo $assoc['descricao_empreendimento'] ?></option>
														<?php
													}
												}
											?>

										</select>
									</div>
								</div>
							</div>

							<div class="col-md-4" id="titulo_orc">
								<div class="row">
									<div class="col-md-3">
										<label for='orcamento' style="color: #FFF; font-weight:100; font-size: x-small; text-transform: uppercase; ">Selecione o Orçamento </label>
									</div>
									<div class="col-md-9">
										<select class="form-control" id="orcamento">
											<option value="-1" editable="0">Selecione</option>
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-4 align-items-center hidden" id="div_input">
								<div class="input-group form-group">
									<input name="search" placeholder="Pesquise Aqui..." autocomplete="off" id="search" class="form-control" type="text">
									<div class="input-group-btn">
										<button id="btnResetSearch" class="btn">&times;</button>
									</div>
								</div>
							</div>

							<div class="col-md-2 hidden" align="right">
								<input type="checkbox" data-toggle="toggle" data-size="small" data-onstyle="info" data-offstyle="default" id="tema">
							</div>
						</div>
					</div>
					
					<!-- <div class="row alert" style="padding: 3px;" >
						<div class="col-md-11" style="text-align: center;">
							<h3  style="text-align: center; text-transform: uppercase; ">Solicitação de Material</h3>
						</div>
						<div class="col-md-1" align="right">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div> -->

					<div class="col-md-12" id="div_input">
						<div class="input-group form-group" style="margin: 10px!important;">
							<input name="search" placeholder="Pesquise Aqui..." autocomplete="off" id="search" class="form-control" type="text">
							<div class="input-group-btn">
								<button id="btnResetSearch" class="btn">&times;</button>
							</div>
						</div>
					</div>

					<div class="panel-body table-wrapper-scroll-y my-custom-scrollbar" >

						<table id="tree" class="table table-bordered">
							<thead class="thead-dark">
								<tr> 
									<th class="alignCenter" style="width:5%!important; ">#</th> 
									<th class="alignCenter" style="width:5%!important; " id="id">ID</th> 
									<th class="alignCenter" style="width:50%!important; ">Pastas</th> 
									<th class="alignCenter" style="width:10%!important;">Quantidade</th> 
									<th class="alignCenter" style="width:10%!important;">Medida</th> 
									<th class="alignCenter" style="width:10%!important;">Qnt Solicitada</th>
									<th class="alignCenter" style="width:10%!important;">Qnt Recebida</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td id="checkbox" class="alignCenter"></td>
									<td id="id" style="padding: 4px !important; " ></td>
									<td id="tree"></td>
									<td class="alignCenter"><input name="qnt" type="text" disabled></td>
									<td class="alignCenter" id="no_input"><input name="unidade" type="text" disabled></td>
									<td class="alignCenter" id="no_input"><input name="qnt_solicitada" type="text" disabled></td>
									<td class="alignCenter" id="no_input"><input name="qnt_recebida" type="text" disabled></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="panel-footer">
						<div class="row">
							<a class="btn btn-primary btn-sm panel-baixo" id="solicita_insumo">Solicitar Insumo</a>
							<a class="btn btn-success btn-sm panel-baixo" id="despacha_material">Despachar Material</a>
							<a class="btn btn-primary btn-sm panel-baixo" href="#modal-solicitao-feita" data-toggle="modal" style="float: right;">Solicitações</a>

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

			<div id="modal-despacho" class="modal fade" role="dialog">
			    <div class="modal-dialog modal-lg">
			        <div class="modal-content" >
			            <div class="modal-header">
			            	<h3 class="modal-title" style="text-align: center; text-transform: uppercase; font-weight: bold;">Despacho de Material</h3>
			                <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
			            </div>
			            <div class="modal-body">

			            	<div class="card-body">
			            		<div id="table_oc" class="pre-scrollable">
			            			<table class="table table-bordered table-responsive-md text-center" id="table_despacho">
			            				<thead class="thead-dark" id="thead_despacho">
			            					<tr>
			            						<th class="text-center" style="width: 60%;">Descrição</th>
			            						<th class="text-center" style="width: 20%;">Qnt</th>
			            					</tr>
			            				</thead>
			            				<tbody id="tbody_despacho">
			            					<tr class="hidden">
			            						<td style='text-align: center; padding: 2px;'>Descricao</td>
			            						<td class="qnt_despacho" contenteditable="true" style='text-align: center;' onKeypress="if((event.keyCode < 48 && event.keyCode != 46) || event.keyCode > 57 ){return false;}">0</td>
			            					</tr>
			            				</tbody>
			            			</table>
			            		</div>
			            	</div>
			            </div>
			            <div class="modal-footer" >
			            	<div class="row">
			            		<div class="col-md-6 form-group">
			            			<label for="select_deposito" ></label>
			            			<select class="form-control" id="select_deposito">
			            				<option value="-1">SELECIONE</option>
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
			            		
			            		<div class="col-md-6">
		            				<a class="btn btn-success btn-sm" id="despacha_material_def">Despachar Material</a>
		            			    <button type="button" class="btn btn-defaut" data-dismiss="modal" >Fechar</button>
			            		</div>
			            	</div>
			            	
			            </div>
			        </div>
			    </div>
			</div>

			<div id="modal-solicitao" class="modal fade" role="dialog">
			    <div class="modal-dialog modal-lg">
			        <div class="modal-content" >
			            <div class="modal-header">
			            	<h3 class="modal-title" style="text-align: center; text-transform: uppercase; font-weight: bold;">Solicitação de insumos</h3>
			                <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
			            </div>
			            <div class="modal-body">

			            	<div class="card-body">
			            		<div class="form-group" >
			            			<input class="form-control" id="input_solicitacao" type="text" placeholder="Pesquise Aqui ...">
			            		</div>

			            		<div id="table_oc" class="pre-scrollable">
			            			<table class="table table-bordered table-responsive-md text-center" id="table_solicitacao">
			            				<thead class="thead-dark" id="thead_solicitacao">
			            					<tr>
			            						<th class="text-center">DESCRICÃO</th>
			            						<th class="text-center" style="width: 15%;">ORIGEM</th>
			            						<th class="text-center" >QNT DISPONIVEL</th>
			            						<th class="text-center">QNT ORÇADO</th>
			            						<th class="text-center">QNT RESTANTE</th>
			            						<th class="text-center" >QUANTIDADE</th>
			            					</tr>
			            				</thead>
			            				<tbody id="tbody_solicitacao">
			            					<tr class="hidden">
			            						<td style='text-align: center; padding: 2px;'>Descricao</td>
			            						<td class="origem" style='text-align: center;'>
			            							<select class="form-control depositos_qnt_disponivel">
			            								<option value="-1">SELECIONE</option>
			            								<option value="0">COMPRAS</option>
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
			            						</td>
			            						<td style='text-align: center; padding: 2px;'>QNT DISPONIVEL</td>
			            						<td style='text-align: center; padding: 2px;'>QNT ORÇADO</td>
			            						<td style='text-align: center; padding: 2px;'>QNT RESTANTE</td>
			            						<td class="qnt_solicitada" contenteditable="true" style='text-align: center;' onKeypress="if((event.keyCode < 48 && event.keyCode != 46) || event.keyCode > 57 ){return false;}">0</td>
			            					</tr>
			            				</tbody>
			            			</table>
			            		</div>
			            	</div>
			            </div>
			            <div class="modal-footer" >
			            	<div class="col-md-6">
			            		<div class="row">
			            			<div class="col-md-1" align="right" style="padding-top: 5px;">
			            				<div style="width: 10px!important; height: 10px!important; background-color: #ff3547!important;"></div>
			            			</div>
			            			<div class="col-md-11" align="left" style="padding: 0;">
			            				<label style="font-size: 8px;">Quantidade solicitada Maior que a Quantidade Restante</label>
			            			</div>
			            		</div>
			            		<div class="row">
			            			<div class="col-md-1" align="right" style="padding-top: 5px;">
			            				<div style="width: 10px!important; height: 10px!important; background-color: #F48024!important;"></div>
			            			</div>
			            			<div class="col-md-11" align="left" style="padding: 0;">
			            				<label style="font-size: 8px;">Quantidade Zerado</label>
			            			</div>
			            		</div>
			            		<div class="row">
			            			<div class="col-md-1" align="right" style="padding-top: 5px;">
			            				<div style="width: 10px!important; height: 10px!important; background-color: #9de1fe!important;"></div>
			            			</div>
			            			<div class="col-md-11" align="left" style="padding: 0;">
			            				<label style="font-size: 8px;">Quantidade solicitada Maior que a Disponivel no Estoque<br>
			            												A diferença que nao houver no  estoque será emcaminhado ao compras
			            				</label>
			            			</div>
			            		</div>
			            	</div>
			            	<div class="col-md-6">
		            			<a class="btn btn-success btn-sm" id="gera_solicitacao">Solicitar Insumos</a>
		            		    <button type="button" class="btn btn-defaut" data-dismiss="modal" >Fechar</button>
			            	</div>
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
			            						<th class="text-center" style="width: 30%;">Usuário</th>
			            						<th class="text-center" style="width: 20%;">Data</th>
			            						<th class="text-center" style="width: 20%;">Situação</th>
			            						<th class="text-center" style="width: 20%;">Ação</th>
			            						<th class="text-center" style="width: 20%;">Ver</th>
			            					</tr>
			            				</thead>
			            				<tbody id="tbody_solicitacao_feita">
			            					<tr class="hidden">
			            						<td style='text-align: center; padding: 5px;'>solicitacao</td>
			            						<td class="usuario" style='text-align: center;'>0</td>
			            						<td class="data_solicitacao" style='text-align: center;'>0</td>
			            						<td class="situacao" style='text-align: center; font-size: 14px; font-weight: bold; text-transform: uppercase;'>Situacao</td>
			            						<td class="acao" style='text-align: center;'></td>
			            						<td class="ver_solicitacao" style='text-align: center;'><a class="btn btn-info btn-sm" id="ver_solicitacao">Ver Solicitação</a></td>
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

			<div id="modal-insumos" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<input type="text" class="hidden" id="id_pai">
							<div class="row">
								<button type="button" class="close" id="close_cad_insumo" data-dismiss="modal">&times;</button>
								<h4 class="modal-title" style="text-align: center; text-transform: uppercase; font-weight: bold;">Adicionar Material</h4>
							</div>

							<div class="row">
								<form method="POST" id="form_principal" action="demo.html">
									<div class="col-md-5" style="">
										<label style="color: #000; text-transform: uppercase; padding-top: 8px;">Categoria</label>
										<select class="form-control"  id="select_categoria" >
											<option value="">Selecione</option>
											<?php 

											include "conexao.php";
											$query_categoria =  mysqli_query($db, "SELECT descricao FROM const_categoria WHERE `categoria_pai` = 0")or die(mysqli_error($db));
											while ($associa = mysqli_fetch_assoc($query_categoria)) {
												?>
												<option value="<?php echo ($associa['descricao'])?>"><?php echo ($associa['descricao'])?></option>
												<?php
											}
											?>
										</select>
									</div>
									<div class="col-md-5" style="">
										<label  style="color: #000 ; text-transform: uppercase; padding-top: 8px;">Espécie</label>
										<select class="form-control " id="select_especie" >
											<option value="" id="selecione">Selecione</option>
										</select>
										
									</div>
									<div class="col-md-2" style="padding-top: 4%;">
										<a href="#" class="btn btn-success btn-sm" id="atualizar" style=" ">Atualizar</a>
									</div>
								</form>
							</div>
							
							
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="form-group" align="center" style="padding: 5px;">
									<input class="form-control" id="input_add_insumo" type="text" placeholder="Pesquise Aqui ..." style="width: 95%;">
								</div>
							</div>
							<div id="table_insumos" class="table-editable pre-scrollable">
				      			<table class="table table-bordered table-responsive-md table-striped text-center">
				      				<colgroup>
				      					<col width="10%"></col>
				      					<col width="40%"></col>
				      					<col width="20%"></col>
				      					<col width="20%"></col>
				      					<col width="10%"></col>
				      				</colgroup>
				      				<thead class="thead-dark">
				      					<tr>
				      						<th class="text-center" style='text-align: center;'>Código</th>
				      						<th class="text-center" style='text-align: center;'>Descrição</th>
				      						<th class="text-center" id="adicionar" style='text-align: center;'>Adicionar</th>
				      					</tr>
				      				</thead>
				      				<tbody id="myTable">
				      					<tr class="hide">
				      						<td style='text-align: center;'>123</td>
				      						<td style='text-align: center;'>Nome do Insumo</td>
				      						<td style='text-align: center;'>
				      							<a class="btn btn-info btn-rounded btn-sm add_insumo_unico">Adicionar</button>
				      						</td>
				      					</tr>
				      				</tbody>
				      			</table>
				      		</div>
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

			<div id="modal-lista-oc" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
							<h4 style="text-align: center;">Lista de Ordem de compras</h4>
						</div>
						<div class="modal-body" align="center">

							<div id="table_oc" class="pre-scrollable">
		            			<table class="table table-bordered table-responsive-md text-center" id="table_oc">
		            				<thead class="thead-dark" id="table_oc">
		            					<tr>
		            						<th class="text-center" style="width: 10%;">Nº OC</th>
		            						<th class="text-center" style="width: 20%;">Fornecedor</th>
		            						<th class="text-center" style="width: 20%;">Data Entrega</th>
		            						<th class="text-center" style="width: 25%;">Visualizar</th>
		            						<th class="text-center" style="width: 25%;">Receber OC</th>
		            					</tr>
		            				</thead>
		            				<tbody id="table_oc">
		            					<tr class="hidden">
		            						<td class="oc" style='text-align: center;'>0</td>
		            						<td class="oc" style='text-align: center;'>0</td>
		            						<td class="oc" style='text-align: center;'>0</td>
		            						<td style='text-align: center; padding: 2px;'><a class="btn btn-sm btn-primary ver_oc">Ver OC</a></td>
		            						<td style='text-align: center; padding: 2px;'>
		            							<a class="btn btn-sm btn-success receber_oc" style="background: #eeae4a; border: none;">Receber OC</a>
		            							<a class="btn btn-sm btn-success hidden ver_recibo">Ver Recibo</a>
		            						</td>
		            					</tr>
		            				</tbody>
		            			</table>
		            		</div>

						</div>
						<div class="modal-footer">
						    <button type="button" class="btn btn-defaut" data-dismiss="modal" >Fechar</button>
						</div>
					</div>
				</div>
			</div>

			<!------ MODAL PARA RECEBER UMA ORDEM DE COMPRA  ------>
			<div id="receber_oc" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
							<h4 style="text-align: center;">Recebimento de Material</h4>
						</div>
						<div class="modal-body"  align="center">
							<a class="hidden" id="id-oc"></a>

							<div id="table_oc" class="pre-scrollable">
								<table class="table table-bordered table-responsive-md text-center" id="table_recebe_material">
									<thead class="thead-dark" id="thead_solicitacao_item">
										<tr>
											<th class="text-center" style="width: 20%;">#</th>
											<th class="text-center" style="width: 60%;">Descrição</th>
											<th class="text-center" style="width: 20%;">Quantidade</th>
										</tr>
									</thead>
									<tbody id="tbody_recebe_material">
										<tr class="hidden">
											<td class="" style='text-align: center;'><input type="checkbox" class="check_recebe_material" checked></td>
											<td style='text-align: center; padding: 2px;'>Descricao</td>
											<td class="qnt" style='text-align: center;' contenteditable="true"  onKeypress="if((event.keyCode < 48 && event.keyCode != 46) || event.keyCode > 57 ){return false;}">0</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<div style="padding: 15px;">
							<div class="form-group">
								<label for="select_documento">Selecione o tipo de Documento</label>
								<select class="form-control" id="select_documento">
									<option value="-1">Selecione</option>
									<option value="Nota Fiscal">Nota Fiscal</option>
									<option value="Cupom Fiscal">Cupom Fiscal</option>
									<option value="Recibo">Recibo</option>
								</select>
							</div>

							<div class="form-group">
								<label for="input_num_recebimento">Digite o Número do recibo</label>
								<input type="text" class="form-control" id="input_num_recebimento">
							</div>

							<div class="form-group">
								<form class="up_img" method="POST" enctype="multipart/form-data">
									<label>Selecione a Imagem</label>
									<input type="file" name="image" id="up_imagem_recibo" accept="image/jpeg">
									<input type="text" name="id_recebimento" class="hidden" id="id_recebimento">
								</form>
							</div>
						</div>
						
						<div class="modal-footer" >
						    <a class="btn btn-sm btn-success" id="confirma_recebe_def">Confirmar Recebimento</a>
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
			<script src="js/const_solicitacao.js"></script>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.30.2/skin-win7/ui.fancytree.min.css" />


			<!---- Botão ON/OF ---->
			<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
		</div>

		<script>
		    $(document).ready(function() {
		        App.init();
		        table('orcamentos/default.json');
		      	
		      	//Defino o tamanho da tabela de acordo com o tamanho da tela do usuario
		      	var aux = ($(window).height() - 200);
		      	$("div.table-wrapper-scroll-y").css('max-height', aux);


		      	if($(window).width() < 600){
		      		var viewFullScreen = $('body');

		      		viewFullScreen.click(function () {
		      		    var docElm = document.documentElement;
		      		    if (docElm.requestFullscreen) {
		      		        docElm.requestFullscreen();
		      		    }
		      		    else if (docElm.msRequestFullscreen) {
		      		        docElm = document.body; //overwrite the element (for IE)
		      		        docElm.msRequestFullscreen();
		      		    }
		      		    else if (docElm.mozRequestFullScreen) {
		      		        docElm.mozRequestFullScreen();
		      		    }
		      		    else if (docElm.webkitRequestFullScreen) {
		      		        docElm.webkitRequestFullScreen();
		      		    }
		      		});

		      		$('button[data-dismiss="alert"]').click();
		      	}
		      
		    });


	        
		</script>
		
	</body>
</html>
