<?php ob_start();
error_reporting(0);
ini_set(“display_errors”, 0 );
require_once("dompdf/dompdf_config.inc.php");

  $dompdf = new DOMPDF();



function dados_empresa($cliente_id){

        include "../conexao.php";
        $query_amigo = "SELECT * FROM cliente where idcliente = $cliente_id";
        $executa_query = mysqli_query ($db, $query_amigo);
        
        while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            

$idcliente          = $buscar_amigo["idcliente"];
$nome_cli           = $buscar_amigo["nome_cli"];
$cpf_cli            = $buscar_amigo["cpf_cli"];
$rg_cli             = $buscar_amigo["rg_cli"];
$estadocivil_cli    = $buscar_amigo["estadocivil_cli"];
$nacionalidade_cli  = $buscar_amigo["nacionalidade_cli"];
$profissao_cli      = $buscar_amigo["profissao_cli"];
$nascimento_cli     = $buscar_amigo["nascimento_cli"];
$email_cli          = $buscar_amigo["email_cli"];
$cidade_cli         = $buscar_amigo["cidade_cli"];
$logradouro_cli     = $buscar_amigo["logradouro_cli"];
$endereco_cli       = $buscar_amigo["endereco_cli"];
$numero_cli         = $buscar_amigo["numero_cli"];
$complemento_cli    = $buscar_amigo["complemento_cli"];
$bairro_cli         = $buscar_amigo["bairro_cli"];
$complemento_cli    = $buscar_amigo["complemento_cli"];
$telefone1_cli      = $buscar_amigo["telefone1_cli"];
$telefone2_cli      = $buscar_amigo["telefone2_cli"];
$cep_cli            = $buscar_amigo["cep_cli"];
$estado_cli         = $buscar_amigo["estado_cli"];

}

  $dados["nome_cli"]          = $nome_cli;
  $dados["cpf_cli"]           = $cpf_cli;
  $dados["rg_cli"]            = $rg_cli;
  $dados["estadocivil_cli"]   = $estadocivil_cli;
  $dados["nacionalidade_cli"] = $nacionalidade_cli;
  $dados["profissao_cli"]     = $profissao_cli;
  $dados["nascimento_cli"]    = $nascimento_cli;
  $dados["email_cli"]         = $email_cli;
  $dados["cidade_cli"]        = $cidade_cli;
  $dados["endereco_cli"]      = $endereco_cli;
  $dados["numero_cli"]        = $numero_cli;
  $dados["bairro_cli"]        = $bairro_cli;
  $dados["telefone1_cli"]     = $telefone1_cli;
  $dados["cep_cli"]           = $cep_cli;
  $dados["estado_cli"]        = $estado_cli;

  return $dados;

}
 
function dados_parcela($parcela_id){

   include "../conexao.php";
        $query_amigo = "SELECT numero_sequencia FROM parcelas where idparcelas = $parcela_id";
        $executa_query = mysqli_query ($db, $query_amigo);
        
        while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
        
        $numero_sequencia          = $buscar_amigo["numero_sequencia"];

        }

        $dados["numero_sequencia"] = $numero_sequencia;
return $dados;
}






/* Cria a instância */

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

       $idvenda = $_GET["idvenda"];
                      include "../conexao.php";
                $query_amigo = "SELECT * FROM venda
                INNER JOIN cliente ON cliente.idcliente = venda.cliente_idcliente
                INNER JOIN lote ON lote.idlote = venda.lote_idlote
                INNER JOIN produto ON  lote.produto_idproduto = produto.idproduto
                INNER JOIN empreendimento ON  produto.empreendimento_idempreendimento = empreendimento.idempreendimento
                INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                
                where venda.idvenda = $idvenda";

                $executa_query = mysqli_query ($db, $query_amigo) or die("agora aqui");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            

$cliente_id          = $buscar_amigo["cliente_id"];
$idcliente          = $buscar_amigo["idcliente"];
$nome_cli     = $buscar_amigo["nome_cli"];
$cpf_cli      = $buscar_amigo["cpf_cli"];
$rg_cli       = $buscar_amigo["rg_cli"];
$estadocivil_cli  = $buscar_amigo["estadocivil_cli"];
$nacionalidade_cli  = $buscar_amigo["nacionalidade_cli"];
$profissao_cli    = $buscar_amigo["profissao_cli"];
$nascimento_cli   = $buscar_amigo["nascimento_cli"];
$email_cli      = $buscar_amigo["email_cli"];
$cidade_cli     = $buscar_amigo["cidade_cli"];
$logradouro_cli   = $buscar_amigo["logradouro_cli"];
$endereco_cli   = $buscar_amigo["endereco_cli"];
$numero_cli     = $buscar_amigo["numero_cli"];
$complemento_cli  = $buscar_amigo["complemento_cli"];
$bairro_cli     = $buscar_amigo["bairro_cli"];
$complemento_cli  = $buscar_amigo["complemento_cli"];
$telefone1_cli    = $buscar_amigo["telefone1_cli"];
$telefone2_cli    = $buscar_amigo["telefone2_cli"];
$cep_cli        = $buscar_amigo["cep_cli"];
$estado_cli       = $buscar_amigo["estado_cli"];
$renda_total       = $buscar_amigo["renda_total"];
$renda_total =  'R$ ' . number_format($renda_total, 2, ',', '.');  

$lote            = $buscar_amigo["lote"];
$m2              = $buscar_amigo["m2"];
$frente            = $buscar_amigo["frente"];
$fundo             = $buscar_amigo["fundo"];
$esquerda          = $buscar_amigo["esquerda"];
$direita           = $buscar_amigo["direita"];

$representada_por            = $buscar_amigo["representada_por"];
$proposta_compra             = $buscar_amigo["aditamento_contrato"];
$matricula_empreendimento    = $buscar_amigo["matricula_empreendimento"];
$img_lote                    = $buscar_amigo["img_lote"];
$idempreendimento_cadastro   = $buscar_amigo["idempreendimento_cadastro"];
$descricao_empreendimento    = $buscar_amigo["descricao_empreendimento"];
$matricula                   = $buscar_amigo["matricula"];
$cadastro_prefeitura         = $buscar_amigo["cadastro_prefeitura"];
$confrontacao                = $buscar_amigo["confrontacao"];
$quadra                      = $buscar_amigo["quadra"];
$valor                       = $buscar_amigo["valor"];
$data_venda                  = $buscar_amigo["data_venda"];
        
$valor_total_entrada3      = $buscar_amigo["valor_entrada"]; 
if($valor_total_entrada3 == ''){
  $valor_total_entrada3 = 0;
}




$valor_desconto          = $buscar_amigo["valor_desconto"];      
$valor_total_entrada4      = $buscar_amigo["entrada_restante"]; 

$parcela_entrada           = $buscar_amigo["parcela_entrada"];
$plano_pagamento           = $buscar_amigo["plano_pagamento"];
$valor_parcela_financiamento           = $buscar_amigo["valor_parcela_financiamento"];
$valor_parcela_entrada           = $buscar_amigo["valor_parcela_entrada"];

$valor_total_do_contrato = ($parcela_entrada * $valor_parcela_entrada) + ($plano_pagamento * $valor_parcela_financiamento);

$valor_total_do_contrato =  'R$ ' . number_format($valor_total_do_contrato, 2, ',', '.');  
$valor_parcela_financiamento = 'R$ ' . number_format($valor_parcela_financiamento, 2, ',', '.');

$vencimento_primeira     = $buscar_amigo["vencimento_primeira"];
$vencimento_restante     = $buscar_amigo["vencimento_restante"];
$idempreendimento          = $buscar_amigo["idempreendimento"]; 

$valor_total_entrada       = $valor_total_entrada3 + $valor_total_entrada4;

if($valor_total_entrada3 != ''){
    $data_vencimento_parcela2  = date('d-m-Y', strtotime("+".($parcela_entrada)." month", strtotime($vencimento_restante)));
}else{
       $data_vencimento_parcela2  = date('d-m-Y', strtotime("+".($parcela_entrada-1)." month", strtotime($vencimento_restante)));

           }

          $dados_empresa = dados_empresa($cliente_id);

          $nome_emp         = $dados_empresa["nome_cli"];
          $cpf_emp          = $dados_empresa["cpf_cli"];
          $rg_emp           = $dados_empresa["rg_cli"];
          $insc_municipal_emp = $dados_empresa["insc_municipal"];
          $endereco_emp     = $dados_empresa["endereco_cli"];
          $bairro_emp       = $dados_empresa["bairro_cli"];
          $cidade_emp       = $dados_empresa["cidade_cli"];
          $estado_emp       = $dados_empresa["estado_cli"];
          $email_emp        = $dados_empresa["email_cli"];

          $dados_representada = dados_empresa($representada_por);

          $nome_rep         = $dados_representada["nome_cli"];
          $cpf_rep          = $dados_representada["cpf_cli"];
          $rg_rep           = $dados_representada["rg_cli"];
          $insc_municipal_rep = $dados_representada["insc_municipal"];
          $endereco_rep     = $dados_representada["endereco_cli"];
          $bairro_rep       = $dados_representada["bairro_cli"];
          $cidade_rep       = $dados_representada["cidade_cli"];
          $estado_rep       = $dados_representada["estado_cli"];
          $email_rep        = $dados_representada["email_cli"];
          $profissao_rep    = $dados_representada["profissao_cli"];
          $nacionalidade_rep= $dados_representada["nacionalidade_cli"];
          $nascimento_rep   = $dados_representada["nascimento_cli"];
          $estadocivil_rep  = $dados_representada["estadocivil_cli"];



}


 $query_amigo_cli = "SELECT * FROM conjuge
                     INNER JOIN cliente ON conjuge.conjuge_idconjuge = cliente.idcliente
                     WHERE cliente_idcliente = $idcliente";


        
                $executa_query_cli = mysqli_query ($db,$query_amigo_cli) or die("Tem mais");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query_cli)) {//--verifica se são amigos
               
                 
                  $nome_con           = $buscar_amigo["nome_cli"];
                  $cpf_con            = $buscar_amigo["cpf_cli"];
                  $rg_con             = $buscar_amigo["rg_cli"];
                  $nacionalidade_con  = $buscar_amigo["nacionalidade_cli"];
                  $profissao_con      = $buscar_amigo["profissao_cli"];
                  $nascimento_con     = $buscar_amigo["nascimento_cli"];
               
}


 $query_rene = "SELECT * FROM venda_renegociacao
                WHERE venda_id = $idvenda order by idvenda_renegociacao desc limit 1";
        
                $executa_rene = mysqli_query ($db,$query_rene) or die("outro aqui");
                while ($buscar_rene = mysqli_fetch_assoc($executa_rene)) {//--verifica se são amigos
               
                 
                  $idvenda_renegociacao      = $buscar_rene["idvenda_renegociacao"];
                  $rene_total_parcelas       = $buscar_rene["total_parcelas"];
                  $rene_valor_parcela        = $buscar_rene["valor_parcela"];
                  $rene_vencimento_primeira  = $buscar_rene["vencimento_primeira"];
                  $rene_vencimento_restante  = $buscar_rene["vencimento_restante"];
                  $rene_entrada              = $buscar_rene["entrada"];
                  if($rene_entrada == ''){
                    $rene_entrada = 0;
                  }
                  $rene_data_contrato        = $buscar_rene["data_contrato"];

                  $total_debito = ($rene_total_parcelas * $rene_valor_parcela) + $rene_entrada;

                  $total_debito = 'R$ ' . number_format($total_debito, 2, ',', '.');

                  if($rene_entrada != ''){

                  $rene_entrada = 'R$ ' . number_format($rene_entrada, 2, ',', '.');

                }else{
                  $rene_entrada = '';
                }

                  $rene_valor_parcela = 'R$ ' . number_format($rene_valor_parcela, 2, ',', '.'); 
                }

          
 
                     



$html ="<p style='text-align: center'><img width='139' height='90' src='../../img/$idempreendimento_cadastro/$img_lote'>
<h3 align='center'><u>ADITAMENTO E RENEGOCIAÇÃO AO INSTRUMENTO PARTICULAR DE CONTRATO DE COMPROMISSO DE COMPRA E VENDA</u></h3>
<h5 align='center'>As partes abaixo qualificadas firmaram entre si  em: $data_venda  um Contrato de Compromisso de Compra e Venda de Lote no Loteamento $descricao_empreendimento</h5>
<strong>Quadro resumo  nº $idvenda</strong>
<h4 style='margin:10px !important'>1-QUALIFICAÇÃO DO(S) CONTRATANTES(S) / COMPRADORES(A)(ES)(AS):</h4>
<table border='0' style='width:100%' align='center' cellspacing='0' cellpadding='0' summary='Tabela de informações de contato'height='6'>
  <tr>
    <td height='6'>Nome: $nome_cli</td>
    <td height='6'><strong>CÔNJUGE</strong></td>
  </tr>
  <tr>
    <td height='6'>RG: $rg_cli</td>
    <td height='6'>Nome: $nome_con</td>
  </tr>
  <tr>
    <td height='6'>CPF / CNPJ: $cpf_cli</td>
    <td height='6'>RG: $rg_con</td>
  </tr>
  <tr>
    <td height='6'>Nacionalidade: $nacionalidade_cli</td>
    <td height='6'>CPF / CNPJ: $cpf_con</td>
  </tr>
  <tr>
    <td height='6'>Profissão: $profissao_cli</td>
    <td height='6'>Nacionalidade: $nacionalidade_con</td>
  </tr>
  <tr>
    <td height='6'>Data nascimento: $nascimento_cli</td>
    <td height='6'>Profissão: $profissao_con</td>
  </tr>
  <tr>
    <td height='6'>Estado Civil: $estadocivil_cli</td>
    <td height='6'>Data nascimento: $nascimento_con</td>
  </tr>

  <tr>
    <td colspan='2' height='6'>Renda: $renda_total</td>
  </tr>
  <tr>
    <td colspan='2' height='6'>Endereço de correspondência: $endereco_cli, $numero_cli</td>
  </tr>
  <tr>
    <td height='6'>Bairro: $bairro_cli</td>
    <td height='6'>UF: $estado_cli</td>
  </tr>
  <tr>
    <td height='6'>Cidade: $cidade_cli</td>
    <td height='6'>CEP: $cep_cli</td>
  </tr>
  <tr>
    <td height='6'>Fones: $telefone1_cli / $telefone2_cli</td>
    <td height='6'>E-mail: $email_cli</td>
  </tr>
</table><br>
<br>
<h4 style='margin:10px !important'>2-DESCRIÇÃO DO LOTE OBJETO DESTE CONTRATO:</h4>
<table border='0' cellspacing='0' cellpadding='0' summary='Tabela de ação de curto prazo' width='100%'>
  <tr>
    <td>Empreendimento: $descricao_empreendimento</td>
  </tr>
  <tr>
    <td>Matricula do Empreendimento: $matricula_empreendimento</td>
  </tr>
  <tr>
    <td>Quadra: $quadra</td>
  </tr>
  <tr>
    <td>Lote: $lote</td>
  </tr>
  <tr>
    <td>Metragem: $m2</td>
  </tr>
  <tr>
    <td>Cadastro Prefeitura Municipal: $cadastro_prefeitura</td>
  </tr>
  <tr>
    <td>Matricula do Lote: $matricula</td>
  </tr>
  <tr>
    <td><div align='justify'> Confrontações: $confrontacao</div></td>
  </tr>
</table><br>
<h4 style='margin:10px !important'><strong>3- VALOR E FORMA DE PAGAMENTO DA RENEGOCIAÇÃO:</strong></h4>
<p width='100%'>
  Valor total do debito: $total_debito, sendo referente as parcelas de Nº: ";
       

       include "../conexao.php";
       $query_primeira = "SELECT parcela_id FROM venda_ren_par where venda_ren_id = $idvenda_renegociacao order by idvenda_ren_par asc limit 1";
       $executa_primeira = mysqli_query ($db, $query_primeira) or die(" eu de novo");
       while ($buscar_primeira = mysqli_fetch_assoc($executa_primeira)) {
          
          $parcela_id     = $buscar_primeira["parcela_id"];
          $dados_parcela1  = dados_parcela($parcela_id);

          $numero_sequencia_primeira = $dados_parcela1["numero_sequencia"];
           
        }


        $query_ultima = "SELECT parcela_id FROM venda_ren_par where venda_ren_id = $idvenda_renegociacao order by idvenda_ren_par desc limit 1
       ";
       $executa_ultima = mysqli_query ($db, $query_ultima) or die(" eu de novo");
       while ($buscar_ultima = mysqli_fetch_assoc($executa_ultima)) {
          
          $parcela_id     = $buscar_ultima["parcela_id"];
          $dados_parcela2  = dados_parcela($parcela_id);

          $numero_sequencia_ultima = $dados_parcela2["numero_sequencia"];
           

        }

        $html .="$numero_sequencia_primeira até $numero_sequencia_ultima";

  $html .="</p>";


 if($rene_entrada != ''){
  $html .="<p>
              <div align='justify'>Entrada: $rene_entrada, Vencimento: $rene_vencimento_primeira</div>
          </p>";
}     

    $html .="<p>
             <div align='justify'>Total de Parcelas da Renegociação: $rene_total_parcelas</div>
          </p>";

    $html .="<p>
              <div align='justify'>Valor da Parcela Renegociação: $rene_valor_parcela</div>
          </p>";

if($rene_entrada != ''){
  $r_primeira = $rene_vencimento_restante;
}else{
  $r_primeira = $rene_vencimento_primeira;
}

    $html .="<p>
             <div align='justify'>Vencendo a primeira em: $r_primeira, e as demais vencendo no mesmo dia dos meses subsequentes.</div>
          </p>";





$html .="<BR><BR>
<h4 style='margin:10px !important'>4-ÍNDICE DE CORREÇÃO E PERIODICIDADE DO REAJUSTE</h4>
<table border='0' cellspacing='0' cellpadding='0' width='100%'>
  <tr>
    <td>Correção anual     pelo índice IGP-M</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table><BR><BR>";

$html .="<div align='justify'>$proposta_compra</div>";


$html .="&nbsp;<BR><BR>
<strong>       E por estarem assim justas e contratadas, assinam o presente, em duas  (02) vias.</strong>
&nbsp;
<BR><BR><BR>";

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
$html .="Franca, $dia_hoje de $nome_mes de $ano_hoje
<BR><BR><BR>

<strong>______________________________________________________________________________________<br>
  COMPRADOR </strong><strong>(A)(ES)(AS): </strong><strong>$nome_cli </strong><BR><BR><BR>



<strong>_____________________________________________________________________________________<br>
  VENDEDORA</strong><strong>(A)(ES)(AS):</strong> <strong>$nome_emp</strong><BR><BR><BR>

Testemunhas: <BR><BR><BR><BR><BR><BR>
1º) _________________________________________________________________________________<br>
  Nome:                      <br>
  CPF: <br>
  RG: <br><br><br>2º) ________________________________________________________________________________<br>
  Nome: <br>
  CPF:<br>
  RG:";




 $dompdf->load_html($html);
  $dompdf->set_paper("A4");
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
