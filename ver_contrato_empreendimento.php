<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";


if(isset($_POST['incspc'])){

   $cod_venda = $_POST["cod_venda"];
   $inc_spc = $_POST["incspc"];

   include "conexao.php";

   $incluispc = mysqli_query($db, "UPDATE venda SET spc = '$inc_spc' WHERE idvenda = $cod_venda");

}

function pega_spc($idvenda){
     include "conexao.php";


     $query = "SELECT spc FROM venda where idvenda = '$idvenda'";

     $executa = mysqli_query($db, $query) or die ("erro na ao listar spc");

     $busca = mysqli_fetch_assoc($executa);

     $dados = $busca['spc'];

     return $dados;



}

  $id_da_venda = $_GET['venda_idvenda'];
  $spc_pega = pega_spc($id_da_venda);




if(isset($_POST["reajustar"])){
  $reajustar = $_POST["reajustar"];
  $cod_venda     = $_POST["cod_venda"];



  include "conexao.php";

  $atualizar = mysqli_query($db, "UPDATE venda SET reajustar = '$reajustar' WHERE idvenda = $cod_venda");
}


if(isset($_POST["novo_igpm"])){
  $novo_igpm = $_POST["novo_igpm"];
  $cod_venda = $_POST["cod_venda"];

          $novo_igpm = date("d-m-Y", strtotime($novo_igpm));


  include "conexao.php";

  $atualizar = mysqli_query($db, "UPDATE venda SET igpm = '$novo_igpm' WHERE idvenda = $cod_venda");
}



if(isset($_POST["data_contrato"])){
  $data_contrato = $_POST["data_contrato"];
  $cod_venda = $_POST["cod_venda"];

          $data_contrato = date("d-m-Y", strtotime($data_contrato));


  include "conexao.php";

  $atualizar = mysqli_query($db, "UPDATE venda SET data_venda = '$data_contrato' WHERE idvenda = $cod_venda");
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html>
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
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="https://immobilebusiness.com.br/admin/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
<?php

function busca_primeira($idvenda){
  include "conexao.php";
  $query = "SELECT data_vencimento_parcela FROM parcelas where venda_idvenda = $idvenda AND tipo_venda = 2 AND descricao = 'Financiamento' order by idparcelas ASC limit 1";
  $executa_query = mysqli_query($db, $query);
  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)){
    $data_vencimento_parcela = $buscar_amigo["data_vencimento_parcela"];
  }
  return $data_vencimento_parcela;
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
    $query_amigo = "SELECT venda_idvenda, descricao, data_vencimento_parcela, valor_parcelas FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $data_vencimento_parcela  = $buscar_amigo["data_vencimento_parcela"];
      $valor_parcelas           = $buscar_amigo["valor_parcelas"];
      $descricao                = $buscar_amigo["descricao"];
      $venda_idvenda            = $buscar_amigo["venda_idvenda"];

  }

$busca_primeira = busca_primeira($venda_idvenda);
$busca_primeira = geraTimestamp($busca_primeira);

$carencia = strtotime($busca_primeira) - strtotime($hoje);

if($carencia > 0){
  $time_inicial = $busca_primeira;
}else{
  $time_inicial = $hoje;
}

$time_final_tratar = geraTimestamp($data_vencimento_parcela);
$time_final = $time_final_tratar;

$diferenca = strtotime($time_final) - strtotime($time_inicial); 


if($diferenca > 0){


  if($descricao == 'Financiamento'){




$divt = (int)floor($diferenca / (60 * 60 * 24 * 30)); // 225 dias

$juros = valor_taxa($idvenda, $tipo) /100 +1;


$potencia = pow($juros,$divt);

$valor_convertido = $valor_parcelas / $potencia;
}else{
  $valor_convertido = $valor_parcelas;
}

}else{

   $diferenca2 = strtotime($hoje) - strtotime($time_final); 

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
            $email_cli        = $buscar_amigo323['email_cli'];

            $dados['nome_cli']      = $nome_cli;
            $dados['telefone1_cli'] = $telefone1_cli;
            $dados['telefone2_cli'] = $telefone2_cli;
            $dados['cpf_cli']       = $cpf_cli;
            $dados['rg_cli']        = $rg_cli;
            $dados['email_cli']     = $email_cli;

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



function calcula_saldo_devedor($valor_parcela, $qtd_parcela_restante, $taxa){

$F = 0;
$M =$valor_parcela;
$n = $qtd_parcela_restante;
if($taxa == ""){
  $taxa = "0.0001";
}
$i = $taxa/100;


$parte1 = $F/(1+$i)**$n;
$parte2 = ((1+$i)**$n) -(1);
$parte21 = (1+$i)**($n+1);
$parte3 = (1+$i)**$n;


 //$vp = $F/(1+$i)**$n + $M*[(1+$i)**$n - (1)]/[(1+$i)**($n+1) - (1+$i)**$n];

$vp = $parte1 + ($M*($parte2 / ($parte21 -$parte3)));

//echo $parte1;
//echo $parte2;
//echo $parte21;
 return $vp;
/*
F = valor futuro (também chamado VF ou FV)
P = valor presente (também chamado VA ou PV)
M = mensalidade (ou outro pagamento periódico, também chamado PGTO ou PMT)
n = número de períodos (em dias, meses, anos, ..., também chamado NPER)
i = taxa de juros (normalmente na forma percentual, também chamado TAXA ou RATE)
*/
}

function parcelas_financiamentos($venda_idvenda){
  include "conexao.php";

    $total_outros = 0;
    $total_financiamento = 0;

    $query_amigo = "SELECT COUNT(idparcelas) as total, valor_parcelas
                    FROM parcelas 
                    where venda_idvenda = $venda_idvenda and tipo_venda = 2 AND situacao = 'Em Aberto' and fluxo = 0 AND descricao = 'Financiamento'";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $total            = $buscar_amigo["total"];
      $valor_parcelas   = $buscar_amigo["valor_parcelas"];

      

      $dados["total"]           = $total;
      $dados["valor_parcelas"]  = $valor_parcelas;

    }

 return $dados;
}

function total_outros($venda_idvenda){
  include "conexao.php";

    $total_outros = 0;
    $total_financiamento = 0;

    $query_amigo = "SELECT SUM(valor_parcelas) as total, descricao
                    FROM parcelas 
                    where venda_idvenda = $venda_idvenda AND situacao = 'Em Aberto' and fluxo = 0 group by descricao";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $total       = $buscar_amigo["total"];
      $descricao   = $buscar_amigo["descricao"];

      if($descricao == 'Financiamento'){
        $total_financiamento = $total;
      }else{
        $total_outros = $total_outros + $total;
      }

      $dados["total_outros"]        = $total_outros;

    }

 return $dados;
}














 ?> 
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
	
	<?php  include "topo.php"; ?>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
		<?php 

		$venda_idvenda = $_GET["venda_idvenda"];
		include "conexao.php";
			$query_amigo =  "SELECT * FROM venda
                       INNER JOIN lote ON venda.lote_idlote = lote.idlote
                       INNER JOIN produto ON venda.produto_idproduto = produto.idproduto
                       INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                       INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                       WHERE idvenda = $venda_idvenda";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar Locador");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
               
                       
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
                  $taxa_financiamento                    = $buscar_amigo["taxa_financiamento"];

                
                  
            

             }



             $dados_cliente   = dados_cliente($cliente_idcliente);




?>




			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"> </small></h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-6 -->
			    <div class="col-md-12">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#default-tab-1" data-toggle="tab">Resumo</a></li>
<li class=""><a href="cessao_contrato.php?idvenda=<?php echo $venda_idvenda ?>&idempreendimento=<?php echo $idempreendimento_cadastro ?>">Cessão</a></li>
<li class=""><a href="distrato.php?idvenda=<?php echo $venda_idvenda ?>&idempreendimento=<?php echo $idempreendimento_cadastro ?>">Cancelamento</a></li>
<li class=""><a href="ocorrencias_empreendimento.php?idempreendimento=<?php echo $idempreendimento_cadastro ?>&idvenda=<?php echo $venda_idvenda ?>">Ocorrências</a></li>
<li class=""><a href="documentos_empreendimento.php?idempreendimento=<?php echo $idempreendimento_cadastro ?>&idvenda=<?php echo $venda_idvenda ?>">Documentos</a></li>
<li class=""><a href="proprietario_empreendimento.php?venda_idvenda=<?php echo $venda_idvenda ?>&idempreendimento=<?php echo $idempreendimento_cadastro ?>">Proprietários</a></li>
<!--
<li class=""><a href="ajuste_contrato.php?venda_idvenda=<?php echo $venda_idvenda ?>&idempreendimento=<?php echo $idempreendimento_cadastro ?>">Ajustes</a></li>
-->
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="default-tab-1">
							 
							<div class="invoice">
                <div class="invoice-company">
                    <span class="pull-right hidden-print">

                    <?php 
                      $busca_renegociar = busca_renegociar($venda_idvenda);

                      if($busca_renegociar > 0){
                    ?>
                  
                     <div class="btn-group m-r-5 m-b-5">
                <a href="javascript:;" class="btn btn-primary">Imprimir Renegociação</a>
                <a href="javascript:;" data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu pull-right">
                  <?php 
                    $query_amigo =  "SELECT * FROM modelo_contrato                      
                                     WHERE tipo_doc = 3 AND empreendimento_id = $idempreendimento_cadastro";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar Locador");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
               
                       
                  $descricao_modelo    = $buscar_amigo["descricao_modelo"];
                  $modelo_id           = $buscar_amigo["idmodelo_contrato"];

                  ?>
                  <li><a href="contratolocacao/aditamento_contrato.php?idvenda=<?php echo $venda_idvenda ?>&tipo=2&modelo_id=<?php echo $modelo_id ?>"><?php echo $descricao_modelo ?></a></li>

                <?php } ?>
                 
                </ul>
              </div>
                    <?php } ?>

                    <a href="parcelas.php?idvenda=<?php echo $venda_idvenda ?>&tipo=2" class="btn btn-sm btn-success m-b-10"><i class="fa fa-money m-r-5"></i> Parcelas</a>
               
           
                      <div class="btn-group m-r-5 m-b-5">
                <a href="javascript:;" class="btn btn-warning">Proposta de Compra</a>
                <a href="javascript:;" data-toggle="dropdown" class="btn btn-warning dropdown-toggle" aria-expanded="false">
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu pull-right">
                  <?php 
                    $query_amigo =  "SELECT * FROM modelo_contrato                      
                                     WHERE tipo_doc = 1 AND empreendimento_id = $idempreendimento_cadastro";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar Locador");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
               
                       
                  $descricao_modelo    = $buscar_amigo["descricao_modelo"];
                  $modelo_id           = $buscar_amigo["idmodelo_contrato"];

                  ?>
                  <li><a href="contratolocacao/novo_proposta.php?idvenda=<?php echo $venda_idvenda ?>&modelo_id=<?php echo $modelo_id ?>"><?php echo $descricao_modelo ?></a></li>

                <?php } ?>
                 
                </ul>
              </div>



              
                    <div class="btn-group m-r-5 m-b-5">
                <a href="javascript:;" class="btn btn-success">Contrato</a>
                <a href="javascript:;" data-toggle="dropdown" class="btn btn-success dropdown-toggle" aria-expanded="false">
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu pull-right">
                  <?php 
                    $query_amigo =  "SELECT * FROM modelo_contrato                      
                                     WHERE tipo_doc = 2 AND empreendimento_id = $idempreendimento_cadastro";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar Locador");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
               
                       
                  $descricao_modelo    = $buscar_amigo["descricao_modelo"];
                  $modelo_id           = $buscar_amigo["idmodelo_contrato"];

                  ?>
                  <li><a href="contratolocacao/novo_proposta.php?idvenda=<?php echo $venda_idvenda ?>&modelo_id=<?php echo $modelo_id ?>"><?php echo $descricao_modelo ?></a></li>

                <?php } ?>
                 
                </ul>
              </div>
                   

                   <?php if (in_array('50', $idrota)) { ?>

                     <a href="recebe_estorno_venda.php?idempreendimento=<?php echo $empreendimento_id ?>&venda_id=<?php echo $venda_idvenda ?>" class="btn btn-sm btn-danger m-b-10"><i class="fa fa-trash m-r-5"></i> Estornar Venda</a>

                     <?php } ?>
          
                    </span>
                    <?php echo $descricao_empreendimento." - ".$quadra." / ".$lote ?>
                </div>
                <div class="invoice-header">
                    <div class="invoice-from">
                        <small>Cliente:</small>
                          <?php  if($spc_pega == 1){
                            ?>&nbsp;&nbsp;&nbsp;
                              <span style="position: absolute; margin-right: " class="label label-danger m-r-10 pull-left">SPC</span>
                              <?php } ?>
                        <address class="m-t-5 m-b-5">
                            <strong><?php echo $dados_cliente['nome_cli']; ?></strong><br />
                            CPF: <?php echo $dados_cliente['cpf_cli']; ?><br />
                            RG: <?php echo $dados_cliente['rg_cli']; ?><br />
                             Tel: <?php echo $dados_cliente['telefone1_cli']; ?><br />
                            Tel 2: <?php echo $dados_cliente['telefone2_cli']; ?><br />
                            E-mail: <?php echo $dados_cliente['email_cli']; ?>
                        </address>
                    </div>
                    <div class="invoice-to">
                        <small>Lote:</small>
                         <address class="m-t-5 m-b-5">
                            <strong>Quadra:<?php echo $quadra; ?></strong><br />
                            Lote: <?php echo $lote; ?><br />
                            M²: <?php echo $m2; ?><br />
                             Matricula: <?php echo $matricula; ?><br />
                            
                        </address>
                    </div>
                    <div class="invoice-date">
                        <small>Data Inicio </small>
                        <div class="date m-t-5"><?php echo $data_venda ?></div>
                        <div class="invoice-detail">
                            Código do Contrato:<?php echo "#".$venda_idvenda ?><br />
                          
                            Cadastrado por:<?php echo nome_user($cadastrado_por); ?><br />
                           
                        </div>
                    </div>
                </div>
                <div class="invoice-content">

                   <div class="table-responsive">
                      <form action="ver_contrato_empreendimento.php?venda_idvenda=<?php echo $venda_idvenda ?>" method="POST">
                        <input type="hidden" name="cod_venda" value="<?php echo $venda_idvenda ?>">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>Saldo Devedor </th>
                                    <th>R$ (Histórico)</th>
                                    <th>Legenda</th>
                                </tr>
                            </thead>
                            <tbody>

                           
                                <tr>
                                   <td>(A) Valor Venda</td>
                                   <td><?php echo 'R$ ' . number_format($valor_desconto, 2, ',', '.'); ?></td>
                                   <td>Valor de Venda</td>                                
                                </tr>
                                
                                <tr>
                                   <td>(B) Valor em aberto ref. Contrato</td>
                                   <td>

                                  <?php  $parcelas_em_aberto = parcelas_em_aberto($venda_idvenda);
                                   echo 'R$ ' . number_format($parcelas_em_aberto, 2, ',', '.'); ?>

                                 </td>
                                   <td>Total de parcelas em aberto ref. contrato atualizado</td>                                
                                </tr>
                                                         
                               
                                <tr>
                                   <td>(C) Saldo devedor do Contrato</td>
                                   <td><?php  

                                   $total_parcelas = parcelas_financiamentos($venda_idvenda);
                                   $qtd_parcelas   = $total_parcelas["total"];
                                   $valor_parcelas = $total_parcelas["valor_parcelas"];
                  
                  $vp =  calcula_saldo_devedor($valor_parcelas, $qtd_parcelas, $taxa_financiamento);

                                   $total_soma = total_outros($venda_idvenda);
                                   $total_sum = $total_soma["total_outros"];


                                   $saldo_devedor = $vp + $total_sum;
echo 'R$ ' . number_format($saldo_devedor, 2, ',', '.');

                                    ?>
                                  


                                   </td>
                                   <td>Saldo devedor do contrato atualizado, ref contrato a valor presente sem juros/multa e Outros</td>                                
                                </tr>

                                 <tr>
                                   <td>(D) Valor juros e multa ref. Parcelas</td>
                                   <td><?php  $total_juros_multa = total_juros_multa($venda_idvenda);
                                   echo 'R$ ' . number_format($total_juros_multa, 2, ',', '.'); ?></td>
                                   <td>Valor do juros e multa incidentes sobre as parcelas em atraso</td>                                
                                </tr>
                                 <tr>
                                   <td>(E) Saldo devedor Total (C+D)</td>
                                   <td>
                                     <?php $total_devedor = $saldo_devedor + $total_juros_multa;
                                    echo 'R$ ' . number_format($total_devedor, 2, ',', '.');
                                      ?>
                                   </td>
                                   <td>Valor do juros e multa incidentes sobre as parcelas em atraso</td>                                
                                </tr>
                                 <tr>
                                   <td>(F) Valor Atraso(1)</td>
                                   <td><?php  $valor_com_juros_multa = valor_com_juros_multa($venda_idvenda);
                                   echo 'R$ ' . number_format($valor_com_juros_multa, 2, ',', '.'); ?></td>
                                   <td>Valor em atraso atualizado com juros, multa, etc</td>                                
                                </tr>
                                 <tr>
                                   <td>(G) Valor Atraso(2)</td>
                                   <td><?php  $valor_sem_juros_multa = valor_sem_juros_multa($venda_idvenda);
                                   echo 'R$ ' . number_format($valor_sem_juros_multa, 2, ',', '.'); ?></td>
                                   <td>Valor em atraso atualizado sem multa e juros de mora</td>                                
                                </tr>

                                 <tr>
                                   <td>(H) Valor Pago</td>
                                   <td><?php  $valor_total_pago = valor_total_pago($venda_idvenda);
                                   echo 'R$ ' . number_format($valor_total_pago, 2, ',', '.'); ?></td>
                                   <td>Total de parcelas pagas</td>                                
                                </tr>
                           

                            </tbody>
                        </table>

                        </form>
                    </div>



                    <div class="table-responsive">
                      <form action="ver_contrato_empreendimento.php?venda_idvenda=<?php echo $venda_idvenda ?>" method="POST">
                        <input type="hidden" name="cod_venda" value="<?php echo $venda_idvenda ?>">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>Data Inicial Reajuste:<?php echo " $igpm" ?> </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                           
                                <tr>
                                   <td>  <input type="date" name="novo_igpm" class="form-control">  </td>
                                   <td> <input type="submit" name="atualizar" value="Atualizar" class="btn btn-success"> </td>
                                </tr>
                        

                           

                            </tbody>
                        </table>

                        </form>
                    </div>



                      <div class="table-responsive">
                      <form action="ver_contrato_empreendimento.php?venda_idvenda=<?php echo $venda_idvenda ?>" method="POST">
                        <input type="hidden" name="cod_venda" value="<?php echo $venda_idvenda ?>">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>Data do Contrato: <?php echo $data_venda ?> </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                           
                                <tr>
                                   <td>  <input type="date" name="data_contrato" class="form-control">  </td>
                                   <td> <input type="submit" name="atualizar" value="Atualizar" class="btn btn-success"> </td>
                                </tr>
                        

                           

                            </tbody>
                        </table>

                        </form>
                    </div>

                    <div class="table-responsive">
                      <form action="ver_contrato_empreendimento.php?venda_idvenda=<?php echo $venda_idvenda ?>" method="POST">
                        <input type="hidden" name="cod_venda" value="<?php echo $venda_idvenda ?>">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>Reajustar Contrato: <?php
                                    if($reajustar == 0){
                                      echo "Sim";
                                    }else{
                                     echo "Não"; 
                                   }
                                     ?> </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                           
                                <tr>
                                   <td>  <input type="radio" name="reajustar" value="0" 
                                    <?php
                                    if($reajustar == 0){ ?>checked <?php } ?> > Sim  <br>
                                   <input type="radio" name="reajustar" value="1"  <?php
                                    if($reajustar == 1){ ?>checked <?php } ?> > Não  </td><br>
                                

                                   <td> <input  style="margin-right: 500px"  type="submit" name="atualizar" value="Atualizar" class="btn btn-success"> </td>
                                </tr>
                        

                           

                            </tbody>
                        </table>


                           

                        </form>
                         <div class="table-responsive">
                      <form action="ver_contrato_empreendimento.php?venda_idvenda=<?php echo $venda_idvenda ?>" method="POST">
                        <input type="hidden" name="cod_venda" value="<?php echo $venda_idvenda ?>">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>Incluir no SPC:
                                     </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                           
                                <tr>
                                   <td>  <input type="radio" name="incspc" value="1"> Sim  <br>
                                   <input type="radio" name="incspc" value="0"> Não </td><br>
                                   <td> <input  style="margin-right: 300px" type="submit" name="atualizar" value="Atualizar" class="btn btn-success"> </td>
                                </tr>
                        

                           

                            </tbody>
                        </table>
                           </form>
                    </div>
                  
            </div>


						</div>




<!-- inicio da aba de parcelas -->


						<div class="tab-pane fade" id="default-tab-2">
							


						</div>
						<div class="tab-pane fade" id="default-tab-3">
							
						</div>
					</div>
					
				</div>
			    <!-- end col-6 -->
			 
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
		
        <!-- begin theme-panel -->
     
        <!-- end theme-panel -->
		
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
	
<script src="https://immobilebusiness.com.br/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
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
