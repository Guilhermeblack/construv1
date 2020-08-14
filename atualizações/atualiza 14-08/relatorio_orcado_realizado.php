<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
set_time_limit(0);

include "protege_professor.php";
include "conexao.php";

if (!isset($_SESSION)) {
	session_start();
}


?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v3.0/admin/html/table_manage_combine.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Mar 2018 17:24:02 GMT -->
<head>
	<meta charset="utf-8" />
	<title>Relatório Orcado X Realizado</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="https://immobilebusiness.com.br/admin//assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/animate.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/css/bootstrap-editable.css" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />

	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/css/bootstrap-editable.css" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>

	<style type="text/css">

	</style>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
		<!-- begin #header -->
		<?php include "topo.php";?>



		<div class="sidebar-bg"></div>
		<div id="content" class="content">
			<div class="panel panel-inverse">
				<div class="panel-heading" style="">
					<h3 class="panel-title">
						Relatório Orçado x Realizado
					</h3>
				</div>

				<div class="panel-body">
					<form class="form" action="relatorio_orcado_realizado.php" method="POST" name="orcado-realizado">
						<div class="row">
						<!--<div class="col-md-6 form-group">
								<label for="empreendimento">Selecione o Empreendimento</label>
								<select class="form-control" id="empreendimento" name="empreendimento">
									<option value="-1">TODOS</option>
									<?php 

									$query = mysqli_query($db, "SELECT * FROM `empreendimento_cadastro`")or die(mysqli_error($db));

									if(mysqli_num_rows($query)){
										while ($assoc = mysqli_fetch_assoc($query)) {
											?>
											<option value="<?php echo($assoc['idempreendimento_cadastro']) ?>"><?php echo($assoc['descricao_empreendimento']) ?></option>
											<?php
										}
									}
									?>
								</select>
							</div> -->
							<div class="form-group col-md-12">
								<label for="orcamento">Selecione o Orçamento</label>
								<select class="form-control" id="orcamento" name="orcamento">
									<option value="-1">TODOS</option>
									<?php 

									$query = mysqli_query($db, "SELECT * FROM `const_orcamento` WHERE `status_editar` = 0")or die(mysqli_error($db));

									if(mysqli_num_rows($query)){
										while ($assoc = mysqli_fetch_assoc($query)) {
											?>
											<option value="<?php echo($assoc['id']) ?>"><?php echo($assoc['titulo']) ?></option>
											<?php
										}
									}
									?>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 form-group">
								<label for="etapa">Etapa</label>
								<select id="etapa" class="form-control default-select2" name="etapa">
									<option value="-1">TODOS</option>
									<?php 

									$query = mysqli_query($db, "SELECT * FROM `const_planocontas`")or die(mysqli_error($db));

									if(mysqli_num_rows($query)){
										while ($assoc = mysqli_fetch_assoc($query)) {
											?>
											<option value="<?php echo($assoc['id']) ?>"><?php echo($assoc['descricao']) ?></option>
											<?php
										}
									}
									?>
								</select>
							</div>

							<div class="col-md-6 form-group">
								<label for="insumo">Insumo</label>
								<select id="insumo" class="form-control default-select2" name="insumo">
									<option value="-1">TODOS</option>
									<?php 

									$query = mysqli_query($db, "SELECT * FROM `const_insumos`")or die(mysqli_error($db));

									if(mysqli_num_rows($query)){
										while ($assoc = mysqli_fetch_assoc($query)) {
											?>
											<option value="<?php echo($assoc['id']) ?>"><?php echo($assoc['descricao']) ?></option>
											<?php
										}
									}
									?>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
							    <label class="control-label">Período</label>
							    <div class="input-group">
							        <input type="date" class="form-control" name="inicio" placeholder="Data Inicial" />
							        <span class="input-group-addon">Até</span>
							        <input type="date" class="form-control" name="fim" placeholder="Data Final"  />
							    </div>
							</div>

							<div class="form-group col-md-6">
								<label class="col-md-4" for="status">Selecione o Status</label>

								<div class="col-md-6">
								    <div class="input-group">
								        <input type="radio" name="tipo" value="1" required="">Análitico
								        <input type="radio" name="tipo" value="2" required="">Sintético
								    </div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<button type="submit" class="btn btn-success" style="float: right;">Enviar</button>
							</div>
						</div>
						
					</form>

					<?php 
						if(isset($_POST['orcamento'])){

							$_POST['orcamento'] == -1 ? $orcamento = '' : $orcamento = $_POST['orcamento'];
							$_POST['etapa'] == -1 ? $etapa = '' : $etapa = $_POST['etapa'];
							$_POST['insumo'] == -1 ? $insumo = '' : $insumo = $_POST['insumo'];
							$inicio = $_POST['inicio'];
							$fim = $_POST['fim'];
							$tipo = $_POST['tipo'];

							$where = "WHERE TORC.id > 0 ";
							$periodo = "";

							// var_dump($_POST);
							// die();

							if($orcamento != ''){
								$where .= "AND TORC.id_orcamento = $orcamento ";
							} 

							if($etapa != ''){
								$where .= "AND (TORC.id_insumo_plano = $etapa AND TORC.tabela = 1)";
							} 

							if($insumo != ''){
								$where .= "AND (TORC.id_insumo_plano = $insumo AND TORC.tabela = 2) ";
							} 

							if($inicio != '' AND $fim != ''){
								$periodo .=" AND STR_TO_DATE(COC.data, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";
							}

							$query_master = mysqli_query($db, "SELECT TORC.*, CPC.id AS id_CPC, CPC.descricao AS desc_CPC, CI.id AS id_CI, CI.descricao AS desc_CI, CO.titulo FROM tabela_orcamento AS TORC LEFT JOIN const_planocontas AS CPC ON (TORC.id_insumo_plano = CPC.id AND TORC.tabela = 1) LEFT JOIN const_insumos AS CI ON (TORC.id_insumo_plano = CI.id AND TORC.tabela = 2) INNER JOIN const_orcamento AS CO ON TORC.id_orcamento = CO.id ".$where." AND TORC.id_tarefa NOT LIKE '%.%'  GROUP BY TORC.id_insumo_plano ")or die(mysqli_error($db));

							if($_POST['tipo'] == 1){

								if(mysqli_num_rows($query_master)){

									$dados = [];

									while ($assoc = mysqli_fetch_assoc($query_master)) {

										//Consulto os insumos da etapa
										if(!empty($assoc['id_CPC'])){
										    
											$query_basico = mysqli_query($db, "SELECT TORC.*, CPC.id AS id_CPC, CPC.descricao AS desc_CPC, CI.id AS id_CI, CI.descricao AS desc_CI, CO.titulo FROM tabela_orcamento AS TORC LEFT JOIN const_planocontas AS CPC ON (TORC.id_insumo_plano = CPC.id AND TORC.tabela = 1) LEFT JOIN const_insumos AS CI ON (TORC.id_insumo_plano = CI.id AND TORC.tabela = 2) INNER JOIN const_orcamento AS CO ON TORC.id_orcamento = CO.id WHERE CAST(TORC.id_tarefa AS UNSIGNED) = CAST(".$assoc['id_tarefa']." AS UNSIGNED) AND TORC.id_orcamento = ".$assoc['id_orcamento']." GROUP BY TORC.id ORDER BY TORC.id ASC")or die(mysqli_error($db));

											if(mysqli_num_rows($query_basico)){
												while ($assoc_basico = mysqli_fetch_assoc($query_basico)) {

													$query_realizado = mysqli_query($db, "SELECT SUM(CIOC.qnt * CIOC.valor_unidade) AS total, CIOC.qnt FROM const_insumo_oc AS CIOC INNER JOIN const_ordem_compra AS COC ON CIOC.id_oc = COC.id INNER JOIN const_cotacao AS CC ON COC.id_cotacao = CC.id WHERE COC.status= 1 AND CC.id_orc = ".$assoc_basico['id_orcamento']." AND CIOC.id_insumo = ".$assoc_basico['id_insumo_plano']." ".$periodo." GROUP BY CIOC.id_insumo")or die(mysqli_error($db));

													if(mysqli_num_rows($query_realizado)){
														$assoc_realizado = mysqli_fetch_assoc($query_realizado);

														$assoc_realizado['total'] == '' ? $assoc_realizado['total'] = 0 : '';

														$assoc_basico['valor_realizado'] = $assoc_realizado['total'];

														$assoc_realizado['qnt'] == '' ? $assoc_realizado['qnt'] = 0 : '';

														$assoc_basico['qnt_realizado'] = $assoc_realizado['qnt'];
													}else{
														$assoc_basico['valor_realizado'] = '0';
														$assoc_basico['qnt_realizado'] = '0';
													}

													$dados[] = $assoc_basico;
												}
											}

										}elseif(!empty($insumo)){

											//Consulto o valor/quantidade ja gasta do insumo
											$query_realizado = mysqli_query($db, "SELECT SUM(CIOC.qnt * CIOC.valor_unidade) AS total FROM const_insumo_oc AS CIOC INNER JOIN const_ordem_compra AS COC ON CIOC.id_oc = COC.id INNER JOIN const_cotacao AS CC ON COC.id_cotacao = CC.id WHERE COC.status= 1 AND CC.id_orc = ".$assoc['id_orcamento']." AND CIOC.id_insumo = ".$assoc['id_insumo_plano']." ".$periodo." GROUP BY ")or die(mysqli_error($db));

											if(mysqli_num_rows($query_realizado)){
												$assoc_realizado = mysqli_fetch_assoc($query_realizado);

												$assoc_realizado['total'] == '' ? $assoc_realizado['total'] = 0 : '';

												$assoc['valor_realizado'] = $assoc_realizado['total'];

												$assoc_realizado['qnt'] == '' ? $assoc_realizado['qnt'] = 0 : '';

												$assoc_basico['qnt_realizado'] = $assoc_realizado['qnt'];
											}else{
												$assoc['valor_realizado'] = '0';
												$assoc_basico['qnt_realizado'] = '0';
											}

											$dados[] = $assoc;
										}
									}
								}

							}else if($_POST['tipo'] == 2){
								if(mysqli_num_rows($query_master)){

									$dados = [];

									while ($assoc = mysqli_fetch_assoc($query_master)) {

										if(!empty($assoc['id_CPC'])){
											$query_basico = mysqli_query($db, "SELECT TORC.*, CPC.id AS id_CPC, CPC.descricao AS desc_CPC, CI.id AS id_CI, CI.descricao AS desc_CI, CO.titulo FROM tabela_orcamento AS TORC LEFT JOIN const_planocontas AS CPC ON (TORC.id_insumo_plano = CPC.id AND TORC.tabela = 1) LEFT JOIN const_insumos AS CI ON (TORC.id_insumo_plano = CI.id AND TORC.tabela = 2) INNER JOIN const_orcamento AS CO ON TORC.id_orcamento = CO.id WHERE CAST(TORC.id_tarefa AS UNSIGNED) = CAST(".$assoc['id_tarefa']." AS UNSIGNED) AND TORC.id_orcamento = ".$assoc['id_orcamento'])or die(mysqli_error($db));

											if(mysqli_num_rows($query_basico)){

												$total_orcado = 0;
												$total_realizado = 0;
												$qnt_orcado = 0;
												$qnt_realizado = 0;

												while ($assoc_basico = mysqli_fetch_assoc($query_basico)) {

													$query_realizado = mysqli_query($db, "SELECT SUM(CIOC.qnt * CIOC.valor_unidade) AS total, CIOC.qnt FROM const_insumo_oc AS CIOC INNER JOIN const_ordem_compra AS COC ON CIOC.id_oc = COC.id INNER JOIN const_cotacao AS CC ON COC.id_cotacao = CC.id WHERE COC.status= 1 AND CC.id_orc = ".$assoc_basico['id_orcamento']." AND CIOC.id_insumo = ".$assoc_basico['id_insumo_plano']." ".$periodo)or die(mysqli_error($db));

													if(mysqli_num_rows($query_realizado)){
														$assoc_realizado = mysqli_fetch_assoc($query_realizado);

														$assoc_realizado['total'] == '' ? $assoc_realizado['total'] = 0 : '';
														$assoc_realizado['qnt'] == '' ? $assoc_realizado['qnt'] = 0 : '';


														$assoc_basico['quantidade'] == '' ? $assoc_basico['quantidade'] = '0' : '';

														$total_realizado += $assoc_realizado['total'];
														$qnt_realizado += $assoc_realizado['qnt'];
														$total_orcado += ($assoc_basico['valor_unitario'] * $assoc_basico['quantidade']);
														$qnt_orcado += $assoc_basico['quantidade'];

													}
												}


												$assoc['total'] = $total_orcado;
												$assoc['valor_realizado'] = $total_realizado;
												$assoc['quantidade'] = $qnt_orcado;
												$assoc['qnt_realizado'] = $qnt_realizado;


												$dados[] = $assoc;
											}

										}
									}
								}
							}
							?>	
							<div class="contanei-fluid" style="padding-top: 5%;">
								<table id="data-table" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th width="15%">Orçamento</th>
											<th width="20%">Insumo</th>
											<th width="15%">Tipo</th>
											<th width="5%">Qnt Orçado</th>
											<th width="15%">Valor Orçado</th>
											<th width="5%">Qnt Gasto</th>
											<th width="15%">Valor Gasto</th>
											<th style="width: 200px!important;">Proporção Orcado X Realizado</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$total_orcado = 0; 
											$total_realizado = 0; 

											foreach ($dados as $key => $value) {
												$insumo_plano = $value['desc_CPC'].$value['desc_CI'];

												if(!empty($value['desc_CI'])){
													$tipo = 'Insumo';
													$medida = $value['unidade'];
													$quantidade = $value['quantidade'];
												}else{
													$tipo = 'Etapa de Obra';
													$medida = "#";
													$quantidade = 0;
												}

												if($_POST['tipo'] == 2){

													$total_orcado += $value['total'];
													$total_realizado += $value['valor_realizado'];

													?>
													<tr>
														<td><?php echo $value['titulo']; ?></td>
														<td><?php echo $insumo_plano; ?></td>
														<td><?php echo 'Etapa'; ?></td>
														<td><?php echo '#'; ?></td>
														<td><?php echo 'R$ '.number_format($value['total'], 2, ',', '.'); ?></td>
														<td><?php echo '#'; ?></td>
														<td><?php echo 'R$ '.number_format($value['valor_realizado'], 2, ',', '.'); ?></td>
														<td><?php echo '#'; ?></td>
													</tr>
													<?php
												}else{

													$total_orcado += ($quantidade * $value['valor_unitario']);
													$total_realizado += $value['valor_realizado'];

													?>
													<tr>
														<td><?php echo $value['titulo']; ?></td>
														<td><?php echo $insumo_plano; ?></td>
														<td><?php echo $tipo; ?></td>
														<td><?php echo $quantidade; ?></td>
														<td><?php echo 'R$ '.number_format(($quantidade * $value['valor_unitario']), 2, ',', '.'); ?></td>
														<td><?php echo $value['qnt_realizado']; ?></td>
														<td><?php echo 'R$ '.number_format($value['valor_realizado'], 2, ',', '.'); ?></td>
														<td><?php echo 'R$ '.number_format(($value['valor_unitario'] * $value['qnt_realizado']), 2, ',', '.'); ?></td>
													</tr>
													<?php
												}
												
											}

											?>
											<tr>
												<td><?php echo $value['titulo']; ?></td>
												<td><?php echo '#'; ?></td>
												<td><?php echo '#'; ?></td>
												<td><?php echo '#'; ?></td>
												<td><?php echo 'R$ '.number_format($total_orcado, 2, ',', '.'); ?></td>
												<td><?php echo '#'; ?></td>
												<td><?php echo 'R$ '.number_format($total_realizado, 2, ',', '.'); ?></td>
												<td><?php echo '#'; ?></td>
											</tr>
											<?php
										?>
									</tbody>
								</table>
							</div>
								
							<?php
						}
					?>

				</div>
			</div>
		</div>

		<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>


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
    <script src="https://immobilebusiness.com.br/admin/assets/js/form-plugins.demo.min.js"></script>


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
				FormPlugins.init();
				TableManageButtons.init();
			});

		</script>
	</body>
	</html>
