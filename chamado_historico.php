<?php  
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

$idusuario = $_SESSION['id_usuario'];   // cadastrado por


?>

<!DOCTYPE html>

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
	<!-- ================== END BASE CSS STYLE ================== -->
	<link href="posicionar/style.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.css">
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
		<!-- begin #header -->
		<?php include "topo.php" ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Registro de Atividades dos Chamados</h1>
			<!-- end page-header -->
			
			<!-- begin timeline -->
			<ul class="timeline">


				<?php

				function buscaImagem($idocor_trat){

					include "conexao2.php";


					$query_amigo = "SELECT * FROM chamado_arquivos
					WHERE ocorrencia_tratar_id = '$idocor_trat' ";

                   // echo $query_amigo; die();

					$executa_query2 = mysqli_query ($db,$query_amigo);             

                     $buscar_amigo2 = mysqli_fetch_assoc($executa_query2);//--verifica se são amigos

                     $url_anexo  = $buscar_amigo2['url_anexo'];



                     return $url_anexo;



                 }


                 function buscaStatus($id_status_trat){

                 	include "conexao2.php";


                 	$query_amigo = "SELECT * FROM chamado_status as CS
                 	INNER JOIN chamado_tratar as OT on CS.idstatus = OT.status_tratar
                 	WHERE idstatus = '$id_status_trat' ";

                   // echo $query_amigo; die();

                 	$executa_query2 = mysqli_query ($db,$query_amigo);             

                     $buscar_amigo2 = mysqli_fetch_assoc($executa_query2);//--verifica se são amigos

                     $descricao  = $buscar_amigo2['descricao'];



                     return $descricao;



                 }





                 $id_url_ocorrencia = $_GET["idocorrencia"];

                 $dominio_cliente = $_SERVER['HTTP_HOST'];

                 $dominio = $dominio_cliente;

                 $dominio_cliente = '"'.$dominio_cliente.'"';

                 include "conexao2.php";
                 $query_amigo = "SELECT * FROM chamado as O INNER JOIN 
                 chamado_tratar as OT on O.idocorrencia = OT.ocorrencia_id
                 WHERE dominio = $dominio_cliente  and idocorrencia = $id_url_ocorrencia
                 order by data_tratar desc";


                 $executa_query = mysqli_query ($db,$query_amigo);             

            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

            	$idocorrencia_tratar  = $buscar_amigo['idcorrencia_tratar'];
            	$descricao_tratar     = $buscar_amigo["descricao_tratar"];
            	$atendente_id    	  = $buscar_amigo["atendente_id"];
            	$data_tratar     	  = $buscar_amigo["data_tratar"];
            	$status_ocorrencia    = $buscar_amigo["status_tratar"];
            	$ocorrencia_id        = $buscar_amigo["ocorrencia_id"];

            	$url_anexo            = buscaImagem($idocorrencia_tratar);
   $url_total = "ocorrencias/". $id_url_ocorrencia . "/" .  $idocorrencia_tratar . "/" . $url_anexo;
     
              

            	$descricao_status     = buscaStatus($status_ocorrencia);
           // echo $url_total; die();

            	?>

            	<li>
            		<!-- begin timeline-time -->
            		<div class="timeline-time">
            			<span class="date">Data / Hora</span>
            			<span ><?php echo $data_tratar?></span>
            		</div>


            		<!-- end timeline-time -->
            		<!-- begin timeline-icon -->
            		<div class="timeline-icon">
            			<a href="javascript:;"><i class="fa fa-paper-plane"></i></a>
            		</div>

            		<div class="timeline-body">
<!-- 
#####################################################################################################
-->

<div class="timeline-header">



	<span class="username"><a href="javascript:;"><?php  echo nome_user($atendente_id)?></a> <small></small></span>

	<div class="timeline-content">
		<span class="date">Status Atendimento:</span>
		<span ><?php echo $descricao_status ?></span>
	</div>




	<div class="timeline-content">
		<p>
			<?php echo $descricao_tratar ?>
		</p>
	</div>


  


	<a href="<?php echo $url_total?>" download>

		<?php


		if(!empty($url_anexo) && substr($url_anexo, -3) == "pdf"){


			?>
			<i class="fa fa-file-pdf-o fa-4x" style="color: black" aria-hidden="true"></i>			            		

			<?php
		}else if(!empty($url_anexo) && (substr($url_anexo, -3) == "jpg" || substr($url_anexo, -3) == "png" )){
			?>
			<img src="<?php echo $url_total?>" >

			<?php



		}else if(!empty($url_anexo) &&  (substr($url_anexo, -3) == "xls" || substr($url_anexo, -3) == "lsx" )){
			?>


			<i class="fa fa-file-excel-o fa-4x" style="color: black" aria-hidden="true"></i>


			<?php

		}else if(!empty($url_anexo)){
			?>    

			<i class="fa fa-cloud-download fa-4x" style="color: black" aria-hidden="true"></i>


	   <?php

		}else if(is_null($url_anexo)){}


		?>    



	</a>

</div>


<!-- 
#####################################################################################################
-->



<!-- end timeline-body -->
</li> 





<?php  }?>




</ul>
<!-- end timeline -->
</div>
<!-- end #content -->

<!-- begin theme-panel -->

<!-- end theme-panel -->

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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"></script> 

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
			Timeline.init();
		});
	</script>

</body>


</html>
