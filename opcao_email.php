<?php 
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	if (!isset($_SESSION)) {
	  session_start();
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
				<h2 class="page-header">Configurações E-mail automático</h2>
				<div class="panel panel-inverse">	
					<div class="panel-heading">
						<h4 class="panel-title">Escolha uma opção</h4>
					</div>
					<div class="panel-body">
						<ul class="list-group"> 
							<li class="list-group-item"><a class="btn btn-success btn-block" href="config_email.php">Editar Configurações do E-mail</a></li>
							<li class="list-group-item"><a class="btn btn-success btn-block" href="edita_email.php?id=1">Editar E-mail para 10 dias antes do vencimento</a></li>
							<li class="list-group-item"><a class="btn btn-success btn-block" href="edita_email.php?id=2">Editar E-mail para 05 dias antes do vencimento</a></li>
							<li class="list-group-item"><a class="btn btn-success btn-block" href="edita_email.php?id=3">Editar E-mail para o dia do vencimento</a></li>
							<li class="list-group-item"><a class="btn btn-success btn-block" href="edita_email.php?id=4">Editar E-mail para 5 dias após o vencimento</a></li>
							<li class="list-group-item"><a class="btn btn-success btn-block" href="edita_email.php?id=5">Editar E-mail para 10 dias após o vencimento</a></li>
							<li class="list-group-item"><a class="btn btn-success btn-block" href="edita_email.php?id=6">Editar E-mail para 15 dias após o vencimento</a></li>
						</ul>
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
