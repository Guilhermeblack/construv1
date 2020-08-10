<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";

?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html>
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v2.0/admin/html/index_v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 21:07:07 GMT -->
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
	
	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="https://immobilebusiness.com.br/admin/assets/plugins/morris/morris.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
<?php
function locatario_qtd_imoveis_locados($idcliente){
    include "conexao.php";
    $query_amigo = "SELECT COUNT(cliente_idcliente) as TOTAL FROM locacao WHERE cliente_idcliente = $idcliente";
    $executa_query = mysqli_query($db, $query_amigo);

    $total = mysqli_num_rows($executa_query);

    return $total;
}

function locador_qtd_imoveis($idcliente){
    include "conexao.php";
    $query_amigo = "SELECT idimovel  FROM imovel WHERE locador_idlocador = $idcliente";
    $executa_query = mysqli_query($db, $query_amigo);

    $total = mysqli_num_rows($executa_query);

    return $total;
}

function locador_qtd_imoveis_locados($idcliente){
    include "conexao.php";
    $query_amigo = "SELECT idimovel FROM locacao 
    				INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel 
    				WHERE locador_idlocador = $idcliente
";
    $executa_query = mysqli_query($db, $query_amigo);

    $total = mysqli_num_rows($executa_query);

    return $total;
}

function parcelas_valor_bruto($idcliente, $idempreendimento){
    include "conexao.php";
    $query_amigo = "SELECT SUM(valor_recebido) as total from parcelas 
    				INNER JOIN empreendimento_cadastro ON parcelas.empreendimento_id_novo = empreendimento_cadastro.idempreendimento_cadastro
    				WHERE situacao = 'Pago' AND repasse_feito = 0 AND cliente_id = $idcliente AND fluxo = 0 AND empreendimento_id_novo = $idempreendimento";
    $executa_query = mysqli_query($db, $query_amigo);

    while ($row = mysqli_fetch_assoc($executa_query)) {
        $total = $row['total'];
    }

    $query_pagar = "SELECT SUM(valor_parcelas) as total from parcelas    				
    				WHERE situacao = 'Em Aberto' AND repasse_feito = 0 AND cliente_id_novo = $idcliente AND fluxo = 1 AND empreendimento_id_novo = $idempreendimento";
    $executa_pagar = mysqli_query($db, $query_pagar);

    while ($row_pagar = mysqli_fetch_assoc($executa_pagar)) {
        $total_pagar = $row_pagar['total'];
    }

    $total_geral = $total + $total_pagar;
   
    return $total_geral;
}

function impostos_parcela($idempreendimento){
	include "conexao.php";
	  $query_comissao = "SELECT comissao_restante, pis, cofins from empreendimento 
    				    WHERE empreendimento_cadastro_id = $idempreendimento";
     $executa_comissao = mysqli_query($db, $query_comissao);

    while ($row_comissao = mysqli_fetch_assoc($executa_comissao)) {
        $comissao = $row_comissao['comissao_restante'];
        $pis   	  = $row_comissao['pis'];
        $cofins   = $row_comissao['cofins'];
    } 
    	$pis 	  = ($pis / 100);
    	$cofins   = ($cofins / 100);
    	$comissao = ($comissao / 100);

    $dados["pis"] 		= $pis;
    $dados["cofins"] 	= $cofins;
    $dados["comissao"]  = $comissao;



    return $dados;
}



function parcelas_apagar($idcliente, $idempreendimento){
    include "conexao.php";
    $query_amigo = "SELECT SUM(valor_parcelas) as total from parcelas    				
    				WHERE situacao = 'Em Aberto' AND cliente_id_novo = $idcliente AND fluxo = 0 AND empreendimento_id_novo = $idempreendimento";
    $executa_query = mysqli_query($db, $query_amigo);

  while ($row = mysqli_fetch_assoc($executa_query)) {
        $total = $row['total'];
    }


    return $total;
}

function parcelas_repasse_agendado($idcliente, $idempreendimento){
    include "conexao.php";
    $query_amigo = "SELECT SUM(valor_parcelas) as total, data_vencimento_parcela, idparcelas from parcelas    				
    				WHERE situacao = 'Em Aberto' AND cliente_id_novo = $idcliente AND fluxo = 1 AND empreendimento_id_novo = $idempreendimento";
    $executa_query = mysqli_query($db, $query_amigo);

  while ($row = mysqli_fetch_assoc($executa_query)) {
        $total = $row['total'];
        $data  = $row['data_vencimento_parcela'];
        $idparcelas  = $row['idparcelas'];

        $dados["total"] 				  = $total;
        $dados["data_vencimento_parcela"] = $data;
        $dados["idparcelas"] = $idparcelas;
    }
    return $dados;
}


function inadi_empreendimento($idempreendimento){

   date_default_timezone_set('America/Sao_Paulo');

    $hoje 	= date('Y-m-d');
    $inicio = date('Y-m-d',strtotime($hoje . "-10000 days"));

    $where = " AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$hoje."' ";

    include "conexao.php";

   $query_amigo = "SELECT SUM(valor_parcelas) as total FROM parcelas                         
                   where empreendimento_id_novo = $idempreendimento AND tipo_venda = 2 AND situacao = 'Em Aberto' AND fluxo = 0 $where";

                   $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
                  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                   $total            = $buscar_amigo["total"];
                  
                  }
            


return $total;
}




function lotes($situacao, $idempreendimento){
    include "conexao.php";
    $query_amigo = "SELECT COUNT(idlote) as total from lote
    				INNER JOIN produto ON lote.produto_idproduto = produto.idproduto
    				INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento   				
    				WHERE lote.status = $situacao AND empreendimento_cadastro_id = $idempreendimento";
    $executa_query = mysqli_query($db, $query_amigo);

  while ($row = mysqli_fetch_assoc($executa_query)) {
        $total = $row['total'];
    }
    return $total;
}


function inadi_juridico($empreendimento_id){

   date_default_timezone_set('America/Sao_Paulo');

    $hoje = date('Y-m-d');
    $inicio = '1900-01-01';

    $where = " AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$hoje."' group by cliente_id_novo";

    include "conexao.php";
$cont = 0;
   $query_amigo = "SELECT COUNT(idparcelas) as total FROM parcelas                         
                   where  situacao = 'Em Aberto' AND empreendimento_id_novo = $empreendimento_id AND fluxo = 0 $where";

                   $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
                  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                   $total            = $buscar_amigo["total"];

                   if($total >= 3){
                    $cont = $cont + 1;
                   }
                  
                  }
            


return $cont;
}



?>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	

	<?php include "topo_cliente.php"; ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<?php
			include "conexao.php";
       		$query_amigo = "SELECT * FROM empreendimento_cadastro WHERE cliente_id = $idcliente";

                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar empreendimentos");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
                 
                  $idempreendimento_cadastro = $buscar_amigo["idempreendimento_cadastro"];
                  $descricao    			 = $buscar_amigo["descricao_empreendimento"];

                  if($idempreendimento_cadastro != ''){
                  ?>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><?php echo $descricao ?><small> </small></h1>
			<!-- end page-header -->
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-3 -->
			    <div class="col-md-3 col-sm-6">
			        <div class="widget widget-stats bg-blue">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
			            <div class="stats-title">Valor Bruto:</div>
			           <?php  $parcelas_valor_bruto = parcelas_valor_bruto($idcliente, $idempreendimento_cadastro); ?>
			            <div class="stats-number"><?php echo 'R$' . number_format($parcelas_valor_bruto, 2, ',', '.'); ?> </div>
			            <div class="stats-progress progress">
			          
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                      
                        <div class="stats-desc">   &nbsp;</div>
			        </div>
			    </div>
			    <!-- end col-3 -->
			    <?php 
			    $impostos = impostos_parcela($idempreendimento_cadastro);

			    $imp_pis      = $impostos["pis"];
			    $imp_cofins   = $impostos["cofins"];
			    $imp_comissao = $impostos["comissao"];


			    $total_pis      =  $parcelas_valor_bruto * $imp_pis;
			    $total_cofins   =  $parcelas_valor_bruto * $imp_cofins;
			    $total_comissao =  $parcelas_valor_bruto * $imp_comissao;

			    $total_geral_impostos = ($total_pis + $total_cofins + $total_comissao);

			    ?>
			    <!-- begin col-3 -->
			    <div class="col-md-3 col-sm-6">
			        <div class="widget widget-stats bg-blue">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-tags fa-fw"></i></div>
			            	<?php 
			            	$parcelas_apagar = parcelas_apagar($idcliente, $idempreendimento_cadastro);

			            	$total_parcelas_apagar = $parcelas_apagar + $total_geral_impostos;
			            	?>

			            <div class="stats-title">Despesas</div>
			            <div class="stats-number"><?php echo 'R$' . number_format($total_parcelas_apagar, 2, ',', '.'); ?></div>
			            <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                       
                        <div class="stats-desc">  &nbsp;</div>
			        </div>
			    </div>

			    <!-- end col-3 -->
			    <!-- begin col-3 -->
			    <div class="col-md-3 col-sm-6">
			        <div class="widget widget-stats bg-blue">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-shopping-cart fa-fw"></i></div>
			            <?php
			            $total_liquido = $parcelas_valor_bruto - $total_parcelas_apagar;
			            ?>

			            <div class="stats-title">Valor Liquido</div>
			            <div class="stats-number"><?php echo 'R$' . number_format($total_liquido, 2, ',', '.'); ?> </div>
			            <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                       
                        <div class="stats-desc">  &nbsp;</div>
			        </div>
			    </div>
   <?php
			            $dados_repasse = parcelas_repasse_agendado($idcliente, $idempreendimento_cadastro);
			            ?>
			      <div class="col-md-3 col-sm-6" onclick="location.href='area_cliente_extrato_empreendimento.php?idrepasse=<?php echo $dados_repasse["idparcelas"] ?>';">
			        <div class="widget widget-stats bg-blue">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-shopping-cart fa-fw"></i></div>
			         

			            <div class="stats-title">Repasse Agendado</div>
			            <div class="stats-number"><?php echo 'R$' . number_format($dados_repasse["total"], 2, ',', '.'); ?> </div>
			            <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                       
                        <div class="stats-desc"> Data Prevista: <?php echo $dados_repasse["data_vencimento_parcela"] ?></div>
			        </div>
			    </div>

			        <div class="col-md-3 col-sm-6">
			        <div class="widget widget-stats bg-black">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-shopping-cart fa-fw"></i></div>
			            <?php
			            $inadi_empreendimento = inadi_empreendimento($idempreendimento_cadastro);
			            ?>

			            <div class="stats-title">Inadimplência</div>
			            <div class="stats-number"><?php echo 'R$' . number_format($inadi_empreendimento, 2, ',', '.'); ?> </div>
			            <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                       
                        <div class="stats-desc"> &nbsp;</div>
			        </div>
			    </div>

			         <div class="col-md-3 col-sm-6">
			        <div class="widget widget-stats bg-black">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-shopping-cart fa-fw"></i></div>
			            <?php
			            $lotes_disp = lotes('1',$idempreendimento_cadastro);
			            ?>

			            <div class="stats-title">Lotes Disponiveis</div>
			            <div class="stats-number"><?php echo $lotes_disp;  ?> </div>
			            <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                       
                        <div class="stats-desc">  &nbsp;</div>
			        </div>
			    </div>


			      <div class="col-md-3 col-sm-6">
			        <div class="widget widget-stats bg-black">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-shopping-cart fa-fw"></i></div>
			          <?php
			            $lotes_reser = lotes('0',$idempreendimento_cadastro);
			            ?>

			            <div class="stats-title">Lotes Em Negociação</div>
			            <div class="stats-number"><?php echo $lotes_reser;  ?> </div>
			            <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                       
                        <div class="stats-desc">  &nbsp;</div>
			        </div>
			    </div>

			        <div class="col-md-3 col-sm-6">
			        <div class="widget widget-stats bg-black">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-shopping-cart fa-fw"></i></div>
			           <?php
			            $lotes_vend = lotes('2',$idempreendimento_cadastro);
			            ?>

			            <div class="stats-title">Lotes Vendidos</div>
			            <div class="stats-number"><?php echo $lotes_vend;  ?> </div>
			            <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                       
                        <div class="stats-desc"> &nbsp;</div>
			        </div>
			    </div>
  <div class="col-md-3 col-sm-6" onclick="location.href='area_cliente_juridico.php?empreendimento_id=<?php echo $idempreendimento_cadastro ?>';">
			        <div class="widget widget-stats bg-black">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-shopping-cart fa-fw"></i></div>
			           <?php
			            $qtd_inadi_juridico = inadi_juridico($idempreendimento_cadastro);
			            ?>

			            <div class="stats-title">Jurídico</div>
			            <div class="stats-number"><?php echo $qtd_inadi_juridico;  ?> </div>
			            <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                       
                        <div class="stats-desc"> &nbsp;</div>
			        </div>
			    </div>

	    <!-- end col-3 -->
			</div>
			<!-- end row -->
			<?php } } ?>
		  <!-- begin row -->
		
		    <!-- end row -->



<!--  AREA DO LOCADOR -->
					<?php
			           if($locador_total != ''){
			        

			            ?>
			           <?php  $total_imoveis_cadastrados = locador_qtd_imoveis($idcliente); ?>



			<!-- begin row -->
			<div class="row">
			    <!-- begin col-3 -->
			    <div class="col-md-3 col-sm-6">
			        <div class="widget widget-stats bg-blue">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
			            <div class="stats-title">Imóveis Cadastrados:</div>
			            <div class="stats-number"><?php echo $total_imoveis_cadastrados; ?> </div>
			            <div class="stats-progress progress">
			          
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                      
                        <div class="stats-desc">   &nbsp;</div>
			        </div>
			    </div>
			    <!-- end col-3 -->
			   
			   			    <!-- begin col-3 -->
			    <div class="col-md-3 col-sm-6">
			        <div class="widget widget-stats bg-blue">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-tags fa-fw"></i></div>
			            	<?php 
			            	$imoveis_locados = locador_qtd_imoveis_locados($idcliente);

			            	?>

			            <div class="stats-title">Imóveis Locados</div>
			            <div class="stats-number"><?php echo $imoveis_locados; ?></div>
			            <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                       
                        <div class="stats-desc">  &nbsp;</div>
			        </div>
			    </div>

			    <!-- end col-3 -->
			    <!-- begin col-3 -->
			  



	    <!-- end col-3 -->
			</div>
			<!-- end row -->
			<?php }  ?>







<!--  fim da area do locador -->
































		
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
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/morris/raphael.min.js"></script>
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/morris/morris.js"></script>

	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->


	<script>
		$(document).ready(function() {
			App.init();
			MorrisChart.init();
		});
               
               </script>	
</body>


</html>
