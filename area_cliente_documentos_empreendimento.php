<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

	$idempreendimento_cadastro = $_GET["idempreendimento"];
	$idvenda          = $_GET["idvenda"];
	$venda_idvenda          = $idvenda;

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
	
	<?php  include "topo_cliente.php"; 

	function quadra_lote($idvenda){


    include "conexao.php";

   $query_amigo = "SELECT produto_idproduto, lote_idlote FROM venda                         
                   where idvenda = $idvenda";

                  $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar lote");
                
                
                  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                   $produto_idproduto      = $buscar_amigo["produto_idproduto"];
                   $lote_idlote            = $buscar_amigo["lote_idlote"];
                  
                  }
            
                  $dados["produto_idproduto"] = $produto_idproduto;
                  $dados["lote_idlote"]       = $lote_idlote;

return $dados;
}



$quadra_lote = quadra_lote($idvenda);




	?>
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
                            <h4 class="panel-title">Documentos Cadastrados</h4>
                        </div>
                        
                        <div class="panel-body">
                            <table id="" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Data Cadastro</th>
                                         <th>Titulo</th>
                                        <th>Descrição</th>
                                        <th>Anexo</th>
                                                                       
                                        
                                    </tr>
                                </thead>

                                      <tbody>
                              	<?php 

								

				include "conexao.php";

				$busca_quadra = $quadra_lote['produto_idproduto'];
				$busca_lote   = $quadra_lote['lote_idlote'];

				$query = mysqli_query($db,"SELECT * FROM documentos
									  WHERE quadra_id = $busca_quadra AND lote_id = $busca_lote order by iddocumentos desc"); 


		    while ($buscar = mysqli_fetch_assoc($query)) {//--While categoria
		   
		      $iddocumentos 			= $buscar["iddocumentos"];
		     $titulo 				= $buscar["titulo"];
		     $data_ocorrencia     	= $buscar["data_ocorrencia"];
		     $descricao     		= $buscar["descricao"];
		     $cadastrado_por     	= $buscar["cadastrado_por"];
		 
		   
		



													?>

                          
                                    <tr class="odd gradeX">
                                        <td><?php echo $data_ocorrencia ?> - <?php echo nome_user($cadastrado_por); ?></td>
                                        <td><?php echo $titulo ?></td>
                                        <td><?php echo $descricao ?></td>
                                        <td>
                                        	

                                        	  <?php	
        $query_anexo = "SELECT * FROM documentos_arquivos WHERE documentos_id = $iddocumentos";
        $executa_anexo = mysqli_query ($db,$query_anexo) or die ("Erro Ocorrencias");
                
        while ($buscar_anexo = mysqli_fetch_assoc($executa_anexo)) {//--verifica se são amigos
           
            	$url_anexo       = $buscar_anexo['url_anexo'];
            	if($url_anexo != ''){

        ?>    	
        		<a href="documentos_arquivos/<?php echo $iddocumentos  ?>/<?php echo $url_anexo ?>">
<i class="fa fa-file" aria-hidden="true"></i></a>
	<?php } } ?>



                                        	
                                        </td>
                                   
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
