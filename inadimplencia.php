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
			


			<!-- begin page-header -->
			<h1 class="page-header">Relatório de Vendas</h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			  

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
                            <h4 class="panel-title">Inadimplência Loteamento</h4>
                        </div>
                      
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>

                                        <th>Nome Cliente</th>
                                        <th>Valor da Parcela</th>
                                        <th>Data Vencimento</th>
                                        <th>Telefone Cliente</th>
                                        <th>Ref: Imóvel / Quadra - Lote</th>
                                      
                                       
                                    </tr>
                                </thead>
                                <tbody>

                                <?php

      date_default_timezone_set('America/Sao_Paulo');               
$hoje = date('Y-m-d');
                 function converterdata($dateSql){
    $ano= substr($dateSql, 6);
    $mes= substr($dateSql, 3,-5);
    $dia= substr($dateSql, 0,-8);
    return $ano."-".$mes."-".$dia;
}                       
             
                                  

                      include_once "conexao.php";

              
 $query_amigo = "SELECT * FROM parcelas
               INNER JOIN venda ON venda.idvenda = parcelas.venda_idvenda
               INNER JOIN cliente ON venda.cliente_idcliente = cliente.idcliente
               INNER JOIN produto ON venda.produto_idproduto = produto.idproduto
               INNER JOIN lote ON venda.lote_idlote = lote.idlote
               
        
                
              
               where tipo_venda = 2
 ";



               

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
           	  $venda_idvenda         		 = $buscar_amigo["venda_idvenda"];
                  $nome_cli         		 = $buscar_amigo["nome_cli"];
                  $valor_parcelas   		 = $buscar_amigo["valor_parcelas"];
                  $data_vencimento_parcela   = $buscar_amigo["data_vencimento_parcela"];

                  $telefone1_cli			 = $buscar_amigo["telefone1_cli"];
                  $quadra			  			 = $buscar_amigo["quadra"];
                   $lote			  			 = $buscar_amigo["lote"];
         		     $situacao			  			 = $buscar_amigo["situacao"];

             $data_vencimento_tratada = converterdata($data_vencimento_parcela);

             if(strtotime($data_vencimento_parcela) < strtotime($hoje) AND $situacao == 'Em Aberto'){ 
             ?>



                                    <tr class="odd gradeX">
 
                                        <td><a href="parcelas.php?idvenda=<?php echo $venda_idvenda ?>&tipo=2"><?php echo $nome_cli ?></a></td>
                                        <td><?php echo 'R$' . number_format($valor_parcelas, 2, ',', '.'); ?></td>
                                         <td><?php echo $data_vencimento_parcela ?></td>
                                        <td><?php echo $telefone1_cli ?></td>
                                        <td><?php echo "$quadra " ?>- Lote:<?php echo " $lote" ?></td>
                                       
                                       

                                         	
                                    
                 
                                       
                                    </tr>
                                  <?php }  } 

 

$query_amigo = "SELECT * FROM parcelas
               INNER JOIN locacao ON locacao.idlocacao = parcelas.venda_idvenda
               INNER JOIN cliente ON locacao.cliente_idcliente = cliente.idcliente
               INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel
               
        
                
              
               where tipo_venda = 1
 ";



               

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
           	  $venda_idvenda         		 = $buscar_amigo["venda_idvenda"];
                  $nome_cli         		 = $buscar_amigo["nome_cli"];
                  $valor_parcelas   		 = $buscar_amigo["valor_parcelas"];
                  $data_vencimento_parcela   = $buscar_amigo["data_vencimento_parcela"];

                  $telefone1_cli			 = $buscar_amigo["telefone1_cli"];
                  $ref			  			 = $buscar_amigo["ref"];
                 
         		     $situacao			  			 = $buscar_amigo["situacao"];

             $data_vencimento_tratada = converterdata($data_vencimento_parcela);

             if(strtotime($data_vencimento_parcela) < strtotime($hoje) AND $situacao == 'Em Aberto'){ 
             ?>



                                    <tr class="odd gradeX">
 
                                        <td><a href="parcelas.php?idvenda=<?php echo $venda_idvenda ?>&tipo=1"><?php echo $nome_cli ?></a></td>
                                        <td><?php echo 'R$' . number_format($valor_parcelas, 2, ',', '.'); ?></td>
                                         <td><?php echo $data_vencimento_parcela ?></td>
                                        <td><?php echo $telefone1_cli ?></td>
                                        <td><?php echo "$ref " ?></td>
                                       
                                       

                                         	
                                    
                 
                                       
                                    </tr>
                                  <?php }  } 

                                  $query_amigo = "SELECT * FROM parcelas
               INNER JOIN venda_imovel ON venda_imovel.idvenda_imovel = parcelas.venda_idvenda
               INNER JOIN cliente ON venda_imovel.cliente_idcliente = cliente.idcliente
               INNER JOIN imovel ON venda_imovel.imovel_idimovel = imovel.idimovel
               
        
                
              
               where tipo_venda = 3
 ";



               

                $executa_query = mysql_query ($query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysql_fetch_assoc($executa_query)) {//--verifica se são amigos
           	  $venda_idvenda         		 = $buscar_amigo["venda_idvenda"];
                  $nome_cli         		 = $buscar_amigo["nome_cli"];
                  $valor_parcelas   		 = $buscar_amigo["valor_parcelas"];
                  $data_vencimento_parcela   = $buscar_amigo["data_vencimento_parcela"];

                  $telefone1_cli			 = $buscar_amigo["telefone1_cli"];
                  $ref			  			 = $buscar_amigo["ref"];
                 
         		     $situacao			  			 = $buscar_amigo["situacao"];

             $data_vencimento_tratada = converterdata($data_vencimento_parcela);

             if(strtotime($data_vencimento_parcela) < strtotime($hoje) AND $situacao == 'Em Aberto'){ 
             ?>



                                    <tr class="odd gradeX">
 
                                        <td><a href="parcelas.php?idvenda=<?php echo $venda_idvenda ?>&tipo=3"><?php echo $nome_cli ?></a></td>
                                        <td><?php echo 'R$' . number_format($valor_parcelas, 2, ',', '.'); ?></td>
                                         <td><?php echo $data_vencimento_parcela ?></td>
                                        <td><?php echo $telefone1_cli ?></td>
                                        <td><?php echo "$ref " ?></td>
                                       
                                       

                                         	
                                    
                 
                                       
                                    </tr>
                                  <?php }  } ?>






                                 
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-10 -->

  



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

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/table_manage_buttons.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:17:14 GMT -->
</html>
