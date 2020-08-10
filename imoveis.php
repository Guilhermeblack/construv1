<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

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
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
<?php
function nome_imov_tipo($idtipo){
                include "conexao.php";
                $query_amigo = "SELECT * FROM imov_tipo
                                WHERE idtipo = $idtipo";
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar tipo");

                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {           
                $descricao_zap  = $buscar_amigo['descricao_zap'];
                }

return $descricao_zap;
}
?>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<?php include "topo.php"; ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
			<li><a href="email_mkt.php"><span class="label label-primary" style="font-size:100% !important">Enviar Email</span></a></li>
			

			<?php if (in_array('17', $idrota)) { ?>	
			<li><a href="cadastro_imovel.php"><span class="label label-primary" style="font-size:100% !important">NOVO IMÓVEL</span></a></li>
			<?php } ?>

			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"> <small>Imóveis</small></h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
             
                <!-- begin col-6 -->

				<?php if (in_array('16', $idrota)) { ?>	
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
                            <h4 class="panel-title">Imóveis Cadastrados</h4>
                        </div>

                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Imagem</th>
                                        <th>Info</th>
                                        <th>Ref</th>
                                          <th>Status do Imóvel</th>
                                       <th>Destacar?</th>
                                        <th>Exibir no site?</th>

                                    
                                        <th>Ver Imóvel</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 

                include "conexao.php";
				if (in_array('49', $idrota)) {          
                 	$query_slide = ("SELECT * FROM imovel order by idimovel desc") or die ("Erro ao listar imoveis, tente mais tarde"); 
            	}else
            	{
            		$query_slide = ("SELECT * FROM imovel where imobiliaria_idimobiliaria = $imobiliaria_idimobiliaria order by idimovel desc") or die ("Erro ao listar imoveis, tente mais tarde"); 
            	}

            	$executa_imovel = mysqli_query($db, $query_slide);

            while ($buscar_slide = mysqli_fetch_assoc($executa_imovel)) {//--While categoria
           
            $idimovel        = $buscar_slide["idimovel"];
            $ref             = $buscar_slide["idimovel"];
            $slide           = $buscar_slide["slide"];
            $img_principal   = $buscar_slide["img_principal"];
            $cod_imov_tipo 	 = $buscar_slide["cod_imov_tipo"];
            $finalidade   	 = $buscar_slide["finalidade"];
            $endereco   	 = $buscar_slide["endereco"];
            $numero   		 = $buscar_slide["numero"];
			$bairro   		 = $buscar_slide["bairro"];
            $site   		 = $buscar_slide["site"];
            $status          = $buscar_slide["status"];

            $nome_imov_tipo = nome_imov_tipo($cod_imov_tipo);

                    ?> 
                                
                                   <tr class="odd gradeX">
                                        <td><img src="fotos/<?php echo $idimovel ?>/<?php echo $img_principal ?>" width="70" height="50" /></td>
                                        <td><?php echo "$nome_imov_tipo " ?>-<?php echo " $finalidade " ?>-<?php echo " $endereco ".", "."$numero "."$bairro" ?></td>
                                        <td><?php echo $ref ?></td>
                                        <td>
                                        <?php if($status == 1 or $status == 0){  ?>
                                        <span class="badge badge-success badge-square">Disponivel</span>
                                        <?php } ?>

                                         <?php if($status == 2){  ?>
                                        <span class="badge badge-warning badge-square">Reservado</span>
                                         <?php } ?>

                                         <?php if($status == 3){  ?>
                                        <span class="badge badge-danger badge-square">Indisponivel</span>
                                         <?php } ?>


                                        </td>
                                        <?php 

                                        if($slide == 1){

                                        ?>

                                        <td><a href="alterar_slide.php?idimovel=<?php echo "$idimovel"; ?>&op=0"><span class="badge badge-success">Sim</span></a> </td>
                                        <?php }else{ ?>


                                        <td><a href="alterar_slide.php?idimovel=<?php echo "$idimovel"; ?>&op=1"><span class="badge badge-danger">Não</span></a> </td>
                                        <?php } ?>




                                          <?php 

                                        if($site == 1){

                                        ?>

                                        <td><a href="alterar_site.php?idimovel=<?php echo "$idimovel"; ?>&op=0"><span class="badge badge-success">Sim</span></a> </td>
                                        <?php }else{ ?>


                                        <td><a href="alterar_site.php?idimovel=<?php echo "$idimovel"; ?>&op=1"><span class="badge badge-danger">Não</span></a> </td>
                                        <?php } ?>








                                        <td>
                                        	
                                        	<a href="ver_imovel.php?idimovel=<?php echo $idimovel ?>"><button type="button" class="btn btn-success"><i class="fa fa-edit"></i>Abrir</button></a>
                                        </td>


                                       

                                    </tr>

                                    <?php } ?>


                                   





                                 
                                </tbody>

                            </table>
                        </div>
                    </div>
               
            </div>
          <?php } ?>
          
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

	<!-- ================== END PAGE LEVEL JS ================== -->
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
