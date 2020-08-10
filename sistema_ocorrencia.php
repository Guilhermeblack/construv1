<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
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
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
 	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
 	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
</head>
<body>


	<?php 
	function nome_quadra($id){
		include "conexao.php";
		$queryquadra = "SELECT quadra FROM produto WHERE idproduto = $id";
		$execquadra = mysqli_query($db, $queryquadra);
		$x = mysqli_fetch_assoc($execquadra);
		return $x["quadra"];
	}


	function nome_lote($id){
		include "conexao.php";
		$querylote = "SELECT lote FROM lote WHERE idlote = $id";
		$execlote = mysqli_query($db, $querylote);
		$y = mysqli_fetch_assoc($execlote);
		return $y["lote"];
	}

	function nome_empreendimento($id){
		include "conexao.php";
		$querylote = "SELECT descricao_empreendimento AS nome FROM empreendimento_cadastro WHERE idempreendimento_cadastro = $id";
		$execlote = mysqli_query($db, $querylote);
		$y = mysqli_fetch_assoc($execlote);
		return $y["nome"];
	}

	?>


	<script type="text/javascript">

		function excluir(){

			document.nome.action = "excluir_contatos.php";
			document.nome.submit();

		}

		function baixar(){

			document.nome.action = "baixar_contatos.php";
			document.nome.submit();

		}

	</script>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		

		<?php include "topo.php"; ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">

				<li><a href="cadastro_ocorrencia.php"><span class="label label-primary">NOVA OCORRENCIA</span></a></li>

			</ol>	 
			<!-- end breadcrumb -->
			<h1 class="page-header">Ocorrências De Obra</h1>
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title"> Filtro</h4>
				</div>
				<div class="panel-body">
					<form class="form-vertical form-bordered" name="myForm" method="GET" action="sistema_ocorrencia.php">

						<div class="row">
							<div class="form-group col-md-6">
								<label class=" control-label">Aberta por:</label>
								<select class="default-select2 form-control" name="aberta_por" >
									<option value="">Todos</option>
									<?php

									include "conexao.php";

									$query_amigo = "SELECT * FROM cliente                       
									order by nome_cli Asc";

									$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
					                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

					                	$idcliente             = $buscar_amigo['idcliente'];
					                	$nome_cli              = $buscar_amigo["nome_cli"];
					                	$cpf_cli              = $buscar_amigo["cpf_cli"];
					                	?>
					                	<option value="<?php echo "$idcliente" ?>"> <?php echo utf8_encode($nome_cli)."  	CPF: "."$cpf_cli" ?> </option>
					                <?php } ?>
					            </select>
							</div>

							<div class="form-group col-md-6">
								<label class="control-label" style="margin-top: -10px;">Ocorrencia Para:</label>
								<select class="default-select2 form-control" name="ocorrencia_para" >
									<option value="">Todos</option>
									<?php

									include "conexao.php";

									$query_amigo = "SELECT * FROM cliente                       
									order by nome_cli Asc";

									$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
					                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

					                	$idcliente             = $buscar_amigo['idcliente'];
					                	$nome_cli              = $buscar_amigo["nome_cli"];
					                	$cpf_cli              = $buscar_amigo["cpf_cli"];



					                	?>
					                	<option value="<?php echo "$idcliente" ?>"> <?php echo utf8_encode($nome_cli)." CPF: "."$cpf_cli" ?> </option>
					                <?php } ?>
					            </select>
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-6">
								<label class="control-label" >Empreendimento</label>
								<select class="default-select2 form-control" name="empreendimento_id" >
									<option value="">Todos</option>
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
							
							<div class="form-group col-md-6">
								<label class=" control-label">Status</label>
								<select name="status_ocorrencia" class="form-control">
									<option value="">Todos</option>
									<option value="1">Aberta</option>
									<option value="2">Em Andamento</option>
									<option value="3">Finalizada Pelo Atendente</option>
									<?php if($idgrupo_acesso == 5 ){   ?>
										<option value="4">Finalizada</option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-12">
								<label class=" control-label" >Período</label>
								<div class="input-group">
									<input type="date" class="form-control" name="inicio" placeholder="Data Inicial" />
									<span class="input-group-addon">Até</span>
									<input type="date" class="form-control" name="fim" placeholder="Data Final"  />
								</div>
							</div>
							
						</div>

						<div class="form-group">
							<input type="submit" name="botao" class="btn btn-sm btn-success" value="Consultar" />
						</div>
					</form>
				</div>
			</div>


		<?php 
		if (isset($_GET["botao"])) {


			$inicio            = $_GET["inicio"];
			$fim               = $_GET["fim"];

			$aberta_por        = $_GET["aberta_por"];
			$ocorrencia_para   = $_GET["ocorrencia_para"];
			$empreendimento_id = $_GET["empreendimento_id"];
			$status_ocorrencia = $_GET["status_ocorrencia"];

			$where = "idocorrencia > 0";

			if($inicio != '' AND $fim != ''){
				$where .= " AND STR_TO_DATE(data_ocorrencia, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";
			}

			if($aberta_por != ''){
				$where .= " AND cadastrado_por = ".$aberta_por;
			}

			if($ocorrencia_para != ''){
				$where .= " AND ocorrencia_para = ".$ocorrencia_para;
			}

			if($status_ocorrencia != ''){
				$where .= " AND status_ocorrencia = ".$status_ocorrencia;
			}

			if($empreendimento_id != ''){
				$where .= " AND empreendimento_id = ".$empreendimento_id;
			}
			?>

			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Informações</h4>
				</div>

				<div class="panel-body">
					<form action="#" method="POST" id="nome" name="nome">

						<table id="data-table" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Cod</th>
									<th>Titulo</th>
									<th>Descrição</th>
									<th>Empreendimento</th>
									<th>Data</th>
									<th>Aberta Por:</th>
									<th>Ocorrencia Para:</th>
									<th>Status</th>
									<th>Anexo</th>
									<th></th>


								</tr>
							</thead>

							<tbody>

								<?php

								include "conexao.php";

					            if(in_array('49', $idrota)){ //se for administrador
					            	$query_amigo = "SELECT * FROM ocorrencia WHERE $where order by status_ocorrencia, idocorrencia desc";
					            }else{//nao é administrador
					                   //pega id do usuario e ver a que grupo ele pertence
					            	$query_amigo1 = "SELECT idgrupo FROM cliente  WHERE idcliente = $imobiliaria_idimobiliaria";

					            	$executa_query1 = mysqli_query($db,$query_amigo1) or die ("Erro ao listar clientes1010");

					            	$buscar_amigo1 = mysqli_fetch_assoc($executa_query1);

					            	$e_imobiliaria = $buscar_amigo1['idgrupo'];
	                                if($e_imobiliaria != '6'){//se nao for imobiliaria

	                                	$query_amigo = "SELECT * FROM ocorrencia WHERE idocorrencia > 0 AND cadastrado_por = $imobiliaria_idimobiliaria or ocorrencia_para = $imobiliaria_idimobiliaria or ocorrencia_para_grupo = (SELECT idgrupo FROM cliente WHERE idcliente = $imobiliaria_idimobiliaria) order by status_ocorrencia, idocorrencia desc ";

	                                  }else{//se for imobiliaria

	                                  	$query_amigo =  "SELECT DISTINCT ocorrencia.idocorrencia, ocorrencia.titulo, ocorrencia.descricao, ocorrencia.data_ocorrencia, ocorrencia.cadastrado_por, ocorrencia.status_ocorrencia, ocorrencia.ocorrencia_para  FROM ocorrencia,cliente WHERE  idocorrencia > 0 and ocorrencia.cadastrado_por = $imobiliaria_idimobiliaria and cliente.imob_id = $imobiliaria_idimobiliaria or ocorrencia.ocorrencia_para = $imobiliaria_idimobiliaria order by ocorrencia.status_ocorrencia, ocorrencia.idocorrencia desc";
	                                }
	                            }


                            	$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro Ocorrencias");

					            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

					            	$idocorrencia       = $buscar_amigo['idocorrencia'];
					            	$titulo             = $buscar_amigo["titulo"];
					            	$descricao          = $buscar_amigo['descricao'];
					            	$data_ocorrencia    = $buscar_amigo["data_ocorrencia"];
					            	$cadastrado_por     = $buscar_amigo["cadastrado_por"];
					            	$status_ocorrencia  = $buscar_amigo["status_ocorrencia"];
					            	$ocorrencia_para    = $buscar_amigo["ocorrencia_para"];
					            	$ocorrencia_para_grupo = $buscar_amigo["ocorrencia_para_grupo"];
					            	$idemp = $buscar_amigo["empreendimento_id"];

					            	if($status_ocorrencia == 1){
					            		$status_mostrar = '<span class="label label-primary">ABERTA</span>';
					            	}elseif($status_ocorrencia == 2){
					            		$status_mostrar = '<span class="label label-success">EM ANDAMENTO</span>';
					            	}elseif($status_ocorrencia == 3){
					            		$status_mostrar = '<span class="label label-warning">FINALIZADA PELO ATENDENTE</span>';

					            	}else{
					            		$status_mostrar = '<span class="label label-danger">FINALIZADA</span>';
					            	}


					            	$nome_quadra = nome_quadra($quadra);
					            	$nome_lote   = nome_lote($lote);
					            	$nome_empreendimento = nome_empreendimento($idemp);

					            	?>


					            	<tr class="odd gradeX">
					            		<td><?php echo $idocorrencia ?></td>
					            		<td><?php echo $titulo ?></td>
					            		<td><?php echo $descricao ?></td>
					            		<td><?php echo $nome_empreendimento ?></td>
					            		<td><?php echo $data_ocorrencia ?></td>
					            		<td><?php echo nome_user($cadastrado_por) ?></td>
					            		<td><?php echo nome_user($ocorrencia_para) ?></td>
					            		<td><?php echo $status_mostrar ?></td>
					            		<td>
					            			<?php	

					            			if(in_array('64', $idrota)){


					            				$query_anexo = "SELECT * FROM ocorrencia_arquivos WHERE ocorrencia_id = $idocorrencia";

					            			}else{


					            				$query_anexo = "SELECT * FROM ocorrencia_arquivos 
					            				INNER JOIN ocorrencia ON ocorrencia_arquivos.idocorrencia_arquivos = ocorrencia.idocorrencia
					            				WHERE ocorrencia_id = $idocorrencia AND  ocorrencia.cadastrado_por = $imobiliaria_idimobiliaria";
					            			} 


					            			$executa_anexo = mysqli_query ($db,$query_anexo) or die ("Erro Ocorrencias");

									        while ($buscar_anexo = mysqli_fetch_assoc($executa_anexo)) {//--verifica se são amigos

									        	$url_anexo       = $buscar_anexo['url_anexo'];
									        	if($url_anexo != ''){

									        		?>    	
									        		<a href="ocorrencias/<?php echo $idocorrencia  ?>/<?php echo $url_anexo ?>">
									        			<i class="fa fa-file" aria-hidden="true"></i></a>
									        		<?php } } ?>

									        	</td>
									        	<td><a href="ocorrencias_tratar.php?idocorrencia=<?php echo $idocorrencia ?>"><span class="label label-success">ABRIR</span></a></td>
									        </tr>

									    <?php } ?>
							</tbody>
						</table>
					</form>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<!-- end #content -->



<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->
</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
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
<script src="https://immobilebusiness.com.br/admin/assets/js/ui-modal-notification.demo.min.js"></script>
<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
	$(document).ready(function() {
		App.init();
		TableManageButtons.init();
		Notification.init();
		FormPlugins.init();

	});
</script>

</body>


</html>
