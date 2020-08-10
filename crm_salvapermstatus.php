<?php
 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";



if(isset($_POST["permissao"])){

	$idgrupo 	= $_GET["idgrupo"];
	$permissao 	= $_POST["permissao"];

	include "conexao.php";

	$insere_grupo = mysqli_query($db,"DELETE FROM crm_grupostatus WHERE crm_idgrupo = '$idgrupo'");


	foreach($permissao as $idrota){
	
		$insere_permissao_grupo = mysqli_query($db,"INSERT INTO crm_grupostatus(crm_idgrupo, crm_statusid) values ('$idgrupo','$idrota')");
		
	}

	mysql_close("conexao.php");
	?>
	<script>
		window.location="crm_permstatus.php?cad=1";
	</script>
	<?php 
}  	
 ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html>
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
	<?php 
function busca_permissao($idgrupo, $idrota){
	include "conexao.php";
    $query_amigo = "SELECT * FROM crm_grupostatus WHERE crm_idgrupo = $idgrupo AND crm_statusid = '$idrota'";
    $executa_query = mysqli_query ($db, $query_amigo);

    $total = mysqli_num_rows($executa_query);

    return $total;
}
?>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		

		<?php include "topo.php"; ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->

			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Permissão de Acesso Por Status</h1>
			<!-- end page-header -->
			<?php if(isset($_GET["ok"])){ ?>
				<div class="alert alert-success fade in m-b-15">
					<strong><font><font>Sucesso! </font></font></strong><font><font>
						Suas alterações foram salvas.
					</font></font><span class="close" data-dismiss="alert"><font><font>×</font></font></span>
				</div>
			<?php } ?>
			<!-- begin row -->
			<div class="row">

				<!-- begin col-10 -->
				<div class="col-md-12">
					<!-- begin panel -->
					<div class="panel panel-inverse">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title">Lista de Status</h4>
						</div>

						<div class="panel-body">



							<?php                 $idgrupo = $_GET["idgrupo"]; ?>




							<form action="crm_salvapermstatus.php?ok=1&idgrupo=<?php echo $idgrupo; ?>" method="POST">
								<table id="" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Descrição</th>                                        
										</tr>
									</thead>
									<tbody>


										<tr class="odd gradeX">

<input type="hidden" name="permissao[]" value="0">
											<?php



											include "conexao.php";

											$cont = 1;
											$query_amigo = "SELECT * FROM crm_status ORDER BY crm_status asc";
											$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar rotas");


            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

            	$idrotas          = $buscar_amigo['crm_idstatus'];
            	$titulo           = $buscar_amigo["crm_status"];

            	$busca_permissao = busca_permissao($idgrupo, $idrotas);
            	?>


            	<td><input type="checkbox" name="permissao[]" 
            		<?php if($busca_permissao != ''){ ?> checked <?php } ?>
            		value="<?php echo $idrotas ?>"><?php echo $titulo ?></td>


            	<?php

            	if($cont == 3){ ?>  </tr><tr>  

            		<?php 
            		$cont = 0;
            	}
            	$cont = $cont + 1;
            } ?>

        </tr>
        <tr><td colspan="3"><input type="submit" class="btn btn-success" name="Gravar" value="Gravar"></tr>
        </tbody>
    </table>
</table>
</div>
</div>
<!-- end panel -->
</div>
<!-- end col-10 -->
</div>
<!-- end row -->
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
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageButtons.init();
		});
	</script>

</body>

</html>
