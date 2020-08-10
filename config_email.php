<?php 
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	include "protege_professor.php";
	if (!isset($_SESSION)) {
	  session_start();
	}
?>

<?php
	include "conexao.php";

	// Auxiliar usada para confirmação de cadastro
	$aux = 0;

	if(isset($_GET["id"])){

		//Insere na Tabela empreendimento_cadastro o status do email referente a cada empreendimento
		$query = mysqli_query($db, "SELECT * FROM empreendimento_cadastro");

		while ($executaQuery = mysqli_fetch_assoc($query)) {

			$idempreendimento = $executaQuery["idempreendimento_cadastro"];
			if(isset($_POST[$idempreendimento])){
				mysqli_query($db, "UPDATE empreendimento_cadastro SET auto_email = 1 WHERE idempreendimento_cadastro = '$idempreendimento' ");
			}else{
				mysqli_query($db, "UPDATE empreendimento_cadastro SET auto_email = 0 WHERE idempreendimento_cadastro = '$idempreendimento' ");
			}
		}
		

		$host = $_POST["host_geral"];
		$host_email = $_POST["host_email"];
		$email_rem = $_POST["email_rem"];
		$senha = $_POST["senha"];
		$port = $_POST["port"];
		$email_desc = $_POST["email_desc"];
		$email_resp = $_POST["email_resp"];
		$email_desc_resp = $_POST["email_desc_resp"];

		$executaQuery = mysqli_query($db, "UPDATE config_email SET url_cliente = '$host', host = '$host_email', port = '$port', username = '$email_rem', password = '$senha',
					remetente_desc ='$email_desc', resposta_email = '$email_resp', resposta_desc = '$email_desc_resp' WHERE id = 1 " ) or die (mysqli_error());;

		if($executaQuery == 1){
			$aux = 1;
		}else{
			$aux = 5;
		}
	}

	// Código para preencher os campos do formulário com os dados do banco
	$executaQuery = mysqli_query($db, "SELECT * FROM config_email");

	while ($recebe = mysqli_fetch_assoc($executaQuery)) {
		$mostra_url = $recebe["url_cliente"];
		$mostra_host = $recebe["host"];
		$mostra_port = $recebe["port"];
		$mostra_username = $recebe["username"];
		$mostra_password = $recebe["password"];
		$mostra_remetente_desc = $recebe["remetente_desc"];
		$mostra_email_resposta = $recebe["resposta_email"];
		$mostra_desc_resposta = $recebe["resposta_desc"];
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

					//Função para mostrar uma div de sucesso de cadastro.
					if($aux == 1){ ?>
						<div class="alert alert-success fade in m-b-15">
							<strong><font>Sucesso!</font></strong>

							<font>
								Suas alterações foram salvas.
							</font>

							<span class="close" data-dismiss="alert" ><font>X</font></span>

						</div>
					<?php }else if($aux == 5){ ?>
						<div class="alert alert-danger fade in m-b-15">
							<strong><font>Não foi possível salvar os dados!</font></strong>

							<font>
								Suas alterações não foram salvas.
							</font>

							<span class="close" data-dismiss="alert" ><font>X</font></span>

						</div>
					<?php }
				?>
					<h3 class="title"> Dados do servidor do E-mail</h3>
					<p></p>
					<form class="form-action" action="config_email.php?id=1" method="POST" name="envia_email">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								    <label for="host_geral">URL Do Cliente</label>
								    <input type="text" class="form-control" name="host_geral" placeholder="http://hrsantos.com.br" value="<?php echo $mostra_url ?>" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						   			<label for="host_email">Host do E-mail</label>
						    		<input type="text" class="form-control" name="host_email" placeholder="br808.hostgator.com.br" value="<?php echo $mostra_host ?>" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								    <label for="email_rem">E-mail do Usuário</label>
								    <input type="email" class="form-control" name="email_rem" placeholder="exemplo@exeplo.com" value="<?php echo $mostra_username ?>" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								    <label for="senha">Senha do Usuário</label>
								    <input type="password" class="form-control senha" name="senha" placeholder="Senha do Usuário" value="<?php echo $mostra_password ?>" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
						    		<label for="port">Porta do E-mail</label>
						    		<input type="text" class="form-control" name="port" placeholder="Porta do E-mail" value="<?php echo $mostra_port ?>" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								    <label for="email_desc">Assunto do E-mail</label> 
								    <input type="text" class="form-control" name="email_desc" placeholder="Descrição do E-mail do Remetente" value="<?php echo $mostra_remetente_desc ?>" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								    <label for="email_resp">E-mail de Resposta</label>
								    <input type="email" class="form-control" name="email_resp" placeholder="exemplo@exeplo.com required" value="<?php echo $mostra_email_resposta ?>" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								    <label for="email_desc_resp">Assunto do E-mail de resposta</label>
								    <input type="text" class="form-control" name="email_desc_resp" placeholder="Descrição E-mail de Resposta" value="<?php echo $mostra_desc_resposta ?>" required>
								</div>
							</div>
						</div>
						<div class="row">
								<div class="form-group col-md-12">
									<div class="panel panel-inverse overflow-hidden">
										<div class="panel-heading">
											<h3 class="panel-title">
										    	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#1">Empreendimentos Ativos: </a> 
											</h3>
										</div>
									    <div id="1" class="panel-collapse collapse">
										    <ul class="list-gruop">
											    <?php 
											    	$query = mysqli_query($db, "SELECT * FROM empreendimento_cadastro");

											    	while ($executaQuery = mysqli_fetch_assoc($query)) {
											    		$empreendimento = $executaQuery["descricao_empreendimento"];
											    		$idempreendimento = $executaQuery["idempreendimento_cadastro"];
											    		$status = $executaQuery["auto_email"];
											    	?>
										    		<li class="list-group-item"><input type="checkbox"  name="<?php echo $idempreendimento ?>" value="1" <?php echo $status == 1 ? "checked" : ""; ?>> <?php echo $empreendimento ?></li>

												<?php	}

											    ?>
										   	</ul>
									   	</div>
							   		</div>
						   		</div>
						</div>
				
						<input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success"/>
					</form>
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
