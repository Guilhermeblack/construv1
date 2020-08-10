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

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/table_manage_buttons.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:15:43 GMT -->
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
		

		<?php include "topo.php"; ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"></h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
                <!-- begin col-6 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Baixar Parcelas</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" method="POST" action="baixa_parcelas.php">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nosso Numero</label>
                                    <div class="col-md-9">
                                        <input type="text" name="nosso_numero" class="form-control" placeholder="Nosso Numero (Sem o Digito)" />
                                    </div>
                                </div>
                               
                              
                              
                              
                                <div class="form-group">
                                   
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-sm btn-success">Consultar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-6 -->
               
            </div>
            <!-- end row -->

<div class="row">
			    <!-- begin col-6 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Resultado da Busca</h4>
                        </div>
                      

                         <?php
                                if(isset($_POST["nosso_numero"])){
                                 ?>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Código da Parcela</th>
                                        <th>Nome (Cliente)</th>
                                        <th>Corretor</th>
                                         <th>Quadra / Lote</th>
                                          <th>Valor Parcela</th>
                                          <th>Data Vencimento</th>
                                         <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                
                $idparcelas = $_POST["nosso_numero"];


                include_once "conexao.php";
                $query_amigo = "SELECT * FROM parcelas 
                INNER JOIN venda ON parcelas.venda_idvenda = venda.idvenda
                INNER JOIN imobiliaria ON venda.imobiliaria_idimobiliaria = imobiliaria.idimobiliaria
                INNER JOIN produto ON venda.produto_idproduto = produto.idproduto
                INNER JOIN cliente ON venda.cliente_idcliente = cliente.idcliente
                INNER JOIN lote ON venda.lote_idlote = lote.idlote
                where idparcelas = $idparcelas";

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar cliente");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            


$nome_cli			= $buscar_amigo["nome_cli"];
$nome_imob			= $buscar_amigo["nome_imob"];
$produto_idproduto			= $buscar_amigo["produto_idproduto"];
$lote			= $buscar_amigo["lote"];
$valor_parcelas			= $buscar_amigo["valor_parcelas"];
$data_vencimento_parcela			= $buscar_amigo["data_vencimento_parcela"];
$idlote			= $buscar_amigo["idlote"];
$idvenda		= $buscar_amigo["idvenda"];
} ?>

                                    <tr>
                                    	<td><?php echo $idparcelas ?></td>
                                    	<td><?php echo $nome_cli ?></td>
                                        <td><?php echo $nome_imob ?></td>
                                        <td>Q- <?php echo $produto_idproduto ?> / <?php echo $lote ?> </td>
                                        <td><?php echo 'R$ ' . number_format($valor_parcelas, 2, ',', '.');  ?></td>
                                         <td><?php echo $data_vencimento_parcela ?></td>
                                          <td>
                                  
                                   
                                     </td>
                                    </tr>
                                     <tr>
                                     <form action="confirmar.php?idlote=<?php echo $idlote?>&idvenda=<?php echo $idvenda ?>&idparcelas=<?php echo $idparcelas ?>">
                                    	<td> Valor Recebido</td>
                                    	<td> <input type="text" class="form-control" name="valor_recebido"> </td>
                                        <td> </td>
                                        <td> <input type="submit" class="form-control btn btn-success" value="Confirmar Venda"/> </td>
                                        <td> </td>
                                        <td> </td>
                                          <td>
                                         
                               
                                   
                                     </td>
                                     </form>
                                    </tr>
                                   





                                </tbody>
                            </table>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- end panel -->
			       
			       
                   
			    </div>
			    <!-- end col-6 -->
			   
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

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/table_manage_buttons.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:17:14 GMT -->
</html>
