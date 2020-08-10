<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

	$idimovel = $_GET["idimovel"];
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
	
	<!-- ================== BEGIN BASE JS ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
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
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
	
	<?php  include "topo.php"; ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
		
				
			<!-- end breadcrumb -->
			<!-- begin page-header -->
		
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">



			    <!-- begin col-6 -->
			    <div class="col-md-12">
					<ul class="nav nav-tabs">
<li class=""><a href="ver_imovel.php?idimovel=<?php echo $idimovel ?>">Resumo</a></li>
<li class=""><a href="visita_imovel.php?idimovel=<?php echo $idimovel ?>">Visitas</a></li>
<li class=""><a href="adicionar_imagem.php?idimovel=<?php echo "$idimovel"; ?>">Galeria de Fotos</a></li>
<li class=""><a href="tour_360.php?idimovel=<?php echo "$idimovel"; ?>">Tour 360</a></li>
<li class=""><a href="video_imovel.php?idimovel=<?php echo "$idimovel"; ?>">Vídeo</a></li>
<li class=""><a href="integracao.php?idimovel=<?php echo "$idimovel"; ?>">Integração Portais</a></li>


<li class="active"><a href="ocorrencias_imovel.php?idimovel=<?php echo $idimovel?>">Ocorrências</a></li>
<li class=""><a href="placa_imovel.php?idimovel=<?php echo $idimovel?>">Placa</a></li>
<li class=""><a href="proprietario_imovel.php?idimovel=<?php echo $idimovel?>">Proprietários</a></li>


					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="default-tab-1">


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
                            <h4 class="panel-title">Ocorrências Cadastradas</h4>
                        </div>
                        
                        <div class="panel-body">
                            <table id="" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Data Ocorrencia</th>
                                         <th>Titulo</th>
                                        <th>Descrição</th>
                                          <th>Status</th>
                                             <th>Abrir</th>
                                       
                                         
                                        
                                    </tr>
                                </thead>

                                      <tbody>
                              	<?php 

								

				include "conexao.php";
				$query = mysqli_query($db,"SELECT * FROM ocorrencia
									  WHERE imovel_id = $idimovel order by idocorrencia desc") or die ("ERRO ao listar ocorrencias"); 


		    while ($buscar = mysqli_fetch_assoc($query)) {//--While categoria
		   
		     $idocorrencia 			= $buscar["idocorrencia"];
		     $titulo 				= $buscar["titulo"];
		     $data_ocorrencia     	= $buscar["data_ocorrencia"];
		     $descricao     		= $buscar["descricao"];
		     $cadastrado_por     	= $buscar["cadastrado_por"];
		     $status_ocorrencia     = $buscar["status_ocorrencia"];
		 
		   
		 if($status_ocorrencia == 1){
            	$status_mostrar = '<span class="label label-primary">ABERTA</span>';
            }elseif($status_ocorrencia == 2){
            	$status_mostrar = '<span class="label label-success">EM ANDAMENTO</span>';
            }elseif($status_ocorrencia == 3){
            	$status_mostrar = '<span class="label label-warning">FINALIZADA PELO ATENDENTE</span>';

            }else{
            	$status_mostrar = '<span class="label label-danger">FINALIZADA</span>';

            }



													?>

                          
                                    <tr class="odd gradeX">
                                        <td><?php echo $data_ocorrencia ?> - <?php echo nome_user($cadastrado_por); ?></td>
                                        <td><?php echo $titulo ?></td>
                                        <td><?php echo $descricao ?></td>
                                        <td><?php echo $status_mostrar ?></td>
                                    <td><a href="ocorrencias_tratar.php?idocorrencia=<?php echo $idocorrencia ?>"><span class="label label-success">ABRIR</span></a></td>
                                    </tr>
                                   <?php } ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
						</div>




<!-- inicio da aba de parcelas -->


						<div class="tab-pane fade" id="default-tab-2">
							


						</div>
						<div class="tab-pane fade" id="default-tab-3">
							
						</div>
					</div>
					
				</div>
			    <!-- end col-6 -->
			 
			</div>
			<!-- end row -->
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
	
<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
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
