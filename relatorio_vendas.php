<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
set_time_limit(0);
ini_set("upload_max_filesize", "10M");
ini_set("max_execution_time", "-1");
ini_set("memory_limit", "-1");
ini_set("realpath_cache_size", "-1");
if (!isset($_SESSION)) {
  session_start();
}

?>

<?php
include "cadastro_planilha_contrato.php";

$aux = 0;

class Upload
{
  var $tipo;
  var $nome;
  var $tamanho;

  function Upload(){
        //Criando objeto
  }

  function UploadArquivo($arquivo, $pasta){ 
    if(isset($arquivo)){
      $nomeOriginal = $arquivo["name"]; 
      $tamanho = $arquivo["size"];

      if (move_uploaded_file($arquivo["tmp_name"], $pasta . $nomeOriginal)){ 

        $this->nome=$pasta . $nomeOriginal;
        $this->tamanho=number_format($arquivo["size"]/1024, 2) . "KB";
        return true; 
      }else{ 
        return false;
      } 
    }
  } 
}


if(isset($_FILES["userfile"])){

  $upArquivo = new Upload;
  if($upArquivo->UploadArquivo($_FILES["userfile"], "planilhas/")){   
    $nome = $upArquivo->nome;
    $tamanho = $upArquivo->tamanho;
    $caminho = "planilhas/".$nome;
    if($_GET["planilha"] == 1){
      $resultado = grava_planilha_venda($nome, $_GET['idempreendimento']); // recebo os dados da gravação
    }else{
      $resultado = grava_planilha_parcela($nome, $_GET['idempreendimento']); // recebo os dados da gravação
    }
    $aux = 1;
  }else{
    $aux = 5;
  }
//unlink($nome);
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
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
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
  <!-- begin #page-loader -->
  <div id="page-loader" class="fade"><span class="spinner"></span></div>
  <!-- end #page-loader -->
  
  <!-- begin #page-container -->
  <div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">

    <?php include "topo.php"; ?>

    <?php    $idempreendimento = $_GET["idempreendimento"];     

    function empreendimento($idempreendimento)
    {


      include "conexao.php";
      $query_amigo = "SELECT * FROM empreendimento
      INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
      where idempreendimento = $idempreendimento";

      $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");


      while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
      {                 
        $descricao           = $buscar_amigo["descricao_empreendimento"];                 
        $empreendimento_id           = $buscar_amigo["empreendimento_cadastro_id"];                 

      }

      $dados["descricao_empreendimento"] = $descricao;
      $dados["empreendimento_id"] = $empreendimento_id;

      return $dados;

    }


    function nome_imob($idcliente)
    {


      include "conexao.php";
      $query_amigo = "SELECT * FROM cliente where idcliente = $idcliente";

      $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar nome da imobiliaria");


      while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
      {                 
        $nome_cli           = $buscar_amigo["nome_cli"];                 

      }

      return $nome_cli;

    }


    function renegociacao($idvenda)
    {

     include "conexao.php";
     $query_amigo = "SELECT * FROM venda_renegociacao where venda_id = $idvenda and status = 0";
     $executa_query = mysqli_query ($db,$query_amigo);
     $total = mysqli_num_rows($executa_query);    

     return $total;

   }

   function distrato($idvenda)
   {

     include "conexao.php";
     $query_amigo = "SELECT * FROM distrato where venda_id = $idvenda and status = 0";
     $executa_query = mysqli_query ($db,$query_amigo);
     $total = mysqli_num_rows($executa_query);    

     return $total;

   }

   function cessao($idvenda)
   {

     include "conexao.php";
     $query_amigo = "SELECT * FROM cessao where venda_id = $idvenda and status = 0";
     $executa_query = mysqli_query ($db,$query_amigo);
     $total = mysqli_num_rows($executa_query);    

     return $total;

   }


   ?>    <!-- begin #content -->
   <div id="content" class="content">

     <?php 
       if((!isset($resultado["error"])) && isset($resultado["ok"])){
         if(empty($resultado["ok"])){
           ?>
           <div class="alert alert-warning" role="alert">
             <p class="font-weight-bold">Falha ao gravar o arquivo, Por favor verifique e tente novamente !</p></br>
           </div>
           <?php
         }
       }

       if(isset($resultado) && (count($resultado["ok"]) !== 0)){       ?>
         <div class="alert alert-success" role="alert">
           <strong><font>Sucesso!</font></strong>
           <font><?php  echo "Foram gravadas ".count($resultado["ok"])." Linhas !";  ?></font>
         </div>
         <?php
       }   
     ?>

     <?php   
     if(isset($resultado["error"]) && $_GET["planilha"] == 1){
       ?>
       <div class="alert alert-danger" role="alert">
        <font><?php echo "Falha ao gravar algumas linhas, por gentileza verifique e tente novamente!"; ?></font>
        <a href="planilhas/falhas.xlsx"><span class="label label-danger" style="font-size:100% !important">BAIXAR PLANILHA DE DADOS NÃO CADASTRADOS!</span></a>
      </div>
      <?php 
    }elseif (isset($resultado["error"]) && $_GET["planilha"] == 2) { ?>
      <div class="alert alert-danger" role="alert">
       <font><?php echo "Falha ao gravar algumas linhas, por gentileza verifique e tente novamente!"; ?></font>
       <a href="planilhas/falhas.xlsx"><span class="label label-danger" style="font-size:100% !important">BAIXAR PLANILHA DE DADOS NÃO CADASTRADOS!</span></a>
     </div>
    <?php }
    ?>


    <ol class="breadcrumb pull-right">
      <?php if (in_array('85', $idrota)) { ?>
        <li>
          <div class="btn-group m-r-5 m-b-5">
            <a href="javascript:;" data-toggle="dropdown" class="btn btn-success dropdown-toggle" aria-expanded="false">Parcelas  <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="planilhas_mod/cad_parcelas.xlsx" download>Baixar planilha Parcelas</a></li>
              <li><a href="#modal-message2" data-toggle="modal">Subir Planilha Parcelas</a></li>
            </ul>
          </div>
        </li>
        <li>
          <div class="btn-group m-r-5 m-b-5">
            <a href="javascript:;" data-toggle="dropdown" class="btn btn-success dropdown-toggle" aria-expanded="false">Contratos  <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="planilhas_mod/cad_contratos.xlsx" download>Baixar planilha Contratos</a></li>
              <li><a href="#modal-message1" data-toggle="modal">Subir Planilha Contratos</a></li>
            </ul>
          </div>
       </li>
    <?php } 
         if (in_array('28', $idrota)) {  ?>
        <li><a href="gerar_contrato_empreendimento.php?idempreendimento=<?php echo $idempreendimento ?>"><span class="label label-success" style="font-size:100% !important">NOVO CONTRATO</span></a></li>
      <?php } ?>

    </ol>
    <!-- begin page-header -->
    <h1 class="page-header">Relatório de Vendas de Lotes / 
      <?php 
        $empreendimento = empreendimento($idempreendimento);
        echo  $empreendimento["descricao_empreendimento"]; 
      ?>
    </h1>

    <!-- end page-header -->

    <!-- begin row -->
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
            <h4 class="panel-title">Filtro de dados</h4>
          </div>
          <div class="panel-body">
           <form class="form-vertical form-bordered" name="myForm" method="GET" action="relatorio_vendas.php?idempreendimento=<?php echo $idempreendimento ?>">

            <input type="hidden" name="idempreendimento" value="<?php echo $idempreendimento ?>">

            <div class="form-group">
              <label class="col-md-2 control-label">Quadra</label>
              <div class="col-md-4">
                <div class="">
                 <select name="quadra" id="quadra" class="form-control">
                  <option value="">Escolha</option>
                  <?php

                  include "conexao.php";

                  $query_amigo = "SELECT * FROM produto
                  WHERE empreendimento_idempreendimento = $idempreendimento order by quadra Asc";
                  $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");


                  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                   $quadra  = $buscar_amigo['quadra'];
                   $idproduto = $buscar_amigo["idproduto"];

                   ?>
                   <option value="<?php echo "$idproduto" ?>"> <?php echo "$quadra" ?> </option>
              
               <?php } ?>
               
         </select>                                    

       </div>
     </div>
   </div>

   <div class="form-group">
    <label class="col-md-2 control-label">Lote</label>
    <div class="col-md-4">
      <div class="">
        <select name="lote"  id="lote" class="form-control">
          <option value="">Escolha</option>


        </select>                                          

      </div>
    </div>
  </div>


  <div class="form-group">
    <label class="col-md-2 control-label">Cliente</label>
    <div class="col-md-4">
      <div class="">
       <input type="text" class="form-control" name="nome_cliente">

     </div>
   </div>
 </div>


 <div class="form-group">
  <label class="col-md-2 control-label">Numero Ficha</label>
  <div class="col-md-4">
    <div class="">
      <input type="text" name="numero_ficha" class="form-control">


    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-2 control-label">Status</label>
  <div class="col-md-4">
    <div class="">
      <select name="status_venda" class="form-control">
        <option value="Todos">Todos</option>                                                    
        <option value="0">Proposta em Analise</option>
        <option value="1">Proposta Recusada</option>
        <option value="2">Proposta Aprovada</option>
        <option value="3">Contrato Ativo</option>
        <option value="5">Contrato Concluido</option>
        <option value="4">Cancelado</option>


      </select>


    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Imobiliaria</label>
  <div class="col-md-4">
    <div class="">
      <select class="form-control" name="imobiliaria_id" id="imobiliaria_id">
        <option value="Todos">Todos</option>
        <?php

            include "conexao.php";

            $query_amigo = "SELECT * FROM cliente
            INNER JOIN cliente_tipo ON cliente_tipo.idcliente = cliente.idcliente
            WHERE idtipo = 11 order by nome_cli Asc";

            $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");

            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

              $idcliente = $buscar_amigo['idcliente'];
              $nome_cli = $buscar_amigo["nome_cli"];
              $cpf_cli = $buscar_amigo["cpf_cli"];

              ?>
              <option value="<?php echo $idcliente ?>"> <?php echo $nome_cli ?> </option>
          <?php } ?>

              </select>

            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label">Corretor</label>
          <div class="col-md-4">
            <div class="">
              <select class="form-control" name="corretor_id" id="corretor_id">
                <option value="0">Escolha</option>

              </select>

            </div>
          </div>
        </div>

        <div class="form-group">

          <div class="col-md-12">
            <input type="submit" name="botao" class="btn btn-sm btn-success" value="Consultar" />
          </div>
        </div>

      </form>


    </div>
  </div>
</div>



<?php 
if (isset($_GET["botao"])) {

  if(isset($_GET["idempreendimento"])){ 

    $quadra         = $_GET["quadra"];
    $lote           = $_GET["lote"];

    $nome_cliente   = $_GET["nome_cliente"];
    $numero_ficha   = $_GET["numero_ficha"];
    $status_venda   = $_GET["status_venda"];

    $imobiliaria_id = $_GET["imobiliaria_id"];
    $corretor_id    = $_GET["corretor_id"];



    $where = 'idvenda > 0';

    if($nome_cliente != ''){
      $where .= " AND cli.nome_cli LIKE '%".$nome_cliente."%'";
    }

    if($numero_ficha != ''){
      $where .= " AND idvenda = '$numero_ficha'";
    }

    if($status_venda != 'Todos' AND $status_venda != '' AND $status_venda == 3){
      $where .= " AND status_venda =".$status_venda;
      ?>
      <script type="text/javascript">
        let condicao = 3;
      </script>

      <?php

    }


    if($status_venda != 'Todos' AND $status_venda != '' AND $status_venda == 5){
      $status_venda = 3;  
      $where .= " AND status_venda =".$status_venda;

      ?>
      <script type="text/javascript">
        let condicao = 5;
      </script>

      <?php

    }

    if($status_venda != 'Todos' AND $status_venda != '' AND $status_venda == 0){
      $where .= " AND status_venda =".$status_venda;

      ?>
      <script type="text/javascript">
        let condicao = 0;
      </script>

      <?php

    }

    if($status_venda != 'Todos' AND $status_venda != '' AND $status_venda == 1){
      $where .= " AND status_venda =".$status_venda;

      ?>
      <script type="text/javascript">
        let condicao = 1;
      </script>

      <?php

    }

    if($status_venda != 'Todos' AND $status_venda != '' AND $status_venda == 2){
      $where .= " AND status_venda =".$status_venda;

      ?>
      <script type="text/javascript">
        let condicao = 2;
      </script>

      <?php

    }

    if($status_venda != 'Todos' AND $status_venda != '' AND $status_venda == 4){
      $where .= " AND status_venda =".$status_venda;

      ?>
      <script type="text/javascript">
        let condicao = 4;
      </script>

      <?php

    }

    if($imobiliaria_id != 'Todos' and $nome_cliente == '' and $numero_ficha == '' and $status_venda == 'Todos' and $quadra == '' and $lote == '') {
      $where .= " AND (imob.imob_id =".$imobiliaria_id." or imob.idcliente =".$imobiliaria_id.")";
    } 

    if(($imobiliaria_id != 'Todos' AND $imobiliaria_id != '') AND ($corretor_id != '0' and $corretor_id != '')){
      $where .= " AND  vnd.imobiliaria_idimobiliaria =".$corretor_id;
    }

    if($quadra != ''){
      $where .= " AND vnd.produto_idproduto = '$quadra'";
    }

    if($lote != ''){
      $where .= " AND vnd.lote_idlote = '$lote'";
    }


    ?>
    <!-- begin col-10 -->
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
          <h4 class="panel-title">Informações de Venda de Lotes</h4>
        </div>

        <div class="panel-body">
          <table id="data-table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Nº Ficha</th>
                <th>Imobiliaria</th>
                <th>Cliente</th>
                <th>Data Venda</th>
                <th>Quadra</th>
                <th>Lote</th>
                <th>Parcelas</th>

                <th><p>Proposta</p>Compra</th>
                <th>Ações</th>
                <th></th>
              </tr>
            </thead>
            <tbody>

              <?php

              $tipo_user = verifica_tipo($imobiliaria_idimobiliaria);

              $idempreendimento = $_GET["idempreendimento"];  
                //echo "o empreendimento é o .: " . $idempreendimento; die();                     

              include "conexao.php";
              if (in_array('49', $idrota)) { 
          //echo "entrei aqui tenho premissao 49";

                $query_amigo = "SELECT vnd.imobiliaria_idimobiliaria, imob.idcliente as imobid, cli.nome_cli as nomecliente, cliente_idcliente,idvenda, idlote, lote, quadra, libera_proposta, status_venda, data_venda, vnd.produto_idproduto, vnd.lote_idlote FROM venda vnd
                INNER JOIN cliente imob ON vnd.imobiliaria_idimobiliaria = imob.idcliente
                INNER JOIN cliente cli  ON vnd.cliente_idcliente = cli.idcliente
                INNER JOIN lote    ON vnd.lote_idlote = lote.idlote 
                INNER JOIN produto ON produto.idproduto = lote.produto_idproduto
                WHERE empreendimento_idempreendimento = $idempreendimento and status_venda != 1 AND $where
                order by idvenda desc";
              }else{
                $query_amigo = "SELECT vnd.imobiliaria_idimobiliaria, imob.idcliente as imobid, cli.nome_cli as nomecliente, cliente_idcliente,idvenda, idlote, lote, quadra, libera_proposta, status_venda, data_venda, vnd.produto_idproduto, vnd.lote_idlote FROM venda vnd
                INNER JOIN cliente imob ON vnd.imobiliaria_idimobiliaria = imob.idcliente
                INNER JOIN cliente cli  ON vnd.cliente_idcliente = cli.idcliente
                INNER JOIN lote    ON vnd.lote_idlote = lote.idlote 
                INNER JOIN produto ON produto.idproduto = lote.produto_idproduto
                WHERE empreendimento_idempreendimento = $idempreendimento AND (vnd.imobiliaria_idimobiliaria = $imobiliaria_idimobiliaria or imob.imob_id = $imobiliaria_idimobiliaria) and status_venda != 1 AND $where
                order by idvenda desc";
              }
              $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");


            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

              $idcliente        = $buscar_amigo['idcliente'];
              $idvenda          = $buscar_amigo["idvenda"];
              $idlote           = $buscar_amigo["idlote"];
              $nome_cli         = $buscar_amigo["nomecliente"];
              $lote             = $buscar_amigo["lote"];
              $quadra           = $buscar_amigo["quadra"];
              $libera_proposta  = $buscar_amigo["libera_proposta"];
              $status_venda     = $buscar_amigo["status_venda"];
              $data_venda       = $buscar_amigo["data_venda"];
              $idvenda_imob2    = $buscar_amigo["imobid"];
              $cliente_alterei  = $buscar_amigo["cliente_idcliente"];

              ?>
              <tr class="odd gradeX">
                <td><?php echo $idvenda ?></td>
                <td><?php 

                $nome_imob_v = nome_imob($idvenda_imob2);
                echo $nome_imob_v ?>



              </td>
              <td><?php echo nome_user($cliente_alterei) ?></td>
              <td><?php echo $data_venda ?></td>
              <td><?php echo $quadra ?></td>
              <td><?php echo $lote ?></td>
              <td>
               <?php if($status_venda != 0){ ?>
                <?php if (in_array('4', $idrota)) { ?>

                  <a href="parcelas.php?idvenda=<?php echo $idvenda ?>&tipo=2">  <span class="label label-primary">Parcelas</span></a>
                <?php } } ?>
              </td>

              <td>

               <?php if($status_venda != 0 or $idgrupo_acesso == 5){ ?>                                      
                <a href="contratolocacao/proposta_compra.php?idvenda=<?php echo $idvenda ?>"> <i class="fa fa-2x fa-file-pdf-o"></i></a>
              <?php } ?>


            </td>
            <td>
             <?php if($status_venda == 4){ ?>


              <span class="label label-danger">CANCELADO</span>



            <?php }else if($status_venda == 1){ ?>





              <span class="label label-danger">Proposta Recusada</span>



            <?php }else if($status_venda == 3 || $status_venda == 5) { ?>

              <?php $recebe_status = contrato_ativo($idvenda);

              if($recebe_status > 0){ ?>
                <div class="ativo"><span class="label label-success">Contrato Ativo</span><br><br>
                  <script>
                    if(condicao == 5){
                      $('.ativo').closest('tr').remove(); 
                    }
                  </script>
                </div>

              <?php }else{ ?>

                <div class="concluido"><span class="label label-primary">Contrato Concluido</span><br><br>
                  <script>
                    if(condicao == 3){
                      $('.concluido').closest('tr').remove(); 
                    }
                  </script>
                </div>

              <?php } ?>


            <?php }else if($status_venda == 2) { ?>




              <span class="label label-success">Proposta Aprovada</span><br><br>
              <?php if (in_array('29', $idrota)) { ?>
               <a href="lancar_contrato_empreendimento.php?idlote=<?php echo $idlote?>&idvenda=<?php echo $idvenda ?>&idempreendimento=<?php echo $idempreendimento ?>"><span class="label label-primary" id="<?php echo $idvenda ?>">Lançar Contrato </span></a>
             <?php } ?>


           <?php }else{ ?>
            <?php if (in_array('29', $idrota)) { ?>                                           



             <a href="confirmar_proposta.php?idlote=<?php echo $idlote?>&idvenda=<?php echo $idvenda ?>&idempreendimento=<?php echo $idempreendimento ?>"><span class="label label-success" id="<?php echo $idvenda ?>">Aprovar Proposta </span></a>
             <br><br>
             <a href="cancelar.php?idlote=<?php echo $idlote?>&idvenda=<?php echo $idvenda ?>&idempreendimento=<?php echo $idempreendimento ?>"><span class="label label-danger" id="C<?php echo $idvenda ?>">Recusar Proposta</span></a>

           <?php }else{  ?>

            <span class="label label-warning">Em Análise</span><br><br>



          <?php } } ?>  

          <?php 
          $total_rene = renegociacao($idvenda);
          if($total_rene > 0){
            ?>


            <a href="confirmar_renegociacao.php?venda_id=<?php echo $idvenda ?>&empreendimento_id=<?php echo $empreendimento['empreendimento_id'] ?>"><span class="label label-warning">Aprovar Renegociação </span></a><br><br>

            <a href="cancelar_renegociacao.php?venda_id=<?php echo $idvenda ?>&empreendimento_id=<?php echo $empreendimento['empreendimento_id'] ?>"><span class="label label-danger">Cancelar Renegociação </span></a>

          <?php } ?>

          <!--  Abaixo codigo para verificacao se existe distrato e aprovar sim ou nao -->

          <?php 
          $total_rene = distrato($idvenda);
          if($total_rene > 0){
            ?>


            <a href="confirmar_distrato.php?venda_id=<?php echo $idvenda ?>&empreendimento_id=<?php echo $empreendimento['empreendimento_id'] ?>&estornado_por=<?php echo $imobiliaria_idimobiliaria ?>&idlote=<?php echo $idlote ?>"><span class="label label-warning">Aprovar Cancelamento </span></a><br><br>

            <a href="cancelar_distrato.php?venda_id=<?php echo $idvenda ?>&empreendimento_id=<?php echo $empreendimento['empreendimento_id'] ?>"><span class="label label-danger">Cancelar</span></a>

          <?php } ?>

          <!--   Fim do codigo para distrato --> 




          <!--  Abaixo codigo para verificacao se existe distrato e aprovar sim ou nao -->

          <?php 
          $total_rene = cessao($idvenda);
          if($total_rene > 0){
            ?>


            <a href="confirmar_cessao.php?venda_id=<?php echo $idvenda ?>&empreendimento_id=<?php echo $empreendimento['empreendimento_id'] ?>&estornado_por=<?php echo $imobiliaria_idimobiliaria ?>&idlote=<?php echo $idlote ?>"><span class="label label-warning">Aprovar CESSÃO </span></a><br><br>

            <a href="cancelar_cessao.php?venda_id=<?php echo $idvenda ?>&empreendimento_id=<?php echo $empreendimento['empreendimento_id'] ?>"><span class="label label-danger">Cancelar CESSÃO </span></a>

          <?php } ?>

          <!--   Fim do codigo para distrato --> 





        </td>

        <td><a href="ver_contrato_empreendimento.php?venda_idvenda=<?php echo $idvenda ?>"><span class="btn btn-success">Abrir</span></a></td>

      </tr>
    <?php } ?>
  </tbody>
</table>
</div>
</div>
<!-- end panel -->
</div>
<!-- end col-10 -->

<?php } } ?>
</div>
<!-- end row -->

<div class="modal modal-message fade" id="modal-message1" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Subir Planilha de Contratos</h4>
      </div>
      <form class="form-action" action="relatorio_vendas.php?planilha=1&idempreendimento=<?php echo $_GET['idempreendimento'] ?>" method="POST" enctype="multipart/form-data" name="envia_xlsx">
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleFormControlFile1"> Selecione seu arquivo .xlsx</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="30000000" required="required">
            <input name="userfile" type="file" class="form-control-file" id="exampleFormControlFile1" required="required">
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success"/>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal modal-message fade" id="modal-message2" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Subir Planilha de Parcelas</h4>
      </div>
      <form class="form-action" action="relatorio_vendas.php?planilha=2&idempreendimento=<?php echo $_GET['idempreendimento'] ?>" method="POST" enctype="multipart/form-data" name="envia_xlsx">
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleFormControlFile1"> Selecione seu arquivo .xlsx</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="30000000" required="required">
            <input name="userfile" type="file" class="form-control-file" id="exampleFormControlFile1" required="required">
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success"/>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- end #content -->


<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->
</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->

<script src="https://immobilebusiness.com.br/admin/assets/js/jquery.maskMoney.js" type="text/javascript"></script>

<script type="text/javascript">

  $(function(){
    $("#valor").maskMoney({symbol:'R$ ', 
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

  <!-- ================== END BASE JS ================== -->

  <!-- ================== END BASE JS ================== -->
  
  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/masked-input/masked-input.min.js"></script>
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

  <script type='text/javascript' src='produtos_pagar.js'></script>
  <script type='text/javascript' src='lote_pagar.js'></script>
  <!-- ================== END PAGE LEVEL JS ================== -->
  
  <script>
    $(document).ready(function() {
      App.init();
      FormPlugins.init();
      TableManageButtons.init();
    });
  </script>
  <script type="text/javascript">
    $(document).click( function() {
     /* Executa a requisição quando o campo CEP perder o foco */
     $('#imobiliaria_id').click(function(){


       /* Configura a requisição AJAX */
       $.ajax({
        url : 'consultar_corretor.php', /* URL que será chamada */ 
        type : 'POST', /* Tipo da requisição */ 
        data: 'imobiliaria_id=' + $('#imobiliaria_id').val(), /* dado que será enviado via POST */
        dataType: 'json', /* Tipo de transmissão */
        success: function(data){

          var $corretor = $('#corretor_id');
          $corretor.empty();

          $.each(data, function(idcorretor, corretor){
           $corretor.append('<option value=' + idcorretor + '>' + corretor + '</option>');
         });

          $corretor.change();        

        }
      });   
       return false;    
     })
   });
 </script>
</body>

</html>
