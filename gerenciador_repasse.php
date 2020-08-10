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


<head>
	<meta charset="utf-8" />
	<title>Immobile Business</title>
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
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
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
	
		
<?php include "topo.php"; 
include "func_painel_repasse.php";?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			
			<!-- begin page-header -->
			<h1 class="page-header">Gerenciador de Repasse </h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">

			            <!-- begin col-6 -->
                <div class="col-md-12">
                
                    <!-- end panel -->
                    <!-- begin panel  é esse aqui  -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Repasse</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" name="myForm" method="GET" action="gerenciador_repasse.php">
                         
                             <div class="form-group">
                                    <label class="col-md-4 control-label">Informe o Período</label>
                                    <div class="col-md-8">
                                        <div class="input-group input-daterange">
                                            <input type="text" class="form-control" name="start" placeholder="Data Inicial" />
                                            <span class="input-group-addon">Até</span>
                                            <input type="text" class="form-control" name="end" placeholder="Data Final" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    
                                    <div class="col-md-8">
                                        <input type="submit" class="btn btn-sm btn-success" value="Consultar" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                
              
                </div>
<?php
date_default_timezone_set('America/Sao_Paulo');               
$hoje = date('Y-m-d');

if(isset($_GET["start"])){
  $start = $_GET["start"];
  $end = $_GET["end"];

  $start2 = $_GET["start"];
  $end2 = $_GET["end"];

  $partes = explode("/", $start);
  $start = $partes[2].'-'.$partes[1].'-'.$partes[0];

  $partes = explode("/", $end);
  $end = $partes[2].'-'.$partes[1].'-'.$partes[0];

}

                       
  
?>
                <!-- begin col-6 -->
                <?php if(isset($_GET["start"])){ ?>

                <!-- begin row -->
			<div class="row">
			 <div class="col-md-6 col-sm-6">
			        <div class="widget widget-stats bg-black">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
			            <div class="stats-title">Todos os Repasses</div>
			            <?php
                  $repasse_envio = '';
			            $total_repasse_todos = todos($start, $end, $repasse_envio);
			            ?>
			            <div class="stats-number"><?php echo 'R$' . number_format($total_repasse_todos, 2, ',', '.'); ?></div>
			            <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                        <div class="stats-desc">(Descrição)</div>
			        </div>
			    </div>
			    <!-- begin col-3 -->
			    <div class="col-md-3 col-sm-6">
			        <div class="widget widget-stats bg-green">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
			            <div class="stats-title">Efetivados</div>
			             <?php
			            $repasses_efetivados_todos = todos($start, $end, 1);
			            ?>
			            <div class="stats-number"><?php echo 'R$' . number_format($repasses_efetivados_todos, 2, ',', '.'); ?> </div>
			            <div class="stats-progress progress">
			          
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                        <div class="stats-desc">Descrição)</div>
			        </div>
			    </div>
			    <!-- end col-3 -->
			    <!-- begin col-3 -->
			    
			    <!-- end col-3 -->
			    <!-- begin col-3 -->
			    <div class="col-md-3 col-sm-6">
			        <div class="widget widget-stats" style="background:#ff5b57 !important">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-shopping-cart fa-fw"></i></div>
			            <div class="stats-title">Não Efetivados</div>
			            <?php
			            $repasses_nao_efetivados_todos = todos($start, $end,3);
			            ?>
			            <div class="stats-number"><?php echo 'R$' . number_format($repasses_nao_efetivados_todos, 2, ',', '.'); ?></div>
			            <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                        <div class="stats-desc">(Desc)</div>
			        </div>
			    </div>
			    <!-- end col-3 -->
			    <!-- begin col-3 -->
			   
			    <!-- end col-3 -->
			</div>
			<!-- end row -->
			    <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-10">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title"><span class="label label-success pull-left m-r-10">NEW</span> Lista de Repasse Referente ao Mês</h4>
                        </div>
                        <div class="panel-body">
                          <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>

                                        <th>Nome Cliente</th>
                                        <th>Data Vencimento</th>
                                        <th>Locador</th>
                                        <th>Valor da Parcela</th>
                                        <th>Valor Repasse</th>
                                        <th>Taxa Adm</th>
                                        <th>Repasse Líquido</th>
                                         <th>Efetivado?</th>
                                      
                                       
                                    </tr>
                                </thead>
                                <tbody>

                                <?php

           
                                  

                      include "conexao.php";

              
$query_amigo = "SELECT * FROM parcelas
                INNER JOIN locacao ON locacao.idlocacao = parcelas.venda_idvenda
                INNER JOIN cliente ON locacao.cliente_idcliente = cliente.idcliente              
                INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel
                INNER JOIN locador ON imovel.locador_idlocador = locador.idlocador
                where tipo_venda = 1 order by idparcelas asc";               

                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar todos os repasses");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
                  $idparcelas               = $buscar_amigo["idparcelas"];
                  $venda_idvenda            = $buscar_amigo["venda_idvenda"];
                  $nome_cli                 = $buscar_amigo["nome_cli"];
                  $valor_parcelas           = $buscar_amigo["valor_parcelas"];
                  $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];

                  $telefone1_cli            = $buscar_amigo["telefone1_cli"];
                  
                  $situacao                 = $buscar_amigo["situacao"];
                  $repasse                  = $buscar_amigo["repasse"];
                  $taxa_adm                 = $buscar_amigo["taxa_adm"];
                  $nome_loc                 = $buscar_amigo["nome_loc"];
                  $repasse_feito            = $buscar_amigo["repasse_feito"];

                 
             
                  $data_vencimento_tratada= converterdata($data_vencimento_parcela);

                  $valor_repasse          = ($valor_parcelas*($repasse/100));
                  $taxa_adm_repasse       = ($valor_parcelas*($taxa_adm/100));

                  $taxa_adm_repasse       = ($valor_parcelas*($taxa_adm/100));
            
                  $total_repasse_cliente  = ($valor_repasse - $taxa_adm_repasse);

                  $total_geral_liquido    = $total_geral_liquido + $total_repasse_cliente;


             $stilo ='';

  if(strtotime($data_vencimento_tratada) <= strtotime($hoje) AND $situacao == 'Em Aberto'){ 

   $stilo = 'danger'; 

    } 

if($situacao == 'Pago'){ 

   $stilo = 'success'; 

    }

            if((strtotime($data_vencimento_tratada) >= strtotime($start)) AND (strtotime($data_vencimento_tratada) <= strtotime($end))){ 
             ?>



               <tr class="<?php echo $stilo ?>">
    
                  <td><a href="parcelas.php?idvenda=<?php echo $venda_idvenda ?>&tipo=1"><?php echo $nome_cli ?></a></td>
                  <td><?php echo $data_vencimento_parcela ?></td>
                  <td><?php echo $nome_loc ?></td>
                  <td><?php echo 'R$' . number_format($valor_parcelas, 2, ',', '.'); ?></td>
                  <td><?php echo 'R$' . number_format($valor_repasse, 2, ',', '.'); ?></td>
                  <td><?php echo 'R$' . number_format($taxa_adm_repasse, 2, ',', '.'); ?></td>
                  <td><?php echo 'R$' . number_format($total_repasse_cliente, 2, ',', '.'); ?></td>
                  <td>
                     	<?php 
                  
                       	if($repasse_feito == 1)
                        {
                        	$status_repasse = "<a href='altera_repasse.php?repasse=0&start=$start2&end=$end2&idparcelas=$idparcelas'><span class='label label-success'>Sim</span></a>";
                        }else{
                        	$status_repasse = "<a href='altera_repasse.php?repasse=1&start=$start2&end=$end2&idparcelas=$idparcelas'><span class='label label-danger'>Não</span></a>";
                        }
                        
                        echo "$status_repasse"; 	?>
                   </td>
               </tr>
        <?php }  } ?>

                                 
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
             <?php } ?>
                </div>
                <!-- end col-6 -->
    
                <!-- end col-6 -->
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
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/masked-input/masked-input.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/password-indicator/js/password-indicator.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-daterangepicker/moment.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
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
	<script src="https://immobilebusiness.com.br/admin/assets/js/form-plugins.demo.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			FormPlugins.init();
			TableManageButtons.init();
		});
	</script>

</body>


</html>
