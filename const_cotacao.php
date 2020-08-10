<?php 
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	set_time_limit(0);

	//include "protege_professor.php";
	ini_set("max_input_time", "-1");
	ini_set("max_input_vars", "10000");
	ini_set("upload_max_filesize", "10M");
	ini_set("max_execution_time", "-1");
	ini_set("memory_limit", "-1");
	ini_set("realpath_cache_size", "-1");
	if (!isset($_SESSION)) {
	  session_start();
	}
?>
<?php 
	
	if (!isset($_SESSION)) {
	  session_start();
	}

	function busca_nome_usuario($id){
		include 'conexao.php';

		$query = mysqli_query($db, "SELECT `nome_cli` FROM `cliente` WHERE `idcliente` = $id");

		if(mysqli_num_rows($query) > 0){
			$assoc = mysqli_fetch_assoc($query);

			return addslashes($assoc['nome_cli']);
		}else{
			return false;
		}
	}

	function consulta_categoria($categoria){
		include "conexao.php";

		$aux = mysqli_query($db, "SELECT descricao FROM const_categoria WHERE id = $categoria")or die(mysqli_error($db));
		if($aux != null){
			$aux = mysqli_fetch_assoc($aux);
			return $aux['descricao'];
		}
		return false;
	}

	function consulta_especie($especie){
		include "conexao.php";

		$aux = mysqli_query($db, "SELECT descricao FROM const_categoria WHERE id = $especie")or die(mysqli_error($db));
		if($aux != null){
			$aux = mysqli_fetch_assoc($aux);
			return $aux['descricao'];
		}
		return false;
	}


	class Upload {
        var $tipo;
        var $nome;
        var $tamanho;
         
        function Upload(){
        //Criando objeto
        }
         
        function UploadArquivo($arquivo, $pasta){ 
            if(isset($arquivo)){
                $nomeOriginal = $arquivo["name"]; 
                $tamanho = $arquivo["size"];
                 
                if (move_uploaded_file($arquivo["tmp_name"], $pasta . $nomeOriginal)){ 

                    $this->nome=$pasta . $nomeOriginal;
                    $this->tamanho=number_format($arquivo["size"]/1024, 2) . "KB";
                    return true; 
                }else{ 
                    return false;
                } 
            }
        } 
    }


    if(isset($_FILES["userfile"])){

		include "const_grava_tabela.php";


		//var_dump($_POST);
		//die();

		$cotacao = $_POST['cotacao'];
		$fornecedor = $_POST['fornecedor'];
		
		if($cotacao != '-1' && $fornecedor != '-1'){
			$upArquivo = new Upload;
			if($upArquivo->UploadArquivo($_FILES["userfile"], "planilhas/"))
			{   
			    $nome = $upArquivo->nome;
			    $tamanho = $upArquivo->tamanho;
			    $caminho = "planilhas/".$nome;
			    $resultado = grava_planilha_cotacao($nome, $cotacao, $fornecedor); // recebo os dados da gravação
			    $aux = 1;
			}else{
			    $aux = 5;
			}

			unlink($nome);
		}
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
		<link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/animate.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />
		<link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

		<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
		<style type="text/css" id="page_style">
			div#form{
				background: #eeeeee!important;
			}

			.pt-3-half {
				padding-top: 1.4rem;
			}

			#salva_categoria{
				margin-top: 15px;
				margin-right: 15px;
			}

			.bootstrap-select >.dropdown-toggle {
				color: #FFF!important;
			}

			a#remove-col > span{
				color: #ff5b57 !important;
				margin: 8px;
			}

			thead.thead-dark > tr > th.text-center{
				font-size: 11px !important;
				padding: 5px !important;
				font-weight: normal;
				color: #fff;
				background-color: #343a40;
				text-transform: uppercase;
			}

			thead.thead-dark{
				vertical-align: middle;
			}

			td[title]:not([id-fornecedor]):not(.melhor_compra){
				background-color: rgb(235, 235, 228)!important;
			}

			tbody > tr > td{
				vertical-align:middle!important;
				color: #000;
				border: 1px solid #343a40!important;
			}

			tr.naoOrcado > td {
				color: #cc0000!important;
				background-color: #ffc107!important;
				border: 1px solid #cc0000!important;
			}

			tr.total > td{
				padding: 5px !important;
				color: #fff;
				text-transform: uppercase;
				font-weight: 600;
				font-size: 16px;
				border: 1px solid #FFF!important;
			}

			tr.total > td:not(.menor_preco):not(.melhor_compra){
				background-color: #343a40!important;
			}

			tr.forma_pgt > td:first-child, tr.desconto > td:first-child{
				color: #000!important;
				text-transform: uppercase;
				font-weight: 600;
				font-size: 14px;
			}

			td.menor_preco{
				background-color: #97DB9B!important;
			}

			td.melhor_compra{
				background-color: #33b5e5!important;
			}

			li.lista_cotacao:hover{
				background-color: rgb(235, 235, 228)!important;
			}

			tr.oc > td{
				border: none!important;
			}

			tr.oc > td > a{
				background-color: #4CAF50!important;
				border: none!important;
			}

			td.estorou{
				color: #FFF!important;
				background-color: #ff3547!important;
				font-weight: bold;
			}

			td.zerado{
				background-color: #F48024!important;
			}

			/* PADDING 0 no body para evitar bug ao atualizar a tabela */
			body{
				padding: 0px!important;
			}

			td.desconto{
				background-color: #33b5e5!important;
				color: #fff;
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



			biri_and_biri{
			  color: red!important;
			  background-color: black!important;
			  word-wrap: break-word!important;
			  text-align: left!important;
			  white-space: pre-line!important;
			}
		</style>
		<!-- ================== END BASE JS ================== -->
	</head>
	<body style="padding-right: 0px!important;">
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
				<?php 
					if((!isset($resultado["error"])) && isset($resultado["ok"])){
						if(empty($resultado["ok"])){
							?>
							<div class="alert alert-warning" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<p class="font-weight-bold">Falha ao gravar o arquivo, Por favor verifique e tente novamente !</p></br>
							</div>
							<?php
						}
					}

					if(isset($resultado) && (count($resultado["ok"]) !== 0)){       ?>
						<div class="alert alert-success" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<strong><font>Sucesso!</font></strong>
							<font><?php  echo "Foram gravadas ".count($resultado["ok"])." Linhas !";  ?></font>
						</div>
						<?php
					}   
					?>

					<?php   
					if(isset($resultado["error"]) && $_GET["planilha"] == 1){
						?>
						<div class="alert alert-danger" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<font><?php echo "Falha ao gravar algumas linhas, por gentileza verifique e tente novamente!"; ?></font>
							<a href="planilhas/falhas.xlsx"><span class="label label-danger" style="font-size:100% !important">BAIXAR PLANILHA DE DADOS NÃO CADASTRADOS!</span></a>
						</div>
						<?php 
					}elseif (isset($resultado["error"]) && $_GET["planilha"] == 2) { ?>
						<div class="alert alert-danger" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<font><?php echo "Falha ao gravar algumas linhas, por gentileza verifique e tente novamente!"; ?></font>
							<a href="planilhas/falhas.xlsx"><span class="label label-danger" style="font-size:100% !important">BAIXAR PLANILHA DE DADOS NÃO CADASTRADOS!</span></a>
						</div>
					<?php }
				?>
				<div class="panel panel-inverse">	
					<div class="panel-heading">
						<div class="row">
							<div class="panel-title col-md-2">
								<h2 class="panel-title" style="font-size: 15px; text-transform: uppercase;">Tabela de Cotação</h2>
							</div>
							<div class="col-md-5">
								<input class="form-control" id="myInput" type="text" placeholder="Pesquise Aqui ...">
							</div>
							<div class="col-md-2">
								<div class="row">
									<div class="col-md-12" align="right">
										<button class="btn btn-success btn-sm" href='#modal_cotacao' data-toggle='modal' data-target='#modal_cotacao'>Solicitação/Cotação</button>
										<select class="form-control hidden" id="orcamento">
											<option value="-1" style="text-transform: uppercase;">Selecione</option>
											<?php
												$query = mysqli_query($db, "SELECT const_cotacao.id FROM `const_cotacao` ")or die(mysqli_error($db));

												if(mysqli_num_rows($query) > 0){
													while ($assoc = mysqli_fetch_assoc($query)) {
											?>
														<option value="<?php echo $assoc['id'];?>" style="text-transform: uppercase;"><?php echo $assoc['titulo'];?></option>
											<?php
													}
												}

											?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="row">
									<div class="col-md-6" align="right">
										<div class="dropdown">
											<button class="btn btn-success dropdown-toggle btn-sm" type="button" data-toggle="dropdown" id="planilhas"> <i class="glyphicon glyphicon-file" ></i> Documentos</button>
											<ul class="dropdown-menu">
												<li><a href="#" id="export_pdf" >Relatorio Cotação (PDF)</a></li>
												<li><a href="#" id="export_excel">Planilha Cotação (XLSX)</a></li>
												<li><a href="#up_planilha" data-toggle="modal" id="up_excel" data-target='#up_planilha'>Subir Cotação (XLSX)</a></li>
											</ul>
										</div>
									</div>
									<div class="col-md-6" align="center">
										<button href="#modal8" data-toggle="modal" type="button" class="btn btn-success btn-sm hidden" id="cad_orcamento" >
											<span class="glyphicon glyphicon-plus" style="font-size: 9px;"></span>
											Nova Cotação
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="panel-body " style="border-top: 0px; padding-top: 0px;">
						<div style="border-top: 0px; padding-top: 0px;">
							<div class="row alert" role="alert" id="alert" style="padding: 0px;">
								<div class="col-md-11" style="text-align: center;">
									<h3 class="card-header text-center font-weight-bold text-uppercase py-4" style="text-align: right;">Cotação de Materiais</h3>
								</div>
								<div class="col-md-1">
									<button type="button" class="close col-md-1" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</div>

							<div class="card-body" style="margin-top: 5px;">
								<div id="table" class="table-editable pre-scrollable">
									<table class="table table-bordered table-responsive-md text-center" id="table_principal">
										<thead class="thead-dark" id="thead_principal">
											<tr>
												<th class="text-center" style="width: 4%; font-weight: bold;"></th>
												<th class="text-center" style="width: 20%;">Descrição</th>
												<th class="text-center" style="width: 8%;">Qnt Orçado</th>
												<th class="text-center" style="width: 10%;">Valor Orçado</th>
												<th class="text-center" style="width: 8%;">Qnt Cotada</th>
											</tr>
										</thead>
										<tbody id="myTable">
											<tr class="hidden">
												<td style='text-align: center;'><input type="checkbox" class="form-check-input input_tr"></td>
												<td title="Tooltip on top" style='text-align: center; font-size: x-small; padding: 2px;'>Descricao</td>
												<td title="Tooltip on top" style='text-align: center;'>Qnt Orçado</td>
												<td title="Tooltip on top" style='text-align: center;'>Valor Orçado</td>
												<td class="quantidade_cotada" style='text-align: center;' contenteditable="true" onKeypress="if((event.keyCode < 48 && event.keyCode != 46) || event.keyCode > 57 ){return false;}">0</td>
											</tr>
											<tr class="total">
												<td colspan="4" style="text-align: center;">TOTAL : </td>
												<td style="text-align: center;" id='melhor_compra' title="MELHOR COMPRA"> </td>
											</tr>
											 <tr class="forma_pgt hi">
												<td colspan="5" style="text-align: center;">FORMA PAGAMENTO : 
													<select class="form-control hidden">
														<option value="-1">Selecione</option>
														<?php 
															include 'conexao.php';

															$query = mysqli_query($db, "SELECT `idforma_pagamento`, `descricao` FROM `forma_pagamento`")or die(mysqli_error($db));

															if(mysqli_num_rows($query) > 0){
																while ($assoc = mysqli_fetch_assoc($query)) {
																	?>
																		<option value="<?php echo $assoc['idforma_pagamento']; ?>"><?php echo $assoc['descricao']; ?></option>
																	<?php
																}
															}
														 ?>
													</select>
												</td>
											</tr> 
											<tr class="desconto">
												<td colspan="5" style="text-align: center;">DESCONTO : </td>
											</tr>
											<tr class="oc">
												<td colspan="4" style="text-align: center;"></td>
												<td style="text-align: center;" id-fornecedor="melhor_compra">
													 
													<a class="btn btn-success btn-sm gerar_oc">Gerar OC</a>

												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- Editable table -->
					</div>

					<div class="panel-footer">
						<div class="row">
							<div class="col-md-12" style="text-align: right;">
								
								<button type="button" class="btn btn-primary btn-sm" id="salva_cotacao" style="float: left; margin-left: 5px;"><i class="glyphicon glyphicon-floppy-disk" ></i> Salvar Cotação</button>

								<a class="btn btn-sm btn-danger hidden" id="finaliza_cotacao" style="float: left; margin-left: 5px;">Finalizar Cotação</a>

								<a href="#OC" data-toggle="modal" data-target="#OC" id="btn_oc" class="btn btn-info btn-sm" style="background-color: #ff3547!important; border:none!important;">Ordem de Compra</a>
								<a href="#modal4" data-toggle="modal" id="add_fornecedores" class="btn btn-info btn-sm">Adicionar Fornecedores</a>
								<a class="btn btn-sm btn-primary" id="add_material">Adicionar Materiais</a>

								<!---
									##############   INUTILIZADO   ################
								<a href="#modal5" data-toggle="modal" id="btn_add_especie" class="btn btn-info btn-sm">Adicionar Espécie de Material</a>
								<a href="#modal6" data-toggle="modal" id="add_all_especie" class="btn btn-info btn-sm">Adicionar Material</a>

								-->
							</div>
						</div>
					</div>
				</div>
			</div>

		
			<div id="modal4" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" id="close_cad_insumo" data-dismiss="modal">&times;</button>
							<h4 class="modal-title" style="text-align: center; text-transform: uppercase; font-weight: bold;">Adicionar Fornecedor</h4>
							<input class="form-control" id="input_fornecedor" type="text" placeholder="Pesquise Aqui ...">
						</div>
						<div class="modal-body pre-scrollable">
							<table class="table table-bordered table-responsive-md table-striped text-center">
								<thead class="thead-dark">
									<tr>
										<th class="text-center">CPF/CNPJ</th>
										<th class="text-center">NOME</th>
										<th class="text-center">Adicionar</th>
									</tr>
								</thead>
								<tbody id="table_fornecedor">
									
									<?php
										include "conexao.php";

										$query = mysqli_query($db, "SELECT * FROM cliente_tipo INNER JOIN cliente ON cliente_tipo.idcliente = cliente.idcliente
																	WHERE cliente_tipo.idtipo = 2 ")or die(mysqli_error($db));

										if(mysqli_num_rows($query) > 0){
											while ($assoc = mysqli_fetch_assoc($query)) {
												?>
												<tr align="center" id_cliente='<?php echo $assoc['idcliente'] ?>'>
													<td cpf="<?php echo $assoc['cpf_cli']; ?>" ><?php echo $assoc['cpf_cli']; ?></td>
													<td ><?php echo utf8_encode($assoc['nome_cli']); ?></td>
													<td ><a href="#" class="btn btn-success btn-sm add_fornecedor">Adicionar</a></td>
												</tr>
												<?php
											}
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div id="modal5" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<div class="row">
								<button type="button" class="close" id="close_cad_insumo" data-dismiss="modal">&times;</button>
								<h4 class="modal-title" style="text-align: center; text-transform: uppercase; font-weight: bold;">Adicionar Categoria/Espécie de Material</h4>
							</div>
							<div class="row">
								<div class="col-md-5">
									<div class="row">
										<div class="col-md-4">
											<label style="font-size: 10px; text-transform: uppercase;">Selecione Categoria</label>
										</div>
										<div class="col-md-8">
											<select class="form-control" id="categoria_select">
												<option id="-1" >Selecione</option>
												<?php
													include 'conexao.php';

													$query = mysqli_query($db, "SELECT * FROM `const_categoria` WHERE `categoria_pai` = 0")or die(mysqli_error($db));

													if(mysqli_num_rows($query) > 0){
														while ($assoc = mysqli_fetch_assoc($query)) {
															?>
																<option id="<?php echo $assoc['id']; ?>"><?php echo $assoc['descricao']; ?></option>
															<?php
														}
													}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4" >
									<input class="form-control" id="input_especie" type="text" placeholder="Pesquise Aqui ...">
								</div>
								<div class="col-md-3">
									<a href="#" class="btn btn-success btn-sm add_all_especie">Adicionar Todos</a>
								</div>
							</div>
						</div>
						<div class="modal-body pre-scrollable">
							<table class="table table-bordered table-responsive-md table-striped text-center">
								<thead class="thead-dark">
									<tr>
										<th class="text-center">Nome</th>
										<th class="text-center">Adicionar</th>
									</tr>
								</thead>
								<tbody id="table_especie">
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div id="modal6" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
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
									<div class="col-md-2" style="padding-top: 5%;">
										<div class="col-md-5" style="padding: 0px;">
											<a href="#" class="btn btn-success btn-sm" id="atualizar" style=" ">Atualizar</a>
										</div>
									</div>
								</form>
							</div>
							
						</div>
						<div class="modal-body pre-scrollable">
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
				      						<th class="text-center">Código</th>
				      						<th class="text-center">Descrição</th>
				      						<th class="text-center" id="adicionar">Adicionar</th>
				      					</tr>
				      				</thead>
				      				<tbody id="myTable">
				      					<tr class="hide">
				      						<td >123</td>
				      						<td >Nome do Insumo</td>
				      						<td>
				      							<button type="button" class="btn btn-info btn-rounded btn-sm add_insumo_unico">Adicionar</button>
				      						</td>
				      					</tr>
				      				</tbody>
				      			</table>
				      		</div>
						</div>
					</div>
				</div>
			</div>

			<div id="dialog-remove" class="modal fade" role="dialog">
			    <div class="modal-dialog">
			        <div class="modal-content" >
			            <div class="modal-header" >
			                <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
			            </div>
			            <div class="modal-body" align="center">
			                <h4 class="modal-title" align="center" id="salvar">Deseja realmente excluir essa coluna?</h4>
			            </div>
			            <div class="modal-footer" >
			            	<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="remove-col">Excluir</button>
			                <button type="button" class="btn btn-defaut btn-sm" data-dismiss="modal" >Cancelar</button>
			            </div>
			        </div>
			    </div>
			</div>

			<a class="hidden" href='#remove-tr' data-toggle='modal' data-target='#dialog-remove-tr'></a>
			<div id="dialog-remove-tr" class="modal fade" role="dialog">
			    <div class="modal-dialog">
			        <div class="modal-content" >
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
			            </div>
			            <div class="modal-body" align="center">
			                <h4 class="modal-title" align="center" id="salvar">Deseja realmente excluir essa Linha?</h4>
			            </div>
			            <div class="modal-footer">
			            	<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="remove-tr">Excluir</button>
			                <button type="button" class="btn btn-defaut btn-sm" data-dismiss="modal" >Cancelar</button>
			            </div>
			        </div>
			    </div>
			</div>

			<button href="#modal-dialog" data-toggle="modal" data-target="#modal-dialog" class="hidden" id="dialog">alo</button>
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

			<a href="#modal7" data-toggle="modal" data-target="#modal7" class="hidden" id="salvar"></a>
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

			<div id="modal8" class="modal fade" role="dialog">
			    <div class="modal-dialog">
			        <div class="modal-content" >
			            <div class="modal-header" >
			                <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
			                <h4 class="modal-title" style="text-align: center; text-transform: uppercase; font-weight: bold;">Adicionar Cotação</h4>
			            </div>
			            <div class="modal-body" align="center">
			            	<div class="row">
			            		<div class="col-md-4">
			            			<label style="text-align: center; text-transform: uppercase; font-weight: bold;">Selecione o Orçamento</label>
			            		</div>
			            		<div class="col-md-8">
			            			<select class="form-control" id="select_add_cotacao">
			            				<option id="-1">Selecione</option>
			            				<?php
			            					include 'conexao.php';

			            					$query = mysqli_query($db, "SELECT const_orcamento.titulo, const_orcamento.id FROM `const_orcamento` WHERE const_orcamento.status_editar = 0");

			            					if(mysqli_num_rows($query) > 0){
			            						while ($assoc = mysqli_fetch_assoc($query)) {
			            							?>
			            							<option id="<?php echo $assoc['id'] ?>"><?php echo $assoc['titulo']; ?></option>
			            							<?php
			            						}
			            					}
			            				?>
			            			</select>
			            		</div>
			            	</div>
			            	<div class="row">
			            		<div class="col-md-4">
			            			<label style="text-align: center; text-transform: uppercase; font-weight: bold;">Titulo da Cotação</label>
			            		</div>
			            		<div class="col-md-8">
			            			<input type="text" name="titulo_cotacao" class="form-control" required>
			            		</div>
			            	</div>
			            </div>
			            <div class="modal-footer">
			            	<button type="button" class="btn btn-success btn-sm" data-dismiss="modal" id="add_cotacao">Adicionar</button>
			                <button type="button" class="btn btn-defaut btn-sm" data-dismiss="modal" >Cancelar</button>
			            </div>
			        </div>
			    </div>
			</div>

			<div class="modal fade" id="up_planilha" role="dialog" style="display: none;">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			                <h4 class="modal-title" style="text-transform: uppercase; text-align: center; font-weight: bold;">Subir Planilha de Orçamento</h4>
			            </div>
			            <form class="form-action" action="const_cotacao.php" method="POST" enctype="multipart/form-data" name="envia_xlsx">
			            	<div class="modal-body">
			            		<div class="form-group">
			            			<label for="exampleFormControlFile1" style="text-transform: uppercase;"> Selecione seu arquivo .xlsx</label>
			            			<input type="hidden" name="MAX_FILE_SIZE" value="30000000" required="required">
			            			<input name="userfile" type="file" class="form-control-file" id="exampleFormControlFile1" required="required">
			            		</div>

			            		<div class="form-group">
			            			<label for="fornecedor_up_excel">SELECIONE UM FORNECEDOR</label>
			            			<select class="form-control" id="fornecedor_up_excel" name="fornecedor" required>
			            				<option value="-1" style="text-transform: uppercase;">SELECIONE </option>
			            			</select>
			            			<input  name="cotacao" class="hidden">
			            		</div>
			            	</div>
			                <div class="modal-footer">
			                    <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success"/>
			                </div>
			            </form>
			        </div>
			    </div>
			</div>

			<!--- MODAL PARA LISTAR AS SOLICITAÇÕES E AS COTAÇÕES  --->
			<div id="modal_cotacao" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" id="close_cad_insumo" data-dismiss="modal">&times;</button>
							<h4 style="text-align: center;">Solicitação / Cotação</h4>
						</div>
						<div class="modal-body pre-scrollable">
							<div role="tabpanel">
			                    <!-- Nav tabs -->
			                    <ul class="nav nav-tabs " role="tablist">
			                        <li role="presentation" class="active"><a href="#solicitacao_insumo" aria-controls="solicitacao_insumo" role="tab" data-toggle="tab" style="font-weight: bold;">Solicitações Insumos</a></li>
			                        <li role="presentation"><a href="#cotacao" aria-controls="cotacao" role="tab" data-toggle="tab" style="font-weight: bold;">Cotacao de Insumos</a></li>
			                    </ul>
			                    <!-- Tab panes -->
			                    <div class="tab-content">
			                        <div role="tabpanel" class="tab-pane active" id="solicitacao_insumo">
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
    				            						<th class="text-center" style="width: 15%;">Ação</th>
    				            						<th class="text-center" style="width: 15%;">Ver</th>
    				            						<th class="text-center" style="width: 15%;">Cotar</th>
    				            					</tr>
    				            				</thead>
    				            				<tbody id="tbody_solicitacao_feita">

    				            					<?php 

    				            						include 'conexao.php';

    				            						// aprovado = 1 -> aprovado 				id_oc // mesma coisa
    				            						// aprovado = 0 -> não aprovado				id_oc // mesma coisa
    				            						// aprovado = -1 -> pedente de aprovação	id_oc // mesma coisa

    				            						// id_destino para compras == 0

    				            						$query = mysqli_query($db, "SELECT CSM.id, CSM.id_orcamento, CSM.id_user, CSM.data FROM const_solicitacao_material AS CSM LEFT JOIN const_cotacao AS CC ON CSM.id = CC.id_solicitacao WHERE CSM.id_oc = -1 AND CSM.aprovado = 1 AND CSM.id_destino = 0 AND CC.id IS NULL ORDER BY id DESC")or die(mysqli_error($db));

    				            						if(mysqli_num_rows($query) > 0){

    				            							$dados = [];

    				            							while($assoc = mysqli_fetch_assoc($query)) {

    				            								$assoc['nome_usuario'] = busca_nome_usuario($assoc['id_user']); 

    				            					?>

    				            							<tr class="" id-solicitacao="<?php echo $assoc['id'] ?>">
    				            								<td style='text-align: center; padding: 5px;'><?php echo $assoc['id']; ?></td>
    				            								<td class="usuario" style='text-align: center;'><?php echo $assoc['nome_usuario']; ?></td>
    				            								<td class="data_solicitacao" style='text-align: center;'><?php echo $assoc['data']; ?></td>
    				            								<td class="acao" style='text-align: center;'><a class="btn btn-danger btn-sm" id="cancelar_solicitacao">Cancelar</a></td>
    				            								<td class="ver_solicitacao" style='text-align: center;'><a class="btn btn-info btn-sm" id="ver_solicitacao">Ver Solicitação</a></td>
    				            								<td class="aprovar_solicitacao" style='text-align: center;'><a class="btn btn-success btn-sm fazer_cotacao">Fazer Cotação</a></td>
    				            							</tr>
    				            					<?php
    				            							}
    				            						}

    				            					 ?>
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

			                        <div role="tabpanel" class="tab-pane" id="cotacao" >
			                        	<div class="form-group" align="center">
			                        		<input class="form-control" id="lista_entrada" type="text" placeholder="Pesquise Aqui ..." >
			                        	</div>
			                        	<div class="pre-scrollable">
			                        		<table class="table table-bordered table-responsive-md table-striped text-center" id="lista_cotacao">
			                        			<thead class="thead-dark">
			                        				<tr>
			                        					<th class="text-center">Nº Cotação</th>
			                        					<th class="text-center">DATA</th>
			                        					<th class="text-center">ABRIR</th>
			                        				</tr>
			                        			</thead>
			                        			<tbody id="lista_cotacao">

			                        				<?php 

														include 'conexao.php';
														
														//nao tem nada no banco por isso retorno null
														//para cotacao ja existente

			                        					$query = mysqli_query($db, 'SELECT * FROM `const_cotacao` WHERE status = -1 ');

			                        					if(mysqli_num_rows($query)){
			                        						while ($assoc = mysqli_fetch_assoc($query)) {
			                        				?>

				                        				<tr class="" id-cotacao="<?php echo $assoc['id'] ?>">
				                        					<td class="text-center"><?php echo $assoc['id'] ?></td>
				                        					<td class="text-center"><?php echo $assoc['data_cotacao'] ?></td>
				                        					<td class="text-center"><a class="btn btn-sm btn-info abrir_cotacao">ABRIR</a></td>
				                        				</tr>

			                        				<?php
			                        						}
			                        					}

			                        				 ?>
			                        				<tr class="hidden">
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
							<textarea name="message" rows="5" cols="60" id="motivo_cancela_solicitacao"></textarea>
						</div>
						<div class="modal-footer" >
						    <button type="button" class="btn btn-danger" id='cancela_solicitacao_def' >Cancelar Solicitacao</button>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Modal Ordem de Compra -->
			<div class="modal fade" id="OC" tabindex="-1" role="dialog" aria-hidden="true">
			    <div class="modal-dialog modal-lg">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                <h4 class="modal-title" id="OC" style="text-align: center; text-transform: uppercase; font-weight: bold;">Ordem de Compra</h4>
			            </div>
			            <div class="modal-body">
			                <div role="tabpanel">
			                    <!-- Nav tabs -->
			                    <ul class="nav nav-tabs nav_oc" role="tablist" >
			                        <li role="presentation" class="hidden"><a href="#emitir_oc" aria-controls="emitir_oc" role="tab" data-toggle="tab" style="font-weight: bold;">Emitir Ordem Compra</a></li>
			                        <li role="presentation"><a href="#lista_oc" aria-controls="lista_oc" role="tab" data-toggle="tab" style="font-weight: bold;">Lista de Ordem Compra</a></li>
			                    </ul>
			                    <!-- Tab panes -->
			                    <div class="tab-content div_oc">
			                        <div role="tabpanel" class="tab-pane hidden " id="emitir_oc">
			                        	<h3 style="text-transform: uppercase; font-size: 14px; font-weight: bold;" id="data_oc"></h3>
			                        	<div class="card-body">
			                        		<div id="table_oc" class="pre-scrollable">
			                        			<table class="table table-bordered table-responsive-md text-center" id="table_oc">
			                        				<thead class="thead-dark" id="thead_principal_oc">
			                        					<tr>
			                        						<th class="text-center" style="width: 25%;">Descrição</th>
			                        						<th class="text-center" style="width: 10%;">Qnt </th>
			                        						<th class="text-center" style="width: 10%;">Valor Total</th>
			                        					</tr>
			                        				</thead>
			                        				<tbody id="tbody_oc">
			                        					<tr class="hidden">
			                        						<td title="Tooltip on top" style='text-align: center; font-size: x-small; padding: 2px;'>Descricao</td>
			                        						<td class="quantidade_cotada" style='text-align: center;'>0</td>
			                        						<td class="valor_total" style='text-align: center;'>0</td>
			                        					</tr>
			                        				</tbody>
			                        			</table>
			                        		</div>
			                        	</div>
			                        	<div class="row" style="margin-top: 10px;">
			                        		<div class="col-md-2">
			                        			<h4 style="text-transform: uppercase; font-size: 12px; font-weight: bold; ">Data de Entrega</h4>
			                        		</div>
			                        		<div class="col-md-4">
			                        			<input type="date" id="input_data" class="form-control" name="data-entrega" placeholder="Data de Entrega" required="">
			                        		</div>
			                        	</div>
			                        	<div class="row">
			                        		<div class="col-md-2">
			                        			<h4 style="text-transform: uppercase; font-size: 12px; font-weight: bold; ">Local de Entrega</h4>
			                        		</div>
			                        		<div class="col-md-4">
			                        			<input type="text" id="input_local_entrega" class="form-control" name="local-entrega" placeholder="Local de Entrega" required="">
			                        		</div>
			                        		<div class="col-md-6" align="right">
			                        			<a href="#" class="btn btn-default btn-sm" id="cancela_oc">Cancelar</a>
			                        			<a href="#" class="btn btn-sm btn-success" id="gerar_oc">Gerar Ordem de Compra</a>
			                        		</div>
			                        	</div>
			                        </div>
			                        <div role="tabpanel" class="tab-pane" id="lista_oc" >
			                        	<input type="text" placeholder="Pesquise Aqui..." class="form-control" id="pesquisa_oc">
			                        	<div class="page-container pre-scrollable" >	
			                        		<table class="table table-bordered table-responsive-md table-striped text-center">
        										<thead class="thead-dark">
        											<tr>
        												<th class="text-center">Nº Ordem Compra</th>
        												<th class="text-center">Data Emissão</th>
        												<th class="text-center">Valor Total</th>
        												<th class="text-center">Fornecedor</th>
        												<th class="text-center">Imprimir</th>
        												<th class="text-center">Cancelar</th>
        											</tr>
        										</thead>
        										<tbody id="table_oc">
        											<tr align="center" class="hidden">
        												<td ></td>
        												<td ></td>
        												<td ></td>
        												<td ></td>
        												<td ><a href="#" class="btn btn-success btn-sm imprimir_oc">Imprimir</a></td>
        												<td ><a href="#" class="btn btn-danger btn-sm cancelar_oc">Cancelar</a></td>
        											</tr>
        										</tbody>
        									</table>
			                        	</div>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>

			<!--- Modal para cancelar a OC ---->
			<div id="cancela_oc" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
						</div>
						<div class="modal-body"  align="center">
							<h4 class="modal-title" align="center">Digite o Motivo do Cancelamento !</h4>
							<textarea name="message" rows="5" cols="60" id="motivo_cancela_oc"></textarea>
						</div>
						<div class="modal-footer" >
						    <button type="button" class="btn btn-danger" id='cancela_oc_def' >Cancelar OC</button>
						</div>
					</div>
				</div>
			</div>

			<div id="alert" class="hidden"></div>

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

			<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
			<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

			<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

			<!-- Latest compiled and minified JavaScript -->
			<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

			<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
			<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
			<!-- ================== END BASE JS ================== -->
			
			<!-- ================== BEGIN PAGE LEVEL JS ================== -->
			<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/ui-contextmenu/jquery.ui-contextmenu.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.30.2/jquery.fancytree-all-deps.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/js/bootstrap-editable.js"></script>
			<script type="text/javascript" src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.30.2/skin-win7/ui.fancytree.min.css" />
			<script src="js/const_cotacao_js.js"></script>
		</div>

		<script>
		    $(document).ready(function() {
		        App.init();

		        var aux = ($(window).height() - 200);
		        $("div#table").css('max-height', aux);

		        $('tr.total, tr.oc, tr.forma_pgt, tr.desconto').hide();
		        
		    });

		</script>

		
	</body>
</html>