<?php ob_start();
 error_reporting(0);
ini_set(“display_errors”, 0 );
require_once("dompdf/dompdf_config.inc.php");
 
/* Cria a instância */
$dompdf = new DOMPDF();
 
                           

           $idimovel = $_GET["idimovel"];
             
                                  

                      include "../conexao.php";

            
 $query_amigo = "SELECT * FROM locacao
                 INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel
                 INNER JOIN cliente ON imovel.locador_idlocador = cliente.idcliente
                 WHERE idimovel = $idimovel";


        
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
               
                  $idlocador          = $buscar_amigo["idcliente"];
                  $nome_loc           = $buscar_amigo["nome_cli"];
                  $cpf_loc            = $buscar_amigo["cpf_cli"];
                  $rg_loc             = $buscar_amigo["rg_cli"];
                  $estadocivil_loc    = $buscar_amigo["estadocivil_cli"];
                  $nacionalidade_loc  = $buscar_amigo["nacionalidade_cli"];
                  $profissao_loc      = $buscar_amigo["profissao_cli"];
                  $nascimento_loc     = $buscar_amigo["nascimento_cli"];
                  $email_loc          = $buscar_amigo["email_cli"];
                  $cidade_loc         = $buscar_amigo["cidade_cli"];
                  $logradouro_loc     = $buscar_amigo["logradouro_cli"];
                  $endereco_loc       = $buscar_amigo["endereco_cli"];
                  $numero_loc         = $buscar_amigo["numero_cli"];
                  $complemento_loc    = $buscar_amigo["complemento_cli"];
                  $bairro_loc         = $buscar_amigo["bairro_cli"];
                  $complemento_loc    = $buscar_amigo["complemento_cli"];
                  $telefone1_loc      = $buscar_amigo["telefone1_cli"];
                  $telefone2_loc      = $buscar_amigo["telefone2_cli"];

                  $cep_loc            = $buscar_amigo["cep_cli"];
                  $estado_loc         = $buscar_amigo["estado_cli"];

          
                  $iptu                = $buscar_amigo["iptu"];
                  $vencimento_iptu     = $buscar_amigo["vencimento_iptu"];
                  $valor_aluguel       = $buscar_amigo["valor_aluguel"];
                  $prazo_contrato      = $buscar_amigo["prazo_contrato"];
                  $primeira_parcela    = $buscar_amigo["primeira_parcela"];

                  $terreno            = $buscar_amigo["terreno"];
                  $area_construida    = $buscar_amigo["area_construida"];
                  $endereco           = $buscar_amigo["endereco"];
                  $numero             = $buscar_amigo["numero"];
                  $cidade             = $buscar_amigo["cidade_idcidade"];
                  $estado             = $buscar_amigo["estado"];
                  $matricula          = $buscar_amigo["matricula"];

               if($terreno == '')
                  {
                    $terreno = ' ';
                  }

                   if($area_construida == '')
                  {
                    $area_construida = ' ';
                  }


              
          //////////////  Fim loc










          ////////////////////////////////////////// imovel       
                  $idlocacao        = $buscar_amigo["idlocacao"];                
                  $ref              = $buscar_amigo["ref"];
                  $data_cadastro    = $buscar_amigo["data_venda"];
                  $tipo             = $buscar_amigo["tipo"];
                  $finalidade       = $buscar_amigo["finalidade"];
                  $bairro           = $buscar_amigo["bairro"];
                  $img_principal    = $buscar_amigo["img_principal"];
 
            
             }






            $query_amigo_con = "SELECT * FROM conjuge
                                INNER JOIN cliente ON conjuge.conjuge_idconjuge = cliente.idcliente
                                WHERE cliente_idcliente = $idlocador";


        
                $executa_query_con = mysqli_query ($db,$query_amigo_con) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query_con)) {//--verifica se são amigos
               
                 
                  $nome_con_loc           = $buscar_amigo["nome_cli"];
                  $cpf_con_loc            = $buscar_amigo["cpf_cli"];
                  $rg_con_loc             = $buscar_amigo["rg_cli"];
                  $nacionalidade_con_loc  = $buscar_amigo["nacionalidade_cli"];
                  $profissao_con_loc      = $buscar_amigo["profissao_cli"];
                  $nascimento_con_loc     = $buscar_amigo["nascimento_cli"];
               
}












//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$query_amigo_dif = "SELECT * FROM locacao
                 INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel
                 INNER JOIN cliente ON locacao.cliente_idcliente = cliente.idcliente
                 WHERE idimovel = $idimovel";


        
                $executa_query_dif = mysqli_query ($db,$query_amigo_dif) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query_dif)) {//--verifica se são amigos


                  $idcliente          = $buscar_amigo["cliente_idcliente"];
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

  $query_amigo_cli = "SELECT * FROM conjuge
                                INNER JOIN cliente ON conjuge.conjuge_idconjuge = cliente.idcliente
                                WHERE cliente_idcliente = $idcliente";


        
                $executa_query_cli = mysqli_query ($db,$query_amigo_cli) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query_cli)) {//--verifica se são amigos
               
                 
                  $nome_con           = $buscar_amigo["nome_cli"];
                  $cpf_con            = $buscar_amigo["cpf_cli"];
                  $rg_con             = $buscar_amigo["rg_cli"];
                  $nacionalidade_con  = $buscar_amigo["nacionalidade_cli"];
                  $profissao_con      = $buscar_amigo["profissao_cli"];
                  $nascimento_con     = $buscar_amigo["nascimento_cli"];
               
}







    if($nome_con == '')
                  {
                    $nome_con = ' ';
                  }
                  
                  if($cpf_con == '')
                  {
                    $cpf_con = ' ';
                  }
                  
                  if($rg_con == '')
                  {
                    $rg_con = ' ';
                  }

                  if($profissao_con == '')
                  {
                    $profissao_con = ' ';
                  }
                  
                  if($nascionalidade_con == '')
                  {
                    $nascionalidade_con = ' ';
                  }
                  
                  if($nascimento_con == '')
                  {
                    $nascimento_con = ' ';
                  }

                  ///////////////////// loc

                  if($nome_con_loc == '')
                  {
                    $nome_con_loc = ' ';
                  }
                  
                  if($cpf_con_loc == '')
                  {
                    $cpf_con_loc = ' ';
                  }
                  
                  if($rg_con_loc == '')
                  {
                    $rg_con_loc = ' ';
                  }

                  if($profissao_con_loc == '')
                  {
                    $profissao_con_loc = ' ';
                  }
                  
                  if($nascionalidade_con_loc == '')
                  {
                    $nascionalidade_con_loc = ' ';
                  }
                  
                  if($nascimento_con_loc == '')
                  {
                    $nascimento_con_loc = ' ';
                  }






$html = "<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>Contrato de Locação</title>

</head>

<body style='font-size:10px'>
<p align='center'><a name='_Hlk489452892'><strong><u><h2>CONTRATO DE  LOCAÇÃO</h2></u></strong></a></p>
<h2> Locatário(a): </h2>
<table border='1' cellspacing='0' cellpadding='0' align='center' width='500'>
  <tr>
    <td width='250' valign='top' style='padding-left:5px'><p>NOME: $nome_cli  <br>
      RG: $rg_cli <br>
      CPF / CNPJ: $cpf_cli <br>
      Nacionalidade: $nacionalidade_cli <br>
      Profissão: $profissao_cli<br>
      Nascimento: $nascimento_cli<br>
      Estado Civil: $estadocivil_cli<br>
      </p></td>
    <td width='250' valign='top' style='padding-left:5px'><p> CÔNJUGE: <br>
      NOME:  $nome_con<br>
      RG: $rg_con<br>
      CPF: $cpf_con<br>
      Nacionalidade: $nascionalidade_con<br>
      Profissão:    $profissao_con </p></td>
  </tr>
</table><br>
<h2> Locador(a): </h2>
<table border='1' cellspacing='0' cellpadding='0' align='center' width='500'>
  <tr>
    <td width='250' valign='top' style='padding-left:5px'><p>NOME: $nome_loc <br>
      RG: $rg_loc <br>
      CPF / CNPJ: $cpf_loc <br>
      Nacionalidade: $nacionalidade_loc <br>
      Profissão: $profissao_loc <br>
      Nascimento: $nascimento_loc<br>
      Estado Civil: $estadocivil_loc<br>
      </p></td>
    <td width='250' valign='top' style='padding-left:5px'><p>CÔNJUGE: <br>
      NOME:  $nome_con_loc<br>
      RG:    $rg_con_loc<br>
      CPF:    $cpf_con_loc<br>
      Nacionalidade: $nascionalidade_con_loc<br>
      Profissão: $profissao_con_loc</p></td>
  </tr>
</table><br>";
              include '../conexao.php';
              $query_fiador1 = 'SELECT * FROM fiador
                                INNER JOIN cliente ON fiador.fiador_idfiador = cliente.idcliente
                                WHERE locacao_idlocacao ='.$idlocacao;
             
              
              $fiador1_query = mysqli_query ($db, $query_fiador1) or die ('Erro ao listar fiador');

                $cont = 1;
       
            while ($buscar_amigo = mysqli_fetch_assoc($fiador1_query)) {//--verifica se são amigos
                  $idfiador           = $buscar_amigo["idcliente"];
                  $nome_fia           = $buscar_amigo['nome_cli'];
                  $cpf_fia            = $buscar_amigo['cpf_cli'];
                  $rg_fia             = $buscar_amigo['rg_cli'];
                  $estadocivil_fia    = $buscar_amigo['estadocivil_cli'];
                  $nacionalidade_fia  = $buscar_amigo['nacionalidade_cli'];
                  $profissao_fia      = $buscar_amigo['profissao_cli'];
                  $nascimento_fia     = $buscar_amigo['nascimento_cli'];
                  $email_fia          = $buscar_amigo['email_cli'];
                  $cidade_fia         = $buscar_amigo['cidade_cli'];
                  $logradouro_fia     = $buscar_amigo['logradouro_cli'];
                  $endereco_fia       = $buscar_amigo['endereco_cli'];
                  $numero_fia         = $buscar_amigo['numero_cli'];
                  $complemento_fia    = $buscar_amigo['complemento_cli'];
                  $bairro_fia         = $buscar_amigo['bairro_cli'];
                  $complemento_fia    = $buscar_amigo['complemento_cli'];
                  $telefone1_fia      = $buscar_amigo['telefone1_cli'];
                  $telefone2_fia      = $buscar_amigo['telefone2_cli'];

                  $cep_fia            = $buscar_amigo['cep_cli'];
                  $estado_fia         = $buscar_amigo['estado_cli'];

                 

$query_amigo_cli = "SELECT * FROM conjuge
                                INNER JOIN cliente ON conjuge.conjuge_idconjuge = cliente.idcliente
                                WHERE cliente_idcliente = $idfiador";


        
                $executa_query_cli = mysqli_query ($db,$query_amigo_cli) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query_cli)) {//--verifica se são amigos
               
                 
                  $nome_con_fia           = $buscar_amigo["nome_cli"];
                  $cpf_con_fia            = $buscar_amigo["cpf_cli"];
                  $rg_con_fia             = $buscar_amigo["rg_cli"];
                  $nacionalidade_con_fia  = $buscar_amigo["nacionalidade_cli"];
                  $profissao_con_fia      = $buscar_amigo["profissao_cli"];
                  $nascimento_con_fia     = $buscar_amigo["nascimento_cli"];
               
}

                    if($nome_con_fia == '')
                  {
                    $nome_con_fia = ' ';
                  }
                  
                  if($cpf_con_fia == '')
                  {
                    $cpf_con_fia = ' ';
                  }
                  
                  if($rg_con_fia == '')
                  {
                    $rg_con_fia = ' ';
                  }

                  if($profissao_con_fia == '')
                  {
                    $profissao_con_fia = ' ';
                  }
                  
                  if($nascionalidade_con_fia == '')
                  {
                    $nascionalidade_con_fia = ' ';
                  }
                  
                  if($nascimento_con_fia == '')
                  {
                    $nascimento_con_fia = ' ';
                  }


  $html .="<h2> Fiador(a) $cont: </h2>
<table border='1' cellspacing='0' cellpadding='0' align='center' width='500'>
  <tr>
    <td width='250' valign='top' style='padding-left:5px'><p>NOME: $nome_fia <br>
      RG: $rg_fia <br>
      CPF / CNPJ: $cpf_fia <br>
      Nacionalidade: $nacionalidade_fia <br>
      Profissão: $profissao_fia<br>
      Nascimento: $nascimento_fia<br>
      Estado Civil: $estadocivil_fia<br>
      
      Imóvel matricula nº :  12345678910<br>
      Endereço: Av Luiz Vasconcelos Pelizaro<br>
      Terreno: 200m2<br>
      Construção: 280m2</p>
      <p>&nbsp;</p></td>
    <td width='250' valign='top' style='padding-left:5px'><p>CÔNJUGE: <br>
      NOME:  $nome_con_fia <br>
      RG:    $rg_con_fia <br>
      CPF:    $cpf_con_fia<br>
      Nacionalidade: $nascionalidade_con_fia<br>
      Profissão:    $profissao_con_fia </p></td>
  </tr>
</table>
<br><br><br><br><br>";
$cont = $cont + 1;
}
date_default_timezone_set( 'America/Sao_Paulo' );
$mes_num = date('m');
 if($mes_num == 1){
    $mes_nome = "Janeiro";
    }elseif($mes_num == 2){
    $mes_nome = "Fevereiro";
    }elseif($mes_num == 3){
    $mes_nome = "Março";
    }elseif($mes_num == 4){
    $mes_nome = "Abril";
    }elseif($mes_num == 5){
    $mes_nome = "Maio";
    }elseif($mes_num == 6){
    $mes_nome = "Junho";
    }elseif($mes_num == 7){
    $mes_nome = "Julho";
    }elseif($mes_num == 8){
    $mes_nome = "Agosto";
    }elseif($mes_num == 9){
    $mes_nome = "Setembro";
    }elseif($mes_num == 10){
    $mes_nome = "Outubro";
    }elseif($mes_num == 11){
    $mes_nome = "Novembro";
    }else{
    $mes_nome = "Dezembro";
    }
$dia = date('d');

$ano = date('Y');
$html .="<h2> Objeto: </h2>
<table border='1' cellspacing='0' cellpadding='0' align='center' width='500'>
  <tr>
    <td width='500' valign='top' style='padding-left:5px'><br>
      Imóvel    matricula: $matricula <br>
      Terreno:    $terreno m2<br>
      Área    construída: $area_construida m2<br>
      Endereço:    $endereco , $numero  - $cidade / $estado <br>
      Valor do    Aluguel: R$ $valor_aluguel<br>
      Data    vencimento do aluguel: $primeira_parcela<br>
      Valor do    IPTU:  R$ $iptu <br>

      Data    vencimento do IPTU: $vencimento_iptu<br>
      Observação:    Sem mais
      <p>&nbsp;</p></td>
  </tr>
</table>
<br><br>
<p>Por  este particular instrumento, as partes supraqualificadas resolvem, de comum  acordo e de livre e espontânea vontade, firmar um Contrato de Locação, tendo  por objeto o imóvel declinado no preâmbulo, a reger-se pelas seguintes  cláusulas e condições:</p>
<p><strong><u>PRIMEIRA:</u></strong>:     Havendo interesse o &ldquo;LOCATÁRIO&rdquo; poderá  desocupar o imóvel após o 12º (décimo segundo) mês de locação, ou o &ldquo;LOCADOR&rdquo;  poderá pedir para desocupar, sem o pagamento da multa prevista na clausula 16ª,  desde que avise com antecedência mínima de 30 (trinta) dias.  </p>
<p><strong><u>SEGUNDA</u></strong><strong>:</strong>        A cada período de 12 ( doze ) o aluguel   sofrerá reajuste, meses que se lhe seguir, pelo primeiro dos índices a  seguir indicados, que sucederão na medida em que o precedente falte, seja  extinto ou não divulgado ou tenha utilização impedida: (1) IGP/M – Índice Geral  de Preços para Mercado, da fundação Getúlio Vargas; (2) IGP­ – Índice Geral de  Preços, da Fundação Getúlio Vargas; (3) IPC – Índice de Preços ao  Consumidor  calculado pela fundação  Instituto de pesquisas Econômicas – FIBE, da USP; (4) INPC – Índice Nacional de  Preços ao Consumidor do IBGE, ou, ainda, Por   Qualquer outro Indexador oficial que venha a substituí-los na hipótese  de sua falta, extinção, não divulgação ou tenha a sua utilização impedida</p>
<p><strong><u>TERCEIRA:</u></strong>     A não observância do prazo estabelecido na  cláusula segunda, implicará na incidência de multa de 10% (dez por cento) sobre  o valor do aluguel, além de juros de mora de 1% a.m., que será cobrado  juntamente com o aluguel do mês, corregido monetariamente pelo índice oficial  da inflação ocorrida no período. Em caso de cobrança judicial, os honorários  advocatícios ficam pactuados em 20% (vinte por cento) sobre o valor do débito. </p>
<p><strong><u>QUARTA</u></strong><strong>:</strong>        Além  do aluguel, obriga se o(a) LOCATÁRIO(A) a efetuar o pagamento dos seguintes  encargos, que poderão ser exigidos juntamente com o aluguel:<br>
  a.  o consumo de água e energia elétrica;<br>
  b.  os demais encargos e tributos que normalmente  incidem ou venham a incidir sobre o imóvel.<br>
  c.  o prêmio de seguro contra incêndio, que deverá ser feito pelo valor venal do  imóvel, e pelo prazo de locação, nele figurando o(a) LOCADOR(A) como  beneficiário(a), e entregando –lhe a cópia da apólice. <br>
  d.  o IPTU <br>
  E.  Taxa referente a condomínio</p>
<p>&nbsp;</p>
<p><strong><u>QUINTA:</u></strong>          O não pagamento desses encargos nas  épocas próprias, facultará ao(a) LOCADOR(A) a justa recusa ao recebimento dos  alugueres, sujeitando-se o(a) LOCATÁRIO(A) ao pagamento dos ônus decorrentes do  inadimplemento, previstos para cada débito, independentemente de eventual ação  de despejo. </p>
<p><strong><u>SEXTA:</u></strong>            O imóvel objeto deste instrumento é  locado exclusivamente para servir de residência ao(à) LOCATÁRIO(A) e sua  família, não podendo sua destinação ser alterada, substituída ou acrescida de  qualquer outra, sem prévia e expressa anuência do(a) LOCADOR(A). Fica vedado,  outrossim, a sublocação, cessão ou transferência deste contrato, bem como o  empréstimo, parcial ou total do imóvel locado, que dependerão também, de prévia  e expressa anuência do(a) LOCADOR(A).</p>
<p><strong><u>SÉTIMA:</u></strong>          O imóvel objeto deste, foi entregue  ao(a) LOCATÁRIO(A) nas condições descritas no &ldquo;Termo de Vistoria&rdquo; devidamente  assinado pelas partes, integrando o presente, obrigando-se a devolvê-lo, uma  vez finda a locação, nas mesmas condições em que o recebeu, razão pela qual, no momento da  restituição das chaves, proceder-se-á a uma nova vistoria. </p>
<p><strong><u>ÚNICO</u></strong>:        Constatadas eventuais  irregularidades e a necessidade de reparos no imóvel em decorrência de uso  indevido, fará o(a) LOCADOR(A) apresentar de imediato ao(à) LOCATÁRIO(A), um  orçamento prévio assinado por profissional do ramo, sendo-lhe facultado pagar o  valor nele declinado, liberando-se assim de eventuais ônus em razão de demora  e/ou imperfeições nos serviços. Caso contrário, poderá contratar por sua  própria conta e risco mão-de-obra especializada, arcando nessa condição com os  riscos de eventuais imperfeições dos serviços e pelo pagamento do aluguel dos  dias despendidos para a sua execução, cessando a locação unicamente  com o &ldquo;Termo de Entrega de Chaves e Vistoria&rdquo;, firmado pelo(a) LOCADOR(A) ou  seu(sua) administrador(a). </p>
<p><strong><u>OITAVA</u></strong>:          Obriga-se o(a) LOCATÁRIO(A) a manter o  imóvel sempre limpo e bem cuidado na vigência da locação, correndo por sua  conta e risco, não só os pequenos reparos tendentes a sua conservação, mas  também as multas a que der causa, por inobservância de quaisquer leis, decretos  e/ou regulamentos.</p>
<p><strong><u>NONA</u></strong>:             O(A) LOCATÁRIO(A) não poderá fazer  no imóvel ou em suas dependências, quaisquer obras ou benfeitorias, sem prévia  e expressa anuência do(a) LOCADOR(A), não lhe cabendo direito de retenção, por  aquelas que, mesmo necessárias ou consentidas, venham a ser realizadas.                                         </p>
<p><strong><u>ÚNICO</u></strong>:      Caso não convenha ao(à) LOCADOR(A) a  permanência de quaisquer obras ou benfeitorias realizadas pelo(a) LOCATÁRIO(A),  mesmo necessárias ou consentidas, deverá este(a), uma vez finda a locação,  removê-las às suas expensas, de modo a devolver o imóvel nas mesmas condições  em que o recebeu. </p>
<p><strong><u>DÉCIMA</u></strong>:         Obriga-se desde já o(a) LOCATÁRIO(A), a  respeitar os regulamentos e as leis vigentes, bem como o direito de vizinhança,  evitando a prática de quaisquer atos que possam perturbar a tranqüilidade ou  ameaçar a saúde pública.</p>
<p><strong><u>ÚNICO</u></strong>:            Fica convencionado que os fiadores  supramencionados não se eximirão da obrigação ora assumida, caso a locação,  seja por força de lei, de contrato ou por ajuste feito entre LOCADOR(A) e LOCATÁRIO(A),  se prorrogue por prazo superior ao convencionado.<strong> </strong><strong> </strong></p>
<p><strong><u>DÉCIMA-</u></strong><br>
  <strong><u>PRIMEIRA</u></strong><strong>:</strong>      Qualquer  tolerância ou concessão, com o fito de resolver extrajudicialmente questão  legal ou contratual, não se constituirá em precedente invocável pelo(a)  LOCATÁRIO(A) e nem modificará quaisquer das condições estabelecidas neste  instrumento. <br>
  <strong><u>DÉCIMA-</u></strong><br>
  <strong><u>SEGUNDA</u></strong>:      Em caso de morte, exoneração, falência ou  insolvência de quaisquer dos fiadores, obriga-se o(a) LOCATÁRIO(A), num prazo  de quinze (15) dias, contados da verificação do fato, a apresentar substituto  idôneo ao(à) LOCADOR(A), à juízo deste(a) (apenas se a garantia for através de  fiança). <br>
  <strong><u>DÉCIMA-</u></strong><br>
  <strong><u>TERCEIRA</u></strong>:     Obriga-se o(a) LOCATÁRIO(A) a efetuar a  ligação de energia elétrica em seu nome, providenciando no seu desligamento,  por ocasião da devolução do imóvel, quando então deverá apresentar as últimas  contas de seu consumo. <br>
  <strong><u>DÉCIMA-</u></strong><br>
  <strong><u>QUARTA</u></strong>:        A falta de cumprimento de qualquer  cláusula ou condição deste instrumento, implicará na sua imediata rescisão, ficando  a parte infratora, sujeita ao pagamento de uma multa, <strong>equivalente a três meses de aluguel</strong>, pelo valor vigente à época da  infração, além de perdas e danos.  <br>
  <strong><u>DÉCIMA-</u></strong><br>
  <strong><u>QUINTA</u></strong>:          Sempre que as partes forem obrigadas a  se valer de medidas judiciais para a defesa de direitos e obrigações decorrentes  deste instrumento, o valor devido a título de honorários, será de 20% (vinte  por cento) sobre o valor da causa, elegendo, desde já, o foro da cidade de Franca  - SP, para a solução das questões dele emergentes.<br>
  <strong><u>DÉCIMA </u></strong><br>
  <strong><u>SEXTA:</u></strong><strong>          </strong>O  &ldquo;LOCATÁRIO&rdquo; desde já abre mão do seu direito de preferência referente a venda  do imóvel objeto deste contrato.</p>
<p><strong><u>ÚNICO:</u></strong>      O &ldquo;LOCATARIO&rdquo; e &ldquo;FIADORES&rdquo; outorgam-se,  mútua e reciprocamente, poderes bastantes especiais e irrevogáveis, para serem,  uns pelos outros, representados passivamente em juízo em decorrência do  contrato de locação, de forma que, em razão do mandato, podem, uns pelos  outros, receber validamente notificações, intimações e inclusive citação  inicial, enquanto pender qualquer obrigação decorrente da locação ajustada.</p>
<p>E  por estarem assim justas e contratadas, assinam o presente, em três (03) vias,  de igual teor e forma, na presença das testemunhas retro, para que surta seus  legais e jurídicos efeitos, obrigando-se por si, seus herdeiros e/ou  sucessores, ao fiel cumprimento de todas as suas cláusulas e condições.</p>
<p>&nbsp;</p>
<p>Franca, $dia de $mes_nome de $ano <br>
  <br>
</p>
<table width='500' border='0' align='center'>
  <tbody>
    <tr>
      <td width='250'><p align='center'>______________________________________</p>
      <p align='center'>Locatário (a): $nome_cli</p></td>
      <td width='250'><p align='center'>______________________________________</p>
      <p align='center'>Locatário  (a): $nome_con</p></td>
    </tr>
    <tr>
      <td width='250'><p align='center'>_____________________________________</p>
      <p align='center'>Locador  (a): $nome_loc</p></td>
      <td width='250'><p align='center'>_____________________________________</p>
      <p align='center'>Locador  (a): $nome_con_loc</p></td>
    </tr>
    <tr>
      <td width='250'><p align='center'>______________________________________</p>
      <p align='center'>Fiador  (a) $nome_fia </p></td>
      <td width='250'><p align='center'>______________________________________</p>
      <p align='center'>Fiador  (a) $nome_con_fia </p></td>
    </tr>
    <tr>
      <td width='250'><p align='center'>______________________________________</p>
      <p align='center'>Fiador  (a) 02</p></td>
      <td width='250'><p align='center'>______________________________________</p>
      <p align='center'>Fiador  (a) 02</p></td>
    </tr>
    <tr>
      <td colspan='2'><center><u>TESTEMUNHAS</u></center></td>
    </tr>
     <tr>
      <td colspan='2'><center><u></u></center></td>
    </tr>
     <tr>
      <td colspan='2'><center><u></u></center></td>
    </tr>
     <tr>
      <td colspan='2'><center><u></u></center></td>
    </tr>
      <tr>
      <td colspan='2'><center><u></u></center></td>
    </tr>
      <tr>
      <td colspan='2'><center><u></u></center></td>
    </tr>
      <tr>
      <td colspan='2'><center><u></u></center></td>
    </tr>
      <tr>
      <td colspan='2'><center><u></u></center></td>
    </tr>
    <tr>
      <td width='250'>_____________________________________<br>
Nome<br>
CPF:<br>
RG:</td>
      <td width='250'>_____________________________________<br>
Nome<br>
CPF:<br>
RG:</td>
    </tr>
  </tbody>
</table>
</body>
</html>";


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
