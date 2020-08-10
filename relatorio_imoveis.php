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

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/gallery.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:18:58 GMT -->
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
  	<link href="https://immobilebusiness.com.br/admin/assets/plugins/isotope/isotope.css" rel="stylesheet" />
  	<link href="https://immobilebusiness.com.br/admin/assets/plugins/lightbox/css/lightbox.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
	
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<?php include "topo.php" ?>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			
			<!-- end page-header -->
		Legenda: 	<span class="label label-danger">Vendido</span>
					<span class="label label-warning">Reservado</span>
					<span class="label label-success">Disponivel</span>
					<span class="label label-inverse">Bloqueado</span>
<br><br>

<h1 class="page-header">Selecione a Quadra </h1>
            <div id="options" class="m-b-10">
                <span class="gallery-option-set" id="filter" data-option-key="filter">
                    <a href="#show-all" class="btn btn-default btn-xs active" data-option-value="*">
                        Todos
                    </a>
                    <a href="#Casa" class="btn btn-default btn-xs" data-option-value=".Casa">
                        Casa
                    </a>
                    <a href="#Apartamento" class="btn btn-default btn-xs" data-option-value=".Apartamento">
                       Apartamento
                    </a>
                    <a href="#Terreno" class="btn btn-default btn-xs" data-option-value=".Terreno">
                        Terreno
                    </a>
                    <a href="#Sobrado" class="btn btn-default btn-xs" data-option-value=".Sobrado">
                        Sobrado
                    </a>


                </span>
            </div>
            <div id="gallery" class="gallery">

             <?php

                      include_once "conexao.php";
                $query_amigo = "SELECT * FROM imovel Order by tipo, idimovel";

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
           
             $tipo       = $buscar_amigo['tipo'];
             $finalidade         = $buscar_amigo["finalidade"];
          	 $preco       = $buscar_amigo["preco"];
              $ref       = $buscar_amigo["ref"];
                $img_principal       = $buscar_amigo["img_principal"];
            

                if($status == 0){

                	$style = 'background-color:#f59c1a !important; color:#FFFFFF !important';
                }else if($status == 1){
                	$style = 'background-color:#00acac !important; color:#FFFFFF !important';

                }else if($status == 2){
                	$style = 'background-color:#ff5b57 !important; color:#FFFFFF !important';
                	
                }else if($status == 3){
                	$style = 'background-color:#2d353c !important; color:#FFFFFF !important';
                	
                }

             ?>


                <div class="image <?php echo " $quadra" ?>">
                    <div class="image-inner">
                        <a href="fotos/principal/<?php echo $img_principal ?>" data-lightbox="gallery-group-1">
                            <img src="https://immobilebusiness.com.br/admin/assets/img/gallery/gallery-1.jpg" alt="" />
                        </a>
                        <p class="image-caption">
                            #<?php echo $quadra ?>
                        </p>
                    </div>
                    <div class="image-info" style="<?php echo $style; ?>">
                        <h5 class="title"> <br></h5>
                        <div class="pull-right">
                           <big> Lote: <?php echo " $lote" ?></big>
                        </div>
                        <div class="rating">
                            <br>
                        </div>
                        <div class="desc">
                          M²:  <?php echo " $m2" ?> <br>
                          Valor: <?php echo 'R$ ' . number_format($valor, 2, ',', '.');  ?> <br>
                        </div>
                    </div>
                </div>
       <?php } ?>
                </div>
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
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/isotope/jquery.isotope.min.js"></script>
  	<script src="https://immobilebusiness.com.br/admin/assets/plugins/lightbox/js/lightbox-2.6.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/gallery.demo.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			Gallery.init();
		});
	</script>
<script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','../../../../www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-53034621-1', 'auto');
      ga('send', 'pageview');

    </script>
</body>

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/gallery.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:19:59 GMT -->
</html>
