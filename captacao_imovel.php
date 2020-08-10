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
	<title>Immobile Business</title>
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
		
	<?php include "topo.php" ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Captação de Imovel <small>Lista de documentos</small></h1>
			<!-- end page-header -->
			
	
			
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="ui-icons-7">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Clique no documento para Imprimir</h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered m-b-0">
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><div><a href="documentos/andar-corporativo.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Andar Corporativo</a></div></td>
                                             <td class="text-center"><div><a href="documentos/captacao_apartamento.pdf"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Apartamento</a></div></td>
                                              <td class="text-center"><div><a href="documentos/apartamento_duplex.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Apartamento Duplex</a></div></td>
                                               <td class="text-center"><div><a href="documentos/apartamento_garden.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Apartamento Garden</a></div></td>
                                                <td class="text-center"><div><a href="documentos/apartamento_triplex.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Apartamento Triplex</a></div></td>
                                                 <td class="text-center"><div><a href="documentos/area.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Área</a></div></td>
                                                  <td class="text-center"><div><a href="documentos/bangalo.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Bangalô</a></div></td>
                                                   <td class="text-center"><div><a href="documentos/barracao.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Barracão</a></div></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><div><a href="documentos/box_garagem.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Box/Garagem</a></div></td>
                                             <td class="text-center"><div><a href="documentos/casa.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Casa</a></div></td>
                                              <td class="text-center"><div><a href="documentos/chacara.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Chácara</a></div></td>
                                               <td class="text-center"><div><a href="documentos/cobertura.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Cobertura</a></div></td>
                                                <td class="text-center"><div><a href="documentos/conjunto.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Conjunto</a></div></td>
                                                 <td class="text-center"><div><a href="documentos/edicula.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Edicula</a></div></td>
                                                  <td class="text-center"><div><a href="documentos/fazenda.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Fazenda</a></div></td>
                                                   <td class="text-center"><div><a href="documentos/flet.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Flet</a></div></td>
                                        </tr>
                                        <tr>
                                           <td class="text-center"><div><a href="documentos/galpao.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Galpão</a></div></td>
                                             <td class="text-center"><div><a href="documentos/haras.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Haras</a></div></td>
                                              <td class="text-center"><div><a href="documentos/hotel.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Hotel</a></div></td>
                                               <td class="text-center"><div><a href="documentos/ilha.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Ilha</a></div></td>
                                                <td class="text-center"><div><a href="documentos/kitnet.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Kitnet</a></div></td>
                                                 <td class="text-center"><div><a href="documentos/laje.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Laje</a></div></td>
                                                  <td class="text-center"><div><a href="documentos/loft.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Loft</a></div></td>
                                                   <td class="text-center"><div><a href="documentos/loja.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Loja</a></div></td>
                                        </tr>
                                        <tr>
                                             <td class="text-center"><div><a href="documentos/pavilhao.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Pavilhão</a></div></td>
                                             <td class="text-center"><div><a href="documentos/penthouse.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Penthouse</a></div></td>
                                              <td class="text-center"><div><a href="documentos/ponto.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Ponto</a></div></td>
                                               <td class="text-center"><div><a href="documentos/pousada.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Pousada</a></div></td>
                                                <td class="text-center"><div><a href="documentos/predio.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Prédio</a></div></td>
                                                 <td class="text-center"><div><a href="documentos/rancho.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Rancho</a></div></td>
                                                  <td class="text-center"><div><a href="documentos/resort.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Resort</a></div></td>
                                                   <td class="text-center"><div><a href="documentos/sala.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Sala</a></div></td>
                                        </tr>
                                        <tr>
                                          
                                             <td class="text-center"><div><a href="documentos/salao.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Salão</a></div></td>
                                              <td class="text-center"><div><a href="documentos/sitio.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Sitio</a></div></td>
                                               <td class="text-center"><div><a href="documentos/sobrado.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Sobrado</a></div></td>
                                                <td class="text-center"><div><a href="documentos/studio.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Studio</a></div></td>
                                                 <td class="text-center"><div><a href="documentos/terreno.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Terreno</a></div></td>
                                                  <td class="text-center"><div><a href="documentos/vilage.php"><i class="fa fa-2x fa-file-word-o"></i></div><div class="hidden-xs">Vilage</a></div></td>
                                                
                                        </tr>
                                      
                                    
                                    
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end panel -->
			    </div>
			    <!-- end col-12 -->
			</div>
			<!-- end row -->
			<!-- begin row -->
			
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
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>


</html>
