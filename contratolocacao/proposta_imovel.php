<?php ob_start();
error_reporting(0);
ini_set(“display_errors”, 0 );
require_once("dompdf/dompdf_config.inc.php");

  $dompdf = new DOMPDF();
  
 
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

                $idimovel = $_GET["idimovel"];
                include "../conexao.php";
                $query_amigo = "SELECT * FROM imovel
                                INNER JOIN cliente ON cliente.idcliente = imovel.locador_idlocador               
                                where idimovel = $idimovel";

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
$renda_total        =  'R$ ' . number_format($renda_total, 2, ',', '.');  

$tipo               = $buscar_amigo["tipo"];
$endereco           = $buscar_amigo["endereco"];
$numero             = $buscar_amigo["numero"];
$bairro             = $buscar_amigo["bairro"];
$cidade_idcidade    = $buscar_amigo["cidade_idcidade"];
$estado             = $buscar_amigo["estado"];


 }



 $query_amigo_cli = "SELECT * FROM conjuge
                     INNER JOIN cliente ON conjuge.conjuge_idconjuge = cliente.idcliente
                     WHERE cliente_idcliente = $idcliente";


        
                $executa_query_cli = mysqli_query ($db,$query_amigo_cli);
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query_cli)) {//--verifica se são amigos
               
                 
                  $nome_con           = $buscar_amigo["nome_cli"];
                  $cpf_con            = $buscar_amigo["cpf_cli"];
                  $rg_con             = $buscar_amigo["rg_cli"];
                  $nacionalidade_con  = $buscar_amigo["nacionalidade_cli"];
                  $profissao_con      = $buscar_amigo["profissao_cli"];
                  $nascimento_con     = $buscar_amigo["nascimento_cli"];
               
}

 
                     



$html ="<p style='text-align: center'><img height='50' src='../fotos/hr.png'>
<h3 align='center'><u>PROPOSTA DE COMPROMISSO DE COMPRA E VENDA</u></h3>
<strong>Quadro resumo  nº $idvenda</strong>
<h4 style='margin:10px !important'>1-QUALIFICAÇÃO DO(S) PROPONENTE(S):</h4>
<table border='0' style='width:100%; margin:0 !important' align='center' cellspacing='0' cellpadding='0' summary='Tabela de informações de contato'>
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
    <td colspan='2' height='6'>Endereço: $endereco_cli, $numero_cli</td>
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
<h4 style='margin:10px !important'>2-DESCRIÇÃO DO OBJETO DESTA PROPOSTA:</h4>
<table border='0' cellspacing='0' cellpadding='0' summary='Tabela de ação de curto prazo' width='100%'>
  <tr>
    <td>Imóvel Referência: $idimovel</td>
  </tr>
  <tr>
    <td>Tipo: $tipo</td>
  </tr>
  <tr>
    <td>Ficha do Imóvel: </td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td>Endereço: $endereco ,$numero - $cidade_idcidade / $estado_cli </td>
  </tr>
  <tr>
    <td>Matricula:</td>
  </tr>
  <tr>
    <td>Cadastro Prefeitura Municipal: </td>
  </tr>
  
</table><br>
<h4 style='margin:10px !important'><strong>3-PREÇO E FORMA DE PAGAMENTO:</strong></h4>
<table border='0' cellspacing='0' cellpadding='0' summary='Tabela de metas de longo prazo' width='100%'>
  <tr>
    <td>Valor proposto: </td>
  </tr>
   <tr>
    <td>A vista(&nbsp;)&nbsp;&nbsp; Parcelado (&nbsp; ) &nbsp;&nbsp;Financiamento (&nbsp; ) &nbsp;&nbsp;Agente Financeiro (&nbsp; ) </td>
  </tr>
   <tr>
    <td>Entrada/Sinal:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)  <span style='text-align:right'>,no ato da assinatura do contrato</span></td>
  </tr>
   <tr>
    <td>Saldo Restante em:                  ,a ser pago no dia &nbsp;&nbsp;__/__/____  </td>
  </tr>";

  

$html .="</table><br>
<h4 style='margin:10px !important'>4- CONDIÇÕES GERAIS</h4>
<BR>";

$html .="<div align='justify'>4.1 Por este instrumento particular, a pessoa qualificada na clausula 1º resolve, por livre e espontânea vontade, propor ao corretor de imoveis, a compra do imovel descrito na clausula 2º pelo preço e condições de pagamento aqui estabelecidos na clausula 3º com validade de 07 dias, contados da data de assinatura desta proposta;<BR><BR>

4.2 O PROPONENTE (S) fica ciente que esta proposta passará por análise e só terá validade após aprovação do(s) VENDEDOR(ES) após aceita torna-se-á um contrato preliminar;<BR><BR>

4.3 Declaro-me (nos) estar inteiramente ciente (s) do conhecimento do perfil deste imóvel, que lhe foram colocados à disposição pelo(s) VENDEDOR(ES), tendo percorrido pessoalmente, ou por intermédio de seu representante ou prepostos, suas divisas, achando-as conforme as especificações constantes neste instrumento;<BR><BR>

4.4 Os pagamentos ora convencionados sujeitam-se à prévia apresentação de todas as certidões obrigatórias e/ou facultativas como: Certidão de Propriedade; Certidão de Ações Cíveis Fiscais e Penais da Justiça Estadual e Federal; Inexistência de Reclamações e/ou Débitos Trabalhistas; Negativa de Protestos; Certidão Negativa de Débito da Receita Federal, Prefeitura e outras.<BR><BR>

4.5 A presente proposta é feita em caráter irrevogável e irretratável, obrigando-se as partes por si, seus herdeiros e/ou sucessores, ao fiel cumprimento de todas as suas cláusulas e condições.<BR><BR>
</div>";


$html .="&nbsp;<BR><BR>
<strong>       E por estarem assim justas e contratadas, assinam o presente, em duas  (01) via.</strong>
&nbsp;
<BR><BR><BR>";


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
$html .="Franca, ______ de ________________ de ______ 
<BR><BR><BR><BR><BR>

<strong>______________________________________________________________________________________<br>
  PROPONENTE </strong><strong>(ES): </strong><strong>$nome_cli </strong><BR><BR><BR><BR><BR>



<strong>_____________________________________________________________________________________<br>
  Corretor:</strong><br><br><br><br><br>

Testemunhas: <BR><BR><BR><BR><BR><BR>
1º) _________________________________________________________________________________<br>
  Nome:                      <br>
  CPF: <br>
  RG: <br><br><br>2º) ________________________________________________________________________________<br>
  Nome: <br>
  CPF:<br>
  RG: 
<br><br><br><br><br><br>

<h4 style='margin:10px !important; text-align:center !important'>ACEITE DA PROPOSTA</h4>
<strong>_____________________________________________________________________________________</strong><br><br><br><br>

<h4 style='margin:10px !important'>5- ACEITE DO(S) PROPRIETÁRIO(S)/VENDEDOR(ES):</h4>

";

$html .="<div align='justify'>5.1 O(s) proprietário(s)/vendedor(es) aceita(m) a proposta conforme formulada e aguarda(m) o proponente para assinatura do contrato definitivo conforme o prazo estabelecido no item 1º da Cláusula 4º  da presente contrato preliminar;<BR><BR><BR><BR>

Franca, ______ de ________________ de ______  <br><br><BR><BR><BR><BR>
</div>";



$html .="<strong>______________________________________________________________________________________<br>
  Proprietário: </strong><BR><BR><BR><BR><BR>



<strong>_____________________________________________________________________________________<br>
  Cônjuge:</strong><br><br><br><br><br>

Testemunhas: <BR><BR><BR><BR><BR><BR>
1º) _________________________________________________________________________________<br>
  Nome:                      <br>
  CPF: <br>
  RG: <br><br><br>2º) ________________________________________________________________________________<br>
  Nome: <br>
  CPF:<br>
  RG: 
<br><br><br><br><br>";

$dompdf->load_html($html);
  $dompdf->set_paper("A4");
  $pdf = $dompdf->render();
  $canvas = $dompdf->get_canvas(); 
  $font = Font_Metrics::get_font("helvetica", "bold"); 
  $canvas->page_text(510, 18, "", $font, 6, array(0,0,0)); //header
  $canvas->page_text(270, 810, "Pág. {PAGE_NUM}/{PAGE_COUNT}", $font, 6, array(0,0,0)); //footer
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
