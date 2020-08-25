<?php 
  //error_reporting(0);
  //ini_set(“display_errors”, 0 );
include "protege_professor.php";

if(isset($_POST["titulo"])){

	include "conexao.php";
	date_default_timezone_set('America/Sao_Paulo');
	$empreendimento_id     = $_POST["empreendimento_id"];
	$descricao             = $_POST["descricao"];
	$titulo                = $_POST["titulo"];
	$cadastrado_por        = $_POST["cadastrado_por"];
	$ocorrencia_para       = $_POST["cliente_idcliente"];
	$ocorrencia_para_grupo = $_POST["grupo_idgrupo"];

	$data_ocorrencia    = date('d-m-Y H:i:s');
	$status_ocorrencia  = '1';

	$inserir = mysqli_query($db, "INSERT INTO ocorrencia(titulo, descricao, cadastrado_por, data_ocorrencia, status_ocorrencia, ocorrencia_para, imovel_id, empreendimento_id, quadra_id, lote_id, ocorrencia_para_grupo) values ('$titulo','$descricao','$cadastrado_por','$data_ocorrencia','$status_ocorrencia','$ocorrencia_para','0','$empreendimento_id','','', '$ocorrencia_para_grupo')");


	$ultimo_id = mysqli_insert_id($db);


	$pasta = "ocorrencias/".$ultimo_id."/";
	if(!file_exists($pasta)){
		mkdir($pasta);
	}


	foreach($_FILES["img"]["error"] as $key => $error){

		if($error == UPLOAD_ERR_OK){
			$tmp_name = $_FILES["img"]["tmp_name"][$key];
			$cod     = $_FILES["img"]["name"][$key];

			$extensao = explode(".", $cod);
		    $parte1   =  $extensao[0]; // piece1
		    $parte2   =  ".".$extensao[1]; // piece2


		    $novo_nome =  rand(1, 15);
		    $pasta_g   = $novo_nome.$parte2;
		    $pasta2    = $pasta.$novo_nome.$parte2;

		    $nome    = $_FILES["img"]["name"][$key];
		    $uploadfile = $pasta . basename($cod);

		    $mover = move_uploaded_file($tmp_name, $uploadfile);

		    $trocando_nome = rename($uploadfile, $pasta2);

		    $inserir = mysqli_query ($db,"INSERT INTO ocorrencia_arquivos (ocorrencia_id, descricao, url_anexo) values ('$ultimo_id','$descricao','$pasta_g')") or die ("ERRO AO ANEXAR ARQUIVO.");

		}
	}

?>

<script type="text/javascript">
	window.location="sistema_ocorrencia.php";
</script>
<?php 

 }
 ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Immobile | Business</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
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
	<script>
		function ShowHideDIV(){

			Valor = document.getElementById("tipo_cobranca").value;

			if (Valor=="2") 
			{
				document.getElementById('locacao').style.display    = "none"
				document.getElementById('teste').style.display      = "block"
				document.getElementById('quadra2').style.display    = "block"
				document.getElementById('lote32').style.display     = "block"

			}
			else
			{
				document.getElementById('locacao').style.display    = "block"
				document.getElementById('teste').style.display      = "none"
				document.getElementById('quadra2').style.display    = "none"
				document.getElementById('lote32').style.display     = "none"
			}
		}
	</script>

	<div id="page-loader" class="fade in"><span class="spinner"></span></div>

	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">

		<?php  include "topo.php"; 	?>

		<div class="sidebar-bg"></div>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<div class="panel panel-inverse" data-sortable-id="form-plugins-11">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Nova Ocorrência</h4>
				</div>

				<div class="panel-body">
					<form class="form-vertical form-bordered" action="cadastro_ocorrencia.php" method="POST" enctype="multipart/form-data">
						<?php 
							$cadastrado_por = $_SESSION["id_usuario"];
						?>

						<input type="hidden" name="cadastrado_por" value="<?php echo $cadastrado_por ?>">

						<div class="form-group">
							<label class="control-label">Destinatário</label>
							<select class="default-select2 form-control" name="cliente_idcliente" required="">
								<option value="">Escolha</option>
								<?php

								include "conexao.php";

								$query_amigo = "SELECT * FROM cliente
								INNER JOIN cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente
								WHERE idtipo = 11 or idtipo = 4 or idtipo = 12 group by cliente.idcliente order by nome_cli Asc";


								$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
				                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

				                	$idcliente             = $buscar_amigo['idcliente'];
				                	$nome_cli              = $buscar_amigo["nome_cli"];
				                	$cpf_cli              = $buscar_amigo["cpf_cli"];



				                	?>
				                	<option value="<?php echo "$idcliente" ?>"> <?php echo "$nome_cli "."CPF: "."$cpf_cli" ?> </option>
				                <?php } ?>
				            </select>
					    </div>

					    <div class="form-group">
					    	<label class="control-label">Para o Grupo</label>
				    		<select class="default-select2 form-control" name="grupo_idgrupo">
				    			<option value="">Escolha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(opcional)</option>
				    			<?php 

				    			include "conexao.php";
				    			$query_slide = mysqli_query($db,"SELECT * FROM grupo
				    				order by titulo_grupo Asc") or die ("Erro ao listar grupo dos clientes, tente mais tarde"); 


					            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria




					            	$idgrupo       = $buscar_slide["idgrupo"];
					            	$titulo_grupo  = $buscar_slide["titulo_grupo"];



					            	?> 
					            	<option value="<?php echo $idgrupo ?>"><?php echo utf8_encode($titulo_grupo) ?></option>

					            <?php }

					            ?> 
				        	</select>
						</div>

						<div class="form-group">
							<label class="control-label">Empreendimento</label>
							<select class=" form-control" name="empreendimento_id" required="">
								<option value="">Escolha</option>
								<?php

								include "conexao.php";

								$query_amigo = "SELECT * FROM `empreendimento_cadastro`";


								$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");

								if(mysqli_num_rows($executa_query)){
									while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

										?>
										<option value="<?php echo $buscar_amigo['idempreendimento_cadastro'];?>"> <?php echo $buscar_amigo['descricao_empreendimento']; ?> </option>
										<?php
								}
				               
				               } ?>
				            </select>
					    </div>

						<div class="form-group">
							<label class="control-label">Titulo</label>
							<textarea class="form-control" name="titulo"></textarea>
						</div>

						<div class="form-group">
							<label class="control-label">Descrição</label>
							<textarea class="form-control" name="descricao"></textarea>
						</div>

						<div class="form-group">
							<label class="control-label">Anexar Arquivo</label>
							<input type="file" name="img[]" multiple="">
						</div>


						<div class="form-group">
							<input type="submit" class="btn btn-success m-r-5 m-b-5" value="Cadastrar" />
						</div>

				</div>
			</div>
		</div>
	</div>

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

<script>

	$(document).ready(function() {
		App.init();
		TableManageButtons.init();
     FormPlugins.init();
	});
</script>
</body>


</html>
