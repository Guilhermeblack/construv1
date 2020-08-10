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
	

	<?php include "topo_cliente.php"; ?>
	

<?php
function dados_parcela($id){
    include "conexao.php";
    $query_amigo = "SELECT valor_recebido, valor_recebido, empreendimento_id_novo,cliente_id_novo,data_vencimento_parcela, data_recebimento FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $valor_parcelas           = $buscar_amigo["valor_parcelas"];
      $valor_recebido           = $buscar_amigo["valor_recebido"];
    $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
      $data_recebimento         = $buscar_amigo["data_recebimento"];
      $cliente_id_novo         = $buscar_amigo["cliente_id_novo"];
      $empreendimento_id_novo         = $buscar_amigo["empreendimento_id_novo"];

      $dados["valor_parcelas"]       = $valor_parcelas;
      $dados["valor_recebido"]       = $valor_recebido;
      $dados["data_vencimento_parcela"]  = $data_vencimento_parcela;
      $dados["cliente_id_novo"]          = $cliente_id_novo;
      $dados["empreendimento_id_novo"]          = $empreendimento_id_novo;

    }
    return $dados;
}
function dados_user($id){
    include "conexao.php";
     $query_igpm = "SELECT nome_cli, cpf_cli FROM cliente where idcliente = $id";

                $executa_igpm = mysqli_query ($db, $query_igpm) or die ("Erro ao listar Nome User");
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $nome_cli             = $buscar_amigoc['nome_cli'];
             $cpf_cli              = $buscar_amigoc['cpf_cli'];

             $dados["nome_cli"] = $nome_cli;
             $dados["cpf_cli"]  = $cpf_cli;
}
return $dados;

} 

function dados_insumo($idcontrato){
    include "conexao.php";
     $query_igpm = "SELECT descricao FROM insumo 
                    INNER JOIN contrato_receber ON contrato_receber.insumo_id = insumo.id
                    where idcontrato_receber = $idcontrato limit 1";

                $executa_igpm = mysqli_query ($db, $query_igpm) or die ("Erro ao listar Nome User");
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $descricao             = $buscar_amigoc['descricao'];

             $dados["descricao"] = $descricao;
}
return $dados;

} 

function dados_empreendimento($id){
    include "conexao.php";
     $query_igpm = "SELECT quadra, lote FROM empreendimento
                    INNER JOIN produto ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento
                    INNER JOIN lote ON lote.produto_idproduto = produto.idproduto
      where empreendimento_cadastro_id = $id";

                $executa_igpm = mysqli_query ($db, $query_igpm) or die ("Erro ao listar Nome User");
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $quadra             = $buscar_amigoc['quadra'];
             $lote              = $buscar_amigoc['lote'];

             $dados["quadra"] = $quadra;
             $dados["lote"]  = $lote;
}
return $dados;

} 
function dados_empreendedor($id){
    include "conexao.php";
    $query_amigo = "SELECT cliente_id FROM empreendimento_cadastro where idempreendimento_cadastro = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $cliente_id           = $buscar_amigo["cliente_id"];


      $dados["cliente_id"]       = $cliente_id;

    }
    return $dados;
}
function repasse_parcela($id){
	  include "conexao.php";
    $query_amigo = "SELECT comissao_restante, cliente_id, pis, cofins FROM empreendimento
    INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
    				
    				where idempreendimento_cadastro = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

   	while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
   	{
      $comissao_restante  = $buscar_amigo["comissao_restante"];
      $pis                = $buscar_amigo["pis"];
      $cofins             = $buscar_amigo["cofins"];
      $cliente_id         = $buscar_amigo["cliente_id"];

      $dados['comissao_restante']  = $comissao_restante;
      $dados['cofins']  		   = $cofins;
      $dados['pis']  			   = $pis;
      $dados['cliente_id']   	   = $cliente_id;

    }


    return $dados;
}
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
			<h1 class="page-header">Repasse de Parcelas</h1>
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
                        <form action="receber_parcelas_repasse.php" method="POST" name="nome">
                        <h3>Valor Bruto</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                         
                                       <th>ID / Nosso Numero</th>

                                        <th>Cliente</th>
                                         <th>Q/L</th>
                                      
                                        <th>Valor Recebido </th>
                                       
                                        <th>% adm</th>

                                        <th>PIS</th>
                                        <th>COFINS</th>
                                         <th>Valor Repasse (Liquido)</th>
                                    

                                    </tr>
                                </thead>
                                <tbody>
<?php               

              include "conexao.php";

     
                
             $cont = 0; 

      $codigo_repasse = $_GET["idrepasse"];
  
        include "conexao.php";
        $query = "SELECT idparcelas, tipo_venda, cliente_id_novo,empreendimento_id_novo,venda_idvenda, valor_recebido, valor_parcelas, data_recebimento, descricao,situacao,forma_pagamento,repasse_feito,codigo_repasse, tipo_venda, STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') as venc 
                                  FROM parcelas 
                                  WHERE codigo_repasse = $codigo_repasse AND tipo_venda = 2  order by venc Asc"; 
    
        $executar_parcelas = mysqli_query($db, $query);
                while ($buscar_amigo = mysqli_fetch_assoc($executar_parcelas)) {//--verifica se são amigos

                  $id                  = $buscar_amigo["idparcelas"];
                  $tipo_venda                  = $buscar_amigo["tipo_venda"];
                  $venda_idvenda               = $buscar_amigo["venda_idvenda"];
                  $valor_parcelas              = $buscar_amigo["valor_recebido"];
                  $data_vencimento_parcela     = $buscar_amigo["venc"];
                  $data_recebimento            = $buscar_amigo["data_recebimento"];
                  $descricao                   = $buscar_amigo["descricao"];
                  $forma_pagamento             = $buscar_amigo["forma_pagamento"];
                  $situacao_parcela            = $buscar_amigo["situacao"];
                  $repasse_feito               = $buscar_amigo["repasse_feito"];
                  $codigo_repasse              = $buscar_amigo["codigo_repasse"];
                  $fluxo                       = $buscar_amigo["tipo_venda"];
                  $empreendimento_id           = $buscar_amigo["empreendimento_id_novo"];
                  $cliente_id_novo             = $buscar_amigo["cliente_id_novo"];

                 
              $dados_parcela        = dados_parcela($id);
              $dados_user           = dados_user($cliente_id_novo);
              $dados_empreendimento = dados_empreendimento($empreendimento_id);

              // busca todos os dados da parcela
              $repasse_parcela 			= repasse_parcela($empreendimento_id);

              $valor_pis 		        = $repasse_parcela['pis'] / 100;
              $valor_cofins 	      = $repasse_parcela['cofins'] / 100;
              $valor_comissao 	    = $repasse_parcela['comissao_restante'] / 100;


              $nome_cliente_novo = $dados_user["nome_cli"];
              $cpf_cliente_novo  = $dados_user["cpf_cli"];   

              $quadra = $dados_empreendimento["quadra"];
              $lote   = $dados_empreendimento["lote"];

           
         

            



             ?>






                                    <tr>

                                     <td>
 	                                     <input type="hidden" name="cliente_idcliente" value="<?php echo $repasse_parcela['cliente_id'] ?>">
 	                                     <input type="hidden" name="empreendimento_id" value="<?php echo $empreendimento_id ?>">
 	                                     <input type="hidden" name="situacao" value="<?php echo $situacao ?>">
 	                                     <input type="hidden" name="inicio" value="<?php echo $inicio ?>">
 	                                     <input type="hidden" name="fim" value="<?php echo $fim ?>">
 	                                     <input type="hidden" name="idparcelas[]" value="<?php echo $id ?>">



                                     <?php echo $id ?></td>
                                       <td><?php echo "$nome_cliente_novo"." - ".$cpf_cliente_novo; ?></td>
                                         <td><?php echo "$quadra"." / ".$lote; ?></td>
  <td><?php echo 'R$' . number_format($valor_parcelas, 2, ',', '.'); ?></td>
<td>
  		<?php
  		 $valor_total_comissao = ($valor_comissao * $valor_parcelas);
  		 echo 'R$' . number_format($valor_total_comissao, 2, ',', '.'); ?>
  		 	
  </td>
  <td>
  		<?php 
  		 $valor_total_pis = ($valor_pis * $valor_parcelas);
  		 echo 'R$' . number_format($valor_total_pis, 2, ',', '.'); ?>
  			
</td>
 <td>
  		<?php
  		$valor_total_cofins = ($valor_cofins * $valor_parcelas);
  		echo 'R$' . number_format($valor_total_cofins, 2, ',', '.'); ?></td>  
 <td>
   <?php 
  		
  		$valor_repasse_liquido = $valor_parcelas - $valor_total_comissao - $valor_total_pis - $valor_total_cofins;

  		echo 'R$' . number_format($valor_repasse_liquido, 2, ',', '.'); ?>
  	
  </td>  
                                    
                                      
                                    </tr>
                               <?php



  			  $cont 		 = $cont + $valor_parcelas;
              $cont_comissao = $cont_comissao + $valor_total_comissao;
              $cont_pis 	 = $cont_pis + $valor_total_pis;
              $cont_cofins   = $cont_cofins + $valor_total_cofins;
              $cont_liquido  = $cont_liquido + $valor_repasse_liquido;






                                } ?>
                               <tr>
	                               	<td></td>
                                   <td></td>
                                      <td></td>
	                               	<td> 

	                               	<span class="label label-success">	Total Recebido:</span><br> <h5><?php echo ' R$ ' . number_format($cont, 2, ',', '.');  ?></h5>
	                               	</td>
	                               	<td><span class="label label-success">	Total Adm:</span><br> <h5><?php echo ' R$ ' . number_format($cont_comissao, 2, ',', '.');  ?></h5></td>
	                               	<td><span class="label label-success">	Total PIS:</span><br> <h5><?php echo ' R$ ' . number_format($cont_pis, 2, ',', '.');  ?></h5></td>
	                               	<td><span class="label label-success">	Total COFINS:</span><br> <h5><?php echo ' R$ ' . number_format($cont_cofins, 2, ',', '.');  ?></h5></td>
	                               	<td><span class="label label-success">	Total Liquido :</span><br> <h5><?php echo ' R$ ' . number_format($cont_liquido, 2, ',', '.');  ?></h5></td>
                               	
                               </tr>

                              
                            
                                </tbody>
                            </table>


<!--Despesas lançadas para o Empreendedor     -->

  <h3>Despesas</h3>

                              <table class="table table-striped">
                                <thead>
                                    <tr>
                                         
                                       <th>ID / Nosso Numero</th>
                                        <th>Descrição</th>
                                      
                                        <th>Valor Parcela </th>
                                       
                                        <th>Data de Vencimento</th>

                                    
                                    

                                    </tr>
                                </thead>
                                <tbody>
<?php               
                    $dados_empreendedor = dados_empreendedor($empreendimento_id);
                    $idempreendedor = $dados_empreendedor["cliente_id"];


              include "conexao.php";
              $tabela_periodo = 'data_vencimento_parcela';
              $inicio = '2000-01-01';
              $mes = date('m');
              $ano = date('Y');
              $ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano));
              $fim = $ano."-".$mes."-".$ultimo_dia;
        
 $situacao_and .=" AND STR_TO_DATE(".$tabela_periodo.", '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";
              $cont_parcelas_pagar =0;
                $query_pagar = "SELECT * From parcelas           
                                WHERE codigo_repasse = $codigo_repasse and tipo_venda = 4";

                $executa_pagar = mysqli_query($db, $query_pagar);

              while ($row_pagar = mysqli_fetch_assoc($executa_pagar)) {
                    $idparcelas              = $row_pagar['idparcelas'];
                    $valor_parcelas_pagar          = $row_pagar['valor_parcelas'];
                    $data_vencimento_parcela = $row_pagar['data_vencimento_parcela'];
                    $idcontrato = $row_pagar['venda_idvenda'];


                    $dados_insumo = dados_insumo($idcontrato);

                            
                       

         
?>


                                    <tr>

                                     <td>
                                      
                                       <input type="hidden" name="despesas_idparcelas[]" value="<?php echo $idparcelas ?>">



                                     <?php echo $idparcelas ?></td>
                                      <td><?php echo $dados_insumo["descricao"] ?></td>
  <td><?php echo 'R$' . number_format($valor_parcelas_pagar, 2, ',', '.'); ?></td>
  <td><?php echo $data_vencimento_parcela ?></td>



 
                                    
                                      
                                    </tr>
                               <?php



          $cont_parcelas_pagar      = $cont_parcelas_pagar + $valor_parcelas_pagar;
       






                                } ?>
                               <tr>
                                  <td></td>  <td></td>
                                  <td> 

                                  <span class="label label-danger">  Total Despesas:</span><br> <h5><?php echo ' R$ ' . number_format($cont_parcelas_pagar, 2, ',', '.');  ?></h5>
                                  </td>
                                  <td></td>
                                         <td></td>
                                 
                                
                               </tr>

                              
                            
                                </tbody>
                            </table>



<h3>
 <span class="label label-primary">Valor Líquido</span></h3> 

  <h4><?php 

$total_final_liquido = ($cont_liquido-$cont_parcelas_pagar);

  echo ' R$ ' . number_format($total_final_liquido, 2, ',', '.');  ?></h4>

          



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
$(".valor_parcelas").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })


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
