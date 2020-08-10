<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

function dados_contabil($parcela_id, $imposto_id){
    include "conexao.php";
    $query_amigo = "SELECT * FROM contabil where parcela_id_receber = $parcela_id AND imposto_id = $imposto_id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $valor_imposto           = $buscar_amigo["valor_imposto"];

      $dados["valor_imposto"]       = $valor_imposto;
     

    }
    return $dados;
}

function dados_parcela($id){
	  include "conexao.php";
    $query_amigo = "SELECT valor_parcelas, valor_recebido ,data_vencimento_parcela, data_recebimento FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

   	while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
   	{
      $valor_recebido           = $buscar_amigo["valor_recebido"];
      $valor_parcelas           = $buscar_amigo["valor_parcelas"];
	  $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
      $data_recebimento         = $buscar_amigo["data_recebimento"];

      $dados["valor_recebido"]  		 = $valor_recebido;
      $dados["valor_parcelas"]  		 = $valor_parcelas;
      $dados["data_vencimento_parcela"]  = $data_recebimento;

    }
    return $dados;
}
function dados_imposto($id){
    include "conexao.php";
    $query_amigo = "SELECT * FROM impostos where idimposto = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $descricao_imposto  = $buscar_amigo["descricao_imposto"];
      $percentual         = $buscar_amigo["percentual"];
      $valor_maximo       = $buscar_amigo["valor_maximo"];
      $ali_min            = $buscar_amigo["ali_min"];
      $ali_max            = $buscar_amigo["ali_max"];

      $dados["descricao_imposto"]   = $descricao_imposto;
      $dados["percentual"]          = $percentual;
      $dados["valor_maximo"]        = $valor_maximo;
      $dados["ali_min"]             = $ali_min;
      $dados["ali_max"]             = $ali_max;

    }
    return $dados;
}


if(isset($_POST["valor_total_imposto"])){

				$data_lancamento = date('d-m-Y');

  				$imposto_id 			         = $_POST["imposto_id"];
  				$empreendimento_id 			   = $_POST["empreendimento_id"];
  				$fornecedor_idfornecedor 	 = $_POST["cliente_idcliente"];
          $situacao 					       = $_POST["situacao"];
          $inicio	 					         = $_POST["inicio"];
          $fim 						           = $_POST["fim"];
				  $valor_total 				       = $_POST["valor_total_imposto"];
				  $data_pagamento 			     = $_POST["data_pagamento"];
				  $percentual 					     = $_POST["percentual"];
				  $antecipar_t 				       = $_POST["idparcelas"];

				  $valor_gravar  = (($percentual / 100) * $valor_total);

				  $data_pagamento = date("d-m-Y", strtotime($data_pagamento));

	include "conexao.php";

	 $inserir = mysqli_query($db, "INSERT INTO contrato_pagar(fornecedor_idfornecedor, centrocusto_id, valor_parcelas, qtd_parcelas, data_vencimento, data_lancamento, empreendimento_id, tipo_venda) values('$fornecedor_idfornecedor',2,'$valor_gravar',1,'$data_pagamento','$data_lancamento','$empreendimento_id', 3)");

	 $venda_idvenda = mysqli_insert_id($db);


$lancamento_pagar = mysqli_query($db, "INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
centrocusto_id,
fluxo,
cliente_id_novo
)

values (
'$venda_idvenda',
'$valor_gravar',
'$data_pagamento',
'Em Aberto',
'Impostos',
'3',  
'2',
'1',
'$fornecedor_idfornecedor'

)");
 $codigo_repasse = mysqli_insert_id($db);

foreach($antecipar_t as $id){
	
	$valor_parcela_individual = dados_parcela($id);
		//echo $valor_parcela_individual['valor_parcelas']; die();
	$valor_individual = (($percentual / 100) * $valor_parcela_individual['valor_recebido']);

 	$lancamento_contabil = mysqli_query($db, "INSERT INTO contabil (

parcela_id_receber,
parcela_id_pagar,
imposto_id,
percentual,
valor_imposto,
data_imposto

)

values (
'$id',
'$codigo_repasse',
'$imposto_id',
'$percentual',
'$valor_individual',
'$data_pagamento'

)");

}

             
	


?>

<script type="text/javascript">
	window.location="contabil.php?empreendimento_id=<?php echo $empreendimento_id ?>&inicio=<?php echo $inicio ?>&fim=<?php echo $fim ?>&situacao=<?php echo $situacao ?>";
</script>

<?php } ?>
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
	

	<?php include "topo.php" ?>
	

<?php


function limpa_valor($valor){

	$valor = str_replace("R$","", $valor);
	$valor = str_replace(".","", $valor);
	$valor = str_replace(",",".", $valor);

	return $valor;
}

function geraTimestamp($data) {
$partes = explode('-', $data);
$tratada = $partes[2].'-'.$partes[1].'-'.$partes[0];
return $tratada;
}


?>




		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Lançamento de Impostos</h1>
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
                            <h4 class="panel-title">Parcelas para Repasse</h4>
                        </div>
                        <div class="panel-body">
                        <form action="receber_parcelas_contabil.php" method="POST" name="nome">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                         
                                       <th>ID / Nosso Numero</th>
                                      
                                        <th>Valor Recebido </th>
                                        <th>Data de Recebimento</th>
                                            <th></th>
                                    

                                    </tr>
                                </thead>
                                <tbody>
<?php               

              include "conexao.php";

              $imposto_id 				  = $_POST["imposto_id"];
              $empreendimento_id 		= $_POST["empreendimento_id"];
              $situacao 				    = $_POST["situacao"];

              $inicio	 				      = $_POST["inicio"];
              $fim 						      = $_POST["fim"];

              $antecipar 				    = $_POST["antecipar"];
                
             $cont = 0; 

             foreach($antecipar as $id){

              // busca todos os dados da parcela
              $dados_parcela 			= dados_parcela($id);


              // alimenta as variaveis 
              $valor_recebido 			= $dados_parcela["valor_recebido"];
              $data_vencimento_parcela	= $dados_parcela["data_vencimento_parcela"];

             
             $dados_contabil = dados_contabil($id, $imposto_id);

            if($dados_contabil['valor_imposto'] == ''){ 
              $cont = $cont + $valor_recebido;
          	}
             ?>






                                    <tr>

                                     <td>
 	                      			<?php   if($dados_contabil['valor_imposto'] == ''){  ?>
 	                                     <input type="hidden" name="idparcelas[]" value="<?php echo $id ?>">
 	                                     <?php } ?>


                                     <?php echo $id ?></td>
                                    <td><?php echo 'R$' . number_format($valor_recebido, 2, ',', '.'); ?></</td>
                                    <td><?php echo $data_vencimento_parcela ?></td>
                                    
                                    <?php   if($dados_contabil['valor_imposto'] != ''){  ?>
                                    <td> <span class="label label-warning">Já Lançado</span> </td>
                                    <?php } ?>
                                      
                                    </tr>
                               <?php } ?>
                           
                                             <input type="hidden" name="imposto_id" value="<?php echo $imposto_id ?>">
 	                                     <input type="hidden" name="cliente_idcliente" value="<?php echo $repasse_parcela['cliente_id'] ?>">
 	                                     <input type="hidden" name="empreendimento_id" value="<?php echo $empreendimento_id ?>">
 	                                     <input type="hidden" name="situacao" value="<?php echo $situacao ?>">
 	                                     <input type="hidden" name="inicio" value="<?php echo $inicio ?>">
 	                                     <input type="hidden" name="fim" value="<?php echo $fim ?>">
                                <tr>
                                 	<td> <h3>Valor Total: <?php echo ' R$ ' . number_format($cont, 2, ',', '.');  ?></h3></td>
                               		<td> 
				                              
                                       <?php

                                       if($imposto_id == 2){
                                        
                                        $dados_imposto = dados_imposto($imposto_id);
                                        $descricao_imposto  = $dados_imposto["descricao_imposto"];
                                        $percentual         = $dados_imposto["percentual"];
                                        $valor_maximo       = $dados_imposto["valor_maximo"];
                                        $ali_min            = $dados_imposto["ali_min"];
                                        $ali_max            = $dados_imposto["ali_max"];

                                        $percentual = ($percentual / 100);
                                        $ali_min    = ($ali_min / 100);
                                        $ali_max    = ($ali_max / 100);

                                        $result1 = $cont * $percentual;

                                        if($result1 <= $valor_maximo){
                                          $valor_total_imposto = $result1 * $ali_min;
                                        }else{
                                          $result2 = $result1 - $valor_maximo;
                                          $imposto2 = $result2 * $ali_max;
                                          $imposto1 = $valor_maximo * $ali_min;
                                          $valor_total_imposto = $imposto1 + $imposto2;
                                        }



                                       }elseif($imposto_id == 1){

                                        $dados_imposto = dados_imposto($imposto_id);
                                        $percentual    = $dados_imposto["percentual"];
                                        $percentual    = ($percentual / 100);

                                        $valor_total_imposto = $cont * $percentual;
                                       }elseif($imposto_id == 3){
                                        
                                        $dados_imposto = dados_imposto($imposto_id);
                                        $percentual    = $dados_imposto["percentual"];
                                        $percentual    = ($percentual / 100);

                                        $valor_total_imposto = $cont * $percentual;
                                       }elseif($imposto_id == 4){
                                        $dados_imposto = dados_imposto($imposto_id);
                                        $percentual    = $dados_imposto["percentual"];
                                        $percentual    = ($percentual / 100);

                                        $valor_total_imposto = $cont * $percentual;
                                       }else{
                                        $valor_total_imposto = $cont;
                                       }


                                       ?>
				                            <h1>  <span class="label label-success"><?php echo ' R$ ' . number_format($valor_total_imposto, 2, ',', '.');  ?></span></h1>
                              		</td>
                                    <td> </td>  
                                      <td> </td>  
                                  
                               	
                               </tr>
                               
                                  <tr>
                                	<td> Data de Vencimento: <input type="date" name="data_pagamento"  class="form-control" placeholder="Data de Pagamento" required="">

                                     <input type="hidden" name="valor_total_imposto" value="<?php echo $valor_total_imposto ?>">

                                  </td>
                               	    <td></td>  
                                    <td></td>
                                      <td> </td>  
                                   
                                    
                               </tr>
                               <tr>
                                	<td><input type="submit" class="btn btn-success" value="Confirmar Recebimento" /></td>
                               	    <td></td>  
                                    <td></td>
                                      <td> </td>  
                                   
                                    
                               </tr>
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

$("#percentual").maskMoney({symbol:'', 
showSymbol:true, thousands:'.', decimal:'.', symbolStay: true});


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
