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
$renda_total        = $buscar_amigo["renda_total"];

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
  $dados["telefone2_cli"]     = $telefone2_cli;
  $dados["cep_cli"]           = $cep_cli;
  $dados["estado_cli"]        = $estado_cli;
  $dados["renda_total"]       = $renda_total;

  return $dados;

}
 
function dados_parcela($parcela_id){

   include "../conexao.php";
        $query_amigo = "SELECT numero_sequencia FROM parcelas where idparcelas = $parcela_id";
        $executa_query = mysqli_query ($db, $query_amigo);
        
        while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
        
        $numero_sequencia          = $buscar_amigo["numero_sequencia"];

        }
return $numero_sequencia;
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
                $query_amigo = "SELECT venda.data_venda, cessao.vencimento_primeira, idcessao, antigo_titular, novo_titular, valor_cessao, total_cessao, data_cessao, cessao.feito_por, lote, m2, frente, fundo, direita, esquerda, cessao, cessao_quitado,matricula_empreendimento, img_lote, idempreendimento_cadastro, descricao_empreendimento, matricula, cadastro_prefeitura, confrontacao, quadra, representada_por, cliente_id FROM cessao
                INNER JOIN venda ON cessao.venda_id = venda.idvenda
                INNER JOIN lote ON lote.idlote = venda.lote_idlote
                INNER JOIN produto ON  lote.produto_idproduto = produto.idproduto
                INNER JOIN empreendimento ON  produto.empreendimento_idempreendimento = empreendimento.idempreendimento
                INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                
                where venda.idvenda = $idvenda";

                $executa_query = mysqli_query ($db, $query_amigo);
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            

$data_venda           = $buscar_amigo["data_venda"];
$idcessao             = $buscar_amigo["idcessao"];
$antigo_titular       = $buscar_amigo["antigo_titular"];
$novo_titular         = $buscar_amigo["novo_titular"];
$valor_cessao         = $buscar_amigo["valor_cessao"];
$valor_cessao =  'R$ ' . number_format($valor_cessao, 2, ',', '.');  

$total_cessao          = $buscar_amigo["total_cessao"];
$total_cessao_extenso = extenso($total_cessao, 0);
$total_cessao =  'R$ ' . number_format($total_cessao, 2, ',', '.');  

$vencimento_primeira   = $buscar_amigo["vencimento_primeira"];

$data_cessao          = $buscar_amigo["data_cessao"];
$feito_por            = $buscar_amigo["feito_por"];


$lote              = $buscar_amigo["lote"];
$m2                = $buscar_amigo["m2"];
$frente            = $buscar_amigo["frente"];
$fundo             = $buscar_amigo["fundo"];
$esquerda          = $buscar_amigo["esquerda"];
$direita           = $buscar_amigo["direita"];

$proposta_compra             = $buscar_amigo["cessao"];
$proposta_compra2            = $buscar_amigo["cessao_quitado"];
$matricula_empreendimento    = $buscar_amigo["matricula_empreendimento"];
$img_lote                    = $buscar_amigo["img_lote"];
$idempreendimento_cadastro   = $buscar_amigo["idempreendimento_cadastro"];
$descricao_empreendimento    = $buscar_amigo["descricao_empreendimento"];
$matricula                   = $buscar_amigo["matricula"];
$cadastro_prefeitura         = $buscar_amigo["cadastro_prefeitura"];
$confrontacao                = $buscar_amigo["confrontacao"];
$quadra                      = $buscar_amigo["quadra"];

$representada_por            = $buscar_amigo["representada_por"];
$cliente_id                  = $buscar_amigo["cliente_id"];
}

          $dados_antigo = dados_empresa($antigo_titular);

          $nome_cli           = $dados_antigo["nome_cli"];
          $cpf_cli            = $dados_antigo["cpf_cli"];
          $rg_cli             = $dados_antigo["rg_cli"];
          $nacionalidade_cli  = $dados_antigo["nacionalidade_cli"];
          $profissao_cli      = $dados_antigo["profissao_cli"];
          $estadocivil_cli    = $dados_antigo["estadocivil_cli"];
          $insc_municipal_cli = $dados_antigo["insc_municipal"];
          $endereco_cli       = $dados_antigo["endereco_cli"];
          $bairro_cli         = $dados_antigo["bairro_cli"];
          $cidade_cli         = $dados_antigo["cidade_cli"];
          $estado_cli         = $dados_antigo["estado_cli"];
          $email_cli          = $dados_antigo["email_cli"];
          $cep_cli            = $dados_antigo["cep_cli"];
          $telefone1_cli      = $dados_antigo["telefone1_cli"];
          $telefone2_cli      = $dados_antigo["telefone2_cli"];
          $renda_total_cli    = $dados_antigo["renda_total"];
          $numero_cli         = $dados_antigo["numero_cli"];
          $nascimento_cli     = $dados_antigo["nascimento_cli"];

$renda_total_cli =  'R$ ' . number_format($renda_total_cli, 2, ',', '.');  



          $dados_novo = dados_empresa($novo_titular);

          $nome_nov           = $dados_novo["nome_cli"];
          $cpf_nov            = $dados_novo["cpf_cli"];
          $rg_nov             = $dados_novo["rg_cli"];
          $nacionalidade_nov  = $dados_novo["nacionalidade_cli"];
          $profissao_nov      = $dados_novo["profissao_cli"];
          $estadocivil_nov    = $dados_novo["estadocivil_cli"];
          $insc_municipal_nov = $dados_novo["insc_municipal"];
          $endereco_nov       = $dados_novo["endereco_cli"];
          $bairro_nov         = $dados_novo["bairro_cli"];
          $cidade_nov         = $dados_novo["cidade_cli"];
          $estado_nov         = $dados_novo["estado_cli"];
          $email_nov          = $dados_novo["email_cli"];
          $cep_nov            = $dados_novo["cep_cli"];
          $telefone1_nov      = $dados_novo["telefone1_cli"];
          $telefone2_nov      = $dados_novo["telefone2_cli"];
          $renda_total_nov    = $dados_novo["renda_total"];
          $numero_nov         = $dados_novo["numero_cli"];
          $nascimento_nov     = $dados_novo["nascimento_cli"];
  $renda_total_nov =  'R$ ' . number_format($renda_total_nov, 2, ',', '.');  


          $dados_emp = dados_empresa($cliente_id);

          $nome_emp          = $dados_emp["nome_cli"];
          $cpf_emp           = $dados_emp["cpf_cli"];
          $rg_emp            = $dados_emp["rg_cli"];
          $nacionalidade_emp = $dados_emp["nacionalidade_cli"];
          $profissao_emp     = $dados_emp["profissao_cli"];
          $estadocivil_emp   = $dados_emp["estadocivil_cli"];
          $insc_municipal_emp = $dados_emp["insc_municipal"];
          $endereco_emp      = $dados_emp["endereco_cli"];
          $bairro_emp        = $dados_emp["bairro_cli"];
          $cidade_emp        = $dados_emp["cidade_cli"];
          $estado_emp        = $dados_emp["estado_cli"];
          $email_emp         = $dados_emp["email_cli"];

          $dados_rep = dados_empresa($representada_por);

          $nome_rep          = $dados_rep["nome_cli"];
          $cpf_rep           = $dados_rep["cpf_cli"];
          $rg_rep            = $dados_rep["rg_cli"];
          $nacionalidade_rep = $dados_rep["nacionalidade_cli"];
          $profissao_rep     = $dados_rep["profissao_cli"];
          $estadocivil_rep   = $dados_rep["estadocivil_cli"];
          $insc_municipal_rep = $dados_rep["insc_municipal"];
          $endereco_rep      = $dados_rep["endereco_cli"];
          $bairro_rep        = $dados_rep["bairro_cli"];
          $cidade_rep        = $dados_rep["cidade_cli"];
          $estado_rep        = $dados_rep["estado_cli"];
          $email_rep         = $dados_rep["email_cli"];

         

 $query_amigo_cli = "SELECT * FROM conjuge
                     INNER JOIN cliente ON conjuge.conjuge_idconjuge = cliente.idcliente
                     WHERE cliente_idcliente = $antigo_titular";


        
                $executa_query_cli = mysqli_query ($db,$query_amigo_cli);
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query_cli)) {//--verifica se são amigos
               
                 
                  $nome_con           = $buscar_amigo["nome_cli"];
                  $cpf_con            = $buscar_amigo["cpf_cli"];
                  $rg_con             = $buscar_amigo["rg_cli"];
                  $nacionalidade_con  = $buscar_amigo["nacionalidade_cli"];
                  $profissao_con      = $buscar_amigo["profissao_cli"];
                  $nascimento_con     = $buscar_amigo["nascimento_cli"];
               
}

 $query_amigo_cli2 = "SELECT * FROM conjuge
                     INNER JOIN cliente ON conjuge.conjuge_idconjuge = cliente.idcliente
                     WHERE cliente_idcliente = $novo_titular";


        
                $executa_query_cli2 = mysqli_query ($db,$query_amigo_cli2);
                
                
            while ($buscar_amigo2 = mysqli_fetch_assoc($executa_query_cli2)) {//--verifica se são amigos
               
                 
                  $nome_con2           = $buscar_amigo2["nome_cli"];
                  $cpf_con2            = $buscar_amigo2["cpf_cli"];
                  $rg_con2             = $buscar_amigo2["rg_cli"];
                  $nacionalidade_con2  = $buscar_amigo2["nacionalidade_cli"];
                  $profissao_con2      = $buscar_amigo2["profissao_cli"];
                  $nascimento_con2     = $buscar_amigo2["nascimento_cli"];
               
}

            $query_ven = "SELECT data_vencimento_parcela FROM parcelas
                      WHERE tipo_venda = '2' AND venda_idvenda = $idvenda and fluxo = 0 and situacao = 'Em Aberto' group by descricao order by idparcelas ASC";        
                $exe_ven = mysqli_query ($db,$query_ven);                
                
                while ($buscar_ven = mysqli_fetch_assoc($exe_ven)) {//--verifica se são amigos
                                  
                      $r_primeira           = $buscar_ven["data_vencimento_parcela"];
                }  
                                

        


              
            
 

$html ="<p style='text-align: center'><img width='139' height='90' src='../../img/$idempreendimento_cadastro/$img_lote'>
<h4 align='center'><u>INSTRUMENTO PARTICULAR DE CESSÃO E TRANSFERÊNCIA DE DIREITOS E OBRIGAÇÕES DO CONTRATO PARTICULAR DE COMPROMISSO DE COMPRA E VENDA DE LOTE</u></h4>

<strong>Quadro resumo  nº $idvenda</strong>
<h4 style='margin:10px !important'>1-QUALIFICAÇÃO DO(S) CEDENTE(ES):</h4>
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
    <td colspan='2' height='6'>Renda: $renda_total_cli</td>
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

<h4 style='margin:10px !important'>2-QUALIFICAÇÃO DO(S) CESSIONÁRIO(OS):</h4>
<table border='0' style='width:100%' align='center' cellspacing='0' cellpadding='0' summary='Tabela de informações de contato'height='6'>
  <tr>
    <td height='6'>Nome: $nome_nov</td>
    <td height='6'><strong>CÔNJUGE</strong></td>
  </tr>
  <tr>
    <td height='6'>RG: $rg_nov</td>
    <td height='6'>Nome: $nome_con2</td>
  </tr>
  <tr>
    <td height='6'>CPF / CNPJ: $cpf_nov</td>
    <td height='6'>RG: $rg_con2</td>
  </tr>
  <tr>
    <td height='6'>Nacionalidade: $nacionalidade_nov</td>
    <td height='6'>CPF / CNPJ: $cpf_con2</td>
  </tr>
  <tr>
    <td height='6'>Profissão: $profissao_nov</td>
    <td height='6'>Nacionalidade: $nacionalidade_con2</td>
  </tr>
  <tr>
    <td height='6'>Data nascimento: $nascimento_nov</td>
    <td height='6'>Profissão: $profissao_con2</td>
  </tr>
  <tr>
    <td height='6'>Estado Civil: $estadocivil_nov</td>
    <td height='6'>Data nascimento: $nascimento_con2</td>
  </tr>

  <tr>
    <td colspan='2' height='6'>Renda: $renda_total_nov</td>
  </tr>
  <tr>
    <td colspan='2' height='6'>Endereço: $endereco_nov, $numero_nov</td>
  </tr>
  <tr>
    <td height='6'>Bairro: $bairro_nov</td>
    <td height='6'>UF: $estado_nov</td>
  </tr>
  <tr>
    <td height='6'>Cidade: $cidade_nov</td>
    <td height='6'>CEP: $cep_nov</td>
  </tr>
  <tr>
    <td height='6'>Fones: $telefone1_nov / $telefone2_nov</td>
    <td height='6'>E-mail: $email_nov</td>
  </tr>
</table><br>
<h4 style='margin:10px !important'>3-DESCRIÇÃO DO LOTE OBJETO DA CESSÃO:</h4>
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
<h4 style='margin:10px !important'><strong>4- VALOR E FORMA DE PAGAMENTO:</strong></h4>
<table border='0' cellspacing='0' cellpadding='0' summary='Tabela de metas de longo prazo' width='100%'>";


if($total_cessao != 'R$ 0,00'){


  $html .="<tr>
    <td><strong>4.1</strong> Saldo do preço ajustado no contrato de origem: $total_cessao ($total_cessao_extenso)</td>
  </tr><tr>
              <td><div align='justify'><strong>4.2</strong>";
       $cont_cessao = 0;
        $query_total_vencer = "SELECT * FROM cessao_parcelas
                               WHERE cessao_id = $idcessao";        
                $executa_total_vencer = mysqli_query ($db,$query_total_vencer);                
                
                while ($buscar_quant = mysqli_fetch_assoc($executa_total_vencer)) {//--verifica se são amigos
                                  
                      $quantidade           = $buscar_quant["qtd_parcelas"];
                      $total                = $buscar_quant["subtotal"];
                      $descricao            = $buscar_quant["descricao_parcela"];
                      $valor_parcelas       = $buscar_quant["valor_parcela_cessao"];

                      $quantidade_extenso = extenso($quantidade,0);
                      $quantidade_extenso = str_replace("reais", "", $quantidade_extenso);
                      $valor_parcelas_extenso = extenso($valor_parcelas, 0);

                      $cont_cessao = $cont_cessao + $total;


                      $total =  'R$ ' . number_format($total, 2, ',', '.');  
                      
                      $valor_parcelas =  'R$ ' . number_format($valor_parcelas, 2, ',', '.');  



                


  $html .=" $quantidade ($quantidade_extenso) parcela(s) no valor de $valor_parcelas ($valor_parcelas_extenso) referente a $descricao ";
  
}  






    $html .="</div></td>
          </tr><tr>
              <td><div align='justify'>Vencendo a primeira em: $vencimento_primeira, e as demais vencendo no mesmo dia dos meses subsequentes.</div></td>
          </tr>";


}else{
  $html .="<tr><td> Valor e preço da cessão: $valor_cessao, sendo pago neste ato ao CEDENTE(S)<td></tr>";
}


$html .="</table><BR>";
if($total_cessao != 'R$ 0,00'){

$html .="<div align='justify'>$proposta_compra</div>";
}else{
  $html .="<div align='justify'>$proposta_compra2</div>";

}

$html .="&nbsp;<BR>
<strong>       E por estarem assim justas e contratadas, assinam o presente, em três  (03) vias.</strong>
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
$html .="Franca, $dia_hoje de $nome_mes de $ano_hoje
<BR><BR><BR>

<strong>______________________________________________________________________________________<br>
  CEDENTE </strong><strong>(ES): </strong><strong>$nome_cli </strong><BR><BR><BR>";

if($nome_con != ''){
$html .="<strong>______________________________________________________________________________________<br>
  CONJUGE </strong><strong>: </strong><strong>$nome_con </strong><BR><BR><BR>";
}

$html .="<strong>_____________________________________________________________________________________<br>
  INTERVENIENTE ANUENTE</strong><strong>(ES):</strong> <strong>$nome_emp</strong><BR><BR><BR>";


$html .="<strong>______________________________________________________________________________________<br>
  CESSIONÁRIO </strong><strong>(OS): </strong><strong>$nome_nov </strong><BR><BR><BR>";
if($nome_con2 != ''){

  $html .="<strong>______________________________________________________________________________________<br>
  CONJUGE </strong><strong>: </strong><strong>$nome_con2 </strong><BR><BR><BR>";
}
 $html .="Testemunhas: <BR><BR><BR><BR><BR><BR>
1º) _________________________________________________________________________________<br>
  Nome:                      <br>
  CPF: <br>
  RG: <br><br><br>2º) ________________________________________________________________________________<br>
  Nome: <br>
  CPF:<br>
  RG: 


";

$dompdf->load_html($html);
  $dompdf->set_paper("A4");
  $pdf = $dompdf->render();
  $canvas = $dompdf->get_canvas(); 
  $font = Font_Metrics::get_font("helvetica", "bold"); 
  $canvas->page_text(510, 18, "", $font, 6, array(0,0,0)); //header
  $canvas->page_text(270, 792, "Pág. {PAGE_NUM}/{PAGE_COUNT}", $font, 6, array(0,0,0)); //footer
  header("Content-type: application/pdf");     
/* Carrega seu HTML */
 
/* Renderiza */
 
/* Exibe */
$dompdf->stream(
    "saida.pdf", /* Nome do arquivo de saída */
    array(
        "Attachment" => false /* Para download, altere para true */
    )
);




?>
