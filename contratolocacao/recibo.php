<?php ob_start();
error_reporting(0);
ini_set(“display_errors”, 0 );

function nome_user($id){
    include "../conexao.php";
     $query_igpm = "SELECT nome_cli FROM cliente where idcliente = $id";

                $executa_igpm = mysqli_query ($db, $query_igpm);
                
                
            while ($buscar_amigoc = mysqli_fetch_assoc($executa_igpm)) {//--verifica se são amigos
           
             $nome_cli             = $buscar_amigoc['nome_cli'];
}
return $nome_cli;

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



function extenso($valor=0, $maiusculas=false) {
        // verifica se tem virgula decimal
        if (strpos($valor, ",") > 0) {
                // retira o ponto de milhar, se tiver
                $valor = str_replace(".", "", $valor);

                // troca a virgula decimal por ponto decimal
                $valor = str_replace(",", ".", $valor);
        }
        $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
        $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões",
                "quatrilhões");

        $c = array("", "cem", "duzentos", "trezentos", "quatrocentos",
                "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
        $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta",
                "sessenta", "setenta", "oitenta", "noventa");
        $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze",
                "dezesseis", "dezesete", "dezoito", "dezenove");
        $u = array("", "um", "dois", "três", "quatro", "cinco", "seis",
                "sete", "oito", "nove");

        $z = 0;

        $valor = number_format($valor, 2, ".", ".");
        $inteiro = explode(".", $valor);
        $cont = count($inteiro);
        for ($i = 0; $i < $cont; $i++)
                for ($ii = strlen($inteiro[$i]); $ii < 3; $ii++)
                $inteiro[$i] = "0" . $inteiro[$i];

        $fim = $cont - ($inteiro[$cont - 1] > 0 ? 1 : 2);
        $rt = '';
        for ($i = 0; $i < $cont; $i++) {
                $valor = $inteiro[$i];
                $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
                $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
                $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

                $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
                        $ru) ? " e " : "") . $ru;
                $t = $cont - 1 - $i;
                $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
                if ($valor == "000"

                )$z++; elseif ($z > 0)
                $z--;
                if (($t == 1) && ($z > 0) && ($inteiro[0] > 0))
                $r .= ( ($z > 1) ? " de " : "") . $plural[$t];
                if ($r)
                $rt = $rt . ((($i > 0) && ($i <= $fim) &&
                        ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
        }

        if (!$maiusculas) {
                return($rt ? $rt : "zero");
        } elseif ($maiusculas == "2") {
                return (strtoupper($rt) ? strtoupper($rt) : "Zero");
        } else {
                return (ucwords($rt) ? ucwords($rt) : "Zero");
        }
        }
?>






<?php
function dados_pagador($cliente_id){
include "../conexao.php";
    $query_amigo = "SELECT * FROM cliente
                    WHERE idcliente = '$cliente_id'";
    
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $nome_cli  = $buscar_amigo["nome_cli"];
      $cpf_cli   = $buscar_amigo["cpf_cli"];
      $rg_cli    = $buscar_amigo["rg_cli"];


      $dados["nome_cli"] = $nome_cli;
      $dados["cpf_cli"]  = $cpf_cli;
      $dados["rg_cli"]   = $rg_cli;

    }
    return $dados;
}

function tipo_insumo($idinsumo){
include "../conexao.php";
    $query_amigo = "SELECT * FROM insumo_descricao
                    where idinsumo_descricao = $idinsumo";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $descricao_insumo           = $buscar_amigo["descricao_insumo"];

    }
    return $descricao_insumo;
}

function pagamento_cheque($parcela_id){
include "../conexao.php";
    $query_amigo = "SELECT * FROM parcelas_cheque
                    where parcela_id = $parcela_id";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $v_banco           = $buscar_amigo["banco"];
      $agencia           = $buscar_amigo["agencia"];
      $conta             = $buscar_amigo["conta"];
      $numero_cheque     = $buscar_amigo["numero_cheque"];
      $data_deposito     = $buscar_amigo["data_deposito"];
      $valor_cheque      = $buscar_amigo["valor_cheque"];

      $dados["v_banco"] = $v_banco;
      $dados["agencia"] = $agencia;
      $dados["conta"] = $conta;
      $dados["numero_cheque"] = $numero_cheque;
      $dados["data_deposito"] = $data_deposito;
      $dados["valor_cheque"]  = $valor_cheque;
    }
    return $dados;
}

function tipo_locacao($venda_idvenda){
include "../conexao.php";
    $query_amigo = "SELECT * FROM locacao
                    INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel 
                    where idlocacao = $venda_idvenda";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $endereco           = $buscar_amigo["endereco"];
      $numero             = $buscar_amigo["numero"];

      $descricao = $endereco.", ".$numero;
    }
    return $descricao;
}

function tipo_venda($venda_idvenda){
include "../conexao.php";
    $query_amigo = "SELECT * FROM venda
                    INNER JOIN produto ON venda.produto_idproduto = produto.idproduto
                    INNER JOIN lote ON venda.lote_idlote = lote.idlote 
                    INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                    INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro 
                    WHERE idvenda = '$venda_idvenda'";
    
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $quadra                      = $buscar_amigo["quadra"];
      $lote                        = $buscar_amigo["lote"];
      $descricao_empreendimento    = $buscar_amigo["descricao_empreendimento"];


      $dados["quadra"] = $quadra;
      $dados["lote"] = $lote;
      $dados["descricao_empreendimento"] = $descricao_empreendimento;

    }
    return $dados;
}


function tipo_receber($venda_idvenda){
include "../conexao.php";
    $query_amigo = "SELECT * FROM contrato_receber
                    WHERE idcontrato_receber = '$venda_idvenda'";
    
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $insumo_descricao  = $buscar_amigo["insumo_descricao"];

      $descricao_insumo = tipo_insumo($insumo_descricao);

    }
    return $descricao_insumo;
}
 

        include "../conexao.php";
        $cod_baixa = $_GET["cod_baixa"];

        $query = "SELECT * FROM parcelas  
                  WHERE cod_baixa = $cod_baixa AND fluxo = 0";
                 
                  $executa_query = mysqli_query($db, $query);

                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

             
                  $forma_pagamento             = $buscar_amigo["forma_pagamento"];
               
                  $cliente_id_novo             = $buscar_amigo["cliente_id_novo"];
             

             
                  $dados_pagador = dados_pagador($cliente_id_novo);

                


                  $nome_pagador = $dados_pagador["nome_cli"];
                  $cpf_pagador  = $dados_pagador["cpf_cli"];
                  $rg_pagador   = $dados_pagador["rg_cli"];


                }

require_once("dompdf/dompdf_config.inc.php");
 
/* Cria a instância */
$dompdf = new DOMPDF();
 
 
$html = "<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>Documento sem título</title>
</head>

<body>
<p align='center'><strong><u>RECIBO DE  PAGAMENTO </u></strong><br>
  <strong>                                                                                  Nº $cod_baixa</strong></p>
<p><strong>DADOS DO PAGADOR: </strong></p>
<p><strong>NOME: </strong>$nome_pagador<strong> </strong><br>
  <strong>CPF: </strong>$cpf_pagador<br>
  <strong>RG: </strong>$rg_pagador</p>
<p><strong>DADOS DO RECEBEDOR</strong></p>
<p><strong>Nome: </strong>HR  Santos Empreendimentos e Negócios Imobiliários LTDA-ME<strong></strong><br>
  <strong>CNPJ: </strong>20.372.698/0001-83<strong></strong><br>
  <strong>CRECI: </strong>26.363-J<strong></strong><br>
  <strong>Endereço: </strong>Rua Estevão Leão Bourroul, 1.922, Centro, Franca -  SP<strong> </strong></p>
<p><strong>&nbsp;</strong></p>";

               $query = "SELECT * FROM parcelas  
                  WHERE cod_baixa = $cod_baixa AND fluxo = 0";
                 
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
                  $baixado_por                 = $buscar_amigo["baixado_por"];


                  if($tipo_venda == 1){
                    $descricao_exibir = tipo_locacao($venda_idvenda);
                  }elseif($tipo_venda == 2){
                    $descricao_exibir = tipo_venda($venda_idvenda);
                    $imprimi_empreendimento = $descricao_exibir['descricao_empreendimento'];
                    $imprimi_quadra         = $descricao_exibir['quadra'];
                    $imprimi_lote           = $descricao_exibir['lote'];
                  }else{
                    $descricao_exibir = tipo_receber($venda_idvenda);
                  }



                  if($forma_pagamento == 4){
                    $parcelas_cheque = pagamento_cheque($idparcelas);
                  }







                  $dados_pagador = dados_pagador($cliente_id_novo);

                


                  $nome_extenso = extenso($valor_recebido);
                  $nome_formapagamento = forma_pagamento($forma_pagamento);
                  $nome_baixadopor = nome_user($baixado_por);



                  $nome_pagador = $dados_pagador["nome_cli"];
                  $cpf_pagador  = $dados_pagador["cpf_cli"];
                  $rg_pagador   = $dados_pagador["rg_cli"];

                  $valor_parcelas = number_format($valor_parcelas, 2, ',', '.');
                  $valor_recebido = number_format($valor_recebido, 2, ',', '.');

                  $valor_do_cheque = $parcelas_cheque["valor_cheque"];


$html .="<p><strong>VALOR RECEBIDO: R$ $valor_recebido ($nome_extenso)</strong><br>
  <strong>Forma de Pagamento: </strong>$nome_formapagamento<br>
  <strong>Referente a parcela nº </strong>$numero_sequencia -  $descricao</p>";




if($forma_pagamento == 4){

$html .="<p><strong>(X) Cheque</strong></p>";

$html .="<table border='1' cellspacing='0' cellpadding='0' style='width:100% !important'>
  <tr>
    <td  style='width:20% !important' valign='top'><p align='center'><strong>Banco</strong></p></td>
    <td  style='width:20% !important' valign='top'><p align='center'><strong>Agencia/ Conta</strong></p></td>
    <td  style='width:20% !important' valign='top'><p align='center'><strong>Nº Cheque</strong></p></td>
    <td  style='width:20% !important' valign='top'><p align='center'><strong>Valor</strong></p></td>
    <td  style='width:20% !important' valign='top'><p align='center'><strong>CPF/CNPJ</strong></p></td>
  </tr>";
 
  $busca_cheque = "SELECT * FROM parcelas_cheque
                    where parcela_id = $parcela_id";
    $exe_cheque = mysqli_query ($db,$busca_cheque);

    while ($result_cheque = mysqli_fetch_assoc($exe_cheque))
    {
      $v_banco           = $result_cheque["banco"];
      $agencia           = $result_cheque["agencia"];
      $conta             = $result_cheque["conta"];
      $numero_cheque     = $result_cheque["numero_cheque"];
      $data_deposito     = $result_cheque["data_deposito"];
      $valor_cheque      = $result_cheque["valor_cheque"];

 $html .="<tr>
    <td  style='width:20% !important' valign='top'><p><strong>$v_banco</strong></p></td>
    <td  style='width:20% !important' valign='top' align='center'><p><strong>$agencia /$conta</strong></p></td>
    <td  style='width:20% !important' valign='top'><p><strong>$numero_cheque</strong></p></td>
    <td  style='width:20% !important' valign='top'><p><strong>$valor_cheque</strong></p></td>
    <td  style='width:20% !important' valign='top'><p><strong>$data_deposito</strong></p></td>
  </tr>
</table>";

}
}

}



if($tipo_venda == 2){
$html .="<p><strong>Empreendimento: </strong>$imprimi_empreendimento<br>
  <strong>QUADRA : </strong>$imprimi_quadra<strong> </strong><br>
  <strong>LOTE: </strong>$imprimi_lote</p>";
}



date_default_timezone_set('America/Sao_Paulo');


$dia_hoje = date('d');
$ano_hoje = date('Y');
 
 $hoje = getdate();

$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");

 $mes = $hoje["mon"];

 $nome_mes = $meses[$mes];

$html .="<p align='center'>Franca, $dia_hoje de $nome_mes  de $ano_hoje.</p>";


$nome_baixado = nome_user($baixado_por);
$html .="<p><strong>&nbsp;</strong></p>
<p><strong>Responsável pelo Recebimento: </strong></p>
<p><strong>&nbsp;</strong></p>
<p><strong>___________________________</strong><br>
  <strong>  $nome_baixado</strong></p>
</body>
</html>
";


/* Carrega seu HTML */
$dompdf->load_html($html);
 
/* Renderiza */
$dompdf->render();
 
/* Exibe */
$dompdf->stream(
    "saida.pdf", /* Nome do arquivo de saída */
    array(
        "Attachment" => false /* Para download, altere para true */
    )
);
?>
