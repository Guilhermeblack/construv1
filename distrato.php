<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";


if(isset($_POST["valor_devolver"])){


  $idvenda           = $_GET["idvenda"];
  $valor_amortizado  = $_POST["valor_amortizado"];
	$valor_lote        = $_POST["valor_lote"];
  $valor_custo       = $_POST["valor_custo"];
  $valor_devolver    = $_POST["valor_devolver"];

  $obs          = $_POST["obs"];
  $feito_por    = $_POST["feito_por"];
  $idlote       = $_POST["idlote"];

  $data_distrato = date("d-m-Y");


include "conexao.php";
	/// Atualiza nome  no contrato
	$atualiza_contrato = "INSERT INTO distrato (venda_id, valor_amortizado, valor_lote, valor_custo, valor_devolver, obs, feito_por, data_distrato) values('$idvenda','$valor_amortizado','$valor_lote', '$valor_custo', '$valor_devolver', '$obs', '$feito_por','$data_distrato')";

	$executa_atualiza = mysqli_query($db, $atualiza_contrato);



}

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
	   <link href="https://immobilebusiness.com.br/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
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
		<!-- begin #header -->
		<?php include "topo.php" ?>


<?php 

	$venda_idvenda 				      = $_GET["idvenda"];
	$empreendimento_cadastro_id = $_GET["idempreendimento"];
		include "conexao.php";
			$query_amigo =  "SELECT * FROM venda
                       INNER JOIN lote ON venda.lote_idlote = lote.idlote
                       INNER JOIN produto ON venda.produto_idproduto = produto.idproduto
                       INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                       INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                       WHERE idvenda = $venda_idvenda";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar Locador");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
               
                       
                  $idlote                                = $buscar_amigo["idlote"];
                  $quadra                                = $buscar_amigo["quadra"];
                  $lote                                  = $buscar_amigo["lote"];
                  $m2                                    = $buscar_amigo["m2"];
                  $matricula                             = $buscar_amigo["matricula"];
                  $descricao_empreendimento              = $buscar_amigo["descricao_empreendimento"];
                  $cliente_idcliente                     = $buscar_amigo["cliente_idcliente"];
                  $data_venda                            = $buscar_amigo["data_venda"];
                  $cadastrado_por                        = $buscar_amigo["cadastrado_por"];
                  $idempreendimento_cadastro             = $buscar_amigo["idempreendimento_cadastro"];
                  $empreendimento_id                     = $buscar_amigo["idempreendimento"];
                  $igpm                                  = $buscar_amigo["igpm"];

                  $valor_desconto                        = $buscar_amigo["valor_desconto"];


            $valor_total_entrada3         = $buscar_amigo["valor_entrada"];  // SINAL
            $valor_total_entrada4         = $buscar_amigo["entrada_restante"];  // ENTRADA NORMAL TOTAL

            $parcela_entrada              = $buscar_amigo["parcela_entrada"]; // QUANTIDADE ENTRADA NORMAL
            $plano_pagamento              = $buscar_amigo["plano_pagamento"]; // QUANTIDADE FINANCIAMENTO
            $valor_parcela_financiamento  = $buscar_amigo["valor_parcela_financiamento"];  // VALOR DA PARCELA DO FINAN
            $valor_parcela_entrada        = $buscar_amigo["valor_parcela_entrada"]; // VALOR DA PARCELA JA NA PRICE

            $inter_qtd                    = $buscar_amigo["inter_qtd"]; // Quantidade parcelas intermediarias
            $inter_valor                  = $buscar_amigo["inter_valor"]; // valor da parcela intermediaria
            $inter_data                   = $buscar_amigo["inter_data"]; // data da primeira intermediaria
            $inter_periodo                = $buscar_amigo["inter_periodo"]; // data da primeira intermediaria
            $valor_total_do_contrato               = $buscar_amigo["valor_desconto"]; // data da primeira intermediaria

           $valor_total_do_contrato_exibir      = ($parcela_entrada * $valor_parcela_entrada) + ($plano_pagamento * $valor_parcela_financiamento) + $valor_total_entrada3 + ($inter_qtd * $inter_valor);

                
                  
            

             }





function valor_taxa($idvenda, $tipo_venda){
    include "conexao.php";
    $query_amigo = "SELECT taxa_financiamento FROM venda where idvenda = $idvenda";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $taxa_financiamento           = $buscar_amigo["taxa_financiamento"];
    }
    return $taxa_financiamento;
}

function valor_convertido($id, $idvenda, $tipo){
    include "conexao.php";
  $hoje = date('Y-m-d');
    $query_amigo = "SELECT data_vencimento_parcela, valor_parcelas FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
      $valor_parcelas           = $buscar_amigo["valor_parcelas"];

  }

$time_inicial = strtotime($hoje);
$time_final_tratar = geraTimestamp($data_vencimento_parcela);
$time_final = strtotime($time_final_tratar);

$diferenca = $time_final - $time_inicial; 


if($diferenca > 0){

$dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias
$juros = valor_taxa($idvenda, $tipo) /100 +1;

$divt = $dias / 30;

$potencia = pow($juros,$divt);

$valor_convertido = $valor_parcelas / $potencia;

}else{

   $diferenca2 = $time_inicial - $time_final; 

    $dias2 = (int)floor( $diferenca2 / (60 * 60 * 24)); // 225 dias

    $multa2 = ($valor_parcelas * (2/100));
    $juros2 = ($valor_parcelas * (0.033/100) * $dias2);

    $valor_convertido = $valor_parcelas + $multa2 + $juros2;


}

   
return $valor_convertido;
}
function valor_total_pago($idvenda)
{
  include "conexao.php";
  $query_amigo323 = "SELECT idparcelas  FROM parcelas where venda_idvenda = '$idvenda' AND tipo_venda = '2' AND situacao = 'Pago' and fluxo = '0'";
  $executa_query323 = mysqli_query($db,$query_amigo323);
   $cont = 0;
    while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se são amigos
            
            $idparcelas         = $buscar_amigo323['idparcelas'];

            $valor_convertido = valor_total_pago_parcelas($idparcelas, $idvenda, 2);

            $cont = $cont + $valor_convertido;
        }
          
  return $cont;
}
function saldo_devedor($idvenda)
{
  include "conexao.php";
  $query_amigo323 = "SELECT idparcelas  FROM parcelas where venda_idvenda = '$idvenda' AND tipo_venda = '2' AND situacao = 'Em Aberto' and fluxo = '0'";
  $executa_query323 = mysqli_query($db,$query_amigo323);
   $cont = 0;
    while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se são amigos
            
            $idparcelas         = $buscar_amigo323['idparcelas'];

            $valor_convertido = valor_convertido($idparcelas, $idvenda, 2);

            $cont = $cont + $valor_convertido;
        }
          
  return $cont;
}
function total_juros_multa($idvenda)
{
  include "conexao.php";
  $query_amigo323 = "SELECT idparcelas  FROM parcelas where venda_idvenda = '$idvenda' AND tipo_venda = '2' AND situacao = 'Em Aberto' and fluxo = '0'";
  $executa_query323 = mysqli_query($db,$query_amigo323);
   $cont = 0;
    while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se são amigos
            
            $idparcelas         = $buscar_amigo323['idparcelas'];

            $valor_convertido = total_juros($idparcelas, $idvenda, 2);

            $cont = $cont + $valor_convertido;
        }
          
  return $cont;
}

function valor_com_juros_multa($idvenda)
{
  include "conexao.php";
  $query_amigo323 = "SELECT idparcelas  FROM parcelas where venda_idvenda = '$idvenda' AND tipo_venda = '2' AND situacao = 'Em Aberto' and fluxo = '0'";
  $executa_query323 = mysqli_query($db,$query_amigo323);
   $cont = 0;
    while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se são amigos
            
            $idparcelas         = $buscar_amigo323['idparcelas'];

            $valor_convertido = valor_parcelas_com_juros($idparcelas, $idvenda, 2);

            $cont = $cont + $valor_convertido;
        }
          
  return $cont;
}

function valor_sem_juros_multa($idvenda)
{
  include "conexao.php";
  $query_amigo323 = "SELECT idparcelas  FROM parcelas where venda_idvenda = '$idvenda' AND tipo_venda = '2' AND situacao = 'Em Aberto' and fluxo = '0'";
  $executa_query323 = mysqli_query($db,$query_amigo323);
   $cont = 0;
    while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se são amigos
            
            $idparcelas         = $buscar_amigo323['idparcelas'];

            $valor_convertido = valor_parcelas_sem_juros($idparcelas, $idvenda, 2);

            $cont = $cont + $valor_convertido;
        }
          
  return $cont;
}
function parcelas_em_aberto($idvenda)
{
  include "conexao.php";
  $query_amigo323 = "SELECT SUM(valor_parcelas) as total  FROM parcelas where venda_idvenda = '$idvenda' AND tipo_venda = '2' AND situacao = 'Em Aberto' and fluxo = '0'";
  $executa_query323 = mysqli_query($db,$query_amigo323);
   
    while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se são amigos
            
            $total         = $buscar_amigo323['total'];
        }
          
  return $total;
}

function busca_renegociar($idvenda)
{
  include "conexao.php";
  $query_amigo323 = "SELECT * FROM venda_renegociacao where venda_id = '$idvenda'";
  $executa_query323 = mysqli_query($db,$query_amigo323);
  $total = mysqli_num_rows($executa_query323);
          
  return $total;
}






function dados_cliente($idcliente)
{
  include "conexao.php";
  $query_amigo323 = "SELECT * FROM cliente where idcliente = '$idcliente'";
  $executa_query323 = mysqli_query ($db,$query_amigo323) or die ("Erro ao listar dados cliente");
                
                
            while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se são amigos
            
            $nome_cli         = $buscar_amigo323['nome_cli'];
            $telefone1_cli    = $buscar_amigo323['telefone1_cli'];
            $telefone2_cli    = $buscar_amigo323['telefone2_cli'];
            $cpf_cli          = $buscar_amigo323['cpf_cli'];
            $rg_cli           = $buscar_amigo323['rg_cli'];

            $dados['nome_cli']      = $nome_cli;
            $dados['telefone1_cli'] = $telefone1_cli;
            $dados['telefone2_cli'] = $telefone2_cli;
            $dados['cpf_cli']       = $cpf_cli;
            $dados['rg_cli']        = $rg_cli;

            }

            return $dados;
}
function geraTimestamp($data) {
$partes = explode('-', $data);
$tratada = $partes[2].'-'.$partes[1].'-'.$partes[0];
return $tratada;
}



function total_juros($id, $idvenda, $tipo){
    include "conexao.php";
  $hoje = date('Y-m-d');
    $query_amigo = "SELECT data_vencimento_parcela, valor_parcelas FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);
$cont = 0;
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
      $valor_parcelas           = $buscar_amigo["valor_parcelas"];

  }

$time_inicial = strtotime($hoje);
$time_final_tratar = geraTimestamp($data_vencimento_parcela);
$time_final = strtotime($time_final_tratar);

$diferenca = $time_final - $time_inicial; 


if($diferenca < 0){

   $diferenca2 = $time_inicial - $time_final; 

    $dias2 = (int)floor( $diferenca2 / (60 * 60 * 24)); // 225 dias

    $multa2 = ($valor_parcelas * (2/100));
    $juros2 = ($valor_parcelas * (0.033/100) * $dias2);

    $multa_total =  $multa2 + $juros2;




}

   
return $multa_total;
}

function valor_total_pago_parcelas($id, $idvenda, $tipo){
    include "conexao.php";
  $hoje = date('Y-m-d');
    $query_amigo = "SELECT valor_recebido FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);
$cont = 0;
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $valor_recebido           = $buscar_amigo["valor_recebido"];

  }



   
return $valor_recebido;
}

function valor_parcelas_com_juros($id, $idvenda, $tipo){
    include "conexao.php";
  $hoje = date('Y-m-d');
    $query_amigo = "SELECT data_vencimento_parcela, valor_parcelas FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);
$cont = 0;
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
      $valor_parcelas           = $buscar_amigo["valor_parcelas"];

  }

$time_inicial = strtotime($hoje);
$time_final_tratar = geraTimestamp($data_vencimento_parcela);
$time_final = strtotime($time_final_tratar);

$diferenca = $time_final - $time_inicial; 


if($diferenca < 0){

   $diferenca2 = $time_inicial - $time_final; 

    $dias2 = (int)floor( $diferenca2 / (60 * 60 * 24)); // 225 dias

    $multa2 = ($valor_parcelas * (2/100));
    $juros2 = ($valor_parcelas * (0.033/100) * $dias2);

    $multa_total = $valor_parcelas + $multa2 + $juros2;




}

   
return $multa_total;
}

function valor_parcelas_sem_juros($id, $idvenda, $tipo){
    include "conexao.php";
  $hoje = date('Y-m-d');
    $query_amigo = "SELECT data_vencimento_parcela, valor_parcelas FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);
$cont = 0;
    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
      $valor_parcelas           = $buscar_amigo["valor_parcelas"];

  }

$time_inicial = strtotime($hoje);
$time_final_tratar = geraTimestamp($data_vencimento_parcela);
$time_final = strtotime($time_final_tratar);

$diferenca = $time_final - $time_inicial; 


if($diferenca < 0){



    $valor_parcelas = $valor_parcelas;




}else{
  $valor_parcelas = 0;
}

   
return $valor_parcelas;
}



?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
		
			<!-- end breadcrumb -->
			<!-- begin page-header -->
				<h1 class="page-header"> CANCELAMENTO DE COMPROMISSO DE COMPRA E VENDA DE LOTE </h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
                <!-- begin col-12 -->
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
                            <h4 class="panel-title">Informações</h4>
             
                        </div>
                        <div class="panel-body">
								<div id="wizard">
									<ol>
										<li>
										    Identificação 
										    <small>Informe os dados do Cancelamento:</small>
										</li>
										
										
										
										
									</ol>
									<!-- begin wizard step-1 -->
									<div class="wizard-step-1">
                                     
								

                                        <fieldset>
                                            <legend class="pull-left width-full">Identificação</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-6">
													<div class="form-group block1">
														<label>Valor Pago:	<?php

										$valor_total_pago = valor_total_pago($venda_idvenda);

										 echo ' R$ ' . number_format($valor_total_pago, 2, ',', '.'); 

										 ?></label><br><br>
									<label> </label>
									

													</div>
                                                </div>

                                                  <div class="col-md-6">
													<div class="form-group block1">
														<label>Valor do Contrato:   <?php echo  'R$ ' . number_format($valor_total_do_contrato_exibir, 2, ',', '.');  ?>

</label><br><br>
									<label> </label>
											
                                                </div>
                                          
                                     
                                                <!-- end col-4 -->
                                            </div>
  <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Descrição</th>
                                       	<th>% de custo</th>
                                       	<th>Impacto Custo</th>
										<th>Valor</th>                                      
                                        <th></th>
                         

                                    </tr>
                                </thead>
                                <tbody>
<?php 
			$idvenda = $_GET["idvenda"];

            include "conexao.php";
            $query_amigo = "SELECT * from custo_distrato where empreendimento_id = $empreendimento_cadastro_id order by idcusto_distrato desc";
                $executa_query = mysqli_query ($db, $query_amigo);
                
            $cont_despesa = 0;    
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
            
            $idcusto_distrato = $buscar_amigo["idcusto_distrato"];
            $descricao_custo  = $buscar_amigo["descricao_custo"];
	    	$percentual_custo       = $buscar_amigo["percentual_custo"];
	    	$impacto_custo    = $buscar_amigo["impacto_custo"];
          

          	  if($impacto_custo == 1){
             	$exibir_impacto = $valor_total_do_contrato * ($percentual_custo/100);
             	$exibir = "Valor do Contrato";

             }else{
             	$exibir_impacto = $valor_total_pago * ($percentual_custo /100);
             	$exibir = "Valor Pago";

             }
            

            $cont_despesa = $cont_despesa + $exibir_impacto;

             ?>

 


                      <tr>
                        
                        <td><?php echo $descricao_custo ?> </td>
                        <td><?php echo $percentual_custo ?> </td>
                        <td><?php echo $exibir ?> </td>
                        <td><?php echo 'R$' . number_format($exibir_impacto, 2, ',', '.'); ?> </td>
                       
                        <td></td>


                        
                      
                      </tr>
                      
               <?php } ?>

                      <tr>
                        
                        <td>TOTAL DE CUSTOS</td>
                        <td></td>
                        <td></td>
                        <td> </td>
                       
                        <td><?php echo 'R$' . number_format($cont_despesa, 2, ',', '.'); ?></td>


                        
                      
                      </tr>

  <tr>
                        
                        <td>TOTAL A DEVOLVER</td>
                        <td></td>
                        <td></td>
                        <td> </td>
                       
                        <td><?php 

                        $total_devolver = $valor_total_pago - $cont_despesa;

                        echo 'R$' . number_format($total_devolver, 2, ',', '.'); ?></td>


                        
                      
                      </tr>

                  
                       
                                </tbody>
                            </table>
            <form method="POST" action="distrato.php?idvenda=<?php echo $venda_idvenda ?>&idempreendimento=<?php echo $empreendimento_cadastro_id ?>">


              <input type="hidden" name="valor_amortizado" value="<?php echo $valor_total_pago ?>">
              <input type="hidden" name="valor_lote" value="<?php echo $valor_total_do_contrato_exibir ?>">
              <input type="hidden" name="valor_custo" value="<?php echo $cont_despesa ?>">
              <input type="hidden" name="valor_devolver" value="<?php echo $total_devolver ?>">

              <input type="hidden" name="feito_por" value="<?php echo $imobiliaria_idimobiliaria ?>">
              <input type="hidden" name="idlote" value="<?php echo $idlote ?>">



  <div class="row">
                                                <!-- begin col-4 -->
                  <div class="col-md-12">
                          <div class="form-group block1">
                            <label>Observações:</label><br><br>
                  <label> </label>
                  
                  <textarea name="obs" class="form-control"></textarea>
                          </div>
                                                </div>

                       <div class="col-md-6">
                          <div class="form-group block1">
                  <label> </label>
                  
                  <input type="submit" name="gravar" value="Confirmar" class="btn btn-success">
                          </div>
                                                </div>

                                              </form>
										</fieldset>
									</div>
									<!-- end wizard step-1 -->
									
     

                        
								</div>
							
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->








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

                          
                            <h4 class="panel-title">Cancelamento:</h4>



                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Valor Amortizado</th>
                                        <th>Valor do Lote</th>
                                        <th>Custo do Cancelamento</th>                                      
                                        <th>Valor a Devolver</th>
                                        <th>Feito por</th>
                                        <th></th>
                         

                                    </tr>
                                </thead>
                                <tbody>
<?php 
            $idvenda = $_GET["idvenda"];

                      include "conexao.php";
                $query_amigo = "SELECT * from distrato where venda_id = $idvenda order by iddistrato desc";
                $executa_query = mysqli_query ($db, $query_amigo);
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
            
            $valor_amortizado   = $buscar_amigo["valor_amortizado"];
            $valor_lote         = $buscar_amigo["valor_lote"];
            $valor_custo        = $buscar_amigo["valor_custo"];
            $valor_devolver     = $buscar_amigo["valor_devolver"];
            $data_distrato      = $buscar_amigo["data_distrato"];
            $feito_por          = $buscar_amigo["feito_por"];
            $iddistrato         = $buscar_amigo["iddistrato"];
            

             ?>

 


                      <tr>
             <td><?php echo 'R$' . number_format($valor_amortizado, 2, ',', '.'); ?></td>
             <td><?php echo 'R$' . number_format($valor_lote, 2, ',', '.'); ?></td>
             <td><?php echo 'R$' . number_format($valor_custo, 2, ',', '.'); ?></td>
             <td><?php echo 'R$' . number_format($valor_devolver, 2, ',', '.'); ?></td>
             <td><?php echo $data_distrato ?></td>


                        <td><?php echo nome_user($feito_por); ?> </td>
                        <td> 

                                <div class="btn-group m-r-5 m-b-5">
                <a href="javascript:;" class="btn btn-primary">Imprimir Cancelamento</a>
                <a href="javascript:;" data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu pull-right">
                  <?php 
                    include "conexao.php";
                    $query_distrato =  "SELECT * FROM modelo_contrato                      
                                     WHERE tipo_doc = 5 AND empreendimento_id = $empreendimento_cadastro_id";

                $executa_distrato = mysqli_query ($db,$query_distrato) or die ("Erro ao listar Locador");
                while ($buscar_distrato = mysqli_fetch_assoc($executa_distrato)) {//--verifica se são amigos
               
                       
                  $descricao_modelo    = $buscar_distrato["descricao_modelo"];
                  $modelo_id           = $buscar_distrato["idmodelo_contrato"];

                  ?>
                  <li><a href="contratolocacao/distrato.php?idvenda=<?php echo $idvenda ?>&iddistrato=<?php echo $iddistrato ?>&modelo_id=<?php echo $modelo_id ?>"><?php echo $descricao_modelo ?></a></li>

                <?php } ?>
                 
                </ul>
              </div>


                 </td>

                        
                      
                      </tr>
                      
               <?php } ?>

                  
                       
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
            
          </div>






























            </div>
            <!-- end row -->


		</div>
		
		
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
$("#percentual").maskMoney({symbol:'', 
showSymbol:false, thousands:'', decimal:'.', symbolStay: true});
 })

$(function(){
$("#valor_parcelas").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })


$(function(){
$("#valor_taxa").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })

$(function(){
$("#quantidade_parcelas").maskMoney({symbol:'R$ ', 
showSymbol:false, thousands:'', decimal:'.', symbolStay: true});
 })

$(function(){
$("#quantidade_parcelas_entrada").maskMoney({symbol:'R$ ', 
showSymbol:false, thousands:'', decimal:'.', symbolStay: true});
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
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/parsley/dist/parsley.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/form-wizards-validation.demo.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/js/apps.min.js"></script>

	       <script type='text/javascript' src='cep.js'></script>
          <script type='text/javascript' src='produtos.js'></script>
	 <script type='text/javascript' src='lote.js'></script>
         <script type='text/javascript' src='medidas.js'></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			FormWizardValidation.init();
			FormPlugins.init();

		});
	</script>

</body>


</html>
