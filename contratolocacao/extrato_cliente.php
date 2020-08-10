<?php  ob_start(); 
error_reporting(0);
ini_set(“display_errors”, 0 ); 

set_time_limit(0);
ini_set("upload_max_filesize", "100M");
ini_set("max_execution_time", "800");
ini_set("memory_limit", "-1");
ini_set("realpath_cache_ttl", "120");

function busca_idvenda($quadra, $lote){
  include "../conexao.php";
  $query = "SELECT idvenda FROM venda where produto_idproduto = $quadra AND lote_idlote = $lote";
  $executa_query = mysqli_query($db, $query);
  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)){
    $idvenda = $buscar_amigo["idvenda"];
  }
  return $idvenda;
}


function calcula_saldo_devedor($valor_parcela, $qtd_parcela_restante, $taxa){

$F = 0;
$M =$valor_parcela;
$n = $qtd_parcela_restante;
if($taxa == ''){
  $i = 0;
}else{
  $i = $taxa/100;
}



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
  include "../conexao.php";

    $total_outros = 0;
    $total_financiamento = 0;

    $query_amigo = "SELECT COUNT(idparcelas) as total, valor_parcelas
                    FROM parcelas 
                    where venda_idvenda = $venda_idvenda and tipo_venda = 2 AND fluxo = 0 AND descricao = 'Financiamento'";
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

function valor_taxa($idvenda, $tipo_venda){
    include "../conexao.php";
    $query_amigo = "SELECT taxa_financiamento FROM venda where idvenda = $idvenda";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $taxa_financiamento           = $buscar_amigo["taxa_financiamento"];
    }
    return $taxa_financiamento;
}
function valor($id){
    include "../conexao.php";
    $query_amigo = "SELECT empreendimento_id_novo, cliente_id_novo FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $empreendimento_id_novo    = $buscar_amigo["empreendimento_id_novo"];
      $cliente_id_novo           = $buscar_amigo["cliente_id_novo"];

      $dados["empreendimento_id_novo"] = $empreendimento_id_novo;
      $dados["cliente_id_novo"]        = $cliente_id_novo;
    }
    return $dados;
}

function data_vencimento_parcela($id){
    include "../conexao.php";
    $query_amigo = "SELECT data_vencimento_parcela FROM parcelas where idparcelas = $id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $data_vencimento_parcela           = $buscar_amigo["data_vencimento_parcela"];
    }
    return $data_vencimento_parcela;
}
function geraTimestamp($data) {
$partes = explode('-', $data);
$tratada = $partes[2].'-'.$partes[1].'-'.$partes[0];
return $tratada;
}

function busca_primeira($idvenda){
  include "../conexao.php";
  $query = "SELECT data_vencimento_parcela FROM parcelas where venda_idvenda = $idvenda AND tipo_venda = 2 AND descricao = 'Financiamento' order by idparcelas ASC limit 1";
  $executa_query = mysqli_query($db, $query);
  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)){
    $data_vencimento_parcela = $buscar_amigo["data_vencimento_parcela"];
  }
  return $data_vencimento_parcela;
}


function valor_convertido($id, $idvenda, $tipo){
    include "../conexao.php";
  $hoje = date('Y-m-d');
    $query_amigo = "SELECT venda_idvenda,descricao, data_vencimento_parcela, valor_parcelas FROM parcelas where idparcelas = $id";
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






function dados_contrato($idparcelas){
  include "../conexao.php";

  $busca_cliente = "SELECT * FROM parcelas
                    INNER JOIN venda ON parcelas.venda_idvenda = venda.idvenda 
                    INNER JOIN lote ON venda.lote_idlote = lote.idlote 
                    INNER JOIN produto ON venda.produto_idproduto = produto.idproduto
                    WHERE idparcelas = $idparcelas";
  $executa_query = mysqli_query($db, $busca_cliente);

  while ($busca_dados = mysqli_fetch_assoc($executa_query)) {
        
         $quadra          = $busca_dados['quadra'];
         $lote            = $busca_dados['lote'];
         $numero_sequencia            = $busca_dados['numero_sequencia'];
         
  }


        $dados["quadra"]   = $quadra;
        $dados["lote"]     = $lote;
        $dados["numero_sequencia"]     = $numero_sequencia;
       

        return $dados;
}

function dados_cliente($idcliente){
  include "../conexao.php";

  $busca_cliente = "SELECT * FROM cliente WHERE idcliente = $idcliente";
  $executa_query = mysqli_query($db, $busca_cliente);

  while ($busca_dados = mysqli_fetch_assoc($executa_query)) {
        
         $idcliente          = $busca_dados['idcliente'];
         $nome_cli           = $busca_dados['nome_cli'];
         $fisico_juridico    = $busca_dados['fisico_juridico'];
         $endereco_cli       = $busca_dados['endereco_cli'];
         $numero_cli         = $busca_dados['numero_cli'];
         $bairro_cli         = $busca_dados['bairro_cli'];
         $cidade_cli         = $busca_dados['cidade_cli'];
         $cep_cli            = $busca_dados['cep_cli'];
         $estado_cli         = $busca_dados['estado_cli'];
         $email_cli          = $busca_dados['email_cli'];
         $telefone1_cli      = $busca_dados['telefone1_cli'];
         $telefone2_cli      = $busca_dados['telefone2_cli'];

         $cpf_cli            = $busca_dados['cpf_cli'];
         $rg_cli             = $busca_dados['rg_cli'];
         $nascimento_cli     = $busca_dados['nascimento_cli'];
         $profissao_cli      = $busca_dados['profissao_cli'];
         $estadocivil_cli    = $busca_dados['estadocivil_cli'];
         $nacionalidade_cli  = $busca_dados['nacionalidade_cli'];
  }


        $dados["idcliente"]         = $idcliente;
        $dados["nome_cli"]          = $nome_cli;
        $dados["fisico_juridico"]   = $fisico_juridico;
        $dados["endereco_cli"]      = $endereco_cli;
        $dados["numero_cli"]        = $numero_cli;
        $dados["bairro_cli"]        = $bairro_cli;
        $dados["cidade_cli"]        = $cidade_cli;
        $dados["cep_cli"]           = $cep_cli;
        $dados["estado_cli"]        = $estado_cli;
        $dados["email_cli"]         = $email_cli;
        $dados["telefone1_cli"]     = $telefone1_cli;
        $dados["telefone2_cli"]     = $telefone2_cli;
        $dados["cpf_cli"]           = $cpf_cli;
        $dados["rg_cli"]            = $rg_cli;
        $dados["nascimento_cli"]    = $nascimento_cli;
        $dados["profissao_cli"]     = $profissao_cli;
        $dados["estadocivil_cli"]   = $estadocivil_cli;
        $dados["nacionalidade_cli"] = $nacionalidade_cli;

        return $dados;
}

function total_pago($venda_idvenda){
  include "../conexao.php";

    $total_outros = 0;
    $total_financiamento = 0;

    $query_amigo = "SELECT SUM(valor_parcelas) as total
                    FROM parcelas 
                    where venda_idvenda = $venda_idvenda and tipo_venda = 2 AND fluxo = 0 AND situacao = 'Pago'";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $total       = $buscar_amigo["total"];

    }

 return $total;
}


function total_outros($venda_idvenda){
  include "../conexao.php";

    $total_outros = 0;
    $total_financiamento = 0;

    $query_amigo = "SELECT SUM(valor_parcelas) as total, descricao
                    FROM parcelas 
                    where venda_idvenda = $venda_idvenda AND fluxo = 0 group by descricao";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $total       = $buscar_amigo["total"];
      $descricao   = $buscar_amigo["descricao"];

      $total_geral = $total_geral + $total;

      if($descricao == 'Financiamento'){
        $total_financiamento = $total;
      }else{
        $total_outros = $total_outros + $total;
      }

      $dados["total_outros"]        = $total_outros;
      $dados["total_geral"]        = $total_geral;

    }

 return $dados;
}
    
$where = " AND idparcelas > 0";


   
date_default_timezone_set('America/Sao_Paulo');               
$hoje = date('Y-m-d');
$hoje = date('Y-m-d',strtotime($hoje . "-1 days"));
$inicio = date('Y-m-d',strtotime($hoje . "-90 days"));

$horario_relatorio = date('d-m-Y H:i:s');

  $quadra   = $_GET["quadra"];  
  $lote     = $_GET["lote"];  

 $idvenda = busca_idvenda($quadra, $lote);
   

  $data_venda = date("d-m-Y");
$arrayData = explode("-",$data_venda);

// Imprimindo os dados:
$dia = $arrayData[0];
$mes = intval($arrayData[1]);
$ano = $arrayData[2];



date_default_timezone_set('America/Sao_Paulo');


$dia_hoje = $dia;
$ano_hoje = $ano;
 
 $hoje = getdate();

$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 0 => "Outubro", 11 => "Novembro", 12 => "Dezembro");


 $nome_mes = $meses[$mes];


$total = parcelas_financiamentos($idvenda);
$parcelas_financiamentos = $total["total"];
$valor_parcelas_calculo  = $total["valor_parcelas"];

  $total_soma = total_outros($idvenda);
  $total_sum = $total_soma["total_outros"];
  $total_contrato = $total_soma["total_geral"];

  $total_pago = total_pago($idvenda);

  $saldo_restante = $total_contrato - $total_pago;

   $total_contrato  =  number_format($total_contrato, 2, ',', '.');
   $total_pago      =  number_format($total_pago, 2, ',', '.');
   $saldo_restante  =  number_format($saldo_restante, 2, ',', '.');

 $valor_taxa = valor_taxa($idvenda, 2);


$recebe_total = calcula_saldo_devedor($valor_parcelas_calculo, $parcelas_financiamentos, $valor_taxa);

  include "../conexao.php";
            $query_amigo = "SELECT * FROM venda
                            INNER JOIN cliente ON venda.cliente_idcliente = cliente.idcliente
                            INNER JOIN lote ON venda.lote_idlote = lote.idlote
                            INNER JOIN produto ON venda.produto_idproduto = produto.idproduto 
                            INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                            INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                            WHERE idvenda = $idvenda";
                           
            $executa_query = mysqli_query ($db,$query_amigo);
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
            $empreendimento_id          = $buscar_amigo["empreendimento_cadastro_id"];
            $descricao_empreendimento   = $buscar_amigo['descricao_empreendimento'];
            $quadra                     = $buscar_amigo['quadra'];
            $lote                       = $buscar_amigo['lote'];
            $nome_cli                   = $buscar_amigo['nome_cli'];
            $data_venda                 = $buscar_amigo['data_venda'];
            $logo                       =$buscar_amigo["img_lote"];

          }


require_once("dompdf/dompdf_config.inc.php");

/* Cria a instância */
$dompdf = new DOMPDF();
 

 
      $html = "<table style='width:100%' border='0'>
    <tr>
      <td colspan='2'><img src='../img/$empreendimento_id/$logo' height='110' /></td>
      <td colspan='2' style='text-align: center'>Caldas Novas, $dia_hoje de $nome_mes de $ano_hoje</td>
    </tr>
    <tr>
      <td colspan='4' style='text-align: center; font-weight: bold;'>Extrato do Cliente</td>
    </tr>
    <tr>
      <td colspan='2'><span style='font-weight: bold'>Cliente</span>: $nome_cli</td>
      <td colspan='2'><span style='font-weight: bold'>Data do Contrato</span>: $data_venda</td>
    </tr>
    <tr>
      <td colspan='2'><span style='font-weight: bold'>Empreendimento</span>: $descricao_empreendimento</td>
      <td><span style='font-weight: bold'>Q:</span> $quadra / <span style='font-weight: bold'>L:</span> $lote</td>
      <td><span style='font-weight: bold'>Contrato:</span> $idvenda</td>
    </tr>
    <tr>
      <td colspan='2'><span style='font-weight: bold'>Valor do Contrato</span>: $total_contrato</td>
      <td><span style='font-weight: bold'>Pago:</span> $total_pago</td>
      <td><span style='font-weight: bold'>Restante</span>: $saldo_restante</td>
    </tr>
</table>";


$html .="<table style='width:100%' height='127' border='0'>

    <tr bgcolor='#b8b8b8'>
      <td style='text-align: center'><strong>Parcela</strong></td>
      <td style='text-align: center'><strong>Vencimento</strong></td>
      <td style='text-align: center'><strong>Valor</strong></td>
      <td style='text-align: center'><strong>Desc</strong></td>
      <td style='text-align: center'><strong>Acres</strong></td>
      <td style='text-align: center'><strong>Data Pagamento</strong></td>
      <td style='text-align: center'><strong>Pago</strong></td>
      <td style='text-align: center'><strong>Obs</strong></td>
    

    </tr>";


$cont_parcelas = 0;
$cont_nfin = 0;

$cont_valor_parcelas = 0;
$cont_desc = 0;
$cont_acre = 0;
$cont_pago = 0;
$cont_juros = 0;
$cont_amort = 0;

$hoje = date('Y-m-d');
  include "../conexao.php";
            $query = "SELECT parcelas.descricao, parcelas.acre_parcela, parcelas.desc_parcela, parcelas.valor_recebido, parcelas.idparcelas, parcelas.tipo_venda, parcelas.venda_idvenda, parcelas.valor_parcelas, parcelas.data_recebimento,parcelas.situacao,parcelas.cod_baixa,parcelas.cliente_id_novo, parcelas.forma_pagamento, STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') as venc 
                      FROM parcelas  
                      WHERE fluxo = 0  AND venda_idvenda=$idvenda and tipo_venda = 2 order by cliente_id_novo, venda_idvenda, venc Asc";
            $executa_query = mysqli_query ($db,$query) or die ("Erro ao listar empreendimento");
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos


              $idparcelas                 = $buscar_amigo["idparcelas"];
              $venda_idvenda              = $buscar_amigo["venda_idvenda"];
              $cliente_id_novo            = $buscar_amigo["cliente_id_novo"];            
              $valor_parcelas             = $buscar_amigo["valor_parcelas"];
              $descricao                  = $buscar_amigo["descricao"];

              $acre_parcela               = $buscar_amigo["acre_parcela"];
              $desc_parcela               = $buscar_amigo["desc_parcela"];
              $valor_recebido             = $buscar_amigo["valor_recebido"];
              $data_recebimento           = $buscar_amigo["data_recebimento"];


              $data_vencimento_tratada    = $buscar_amigo["venc"];
              $situacao                   = $buscar_amigo["situacao"];
              $tipo_venda_result          = $buscar_amigo["tipo_venda"];

              $dados_cliente  =  dados_cliente($cliente_id_novo); 


              $nome_cli           = $dados_cliente["nome_cli"];
           

              $dados_contrato  =  dados_contrato($idparcelas); 

            // contadores

              $cont_valor_parcelas = $cont_valor_parcelas + $valor_parcelas;
              $cont_acre = $cont_acre + $acre_parcela;
              $cont_desc = $cont_desc + $desc_parcela;
              $cont_pago = $cont_pago + $valor_recebido;

           // fim contadore


              $quadra = $dados_contrato["quadra"];
              $lote   = $dados_contrato["lote"];
              $numero_sequencia   = $dados_contrato["numero_sequencia"];

               $cont_parcelas = $cont_parcelas + 1;
             $exibir_valor_parcelas =  number_format($valor_parcelas, 2, '.', '');


              $parcelas_restantes = $parcelas_financiamentos - $cont_parcelas;

              $exibir_vencimento  = date("d-m-Y", strtotime($data_vencimento_tratada));

              $diferenca = strtotime($hoje) - strtotime($data_vencimento_tratada);

              $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias


              $valor_multa = (2/100);
              $valor_juros = (0.033/100);

              $multa = ($valor_parcelas * $valor_multa);
              $juros = ($valor_parcelas * $valor_juros * $dias);

              $valor_multa_juros =   $valor_parcelas + $multa + $juros;



/////////  tentando achar saldo devedor


        $pgto = $valor_parcelas;



        if($descricao != 'Financiamento'){

          if($cont_nfin == 0){

            $valor_total  = $recebe_total + $total_sum;
            $valor_desconto = $valor_total;
          }

        $juros_amort = 0;
        $valor_desconto = $valor_desconto - $pgto;
        $amort = $pgto;

        $cont_parcelas = 0;
        $cont_nfin = $cont_nfin + 1;


        }else{        

          if($cont_parcelas == 1){
            $calculo = $recebe_total;
          }else{
            $calculo = $valor_desconto;
          }
        $valor_desconto = calcula_saldo_devedor($pgto, $parcelas_restantes, $valor_taxa);

        $juros_amort = $calculo * (1/100);
      //  $valor_desconto = $valor_desconto - $pgto + $juros_amort;        
        $amort = $pgto - $juros_amort;

      }

        $cont_juros = $cont_juros + $juros_amort;
        $cont_amort = $cont_amort + $amort;

          $valor_desconto =  number_format($valor_desconto, 2, '.', '');
          $juros_amort    =  number_format($juros_amort, 2, '.', '');
          $amort          =  number_format($amort, 2, '.', '');

          $desc_parcela          =  number_format($desc_parcela, 2, '.', '');
          $acre_parcela          =  number_format($acre_parcela, 2, '.', '');
          $valor_recebido          =  number_format($valor_recebido, 2, '.', '');



             

                          
           


 $html .="<tr>
  <td style='text-align: center'>$numero_sequencia</td>
  <td style='text-align: center'>  $exibir_vencimento </td>
  <td style='text-align: center'>$exibir_valor_parcelas</td>
  <td style='text-align: center'>$desc_parcela</td>
  <td style='text-align: center'>$acre_parcela</td>
  <td style='text-align: center'>$data_recebimento</td>
  <td style='text-align: center'>$valor_recebido</td>
  <td style='text-align: center'>$obs_parcela</td>

  </tr>";

}

   $cont_valor_parcelas  =  number_format($cont_valor_parcelas, 2, ',', '.');
   $cont_acre  =  number_format($cont_acre, 2, ',', '.');
   $cont_desc  =  number_format($cont_desc, 2, ',', '.');
   $cont_pago  =  number_format($cont_pago, 2, ',', '.');
   $cont_juros  =  number_format($cont_juros, 2, ',', '.');
   $cont_amort  =  number_format($cont_amort, 2, ',', '.');


$html .="<tr bgcolor='#b8b8b8'>
      <td style='text-align: center'><strong>Total</strong></td>
      <td style='text-align: center'><strong></strong></td>
      <td style='text-align: center'><strong>$cont_valor_parcelas</strong></td>
      <td style='text-align: center'><strong>$cont_desc</strong></td>
      <td style='text-align: center'><strong>$cont_acre</strong></td>
      <td style='text-align: center'><strong> </strong></td>
      <td style='text-align: center'><strong>$cont_pago</strong></td>
  
    </tr>";

$html .="</table>";





$dompdf->load_html($html);
  $dompdf->set_paper("A4", "landscape");
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
