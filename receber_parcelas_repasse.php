<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";
function dados_parcela($id){
    include "conexao.php";
    $query_amigo = "SELECT  numero_sequencia, valor_recebido, valor_recebido, descricao, empreendimento_id_novo,cliente_id_novo,data_vencimento_parcela, data_recebimento FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $valor_parcelas          = $buscar_amigo["valor_parcelas"];
      $valor_recebido          = $buscar_amigo["valor_recebido"];
      $data_vencimento_parcela = $buscar_amigo["data_vencimento_parcela"];
      $data_recebimento        = $buscar_amigo["data_recebimento"];
      $cliente_id_novo         = $buscar_amigo["cliente_id_novo"];
      $empreendimento_id_novo  = $buscar_amigo["empreendimento_id_novo"];
      $descricao               = $buscar_amigo["descricao"];
      $numero_sequencia        = $buscar_amigo["numero_sequencia"];

      $dados["numero_sequencia"]           = $numero_sequencia;
      $dados["valor_parcelas"]             = $valor_parcelas;
      $dados["valor_recebido"]             = $valor_recebido;
      $dados["data_vencimento_parcela"]    = $data_vencimento_parcela;
      $dados["cliente_id_novo"]            = $cliente_id_novo;
      $dados["cliente_id_novo"]            = $cliente_id_novo;
      $dados["empreendimento_id_novo"]     = $empreendimento_id_novo;
      $dados["descricao"]                  = $descricao;
      $dados["data_recebimento"]           = $data_recebimento;

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
     $query_igpm = "SELECT quadra, lote FROM parcelas
                    INNER JOIN venda ON parcelas.venda_idvenda = venda.idvenda
                    INNER JOIN produto ON venda.produto_idproduto = produto.idproduto
                    INNER JOIN lote ON venda.lote_idlote = lote.idlote
      where idparcelas = $id";

                $executa_igpm = mysqli_query ($db, $query_igpm) or die ("Erro ao listar Nome User");
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $quadra             = $buscar_amigoc['quadra'];
             $lote              = $buscar_amigoc['lote'];

             $dados["quadra"] = $quadra;
             $dados["lote"]  = $lote;
}
return $dados;

} 

if(isset($_POST["valor_total"])){

				$data_lancamento = date('d-m-Y');

  				$empreendimento_id 			  = $_POST["empreendimento_id"];
  				$fornecedor_idfornecedor 	= $_POST["cliente_idcliente"];
          $situacao 				        = $_POST["situacao"];
          $inicio	 				          = $_POST["inicio"];
          $fim 					            = $_POST["fim"];
          $valor_total 		          = $_POST["valor_total"];
				  $data_repasse 		        = $_POST["data_repasse"];
				  $data_repasse             = date("d-m-Y", strtotime($data_repasse));
          $antecipar_t              = $_POST["idparcelas"];
          $despesas_idparcelas      = $_POST["despesas_idparcelas"];
          $repasse_por              = $_POST["repasse_por"];

	include "conexao.php";

	



	 $inserir = mysqli_query($db, "INSERT INTO contrato_pagar(fornecedor_idfornecedor, centrocusto_id, valor_parcelas, qtd_parcelas, data_vencimento, data_lancamento, empreendimento_id, tipo_venda) values('$fornecedor_idfornecedor',2,'$valor_total',1,'$data_repasse','$data_lancamento','$empreendimento_id', 3)");

	 $venda_idvenda = mysqli_insert_id($db);


$lancamento_repasse = mysqli_query($db, "INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
centrocusto_id,
fluxo,
cliente_id_novo,
empreendimento_id_novo
)

values (
'$venda_idvenda',
'$valor_total',
'$data_repasse',
'Em Aberto',
'Repasse empreendimento',
'3',  
'2',
'1',
'$fornecedor_idfornecedor',
'$empreendimento_id'

)");
 $codigo_repasse = mysqli_insert_id($db);
foreach($antecipar_t as $id){

		

		$inserir_update_repasse = "UPDATE parcelas set 
									repasse_feito = '1', 
									codigo_repasse = '$codigo_repasse' 
									WHERE idparcelas = '$id'";
 		$executa_query = mysqli_query ($db, $inserir_update_repasse);
             
	}  


////////  foreach das parcelas de despesas
foreach($despesas_idparcelas as $id){

  $dados = dados_parcela($id);  
  $valor_parcela = $dados["valor_parcelas"];
  $cod_baixa = date('Y-m-d H:i:s');

        $cod_baixa = str_replace("-","", $cod_baixa);
        $cod_baixa = str_replace(":","", $cod_baixa);
        $cod_baixa = str_replace(" ","", $cod_baixa);
    $inserir_update_despesas = "UPDATE parcelas set     
                              situacao  ='Pago',
                              data_recebimento = '$data_lancamento',
                              valor_recebido   = '$valor_parcela',
                              forma_pagamento  = '1',          
                              contacorrente_id = '2',
                              cod_baixa        = '$cod_baixa',
                              baixado_por      = '$repasse_por',
                              data_baixa       = '$data_lancamento',
                              codigo_repasse   = '$codigo_repasse' 
                              WHERE idparcelas = '$id'";
    $executa_despesas = mysqli_query ($db, $inserir_update_despesas);
             
  }  




?>

<script type="text/javascript">
	window.location="repasse.php?empreendimento_id=<?php echo $empreendimento_id ?>&inicio=<?php echo $inicio ?>&fim=<?php echo $fim ?>&situacao=<?php echo $situacao ?>";
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
	
	  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="https://immobilebusiness.com.br/admin/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/css/animate.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/css/style.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/css/style-responsive.min.css" rel="stylesheet" />
  <link href="https://immobilebusiness.com.br/admin/assets/css/theme/default.css" rel="stylesheet" id="theme" />

       <link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
          <link href="https://immobilebusiness.com.br/admin/assets/css/multiple-select.css" rel="stylesheet"/>

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
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	

	<?php include "topo.php" ?>
	

<?php

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
    $query_amigo = "SELECT comissao_entrada, comissao_restante, cliente_id, pis, cofins FROM empreendimento
    				INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
    				where idempreendimento_cadastro = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

   	while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
   	{
      $comissao_entrada   = $buscar_amigo["comissao_entrada"];
      $comissao_restante  = $buscar_amigo["comissao_restante"];
      $pis                = $buscar_amigo["pis"];
      $cofins             = $buscar_amigo["cofins"];
      $cliente_id         = $buscar_amigo["cliente_id"];

      $dados['comissao_entrada']  = $comissao_entrada;
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
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                         
                                       <th>ID / Nosso Numero</th>
                                       <th>Q</th>
                                       <th>L</th>
                                       <th>Nº Parcela</th>
                                       <th>Data Recebimento</th>
                                       <th>Cliente</th>
                                       <th>Valor Recebido </th>
                                       <th>% adm</th>
                                       <th>Descrição Parcela</th> 
                                       <th>PIS</th>
                                       <th>COFINS</th>
                                       <th>Valor Repasse (Liquido)</th>
                                    

                                    </tr>
                                </thead>
                                <tbody>
<?php               

              include "conexao.php";

              $empreendimento_id 		= $_POST["empreendimento_id"];
              $situacao 				    = $_POST["situacao"];

              $inicio	 				      = $_POST["inicio"];
              $fim 						      = $_POST["fim"];

              $antecipar 				    = $_POST["antecipar"];
                
             $cont = 0; 

             foreach($antecipar as $id){

              // busca todos os dados da parcela
              $dados_parcela 			= dados_parcela($id);
              $repasse_parcela 		= repasse_parcela($empreendimento_id);

              $valor_pis 		  = $repasse_parcela['pis'] / 100;
              $valor_cofins 	= $repasse_parcela['cofins'] / 100;
              $valor_comissao = $repasse_parcela['comissao_restante'] / 100;
              $valor_entrada  = $repasse_parcela['comissao_entrada'] / 100;



              // alimenta as variaveis 
              $valor_parcelas 			    = $dados_parcela["valor_recebido"];
              $data_vencimento_parcela  = $dados_parcela["data_vencimento_parcela"];
              $cliente_id_novo          = $dados_parcela["cliente_id_novo"];
              $empreendimento_id_novo   = $dados_parcela["empreendimento_id_novo"];
              $descricao_parcela        = $dados_parcela["descricao"];
              $numero_sequencia         = $dados_parcela["numero_sequencia"];
              $data_recebimento         = $dados_parcela["data_recebimento"];

              $dados_user = dados_user($cliente_id_novo);
              $dados_empreendimento = dados_empreendimento($id);
          
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
        <td><?php echo $quadra ?></td>
  <td><?php echo $lote; ?></td>
  <td><?php echo $numero_sequencia; ?></td>
  <td><?php echo $data_recebimento; ?></td>

  <td><?php echo "$nome_cliente_novo"." - ".$cpf_cliente_novo; ?></td>

  <td><?php echo 'R$' . number_format($valor_parcelas, 2, ',', '.'); ?></td>
<td>
  		<?php
        if($descricao_parcela == 'Parcelamento Entrada'){
           $valor_total_comissao = ($valor_entrada * $valor_parcelas);
        }elseif($descricao_parcela == 'Financiamento'){
           $valor_total_comissao = ($valor_comissao * $valor_parcelas);

        }else{
          $valor_total_comissao = 0;
        }
  		 echo 'R$' . number_format($valor_total_comissao, 2, ',', '.'); ?>
  		 	
  </td>

    <td><?php echo $descricao_parcela; ?></td>

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
	                               	<td>Total</td>
                                        <td></td>
                                              <td></td>
                                               <td></td> <td></td> <td></td>   
                                                <td> 

                                  <span class="label label-success" style="font-size: 14px !important"> <?php echo ' R$ ' . number_format($cont, 2, ',', '.');  ?></span>
                                  </td>
	                             
                                

	                               	<td><span class="label label-success" style="font-size: 14px !important"><?php echo ' R$ ' . number_format($cont_comissao, 2, ',', '.');  ?></span></td>

                                 <td></td>
                                 
	                               	<td><span class="label label-success" style="font-size: 14px !important"><?php echo ' R$ ' . number_format($cont_pis, 2, ',', '.');  ?></span</td>

	                               	<td><span class="label label-success" style="font-size: 14px !important"><?php echo ' R$ ' . number_format($cont_cofins, 2, ',', '.');  ?></span></td>

	                               	<td><span class="label label-success" style="font-size: 14px !important"><?php echo ' R$ ' . number_format($cont_liquido, 2, ',', '.');  ?></span></td>
                               	
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
                                WHERE situacao = 'Em Aberto' AND cliente_id_novo = $idempreendedor AND fluxo = 0 AND empreendimento_id_novo = $empreendimento_id $situacao_and";

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
                                  <td></td>
                                        <td></td>
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

              <table class="table table-striped">
                                <thead>
                                    <tr>
                                      <th>Data de Pagamento</th>
                                      <th> <input type="date" name="data_repasse" class="form-control" placeholder="Data de Repasse" required=""> </th>
                                      <th><input type="hidden" name="valor_total" value="<?php echo $total_final_liquido ?>"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                  <tr>
                                     <td><input type="submit" class="btn btn-success" name="Confirmar" value="Confirmar"></td>
                                     <td></td>
                                     <td></td>
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

$(function(){
$(".valor_parcelas").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })


</script>


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
  <script src="https://immobilebusiness.com.br/admin/assets/js/form-plugins.demo.min.js"></script>
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
            FormPlugins.init();

    });
  </script>

</body>

</html>
