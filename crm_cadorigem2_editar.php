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
	<script type="text/javascript"> 


			function excluir(){

				document.nome.action = "crm_excluirorigem.php";
				document.nome.submit();

			}

			

		</script>

		<!-- begin #page-loader -->
		<div id="page-loader" class="fade in"><span class="spinner"></span></div>
		<!-- end #page-loader -->
		
		<!-- begin #page-container -->
		<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
			<!-- begin #header -->
			
			<?php 
			include "topo.php";
			//echo $_SERVER['HTTP_REFERER']; 

			 
			$iid = $_GET["id"];

			include "conexao.php";
			$query_slide = mysqli_query($db,"SELECT * FROM crm_origem WHERE crm_idorigem = $iid ") or die ("Erro ao listar grupo dos clientes, tente mais tarde");

    while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

    	$id          = $buscar_slide["crm_idorigem"];
    	$desc          = $buscar_slide["crm_origemnome"];
    	
    	
}
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
				<!-- begin col-10 -->
				<div class="col-md-6">
					<div class="panel panel-inverse m-b-0">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title">Cadastro Origem</h4>
						</div>
						<div class="panel-body">
							<form action="crm_salvaorigem.php?edit=<?php echo $id ;?>" method="POST">
								<div id="wizard">									

									<!-- begin wizard step-3 -->
									<div>
										<fieldset>

											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Nome da Origem</label>
														<input type="text" name="nome_origem" placeholder="Atendimento" class="form-control" required="" value="<?php echo $desc ; ?>" />
														
													</div>
													<button type="submit" class="btn btn-sm btn-primary">Editar</button>
												</div>
											</div>
										</fieldset>

										

										

									</div>
									<!-- end wizard step-3 -->



								</div>
							</form>


						</div>

					</div>
				

				</div>
				<!-- end col-10 -->


			
			<!-- end row -->

	<!-- begin row -->
				

					<!-- begin col-10 -->
					<div class="col-md-6">
						<!-- begin panel -->
						<div class="panel panel-inverse">
							<div class="panel-heading">
								<div class="panel-heading-btn">
									<?php if (in_array('61', $idrota)) { ?>
									<a href="#" onclick="javascript: if (confirm('Você realmente deseja excluir este cadastro?')) excluir()"><span class="label label-danger">EXCLUIR</span></a>
									<?php } ?>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
								</div>
								<h4 class="panel-title">Informações dos Leads</h4>
							</div>

							<div class="panel-body">
								<form action="#" method="POST" id="nome" name="nome">

									<table id="data-table" class="table table-striped table-bordered">
										<thead>
											<tr>
												
												<th>ID</th>
												<th>Origem</th>
												<?php if (in_array('60', $idrota)) { ?>
													<th>Ações</th>
													<?php } ?>
												
											</tr>
										</thead>
										<tbody>

											<?php

											include "conexao.php";

											//inner join para mostrar o nome da origem e nao o ID.
											$query_amigo = "SELECT * FROM crm_origem order by crm_idorigem";
											$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar contatos");

	            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

	            	$id               	= $buscar_amigo['crm_idorigem'];
	            	$nome               = $buscar_amigo["crm_origemnome"];
	            	$cont_cli			+= 1;

	            	?>

	            	<tr class="odd gradeX">

	            		
	            		<td><?php echo $id ?></td>
	            		<td><?php echo $nome ?></td>
	            		<?php if (in_array('60', $idrota)) { ?><td>
                   <input type="hidden" name="editaid" value="<?php echo $id ?>"><a href="crm_cadorigem2_editar.php?id=<?php echo $id ?>"><span class="label label-warning">Editar</span></a>         
</td><?php } ?>	
	            	</tr>
	            	<?php $cont = $cont + 1;

	            } ?>
	        </tbody>
	    </table>
	</form>
	</div>
	</div>
	<!-- end panel -->
	</div>
	<!-- end col-10 -->
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
<script type="text/javascript"> 

	document.getElementById('menucrm').style.display="block";

</script>
			<script>
				$(document).ready(function() {
					App.init();
					FormSummernote.init();
				});
			</script>

	</body>


	</html>
