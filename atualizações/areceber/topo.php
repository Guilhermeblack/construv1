 <link rel="shortcut icon" href="https:/immobilebusiness.com.br/home/favicon.ico">


 <div class="modal fade" id="video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" align="center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> 

        <a id="texto-loading" style="font-size: 20px; font-weight: bold; color:#000; text-transform: uppercase;">Qualquer dúvida ligue <b>
          <img src="https://construmobile.com.br/home/wp-content/themes/panoramia/imagesconstru/icon-phone.svg" class="icon" width="20">
          (16)3721-0707<b></a>

        <span class="phone" >
          <a style="font-size: 20px; font-weight: bold; color:#000; text-transform: uppercase;" href="https://wa.me/5516999669765?text=Olá,%20Gostaria%20de%20mais%20detalhes%20sobre%20os%20ConstruMobile" target="_blank" alt="Celular"> Ou mande WhatsApp 
            <img src="https://construmobile.com.br/home/wp-content/themes/panoramia/imagesconstru/icon-whatsapp.svg" alt="Celular" class="icon" width="20">
         (16) 99966-9765               </a>

         <br>

         <a style="font-size: 20px; font-weight: bold; color:#000; text-transform: uppercase;"> Estaremos prontos Para te Atender!</a>
        
        </span>
      </div>
      <div class="modal-body" style="padding: 0px;">
        <div class="embed-responsive embed-responsive-16by9">
          <!-- <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/eJnGLhxLxX0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
        </div>
      </div>
    </div>
  </div>
 </div>

 <?php
 
if(!isset($_SESSION)) 
{ 
  session_start(); 
}
 
 $imobiliaria_idimobiliaria = $_SESSION["id_usuario"];


 $idrota          = $_SESSION["idrota"];
 $idgrupo_acesso      = $_SESSION["idgrupo_acesso"];






 function nome_user($id){
  include "conexao.php";
  $query_igpm = "SELECT nome_cli FROM cliente where idcliente = $id";

  $executa_igpm = mysqli_query ($db, $query_igpm);
            $nome_cli='';

            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos

              $nome_cli             = $buscar_amigoc['nome_cli'];
            }
            if ($nome_cli != '/^[a-zA-Z0-9-().@]/'){
                $nome_cli = 'Usuário';
            }
            return $nome_cli;

    } 

    function verifica_tipo($idcliente){
      include "conexao.php";
      $query_amigo = "SELECT * FROM cliente_tipo
      INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo
      WHERE idcliente = $idcliente";


      $cont = 0;
      $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar Tipo");


            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

              $descricao_tipo             = $buscar_amigo['descricao_tipo'];

              $dados[$cont] = $descricao_tipo;
              $cont = $cont + 1;
            }

            return $dados;
    }

    function nome_cli($id){
      include "conexao.php";
      $query_igpm = "SELECT nome_cli FROM locacao
      INNER JOIN cliente ON locacao.cliente_idcliente = cliente.idcliente

      where idlocacao = $id";

      $executa_igpm = mysqli_query ($db, $query_igpm) or die ("Erro ao listar cliente");


            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos

              $nome_cli             = $buscar_amigoc['nome_cli'];
            }
            return $nome_cli;

    } 
    function nome_cli_empreendimento($id){
      include "conexao.php";
      $query_igpm = "SELECT nome_cli FROM venda
      INNER JOIN cliente ON venda.cliente_idcliente = cliente.idcliente

      where idvenda = $id";

      $executa_igpm = mysqli_query ($db, $query_igpm) or die ("Erro ao listar cliente");


            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos

              $nome_cli             = $buscar_amigoc['nome_cli'];
            }
            return $nome_cli;

    } 
    function contrato_ativo($venda_id){
      include "conexao.php";
      $query_igpm = "SELECT COUNT(idparcelas) as total 
      from parcelas 
      where venda_idvenda = $venda_id 
      and tipo_venda = 2 
      AND fluxo = 0 
      and situacao = 'Em Aberto'";


      $executa_igpm = mysqli_query ($db, $query_igpm);
    while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos

      $total             = $buscar_amigoc['total'];
    }
    return $total;

} 
function nome_cli_imovel($id){
  include "conexao.php";
  $query_igpm = "SELECT nome_cli FROM venda_imovel
  INNER JOIN cliente ON venda_imovel.cliente_idcliente = cliente.idcliente

  where idvenda_imovel = $id";

  $executa_igpm = mysqli_query ($db, $query_igpm) or die ("Erro ao listar cliente");


            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos

              $nome_cli             = $buscar_amigoc['nome_cli'];
            }
            return $nome_cli;

    } 
    function converterdataigpm($dateSql){
      $ano= substr($dateSql, 6);
      $mes= substr($dateSql, 3,-5);
      $dia= substr($dateSql, 0,-8);
      return $ano."-".$mes."-".$dia;
    }  

////////////////  Abaixo verificação da necessidade de reajuste do IGPM nos contratos de locação


    function verifica_locacao(){

      date_default_timezone_set('America/Sao_Paulo'); 
      $data_hoje = date('Y-m-d');
      include "conexao.php";
      $query_igpm = "SELECT primeira_parcela, igpm, idlocacao FROM locacao";
      $cont = 0;
      $executa_igpm = mysqli_query ($db, $query_igpm) or die ("Erro ao listar empreendimento");


            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos

              $primeira_parcela_igpm             = $buscar_amigoc['primeira_parcela'];
              $igpm                     = $buscar_amigoc['igpm'];
              $idlocacao                = $buscar_amigoc['idlocacao'];

              if($igpm == ''){
                $data_para_calculo = $primeira_parcela_igpm;
              }else{
                $data_para_calculo = $igpm;
              }

              $data_para_calculo_tratada = converterdataigpm($data_para_calculo);


              $time_inicial = strtotime($data_hoje);
              $time_final   = strtotime($data_para_calculo_tratada);


              $diferenca = $time_inicial - $time_final;

    $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

    if($dias >= 334){ 

      $retorno_igpm[$cont] = $idlocacao;

      $cont = $cont + 1;



    } }

    return $retorno_igpm;
  }
  function verifica_empreendimento(){

    date_default_timezone_set('America/Sao_Paulo'); 
    $data_hoje = date('Y-m-d');
    include "conexao.php";
    $query_igpm = "SELECT vencimento_primeira, igpm, idvenda FROM venda";
    $cont = 0;
    $executa_igpm = mysqli_query($db, $query_igpm);


            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos

              $vencimento_primeira         = $buscar_amigoc['vencimento_primeira'];
              $igpm                   = $buscar_amigoc['igpm'];
              $idvenda                = $buscar_amigoc['idvenda'];

              if($igpm == ''){
                $data_para_calculo = $vencimento_primeira;
              }else{
                $data_para_calculo = $igpm;
              }

              $data_para_calculo_tratada = converterdataigpm($data_para_calculo);


              $time_inicial = strtotime($data_hoje);
              $time_final   = strtotime($data_para_calculo_tratada);


              $diferenca = $time_inicial - $time_final;

    $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

    $contrato_ativo = contrato_ativo($idvenda);

    if($dias >= 334 AND $contrato_ativo > 0){ 

      $retorno_igpm[$cont] = $idvenda;

      $cont = $cont + 1;



    } }

    return $retorno_igpm;
  }



  ?>
  <div id="header" class="header navbar navbar-default navbar-fixed-top">
    <!-- begin container-fluid -->
    <div class="container-fluid">
      <!-- begin mobile sidebar expand / collapse button -->
      <div class="navbar-header">
          <a href="index.php" class="navbar-brand"><span><img src="img/icone.ico" height="32px" width="32px"></span> ConstruMobile</a>

          <button type="button" class="navbar-toggle" data-click="sidebar-toggled">

          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <!-- end mobile sidebar expand / collapse button -->

      <!-- begin header navigation right -->
      <ul class="nav navbar-nav navbar-right">
        <li>
          <form class="navbar-form full-width">
            <div class="form-group">
              <input type="text" class="form-control" />
              <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
            </div>
          </form>
        </li>
        <li class="dropdown">
          <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
            <i class="fa fa-bell-o"></i>






          </a>
          <ul class="dropdown-menu media-list pull-right animated fadeInDown">





          </ul>
        </li>
        <li class="dropdown navbar-user">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">


            <?php 
            include "conexao.php";
            $query_path_foto = "SELECT path_foto FROM cliente WHERE idcliente = $imobiliaria_idimobiliaria";
            $executa_path_foto = mysqli_query($db, $query_path_foto);
            $buscar_path = mysqli_fetch_assoc($executa_path_foto);


            if(!empty($buscar_path['path_foto'])){

              ?>
              <img src="/<?php echo $buscar_path['path_foto']?>" /> 

              <?php 

            }else{
              ?>
              <img src="img/foto_default.jpg" /> 

              <?php
            }


            ?>



            <span class="hidden-xs"> <?php echo nome_user($imobiliaria_idimobiliaria) ?>  </span> 



            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInLeft">
            <li class="arrow"></li>
             <li> <a href ="chamados.php">Chamados</a></li>

            <li><a href="logout.php">Sair</a></li>
          </ul>
        </li>
      </ul>
      <!-- end header navigation right -->
    </div>
    <!-- end container-fluid -->
  </div>
  <!-- end #header -->

  <!-- begin #sidebar -->
  <div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
      <!-- begin sidebar user -->
      <ul class="nav">
        <li class="nav-profile">
          <div class="image">
            <a href="javascript:;"></a>
          </div>
          <div class="info">
            Immobile
            <small>Business</small>
          </div>
        </li>
      </ul>
      <!-- end sidebar user -->
      <script type="text/javascript">
        var x = setInterval(function() {
          <?php include "crm_attform.php"; ?>
        }, 5000);
      </script>
      <!-- begin sidebar nav -->
      <ul class="nav">
        <li class="nav-header">Menu</li>

        <li class="has-sub">
          <a href="#" data-toggle="modal" data-target="#video" style="color: red; font-size:20px; text-transform: uppercase; font-weight: bold;">
            <i class="fa fa-video-camera"></i>
            <span>Tutorial</span>
          </a>

        </li>  

        <li class="has-sub">
          <a href="painel.php">
            <span class="badge pull-right"></span>

            <i class="fa fa-dashboard"></i>
            <span>Painel Geral</span>
          </a>

        </li>  

        <li class="has-sub">
            <a href="javascript:;">
                <b class="caret pull-right"></b>
                <i class="glyphicon glyphicon-equalizer"></i>
                <span>Empreendimento</span>
            </a>
                <ul class="sub-menu">
                    <li><a href="const_cadastro_empreendimento.php">Empreendimento</a></li>
                    <li><a href="const_sub_empreendimento.php">Sub-Empreendimento</a></li>
                </ul>
        </li>

        <li class="has-sub">
            <a href="javascript:;">
                <b class="caret pull-right"></b>
                <i class="fa fa-align-left"></i>
                <span>Orçamento</span>
            </a>
                <ul class="sub-menu">
                    <li><a href="const_tabela.php">Tabela de Orçamento</a></li>
                    <li><a href="const_cad_insumos.php">Tabela Insumos</a></li>
                    <li><a href="const_plano_contas.php">Tabela Etapas de Obra</a></li>
                    <li><a href="const_tarefas.php">Tabela Tarefas</a></li>
                </ul>
        </li>
        
        <li class="has-sub">
            <a href="javascript:;">
                <b class="caret pull-right"></b>
                <i class="glyphicon glyphicon-home"></i>
                <span>Obra</span>
            </a>
                <ul class="sub-menu">
                    <li><a href="const_solicitacao_material.php">Gerenciamento de Materiais</a></li>
                    <li><a href="const_gerencia_tarefa.php">Gerenciamento da tarefas</a></li>
                    <li><a href="const_equipe.php">Equipes Funcionarios</a></li>
                </ul>
        </li>
        
        <li class="has-sub">
            <a href="javascript:;">
                <b class="caret pull-right"></b>
                <i class="glyphicon glyphicon-usd"></i>
                <span>Compras/Financeiro</span>
            </a>
                <ul class="sub-menu">
                    <li><a href="const_cotacao.php"> Cotação Material</a></li>
                    <li><a href="contas_apagar.php">Contas a Pagar</a></li>
                    <li><a href="contas_areceber.php">Contas a Receber</a></li> 
                </ul>
        </li>
        
        <li class="">
            <a href="const_deposito.php">
                <i class="glyphicon glyphicon-folder-open"></i>
                <span> Depósito de Material</span>
            </a>
        </li>

          <!-- ########### COMEÇOU BEM O DIA HOJE EM ############## -->

          <?php if (in_array('47', $idrota)) { ?>
            <li class="has-sub">
              <a href="sistema_ocorrencia.php">
                <span class="badge pull-right"></span>

                <i class="fa fa-exclamation-triangle"></i>
                <span>Ocorrências de Obra</span>
              </a>

            </li>
          <?php } ?>  

          <li class="has-sub">
            <a href="const_diario_obra.php">
              <span class="badge pull-right"></span>

              <i class="fa fa-check-square-o"></i>
              <span>Controle de Ponto</span>
            </a>

          </li>
         
          <li class="has-sub">
            <a href="clientes.php">

              <i class="fa fa-users"></i>
              <span>Cadastro Geral</span>
            </a>
            
          </li>
          

      
     

        <li class="has-sub">
          <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-file-pdf-o"></i>
            <span>Relatórios</span>
          </a>
          <ul class="sub-menu">
              <li><a href="relatorio_tarefa.php">Relatorio Tarefa</a></li>
              <li><a href="relatorio_orcado_realizado.php">Relatorio Orcado X Realizado</a></li>
              <li><a href="relatorio_abc.php">Relatorio Curva ABC</a></li>
          </ul>
        </li>
   

      <?php if (in_array('33', $idrota)) { ?>
        <li class="has-sub">
          <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-cog"></i>
            <span>Configurações</span>
          </a>
          <ul class="sub-menu">

            <li><a href="relatorio_conta_corrente.php">Conta Corrente</a></li>

            <li><a href="centro_cobranca.php">Centro de Receita</a></li>
            <li><a href="forma_pagamento.php">Formas de Pagamento</a></li>

            <li><a href="relatorio_grupos.php">Grupos de Acesso</a></li>

          </ul>
        </li>

    <?php } ?>


    <!-- end sidebar minify button -->
  </ul>
  <!-- end sidebar nav -->
</div>
<!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>