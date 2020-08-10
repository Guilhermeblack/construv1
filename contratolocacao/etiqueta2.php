<?php  ob_start(); 
error_reporting(0);
ini_set(“display_errors”, 0 ); 
set_time_limit(0);
ini_set("upload_max_filesize", "10M");
ini_set("max_execution_time", "800");
ini_set("memory_limit", "-1");
ini_set("realpath_cache_ttl", "120");

$ordenar = $_GET['ordenar'];

if (!isset($_SESSION)) {
  session_start();
  global $usuario;

  $usuario = $_SESSION["id_usuario"];

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
    $juros_hr  = '0200';
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
  include "../conexao.php";

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


//$usuario = $_SESSION['imobiliaria_idimobiliaria'];

function pegaUsuario(){
      include '../conexao.php';
      global $usuario;
      $query_amigo = "SELECT nome_cli FROM cliente WHERE idcliente = '$usuario'";
     

      $executa_query = mysqli_query($db,$query_amigo) or die ("Erro ao listar usuario");
      $buscar_amigo = mysqli_fetch_assoc($executa_query);

      $dados = $buscar_amigo['nome_cli'];
    
 
      return $dados;
}

$usu = pegaUsuario();





function dados_locacao($locacao_id){
    include "../conexao.php";
            $query_amigo = "SELECT * FROM locacao 
                            INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel                    
                            WHERE idlocacao = $locacao_id";                           
            $executa_query = mysqli_query ($db,$query_amigo);                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
            $endereco   = $buscar_amigo['endereco'];
            $numero     = $buscar_amigo['numero'];
            $cep        = $buscar_amigo['cep'];

          }

          $exibir = $endereco.", ".$numero." Cep: ".$cep;

          return $exibir;
}



function dados_empreendimento($empreendimento_id){
    include "../conexao.php";
            $query_amigo = "SELECT * FROM empreendimento_cadastro                           
                            WHERE idempreendimento_cadastro = $empreendimento_id";                           
            $executa_query = mysqli_query ($db,$query_amigo);                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
            $descricao_empreendimento   = $buscar_amigo['descricao_empreendimento'];
          }

          return $descricao_empreendimento;
}
function fotologo($empreendimento_id){
    include "../conexao.php";
            $query_amigo = "SELECT * FROM empreendimento_cadastro                           
                            WHERE idempreendimento_cadastro = $empreendimento_id";                           
            $executa_query = mysqli_query ($db,$query_amigo);                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
            $img   = $buscar_amigo['img_lote'];
          }

          return $img;
}

function dados_quadra($quadra_id){
    include "../conexao.php";
            $query_amigo = "SELECT * FROM produto                           
                            WHERE idproduto = $quadra_id";                           
            $executa_query = mysqli_query ($db,$query_amigo);                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
            $quadra   = $buscar_amigo['quadra'];
          }

          return $quadra;
}

function dados_lote($lote_id){
    include "../conexao.php";
            $query_amigo = "SELECT * FROM lote                           
                            WHERE idlote = $lote_id";                           
            $executa_query = mysqli_query ($db,$query_amigo);                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
            $lote   = $buscar_amigo['lote'];
          }

          return $lote;
}

function nome_user($id){
    include "../conexao.php";
     $query_igpm = "SELECT nome_cli FROM cliente where idcliente = $id";

                $executa_igpm = mysqli_query ($db, $query_igpm);
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $nome_cli             = $buscar_amigoc['nome_cli'];
}
return $nome_cli;

} 
function cpf_user($id){
    include "../conexao.php";
     $query_igpm = "SELECT cpf_cli FROM cliente where idcliente = $id";

                $executa_igpm = mysqli_query ($db, $query_igpm);
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $cpf_cli             = $buscar_amigoc['cpf_cli'];
}
return $cpf_cli;

} 



function converterdata($dateSql){
    $ano= substr($dateSql, 6);
    $mes= substr($dateSql, 3,-5);
    $dia= substr($dateSql, 0,-8);
    return $ano."-".$mes."-".$dia;
}


function forma_pagamento($id){
include "../conexao.php";
    $query_amigo = "SELECT * FROM forma_pagamento where idforma_pagamento = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $descricao           = $buscar_amigo["descricao"];
    }
    return $descricao;
}



function retorna_dados_cliente_zika($id, $idvenda){
  /*
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
    $juros_hr  = '0200';
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
  }*/

  $wes_hoje = date('dmy');
  include "../conexao.php";

  $query_amigo323 = "SELECT * FROM cliente WHERE cliente.idcliente = $id";

  $executa_query323 = mysqli_query ($db,$query_amigo323) or die ("Erro ao listar dados cliente");

    while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se são amigos
      $idcliente                  = $buscar_amigo323['idcliente'];
      $nome_cli                   = $buscar_amigo323['nome_cli'];
      $cidade_cli         = $buscar_amigo323['cidade_cli'];
      $numero_cli         = $buscar_amigo323['numero_cli'];
      $endereco_cli       = $buscar_amigo323['endereco_cli'];
      $bairro_cli         = $buscar_amigo323['bairro_cli'];
      $cep_cli          = $buscar_amigo323['cep_cli'];
    }

    $dados['nome_cli']                 = $nome_cli;
    $dados['cidade_cli']         = $cidade_cli;
    $dados['numero_cli']               = $numero_cli;
    $dados['endereco_cli']             = $endereco_cli;
    $dados['bairro_cli']               = $bairro_cli;
    $dados['cep_cli']                  = $cep_cli;

    return $dados;
}

function geraTimestamp($data) {
$partes = explode('-', $data);
$tratada = $partes[2].'-'.$partes[1].'-'.$partes[0];
return $tratada;
}
   
  
date_default_timezone_set('America/Sao_Paulo');               
$horario_relatorio = date('d-m-Y H:i:s');

$data_venda = date("d-m-Y");
$arrayData = explode("-",$data_venda);

// Imprimindo os dados:
$dia = $arrayData[0];
$mes = intval($arrayData[1]);
$ano = $arrayData[2];


$dia_hoje = $dia;
$ano_hoje = $ano;
 
 $hoje = getdate();

$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 0 => "Outubro", 11 => "Novembro", 12 => "Dezembro");


 $nome_mes = $meses[$mes];


    
      $inicio                   = $_GET["inicio"];
      $fim                      = $_GET["fim"];
      $situacao_and = "";



      $cliente_idcliente        = $_GET["cliente_idcliente"];
      $empreendimento_id        = $_GET["empreendimento_id"];
      $numero_lancamento        = $_GET["numero_lancamento"];
      $numero_baixa             = $_GET["numero_baixa"];
      $situacao                 = $_GET["situacao"];
      $tipo_periodo             = $_GET["tipo_periodo"];

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
        $tabela_periodo ='data_recebimento';
      }elseif($tipo_periodo == '2'){
        $tabela_periodo ='data_vencimento_parcela';
      }elseif($tipo_periodo == '3'){
        $tabela_periodo ='data_baixa';
      }else{
        $tabela_periodo ='data_vencimento_parcela';

      }

                              
      $cont_contrato  = 0;
      $cont_cancelado = 0;
      $inner_busca = '';
     // $inner_busca =' INNER JOIN centrocobranca ON parcelas.centrocusto_id = centrocobranca.idcentrocobranca


    if($empreendimento_id != ''){
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

      if($numero_lancamento != ''){
        $situacao_and .= " AND idparcelas =".$numero_lancamento;
      }

       if($inicio != '' AND $fim != ''){
        $situacao_and .=" AND STR_TO_DATE(".$tabela_periodo.", '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";

      }



 
 // Abaixo codigos de verificação dos dados do filtro APENAS PARA EXIBIR NO CABEÇALHO DO RELATORIO

if($cliente_idcliente != '' and $cliente_idcliente != 0 and $cliente_idcliente != 'Todos'){
  $rel_nome_cli = nome_user($cliente_idcliente);
}else{
  $rel_nome_cli = '';
}

if($empreendimento_id != '' and $empreendimento_id != 0 and $empreendimento_id != 'Todos'){
  $rel_empreendimento = dados_empreendimento($empreendimento_id);
  $logo = fotologo($empreendimento_id);
}else{
  $rel_empreendimento = '';
}

if($quadra != '' and $quadra != 0 and $quadra != 'Todos'){
  $rel_quadra = dados_quadra($quadra);
}else{
  $rel_quadra = '';
}

if($lote != '' and $lote != 0 and $lote != 'Todos'){
  $rel_lote = dados_lote($lote);
}else{
  $rel_lote = '';
}

if($inicio != '' and $inicio != 0 and $inicio != 'Todos'){
    $rel_inicio = date("d-m-Y", strtotime($inicio));
    $rel_fim    = date("d-m-Y", strtotime($fim));

    $rel_periodo = "$rel_inicio"." até ".$rel_fim;
}else{
  $rel_periodo = '';
}

  
if($tipo_periodo != '' and $tipo_periodo != 0 and $tipo_periodo != 'Todos'){

 if($tipo_periodo == '1'){
        $rel_tipo_periodo ='Data Recebimento';
      }elseif($tipo_periodo == '2'){
        $rel_tipo_periodo ='Data Vencimento';
      }elseif($tipo_periodo == '3'){
        $rel_tipo_periodo ='Data de Baixa';
      }else{
        $rel_tipo_periodo ='Data Vencimento';
      }

}else{
  $rel_tipo_periodo = 'Data Vencimento';
}


if($situacao != '' and $situacao != 0 and $situacao != 'Todos'){
  if($situacao == 1){
        $rel_situacao = "Em Aberto";
      }elseif ($situacao == 2) {
        $rel_situacao = "Pago";
      }else{
        $rel_situacao = 'Todos';
      }
  }else{
  $rel_situacao = 'Todos';
}



if($numero_lancamento != '' and $numero_lancamento != 0 and $numero_lancamento != 'Todos'){
  $rel_numero_lancamento = $numero_lancamento;
}else{
  $rel_numero_lancamento = '';
}

if($numero_baixa != '' and $numero_baixa != 0 and $numero_baixa != 'Todos'){
  $rel_numero_baixa = $numero_baixa;
}else{
  $rel_numero_baixa = '';
}

require_once("dompdf/dompdf_config.inc.php");

/* Cria a instância */
$dompdf = new DOMPDF();
 
      if($_GET['empreendimento_id'] != 'Todos' ){ 

            $image = "<img src='../img/$empreendimento_id/$logo' height='110' />";
       }else{
            $image = "";
       }


 
      $html = "<table style='width:100%' border='0'>
    <tr>
      <td colspan='2'>$image</td>
      <td colspan='2' style='text-align: right'>Caldas Novas, $dia_hoje de $nome_mes de $ano_hoje<br><font style='font-size: 10px'> Emitidor por.: $usu</font></td>
    </tr>
    <tr>
      <td colspan='4' style='text-align: center; font-weight: bold;'>RELATÓRIO DE RECEBIMENTOS</td>
    </tr>
    <tr>
      <td colspan='2'><span style='font-weight: bold'>Cliente</span>: $rel_nome_cli</td>
      
    </tr>
    <tr>
      <td colspan='3'><span style='font-weight: bold'>Empreendimento</span>: $rel_empreendimento</td>
      <td><span style='font-weight: bold'>Q:</span> $rel_quadra / <span style='font-weight: bold'>L:</span> $rel_lote</td>
    </tr>
    <tr>
      <td colspan='2'><span style='font-weight: bold'>Periodo</span>: $rel_periodo / <strong>Tipo Periodo</strong> $rel_tipo_periodo </td>
      <td><span style='font-weight: bold'>Situação :</span> $rel_situacao</td>
      <td><span style='font-weight: bold'>Nº Lanc</span>: $rel_numero_lancamento <strong> Nº Baixa: </strong>$rel_numero_baixa</td>
    </tr>
</table>";


$html .="<table style='width:100%; font-size:10px;' height='127' border='0'>

    <tr bgcolor='#b8b8b8'>
      <td style='text-align: center'><strong>Q/L</strong></td>
      <td style='text-align: center'><strong>Nº Lanc</strong></td>
      <td style='text-align: center'><strong>Parcela Nº</strong></td>
      <td style='text-align: center'><strong>Cliente</strong></td>
      <td style='text-align: center'><strong>Descrição</strong></td>
      <td style='text-align: center'><strong>Vencimento</strong></td>
      <td style='text-align: center'><strong>Valor</strong></td>
      <td style='text-align: center'><strong>Situação</strong></td>
      <td style='text-align: center'><strong>Data Recebto</strong></td>
      <td style='text-align: center'><strong>Juros</strong></td>
      <td style='text-align: center'><strong>Honor.</strong></td>
      <td style='text-align: center'><strong>Valor Pago</strong></td>
    </tr>";

     $inicio  = converterdata($inicio);
          $fim     = converterdata($fim);
     
     $cont_valor_parcelas = 0;
     $cont_acre = 0;
     $cont_pago = 0;
     $cont_desc = 0;
     $cont_total_juros = 0;
     $cont_hono = 0;
     
     if($ordenar == "quadra_lote" OR $ordenar == '' ){
        // $ord = "produto.quadra, venda.lote_idlote";
         $ord = "CAST(produto.quadra as UNSIGNED), CAST(lote.lote as UNSIGNED)";

     }else if($ordenar == 'lancamento'){
         $ord = "parcelas.numero_sequencia";
     }else if($ordenar == 'cliente'){
         $ord = "cliente.nome_cli";
     }else if($ordenar == 'dt_vencimento'){
         $ord = "parcelas.data_vencimento_parcela";
     }else if($ordenar == 'dt_recebimento'){
         $ord = "parcelas.data_recebimento";
     }else if($ordenar == 'situacao'){
         $ord = "parcelas.situacao";
     }else if($ordenar == 'parcelas'){
         $ord = "parcelas.numero_sequencia";
     }
     
     
     

        include "../conexao.php";
        $query = "SELECT parcelas.idparcelas, parcelas.numero_sequencia,parcelas.desc_parcela, parcelas.cliente_id_novo,data_lancamento_sistema, lancamento_por, baixado_por, data_baixa,parcelas.acre_parcela,parcelas.tipo_venda, parcelas.venda_idvenda, parcelas.valor_recebido, parcelas.valor_parcelas, parcelas.data_recebimento, parcelas.descricao,parcelas.situacao,parcelas.cod_baixa,parcelas.forma_pagamento, parcelas.obs_caldas,  STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') as venc, produto.quadra , venda.lote_idlote, parcelas.juros_mora, parcelas.juros_multa, parcelas.juros_outros,  
                                  cliente.nome_cli FROM cliente INNER JOIN   parcelas  ON cliente.idcliente = parcelas.cliente_id_novo  $inner_busca INNER JOIN lote ON venda.lote_idlote = lote.idlote INNER JOIN produto ON venda.produto_idproduto = produto.idproduto 
                                   WHERE fluxo = 0  $situacao_and order by $ord  Asc";

               // echo $query;

                  $executa_query = mysqli_query($db, $query);

                $reg = 0; 

                $dados = array();
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                  $idparcelas                  = $buscar_amigo["idparcelas"];
                  $tipo_venda                  = $buscar_amigo["tipo_venda"];
                  $venda_idvenda               = $buscar_amigo["venda_idvenda"];
                  $cliente_id_novo             = $buscar_amigo["cliente_id_novo"];

                  $cliente = retorna_dados_cliente_zika($cliente_id_novo);
                  $dados_cli = retorna_dados_cliente($idparcelas, $venda_idvenda, $tipo_venda);

                  $dado = null;
                  $dado[] = $cliente['nome_cli']; 
                  $dado[] = $cliente['cidade_cli']; 
                  $dado[] = $cliente['bairro_cli']; 
                  $dado[] = $cliente['cep_cli']; 
                  $dado[] = $cliente['endereco_cli'];
                  $dado[] = $dados_cli['lote'];
                  $dado[] = $dados_cli['quadra'];

                  $dados[] = $dado;

                }


?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://immobilebusiness.com.br/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
</head>
<body>
  <a id="baixar" href="https://etiquetas.ibsystem.com.br/etiqueta/etiquetas.pdf"></a>
  <script type="text/javascript">
    $(document).ready(function(){
      var dados = [];
      var dado = [];

      <?php 
      foreach ($dados as $key => $value) {
        foreach ($value as $chave => $valor) {
          ?>
          dado.push('<?php echo $valor; ?>');
          <?php
        }
        ?>
        dados.push(dado);
        dado = [];
        <?php
      }
      ?>

      $.ajax({  
        url:'https://etiquetas.ibsystem.com.br/etiqueta/etiqueta.php',  
        method:'POST', 
        data: {dados},
        success: dados =>   
        {  
          window.location.replace("../etiqueta.php?confirma_etiqueta=1");
        },
        error: erro => {
          alert('Erro ao Gerar etiquetas!');
        }  
      });
      
    });
  </script>
</body>
</html>
