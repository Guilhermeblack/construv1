<?php
 error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
 ?>

 <!DOCTYPE html>

<html>


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

	<!-- begin #page-loader -->
	<div id="page-loader" class="fade"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		

		<?php include "topo.php"; 

		$projeto_id = $_GET["projeto_id"];
		$pacotes_id  = $_GET["pacotes_id"];


		?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
				<ol class="breadcrumb pull-right">
				<?php if (in_array('32', $idrota)) { ?>
				<li><a href="cadastro_lista_orcamento.php?pacotes_id=<?php echo $pacotes_id ?>&projeto_id=<?php echo $projeto_id ?>"><span class="label label-primary" style="font-size:100% !important">ADICIONAR LISTA</span></a></li>

				

				<?php } ?>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Lista de Insumos</h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			 


            <?php

                      include "conexao.php";
               
                    $query_amigo = "SELECT * FROM lista_orcamento
                    				where projeto_id = '$projeto_id' AND pacotes_id = '$pacotes_id' 
                    				order by idlista_orcamento desc";

                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar listas");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)){ {}
           
             $idlista_orcamento             = $buscar_amigo['idlista_orcamento'];
             $descricao_lista               = $buscar_amigo["descricao_lista"];
        
             
            
             ?>


			    <!-- begin col-10 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                       <div class="panel-heading">
                            <div class="btn-group pull-right">
                                
                                    
                                   <a href="cadastro_lista.php?pacotes_id=<?php echo $pacotes_id ?>&projeto_id=<?php echo $projeto_id ?>&lista_id=<?php echo $idlista_orcamento	 ?>">
                                   <span class="label label-success">Adicionar Itens</span></a>
                             
                                
                            </div>
                            <h4 class="panel-title"><?php echo $descricao_lista ?></h4>
                        </div>
                      
                        <div class="panel-body">
                            <table  class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                   		
                                        <th>Materiais</th>
                                        <th>Quantidade</th>
                                         <th>Unidade</th>

                                          <th>Valor</th>
                                    
                                      
                                       
                                    </tr>
                                </thead>
                                <tbody>
   <?php

            
                                  
        
                include "conexao.php";            
               $total = 0;
                $query_amigo_item = "SELECT * FROM itens_lista
                                INNER JOIN insumo ON itens_lista.insumo_id = insumo.id                               
                                WHERE projeto_id = $projeto_id AND pacotes_id=$pacotes_id AND lista_id = $idlista_orcamento";
                $executa_query_item = mysqli_query ($db,$query_amigo_item) or die ("Erro ao listar pacotes");
                
                
            while ($buscar_amigo2 = mysqli_fetch_assoc($executa_query_item)) {//--verifica se são amigos
            $insumo_id     	   	   = $buscar_amigo2["insumo_id"];
            $iditens_lista     	   = $buscar_amigo2["iditens_lista"];
            $qta_insumo            = $buscar_amigo2['qta_insumo'];
            $descricao             = $buscar_amigo2["descricao"];
            $un                    = $buscar_amigo2["un"];
            $valor_insumo          = $buscar_amigo2["valor_insumo"];
         
            $total = $total + $valor_insumo;
           
          
             ?>



                                    <tr class="odd gradeX">
                                       <td><?php echo $descricao ?></td>
                                        <td><?php echo $qta_insumo ?></td>
                                        <td><?php echo $un ?></td>
                                        <td><?php echo 'R$ ' . number_format($valor_insumo, 2, ',', '.');  ?></td>
                                    </tr>
                                  <?php } ?>
                                  <tr>
                                  <td colspan="3"><center>Valor Total:</center></td>
                                   <td> <span class="label label-success"><?php echo 'R$ ' . number_format($total, 2, ',', '.');  ?></span></td>
                                  </tr>
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
