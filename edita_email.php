<?php 
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	if (!isset($_SESSION)) {
	  session_start();
	}
?>
<?php
	include "conexao.php";
	
	$confirma = 0;

	//Atualiza o modelo do e-mail
	if(isset($_POST['conteudo'])){
		$aux = $_POST['conteudo'];
		$id = $_GET['id'];

		switch ($id){
			case 1:
				1 == mysqli_query($db, "UPDATE config_email SET avencer_10 = '$aux' WHERE id = 1") ? $confirma = 1 : $confirma = 5;
				break;
			case 2:
				1 == mysqli_query($db, "UPDATE config_email SET avencer_5 = '$aux' WHERE id = 1") ? $confirma = 1 : $confirma = 5;
				break;
			case 3:
				1 == mysqli_query($db, "UPDATE config_email SET avencer_0 = '$aux' WHERE id = 1") ? $confirma = 1 : $confirma = 5;
				break;
			case 4:
				1 == mysqli_query($db, "UPDATE config_email SET venceu_5 = '$aux' WHERE id = 1") ? $confirma = 1 : $confirma = 5;
				break;
			case 5:
				1 == mysqli_query($db, "UPDATE config_email SET venceu_10 = '$aux' WHERE id = 1") ? $confirma = 1 : $confirma = 5;
				break;
			case 6:
				1 == mysqli_query($db, "UPDATE config_email SET venceu_15 = '$aux' WHERE id = 1") ? $confirma = 1 : $confirma = 5;
				break;
			default:
				break;
		}
	}


	//exibe o modelo cadastrado no campo de texto
	if(isset($_GET["id"])){
		$id = $_GET["id"];

		switch ($id){
			case 1:
				$aux ="10 dias para vencer!"; 
				$executa = mysqli_query($db,"SELECT avencer_10 FROM config_email");
				$busca = mysqli_fetch_assoc($executa);
				$email_html = $busca['avencer_10'];

				break;
			case 2:
				$aux ="5 dias para vencer!";
				$executa = mysqli_query($db,"SELECT avencer_5 FROM config_email");
				$busca = mysqli_fetch_assoc($executa);
				$email_html = $busca['avencer_5'];
				break;
			case 3:
				$aux ="0 dias para vencer!";
				$executa = mysqli_query($db,"SELECT avencer_0 FROM config_email");
				$busca = mysqli_fetch_assoc($executa);
				$email_html = $busca['avencer_0'];
				break;
			case 4:
				$aux ="Venceu a 5 dias!";
				$executa = mysqli_query($db,"SELECT venceu_5 FROM config_email");
				$busca = mysqli_fetch_assoc($executa);
				$email_html = $busca['venceu_5'];
				break;
			case 5:
				$aux ="Venceu a 10 dias!";
				$executa = mysqli_query($db,"SELECT venceu_10 FROM config_email");
				$busca = mysqli_fetch_assoc($executa);
				$email_html = $busca['venceu_10'];
				break;
			case 6:
				$aux ="Venceu a 15 dias!";
				$executa = mysqli_query($db,"SELECT venceu_15 FROM config_email");
				$busca = mysqli_fetch_assoc($executa);
				$email_html = $busca['venceu_15'];
				break;
			default:
				$email_html = " ";
				break;
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
		<link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/animate.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
		<link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />
		<!-- ================== END BASE CSS STYLE ================== -->
		
		<!-- ================== BEGIN PAGE CSS ================== -->
		<link href="https://immobilebusiness.com.br/admin/assets/plugins/summernote/summernote.css" rel="stylesheet" />
		<!-- ================== END PAGE CSS ================== -->
		
		<!-- ================== BEGIN BASE JS ================== -->
		<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
		<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=shgcpb5mcjj2aclo6xy02pw1nff4235ewyrdu7x558wq6xcs"></script>
		<script>
		  	tinymce.init({
				selector: "textarea",  // change this value according to your HTML
				plugins: "print code",
				height : 400,
				menubar: "file ",
				toolbar: "print | code| newdocument| undo| redo| visualaid| cut| copy| paste| selectall| bold| italic| underline|strikethrough| subscript| superscript| removeformat| formats | alignleft aligncenter alignright"
			});
		</script>
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
				<!-- begin breadcrumb -->
				<?php 

					//Função para mostrar uma div de sucesso de cadastro.
					if($confirma == 1){ ?>
						<div class="alert alert-success fade in m-b-15">
							<strong><font>Sucesso!</font></strong>

							<font>
								Suas alterações foram salvas.
							</font>

							<span class="close" data-dismiss="alert" ><font>X</font></span>

						</div>
					<?php }else if($confirma == 5){ ?>
						<div class="alert alert-danger fade in m-b-15">
							<strong><font>Não foi possível salvar os dados!</font></strong>

							<font>
								Suas alterações não foram salvas.
							</font>

							<span class="close" data-dismiss="alert" ><font>X</font></span>

						</div>
					<?php }
				?>
				<!-- end breadcrumb -->
				<!-- begin page-header -->
				<h1 class="page-header">Cadastro E-mail</h1>
				<!-- end page-header -->
				
				<!-- begin row -->
				<div class="row">
					<!-- begin col-2 -->
					<div class="col-md-2">
						<h4 >Dados do Contrato / Cliente</h4>
						<div><b class="text-inverse">Cliente</b></div>
						<p>
							@email_cli</br>
							@nome_cli,</br>
							@cpf_cli,</br>
							@cidade_cli,</br>
							@endereco_cli,</br>
							@numero_casa_cli,</br>
							@bairro_cli,</br>
							@telefone_cli,</br>
							@falta_qnt_dias
						</p>

						<div><b class="text-inverse">Empreendimento</b></div>
						<p>
							@nome_empreendimento 
						</p>
						<div><b class="text-inverse">Data</b></div>
						<p>
							@data_vencimento
							@data_venda
						</p>

					</div>
					<!-- end col-2 -->

					<div class="col-md-10">
						<div class="panel panel-inverse m-b-0">
							<div class="panel-heading">
								<h4 class="panel-title"> E-mail:  <?php  echo isset($aux)? $aux : '' ;?> </h4>
							</div>
						</div>
					</div>

					<!-- begin col-10 -->
					<div class="col-md-10">
						<div class="panel panel-inverse m-b-0">
							<div class="panel-heading">
								<h4 class="panel-title">Editar E-mail: <?php  echo isset($aux)? $aux : '' ;?></h4>
							</div>
							<div class="panel-body p-0">
								<form action="#" method="POST" name="formulario">
									<textarea class="conteudo" name="conteudo"> <?php  echo isset($email_html)? $email_html: ''; ?></textarea>
									<input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success"/>
								</form>
							</div>
						</div>
					</div>
					<!-- end col-10 -->
				</div>
				<!-- end row -->
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
			<script src="https://immobilebusiness.com.br/admin/assets/plugins/summernote/summernote.min.js"></script>
			<script src="https://immobilebusiness.com.br/admin/assets/js/form-summernote.demo.min.js"></script>
			<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
			<!-- ================== END PAGE LEVEL JS ================== -->
		</div>

		<script>
			$(document).ready(function() {
				App.init();
				FormSummernote.init();
			});
		</script>
	</body>
</html>
