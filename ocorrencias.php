<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

	$idlocacao = $_GET["idlocacao"];



if(isset($_POST["titulo"])){

	date_default_timezone_set('America/Sao_Paulo');

	$cadastrado_por  	= $_POST["cadastrado_por"];
	$titulo  			= $_POST["titulo"];
	$descricao 			= $_POST["descricao"];
	$data_ocorrencia 	= date('d-m-Y H:i:s');
 
	include "conexao.php";

	$inserir = mysqli_query($db, "INSERT INTO ocorrencia (titulo, descricao,data_ocorrencia, idlocacao, cadastrado_por) values ('$titulo','$descricao','$data_ocorrencia','$idlocacao','$cadastrado_por')");
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
						<li class=""><a href="ver_contrato.php?idlocacao=<?php echo $idlocacao ?>">Resumo</a></li>
<li class=""><a href="vistoria.php?idlocacao=<?php echo $idlocacao ?>">Vistoria</a></li>
<li class="active"><a href="ocorrencias.php?idlocacao=<?php echo $idlocacao ?>">Ocorrências</a></li>
<li class=""><a href="cobranca.php?idlocacao=<?php echo $idlocacao ?>">Cobrança</a></li>

					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="default-tab-1">



				   <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-11">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Ocorrências</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" action="ocorrencias.php?idlocacao=<?php echo $idlocacao ?>" method="POST">
                               
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Titulo</label>
                                    <div class="col-md-9">
                            
			  <input type="text" class="form-control" name="titulo" required="" />
			  <input type="hidden" name="cadastrado_por" value="<?php echo $imobiliaria_idimobiliaria ?>" />

	
                                        </select>

                                
                                    </div>
                                </div>

                          		  <div class="form-group">
                                    <label class="col-md-3 control-label">Descrição</label>
                                    <div class="col-md-9">
                                  <textarea class="form-control" name="descricao"></textarea>

                                      
                                    </div>
                                </div>


                            
                                  <div class="form-group">
                            
                                    <div class="col-md-9">
                                       <input type="submit" class="btn btn-success m-r-5 m-b-5" value="Cadastrar" />
                                    </div>
                                </div>

                             




                              





                              






                         
                        </div>
                    </div>
                    <!-- end panel -->
                </div>




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
                                         
                                        
                                    </tr>
                                </thead>

                                      <tbody>
                              	<?php 

								

				include "conexao.php";
				$query = mysqli_query($db,"SELECT * FROM ocorrencia
									  WHERE idlocacao = $idlocacao order by idocorrencia desc") or die ("ERRO ao listar garantias"); 


		    while ($buscar = mysqli_fetch_assoc($query)) {//--While categoria
		   
		     $titulo 			= $buscar["titulo"];
		     $data_ocorrencia     		= $buscar["data_ocorrencia"];
		     $descricao     		= $buscar["descricao"];
		     $cadastrado_por     		= $buscar["cadastrado_por"];
		 
		   
		



													?>

                          
                                    <tr class="odd gradeX">
                                 <td><?php echo $data_ocorrencia ?> - <?php echo nome_user($cadastrado_por); ?></td>
                                        <td><?php echo $titulo ?></td>
                                        <td><?php echo $descricao ?></td>
                                    
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
