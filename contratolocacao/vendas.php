<?php  ob_start(); 
error_reporting(0);
ini_set(“display_errors”, 0 ); 
set_time_limit(0);
ini_set("upload_max_filesize", "10M");
ini_set("max_execution_time", "800");
ini_set("memory_limit", "-1");
ini_set("realpath_cache_ttl", "120");

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
function converterdata($dateSql){
    $ano= substr($dateSql, 6);
    $mes= substr($dateSql, 3,-5);
    $dia= substr($dateSql, 0,-8);
    return $ano."-".$mes."-".$dia;
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


  
  $idempreendimento         = $_GET["empreendimento_id"];
  $quadra         = $_GET["idquadra"];
  $lote           = $_GET["lote"];

  $status_venda   = $_GET["status_venda"];

  $imobiliaria_id = $_GET["imobiliaria_id"];
  $corretor_id    = $_GET["corretor_id"];
  
  $inicio                   = $_GET["inicio"];
  $fim                      = $_GET["fim"];
  

  $where = 'idvenda > 0';


   


  if($status_venda != 'Todos' AND $status_venda != ''){
    $where .= " AND status_venda =".$status_venda;
  }

   if(($imobiliaria_id != 'Todos' AND $imobiliaria_id != '') AND ($corretor_id == 0 AND $corretor_id == '')){
    $where .= " AND (imob.imob_id =".$imobiliaria_id." or imob.idcliente =".$imobiliaria_id.")";
  } 
  
  if(($imobiliaria_id != 'Todos' AND $imobiliaria_id != '')AND ($corretor_id != 0 and $corretor_id != '')){
    $where .= " AND  vnd.imobiliaria_idimobiliaria =".$corretor_id;
  }

  if($quadra != '' AND $quadra != 0){
    $where .= " AND vnd.produto_idproduto = '$quadra'";
  }

   if($lote != '' AND $lote != 0){
    $where .= " AND vnd.lote_idlote = '$lote'";
  }

  if($inicio != '' AND $fim != ''){
        $where .=" AND STR_TO_DATE(data_venda, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";

      }

if($status_venda != 'Todos'){

if($status_venda == 0){
  $exibir_status = 'Proposta em Análise';
}elseif($status_venda == 1){
  $exibir_status = 'Proposta Recusada';
}elseif($status_venda == 2){
  $exibir_status = 'Proposta Aprovada';
}elseif($status_venda == 3){
  $exibir_status = 'Contrato Ativo';
}else{
  $exibir_status ='Contrato Concluido';
}

}

if($inicio != '' and $inicio != 0 and $inicio != 'Todos'){
    $rel_inicio = date("d-m-Y", strtotime($inicio));
    $rel_fim    = date("d-m-Y", strtotime($fim));

    $rel_periodo = "$rel_inicio"." até ".$rel_fim;
}else{
  $rel_periodo = '';
}

$rel_empreendimento = dados_empreendimento($idempreendimento);
$logo = fotologo($idempreendimento);
$rel_quadra = dados_quadra($quadra);
$rel_lote   = dados_lote($lote);

$rel_imobiliaria = nome_user($imobiliaria_id);
$rel_corretor    = nome_user($corretor_id);

require_once("dompdf/dompdf_config.inc.php");

/* Cria a instância */
$dompdf = new DOMPDF();
 

 
      $html = "<table style='width:100%' border='0'>
    <tr>
      <td colspan='2'><img src='../img/$idempreendimento/$logo' height='110' /></td>
      <td colspan='2' style='text-align: center'>Caldas Novas, $dia_hoje de $nome_mes de $ano_hoje</td>
    </tr>
    <tr>
      <td colspan='4' style='text-align: center; font-weight: bold;'>RELATÓRIO DE VENDAS</td>
    </tr>
 
    <tr>
      <td colspan='3'><span style='font-weight: bold'>Empreendimento</span>: $rel_empreendimento</td>
      <td><span style='font-weight: bold'>Q:</span> $rel_quadra / <span style='font-weight: bold'>L:</span> $rel_lote</td>
    </tr>
    <tr>
      <td colspan='2'><span style='font-weight: bold'>Status</span>: $exibir_status </td>
      <td><span style='font-weight: bold'>Imobiliaria:</span> $rel_imobiliaria</td>
      <td><span style='font-weight: bold'>Corretor:</span>: $rel_corretor </td>
    </tr>
    <tr>
      <td colspan='2'><span style='font-weight: bold'>Periodo</span>: $rel_periodo</td>
    </tr>
</table>";


$html .="<table style='width:100%; font-size:10px;' height='127' border='0'>

    <tr bgcolor='#b8b8b8'>
      <td style='text-align: center'><strong>Nº Ficha</strong></td>
      <td style='text-align: center'><strong>Imobiliaria</strong></td>
      <td style='text-align: center'><strong>Cliente</strong></td>
      <td style='text-align: center'><strong>Data Venda</strong></td>
      <td style='text-align: center'><strong>Q/L</strong></td>

      <td style='text-align: center'><strong>Valor Venda</strong></td>
      <td style='text-align: center'><strong>Sinal</strong></td>
      <td style='text-align: center'><strong>Entrada</strong></td>      
      <td style='text-align: center'><strong>Qtd Entrada</strong></td>
      <td style='text-align: center'><strong>Parcela Entrada</strong></td>

      <td style='text-align: center'><strong>Saldo Devedor</strong></td>
      <td style='text-align: center'><strong>Qtd Parcelas</strong></td>
      <td style='text-align: center'><strong>Parcela Financiamento</strong></td>
      <td style='text-align: center'><strong>1º Vencimento</strong></td>
      <td style='text-align: center'><strong>Restantes</strong></td>
      <td style='text-align: center'><strong>Taxa %</strong></td>

    </tr>";

    $inicio  = converterdata($inicio);
          $fim     = converterdata($fim);

   
        include "../conexao.php";
       $query_amigo = "SELECT vnd.valor_desconto, vnd.valor_entrada, vnd.vencimento_primeira, vnd.valor_para_parcelamento, vnd.plano_pagamento, vnd.taxa_financiamento, vnd.parcela_entrada, vnd.vencimento_restante, vnd.entrada_restante, vnd.valor_parcela_financiamento, vnd.valor_parcela_entrada, vnd.imobiliaria_idimobiliaria, imob.idcliente as imobid, cli.nome_cli as nomecliente, cliente_idcliente,idvenda, idlote, lote, quadra, libera_proposta, status_venda, data_venda, vnd.produto_idproduto, vnd.lote_idlote FROM venda vnd
                INNER JOIN cliente imob ON vnd.imobiliaria_idimobiliaria = imob.idcliente
                INNER JOIN cliente cli  ON vnd.cliente_idcliente = cli.idcliente
                INNER JOIN lote    ON vnd.lote_idlote = lote.idlote 
                INNER JOIN produto ON produto.idproduto = lote.produto_idproduto 
                INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                WHERE empreendimento_cadastro_id = $idempreendimento  AND $where
                order by idvenda desc";

            //   echo $query_amigo; die();

                 $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
                 
            $valor_desconto           = $buscar_amigo['valor_desconto'];
            $valor_entrada            = $buscar_amigo['valor_entrada'];
            $vencimento_primeira      = $buscar_amigo['vencimento_primeira'];
            $valor_para_parcelamento  = $buscar_amigo['valor_para_parcelamento'];
            $plano_pagamento          = $buscar_amigo['plano_pagamento'];
            $taxa_financiamento       = $buscar_amigo['taxa_financiamento'];
            $parcela_entrada          = $buscar_amigo['parcela_entrada'];
            $vencimento_restante      = $buscar_amigo['vencimento_restante'];
            $entrada_restante         = $buscar_amigo['entrada_restante'];
            $valor_parcela_financiamento  = $buscar_amigo['valor_parcela_financiamento'];
            $valor_parcela_entrada        = $buscar_amigo['valor_parcela_entrada'];


            $idcliente        = $buscar_amigo['idcliente'];
            $idvenda          = $buscar_amigo["idvenda"];
            $idlote           = $buscar_amigo["idlote"];
            $nome_cli         = $buscar_amigo["nomecliente"];
            $lote             = $buscar_amigo["lote"];
            $quadra           = $buscar_amigo["quadra"];
            $libera_proposta  = $buscar_amigo["libera_proposta"];
            $status_venda     = $buscar_amigo["status_venda"];
            $data_venda       = $buscar_amigo["data_venda"];
            $idvenda_imob2       = $buscar_amigo["imobid"];
            $cliente_alterei       = $buscar_amigo["cliente_idcliente"];
            
              $nome_imob_v = nome_user($idvenda_imob2);
              $imobiliaria = nome_user($cliente_alterei);           


              $valor_para_parcelamento = number_format($valor_para_parcelamento, 2, ',', '.');
              $valor_desconto = number_format($valor_desconto, 2, ',', '.');
              $valor_entrada = number_format($valor_entrada, 2, ',', '.');
              $valor_parcela_entrada = number_format($valor_parcela_entrada, 2, ',', '.');
              $valor_parcela_financiamento = number_format($valor_parcela_financiamento, 2, ',', '.');

           


 $html .="<tr>
  <td style='text-align: center'>$idvenda</td>
  <td style='text-align: center'>  $nome_imob_v </td>
  <td style='text-align: center'>$imobiliaria</td>
  <td style='text-align: center'>$data_venda</td>
  <td style='text-align: center'>$quadra / $lote</td>

      <td style='text-align: center'>$valor_desconto</td>
      <td style='text-align: center'>$valor_entrada</td>
      <td style='text-align: center'>$entrada_restante</td>      
      <td style='text-align: center'>$parcela_entrada</td>
      <td style='text-align: center'>$valor_parcela_entrada</td>

      <td style='text-align: center'>$valor_para_parcelamento</td>
      <td style='text-align: center'>$plano_pagamento</td>
      <td style='text-align: center'>$valor_parcela_financiamento</td>
      <td style='text-align: center'>$vencimento_primeira</td>
      <td style='text-align: center'>$vencimento_restante</td>
      <td style='text-align: center'>$taxa_financiamento</td>
 
  </tr>";

}






$html .="</table>";


$dompdf->load_html($html);
  $dompdf->set_paper("A4","landscape");
  ob_clean();

  $pdf = $dompdf->render();
  $canvas = $dompdf->get_canvas(); 
  $font = Font_Metrics::get_font("helvetica", "bold"); 
  $canvas->page_text(510, 18, "", $font, 6, array(0,0,0)); 
  $canvas->page_text(270, 792, "Pág. {PAGE_NUM}/{PAGE_COUNT}", $font, 6, array(0,0,0)); 
  header("Content-type: application/pdf");     
 
 
$dompdf->stream(
    "saida.pdf", 
    array(
        "Attachment" => false 
    )
);






?>
