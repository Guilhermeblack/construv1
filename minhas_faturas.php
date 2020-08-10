<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";


           $idvenda     ='11';
           $tipo_venda  = '2';

     function dados_cliente_locacao($venda_id){

  include "conexao.php";
  $busca_conta = mysqli_query($db, "SELECT nome_cli
                    FROM locacao
                    INNER JOIN cliente ON locacao.cliente_idcliente = cliente.idcliente                   
                    WHERE idlocacao = '$venda_id'");

  while ($conta = mysqli_fetch_assoc($busca_conta)) {


            $nome_cli = $conta["nome_cli"];
    

            $dados["nome_cli"] = $nome_cli;
            $dados["quadra"]   = '';
            $dados["lote"]     = '';

    }

    return $dados;
}

     function dados_cliente_empreendimento($venda_id){

  include "conexao.php";
  $busca_conta = mysqli_query($db, "SELECT nome_cli, quadra, lote
                    FROM venda
                    INNER JOIN cliente ON venda.cliente_idcliente = cliente.idcliente
                    INNER JOIN produto ON venda.produto_idproduto = produto.idproduto
                    INNER JOIN lote ON venda.lote_idlote = lote.idlote
                    WHERE idvenda = '$venda_id'");

  while ($conta = mysqli_fetch_assoc($busca_conta)) {


            $nome_cli = $conta["nome_cli"];
            $quadra   = $conta["quadra"];
            $lote     = $conta["lote"];

            $dados["nome_cli"] = $nome_cli;
            $dados["quadra"]   = $quadra;
            $dados["lote"]     = $lote;

    }

    return $dados;
}

     function conta_corrente($idcontacorrente){

  include "conexao.php";
  $busca_conta = mysqli_query($db, "SELECT banco
                    FROM contacorrente
                    WHERE idcontacorrente = '$idcontacorrente'");

  while ($conta = mysqli_fetch_assoc($busca_conta)) {


            $banco    = $conta["banco"];
 
    }

    return $banco;
}

   function conta_locacao($idvenda){

  include "conexao.php";
  $busca_conta = mysqli_query($db, "SELECT contacorrente
                    FROM locacao
                    WHERE idlocacao = '$idvenda'");

  while ($conta = mysqli_fetch_assoc($busca_conta)) {


            $contacorrente    = $conta["contacorrente"];
 
    }

    return $contacorrente;
}

function conta_empreendimento($idvenda){

  include "conexao.php";
  $busca_conta = mysqli_query($db, "SELECT contacorrente_id
                    FROM venda
                    INNER JOIN produto ON venda.produto_idproduto = produto.idproduto 
                    INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                    INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro 
                    INNER JOIN empreendimento_centrocusto ON empreendimento_cadastro.idempreendimento_cadastro = empreendimento_centrocusto.empreendimento_id
                    WHERE idvenda = '$idvenda'");

  while ($conta = mysqli_fetch_assoc($busca_conta)) {


            $contacorrente    = $conta["contacorrente_id"];
 
    }

    return $contacorrente;
}


if($tipo_venda == 2)
{
 $inner = 'INNER JOIN venda ON venda.idvenda = parcelas.venda_idvenda';
 $tabela_inner = 'venda';
}
if($tipo_venda == 3)
{
 $inner = 'INNER JOIN venda_imovel ON venda_imovel.idvenda_imovel = parcelas.venda_idvenda';
 $tabela_inner = 'venda_imovel';
}
if($tipo_venda == 1)
{
 $inner = 'INNER JOIN locacao ON locacao.idlocacao = parcelas.venda_idvenda';
 $tabela_inner = 'locacao';
 
}

 if($tipo_venda == 1){

        $contacorrente = conta_locacao($idvenda);

      }else{
        $contacorrente = conta_empreendimento($idvenda);

      }

            $banco = conta_corrente($contacorrente);

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
	<script src="https://immobilebusiness.com.br/admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<script type="text/javascript">

function atualizar_parcela(){

document.nome.action = "atualizar_parcela.php";
document.nome.submit();

}

function adicionar_parcelas(){

document.nome.action = "parcelas_adicionar.php";
document.nome.submit();

}

function dia_vencimento(){

document.nome.action = "alterar_dia_vencimento.php";
document.nome.submit();

}

function receber(){

document.nome.action = "receber_parcelas.php";
document.nome.submit();

}
function renegociar(){

document.nome.action = "renegociar.php";
document.nome.submit();

}
function vincular(){

document.nome.action = "boletos.php";
document.nome.submit();

}

function acao(){

document.nome.action = "igpm.php";
document.nome.submit();

}




function remessa(){

document.nome.action = "remessa/remessa2.php";
document.nome.submit();

}



function boletos(){

document.nome.action = "http://immobilebusiness.com.br/admin/boletos/boleto_santander_banespa.php";
document.nome.submit();

}








		function verificaStatus(nome){
	if(nome.form.tudo.checked == 0)
		{
			nome.form.tudo.checked = 1;
			marcarTodos(nome);
		}
	else
		{
			nome.form.tudo.checked = 0;
			desmarcarTodos(nome);
		}
}
 
function marcarTodos(nome){
   for (i=0;i<nome.form.elements.length;i++)
	  if(nome.form.elements[i].type == "checkbox")
		 nome.form.elements[i].checked=0
}
 
function desmarcarTodos(nome){
   for (i=0;i<nome.form.elements.length;i++)
	  if(nome.form.elements[i].type == "checkbox")
		 nome.form.elements[i].checked=1
}

	</script>
</head>
<body>


	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	

	<?php include "topo.php" ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
		
        <li><a href="#" onclick="boletos()"><span class="label label-primary">Imprimir Boletos</span></a></li>
      
				
			</ol>
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
                        <form action="recebe_antecipar.php" method="POST" id="nome" name="nome">
                         <input type="hidden" name="idvenda" value="<?php echo $idvenda; ?>">
                        <input type="hidden" name="tipo" value="<?php echo $tipo_venda; ?>">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                          <th> <input type='checkbox' name='tudo' onclick="verificaStatus(this)" /></th>
                                       <th>ID / Nosso Numero</th>
 <th>Nº Parcela</th>
                                      
                                            <th>Descrição</th>
                                        <th>Valor Corrigido</th>
                                        <th>Data Vencimento</th>
                                        <th> Situação</th>
                                         <th> Valor Recebido</th>
                                          <th> Data de Recebimento</th>

                                    </tr>
                                </thead>
                                <tbody>
<?php     

if($tipo_venda == 1){
	$valor_multa = (10 / 100);
}else{
	$valor_multa = (2 / 100);
}


$valor_juros = (0.033 / 100);




$hostname ='localhost';
$username ='immob049_immobil';
$senha ='si171156';
$banco ='immob049_immobile';
$db = @mysqli_connect($hostname,$username,$senha,$banco) or die (@mysql_error());
@mysqli_select_db($banco, $db);


                $query_amigo = "SELECT numero_sequencia, remessa, idparcelas, valor_parcelas, situacao, descricao, valor_recebido, data_recebimento, idcliente, STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') as venc FROM parcelas 
                INNER JOIN venda ON parcelas.venda_idvenda = venda.idvenda
                
                INNER JOIN cliente ON venda.cliente_idcliente = cliente.idcliente
                WHERE venda_idvenda = $idvenda AND tipo_venda = $tipo_venda AND fluxo = 0 order by venc Asc";

//echo $query_amigo; die();

                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
            
            $idparcelas              = $buscar_amigo["idparcelas"];
	    	$valor_parcelas          = $buscar_amigo["valor_parcelas"];
            $data_vencimento_parcela = $buscar_amigo["venc"];
            $situacao                = $buscar_amigo["situacao"];
            $descricao               = $buscar_amigo["descricao"];
            $valor_recebido          = $buscar_amigo["valor_recebido"];
  	    	$data_recebimento        = $buscar_amigo["data_recebimento"];
            $idcliente               = $buscar_amigo["idcliente"];
            $remessa                 = $buscar_amigo["remessa"];
            $numero_sequencia        = $buscar_amigo["numero_sequencia"];


            if($descricao == 'Aluguel'){            
             $cont = $cont + 1;
           }

             $data_vencimento_tratada  = $data_vencimento_parcela;
             $data_recebimento_tratada = converterdata($data_recebimento);
             
              if($valor_recebido == ''){
              	$valor_recebido = 0.00;
              }


             ?>

 <?php

 $stilo ='';



  	if($situacao == 'Pago'){
	
	$stilo = 'success';
  
  if(strtotime($data_vencimento_tratada) >= strtotime($data_recebimento_tratada)){ 

  	$valor_parcelas = $valor_parcelas;

  }else{
		
		$time_inicial = strtotime($data_vencimento_tratada);
		$time_final   = strtotime($data_recebimento_tratada);

		$diferenca    = $time_final - $time_inicial;

		$dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

		$multa = ($valor_parcelas * $valor_multa);
  	$juros = ($valor_parcelas * (0.033/100) * $dias);

  	$valor_parcelas =   $valor_parcelas + $multa + $juros;

  }
  		
}else{

	if(strtotime($data_vencimento_tratada) < strtotime($hoje) ) { 

    $stilo = 'danger';
    $time_inicial = strtotime($hoje);
    $time_final   = strtotime($data_vencimento_tratada);

    $diferenca = $time_inicial - $time_final; 

    $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

		$multa = ($valor_parcelas * $valor_multa);
 		$juros = ($valor_parcelas * $valor_juros * $dias);

 		$valor_parcelas = $valor_parcelas + $multa + $juros;


}else{
	$valor_parcelas = $valor_parcelas;
}

} 
     ?>





                      <tr class="<?php echo $stilo; ?>">
                        <td><?php if($stilo != 'success'){ ?>

                        	<?php if($remessa == 1){ ?>

                        	<input type="checkbox" name="antecipar[]" value="<?php echo $idparcelas ?>">

                        	<?php } } ?>	</td>


                        <td><?php echo $idparcelas ?></td>
                        <td><?php echo $numero_sequencia ?></td>
                        <td <?php echo $stilo; ?>><?php echo $descricao ?></td>
                        <td <?php echo $stilo; ?>><?php echo 'R$' . number_format($valor_parcelas, 2, ',', '.'); ?></td>
                         <td <?php echo $stilo; ?>>

                                        <?php

                                        $originalDate = $data_vencimento_parcela;
                                        $newDate = date("d-m-Y", strtotime($originalDate));
                                         echo $newDate ?>
                                           

                                         </td>
                        <td <?php echo $stilo; ?>><?php echo $situacao ?></td>
                        <td <?php echo $stilo; ?>><?php echo 'R$' . number_format($valor_recebido, 2, ',', '.'); ?></td>
                        <td <?php echo $stilo; ?>><?php echo $data_recebimento ?></td>
                      
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
