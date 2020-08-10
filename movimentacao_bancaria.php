<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include "protege_professor.php"; 

function converterdata($dateSql){
    $ano= substr($dateSql, 6);
    $mes= substr($dateSql, 3,-5);
    $dia= substr($dateSql, 0,-8);
    return $ano."-".$mes."-".$dia;
}



function forma_pagamento($id){
include "conexao.php";
    $query_amigo = "SELECT * FROM forma_pagamento where idforma_pagamento = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $descricao           = $buscar_amigo["descricao"];
    }
    return $descricao;
}

function cpf_cli($id){
    include "conexao.php";
     $query_igpm = "SELECT cpf_cli FROM venda
            INNER JOIN cliente ON venda.cliente_idcliente = cliente.idcliente

      where idvenda = $id";

                $executa_igpm = mysqli_query ($db, $query_igpm) or die ("Erro ao listar cliente");
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $cpf_cli             = $buscar_amigoc['cpf_cli'];
}
return $cpf_cli;

} 





function retorna_dados_cliente($id, $idvenda, $tipo_venda){

if($tipo_venda == 2)
{
 $inner = 'INNER JOIN venda ON venda.idvenda = parcelas.venda_idvenda
           INNER JOIN lote ON venda.lote_idlote = lote.idlote
           INNER JOIN produto ON venda.produto_idproduto = produto.idproduto
           INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
           INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';
 $tabela_inner = 'empreendimento_cadastro.cliente_id';
 $juros_hr = '0200';

}
if($tipo_venda == 3)
{
 $inner = 'INNER JOIN contrato_pagar ON contrato_pagar.idcontrato_pagar = parcelas.venda_idvenda
          
           INNER JOIN empreendimento ON contrato_pagar.empreendimento_id = empreendimento.idempreendimento 
           INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';
 $tabela_inner = 'contrato_pagar.fornecedor_idfornecedor';
 $juros_hr  = '0200';
}
if($tipo_venda == 1)
{
 $inner = 'INNER JOIN locacao ON locacao.idlocacao = parcelas.venda_idvenda 
           INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel';
 $tabela_inner = 'imovel.locador_idlocador';
 $juros_hr = '1000';
}
if($tipo_venda == 4)
{
 $inner = 'INNER JOIN contrato_receber ON contrato_receber.idcontrato_receber = parcelas.venda_idvenda
          
           INNER JOIN empreendimento ON contrato_receber.empreendimento_id = empreendimento.idempreendimento 
           INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';

 $tabela_inner = 'contrato_receber.cliente_idcliente';
 $juros_hr  = '0200';
}

$wes_hoje = date('dmy');
        include "conexao.php";
          $query_amigo323 = "SELECT * FROM parcelas ".$inner."  
                
                INNER JOIN cliente ON ".$tabela_inner." = cliente.idcliente
                WHERE idparcelas = $id";


                $executa_query323 = mysqli_query ($db,$query_amigo323) or die ("Erro ao listar dados cliente");
                
                
            while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se são amigos
            $idcliente                  = $buscar_amigo323['idcliente'];
            $nome_cli                   = $buscar_amigo323['nome_cli'];
            $cpf_cli                    = $buscar_amigo323['cpf_cli'];
            $descricao_empreendimento   = $buscar_amigo323['descricao_empreendimento'];
            $quadra                     = $buscar_amigo323['quadra'];
            $lote                       = $buscar_amigo323['lote'];
            $idempreendimento_cadastro  = $buscar_amigo323['idempreendimento_cadastro'];
            $data_venda                 = $buscar_amigo323['data_venda'];


            }
            $dados['data_venda']               = $data_venda;
            $dados['cpf_cli']                  = $cpf_cli;
            $dados['nome_cli']                 = $nome_cli;
            $dados['descricao_empreendimento'] = $descricao_empreendimento;
            $dados['quadra']                   = $quadra;
            $dados['lote']                     = $lote;
            $dados['idcliente']                = $idcliente;
            $dados['idempreendimento_cadastro'] = $idempreendimento_cadastro;

           return $dados;
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
  <script type="text/javascript">


function receber(){

document.nome.action = "receber_parcelas_apagar.php";
document.nome.submit();

}

function estornar(){

document.nome.action = "recebe_estorno.php";
document.nome.submit();

}

function estornar_pagamento(){

document.nome.action = "recebe_estorno_pagamento.php";
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


	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
<?php include "topo.php"; ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
		
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">MOVIMENTAÇÃO BANCÁRIA </h1>
			<!-- end page-header -->
			
			<div class="row">
			    <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Informe o Período</h4>
                        </div>
                        <div class="panel-body">
                        	 <form class="form-vertical form-bordered" name="myForm" method="GET" action="movimentacao_bancaria.php">
                       <div class="row">
                            <div class="form-group">
                                    <label class="col-md-2 control-label">Fornecedor</label>
                                    <div class="col-md-4">
                                        <div class="input-group input-daterange">
                                             <select class="default-select2 form-control" name="cliente_idcliente" required="">
                                        <option value="Todos">Todos</option>
                      <?php

                      include "conexao.php";
                
        $query_amigo = "SELECT * FROM cliente
                        INNER JOIN cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente
                        WHERE idtipo = 2 order by nome_cli Asc";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
              $idcliente             = $buscar_amigo['idcliente'];
              $nome_cli              = $buscar_amigo["nome_cli"];
                $cpf_cli              = $buscar_amigo["cpf_cli"];
        
             
            
             ?>
                <option value="<?php echo "$idcliente" ?>"> <?php echo "$nome_cli "."CPF: "."$cpf_cli" ?> </option>
            <?php } ?>

                                           
                                        </select>
                                           
                                        </div>
                                    </div>
                                </div>



                                      <div class="form-group">
                                    <label class="col-md-2 control-label">Empreendimento</label>
                                    <div class="col-md-4">
                                        <div class="input-group input-daterange">
                                             <select class="default-select2 form-control" name="empreendimento_id" >
                                        <option value="Todos">Todos</option>
                      <?php

                      include "conexao.php";
                
        $query_amigo = "SELECT * FROM empreendimento_cadastro order by descricao_empreendimento Asc";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
              $idempreendimento_cadastro             = $buscar_amigo['idempreendimento_cadastro'];
              $descricao_empreendimento              = $buscar_amigo["descricao_empreendimento"];
        
             
            
             ?>
                <option value="<?php echo $idempreendimento_cadastro ?>"> <?php echo $descricao_empreendimento ?> </option>
            <?php } ?>

                                           
                                        </select>
                                           
                                        </div>
                                    </div>
                                </div>





</div>

<div class="row">




                                  <div class="form-group">
                                    <label class="col-md-2 control-label">Período</label>
                                    <div class="col-md-10">
                                        <div class="input-group input-daterange">
                                            <input type="date" class="form-control" name="inicio" placeholder="Data Inicial" />
                                            <span class="input-group-addon">Até</span>
                                            <input type="date" class="form-control" name="fim" placeholder="Data Final"  />
                                        </div>
                                    </div>
                                </div>
  </div>
    <div class="row">

                                 

                                  <div class="form-group">
                                    <label class="col-md-2 control-label">Tipo Periodo</label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="radio" name="tipo_periodo" value="1" >Lançamento
                                            <input type="radio" name="tipo_periodo" value="2" >Vencimento
                                            <input type="radio" name="tipo_periodo" value="3" >Baixa
                                           
                                        </div>
                                    </div>
                                </div>

                                  <div class="form-group">
                                    <label class="col-md-2 control-label">Situação</label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="radio" name="situacao" value="1" required="">A Vencer
                                            <input type="radio" name="situacao" value="2" required="">Pago
                                            <input type="radio" name="situacao" value="3" required="">Todos
                                           
                                        </div>
                                    </div>
                                </div>
  </div>

<div class="row">
                                    <div class="form-group">
                                    <label class="col-md-2 control-label">Numero Lançamento</label>
                                    <div class="col-md-4">
                                        <div class="input-group input-daterange">
                                            <input type="text" name="numero_lancamento" class="form-control">
                                          
                                           
                                        </div>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Numero Baixa</label>
                                    <div class="col-md-4">
                                        <div class="input-group input-daterange">
                                            <input type="text" name="numero_baixa" class="form-control">
                                          
                                           
                                        </div>
                                    </div>
                                </div>
</div>
<div class="row">
                                    <div class="form-group">
                                    <label class="col-md-2 control-label">Conta Corrente</label>
                                    <div class="col-md-4">
                                        <div class="input-group input-daterange">
                                            <select class="default-select2 form-control" name="contacorrente">
                                        <option value="Todos">Todos</option>
                      <?php

                      include "conexao.php";
                
        $query_amigo = "SELECT * FROM contacorrente";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
              $idcontacorrente   = $buscar_amigo['idcontacorrente'];
              $nome_empresa      = $buscar_amigo['nome_empresa'];
              $agencia           = $buscar_amigo["agencia"];
              $dig_agencia       = $buscar_amigo["dig_agencia"];
              $conta             = $buscar_amigo["conta"];
              $dig_conta         = $buscar_amigo["dig_conta"];
        
             
            
             ?>
                <option value="<?php echo "$idcontacorrente" ?>"> <?php echo "$nome_empresa "."Ag: "."$agencia"."-".$dig_agencia." Conta:".$conta." Dig:".$dig_conta ?> </option>
            <?php } ?>

                                           
                                        </select>
                                          
                                           
                                        </div>
                                    </div>
                                </div>
                               
</div>

                                  <div class="form-group">
                                    
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-sm btn-success" value="Consultar" />
                                    </div>
                                </div>

                       </form>



                        </div>
                    </div>
			    </div>






			    

<?php if(isset($_GET["inicio"])){ ?>
   <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Relatório de Recebimentos no período</h4>
                        </div>
                        <div class="panel-body">

                        <form action="receber_parcelas_apagar.php" method="POST" id="nome" name="nome">
<?php 
      
      $inicio                   = $_GET["inicio"];
      $fim                      = $_GET["fim"];
      
     // $inicio = date("d-m-Y", strtotime($inicio));
     // $fim    = date("d-m-Y", strtotime($fim));


      $cliente_idcliente        = $_GET["cliente_idcliente"];
      $empreendimento_id        = $_GET["empreendimento_id"];
      $numero_lancamento        = $_GET["numero_lancamento"];
      $numero_baixa             = $_GET["numero_baixa"];
      $situacao                 = $_GET["situacao"];
      $tipo_periodo             = $_GET["tipo_periodo"];
      $contacorrente            = $_GET["contacorrente"];

      if($tipo_periodo == '1'){
        $tabela_periodo ='data_lancamento_sistema';
      }elseif($tipo_periodo == '2'){
        $tabela_periodo ='data_vencimento_parcela';
      }elseif($tipo_periodo == '3'){
        $tabela_periodo ='data_baixa';
      }else{
        $tabela_periodo ='data_vencimento_parcela';


      }
                              
      $cont_contrato  = 0;
      $cont_cancelado = 0;

      $inner_busca =' INNER JOIN centrocobranca ON parcelas.centrocusto_id = centrocobranca.idcentrocobranca
';

      if($situacao == 1){
        $situacao_and = " AND situacao = 'Em Aberto'";
      }elseif ($situacao == 2) {
        $situacao_and = " AND situacao = 'Pago'";
      }else{
        $situacao_and = '';
      }

      if($contacorrente != 'Todos'){
        $situacao_and .= " AND contacorrente_id =".$contacorrente;
      }

      if($cliente_idcliente != 'Todos'){
        $situacao_and .= " AND cliente_id_novo =".$cliente_idcliente;
      }

      if($empreendimento_id != 'Todos'){
        $situacao_and .= " AND empreendimento_id_novo =".$empreendimento_id;
      }

      if($numero_baixa != ''){
        $situacao_and .= " AND cod_baixa =".$numero_baixa;
      }

      if($numero_lancamento != ''){
        $situacao_and .= " AND idparcelas =".$numero_lancamento;
      }

       if($inicio != '' AND $fim != ''){
        $situacao_and .=" AND STR_TO_DATE(".$tabela_periodo.", '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";

      }




?>
            
            <input type="hidden" name="cliente_idcliente" value="<?php echo $cliente_idcliente ?>">
            <input type="hidden" name="empreendimento_id" value="<?php echo $empreendimento_id ?>">
            <input type="hidden" name="numero_lancamento" value="<?php echo $numero_lancamento ?>">
            <input type="hidden" name="numero_baixa" value="<?php echo $numero_baixa ?>">
            <input type="hidden" name="tipo_periodo" value="<?php echo $tipo_periodo ?>">
            <input type="hidden" name="inicio" value="<?php echo $inicio ?>">
            <input type="hidden" name="fim" value="<?php echo $fim ?>">
            <input type="hidden" name="situacao" value="<?php echo $situacao ?>">
                        	 <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                     <th>Documento</th>
                                      
                                        <th>Parcela</th>
                                         <th>CPF/CNPJ</th>
                                            <th>Nome/Razão Social</th>
                                          <th>Emissão</th>
                                        
                                        <th>Pagar</th>
                                        <th>Vencimento</th>
                                        <th>Pago</th>
                                        <th>Motivo</th>

                                        <th>Juros</th>
                                        <th>Multa</th>
                                        <th>Desconto</th>
                                        <th>Valor Pago + Juros</th>
                                        <th>Data da Baixa</th>
                                        <th>Banco</th>

                                                        
                                    
                                        

                                       
                                        
                                    </tr>
                                </thead>
                                <tbody>




<?php 
      
          $inicio  = converterdata($inicio);
          $fim     = converterdata($fim);
     

				include "conexao.php";
				$query = "SELECT parcelas.idparcelas, parcelas.numero_sequencia,parcelas.desc_parcela, parcelas.acre_parcela ,data_lancamento_sistema, lancamento_por, baixado_por, data_baixa,parcelas.tipo_venda, parcelas.fluxo,parcelas.venda_idvenda, parcelas.valor_recebido, parcelas.valor_parcelas, parcelas.data_recebimento, centrocobranca.descricaocentro,parcelas.situacao, parcelas.cliente_id_novo,parcelas.cod_baixa,parcelas.forma_pagamento, STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') as venc 
                                  FROM parcelas  $inner_busca
                                  WHERE (fluxo = 0)   $situacao_and order by venc, idparcelas Asc";
                 
                  $executa_query = mysqli_query($db, $query);

                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                  $idparcelas                  = $buscar_amigo["idparcelas"];
                  $tipo_venda                  = $buscar_amigo["tipo_venda"];
                  $venda_idvenda               = $buscar_amigo["venda_idvenda"];
                  $valor_recebido              = $buscar_amigo["valor_recebido"];
                  $valor_parcelas              = $buscar_amigo["valor_parcelas"];
                  $data_vencimento_parcela     = $buscar_amigo["venc"];
                  $data_recebimento     	     = $buscar_amigo["data_recebimento"];
                  $descricao		     	         = $buscar_amigo["descricaocentro"];
                  $forma_pagamento             = $buscar_amigo["forma_pagamento"];
                  $situacao_parcela            = $buscar_amigo["situacao"];
                  $cod_baixa                   = $buscar_amigo["cod_baixa"];
                  $cliente_id_novo             = $buscar_amigo["cliente_id_novo"];
                  $numero_sequencia             = $buscar_amigo["numero_sequencia"];

                  $lancamento_por             = $buscar_amigo["lancamento_por"];
                  $data_lancamento_sistema    = $buscar_amigo["data_lancamento_sistema"];
                  $baixado_por                = $buscar_amigo["baixado_por"];
                  $data_baixa                 = $buscar_amigo["data_baixa"];
                  $desc_parcela               = $buscar_amigo["desc_parcela"];
                  $acre_parcela               = $buscar_amigo["acre_parcela"];
                  $fluxo                      = $buscar_amigo["fluxo"];


                   if($fluxo == 1)
                  {
                    $texto_fluxo = '<span class="label label-danger">Despesa</span>';
                  }else{
                    $texto_fluxo = '<span class="label label-success">Receita</span>';

                  }




                  if($lancamento_por != ''){
                  $lancamento_por = nome_user($lancamento_por);
                  }

                  if($baixado_por != ''){
                  $baixado_por    = nome_user($baixado_por);
                  }

                  if($situacao_parcela != 'Pago')
                  {
                    $texto_situacao = '<span class="label label-danger">A Vencer</span>';
                  }else{
                    $texto_situacao = '<span class="label label-success">PAGO</span>';

                  }

           
          
$nome_user = nome_user($cliente_id_novo);
$cpf_user  = cpf_cli($venda_idvenda);
        

        $dados_cli = retorna_dados_cliente($idparcelas, $venda_idvenda, $tipo_venda);

    
   
      
        $total_bruto = $total_bruto + $valor_parcelas;
        $total_liquido = $total_liquido + $valor_recebido;  

$data_venda = $dados_cli['data_venda'];

$data_venda = date("d/m/Y", strtotime($data_venda));



$data_recebimento = str_replace("-","/", $data_recebimento);

$data_vencimento_parcela = date("d-m-Y", strtotime($data_vencimento_parcela));
$data_vencimento_parcela = str_replace("-","/", $data_vencimento_parcela);





		     ?>

                                    <tr class="odd gradeX">
                                        <td><?php echo $venda_idvenda ?></td>
                                        <td><?php echo $numero_sequencia ?></td>
                                        <td><?php echo $cpf_user ?></td>
                                        <td><?php echo $nome_user ?></td>
                                        <td><?php echo $data_venda ?></td>
                                        <td><?php echo number_format($valor_parcelas, 2, ',', ''); ?></td>
                                        <td><?php echo $data_vencimento_parcela ?></td>
                                        <td><?php echo number_format($valor_recebido, 2, ',', ''); ?></td>
                                        <td>PAGAMENTO</td>
                                        <td><?php echo number_format($acre_parcela, 2, ',', ''); ?></td>
                                        <td>0,00</td>
                                        <td><?php echo number_format($desc_parcela, 2, ',', ''); ?></td>
                                        <td>

                                          <?php 

                                          $valor_parcela_desconto = $valor_parcelas + $acre_parcela - $desc;
                                          echo number_format($valor_parcela_desconto, 2, ',', ''); ?>
                                            
                                          </td>
                                        <td><?php echo $data_recebimento ?></td>

                                        <td>13007962</td>
                                        
                                    </tr>
                                     <?php   }?>

                                   
                                </tbody>
                            </table>
                            <?php echo "Total Parcelas: ".'R$ ' . number_format($total_bruto, 2, ',', '.') ?> <BR>
<?php echo "Total Pago: ".'R$ ' . number_format($total_liquido, 2, ',', '.') ?>
<BR>
<?php echo "Total A pagar: ".'R$ ' . number_format($total_bruto - $total_liquido, 2, ',', '.') ?>
</form>


                        </div>
                    </div>
			    </div>

<?php } ?>


			</div>
		</div>
		<!-- end #content -->
		

		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
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

  <script src="produtos_pagar.js"></script>
  <script src="lote_pagar.js"></script>
  <script src="etapa_pagar.js"></script>
  <!-- ================== END PAGE LEVEL JS ================== -->
  
  <script>
    $(document).ready(function() {
      App.init();
      TableManageButtons.init();
    });
  </script>

</body>


</html>
