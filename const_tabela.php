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
	require_once("const_grava_tabela.php");	
	include "conexao.php";

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

    	if($_POST['select_up'] == 1 || $_POST['select_up'] == 2){
	

    		$upArquivo = new Upload;
    		if($upArquivo->UploadArquivo($_FILES["userfile"], "planilhas/"))
    		{   
    		    $nome = $upArquivo->nome;
    		    $tamanho = $upArquivo->tamanho;
    		    $caminho = "planilhas/".$nome;
    		    $resultado = grava_planilha_orcamento($nome, $_POST['id_orcamento'], $_POST['select_up']); // recebo os dados da gravação
    		    $aux = 1;
    		}else{
    		    $aux = 5;
    		}

			unlink($nome);
			unlink($caminho);
			unset($nome);
			unset($caminho);
			unset($_FILES["userfile"]);
			unset($_POST['select_up']);


			header("Refresh:0; url=const_tabela.php");
			
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
		<link href="css/tooltip.css" rel="stylesheet">
		<link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/animate.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />
		<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


		<!-- ================== END BASE CSS STYLE ================== -->
		
		<style type="text/css">
			/* custom alignment (set by 'renderColumns'' event) */

			.alignCenter {
				text-align: center;
			}

			span{
				font-family: Arial, Helvetica, sans-serif;
			}

			input{
				width: 100%;
			}

			th, td {
				padding: 0px !important;
				margin: 0px !important;
				text-align: left;
				border-bottom: 1px solid #000;
				vertical-align:middle!important;
				color: #000;
			}

			tr.pai > td#tree > span {
				font-weight: bold;
				text-transform: uppercase;
			}

			tr > td#tree> span {
				text-transform: capitalize;
			}

			input#total{
				width: 80%;
				float: right;
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
				font-size: 11px!important;
			}
			thead.thead-dark > tr > th.alignCenter{
				vertical-align: center !important;
				font-size: 13px !important;
				padding: 5px !important;
				font-weight: normal;
				color: #fff;
				background-color: #343a40;
				text-transform: uppercase;
			}

			thead.thead-dark{
				vertical-align: middle;
			}

			h2.tracking-in-contract-bck {
				-webkit-animation: tracking-in-contract-bck 2s cubic-bezier(0.215, 0.610, 0.355, 1.000) both;
				animation: tracking-in-contract-bck 2s cubic-bezier(0.215, 0.610, 0.355, 1.000) both;

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
				<?php 
					if((!isset($resultado["error"])) && isset($resultado["ok"])){
						if(empty($resultado["ok"])){
							?>
							<div class="alert alert-warning" role="alert">
								<p class="font-weight-bold">Falha ao gravar o arquivo, Por favor verifique e tente novamente !</p></br>
							</div>
							<?php
						}
					}

					if(isset($resultado) && (count($resultado["ok"]) !== 0)){       ?>
						<div class="alert alert-success" role="alert">
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
							<font><?php echo "Falha ao gravar algumas linhas, por gentileza verifique e tente novamente!"; ?></font>
							<a href="planilhas/falhas.xlsx"><span class="label label-danger" style="font-size:100% !important">BAIXAR PLANILHA DE DADOS NÃO CADASTRADOS!</span></a>
						</div>
						<?php 
					}elseif (isset($resultado["error"]) && $_GET["planilha"] == 2) { ?>
						<div class="alert alert-danger" role="alert">
							<font><?php echo "Falha ao gravar algumas linhas, por gentileza verifique e tente novamente!"; ?></font>
							<a href="planilhas/falhas.xlsx"><span class="label label-danger" style="font-size:100% !important">BAIXAR PLANILHA DE DADOS NÃO CADASTRADOS!</span></a>
						</div>
					<?php }
				?>

				<h3 class="page-header">Orçamento Geral</h3>
				<div class="panel panel-inverse">	
					<div class="panel-heading">
						<div class="row">

							<div class="col-md-2">
								<a href="#modal4" data-toggle="modal" data-target="#modal4" id="cad_orcamento" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-plus" style="font-size: 10px;"></span>
									Novo Orçamento
								</a>
							</div>

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


							
							<div class="col-md-2" align="left">
								<div class="dropdown">
								    <button class="btn btn-success dropdown-toggle btn-sm" type="button" data-toggle="dropdown" style="margin-left: 25px!important;" id="planilhas">Planilhas <span class="caret"></span></button>
								    <ul class="dropdown-menu">
								      <li><a href="planilhas_mod/MODELO_ORCAMENTO.xlsx" >Baixar Planilha Modelo</a></li>
								      <li class="divider"></li>
								      <li><a href="#modal-message" data-toggle="modal" id="upload_planilha">Subir Planilha Modelo</a></li>
								    </ul>
								</div>
							</div>
						</div>
					</div>
					
					<div class="panel-body table-wrapper-scroll-y my-custom-scrollbar" >
						<div role="tabpanel">
		                    <!-- Nav tabs -->
		                    <ul class="nav nav-tabs" role="tablist">
		                        <li role="presentation" class="active"><a href="#orc_material" aria-controls="orc_material" role="tab" data-toggle="tab" style="font-weight: bold;">Orçamento de Material</a></li>
		                        <li role="presentation"><a href="#orc_tarefa" aria-controls="orc_tarefa" role="tab" data-toggle="tab" style="font-weight: bold;">Orçamento de Tarefas/Serviços</a></li>
		                    </ul>
		                    <!-- Tab panes -->
		                    <div class="tab-content">
		                        <div role="tabpanel" class="tab-pane active" id="orc_material">
		                        	<div class="row" align="center" id="div_input">
            							<div class="input-group" style="padding: 10px;">
            								<input  placeholder="Pesquise Aqui..." autocomplete="off" id="search_material" class="form-control" type="text">
            								<div class="input-group-btn">
            									<button id="reset_material" class="btn">&times;</button>
            								</div>
            							</div>
            						</div>
		                        	<table id="tree" class="table table-bordered">
		                        		<thead class="thead-dark">
		                        			<tr> 
		                        				<th class="alignCenter" style="width:3%; ">#</th> 
		                        				<th class="alignCenter" style="width:5%; ">ID</th> 
		                        				<th class="alignCenter" style="width:32%; ">Pastas</th> 
		                        				<th class="alignCenter" style="width:15px;">Quantidade</th> 
		                        				<th class="alignCenter" style="width:15px;">Medida</th> 
		                        				<th class="alignCenter" style="width:15px;">Valor Unitario</th>
		                        				<th class="alignCenter" style="width:15px;">Total</th> 
		                        			</tr>
		                        		</thead>
		                        		<tbody>
		                        			<tr>
		                        				<td id="checkbox" class="alignCenter"></td>
		                        				<td id="id" style="padding: 4px !important; " ></td>
		                        				<td id="tree"></td>
		                        				<td class="alignCenter" id="no_input"><input name="unidade" id="unidade" type="text"></td>
		                        				<td class="alignCenter" id="no_input"><input name="qnt" id="qnt" type="text"></td>
		                        				<td class="alignCenter" id="no_input"><input name="valor_qnt" type="text" id="money"></td>
		                        				<td class="alignCenter"><input name="total" type="text" id="money" disabled></td>
		                        			</tr>
		                        		</tbody>
		                        	</table>
		                        </div>

		                        <div role="tabpanel" class="tab-pane" id="orc_tarefa" >
		                        	<div class="row" align="center" id="div_input">
            							<div class="input-group" style="padding: 10px;">
            								<input placeholder="Pesquise Aqui..." autocomplete="off" id="search_tarefa" class="form-control" type="text">
            								<div class="input-group-btn">
            									<button id="reset_tarefa" class="btn">&times;</button>
            								</div>
            							</div>
            						</div>

            						<table id="orc_tarefa" class="table table-bordered">
            							<thead class="thead-dark">
            								<tr> 
            									<th class="alignCenter" style="width:3%; ">#</th> 
            									<th class="alignCenter" style="width:5%; ">ID</th> 
            									<th class="alignCenter" style="width:32%; ">Pastas</th> 
            									<th class="alignCenter" style="width:15px;">Quantidade</th> 
            									<th class="alignCenter" style="width:15px;">Medida</th> 
            									<th class="alignCenter" style="width:15px;">Valor Unitario</th>
            									<th class="alignCenter" style="width:15px;">Total</th> 
            								</tr>
            							</thead>
            							<tbody>
            								<tr>
            									<td id="checkbox" class="alignCenter"></td>
            									<td id="id" style="padding: 4px !important; " ></td>
            									<td id="tree"></td>
            									<td class="alignCenter" id="no_input"><input name="unidade" id="unidade" type="text"></td>
            									<td class="alignCenter" id="no_input"><input name="qnt" id="qnt" type="text"></td>
            									<td class="alignCenter" id="no_input"><input name="valor_qnt" type="text" id="money"></td>
            									<td class="alignCenter"><input name="total" type="text" id="money" disabled></td>
            								</tr>
            							</tbody>
            						</table>
		                        </div>
		                    </div>
		                </div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-8" style="width:;">
								<button onclick="salva_tabela();" class="btn btn-success btn-sm" id="salva_tabela">
									<span class="glyphicon glyphicon-floppy-disk" style="font-size: 10px;"></span>
									Salvar Tabela
								</button>
								<button href="#modal5" data-toggle="modal" data-target="#modal5" class="btn btn-info btn-sm" id="chama_finaliza_orcamento">
									<span class="glyphicon glyphicon-lock" style="font-size: 10px;"></span>
									Finalizar Orçamento
								</button>
							
								<span class="glyphicon glyphicon-lock hidden" style="font-size: 25px; color: #343a40; padding-right: 15px;" id="orcamento_fechado"></span>

								<button onclick="gera_excel();" class="btn btn-danger btn-sm" style="background-color: #41863a; color: #FFF; border:none;" >Exportar Excel</button>

								<button onclick="gera_pdf();" class="btn btn-danger btn-sm" style="background-color: #41863a; color: #FFF; border:none;" >Exportar PDF</button>
								
								<!-- <button href="#modal-insumo" data-toggle="modal" data-target="#modal-insumo" class="btn btn-warning btn-md" id="add-insumo" style="margin-left:11%;">
									<span class="glyphicon glyphicon-plus-sign" style="font-size: 10px;"></span>
									Adicionar Item
								</button> -->
							</div>
							<div class="col-md-4" >
								<p>
									<label><strong>Total</strong></label>
								    <input class="w3-input w3-border" id="total" type="text" disabled>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="modal-message" role="dialog" style="display: none;">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			                <h4 class="modal-title">Subir Planilha de Orçamento</h4>
			            </div>
			            <form class="form-action" action="const_tabela.php" method="POST" enctype="multipart/form-data" id="envia_xlsx" >
			            	<div class="modal-body">
			            		<div class="form-group">
			            			<input type="hidden" name="id_orcamento" value="" id="id_orcamento">
			            			<label for="exampleFormControlFile1"> Selecione seu arquivo .xlsx</label>
			            			<input type="hidden" name="MAX_FILE_SIZE" value="30000000" required="required">
			            			<input name="userfile" type="file" class="form-control-file" id="exampleFormControlFile1" required="required">
			            		</div>
			            		<div class="form-group">
			            			<label for="select_up"> Selecione O tipo de Planilha</label>
			            			<select class="form-control" id="select_up" name="select_up">
			            				<option value="-1">Selecione</option>
			            				<option value="1">Planilha de Materias</option>
			            				<option value="2">Planilha de Tarefas</option>
			            			</select>
			            		</div>
			            	</div>
			            	<div class="modal-footer">
			            		<input type="submit" id="cad_plan" name="cad_plan" value="Cadastrar" class="btn btn-success"/>
			            	</div>
			            </form>
			        </div>
			    </div>
			</div>

			<div class='loading'>
				
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

			<button href="#modal2" data-toggle="modal" data-target="#modal2" class="hidden" id="cad_insumo"></button>
			<div id="modal2" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" id="close_cad_insumo" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Cadastrar Insumo</h4>
						</div>
						<div class="modal-body">
							<form method="POST" action="const_grava_insumo.php" id="cad_insumo_form">
								<div class="form-group">
									<label>Descrição</label>
									<input type="text" class="form-control" id="cad_insumo_desc" placeholder="Descrição" name="descricao_insumo" disabled required style="text-transform: uppercase;">
								</div>
								<div class="form-group">
									<label>Código</label>
									<input type="text" class="form-control" id="cad_insumo_cod" placeholder="Código" name="codigo_insumo" required>
								</div>
								<div class="form-group">
									<label>Categoria</label>
									<select name="select_categoria" id="select_categoria" class="form-control" form="form_especie" required>
										<option value ="-1" selected>Selecione</option>
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

								<div class="form-group">
									<label>Especie</label>
									<select class="form-control" id="select_especie" required>
										<option value="-1" id="selecione">Selecione</option>
									</select>
								</div>
								
								<div class="modal-footer" style="text-align: right;">
									<button type="submit" name="insert" value="Cadastrar" class="btn btn-success" id="salva_insumo" >Salvar</button>
									<button type="reset" value="reset" class="hide" id="reset" ></button>
								</div>
							</form>	
						</div>
					</div>
				</div>
			</div>

			<div id="cad_tarefa" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" id="close_cad_insumo" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Cadastrar Tarefa</h4>
						</div>
						<div class="modal-body">
							<form method="POST" action="const_grava_insumo.php" id="cad_tarefa_form">
								<div class="form-group">
									<label>Descrição</label>
									<input type="text" class="form-control" id="cad_tarefa_input" placeholder="Descrição" name="nome_tarefa" disabled required style="text-transform: uppercase;">
								</div>
								<div class="form-group">
									<label>Código</label>
									<input type="text" class="form-control" id="cad_tarefa_cod" placeholder="Código" name="cod_tarefa" required>
								</div>
								<div class="modal-footer" style="text-align: right;">
									<button type="submit" name="insert" value="Cadastrar" class="btn btn-success" id="salva_insumo" >Salvar</button>
									<button type="reset" value="reset" class="hide" id="reset" ></button>
								</div>
							</form>	
						</div>
					</div>
				</div>
			</div>

			<button href="#modal3" data-toggle="modal" data-target="#modal3" class="hidden" id="cad_plano"></button>
			<div id="modal3" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Cadastrar Plano de Conta</h4>
						</div>
						<div class="modal-body">
							<form method="POST" action="const_grava_planoContas.php" id="cad_plano_form">
								<div class="form-group">
									<label>Descrição</label>
									<input type="text" class="form-control" id="cad_plano_desc" placeholder="Descrição" name="descricao_insumo" required disabled style="text-transform: uppercase;">
								</div>
								<div class="form-group">
									<label>Código</label>
									<input type="text" class="form-control" id="cad_plano_cod" placeholder="Código" name="codigo_insumo" required>
								</div>
								<div class="modal-footer" style="text-align: right;">
									<button type="submit" name="insert" value="Cadastrar" class="btn btn-success" id="salva_insumo" >Salvar</button>
									<button type="reset" value="reset" class="hide" id="reset" ></button>
								</div>
							</form>	
						</div>
					</div>
				</div>
			</div>

			<div id="modal4" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Cadastrar Orçamento</h4>
						</div>
						<div class="modal-body">
							<form method="POST" action="const_tabela.php" id="form_cad_orcamento">
								<div class="form-group">
									<label>Orçamento</label>
									<input type="text" class="form-control" id="cad_orcamento" placeholder="Descrição" name="cad_orcamento" required style="text-transform: uppercase;">
								</div>
								<div class="form-group">
									<label>Empreendimento</label>
									<select class="form-control" required id="select_empreendimento">
										<option value="-1">Selecione</option>
										<?php
											$query = mysqli_query($db, "SELECT * FROM empreendimento_cadastro")or die(mysqli_error($db));

											if(mysqli_num_rows($query) > 0){
												while ($assoc = mysqli_fetch_assoc($query)) {
													?>
													<option value="<?php echo $assoc['idempreendimento_cadastro']; ?>"><?php echo $assoc['descricao_empreendimento'];?></option>
													<?php
												}
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label>Sub-Empreendimento</label>
									<select class="form-control" required id="select_sub_empreendimento">
										<option value="-1">Selecione</option>
									</select>
								</div>
								<div class="modal-footer" style="text-align: right;">
									<button type="submit" name="insert" value="Cadastrar" class="btn btn-success" id="salva_insumo" >Salvar</button>
									<button type="reset" value="reset" class="hide" id="reset"></button>
								</div>
							</form>	
						</div>
					</div>
				</div>
			</div>

			<div id="modal5" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title" style="text-transform: uppercase; text-align: center; font-weight: bold;">Finalizar Orçamento</h4>
						</div>
						<div class="modal-body" align="center">
							<h3>Deseja realmente Finalizar o Orçamento?</h3>
							<p style="font-weight: bold;">Depois de Finalizado você não poderá realizar alterações</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success btn-sm" id="finaliza_orcamento" data-dismiss="modal">Finalizar</button>
							<button type="button" class="btn btn-defaut btn-sm" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</div>
			</div>

			<div id="modal-insumo" class="modal fade" role="dialog">
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
										<select class="form-control"  id="choice_categoria" >
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
										<select class="form-control " id="choice_especie" >
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
							<div id="table_ins" class="table-editable pre-scrollable">
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

		</div>

		<div class="script">
			<!-- ================== BEGIN BASE JS ================== -->
			<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
			<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
			<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
			<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

			<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
			<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
			<!-- ================== END BASE JS ================== -->
			
			<!-- ================== BEGIN PAGE LEVEL JS ================== -->
			
			<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/ui-contextmenu/jquery.ui-contextmenu.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.30.2/jquery.fancytree-all-deps.js"></script>
			<script src="js/const_tabela.js"></script>
			<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
			<script type="text/javascript" src="tableExport/libs/FileSaver/FileSaver.min.js"></script>
			<script type="text/javascript" src="tableExport/libs/js-xlsx/xlsx.core.min.js"></script>
			<script type="text/javascript" src="tableExport/libs/jsPDF/jspdf.min.js"></script>
			<script type="text/javascript" src="tableExport/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
			<script type="text/javascript" src="tableExport/tableExport.min.js"></script>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.30.2/skin-win7/ui.fancytree.min.css" />
		</div>

		<script type="text/javascript">
			function gera_excel(){

			    var aux = $('div[class="tab-pane active"]').attr('id');

			    aux == 'orc_material' ? aux = "tree" :  '';

			    console.log(aux);

			    var orc = $("table#"+aux).fancytree("getTree");

			    console.log(orc);

			    orc.expandAll();

			    $('table#'+aux).tableExport({
			        type:'xlsx',
			        postCallback: function(){
			            console.log('done loading my humugoid file')
			        }
			    });
			}

			function gera_pdf(){

			    var aux = $('div[class="tab-pane active"]').attr('id');
			    aux == 'orc_material' ? aux = "tree" :  '';

			    var orc = $("table#"+aux).fancytree("getTree");

			    console.log(orc);

			    var doc = new jsPDF();

			    orc.expandAll();

			    $('table#'+aux).tableExport({
			        type:'pdf',
			        fileName: 'tarefa'
			    }, doc);

			    orc.expandAll(false);
			}

		</script>

		<script>
		    $(document).ready(function() {
		        App.init();
		        table('orcamentos/default.json', 'table#tree');

		        table('orcamentos/default.json', 'table#orc_tarefa');
		      	
		      	//Defino o tamanho da tabela de acordo com o tamanho da tela do usuario
		      	var aux = ($(window).height() - 200);
		      	$("div.table-wrapper-scroll-y").css('max-height', aux);

		        setInterval(function(){
		        	atualiza_no();
		        }, 500);


		       
		      
		    });
		</script>
		
	</body>
</html>
