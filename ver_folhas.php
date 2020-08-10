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
<script type="text/javascript">
	
	function passa_dados(idfolha, idcheque, iduser){

		  document.getElementById('idfolha_cheque').value  = idfolha
		  document.getElementById('idcheque').value  = idcheque
		  document.getElementById('iduser').value  = iduser


	}


</script>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		

		<?php include "topo.php";
			  include "conexao.php";

		$idcheque = $_GET["idcheque"];	

		 ?>
		



		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
				<ol class="breadcrumb pull-right">
		
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">FOLHAS DE CHEQUES</h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			   <?php if (in_array('33', $idrota)) { ?>
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
                            <h4 class="panel-title"></h4>
                        </div>
                      
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Numero Cheque</th>                                        
                                        <th>Situação</th>                                        
                                        <th>Obs </th>
                                                                           
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>

<?php

            
                                  

                      include "conexao.php";


 				$query_amigo = "SELECT * FROM folha_cheque WHERE cheque_id = '$idcheque'";
 				$executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar Folhas de Cheque");
                
                
            	while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
					$idfolha_cheque        = $buscar_amigo["idfolha_cheque"];
					$numero_cheque         = $buscar_amigo["numero_cheque"];
					$descricao_cancelar    = $buscar_amigo["descricao_cancelar"];
					$situacao_folha    	   = $buscar_amigo["situacao_folha"];
					$alterado_por    	   = $buscar_amigo["alterado_por"];
					$data_alterado    	   = $buscar_amigo["data_alterado"];
				
            
             ?>


                                    <tr class="odd gradeX">
                                       <td><?php echo $numero_cheque ?></td>
                                       <td>

                                       <?php 
                                       if($situacao_folha == 0){ ?>
                                       
                                       <span class="label label-success">Disponivel</span>


                                       <?php } ?>

                                         <?php 
                                       if($situacao_folha == 1){ ?>
                                       
                                       <span class="label label-warning">Utilizada</span>


                                       <?php } ?>

                                        <?php 
                                       if($situacao_folha == 2){ ?>
                                       
                                       <span class="label label-warning">CANCELADA</span>


                                       <?php } ?>
                                       	
                                       </td>
                                    	   <td>

                                    	   <?php 
                                    	   if($descricao_cancelar != ''){
                                    	   	$nome_alterado = nome_user($alterado_por);
                                    	   echo $descricao_cancelar."<br>"."Cancelado por: ".$nome_alterado."<br> ".$data_alterado;
                                    		}
                                    	   ?>
                                    	   	

                                    	   </td>
                                       <td>
                                       <?php if($situacao_folha == 0){ ?>
                                       <a href="#modal-dialog" data-toggle="modal"><span class="label label-danger" onclick="passa_dados(<?php echo $idfolha_cheque ?>, <?php echo $idcheque ?>, <?php echo $imobiliaria_idimobiliaria ?>)">CANCELAR FOLHA</span></a>
                                       <?php } ?>
                                       </td>


                                    </tr>
                                     <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-10 -->


<?php } ?>






            </div>
            <!-- end row -->
		</div>
		<!-- end #content -->
		
     




<!-- Inicio modal -->


     <div class="modal fade" id="modal-dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Cancelamento de Folha</h4>
                    </div>
                    <div class="modal-body">


              <form class="form-group" id="formmodal" action="cancelar_folha.php" method="POST">
                              
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Informe o motivo do cancelamento:</label>
                                    <div class="col-md-9">
                                          
                                <textarea class="form-control" name="descricao_cancelar"></textarea> 
								<input type="hidden" name="idfolha_cheque" id="idfolha_cheque" value="">
								<input type="hidden" name="idcheque" id="idcheque" value="">
								<input type="hidden" name="iduser" id="iduser" value="">
                                        
                                    </div>
                                </div>
                                
                              
                                 

                              
                                
                           
                    </div>
                    <div class="modal-footer">
                      <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancelar</a>
                      <input type="submit" class="btn btn-sm btn-success" value="Confirmar Cancelamento"/>
                        </form>
                    </div>
                  </div>
                </div>
              </div>






<!-- Fim do Modal -->



















		
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
