<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

$cont = 0;
date_default_timezone_set('America/Sao_Paulo');               
$hoje = date('Y-m-d');
function converterdata($dateSql){
    $ano= substr($dateSql, 6);
    $mes= substr($dateSql, 3,-5);
    $dia= substr($dateSql, 0,-8);
    return $ano."-".$mes."-".$dia;
}   
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
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
	

	<?php include "topo_cliente.php" ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
		
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Parcelas</h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			
			    <!-- begin col-6 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="table-basic-4">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Parcelas do Contrato</h4>
                        </div>
                        <div class="panel-body">
                      
                    
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                       
                                       <th>ID / Nosso Numero</th>
 <th>Nº Parcela</th>
                                      
                                            <th>Descrição</th>
                                        <th>Valor Parcela</th>
                                        <th>Data Vencimento</th>
                                        <th>Desconto</th>
                                        <th>Acréscimo</th>
                                        <th>Valor Total</th>
                                        <th>Data Pagamento</th>
                                        <th> Situação</th>
                                       
                                         

                                    </tr>
                                </thead>
                                <tbody>
<?php     
	$venda_idvenda = $_GET["idvenda"];





                include "conexao.php";
                $query_amigo = "SELECT * FROM parcelas
                                INNER JOIN locacao ON parcelas.venda_idvenda = locacao.idlocacao
              WHERE venda_idvenda = $venda_idvenda AND cliente_id_novo = '$idcliente' and fluxo = '1' order by idparcelas Asc";

                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
             	$idparcelas           		= $buscar_amigo["idparcelas"];
			    $valor_parcelas          	= $buscar_amigo["valor_parcelas"];
                $data_vencimento_parcela  	= $buscar_amigo["data_vencimento_parcela"];
         		$situacao           		= $buscar_amigo["situacao"];
                $descricao           		= $buscar_amigo["descricao"];
                $valor_recebido           	= $buscar_amigo["valor_recebido"];
  				$data_recebimento    		= $buscar_amigo["data_recebimento"];
  				$desc_parcela    			= $buscar_amigo["desc_parcela"];
  				$acre_parcela    			= $buscar_amigo["acre_parcela"];

  				$exibir_vencimento   		= $data_recebimento;


                $cont = $cont + 1;


             $data_vencimento_tratada  = converterdata($data_vencimento_parcela);
             $data_recebimento_tratada = converterdata($data_recebimento);
             
              if($valor_recebido == ''){
              	$valor_recebido = 0.00;
              }
               if($desc_parcela == ''){
              	$desc_parcela = 0.00;
              }
               if($acre_parcela == ''){
              	$acre_parcela = 0.00;
              }


             ?>

 <?php

 	$stilo ='';

  	if($situacao == 'Pago'){
	
		$stilo = 'success';  		
	}	
?>


                                  <tr class="<?php echo $stilo; ?>">
                               
                                    <td><?php echo $idparcelas ?></td>
                                    <td><?php echo $cont ?></td>
                                    <td <?php echo $stilo; ?>><?php echo $descricao ?></td>
                                    <td <?php echo $stilo; ?>><?php echo 'R$ ' . number_format($valor_parcelas, 2, ',', '.'); ?></td>
                                    <td <?php echo $stilo; ?>><?php echo $data_vencimento_parcela ?></td>

                                    <td <?php echo $stilo; ?>><?php echo 'R$ ' . number_format($desc_parcela, 2, ',', '.'); ?></td>

                                    <td <?php echo $stilo; ?>><?php echo 'R$ ' . number_format($acre_parcela, 2, ',', '.'); ?></td>
                                    <td <?php echo $stilo; ?>><?php echo 'R$ ' . number_format($valor_recebido, 2, ',', '.'); ?></td>
                                    <td <?php echo $stilo; ?>><?php echo $exibir_vencimento ?></td>

                                    <td <?php echo $stilo; ?>><?php echo $situacao ?></td>
                                   
                                  


                                    </tr>
                                <?php } ?>

                              
                                </tbody>
                            </table>
                            </form>
                        </div>
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

<script src="https://immobilebusiness.com.br/admin/assets/js/jquery.maskMoney.js" type="text/javascript"></script>

 <script type="text/javascript">

$(function(){
$("#valor_recebido").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })


</script>

<script type="text/javascript">
function baixa_tudo(id){


           /* Configura a requisição AJAX */
           $.ajax({
                url : 'calcula_baixa.php', /* URL que será chamada */ 
                type : 'GET', /* Tipo da requisição */ 
                data: 'idparcelas=' + id, /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                  
                    
				 $('#dta_vencimento').val(data.dta_vencimento);     
				 $('#valor_normal').val(data.valor_normal);  
				 $('#multa').val(data.multa); 
				 $('#juros').val(data.juros); 
				 $('#valor_corrigido').val(data.valor_corrigido);  
				 $('#idparcelas').val(data.idparcelas);
				  $('#idvenda').val(data.idvenda);  
				  $('#tipo_venda').val(data.tipo_venda);                  
                }
           });   
}   

</script>


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
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>

</body>

</html>
