<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php";


           $idvenda     = $_GET["idvenda"];
           $tipo_venda  = $_GET["tipo"];

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
// function pegaJurosMultaHonorario($idparcela){
//               include "conexao.php";
            
//               $query = mysqli_query($db, "SELECT juros_mora, juros_multa, juros_outros FROM parcelas where idparcelas = '$idparcela'");
//               $busca = mysqli_fetch_assoc($query);

//               //$remessa = "DEU CERTO";
//               $remessa['juros_mora'] =  $busca['juros_mora'];
//               $remessa['juros_multa'] =  $busca['juros_multa'];
//               $remessa['juros_outros'] =  $busca['juros_outros'];

//               return $remessa;

//         }


function pega_obs($idvenda){
   include "conexao.php";


     $query = "SELECT obs_parcela FROM parcelas where idvenda = '$idvenda'";

     $executa = mysqli_query($db, $query) or die ("erro na ao listar spc");

     $busca = mysqli_fetch_assoc($executa);

     $dados = $busca['spc'];

     return $dados;

}



function pega_spc($idvenda){
     include "conexao.php";


     $query = "SELECT spc FROM venda where idvenda = '$idvenda'";

     $executa = mysqli_query($db, $query) or die ("erro na ao listar spc");

     $busca = mysqli_fetch_assoc($executa);

     $dados = $busca['spc'];

     return $dados;



}

  $spc_pega = pega_spc($idvenda);

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

function pegar_empreendimento($idvenda){
    include "conexao.php";

  $busca_empreendimento = mysqli_query($db, "SELECT empreendimento.idempreendimento, empreendimento_cadastro.descricao_empreendimento FROM venda INNER JOIN produto ON venda.produto_idproduto = produto.idproduto INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento INNER JOIN empreendimento_cadastro ON empreendimento.idempreendimento = empreendimento_cadastro.idempreendimento_cadastro WHERE idvenda = '$idvenda'");

  while ($emp = mysqli_fetch_assoc($busca_empreendimento)) {

             $dados['empreendimento']  = $emp['idempreendimento'];
             $dados['descricao'] = $emp['descricao_empreendimento'];

  }

    return $dados;

}


function pegar_indice_automatico($idvenda){
   include "conexao.php";

    $query =  "SELECT indice_correcao.descricao_indice FROM parcelas INNER JOIN venda ON parcelas.venda_idvenda = venda.idvenda INNER JOIN produto ON venda.produto_idproduto = produto.idproduto INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento INNER JOIN indice_correcao ON empreendimento.indice_correcao = indice_correcao.idindice_correcao WHERE venda.idvenda = '$idvenda' LIMIT 1";

     $executa_indice = mysqli_query($db, $query) or die ("erro ao listar indice");


    while ($busca_indice = mysqli_fetch_assoc($executa_indice)) {


            $dados    = $busca_indice["descricao_indice"];
 
    }

    return $dados;
}




$indice_pega = pegar_indice_automatico($idvenda);



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
    <script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<!-- ================== END BASE JS ================== -->

  <style type="text/css">

@media (max-width: 600px) 
{
  td,th
   {
    width: 8%;
   }
}




    thead, tbody{
    display: block;  
    }

    tbody{
    overflow-y: scroll;


    }
::-webkit-scrollbar {
  width: 10px;
}
::-webkit-scrollbar-track {
  background: transparent;
}
::-webkit-scrollbar-thumb {
  background: gray;
}

/*th{
  width: 8.33%;
}
td{
  width: 8.33%;
}*/

  </style>

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

<?php if($banco == '341'){ ?>

function remessa(){

document.nome.action = "remessa-itau/gerar-remessa-itau-cnab-400.php";
document.nome.submit();

}



function boletos(){

document.nome.action = "boletos/boleto_itau.php";
document.nome.submit();

}

<?php } ?>


<?php if($banco == '237'){ ?>

function remessa(){

document.nome.action = "bradesco/remessa-bradesco-cnab-240.php";
document.nome.submit();

}



function boletos(){

document.nome.action = "boletos/boleto_bradesco.php";
document.nome.submit();

}

<?php } ?>







<?php if($banco == '001'){ ?>

function remessa(){

document.nome.action = "bb/remessa.php";
document.nome.submit();

}



function boletos(){

document.nome.action = "boletos/boleto_bb.php";
document.nome.submit();

}

<?php } ?>


<?php if($banco == '033'){ ?>

function remessa(){

document.nome.action = "remessa/remessa2.php";
document.nome.submit();

}



function boletos(){

document.nome.action = "boletos/boleto_santander_banespa.php";
document.nome.submit();

}

<?php } ?>



<?php if($banco == '104'){ ?>

function remessa(){

document.nome.action = "caixa/gerar-remessa-caixa-arquivo-demo.php";
document.nome.submit();

}



function boletos(){

document.nome.action = "boletos/boleto_cef_sigcb.php";
document.nome.submit();

}

<?php } ?>










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
       <?php
      $id_emp = pegar_empreendimento($idvenda);
      ?>
      <h1 class="page-header"><?php echo $id_emp['descricao']?></h1>
      <!-- end page-header -->
			<!-- begin breadcrumb -->
     <form action="recebe_antecipar.php" method="POST" id="nome" name="nome">

			<ol class="breadcrumb pull-right">
        <li>
        <?php if (in_array('4', $idrota)) { ?>
            <button type="submit" name="enviar" style="background: transparent; border-style: none; outline-style: none;"><spam class="label label-primary">Antecipar</spam></button>
                        <?php

                         } ?>
                       </li>
         

        <?php if (in_array('4', $idrota)) { ?>
        <li><a href="ocorrencias_empreendimento.php?idempreendimento=<?php echo $id_emp['empreendimento']?>&idvenda=<?php echo $idvenda?>" onclick="atualizar_parcela()"><span  class="label label-primary">Ocorrências</span></a></li>
        <?php } ?>		
				
        <?php if (in_array('4', $idrota)) { ?>
        <li><a href="#" onclick="atualizar_parcela()"><span class="label label-primary">Atualizar Parcela</span></a></li>
        <?php } ?>   

        <?php if (in_array('4', $idrota)) { ?>
        <li><a href="#" onclick="renegociar()"><span class="label label-primary">Renegociar</span></a></li>
        <?php } ?> 
        
        <?php if (in_array('4', $idrota)) { ?>
        <li><a href="#" onclick="dia_vencimento()"><span class="label label-primary">Alterar Dia Vencimento</span></a></li>
        <?php } ?> 

         <?php if (in_array('4', $idrota)) { ?>
        <li><a href="#" onclick="adicionar_parcelas()"><span class="label label-primary">Adicionar Parcelas</span></a></li>
        <?php }  

        ?>

        <?php if (in_array('4', $idrota)) { ?>

         


        <li><a href="#" onclick="acao()"><span class="label label-primary"><?php echo $indice_pega;?></span></a></li>


        <?php } ?>
               <?php if (in_array('4', $idrota)) { ?>
        <li><a href="#" onclick="vincular()"><span class="label label-primary">VINCULAR</span></a></li>
        <?php } ?>
        <?php if (in_array('4', $idrota)) { ?>
        <li><a href="#" onclick="remessa()"><span class="label label-primary">Gerar Remessa</span></a></li>
        <?php } ?>
        <?php if (in_array('4', $idrota)) { ?>
        <li><a href="#" onclick="boletos()"><span class="label label-primary">Imprimir Boletos</span></a></li>
        <?php } ?>
				
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
     
			
			<!-- begin row -->
			<div class="row">
			
			    <!-- begin col-6 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="table-basic-4" style="height: 30%">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>

                            <?php

                            if($tipo_venda == 1){
                               $dados_cliente = dados_cliente_locacao($idvenda);

                            }else{
                              $dados_cliente = dados_cliente_empreendimento($idvenda);

                            }



                              ?>
                            <h4 class="panel-title">PARCELAS - <?php echo $dados_cliente["nome_cli"] ?> - <?php echo $dados_cliente["quadra"] ?>/<?php echo $dados_cliente["lote"] ?>&nbsp;&nbsp;

                          <?php  if($spc_pega == 1){
                            ?>
                              <span style="position: absolute; margin-right: " class="label label-danger m-r-10 pull-left">SPC</span>
                              <?php } ?>


                            </h4>




                        </div>
                        <div class="panel-body">
                   
                    <input type="hidden" name="idvenda" value="<?php echo $idvenda; ?>">
                        <input type="hidden" name="tipo" value="<?php echo $tipo_venda; ?>">
                              
                           <div class="table-responsive">
                                 <table class="table table-hover" boder=1 >
                                <thead>
                                    <tr>
                                      <th> <input type='checkbox' name='tudo' onclick="verificaStatus(this)" /></th>
                                       <th>ID / Nosso Numero</th>
                                      <th>Nº Parcela</th>
                                      
                                            <th>Descrição</th>
                                        <th>Valor <br>Corrigido</th>
                                      
                                        <th>Situação</th>
                                         <th>Valor Recebido</th>
                                           <th style="width: 8%">Data <br>Vencimento</th>
                                          <th style="width: 8%">Data de <br> Recebimento</th>
                                           <th> Observ.</th>
                                          <th> Vinculo</th>
                                          <th> Data Atualizada</th>
                                         <th> Remessa</th>
                                        


                                    </tr>
                                </thead>
                          

                        
                            
                         
                       
                              
<?php     

if($tipo_venda == 1){
	$valor_multa = (10 / 100);
}else{
	$valor_multa = (2 / 100);
}


$valor_juros = (0.033 / 100);


$cont_atualiza_entrada = 0;
$cont_atualiza_finan = 0;


$cont_vinculo = 0;


                      include "conexao.php";
                $query_amigo = "SELECT obs_caldas, obs_parcela, acre_parcela, desc_parcela, data_boleto, idparcelas, remessa,vinculo, valor_parcelas, numero_sequencia,situacao, descricao, valor_recebido, data_recebimento, idcliente, STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') as venc, juros_mora, juros_multa, juros_outros FROM parcelas ".$inner."  
                
                INNER JOIN cliente ON ".$tabela_inner.".cliente_idcliente = cliente.idcliente
                WHERE venda_idvenda = $idvenda AND tipo_venda = $tipo_venda AND fluxo = 0 order by venc, numero_sequencia Asc";



                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar empreendimento");
                
                 ?>
          <!--   <div class="table-responsive"  style="max-height: 320px; overflow:auto;-webkit-overflow-scrolling: touch;"> -->
<!--                              <tbody  style="max-height: 320px; overflow-y:auto;-webkit-overflow-scrolling: touch;" >
 -->                              <tbody style="width: 100%; height: 320px;-webkit-overflow-scrolling: touch;">
                              <?php
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
            
            $idparcelas              = $buscar_amigo["idparcelas"];
	    	    $valor_parcelas          = $buscar_amigo["valor_parcelas"];
            $data_vencimento_parcela = $buscar_amigo["venc"];
            $situacao                = $buscar_amigo["situacao"];
            $descricao               = $buscar_amigo["descricao"];
            $valor_recebido          = $buscar_amigo["valor_recebido"];
  	    	  $data_recebimento        = $buscar_amigo["data_recebimento"];
            $idcliente               = $buscar_amigo["idcliente"];
            $numero_sequencia        = $buscar_amigo["numero_sequencia"];
            $vinculo                 = $buscar_amigo["vinculo"];
            $remessa                 = $buscar_amigo["remessa"];
            $data_boleto             = $buscar_amigo["data_boleto"];

            $acre_parcela             = $buscar_amigo["acre_parcela"];
            $desc_parcela             = $buscar_amigo["desc_parcela"];
            $observ                   = $buscar_amigo["obs_parcela"];
            $obs_caldas              = $buscar_amigo["obs_caldas"];
            $juros_mora              = $buscar_amigo['juros_mora'];
            $juros_multa             = $buscar_amigo['juros_multa'];
            $juros_outros            = $buscar_amigo['juros_outros'];


           // $valor_recebido = ($valor_recebido + $acre_parcela) - $desc_parcela;


            if($descricao == 'Aluguel'){            
             $cont = $cont + 1;
           }


        


            if($remessa == '0'){
            $remessa_exbir = '<span class="badge badge-danger">Não</span>';
           }else{
            $remessa_exbir = '<span class="badge badge-success">Sim</span>';


           }
          



            if($data_boleto != ''){

                           $data_vencimento_tratada = converterdata($data_boleto);

            }else{

             $data_vencimento_tratada  = $data_vencimento_parcela;
           }

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

  	$valor_parcelas =   $valor_parcelas;

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

 		$valor_parcelas = $valor_parcelas;


}else{
	$valor_parcelas = $valor_parcelas;
}

} 
     ?>




                      <tr  class="<?php echo $stilo; ?>">


                        
                        <td><?php if($stilo != 'success'){ 
                                if($cont_vinculo != $vinculo or $vinculo == 0){
                            ?><input type="checkbox" name="antecipar[]" value="<?php echo $idparcelas ?>">

                          <?php }  }    if($vinculo != ''){
                              $cont_vinculo = $vinculo; } ?> </td>



                        <td><?php echo $idparcelas ?></td>
                        <td><?php echo $numero_sequencia ?></td>
                        <td style="width: 5%"><?php echo $obs_caldas ?></td>
                        <td style="width: 5%"><?php echo 'R$' . number_format($valor_parcelas, 2, ',', '.'); ?></td>
                       
                        <td><?php echo $situacao ?></td>
                        <td><?php echo 'R$' . number_format($valor_recebido, 2, ',', '.'); ?></td>



                      <td>
                                           

                                        <?php

                                        $originalDate = $data_vencimento_parcela;
                                        $newDate = date("d-m-Y", strtotime($originalDate));
                                         echo $newDate ?>

                                         </td>

                        <td><?php echo $data_recebimento ?></td>


                           
                        <td> <button type="button" onclick="chama_parcela('<?php echo $idparcelas ?>')"  class="btn btn-primary" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" style="outline-style: none; border-style: none; background: transparent; font-size: 12px"><font style="color: black"><?php if($observ != ''){
                                                                 // echo substr($observ, 0,6);
                                              ?>
                                                 <img src="img/lupa.png" width="30">

                                              <?php 

                        }else{
                              ?></font></button>
                     <center><strong>...</strong></center></td>
                          <?php
                        }
                        ?>



                        <td style="width: 6.33%"><?php echo $vinculo ?></td>

                         <?php  if($data_boleto == ''){
                          ?>

                          <td style="width: 7%"> <?php
                              
                           ?>
                         </td>
                         <?php
                         }else{
                           ?>
                           <td style="width: ¨7%"><?php echo $data_boleto ?></td>


                           <?php
                               

                         } 
                              ?></td>

                    

                          <?php 

                          if($situacao == 'Em Aberto'){
                            ?>
                              <td style="width: 8%"><center>
                            <?php
                          echo $remessa_exbir;

                            ?></center></td><?php
                          }else{
                            ?> 

                            <td style="width: 8%" ></td>

                            <?php
                          } ?>
                           

                      
                       
                      
                      </tr>
                      
                                <?php

                                

                                 } ?>

                          </tbody>
                        </table>
                    <!--     <table>
                        <td>
                    
                        </td>

                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>


                      </tr>
                               
                            </table> -->
                          </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
			      
			    </div>
			    <!-- end col-6 -->
			</div>
		
    <!-- #####################################################################################
##################################################################################### -->

                                        <div class="modal fade" id="add_data_Modal"  role="dialog" >  
                                            <div class="modal-dialog modal-md" style="background: white;">  
                                                 <div class="panel-heading" style="background: black">
                                                       <spam style="color: white">Observações</spam>
                                                 </div>

                                              <div style="height: auto; background: white; padding: 40px">
                                                   <div id="msg"></div>
                                                   <div>
                                                      <?php 
                                                        
                                                        if($juros_mora != '' || $juros_multa != '' || $juros_outros != ''){
                                                           $valor_corrigido = $valor_parcelas + $juros_mora + $juros_outros + $juros_multa;

                                                  
                                                        $obs = "<u><strong>Atualização</strong></u>  
                                                                <br><br><strong>VALOR PARCELA CORRIGIDO : R$  </strong>". str_replace('R$', '', $valor_corrigido) . "<br>"
           . "<strong>VALOR MULTA : R$  </strong>" . str_replace('R$', '', $juros_multa) . "<br>"
  .  "<strong>VALOR JUROS : R$  </strong>" . str_replace('R$', '', $juros_mora) . "<br>"
  .  "<strong>VALOR HONORARIOS : R$  </strong>" . str_replace('R$', '', $juros_outros) . "<br>";
         
                                                echo $obs;

                                                          

                                                        }



                                                      ?>




                                                   </div>



                                                       
                                                    </div>

                                                      <script>
                                                   
                                                        function chama_parcela(idparcela) {
                                                          //alert(idparcela)
                                                            passa_idparcela(idparcela)
                                                        }
                                                       
                                                        
                                                        function passa_idparcela(idparcela){
     
                                                               $.ajax({
                                                               url : 'func_pega_obs.php',
                                                               type : 'POST', 
                                                               data: 'idpar=' + idparcela, 
                                                               dataType: 'json', 
                                                               success: function(data){
                 
                          
                                                                $('#msg').html("<strong><spam style='font-size: 17px'>" + data + "</spam></strong><div><button type='button' class='btn btn-danger' name='age' id='age' data-toggle='modal' data-target='#add_data_Modal'>Fechar</button></div> ");


                                                                   }

                                                                });


                                                             } 
                                                          



                                                      </script>
                                                  </div>
                                  
                                 </div>  


                                          </div>

<!-- #####################################################################################
##################################################################################### -->

			
	
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
