
<?php 
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	set_time_limit(0);

	//include "protege_professor.php";

	ini_set("upload_max_filesize", "10M");
	ini_set("max_execution_time", "-1");
	ini_set("memory_limit", "-1");
	ini_set("realpath_cache_size", "-1");
	if (!isset($_SESSION)) {
	  session_start();
	}
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

        $upArquivo = new Upload;
        if($upArquivo->UploadArquivo($_FILES["userfile"], "planilhas/"))
        {   
            $nome = $upArquivo->nome;
            $tamanho = $upArquivo->tamanho;
            $caminho = "planilhas/".$nome;
            $resultado = grava_planilha_insumos($nome); // recebo os dados da gravação
            $aux = 1;
        }else{
            $aux = 5;
        }

        unlink($nome);
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
		<link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/animate.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/css/bootstrap-editable.css" />

		<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
		<style type="text/css">
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

			thead.thead-dark > tr > th.text-center{
				vertical-align:middle!important;
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

			.row{
				padding: 0px;
			}

			tbody > tr > td{
				color: #000;
				border: 1px solid #343a40!important;
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
				<div class="panel panel-inverse">	
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-1">
								<h2 class="panel-title" style="font-size: 15px;">Tabela de Insumos</h2>
							</div>

							<div class="col-md-8">
								<div class="row">
									<form method="POST" id="form_principal" action="demo.html">
										<div class="col-md-5" style="padding: 0px;">
											<div class="row">
												<div class="col-md-1"></div>
												<div class="col-md-3">
													<label style="color: #FFF; text-transform: uppercase; padding-top: 8px;">Categoria</label>
												</div>
												<div class="col-md-7" style="padding: 0px;">
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
											</div>
										</div>
										<div class="col-md-7" style="padding: 0px;">
											<div class="row">
												<div class="col-md-2" style="padding-right: 0px; ">
													<label  style="color: #FFF; text-transform: uppercase; padding-top: 8px;">Espécie </label>
												</div>
												<div class="col-md-5" style="padding-left: 0px;">
													<input type="text" name="test" class="form-control" id="input_especie">
													<select class="form-control hidden" id="select_especie">
														<option value="" id="selecione">Selecione</option>
													</select>
												</div>
												<div class="col-md-5" style="padding: 0px;">
													<a href="#" class="btn btn-success" id="atualizar">Atualizar</a>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="col-md-2">
							    <input class="form-control" id="myInput" type="text" placeholder="Pesquise Aqui ...">
							</div>

							<div class="col-md-1" style="text-align: right;">
								<div class="dropdown">
								    <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Planilhas <span class="caret"></span></button>
								    <ul class="dropdown-menu">
								    	<li><a href="planilhas_mod/modelo_insumo.xlsx">Baixar Planilha Modelo</a></li>
								    	<li class="divider"></li>
								    	<li><a href="#modal-message" data-toggle="modal">Subir Planilha Modelo</a></li>
								    	<li class="hide"><a href="#modal3" data-toggle="modal" data-target="#modal3" id="excluir"></a></li>
								    	<li class="hide"><a href="#modal4" data-toggle="modal" data-target="#modal4" id="salvar"></a></li>
								    </ul>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-body " style="border-top: 0px; padding-top: 0px;">
						<div id="table" class="table-editable" style="border-top: 0px; padding-top: 0px;">
					      <div class="card">
					      	<div class="row alert" role="alert" style="padding: 0px;">
					      		<div class="col-md-11" style="text-align: center;">
					      			<h3 style="text-align: center; text-transform: uppercase; ">Cadastro de Insumos</h3>
					      		</div>
					      		<div class="col-md-1">
					      			<button type="button" class="close col-md-1" data-dismiss="alert" aria-label="Close">
					      				<span aria-hidden="true">&times;</span>
					      			</button>
					      		</div>
					      	</div>
					          
					      	<div class="card-body">
					      		<div id="table" class="table-editable pre-scrollable">
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
					      						<th class="text-center">Categoria</th>
					      						<th class="text-center">Espécie</th>
					      						<th class="text-center" id="remove">Remover</th>
					      					</tr>
					      				</thead>
					      				<tbody id="myTable">
					      					<tr align="center">
					      						<td colspan="5">Sem conteudo !</td>
					      					</tr>
					      					<tr class="hide">
					      						<td >123</td>
					      						<td >Nome do Insumo</td>
					      						<td ></td>
					      						<td ></td>
					      						<td>
					      							<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remover</button></span>
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
								<button type="button" class="btn btn-primary btn-sm table-add" style="float: left;"><i class="fa fa-plus-circle" ></i> Novo Insumo</button>
								<button type="button" class="btn btn-success btn-sm" name="age" id="age" data-toggle="modal" data-target="#modal1"><i class="fa fa-plus-circle" ></i> Cadastrar Categoria</button>
								<button type="button" class="btn btn-success btn-sm" name="age" id="age" data-toggle="modal" data-target="#modal2"><i class="fa fa-plus-circle" ></i> Cadastrar Especie</button>
								<button type="button" class="btn btn-success btn-sm" name="age" id="age" data-toggle="modal" data-target="#modal5"><i class="glyphicon glyphicon-search" ></i> Consultar insumo</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade"  id="modal-message" role="dialog">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			                <h4 class="modal-title">Subir Planilha de Insumos</h4>
			            </div>
			            <form class="form-action" action="const_cad_insumos.php" method="POST" enctype="multipart/form-data" name="envia_xlsx">
			                <div class="modal-body">
			                      <div class="form-group">
			                        <label for="exampleFormControlFile1"> Selecione seu arquivo .xlsx</label>
			                        <input type="hidden" name="MAX_FILE_SIZE" value="30000000" required="required">
			                        <input name="userfile" type="file" class="form-control-file" id="exampleFormControlFile1" required="required">
			                      </div>
			                </div>
			                <div class="modal-footer">
			                    <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success"/>
			                </div>
			            </form>
			        </div>
			    </div>
			</div>
			<div id="modal1" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Cadastrar Categoria</h4>
						</div>
						<div class="modal-body" id="cad_categoria" align="center">
							<form method="POST" action="const_grava_insumo.php" id="form_categoria">
								<div class="col-md-12" align="left">
									<label for="inputEmail4">Descrição</label>
									<input type="text" class="form-control" id="inputEmail4" placeholder="Descrição" name="descricao_categoria" required>
								</div>
								<div style="text-align: right;">
									<button type="submit" name="insert" value="Cadastrar" class="btn btn-success" id="salva_categoria" >Salvar</button>
									<button type="reset" value="reset" class="hide" id="reset" ></button>
								</div>
							</form>	
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

			<div id="modal3" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<h4 class="modal-title" align="">Excluido com sucesso!</h4>
						</div>
						<div class="modal-footer">
						    <button type="button" class="btn btn-defaut" data-dismiss="modal" >Fechar</button>
						</div>
					</div>
				</div>
			</div>

			<div id="modal4" class="modal fade" role="dialog">
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

			<div id="modal5" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
							<h3 class="modal-title" style="text-align: center; text-transform: uppercase;">Consulta de Insumo</h3>
							<div class="row">
								<div class="col-md-10">
									<input type="text" name="pesquisa_geral" class="form-control" placeholder="Digite aqui o Insumo preocurado ...">
								</div>
								<div class="col-md-2">
									<a href="#" class="btn-sm btn btn-success" id="pesquisa_geral">Pesquisar</a>
								</div>
							</div>
						</div>
						<div class="modal-body" align="center">
							<div id="table_consulta_insumo" class="table-editable pre-scrollable">
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
											<th class="text-center">Categoria</th>
											<th class="text-center">Espécie</th>
											<th class="text-center" id="remove">Remover</th>
										</tr>
									</thead>
									<tbody id="myTable">
										<tr class="hide">
											<td >123</td>
											<td >Nome do Insumo</td>
											<td ></td>
											<td ></td>
											<td>
												<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remover</button></span>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="modal-footer" id="footer_salvar">
						    <button type="button" class="btn btn-defaut" data-dismiss="modal" >Fechar</button>
						</div>
					</div>
				</div>
			</div>

			<div id="modal2" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Cadastrar Espécie</h4>
						</div>
						<div class="modal-body">
							<form method="POST" action="const_grava_insumo.php" id="form_especie">
								<div class="row">
									<div class="col-md-12">
										<label>Descrição</label>
										<input type="text" class="form-control" id="inputEmail4" placeholder="Descrição" name="descricao_especie" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12" style="margin-top: 15px;">
										<label>Categoria</label>
										<select name="select_categoria" id="select_categoria" class="form-control" form="form_especie" required>
											<option value ="" selected>Selecione</option>
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
								</div>
								<div style="text-align: right;">
									<button type="submit" name="insert" value="Cadastrar" class="btn btn-success" id="salva_categoria" >Salvar</button>
									<button type="reset" value="reset" class="hide" id="reset" ></button>
								</div>
							</form>	
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
			<!--[if lt IE 9]>
				<script src="https://immobilebusiness.com.br/admin/assets/crossbrowserjs/html5shiv.js"></script>
				<script src="https://immobilebusiness.com.br/admin/assets/crossbrowserjs/respond.min.js"></script>
				<script src="https://immobilebusiness.com.br/admin/assets/crossbrowserjs/excanvas.min.js"></script>
			<![endif]-->

			<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
			<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


			<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
			<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
			<!-- ================== END BASE JS ================== -->
			
			<!-- ================== BEGIN PAGE LEVEL JS ================== -->
			<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/ui-contextmenu/jquery.ui-contextmenu.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.30.2/jquery.fancytree-all-deps.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/js/bootstrap-editable.js"></script>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.30.2/skin-win7/ui.fancytree.min.css" />
		</div>

		<script>
		    $(document).ready(function() {
		        App.init();
		        //table();

		        //var aux = ($(window).height() - 250);
		        //$("div#table").css('max-height', aux+'px');

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
		        
		        $("#myInput").on("keyup", function() {
		        	var value = $(this).val().toLowerCase();
		        	$("#myTable tr").filter(function() {
		        		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		        	});
		        });

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
				
		        var $TABLE = $('#table');
		        var $BTN = $('#salva_table');
		        var $FORM_PRINCI = $('#form_principal');

		        //Adiciona linha a tabela
		        $('button.table-add').click(function () {

		            var aux = [];

		        	aux['categoria'] = $FORM_PRINCI.find('select#select_categoria > option:selected').val();
		        	aux['especie'] = $('input#input_especie').val();

		        	if(aux['categoria'] != '' && aux['especie'] != ''){
		        		var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
		        		$TABLE.find('table').append($clone);

		        		$TABLE.find('tbody > tr:last-child > td').each(function(i){
		        			if(i == 0){
		        				$(this).attr("contenteditable", "true");
		        			}else if(i == 1){
		        				$(this).attr("contenteditable", "true");
		        			}else if(i == 2){
		        				$(this).text(aux['categoria']);
		        			}else if(i == 3){
		        				$(this).text(aux['especie']);
		        			}else if(i == 4){
		        				$(this).find("span.table-remove").toggle();
		        				$(this).append("<span id='salvar'><button type='button' class='btn btn-defaut btn-rounded btn-sm my-0 alonso' style='background: #388e3c!important; color: #FFF;'>Salvar</button></span>");
		        			}
		        		});

		        		$TABLE.find('tbody > tr:last-child > td').focus();
		        	}else{
		        		$("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Categoria e/ou Espécie não selecionada!</h4>");
		        		$("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
		        		$('button#dialog').click();
		        	}
		        });

		        //função para salvar a nova linha inserida no banco de dados
		        $(document).on('click', '#salvar', function(){  

		            var adiciona = [];

		            //Troca os botoes da linha
		            $(this).toggle();
		            $(this).parent().find("span.table-remove").toggle();

		            //Pega todos os dados da linha
		            $(this).parents('tr').find('td').each(function(i){
		                if(i == 0){
		                    $(this).attr("contenteditable", "false");
		                    $(this).text($(this).text().toUpperCase());
		                    adiciona.push($(this).text());
		                }else if(i == 1){
		                    $(this).attr("contenteditable", "false");
		                    $(this).text($(this).text().toUpperCase());
		                    adiciona.push($(this).text());
		                }else if(i == 2){
		                	$(this).text($(this).text().toUpperCase());
		                    adiciona.push($(this).text());
		                }else if(i == 3){
		                	$(this).text($(this).text().toUpperCase());
		                    adiciona.push($(this).text());
		                }
		            });

		            $.ajax({  
		                url:'const_grava_insumo.php',  
		                method:'POST', 
		                data: {adiciona},
		                dataType:'json',  
		                success: dados => 
		                {   
		                    $("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Salvo com Sucesso!</h4>");
		                    $("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
		                    $('button#dialog').click();

		                },
		                error: erro => {
		                    $("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Erro ao salvar!</h4>");
		                    $("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
		                    $('button#dialog').click();
		                }  
		            });
		        });

		        //Função para excluir a linha do banco de dados
		        $('.table-remove').click(function () {
		            $("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Deseja realmente excluir o Insumo?</h4>");
		            $("div#dialog-footer").html(" <button type='button' class='btn btn-success' id='confirmar' >Confirmar</button>");
		            $("div#dialog-footer").append("<button type='button' class='btn btn-danger' id='cancelar' data-dismiss='modal'>Cancelar</button>");
		            $("div#dialog-footer").append("<button type='button' class='hidden' id='codigo' data-cod='"+$(this).parents('tr').find('td:first-child').text()+"'></button>");
		            $('button#dialog').click();
		        });

		        //Função para excluir a linha do banco de dados
		        $(document).on('click', '#confirmar', function(){  

		           var remove = $(this).parents('div').find('button#codigo').attr('data-cod')

		           $.ajax({  
		                url:'const_grava_insumo.php',  
		                method:'POST', 
		                data: {remove},
		                dataType:'json',  
		                success: dados => 
		                {   
		                  if(dados == 1){

		                    $('tr').find('td:first-child').each(function(){
		                        if($(this).text() == remove){
		                            $(this).parents('tr').detach();
		                            return ;
		                        }
		                    });

		                    $("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>Excluido com com Sucesso!</h4>");
		                    $("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
		                  }

		                },
		                error: erro => {
		                    $("div#dialog-body").html("<h4 class='modal-title' align='center' id='salvar'>alonso!</h4>");
		                    $("div#dialog-footer").html("<button type='button' class='btn btn-defaut' data-dismiss='modal' >Fechar</button>");
		                }  
		            });
		        });

		        //grava uma nova categoria e atualiza todos os select 
		        $('#form_categoria').on("submit", function(event){  
         			event.preventDefault();  

         			$.ajax({  
         				url:'const_grava_insumo.php',  
         				method:'POST', 
         				data:$('#form_categoria').serialize(),
         				dataType:'json',  
         				success: dados => 
         				{  	
         					$("button#reset").click();
         					$(".close").click();
         					$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Salvo com Sucesso!</h4>");
         					$("a#salvar").click();

         					// Insiro as opções do banco nos selects da página
         					$("select#select_categoria").each(function(){
         						$(this).append('<option value="'+dados[dados.length-1]+'">'+dados[dados.length-1]+'</option>');
         					});
         				},
         				error: erro => {
         					$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Falha ao Gravar !</h4>");
         					$("a#salvar").click();
         				} 
         			});  
		        });

		        //grava uma nova especie
		        $('#form_especie').on("submit", function(event){  
         			event.preventDefault();  

         			$.ajax({  
         				url:'const_grava_insumo.php',  
         				method:'POST', 
         				data:$('#form_especie').serialize(),
         				dataType:'json',  
         				success: dados => 
         				{  	
         					$("button#reset").click();
         					$(".close").click();
         					$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Salvo com Sucesso!</h4>");
         					$("a#salvar").click();
         				},
         				error: erro => {
         					$("div#salvar").html("<h4 class='modal-title' align='center' id='salvar'>Falha ao Gravar !</h4>");
         					$("a#salvar").click();
         				}  
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

		        				$('input#input_especie').val('');

	        					var selecione = $("select#select_especie").find('> option#selecione').clone(true);
	        					$("select#select_especie").empty();
	        					$("select#select_especie").append(selecione);

		        				for(var i = 0; i < dados.length; i++){
		        					//insiro as opções que peguei no banco
		        					$("select#select_especie").append('<option value="'+dados[i]+'">'+dados[i]+'</option>');
		        				}

		        				setTimeout(function(){
		        					if(i > 8){
		        						$("#ui-id-1").css("overflow-y" , "scroll");
		        						$("#ui-id-1").css("overflow-x" , "hidden");
		        						$("#ui-id-1").css("height" , "50%");
		        					}else{
		        						$("#ui-id-1").css("height", "auto");
		        						$("#ui-id-1").css("overflow-y" , "hidden");
		        						$("#ui-id-1").css("overflow-x" , "hidden");
		        					}
		        				}, 250);

		        				auto_complete();
		        				
		        			}else{
		        				$('input#input_especie').val('');
		        				var selecione = $("select#select_especie").find('> option#selecione').clone(true);
	        					$("select#select_especie").empty();
	        					$("select#select_especie").append(selecione);
		        			}
		        		},
		        		error: erro => {console.log(1)}  
		        	});  
		        });

		        //Atualiza toda a tabela de acordo com as opções selecionadas
		        $("#atualizar").click(function(){
		        	var $clone = $TABLE.find('tr.hide').clone(true);
		        	$TABLE.find('tbody').empty();
		        	$TABLE.find('table').append($clone);

		        	$("input#myInput").val('');
		        	var aux = {};

		        	aux['categoria'] = $FORM_PRINCI.find('select#select_categoria > option:selected').val();
		        	aux['especie'] = $('input#input_especie').val();

		        	$.ajax({  
		        		url:'const_grava_insumo.php',  
		        		method:'POST', 
		        		data: aux,
		        		dataType:'json', 
		        		beforeSend: function(){
		        			$("div#modal-dialog > div > div > div#dialog-body").html("<img src='img/loading.gif' width='45' height='45' style='text-align: right;'>");
		        			$("div#modal-dialog > div > div > div#dialog-footer").html("<h4 class='modal-title' align='center' id='salvar'>Carregando, aguarde!</h4>");
		        			$("button#dialog").click();
		        		},
		        		success: dados => 
		        		{  	
							$("button#close").click();
							
							// console.log(dados);

		        			if(!isEmpty(dados.categoria)){

		        				for(var data in dados ){

		        					var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
		        					$TABLE.find('tbody').append($clone);

		        					$TABLE.find('tbody > tr:last-child > td').each(function(i){
		        						if(i == 0){
		        							$(this).text(dados[data].codigo);

		        						}else if(i == 1){
		        							$(this).text(dados[data].desc);

		        						}else if(i == 2){
		        							$(this).text(dados[data].cat);

		        						}else if(i == 3){
		        							$(this).text(dados[data].esp);

		        						}else if(i == 4 && dados[data].valida == 1){
		        							$(this).find('span.table-remove').detach();
		        						}
		        					});
		        				}
		        			}else{
		        				$TABLE.find('tbody').empty();
		        				if ($('tbody').is(':empty')){

		        				 	$('tbody').html("<tr colspan='4' align='center'><td>Sem conteudo !</td></tr>");
		        				}
		        			}
		        		},
		        		error: erro => {console.log("alonso")},  
		        	});
		        });

		        //Realiza uma busca na Tabela const_insumos pelo insumo preocurado
		        $("a#pesquisa_geral").click(function(){

		        	let pesquisa = $('input[name="pesquisa_geral"]').val().toUpperCase();
		        	var tabela = $('div#table_consulta_insumo > table');
		        	 tabela.find('> tbody > tr:not(tr.hide)').empty();

		        	$.ajax({  
		        		url:'const_grava_insumo.php',  
		        		method:'POST', 
		        		data: {pesquisa:pesquisa},
		        		dataType:'json', 
		        		success: dados => 
		        		{  	
		        			if(dados != '0'){

		        				for(var data in dados ){

		        					
		        					var $clone = tabela.find('> tbody > tr.hide').clone(true).removeClass('hide');
		        					tabela.find('> tbody').append($clone);

		        					tabela.find('> tbody > tr:last-child > td').each(function(i){
		        						if(i == 0){
		        							$(this).text(dados[data].codigo);

		        						}else if(i == 1){
		        							$(this).text(dados[data].desc);

		        						}else if(i == 2){
		        							$(this).text(dados[data].cat);

		        						}else if(i == 3){
		        							$(this).text(dados[data].esp);

		        						}else if(i == 4 && dados[data].valida == 1){
		        							$(this).find('> span.table-remove').detach();
		        						}
		        					});
		        				}
		        			}else{
		        				var $clone = tabela.find('> tbody > tr.hide').clone(true);

		        				tabela.find('> tbody').empty();

		        				if (tabela.find('> tbody').is(':empty')){

		        				 	tabela.find('> tbody').html("<tr class='sn'><td colspan='5' align='center'>Sem conteudo !</td></tr>");
		        				}

		        				tabela.find('> tbody').append($clone);
		        			}
		        		},
		        		error: erro => {console.log("alonso")},  
		        	});
		        });
		    }); 	 	

		</script>

		
	</body>
</html>