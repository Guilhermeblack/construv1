<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php"; 

function converterdata($dateSql){
	$ano= substr($dateSql, 6);
	$mes= substr($dateSql, 3,-5);
	$dia= substr($dateSql, 0,-8);
	return $ano."-".$mes."-".$dia;
}

function forma_pagamento($id){
	include "conexao.php";
	$query_amigo = "SELECT * FROM forma_pagamento where idforma_pagamento = $id";
	$executa_query = mysqli_query ($db,$query_amigo);

	while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
	{
		$descricao           = $buscar_amigo["descricao"];
	}
	return $descricao;
}

function retorna_dados_cliente($id, $idvenda, $tipo_venda){





	if($tipo_venda == 2)
	{
		$inner = 'INNER JOIN venda ON venda.idvenda = parcelas.venda_idvenda
		INNER JOIN lote ON venda.lote_idlote = lote.idlote
		INNER JOIN produto ON venda.produto_idproduto = produto.idproduto
		INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
		INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';
		$tabela_inner = 'venda.cliente_idcliente';
		$juros_hr = '0200';

	}
	if($tipo_venda == 3)
	{
		$inner = 'INNER JOIN contrato_pagar ON contrato_pagar.idcontrato_pagar = parcelas.venda_idvenda

		INNER JOIN empreendimento ON contrato_pagar.empreendimento_id = empreendimento.idempreendimento 
		INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';
		$tabela_inner = 'contrato_pagar.fornecedor_idfornecedor';
		$juros_hr  = '0200';
	}
	if($tipo_venda == 1)
	{
		$inner = 'INNER JOIN locacao ON locacao.idlocacao = parcelas.venda_idvenda INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel';
		$tabela_inner = 'locacao.cliente_idcliente';
		$juros_hr = '1000';
	}
	if($tipo_venda == 4)
	{
		$inner = 'INNER JOIN contrato_receber ON contrato_receber.idcontrato_receber = parcelas.venda_idvenda

		INNER JOIN empreendimento ON contrato_receber.empreendimento_id = empreendimento.idempreendimento 
		INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';

		$tabela_inner = 'contrato_receber.cliente_idcliente';
		$juros_hr  = '0200';
	}

	$wes_hoje = date('dmy');
	include "conexao.php";
	$query_amigo323 = "SELECT * FROM parcelas ".$inner."  

	INNER JOIN cliente ON ".$tabela_inner." = cliente.idcliente
	WHERE idparcelas = $id";



	$executa_query323 = mysqli_query ($db,$query_amigo323) or die ("Erro ao listar dados cliente");


    while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se são amigos
    	$idcliente                  = $buscar_amigo323['idcliente'];
    	$nome_cli                   = $buscar_amigo323['nome_cli'];
    	$descricao_empreendimento   = $buscar_amigo323['descricao_empreendimento'];
    	$quadra                     = $buscar_amigo323['quadra'];
    	$lote                       = $buscar_amigo323['lote'];



    	if($tipo_venda == 1){
    		$endereco      = $buscar_amigo323['endereco'];
    		$numero        = $buscar_amigo323['numero'];
    		$cep           = $buscar_amigo323['cep'];
    	}
    }


    $dados['nome_cli']                 = $nome_cli;
    $dados['descricao_empreendimento'] = $descricao_empreendimento;
    $dados['quadra']                   = $quadra;
    $dados['lote']                     = $lote;
    $dados['idcliente']                = $idcliente;

    if($tipo_venda == 1){
    	$dados['endereco']                 = $endereco;
    	$dados['numero']                   = $numero;
    	$dados['cep']                      = $cep;
    }


    return $dados;
}
?>

    <!DOCTYPE html>
    <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
    <!--[if !IE]><!-->
    <html>
    <!--<![endif]-->

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

    	<link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    	<link href="https://immobilebusiness.com.br/admin/assets/css/multiple-select.css" rel="stylesheet"/>

    	<!-- ================== END BASE CSS STYLE ================== -->

    	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
    	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
    	<!-- ================== END PAGE LEVEL STYLE ================== -->

    	<!-- ================== BEGIN BASE JS ================== -->
    	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
    	<!-- ================== END BASE JS ================== -->
    </head>
    <body>


    	<!-- begin #page-loader -->
    	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
    	<!-- end #page-loader -->

    	<!-- begin #page-container -->
    	<div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed">
    		<!-- begin #header -->
    		<?php include "topo.php"; ?>

    		<!-- begin #content -->
    		<div id="content" class="content">
    			<!-- begin breadcrumb -->

    			<!-- end breadcrumb -->
    			<!-- begin page-header -->
    			<h1 class="page-header">Etiquetas</h1>
    			<!-- end page-header -->

    			<div class="row">
    				<div class="col-md-12">
    					<div class="panel panel-inverse">
    						<div class="panel-heading">
    							
    							<h4 class="panel-title">Informe o Período</h4>
    						</div>
    						<div class="panel-body">
    							<form class="form-vertical form-bordered" name="myForm" method="GET" action="contratolocacao/etiqueta2.php">
    								<div class="row">             
    									<div class="form-group">
    										<label class="col-md-2 control-label">Cliente</label>
    										<div class="col-md-4">
    											<div class="input-group">
    												<select class="default-select2 form-control" name="cliente_idcliente" required="">
    													<option value="Todos">Todos</option>
    													<?php

    													include "conexao.php";

    													$query_amigo = "SELECT * FROM cliente
    													INNER JOIN cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente
    													WHERE idtipo = 1 order by nome_cli Asc";

    													$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
										                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

										                	$idcliente             = $buscar_amigo['idcliente'];
										                	$nome_cli              = $buscar_amigo["nome_cli"];
										                	$cpf_cli               = $buscar_amigo["cpf_cli"];

										                	?>
										                	<option value="<?php echo "$idcliente" ?>"> <?php echo "$nome_cli "."CPF: "."$cpf_cli" ?> </option>
										                <?php } ?>
										            </select>
										        </div>
										    </div>
										</div>

										<div class="form-group">
											<label class="col-md-2 control-label">Empreendimento</label>
											<div class="col-md-4">
												<div class="input-group">
													<select class="default-select2 form-control" name="empreendimento_id" id="os" >
														<option value="Todos">Todos</option>
														<?php

														include "conexao.php";

														$query_amigo = "SELECT * FROM empreendimento_cadastro order by descricao_empreendimento Asc";

														$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
										                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

										                	$idempreendimento_cadastro             = $buscar_amigo['idempreendimento_cadastro'];
										                	$descricao_empreendimento              = $buscar_amigo["descricao_empreendimento"];



										                	?>
										                	<option value="<?php echo $idempreendimento_cadastro ?>"> <?php echo $descricao_empreendimento ?> </option>
										                <?php } ?>

										            </select>
										        </div>
										    </div>
										</div>
									</div>


									<!-- Inicio quadra / lote -->
									<div class="form-group">
										<label class="col-md-2 control-label">Quadra</label>
										<div class="col-md-4">
											<div>
												<select name="idquadra"  id="quadra" class="form-control">
												</select>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Lote</label>
										<div class="col-md-4">
											<div>
												<select name="idlote"  id="lote" class="form-control">
												</select>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group">
											<label class="col-md-2 control-label">Período</label>
											<div class="col-md-10">
												<div class="input-group">
													<input type="date" class="form-control" name="inicio" placeholder="Data Inicial" />
													<span class="input-group-addon">Até</span>
													<input type="date" class="form-control" name="fim" placeholder="Data Final"  />
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group">
											<label class="col-md-2 control-label">Tipo Periodo</label>
											<div class="col-md-4">
												<div class="input-group">
													<input type="radio" name="tipo_periodo" value="1" >Recebimento
													<input type="radio" name="tipo_periodo" value="2" >Vencimento
													<input type="radio" name="tipo_periodo" value="3" >Baixa
												</div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-2 control-label">Situação</label>
											<div class="col-md-4">
												<div class="input-group">
													<input type="radio" name="situacao" value="1" required="">A Vencer
													<input type="radio" name="situacao" value="2" required="">Pago
													<input type="radio" name="situacao" value="3" required="">Todos
												</div>
											</div>
										</div>
									</div>


									<div class="row">
										<div class="form-group col-md-4">
											<div class="input-group">
												<label class="control-label">Numero Lançamento</label>
												<input type="text" name="numero_lancamento" class="form-control">
											</div>
										</div>
										<div class="form-group col-md-4">
											<div class="input-group">
												<label class=" control-label">Numero Baixa</label>
												<input type="text" name="numero_baixa" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Empreendimento</label>
											<div class="col-md-4">
												<div class="input-group">
													<select class="default-select2 form-control" name="empreendimento_id" id="os" >
														<option value="Todos">Todos</option>
														<?php

														include "conexao.php";

														$query_amigo = "SELECT * FROM empreendimento_cadastro order by descricao_empreendimento Asc";

														$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
										                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

										                	$idempreendimento_cadastro             = $buscar_amigo['idempreendimento_cadastro'];
										                	$descricao_empreendimento              = $buscar_amigo["descricao_empreendimento"];



										                	?>
										                	<option value="<?php echo $idempreendimento_cadastro ?>"> <?php echo $descricao_empreendimento ?> </option>
										                <?php } ?>

										            </select>
										        </div>
										    </div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<input type="submit" class="btn btn-sm btn-success" value="Consultar" />
											<a href="#" class="btn btn-info btn-sm">Cadastrar Modelo de etiquetas</a>
										</div>
									</div>
								</form>
								
							</div>
						</div>
					</div>
				</div>


			<!-- end #content -->
			</div>

			<button href="#modal-dialog" data-toggle="modal" data-target="#modal-dialog" class="hidden" id="dialog"></button>
			<div id="modal-dialog" class="modal fade" role="dialog">
			    <div class="modal-dialog">
			        <div class="modal-content" >
			            <div class="modal-header" id="dialog-header">
			                <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
			                <h4 class="modal-title" align="center" id="salvar">Baixar Etiquetas!</h4>
			            </div>
			            <div class="modal-body" id="dialog-body" align="center">
			                <a href="https://etiquetas.ibsystem.com.br/etiqueta/etiquetas.pdf" class="btn btn-success">Baixar</a>
			            </div>
			            <div class="modal-footer" id="dialog-footer">
			                <button type="button" class="btn btn-defaut" data-dismiss="modal" >Fechar</button>
			            </div>
			        </div>
			    </div>
			</div>

			<!-- begin scroll to top btn -->
			<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
			
		<!-- end scroll to top btn -->
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
		<!-- ================== BEGIN PAGE LEVEL JS ================== -->
		<script src="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media//jquejsry.dataTables.js"></script>
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


		<script src="produtos_pagar.js"></script>
		<script src="lote_pagar.js"></script>

		<script>
			$(document).ready(function() {
				App.init();
				TableManageButtons.init();
				FormPlugins.init();

				<?php
					if(isset($_GET['confirma_etiqueta'])){
						?>	
							$('button#dialog').click();

						<?php
					}
				?>
			});
		</script>
	</body>
</html>
