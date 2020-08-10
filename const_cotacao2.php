
<?php 
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	set_time_limit(0);

	include "protege_professor.php";

	ini_set("upload_max_filesize", "10M");
	ini_set("max_execution_time", "-1");
	ini_set("memory_limit", "-1");
	ini_set("realpath_cache_size", "-1");
?>
<?php 

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

			td[title]{
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

			tr.total > td:not(.menor_preco){
				background-color: #343a40!important;
			}

			td.menor_preco{
				background-color: #97DB9B!important;
			}

			li.lista_cotacao:hover{
				background-color: rgb(235, 235, 228)!important;
			}
		</style>
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
								<h2 class="panel-title" style="font-size: 15px;">Tabela de Cotação</h2>
							</div>
							<div class="col-md-5">
								<input class="form-control" id="myInput" type="text" placeholder="Pesquise Aqui ...">
							</div>
							<div class="col-md-2">
								<div class="row">
									<div class="col-md-12" align="right">
										<button class="btn btn-success btn-sm" href='#modal_cotacao' data-toggle='modal' data-target='#modal_cotacao'>Selecionar Cotação</button>
										<select class="form-control hidden" id="orcamento">
											<option value="-1" style="text-transform: uppercase;">Selecione</option>
											<?php
												$query = mysqli_query($db, "SELECT const_cotacao.id, const_orcamento.titulo FROM `const_cotacao` INNER JOIN const_orcamento ON const_cotacao.id_orc = const_orcamento.id")or die(mysqli_error($db));

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
										<button href="#modal8" data-toggle="modal" type="button" class="btn btn-success btn-sm" id="cad_orcamento" >
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
					      						<th class="text-center" style="width: 20%;">Descrição</th>
					      						<th class="text-center" style="width: 10%;">Qnt Orçado</th>
					      						<th class="text-center" style="width: 10%;">Valor Orçado</th>
					      						<th class="text-center" style="width: 10%;">Qnt Cotada</th>
					      					</tr>
					      				</thead>
					      				<tbody id="myTable">
					      					<tr class="hidden">
					      						<td title="Tooltip on top" style='text-align: center; font-size: x-small; padding: 2px;'>Descricao</td>
					      						<td title="Tooltip on top" style='text-align: center;'>Qnt Orçado</td>
					      						<td title="Tooltip on top" style='text-align: center;'>Valor Orçado</td>
					      						<td class="quantidade_cotada" style='text-align: center;' contenteditable="true">0</td>
					      					</tr>
					      					<tr class="total">
					      						<td colspan="4">TOTAL : </td>
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

								<a href="#modal4" data-toggle="modal" id="add_fornecedores" class="btn btn-info btn-sm">Adicionar Fornecedores</a>
								<a href="#modal5" data-toggle="modal" id="btn_add_especie" class="btn btn-info btn-sm">Adicionar Espécie de Material</a>
								<a href="#modal6" data-toggle="modal" id="add_all_especie" class="btn btn-info btn-sm">Adicionar Material</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="modal_cotacao" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" id="close_cad_insumo" data-dismiss="modal">&times;</button>
							<h4 class="modal-title" style="text-align: center; text-transform: uppercase; font-weight: bold;">Cotação</h4>
							<div class="row">
								<div class="col-md-3">
									<label for="select_orcamento">SELECIONE O ORÇAMENTO: </label>
								</div>
								<div class="col-md-9">
									<select class="form-control" id="select_orcamento">
										<option value="-1" style="text-transform: uppercase;">Selecione</option>
										<?php
											$query = mysqli_query($db, "SELECT id, titulo FROM `const_orcamento` WHERE `status_editar` = 0")or die(mysqli_error($db));

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
						<div class="modal-body pre-scrollable">
							<ul class="list-group" id="list_cotacao">

							</ul>
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

			<a class="hidden" href='#dialog-remove-tr' data-toggle='modal' data-target='#dialog-remove-tr'></a>
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

			<div id="alert" class="hidden"></div>

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

		</div>

		<script>
		    $(document).ready(function() {
		        App.init();

		        var aux = ($(window).height() - 200);
		        $("div#table").css('max-height', aux);

		        var $orcamento = $('select#orcamento');
		        $('#table_principal > tbody#myTable').find('> tr.total').hide();


		        function encode_utf8(s) {
		          return unescape(encodeURIComponent(s));
		        }

		        function decode_utf8(s) {
		          return decodeURIComponent(escape(s));
		        }

		        function isEmpty(obj){
		        	return JSON.stringify(obj) === '{}';
		        }

		        function sleep(milliseconds) {
		          var start = new Date().getTime();
		          for (var i = 0; i < 1e7; i++) {
		            if ((new Date().getTime() - start) > milliseconds){
		              break;
		            }
		          }
		        }

	        	function DiaExtenso() {

	        		let meses = new Array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
	        		let semana = new Array("Domingo","Segunda-feira","Terça-feira","Quarta-feira","Quinta-feira","Sexta-feira","Sábado");
		        	let hoje = new Date();

		        	let dia = hoje.getDate();
		        	let dias = hoje.getDay();
		        	let mes = hoje.getMonth();
		        	let ano = hoje.getYear();

		        	if (navigator.appName == "Netscape"){
		        	  ano = ano + 1900;
		        	}

		        	let diaext = semana[dias] + ", " + dia + " de " + meses[mes] + " de " + ano;
		        	return diaext;
	        	}

		        function auto_complete(){
		        	var mySource = [];
		        	$("select#select_especie").children("option").map(function() {
		        		mySource.push($(this).text());
		        	});

		        	$("#input_especie").autocomplete({
		        		source: mySource,
		        		minLength: 0
		        	}).focus(function () {
		        		$(this).autocomplete('search', $(this).val())
		        	});
		        }	

		        //Calculo o Total de cada fornecedor e o melhor preço de cada um e de cada insumo separadamente
		        function calc_total(){

		        	$('#table_principal > tbody#myTable').find('> tr.total').show();

		        	let $body = $('#table_principal > tbody#myTable');
		        	var total = [];
		        	let valor;

		        	//menor armazena o id-fornecedor do menor valor
		        	let menor;
		        	let id_menor;

		        	$body.find('> tr:not(tr.hidden, tr.total)').each(function(i){

		        		menor = 0;
		        		id_menor = null;

		        		//Seto as opções no objeto total
		        		if(i == 0){
		        			$(this).find('> td').each(function(j){
		        				if(j > 3){
		        					total[j-4] = 0;
		        				}
		        			});
		        		}

		        		$(this).find('> td').each(function(j){
		        			if(j > 3){
		        				isNaN(parseFloat($(this).text().replace(/[R$. ]/g, '').replace(/,/g, '.'))) ? valor = 0 : valor = parseFloat($(this).text().replace(/[R$. ]/g, '').replace(/,/g, '.'));
		        				total[j-4] +=  valor;

		        				//console.log(valor);
		        				//console.log(total);
		        				if(menor == 0 && valor != 0){
		        					menor = valor;
		        					id_menor = $(this).attr('id-fornecedor');
		        				}else if(valor != 0 && valor < menor){
		        					menor = valor;
		        					id_menor = $(this).attr('id-fornecedor');
		        				}

		        				valor = null;
		        			}
		        		});

		        		//console.log(id_menor);
		        		//console.log(menor);

		        		if(menor != 0 && id_menor != null){
		        			$(this).find('> td').each(function(i){
		        				$(this).attr('id-fornecedor') == id_menor ? $(this).addClass('menor_preco') : $(this).removeClass('menor_preco');
		        			});
		        		}
		        	});

		        	//Calculo o menor valor geral
		        	menor = 0;
		        	id_menor = null;

		        	for(let i = 0; i < total.length; i++){
		        		if(menor == 0 && total[i] != 0){
		        			menor = total[i];
		        			id_menor = i;
		        		}else if(total[i] != 0 && total[i] < menor){
		        			menor = total[i];
		        			id_menor = i;
		        		}
		        	}

		        	//console.log(id_menor);
		        	//console.log(total.length);

		        	$body.find('> tr.total > td').each(function(i){
		        		if(i > 0){
		        			if(id_menor != null && (i-1) == id_menor){
		        				$(this).text(total[i-1].toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
		        				$(this).addClass('menor_preco');
		        			}else{
		        				$(this).text(total[i-1].toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
		        				$(this).removeClass('menor_preco');
		        			}
		        		}
		        	});
		        }

		        //Monto o ContextMenu para todas as linhas da tabela principal
		        $(document).contextmenu({
		        	delegate: "div#table tr",
		        	menu: [{
		        		title: "Excluir Linha",
		        		cmd: "delete_insumo",
		        		uiIcon: "ui-icon-pencil",
		        	}
		        	],
		        	select: function(event, ui) {
	        			//console.log(ui.target.parents('tr').attr('id-insumo'));

	        	    	let id_insumo = ui.target.parents('tr').attr('id-insumo');
	        	    	let cotacao = $('select#orcamento').find('option:selected').val();

	        	    	$('button#remove-tr').attr('id-insumo', id_insumo);
	        	    	$('button#remove-tr').attr('cotacao', cotacao);

	        	    	$("a[data-target='#dialog-remove-tr']").click();
	        	    }
	        	});
		        
		        // Input para busca da tabela principal
		        $("#myInput").on("keyup", function() {
		        	var value = $(this).val().toLowerCase();
		        	$("#myTable tr").filter(function() {
		        		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
		        	});
		        });

		        // Input para busca da modal de fornecedores
		        $("#input_fornecedor").on("keyup", function() {
		        	var value = $(this).val().toLowerCase();
		        	$("#table_fornecedor tr").filter(function() {
		        		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		        	});
		        });

		        // Input para busca da modal de Espécieis
		        $("#input_especie").on("keyup", function() {
		        	var value = $(this).val().toLowerCase();
		        	$("#table_especie tr").filter(function() {
		        		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		        	});
		        });

		        //Salva todos os itens da tabela de cotaca na tabela const_itens_cotacao e grava as colunas na tabela const_fornecedor_cotacao
		        $('button#salva_cotacao').click(function(){
		        	let cotacao = $orcamento.find('> option:selected').val();

		        	if(cotacao != -1){

		        		let dados = [];
		        		let dado = [];
		        		let colunas = [];

		        		$('table#table_principal').find('> tbody#myTable > tr:not(.hidden, .total)').each(function(i){
		        			let id_insumo = $(this).attr('id-insumo');
		        			let qnt = $(this).find('> td').eq(3).text();
		        			let status;

		        			$(this).hasClass('naoOrcado') ? status = 0 : status = 1;

		        			$(this).find('> td').each(function(j){
		        				if(j > 3){

		        					dado.push(qnt);
		        					dado.push($(this).text());
		        					dado.push($(this).attr('id-fornecedor'));
		        					dado.push(id_insumo);
		        					dado.push(cotacao);
		        					dado.push(status);

		        					dados.push(dado);
		        					dado = [];
		        				}
		        			});
		        		});

		        		$('thead#thead_principal').find('> tr > th').each(function(i){
		        			if(i > 3){
		        				colunas.push($(this).attr('id-fornecedor'));
		        			}
		        		});

		        		//console.log(dados);

		        		$.ajax({
		        			url:   'const_grava_cotacao.php',
		        			type:  'POST',
			           		data: {dados:dados, colunas:colunas}, //essa e o padrao x-www-form-urlencode
			           		dataType:'json',  

			           		error: function() {
			           			$("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Salvar a Tabela!!</h4>");
			           			$("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
			           		},
			           		success: function(data) { 
			           			$("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Salvo com Sucesso!</h4>");
			           			$("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
			           		},
			           		beforeSend: function() {
			           			$("div#dialog-body").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
			           			$("div#dialog-footer").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
			           			$("button#dialog").click();
			           		}
			           	});


		        	}else{
		        		alert("Preencha uma cotação!");
		        	}
		        });

		        // Adiciona uma coluna de Fornecedor contendo com atributo 'id' do fornedor
		        $('a.add_fornecedor').click(function(){
		        	let cont = 0;
		        	let orc = $orcamento.find('option:selected').val();

		        	$('#table_principal > thead#thead_principal').find('> tr > th').each(function(i){
		        		cont++;
		        	});

		        	if(cont > 8){
		        		alert("Numero Máximo de 5 Fornecedores! ");
		        	}else if(orc != -1){
		        		let cpf_cnpj = $(this).parents('tr').find('td').eq(0).text();
		        		let nome = $(this).parents('tr').find('td').eq(1).text();
		        		let id_fornecedor = $(this).parents('tr').attr('id_cliente');

		        		$(this).hide();

		        		$('#table_principal > thead#thead_principal').find('> tr').append("<th class='text-center' id-fornecedor='"+id_fornecedor+"'>"+nome+"<a  id='remove-col' href='#dialog-remove' data-toggle='modal' data-target='#dialog-remove'><span class='glyphicon glyphicon-remove'></span></th>");

		        		$("#table_principal > tbody#myTable").find('> tr:not(tr.total)').each(function(){
		        			$(this).append("<td id-fornecedor='"+id_fornecedor+"' contenteditable='true' style='text-align: center;'>R$ 0,00</td>");
		        			//$(this).find('> td:last-child').focus();
		        		});

		        		$("#table_principal > tbody#myTable").find('> tr.total').append("<td id-fornecedor='"+id_fornecedor+"' style='text-align: center;'>R$ 0,00</td>");
		        		/*
		        		$.ajax({  
		        			url:'const_grava_cotacao.php',  
		        			method:'POST', 
		        			data: {orc:orc,id_fornecedor:id_fornecedor },
		        			dataType:'json',  
		        			success: dados => 	
		        			{  
		        				console.log(1);
		        			},
		        			error: erro => {console.log(0)}  
		        		}); 
		        		*/
		        	}else{
		        		alert('Selecione um Orçamento!');
		        	}
		        });

		        //Atualizo a tabela de espécie de acordo com a categoria selecionada
		        $('select#categoria_select').change(function(){
		        	let categoria = $(this).find('option:selected').attr('id');

		        	$.ajax({
		        		url:   'const_grava_cotacao.php',
		        		type:  'POST',
					   //cache: false,
		           		data: {categoria:categoria}, //essa e o padrao x-www-form-urlencode
		           		dataType:'json',  

		           		beforeSend: function(){
		           			//$('button.close').click();

    	        			$("div#salvar").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
    	        			$("div#footer_salvar").html("<h4 class='modal-title' align='center' id='salvar' >Carregando, aguarde!</h4>");
    	        			$("a#salvar").click();
    	        		},
    	        		success: dados => 
    	        		{  	
    	        			$('button#close').click();
    	        			if(dados != '0'){

    	        				$('tbody#table_especie').empty();

    	        				for(var i in dados){
    	        					$('tbody#table_especie').append("<tr id='"+dados[i].id+"'><td class='text-center'>"+dados[i].descricao+"</td><td class='text-center'><a class='btn btn-success btn-sm' id='add_especie'>Adicionar</a></td></tr>");
    	        				}
    	        			}
    	        		},
    	        		error: erro => {console.log("alonso")},  
		           	});
		        });

		        //Adiciono Todas as epécies na tabela
		        $('a.add_all_especie').click(function(){
    	        	if($('select#orcamento option:selected').val() != -1){
    	        		let id_cot = $('select#orcamento > option:selected').val();
    	        		let id_cat = $('select#categoria_select > option:selected').attr('id');

    	        		//$(this).hide();

    	        		//console.log(id_cot);
    	        		//console.log(id_cat);

    	        		if(id_cat != -1){
			        		$.ajax({
			        			url:   'const_grava_cotacao.php',
			        			type:  'POST',
							   //cache: false,
							   //data:  { ok : 'deu certo!'},
				           		data: {id_cot:id_cot, id_cat:id_cat}, //essa e o padrao x-www-form-urlencode
				           		dataType:'json',  

				           		beforeSend: function() {
				           			$('button.close').click();

				           			$("div#modal-dialog > div > div > div#dialog-body").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
				           			$("div#modal-dialog > div > div > div#dialog-footer").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
				           			$("button#dialog").click();
				           		},
				           		success: function(data) { 
							   		//console.log(data);
							   		if(data != 0){
							   			//Realocando a 'tr' TOTAL
							   			let total = $('#table_principal > tbody#myTable').find('> tr.total').clone(true);
							   			$('#table_principal > tbody#myTable').find('> tr.total').detach();

							   			for(let i = 0; i < data.length; i++){

							   				//Verifico se o insumo ja existe na tabela, se nao existir eu o crio
							   				if(!$("tr[id-insumo='"+data[i].id+"']").length){
								   				let aux = $('#table_principal > tbody#myTable').find('> tr.hidden').clone();

								   				$('#table_principal > tbody#myTable').append(aux);

								   				$('#table_principal > tbody#myTable').find("> tr:last-child").removeClass('hidden')
	        				   					.addClass('align-center').attr('id_especie', data[i].id_especie).attr('id-insumo', data[i].id);


								   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(0).text(data[i].descricao).attr('title', 'CÓDIGO: '+data[i].codigo);
								   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(1).text(data[i].quantidade == '' ? 0 : data[i].quantidade).attr('title', 'UNIDADE MEDIDA: '+data[i].unidade);
								   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(2).text((data[i].quantidade * data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})).attr('title', 'VALOR UNIDADE: '+parseFloat(data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));

								   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(3).text(data[i].quantidade == '' ? 0 : data[i].quantidade); 

								   				$('#table_principal > tbody#myTable').find("> tr:last-child > td[contenteditable='true']:not(td.quantidade_cotada)").each(function(){
								   					$(this).text('R$ 0,00');
								   				});
							   				}
							   			}

							   			$('#table_principal > tbody#myTable').append(total);
							   		}

							   		$('button.close').click();
							   	},
							   	error: function() {
							   		$('button.close').click();
							   		console.log(0);
							   	}
							});
    	        		}else{
    	        			alert("Selecione uma Categoria !");
    	        		}
    	        	}else{
    	        		alert("Selecione um Orçamento !");
    	        	}
		        });

		        //Atualizo a tabela de acordo com o orçamento selecionado
		        $('select#orcamento').change(function(){

		        	//Habilito todos os botoes da tabela de fornecedores
		        	$('a.add_fornecedor').each(function(i){
		        		$(this).show();
		        	});

		        	//Limpo o Cabeçalho da tabela - todas as colunas de Fronecedores
		        	$('#table_principal > thead#thead_principal').find("> tr > th").each(function(i){
		        		if(i > 3){
		        			$(this).detach();
		        		}
		        	});

		        	//Limpo as colunas de fornecedores da linha .hidden 
		        	$('#table_principal > tbody#myTable').find("> tr.hidden > td").each(function(i){
		        		if(i > 3){
		        			$(this).detach();
		        		}
		        	});

		        	//Limpo as colunas de fornecedores da linha .total 
		        	$('#table_principal > tbody#myTable').find("> tr.total > td").each(function(i){
		        		if(i > 0){
		        			$(this).detach();
		        		}
		        	});

		        	let total = $('#table_principal > tbody#myTable').find('> tr.total').clone(true);

		        	//Limpo todas as linhas do tbody menos a linha .hidden
		        	$('#table_principal > tbody#myTable').find("> tr:not(tr.hidden)").each(function(){
		        		$(this).detach();
		        	});

		        	//Habilito os botoes das espécies
		        	$('tbody#table_especie > tr > td:last-child').find('a').each(function(){
		        		$(this).show();
		        	});

		        	$('a.add_all_especie').show();

		        	let att_cotacao = $orcamento.find('> option:selected').val();

		        	if(att_cotacao != -1){

		        		//desconsidera
		        		id_cotacao = att_cotacao;
		        		//Ajax para atualizar o select de upload de planilhas da pagina
		        		$.ajax({  
		        			url:'const_grava_cotacao.php',  
		        			method:'POST', 
		        			data: {id_cotacao:id_cotacao},
		        			dataType:'json',  
		        			success: dados => 	
		        			{  	
		        				$('select#fornecedor_up_excel > option:not(option[value="-1"])').detach();
		        				if(dados != '0'){
		        					for(let i = 0; i < dados.length; i++){
		        						$('select#fornecedor_up_excel').append('<option value="'+dados[i].id+'" style="text-transform: uppercase;">'+dados[i].nome+'</option>');
		        					}
		        				}

		        				$('input[name="cotacao"]').val(id_cotacao);
		        			},
		        			error: erro => {console.log(0)}  
		        		}); 


		        		//Ajax para obter os dados da planilha
	        			$.ajax({
	        				url:   'const_grava_cotacao.php',
	        				type:  'POST',
	        		   		data: {att_cotacao:att_cotacao}, //essa e o padrao x-www-form-urlencode
	        		   		dataType:'json',  

	        		   		error: function(data) {
	        		   			//console.log(data);
	        		   			$("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Salvar a Tabela!!</h4>");
	        		   			$("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
	        		   		},
	        		   		success: function(data) { 
	        		   			$("button.close").click();

	        		   			if(data != 0){
	        		   				//console.log(data[0].table_header[2]);
	        		   				//For para inserir os th no cabeçalho da tabela 
	        		   				for(let i = 0; i < data[0].table_header.length; i++){
	        		   					$('#table_principal > thead#thead_principal').find('> tr').append("<th class='text-center' id-fornecedor='"+data[0].table_header[i].id_fornecedor+"'>"+data[0].table_header[i].nome_fornecedor+"<a  id='remove-col' href='#dialog-remove' data-toggle='modal' data-target='#dialog-remove'><span class='glyphicon glyphicon-remove'></span></th>");

	        		   					$("#table_principal > tbody#myTable").find('> tr.hidden').append("<td id-fornecedor='"+data[0].table_header[i].id_fornecedor+"' contenteditable='true' style='text-align: center;'>R$ 0,00</td>");

	        		   					$("#table_principal > tbody#myTable").find('> tr.total').append("<td id-fornecedor='"+data[0].table_header[i].id_fornecedor+"' style='text-align: center;'>R$ 0,00</td>");

	        		   					//Desabilito o botao de adicionar o fornecedor de acordo com os fornecedores da tabela
	        		   					$('tbody#table_fornecedor').find('> tr[id_cliente="'+data[0].table_header[i].id_fornecedor+'"] > td:last-child > a').hide();
	        		   				}
	        		   				

	        		   				//$(this).find('> td:last-child').focus();
	        		   				//Faz para inserir os td na tbody
	        		   				for(let i = 1; i < data.length; i++){
	        		   					//console.log(data[i]);

	        		   					let insumo = data[i].id_insumo;
	        		   					let fornecedor = data[i].id_fornecedor;
	        		   					
	        		   					let tr = "tr[id-insumo='"+insumo+"']";
	        		   					let td = "> td[id-fornecedor='"+fornecedor+"']";

	        		   					if($(tr).find(td).length){
	        		   						$(tr).find(td).text(parseFloat(data[i].valor).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
	        		   					}else{
	        		   						let status ; 

	        		   						data[i].status == 1 ? status = '' : status = 'naoOrcado';

	        		   						if(data[i].status == 1){
		        		   						let aux = $('#table_principal > tbody#myTable').find('> tr.hidden').clone();
			        		   					$('#table_principal > tbody#myTable').append(aux);

			        		   					$('#table_principal > tbody#myTable').find("> tr:last-child").removeClass('hidden')
			        		   					.addClass('align-center').attr('id-insumo', data[i].id_insumo);

			        		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(0).text(decode_utf8(data[i].descricao)).attr('title', 'CÓDIGO: '+data[i].codigo);

			        		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(1).text(data[i].qnt_orcado == '' ? 0 : data[i].qnt_orcado).attr('title', 'UNIDADE MEDIDA: '+data[i].unidade);

			        		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(2).text((data[i].qnt_orcado * data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})).attr('title', 'VALOR UNIDADE: '+parseFloat(data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));

			        		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(3).text(data[i].qnt_cotado);

			        		   					//Coloco o Valor cotado na nova linha criada
			        		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td[id-fornecedor='"+fornecedor+"']").text(parseFloat(data[i].valor).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
	        		   						}else{
		        		   						let aux = $('#table_principal > tbody#myTable').find('> tr.hidden').clone();
			        		   					$('#table_principal > tbody#myTable').append(aux);

			        		   					$('#table_principal > tbody#myTable').find("> tr:last-child").removeClass('hidden')
			        		   					.addClass('align-center').addClass('naoOrcado').attr('id-insumo', data[i].id_insumo).attr('title', 'Item nao Orçado');

			        		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(0).text(decode_utf8(data[i].descricao)).attr('title', 'CÓDIGO: '+data[i].codigo);

			        		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(1).text(data[i].qnt_orcado == '' ? 0 : data[i].qnt_orcado).attr('title', 'Item nao Orçado');

			        		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(2).text((data[i].qnt_orcado * data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})).attr('title', 'Item nao Orçado');

			        		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(3).text(data[i].qnt_cotado);

			        		   					//Coloco o Valor cotado na nova linha criada
			        		   					$('#table_principal > tbody#myTable').find("> tr:last-child > td[id-fornecedor='"+fornecedor+"']").text(parseFloat(data[i].valor).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
	        		   						}
	        		   					}
	        		   				}
	        		   			}

	        		   			//console.log(data);

	        		   			$('#table_principal > tbody#myTable').append(total);
	        		   			for(let i = 0; i < data[0].table_header.length; i++){
	        		   				$("#table_principal > tbody#myTable").find('> tr.total').append("<td id-fornecedor='"+data[0].table_header[i].id_fornecedor+"' style='text-align: center;'>R$ 0,00</td>");
	        		   			}
	        		   			
	        		   			calc_total();
	        		   			//console.log('aqui');
	        		   		},
	        		   		beforeSend: function() {
	        		   			$("div#dialog-body").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
	        		   			$("div#dialog-footer").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
	        		   			$("button#dialog").click();
	        		   		}
	        		   	});
		        	}else{
		        		$('select#fornecedor_up_excel > option:not(option[value="-1"])').detach();
		        		$('#table_principal > tbody#myTable').append(total);
		        		$('#table_principal > tbody#myTable').find('> tr.total').hide();
		        	}
		        });

		        //Exporto a tabela para PDF
		        $('a#export_pdf').click(function(){

		        	//var pdf = "<style type='text/css'>"+$('style#page_style').html()+"</style>";
		        	var pdf = $('div#table').clone(true);
		        	var cabecalho = $('div#alert').clone(true);
		        	var tr_hidden = $('table#table_principal > tbody > tr.hidden').clone(true);
		        	var total;

		        	//console.log(cabecalho.html());

		        	cabecalho.html("<h2 style='font-size: 16px; text-align: center; text-transform:uppercase; font-weight:bold'>Relátorio de Cotação</h2>");

		        	cabecalho.append("<p style='font-size: 14px; text-align: left; text-transform:uppercase; font-weight:bold'>Cotação Referente ao Orçamento: "+$('select#orcamento > option:selected').text()+"</p>");

		        	cabecalho.append("<p style='font-size: 12px; text-align: left; text-transform:uppercase; '>"+DiaExtenso()+"</p>");
		        	
		        	cabecalho.css({
		        		'margin' : '15px',
		        	});

		        	pdf.find('table#table_principal > thead > tr > th').each(function(i){
		        		$(this).css({
		        			'vertical-align' : 'center',
		        			'font-size' : '13px',
		        			'padding' : '5px',
		        			'font-weight': 'bold',
		        			'color' : '#fff',
		        			'background-color' : '#343a40',
		        			'text-transform' : 'uppercase',
		        		});
		        	});

		        	pdf.find('table#table_principal > tbody > tr').each(function(i){

		        		$(this).find('> td').each(function(j){
		        			if($(this).hasClass('menor_preco')){
		        				$(this).css('background-color', '#97DB9B!important');
		        				$(this).css('border', 'solid 1px #FFF');
		        			}
		        		});

		        		if($(this).hasClass('hidden')){
		        			$(this).detach();
		        		}else if($(this).hasClass('naoOrcado')){
		        			$(this).css({
		        				'border' : 'solid 1px #cc0000',
		        				'background-color' : '#ffc107',
		        			});
		        		}else if(i % 2 == 0){

		        			$(this).css({
		        				'border' : 'solid 1px #000',
		        				'background-color' : '#ccc',
		        			});
		        		}
		        	});

		        	pdf = (cabecalho.html() + pdf.html());
		        	//console.log(pdf);

		        	$.ajax({
		        		url:   'const_grava_cotacao.php',
		        		type:  'POST',
					   //cache: false,
					   //data:  { ok : 'deu certo!'},
		           		data: {pdf:pdf}, //essa e o padrao x-www-form-urlencode
		           		//dataType:'json',  

		           		beforeSend: function(){
    	        			$("div#salvar").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
    	        			$("div#footer_salvar").html("<h4 class='modal-title' align='center' id='salvar' >Carregando, aguarde!</h4>");
    	        			$("a#salvar").click();
    	        		},
    	        		success: dados => 
    	        		{  	
    	        			$("div#salvar").html("<a href='pdf/filename.pdf' class='btn btn-success' target='_blank' style='text-align: center;'>Abrir PDF</a>");
    	        			$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
    	        		},
    	        		error: erro => {console.log("alonso")},  
		           	});
		        });

		        //Exporto os dados para o excel
		        $('a#export_excel').click(function(){

		        	let excel = [];
		        	let dado = [];

		        	$('table#table_principal').find('> tbody > tr:not(tr.hidden, tr.total, tr.naoOrcado)').each(function(i){
		        		dado.push($(this).find('> td').eq(0).text());
		        		dado.push($(this).find('> td').eq(3).text());

		        		excel.push(dado);

		        		dado = [];
		        	});

		        	//console.log(excel);

		        	$.ajax({
		        		url:   'const_grava_cotacao.php',
		        		type:  'POST',
					   //cache: false,
					   //data:  { ok : 'deu certo!'},
		           		data: {excel:excel}, //essa e o padrao x-www-form-urlencode
		           		//dataType:'json',  

		           		beforeSend: function(){
    	        			$("div#salvar").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
    	        			$("div#footer_salvar").html("<h4 class='modal-title' align='center' id='salvar' >Carregando, aguarde!</h4>");
    	        			$("a#salvar").click();
    	        		},
    	        		success: dados => 
    	        		{  	
    	        			$("div#salvar").html("<a href='pdf/cotacao.xlsx' class='btn btn-success' style='text-align: center;'>Baixar EXCEL</a>");
    	        			$("div#footer_salvar").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
    	        		},
    	        		error: erro => {console.log("alonso")},  
		           	});
		        });

    	        //Atualiza os campos do select de acordo com a categoria selecionada
    	        $("select#select_categoria").change(function(data){

    	        	//Pego o elemento selecionado
    	        	var aux = {opcao_select : $(this).find('option:selected').val()};

    	        	$.ajax({  
    	        		url:'const_grava_insumo.php',  
    	        		method:'POST', 
    	        		data: aux,
    	        		dataType:'json',  
    	        		success: dados => 	
    	        		{  
    	        			if(dados != 1){
    	        				//limpo todas as opções
            					var selecione = $("select#select_especie").find('> option#selecione').clone(true);
            					$("select#select_especie").empty();
            					$("select#select_especie").append(selecione);

    	        				for(var i = 0; i < dados.length; i++){
    	        					//insiro as opções que peguei no banco
    	        					$("select#select_especie").append('<option value="'+dados[i]+'">'+dados[i]+'</option>');
    	        				}
    	        			}else{
    	        				var selecione = $("select#select_especie").find('> option#selecione').clone(true);
            					$("select#select_especie").empty();
            					$("select#select_especie").append(selecione);
    	        			}
    	        		},
    	        		error: erro => {console.log(1)}  
    	        	});  
    	        });

    	        //Atualiza toda a tabela de insumos de acordo com as opções selecionadas
    	        $("a#atualizar").click(function(){

    	        	var $TABLE = $('#table_insumos > table');
    	        	var $FORM_PRINCI = $('#form_principal');

    	        	var $clone = $TABLE.find('> tbody > tr.hide').clone(true);
    	        	$TABLE.find('> tbody').empty();
    	        	$TABLE.find('> tbody').append($clone);
    	        	
    	        	var aux = {};

    	        	aux['categoria'] = $FORM_PRINCI.find('select#select_categoria > option:selected').val();
    	        	aux['especie'] = $FORM_PRINCI.find('select#select_especie > option:selected').val();

    	        	$.ajax({  
    	        		url:'const_grava_insumo.php',  
    	        		method:'POST', 
    	        		data: aux,
    	        		dataType:'json', 
    	        		beforeSend: function(){
    	        			$("div#salvar").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
    	        			$("div#footer_salvar").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
    	        			$("a#salvar").click();
    	        		},
    	        		success: dados => 
    	        		{  	
    	        			//console.log(dados);
    	        			$("button#close").click();

    	        			if(!isEmpty(dados)){

    	        				for(var data in dados ){

    	        					var $clone = $TABLE.find('> tbody > tr.hide').clone(true).removeClass('hide table-line').attr('id-insumo-solo', dados[data].id);
    	        					$TABLE.find('> tbody').append($clone);

    	        					$TABLE.find('> tbody > tr:last-child > td').each(function(i){
    	        						if(i == 0){
    	        							$(this).text(dados[data].codigo);

    	        						}else if(i == 1){
    	        							$(this).text(dados[data].desc);
    	        						}
    	        					});
    	        				}
    	        			}else{
    	        				$TABLE.find('> tbody').empty();
    	        				if ($('> tbody').is(':empty')){

    	        				 	$('> tbody').html("<tr colspan='4' align='center'><td>Sem conteudo !</td></tr>");
    	        				}
    	        			}
    	        		},
    	        		error: erro => {
    	        			$("button#close").click();
    	        			console.log("Erro")
    	        		},  
    	        	});
    	        });	

    	        //Adiciono um nova Cotacao e faz a inserção no banco de dados
    	        $('button#add_cotacao').click(function(){
    	        	let orcamento = $('select#select_add_cotacao').find('option:selected').attr('id');
    	        	let titulo = $('input[name="titulo_cotacao"]').val();

    	        	console.log(orcamento);
    	        	console.log(titulo);

    	        	//console.log(orcamento);
    	        	if(orcamento != -1 && titulo != ''){
    	        		$.ajax({  
    	        			url:'const_grava_cotacao.php',  
    	        			method:'POST', 
    	        			data: {orcamento:orcamento, titulo:titulo},
    	        			dataType:'json',  
    	        			success: dados => 	
    	        			{  
    	        				if(dados == '1'){
    	        					window.location.replace("const_cotacao2.php");
    	        				}
    	        			},
    	        			error: erro => {console.log(1)}  
    	        		}); 
    	        	}else{
    	        		alert('Selecione Um Orçamento! / Digite um titulo!');
    	        	}
		        });

    	        //Faço a exclusão da linha selecionada
		        $('button#remove-tr').click(function(){
		        	let insumo = $(this).attr('id-insumo');
		        	let cotacao = $(this).attr('cotacao');

		        	$.ajax({
		        		url:   'const_grava_cotacao.php',
		        		type:  'POST',
		           		data: {insumo:insumo, cotacao:cotacao}, //essa e o padrao x-www-form-urlencode
		           		dataType:'json',  

    	        		success: dados => 
    	        		{  	
    	        			if(dados = '1'){
    	        				$("tr[id-insumo='"+insumo+"']").detach();

	    	        			$("button#dialog").click();
	    	        			$("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Excluido com Sucesso!</h4>");
				           		$("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
    	        			}else{
    	        				$("button#dialog").click();
    	        				$("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Excluir!!</h4>");
    	        				$("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
    	        			}
    	        			calc_total();
    	        		},
    	        		error: erro => {
    	        			$("button#dialog").click();
    	        			$("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao Excluir!!</h4>");
    	        			$("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
    	        		},  
		           	});
		        });


		        //Atualizo a lista de cotações de acordo com o Orçamento Selecionado
		        $('select#select_orcamento').change(function(){
		        	let orc_cotacao = $('select#select_orcamento').find('option:selected').val();

		        	let list = $('ul#list_cotacao');

		        	list.empty();

		        	$.ajax({
		        		url:   'const_grava_cotacao.php',
		        		type:  'POST',
					   //cache: false,
		           		data: {orc_cotacao:orc_cotacao}, //essa e o padrao x-www-form-urlencode
		           		dataType:'json',  

    	        		success: dados => 
    	        		{  	
    	        			//console.log(dados);

    	        			if(dados != '0'){
    	        				for(let dado in dados){
    	        					list.append("<li id='"+dados[dado].id+"' class='list-group-item lista_cotacao' style='text-align:center; text-transform: uppercase; font-weight: bold; font-size: 15px;'>"+(dados[dado].titulo)+"</li>");
    	        				}
    	        			}
    	        		},
    	        		error: erro => {console.log("alonso")},  
		           	});
		        });

		        /*	######## INUTILIZADO ########
		        $('select#cotacao_up_excel').change(function(){
		        	if($(this).find('> option:selected').val() != -1){
		        		let id_cotacao = $(this).find('> option:selected').val();

		        		$.ajax({  
		        			url:'const_grava_cotacao.php',  
		        			method:'POST', 
		        			data: {id_cotacao:id_cotacao},
		        			dataType:'json',  
		        			success: dados => 	
		        			{  	
		        				$('select#fornecedor_up_excel > option:not(option[value="-1"])').detach();
		        				if(dados != '0'){
		        					for(let i = 0; i < dados.length; i++){
		        						$('select#fornecedor_up_excel').append('<option value="'+dados[i].id+'" style="text-transform: uppercase;">'+dados[i].nome+'</option>');
		        					}
		        				}
		        			},
		        			error: erro => {console.log(0)}  
		        		}); 


		        	}else{
		        		$('select#fornecedor_up_excel > option:not(option[value="-1"])').detach();
		        	}
		        });
		        */

		        //Atualizo a tabela de acordo com a Cotação Selecionada
		        $(document).on('click', 'li.lista_cotacao', function(){
		        	let id = $(this).attr('id');

		        	$('select#orcamento').find('option[value="'+id+'"]').attr('selected', 'selected').change();

		        	$('h2.panel-title').text($(this).text());

		        	$('button.close').click();
		        });

		        // Aplica mascara de money sempre que ocorre um evento Blur em alguma das celulas editaveis
		        $(document).on('blur', "td[contenteditable='true']:not(.quantidade_cotada)", function(){
		        	let valor;

		        	isNaN(parseFloat($(this).text().replace(/[R$. ]/g, '').replace(/,/g, '.'))) ? valor = 0 : valor = parseFloat($(this).text().replace(/[R$. ]/g, '').replace(/,/g, '.'));

		        	$(this).text(valor.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));

		        	calc_total();
		        });

		        // Salva o cpf a ser excluido no botao de exclusao da modal dialog-remove
		        $(document).on('click', "a#remove-col", function(){
		        	let cpf = $(this).parents('th').attr('cpf-fornecedor');
		        	let id_fornecedor = $(this).parents('th').attr('id-fornecedor');
		        	$('button#remove-col').attr('cpf-fornecedor', cpf);
		        	$('button#remove-col').attr('id-fornecedor', id_fornecedor);
		        });

		        // Remove a coluna selecionada após a confirmação e faz a exclusao na tabela conts_fornecedor_cotacao
		        $(document).on('click', "button#remove-col", function(){
		        	let id_fornecedor = $(this).attr('id-fornecedor');
		        	let cotacao = $orcamento.find('option:selected').val();

		        	//console.log(cotacao);
		        	//console.log(id_fornecedor);

		        	/*
		        	$.ajax({  
		        		url:'const_grava_cotacao.php',  
		        		method:'POST', 
		        		data: {cotacao:cotacao, id_fornecedor:id_fornecedor },
		        		dataType:'json',  
		        		success: dados => 	
		        		{  	
		        			console.log(1);
		        		},
		        		error: erro => {console.log(0)}  
		        	}); 
					*/
	
		        	$('thead#thead_principal').find('> tr > th[id-fornecedor="'+id_fornecedor+'"]').detach();

		        	$("tbody#myTable").find('> tr > td[id-fornecedor="'+id_fornecedor+'"]').each(function(){
		        		$(this).detach();
		        	});

		        	$('tbody#table_fornecedor > tr > td[id-fornecedor="'+id_fornecedor+'"]').parents('tr').find('> td:last-child > a').show();
		        });

                // Adiciona a espécie de MATERIAL selecionada de acordo com o orçamento selecionado
                $(document).on('click', "a#add_especie", function(){
                	//console.log('ola');
                	if($('select#orcamento option:selected').val() != -1){
                		let id_orc = $('select#orcamento option:selected').val();
                		let id_especie = $(this).parents('tr').attr('id');
                		$(this).hide();

                		//console.log(id_orc);
                		//console.log(id_especie);
                		
        				$.ajax({
        				   url:   'const_grava_cotacao.php',
        				   type:  'POST',
        				   //cache: false,
        				   //data:  { ok : 'deu certo!'},
        	           		data: {id_orc:id_orc, id_especie:id_especie}, //essa e o padrao x-www-form-urlencode
        	           		dataType:'json',  

        				   success: function(data) { 
        				   		//console.log(data);

        				   		if(data != 0){
        				   			let total = $('#table_principal > tbody#myTable').find('> tr.total').clone(true);
        				   			$('#table_principal > tbody#myTable').find('> tr.total').detach();

        				   			for(let i = 0; i < data.length; i++){
        				   				if(!$("tr[id-insumo='"+data[i].id+"']").length){
							   				let aux = $('#table_principal > tbody#myTable').find('> tr.hidden').clone();

							   				$('#table_principal > tbody#myTable').append(aux);

							   				$('#table_principal > tbody#myTable').find("> tr:last-child").removeClass('hidden')
        				   					.addClass('align-center').attr('id_especie', data[i].id_especie).attr('id-insumo', data[i].id);


							   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(0).text(data[i].descricao).attr('title', 'CÓDIGO: '+data[i].codigo);
							   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(1).text(data[i].quantidade == '' ? 0 : data[i].quantidade).attr('title', 'UNIDADE MEDIDA: '+data[i].unidade);
							   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(2).text((data[i].quantidade * data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})).attr('title', 'VALOR UNIDADE: '+parseFloat(data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));

							   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(3).text(data[i].quantidade == '' ? 0 : data[i].quantidade);

							   				$('#table_principal > tbody#myTable').find("> tr:last-child > td[contenteditable='true']:not(td.quantidade_cotada)").each(function(){
							   					$(this).text('R$ 0,00');
							   				});
						   				}
        				   			}

        				   			$('#table_principal > tbody#myTable').append(total);
        				   		}
        				   },
           				   error: function() {
           				        console.log(0);
           				   }
        				});
						
                	}else{
                		alert("Selecione um Orçamento !");
                	}
                });

                //Adiciona um novo unico insumo, e faz a verificação se ele foi orçado
                $(document).on('click', 'button.add_insumo_unico', function(){
                	let id_insumo_adicionar = $(this).parents('tr').attr('id-insumo-solo');
                	let cotacao = $orcamento.find('> option:selected').val();

		        	if(cotacao != -1){

			        	$.ajax({
			        		url:   'const_grava_cotacao.php',
			        		type:  'POST',
						   //cache: false,
			           		data: {id_insumo_adicionar:id_insumo_adicionar, cotacao:cotacao}, //essa e o padrao x-www-form-urlencode
			           		dataType:'json',  

	    	        		success: data => 
	    	        		{  	
						   		if(data != 0){

						   			let total = $('#table_principal > tbody#myTable').find('> tr.total').clone(true);
						   			$('#table_principal > tbody#myTable').find('> tr.total').detach();

						   			for(let i = 0; i < data.length; i++){

						   				if(!$("tr[id-insumo='"+data[i].id+"']").length){

						   					if(data[i].valida == '1'){
								   				let aux = $('#table_principal > tbody#myTable').find('> tr.hidden').clone();

								   				$('#table_principal > tbody#myTable').append(aux);

								   				$('#table_principal > tbody#myTable').find("> tr:last-child").removeClass('hidden')
	        				   					.addClass('align-center').attr('id_especie', data[i].id_especie).attr('id-insumo', data[i].id);


								   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(0).text(data[i].descricao).attr('title', 'CÓDIGO: '+data[i].codigo);
								   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(1).text(data[i].quantidade == '' ? 0 : data[i].quantidade).attr('title', 'UNIDADE MEDIDA: '+data[i].unidade);
								   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(2).text((data[i].quantidade * data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})).attr('title', 'VALOR UNIDADE: '+parseFloat(data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));

								   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(3).text(data[i].quantidade == '' ? 0 : data[i].quantidade);

								   				$('#table_principal > tbody#myTable').find("> tr:last-child > td[contenteditable='true']:not(td.quantidade_cotada)").each(function(){
								   					$(this).text('R$ 0,00');
								   				});
						   					}else{
								   				let aux = $('#table_principal > tbody#myTable').find('> tr.hidden').clone();

								   				$('#table_principal > tbody#myTable').append(aux);

								   				$('#table_principal > tbody#myTable').find("> tr:last-child").removeClass('hidden')
	        				   					.addClass('align-center').attr('id_especie', data[i].id_especie).attr('id-insumo', data[i].id).addClass('naoOrcado').attr('title', 'Item Não Orçado');


								   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(0).text(data[i].descricao).attr('title', 'CÓDIGO: '+data[i].codigo);
								   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(1).text(data[i].quantidade == '' ? 0 : data[i].quantidade).attr('title', 'Item Não Orçado');
								   				$('#table_principal > tbody#myTable').find("> tr:last-child > td").eq(2).text((data[i].quantidade * data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})).attr('title', 'Item Não Orçado');

								   				$('#table_principal > tbody#myTable').find("> tr:last-child > td[contenteditable='true']:not(td.quantidade_cotada)").each(function(){
								   					$(this).text((data[i].quantidade * data[i].valor_unitario).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
								   				});
						   					}
						   				}
						   			}

						   			$('#table_principal > tbody#myTable').append(total);

						   			$('.close').click();
	    	        				$('#table_principal > tbody#myTable').find('> tr:last-child > td.quantidade_cotada').focus();
						   		}else{
						   			alert('Insumo Não encontrado!');
						   		}
	    	        			//console.log(dados);
	    	        		},
	    	        		error: erro => {console.log("alonso")},  
			           	});

                		//console.log(id_insumo);
                	}else{
                		alert('Selecione Uma Cotação!');
                	}
                });
		    });

		</script>

		
	</body>
</html>