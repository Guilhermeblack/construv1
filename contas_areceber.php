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



function retorna_dados_cliente($id, $idvenda, $tipo_venda){





  if($tipo_venda == 2)
  {
   $inner = 'INNER JOIN venda ON venda.idvenda = parcelas.venda_idvenda
   INNER JOIN lote ON venda.lote_idlote = lote.idlote
   INNER JOIN produto ON venda.produto_idproduto = produto.idproduto
   INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
   INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';
   $tabela_inner = 'venda.cliente_idcliente';
   $juros_hr = '0200';

 }
 if($tipo_venda == 3)
 {
   $inner = 'INNER JOIN contrato_pagar ON contrato_pagar.idcontrato_pagar = parcelas.venda_idvenda

   INNER JOIN empreendimento ON contrato_pagar.empreendimento_id = empreendimento.idempreendimento 
   INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro';
   $tabela_inner = 'contrato_pagar.fornecedor_idfornecedor';
   $juros_hr 	= '0200';
 }
 if($tipo_venda == 1)
 {
   $inner = 'INNER JOIN locacao ON locacao.idlocacao = parcelas.venda_idvenda INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel';
   $tabela_inner = 'locacao.cliente_idcliente';
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
              $descricao_empreendimento   = $buscar_amigo323['descricao_empreendimento'];
              $quadra                     = $buscar_amigo323['quadra'];
              $lote                       = $buscar_amigo323['lote'];



              if($tipo_venda == 1){
                $endereco      = $buscar_amigo323['endereco'];
                $numero        = $buscar_amigo323['numero'];
                $cep           = $buscar_amigo323['cep'];
              }


            }
            $dados['nome_cli']                 = $nome_cli;
            $dados['descricao_empreendimento'] = $descricao_empreendimento;
            $dados['quadra']                   = $quadra;
            $dados['lote']                     = $lote;
            $dados['idcliente']                = $idcliente;

            if($tipo_venda == 1){
              $dados['endereco']                 = $endereco;
              $dados['numero']                   = $numero;
              $dados['cep']                      = $cep;
            }


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
          <script type="text/javascript">

            <?php if(isset($_GET["contacorrente_id"])){

              $verifica_conta = $_GET["contacorrente_id"];

              if($verifica_conta != 0 AND $verifica_conta != ''){


               ?>

               function remessa(){

                document.nome.action = "remessa/remessa-mes.php";
                document.nome.submit();

              }

              function boletos(){

                document.nome.action = "boletos/boleto_santander_banespa-mes.php";
                document.nome.submit();

              }

              function boletoemail(){

                document.nome.action = "boleto-email.php";
                document.nome.submit();

              }
            <?php } } ?>

            function receber(){

              document.nome.action = "receber_parcelas_areceber.php";
              document.nome.method = "GET";
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
           <ol class="breadcrumb pull-right">

            <?php if(isset($_GET["contacorrente_id"])){

              $verifica_conta = $_GET["contacorrente_id"];

              if($verifica_conta != 0 AND $verifica_conta != ''){


               ?>

               <?php if (in_array('4', $idrota)) { ?>
                <li><a href="#" onclick="remessa()"><span class="label label-primary">Gerar Remessa</span></a></li>

                <li><a href="#" onclick="boletos()"><span class="label label-primary">Gerar Boletos</span></a></li>

                <li><a href="#" onclick="boletoemail()"><span class="label label-primary">Enviar Boletos por Email</span></a></li>
              <?php }  } } ?>



              <?php if (in_array('41', $idrota)) { ?>
                <li><a href="#" onclick="estornar()"><span class="label label-danger">ESTORNAR PARCELA</span></a></li>
              <?php } ?>

              <?php if (in_array('41', $idrota)) { ?>
                <li><a href="#" onclick="estornar_pagamento()"><span class="label label-warning">ESTORNAR RECEBIMENTO</span></a></li>
              <?php } ?>



              <?php if (in_array('10', $idrota)) { ?>
                <li><a href="#" onclick="receber()"><span class="label label-success">BAIXAR PARCELA</span></a></li>
              <?php } ?>
              <?php if (in_array('9', $idrota)) { ?>
                <li><a href="lancar_conta_receber.php"><span class="label label-success">NOVO LANÇAMENTO</span></a></li>
              <?php } ?>


            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header">CONTAS A RECEBER</h1>
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
                 <form class="form-vertical form-bordered" name="myForm" method="GET" action="contas_areceber.php">
                  <div class="row">             
                    <div class="form-group">
                      <label class="col-md-2 control-label">Cliente</label>
                      <div class="col-md-4">
                        <div class="input-group">
                         <select class="default-select2 form-control" name="cliente_idcliente" required="">
                          <option value="Todos">Todos</option>
                          <?php

                          include "conexao.php";

                          $query_amigo = "SELECT * FROM cliente
                          INNER JOIN cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente
                          WHERE idtipo = 1 order by nome_cli Asc";

                          $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                  $idcliente             = $buscar_amigo['idcliente'];
                  $nome_cli              = $buscar_amigo["nome_cli"];
                  $cpf_cli               = $buscar_amigo["cpf_cli"];



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
            <div class="input-group">
             <select class="default-select2 form-control" name="empreendimento_id" id="os" >
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



      <!-- Inicio quadra / lote -->

      <div class="row">


        <div class="form-group">
          <label class="col-md-2 control-label">Quadra</label>
          <div class="col-md-4">
            <div>
              <select name="idquadra"  id="quadra" class="form-control">
              </select>

            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label">Lote</label>
          <div class="col-md-4">
            <div>
              <select name="idlote"  id="lote" class="form-control">
              </select>

            </div>
          </div>
        </div>


      </div>



      <!-- Fim quadra / lote -->


      <div class="row" style="margin-top:10px !important">


       <div class="form-group">
        <label class="col-md-2 control-label">Remessa / Conta</label>
        <div class="col-md-10">
          
           <select class="default-select2 form-control" name="contacorrente_id" required="">
            <option value="Todos">Todos</option>
            <?php

            include "conexao.php";

            $query_amigo = "SELECT * FROM contacorrente";

            $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                  $idcontacorrente       = $buscar_amigo['idcontacorrente'];
                  $agencia               = $buscar_amigo["agencia"];
                  $conta                 = $buscar_amigo["conta"];
                  $dig_conta             = $buscar_amigo["dig_conta"];
                  $nome_empresa          = $buscar_amigo["nome_empresa"];



                  ?>
                  <option value="<?php echo "$idcontacorrente" ?>"> <?php echo "$nome_empresa"."/ Ag: ".$agencia." /Conta: ".$conta." / Dig:".$dig_conta ?> </option>
                <?php } ?>


              </select>

            </div>
       
        </div>
      </div>





      <div class="row" style="margin-top:10px !important">







        <div class="form-group">
          <label class="col-md-2 control-label">Período</label>
          <div class="col-md-10">
            <div class="input-group">
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
            <div class="input-group">
              <input type="text" name="numero_lancamento" class="form-control">


            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label">Numero Baixa</label>
          <div class="col-md-4">
            <div class="input-group">
              <input type="text" name="numero_baixa" class="form-control">


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

      <form action="receber_parcelas_areceber.php" method="POST" id="nome" name="nome">
        <?php 

        $inicio                   = $_GET["inicio"];
        $fim                      = $_GET["fim"];
        $situacao_and = "";
     // $inicio = date("d-m-Y", strtotime($inicio));
     // $fim    = date("d-m-Y", strtotime($fim));


        $cliente_idcliente        = $_GET["cliente_idcliente"];
        $empreendimento_id        = $_GET["empreendimento_id"];
        $numero_lancamento        = $_GET["numero_lancamento"];
        $numero_baixa             = $_GET["numero_baixa"];
        $situacao                 = $_GET["situacao"];
        $tipo_periodo             = $_GET["tipo_periodo"];
        $contacorrente_id         = $_GET["contacorrente_id"];

        $quadra                   = $_GET["idquadra"];
        $lote                     = $_GET["idlote"];

        $locacao_id               = $_GET["idlocacao"];

        if($quadra != '' AND $quadra != 0){
          $situacao_and .= " AND venda.produto_idproduto = ".$quadra;
        }

        if($lote != '' AND $lote != 0){
          $situacao_and .= " AND venda.lote_idlote = ".$lote;
        }

        if($locacao_id != '' AND $locacao_id != 0 AND $locacao_id != 'Todos'){
          $situacao_and .= " AND locacao.idlocacao = ".$locacao_id." AND tipo_venda = 1";
        }

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



        if($empreendimento_id != ''  AND $empreendimento_id != 0 AND $empreendimento_id != 'Todos'){
          $inner_busca .=' INNER JOIN venda ON parcelas.venda_idvenda = venda.idvenda'; 
        }

        if($locacao_id != '' AND $locacao_id != 0 AND $locacao_id != 'Todos'){
          $inner_busca .=' INNER JOIN locacao ON parcelas.venda_idvenda = locacao.idlocacao'; 

        }

        if($situacao == 1){
          $situacao_and .= " AND situacao = 'Em Aberto'";
        }elseif ($situacao == 2) {
          $situacao_and .= " AND situacao = 'Pago'";
        }else{
          $situacao_and .= '';
        }


        if($cliente_idcliente != 'Todos'){
          $situacao_and .= " AND cliente_id_novo =".$cliente_idcliente;
        }

        if($empreendimento_id != 'Todos'){
          $situacao_and .= " AND empreendimento_id_novo =".$empreendimento_id. " AND tipo_venda = 2";
        }

        if($numero_baixa != ''){
          $situacao_and .= " AND cod_baixa =".$numero_baixa;
        }



        if($inicio != '' AND $fim != ''){
          $situacao_and .=" AND STR_TO_DATE(".$tabela_periodo.", '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";

        }

        if($numero_lancamento != ''){
          $situacao_and = " AND idparcelas =".$numero_lancamento;
        }

        if($numero_baixa != ''){
          $situacao_and = " AND cod_baixa =".$numero_baixa;
        }




        ?>

        <input type="hidden" name="contacorrente_id" value="<?php echo $contacorrente_id ?>">
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
             <th> <input type='checkbox' name='tudo' onclick="verificaStatus(this)" /></th>
             <th>Nº LANC</th>
             <th>Nº PARC</th>
             <th>Cliente</th>
             <th>Descrição</th>
             <th>Empreendimento</th>
             <th>Q/L</th>                                       
             <th>Data Vencimento</th>
             <th>Valor Parcela</th>
             <th>Situação</th>
             <th>Data Recebimento</th>
             <th>Desconto</th>
             <th>Acréscimo</th>
             <th>Valor Pago</th>
             <th>Forma de Pagamento</th>
             <th>Código de Baixa</th>
             <th>Lançado por</th>                                    
             <th>Baixado por</th>        
             <th></th>

           </tr>
         </thead>
         <tbody>




          <?php 

          $inicio  = converterdata($inicio);
          $fim     = converterdata($fim);


          include "conexao.php";
          $query = "SELECT parcelas.idparcelas, parcelas.numero_sequencia,parcelas.desc_parcela, parcelas.cliente_id_novo,data_lancamento_sistema, lancamento_por, baixado_por, data_baixa,parcelas.acre_parcela,parcelas.tipo_venda, parcelas.venda_idvenda, parcelas.valor_recebido, parcelas.valor_parcelas, parcelas.data_recebimento, parcelas.descricao,parcelas.situacao,parcelas.cod_baixa,parcelas.forma_pagamento, STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') as venc 
          FROM parcelas  $inner_busca
          WHERE fluxo = 0  $situacao_and order by venc Asc";
          $executa_query = mysqli_query($db, $query);

                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                  $idparcelas                  = $buscar_amigo["idparcelas"];
                  $tipo_venda                  = $buscar_amigo["tipo_venda"];
                  $venda_idvenda               = $buscar_amigo["venda_idvenda"];
                  $valor_recebido              = $buscar_amigo["valor_recebido"];
                  $valor_parcelas              = $buscar_amigo["valor_parcelas"];
                  $data_vencimento_parcela     = $buscar_amigo["venc"];
                  $data_recebimento            = $buscar_amigo["data_recebimento"];
                  $descricao                   = $buscar_amigo["descricao"];
                  $forma_pagamento             = $buscar_amigo["forma_pagamento"];
                  $situacao_parcela            = $buscar_amigo["situacao"];
                  $cod_baixa                   = $buscar_amigo["cod_baixa"];
                  $desc_parcela                = $buscar_amigo["desc_parcela"];
                  $acre_parcela                = $buscar_amigo["acre_parcela"];
                  $cliente_id_novo             = $buscar_amigo["cliente_id_novo"];
                  $numero_sequencia            = $buscar_amigo["numero_sequencia"];

                  $lancamento_por             = $buscar_amigo["lancamento_por"];
                  $data_lancamento_sistema    = $buscar_amigo["data_lancamento_sistema"];
                  $baixado_por                = $buscar_amigo["baixado_por"];
                  $data_baixa                 = $buscar_amigo["data_baixa"];


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


                  $descricao_pagamento = forma_pagamento($forma_pagamento);


                  if($tipo_venda == 2){
                    $dados_cli = retorna_dados_cliente($idparcelas, $venda_idvenda, $tipo_venda);
                  }

                  if($tipo_venda == 1){
                    $dados_cli = retorna_dados_cliente($idparcelas, $venda_idvenda, $tipo_venda);
                  }



                  $total_bruto = $total_bruto + $valor_parcelas;
                  $total_liquido = $total_liquido + $valor_recebido;  





                  ?>

                  <tr class="odd gradeX">
                    <td><input type="checkbox" name="antecipar[]" value="<?php echo $idparcelas ?>"></td>
                    <td><?php echo $idparcelas ?></td>
                    <td><?php echo $numero_sequencia ?></td>
                    <td><?php echo nome_user($cliente_id_novo); ?></td>
                    <td><?php echo $descricao ?></td>
                    <td>
                      <?php if($tipo_venda == 2){ ?>
                        <?php echo $dados_cli['descricao_empreendimento'] ?>
                      <?php } ?>

                      <?php if($tipo_venda == 1){ ?>
                        <?php echo $dados_cli['endereco'].", ".$dados_cli['numero']." Cep: ".$dados_cli['cep']?>
                      <?php } ?>

                    </td>
                    <td><?php echo $dados_cli['quadra'] ?>/<?php echo $dados_cli['lote'] ?></td>
                    <td><?php $newDate = date("d-m-Y", strtotime($data_vencimento_parcela)); echo $newDate; ?></td>
                    <td><?php echo 'R$' . number_format($valor_parcelas, 2, ',', '.'); ?></td>
                    <td><?php echo $texto_situacao ?></td>
                    <td><?php echo $data_recebimento ?></td>
                    <td><?php echo 'R$ ' . number_format($desc_parcela, 2, ',', '.'); ?></td>
                    <td><?php echo 'R$ ' . number_format($acre_parcela, 2, ',', '.'); ?></td>
                    <td><?php echo 'R$' . number_format($valor_recebido, 2, ',', '.'); ?></td>
                    <td><?php echo $descricao_pagamento; ?></td>
                    <td><?php echo $cod_baixa ?></td>
                    <td><?php echo $lancamento_por." / ".$data_lancamento_sistema ?></td>
                    <td><?php echo $baixado_por." / ".$data_baixa ?></td>
                    <td>  <?php  if($situacao_parcela != 'Pago'){ ?>
                      <a href="editar_parcela_conta_pagar.php?idparcela=<?php echo $idparcelas ?>"><span class="label label-warning">Editar</span></a>
                    <?php } ?>
                    <?php  if($situacao_parcela == 'Pago'){ ?>
                      <a href="contratolocacao/recibo.php?cod_baixa=<?php echo $cod_baixa ?>"><span class="label label-success">Recibo</span></a>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>


            </tbody>
          </table>
          <?php echo "Total Parcelas: ".'R$ ' . number_format($total_bruto, 2, ',', '.') ?> <BR>
          <?php echo "Total Pago: ".'R$ ' . number_format($total_liquido, 2, ',', '.') ?>

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


  <script src="produtos_pagar.js"></script>
  <script src="lote_pagar.js"></script>
  
  <script>
    $(document).ready(function() {
      App.init();
      TableManageButtons.init();
      FormPlugins.init();

    });
  </script>

</body>


</html>
