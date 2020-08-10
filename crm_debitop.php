<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8" />
	<title>Immobile | Business</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets\plugins\jquery-ui\themes\base\minified\jquery-ui.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />

	
	<!-- ================== END BASE CSS STYLE ================== -->

	<link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />

	<!-- ================== BEGIN PAGE CSS ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />

	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	
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

		<?php 
		include "topo.php";
			//echo $_SERVER['HTTP_REFERER']; 
		?>


		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->

			<!-- begin page-header -->
			<h1 class="page-header">CRM | Immoblie</h1>
			<!-- end page-header -->

			<!-- begin row -->
			<div class="row">
				<!-- begin col-2 -->

				<!-- end col-2 -->
				<div class="col-md-8">

					<div class="panel panel-inverse m-b-0">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title">Cadastro Lead <small> Manual</small></h4>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<form class="dropzone" id="addImages" method="POST" enctype="multipart/form-data" name="formodal" action="crm_salvapremio.php">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Nome Prêmio:</label>
												<input type="text" placeholder="Nome do Prêmio" name="npremio" class="form-control" required="" /> 

											</div>

										</div>		
										<div class="col-md-4">
											<div class="form-group">
												<label>Estrelas:</label>
												<input type="number" min="0" max="5" id="data" placeholder="0" name="stars" class="form-control" required="" />

											</div>

										</div>		
										<div class="col-md-4">	
											<div class="form-group">
												<label>Valor:</label>
												<input type="number" min="0" id="vlrpts" name="valorpts" placeholder="pt$" class="form-control" required=""/>
											</div>
										</div>



										<div class="col-md-6">
											<div class="form-group">
												<label>Descrição:</label>
												<textarea placeholder="Descrição do Prêmio." class="form-control" name="descricao" required=""></textarea>
											</div>
										</div> 

										<div class="col-md-6">

											<label>Interesse</label>

											<select class="form-control" name="interessef" id="interesse" >
												<option value="">Escolha</option>


												<?php 
												include "conexao.php";
												$query_c = "SELECT empreendimento_cadastro_id as id, descricao_empreendimento 
												FROM empreendimento
												INNER JOIN empreendimento_cadastro ON empreendimento_cadastro_id = idempreendimento_cadastro

												order by idempreendimento_cadastro desc";
												$executa_queryc = mysqli_query ($db,$query_c) or die ("Erro ao listar empreendimento mesmo");


            while ($buscar_amigoc = mysqli_fetch_assoc($executa_queryc)) {//--verifica se são amigos

            	$id             = $buscar_amigoc['id'];
            	$descricao                   = $buscar_amigoc['descricao_empreendimento'];
            	?>
            	<option value="<?php echo $id ?> "><?php echo $descricao ?></option>
            <?php }  ?>
        </select>


    </div> 

    <div class="col-md-4">
    	<input type="checkbox" name="ativof" value="1" checked> Ativo?

    </div>

    <br>

    <div class="col-md-4">
    	Upload Foto:
    	<div class="fallback"> 
    		<input name="file" type="file" multiple /> 
    	</div>
    </div> 
    <div class="col-md-4">
    	<button type="submit" class="btn btn-sm btn-primary">Cadastrar</button>	
    	<!-- #modal-dialog -->

    </div>

</div>

</form>
</div>
</div>
</div>
</div>
</div>

</div>


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
	<!--[if lt IE 9]>
		<script src="https://immobilebusiness.com.br/admin/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="https://immobilebusiness.com.br/admin/assets/crossbrowserjs/respond.min.js"></script>
		<script src="https://immobilebusiness.com.br/admin/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/morris/raphael.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/morris/morris.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-merc-en.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>

	
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/clipboard/clipboard.min.js"></script>

	<!-- ================== END PAGE LEVEL JS ================== -->
	<script type="text/javascript"> 

		document.getElementById('menucrm').style.display="block";

	</script>
	<script>
		$(document).ready(function() {
			App.init();

		});
	</script>

</body>


</html>
