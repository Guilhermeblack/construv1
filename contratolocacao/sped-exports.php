<?php
ob_start();
//error_reporting(0);
//ini_set(“display_errors”, 0 );
?>

<?php

require_once("dompdf/dompdf_config.inc.php");

global $inicio;
global $fim;

date_default_timezone_set('America/Sao_Paulo');               
$horario_relatorio = date('d-m-Y H:i:s');

$inicio                   = $_GET["inicio"];
$fim                      = $_GET["fim"];

//   $inicio = date("d-m-Y", strtotime($inicio));
//   $fim    = date("d-m-Y", strtotime($fim));

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


if($inicio != '' and $inicio != 0 and $inicio != 'Todos'){
  $rel_inicio = date("d-m-Y", strtotime($inicio));
  $rel_fim    = date("d-m-Y", strtotime($fim));
  $rel_periodo = "$rel_inicio"." até ".$rel_fim;
}else{
  $rel_periodo = '';
}

$codigo_empreendimento = 0;


$html = "<table style='width:100%' border='0'>
<tr>
<td rowspan='2' colspan='2'><img src='fotos/hr.png' /></td>
<td colspan='2' style='text-align: center'>Franca, $dia_hoje de $nome_mes de $ano_hoje</td>
</tr>
<tr>
<td colspan='2' style='text-align: center'>Data Inicial .: $rel_inicio<br>
Data Final .: $rel_fim</td>
</tr>


<tr>
<td colspan='4' style='text-align: center; font-weight: bold;'>SPED CONTRIBUIÇÕES - F200/210</td>
</tr>

</table>";

$sel_empresa = addslashes($_GET['idcliente']);


if($sel_empresa == 'Todos'){

        //pegar quantidade de empreendimento por empresa
  $qtd_emprendimento = pegaQtdEmprendimento(); 
  $html .= executar($qtd_emprendimento); 

}else{

  $qtd_emprendimento_empresa = pegaQtdEmprendimento($sel_empresa);
        //echo "<br>A QUANTIDADE DE EMPREENDIMENTO DESTA EMPRESA É DE.: " . $qtd_emprendimento_empresa; die();
  $html .= executarPorId($sel_empresa);
}

$remessa= "remessa/";
$qtdvenda = 0;

function pegaQtdEmprendimento($idcliente){ 
  include '../conexao.php';
  $query_amigo = "SELECT COUNT(*) as total_emprendimento FROM empreendimento_cadastro WHERE cliente_id = $idcliente";
  $executa_query = mysqli_query($db,$query_amigo) or die ("Erro ao listar empreendimento");
  $buscar_amigo = mysqli_fetch_assoc($executa_query);

  $qtd = $buscar_amigo['total_emprendimento'];
  return $qtd;
}


$totalrecebido = 0;


###########################################################################################

$quantidade_venda = 0;
$array_vendas_id = array();

$ttotalsaldounidade = 0;
$ssomatotalrecant = 0;
$ssomatotalrecper = 0;


function executarPorId($val){


  global $inicio;
  global $fim;
  global $quantidade_venda;
  global $array_vendas_id;
  global $qtd_emprendimento_empresa;
  global $codigo_empreendimento;
  global $rel_periodo;
  global $ttotalsaldounidade;
  global $ssomatotalrecper;
  global $ssomatotalrecant;

          //echo $val;
  $resultado = buscarVendasEmpreendimento($val);
  $empresa = buscarEmpresa($val);
  $render = "<hr><label><strong>Empresa.:</strong>  $empresa</label><hr>";
  $render .= "<table style='width:100%; font-size:10px;' height='127' border='0'>"  ;
  $result = empreendimento($val);

  // echo "<br>id da empresa consultada.: " . $val;
  // echo "<pre>";
  // print_r($result);
  // echo "</pre>"; die();


  if($resultado == array()){

    $empresa = buscarEmpresa($val);

    $render .= "<tr>
    <th colspan=13><font style='font-size: 15px'> Nenhum Registro encontrado para a Empresa Selecionada !!!</font></th>
    </tr>";
    $render .= "</table>";
    return $render;
  }





  foreach ($result['dados_empreendimento'] as $empreendimento_por_empresa) {
      # code...
      // echo "<br>id da empresa consultada.: " . $val;
      // echo "<pre>";
      // print_r($empreendimento_por_empresa);
      // echo "</pre>"; die();




     //DESCRIÇAO DO EMPREENDIMENTO ;
   $descempr = $empreendimento_por_empresa[0];

   $codigo_empreendimento = $empreendimento_por_empresa[1];

     //echo "<br>O codigo do empreendimento é .: " . $codigo_empreendimento; die();

          // $descempr = $result[0][0][$i];
        // echo "<pre>";
        // print_r($resultado); 
        // $quantidade_venda = $resultado['qtdvenda'];
   $array_vendas_id = $resultado['idvenda'];
        // echo "</pre>";



   $empresa = $resultado['empresa'];
   $cnpj    = $resultado['cnpj'];
   $uf      = $resultado['uf'];
   $codempresa = $resultado['codempresa'];



   $render .=  "<tr>";

   $render .=  "<th colspan='13' style='text-align: left'><font style='font-size: 15px' ><br>Empreendimento.: $descempr</font> </th>

   </tr>";




   $cont = count($resultado);

   $render .= "<tr  bgcolor='#b8b8b8'>
   <th>Quadra</th>
   <th>Lote</th>
   <th>Contrato</th>
   <th>Custo Orçado</th>
   <th>S/ Direito Credito</th>
   <th>Saldo Unidade</th>
   <th>Recebido Anterior</th>
   <th>Recebido Periodo</th>
   <th>% Acumul. Recebido</th>
   <th>% Mes. Recebido</th>
   <th>Base Calculo</th>
   <th>PIS</th>
   <th>COFINS</th>
   </tr>";


   $totalsaldounidade = 0;
   $somatotalrecant = 0;
   $somatotalrecper = 0;



   $venda_emprendimento = buscarVendasEmpreendimento($val,$codigo_empreendimento);

       // echo "<pre>";
       //  print_r($venda_emprendimento); 
       //  echo "</pre>"; die();


   foreach ($venda_emprendimento['idvenda'] as $valor) {

    $quadra =  buscarQuadraLote($valor,0);
    $parcelas = valorTotalParcelasPagas($valor);
    // echo "<pre>";
    // print_r($parcelas);
    // echo "</pre>";


    $totalrecebido = $parcelas['total_pago'];
    $datarecebimento = $parcelas['data_recebimento'];
    $totalrecebidoant = $parcelas['total_recebido_ant'];
    $vquadra = $quadra['quadra'];
    $vlote = $quadra['lote'];
    $saldounidade = saldoUnidade($valor);
    $acurec0 = $totalrecebidoant + $totalrecebido;
    $acurec1 = $saldounidade + $totalrecebidoant + $totalrecebido;
    $acurec  = ($acurec0 / $acurec1) * 100;
    $acurec = number_format($acurec, 4);
    $macum = ($totalrecebido / $acurec1) * 100;
    $macum = number_format($macum, 4);

    $render .= "<tr>

    <td style='text-align: center'>  $vquadra</td>
    <td style='text-align: center'> $vlote </td>
    <td style='text-align: center'> $valor</td>
    <td style='text-align: right'>0,00 &nbsp;&nbsp;  </td>
    <td style='text-align: right'>0,00 &nbsp;&nbsp;   </td>
    <td style='text-align: right'>". number_format($saldounidade, 2, ',','.') ." &nbsp;&nbsp;</td>
    <td style='text-align: right'>". number_format($totalrecebidoant, 2, ',', '.') . " &nbsp;&nbsp;</td>
    <td style='text-align: right'>". number_format($totalrecebido, 2, ',','.') . " &nbsp;&nbsp;</td>
    <td style='text-align: right>$acurec &nbsp;&nbsp; </td>
    <td style='text-align: right'>$macum &nbsp;&nbsp;</td>
    <td style='text-align: right'>0,00 &nbsp;&nbsp;   </td>
    <td style='text-align: right'>0,00 &nbsp;&nbsp;   </td>
    <td style='text-align: right'>0,00 &nbsp;&nbsp;   </td>

    </tr>";


    $totalsaldounidade += saldoUnidade($valor);
    $somatotalrecant += $totalrecebidoant;
    $somatotalrecper += $totalrecebido;


  }


  $ttotalsaldounidade += $totalsaldounidade;
  $ssomatotalrecant += $somatotalrecant;
  $ssomatotalrecper += $somatotalrecper;



  $render .="<tr bgcolor=#b8b8b8>
  <td colspan=3 style='text-align: right'><strong>Totais &nbsp;&nbsp;&nbsp;</strong></td>
  <td style='text-align: right'><strong>0,00 &nbsp;&nbsp;</strong></td>
  <td style='text-align: right'><strong>0,00 &nbsp;&nbsp;</strong></td>
  <td style='text-align: right'><strong>" . number_format($totalsaldounidade, 2, ',', '.') . " &nbsp;&nbsp;</strong></td>
  <td style='text-align: right'><strong>" . number_format($somatotalrecant, 2, ',', '.') . "&nbsp;&nbsp;&nbsp;</strong></td>
  <td style='text-align: right'><strong>" . number_format($somatotalrecper, 2, ',','.') . " &nbsp;&nbsp;</strong></td>
  <td style='text-align: center'><strong></strong></td>
  <td style='text-align: center'><strong></strong></td>
  <td style='text-align: right'><strong>0,00 &nbsp;&nbsp;</strong></td>
  <td style='text-align: right'><strong>0,00 &nbsp;&nbsp;</strong></td>
  <td style='text-align: right'><strong>0,00 &nbsp;&nbsp;</strong></td>

  </tr>";

}

$render .= "<br>
<hr>
<table>
<tr>
<td colspan='3' width='170px' style='text-align: right'><strong>Total Geral &nbsp;&nbsp;&nbsp;</strong></td>
<td width='75px' style='text-align: right'><strong>0,00 &nbsp;&nbsp;</strong></td>
<td width='87px'  style='text-align: right'><strong>0,00 &nbsp;&nbsp;</strong></td>
<td width='87px'  style='text-align: right'><strong>" . number_format($ttotalsaldounidade, 2, ',', '.') . " &nbsp;&nbsp;</strong></td>
<td width='100px'  style='text-align: right'><strong>" . number_format($ssomatotalrecant, 2, ',', '.') . "&nbsp;&nbsp;&nbsp;</strong></td>
<td width='92px'  style='text-align: right'><strong>" . number_format($ssomatotalrecper, 2, ',','.') . " &nbsp;&nbsp;</strong></td>
<td width='70px' style='text-align: center'><strong></strong></td>
<td width='100px' style='text-align: center'><strong></strong></td>
<td width='100px' style='text-align: right'><strong>0,00 &nbsp;&nbsp;</strong></td>
<td width='40px'  style='text-align: right'><strong>0,00 &nbsp;&nbsp;</strong></td>
<td width='65px' style='text-align: right'><strong>0,00 &nbsp;&nbsp;</strong></td>
</tr>


</table>

<hr>


";



$render .= "</table>";
// $render .= "<br><table style='border-collapse: collapse; border: solid 1px black'>";
// $render .= "<tr>
// <th colspan=2 style='text-align: left; border: solid 1px black' ><font style='font-size: 10' >Origem dos campos calculados</font></th>
// </tr>
// <tr>
// <td style='border: solid 1px black'>
// <font style='font-size: 9'>
// &nbsp;E = (D * P) / 100<br>
// &nbsp;F = (D * Q) / 100<br>
// &nbsp;G = (D * (P - Q)) / 100<br>
// &nbsp;K = (I + J) / (H + I + J) * 100
// </font>
// </td>
// <td style='border: solid 1px black'>
// <font style='font-size: 9'>
// &nbsp;L = J /( H + I + J ) * 100<br>
// &nbsp;M = (G * L) / 100<br>
// &nbsp;N = (M * 1,65) / 100<br>
// &nbsp;O = (M * 7,6) / 100<br>
// </font>
// </td>
// </tr>
// </table>
// ";

header_lote($codempresa, $empresa, $inicio, $fim, $cnpj, $uf, $render);


return $render;
}


function empreendimento($porempresa)
{
  //echo "entrei aqui e o id da empresa e .: " . $porempresa;
  include '../conexao.php';

  global $inicio;
  global $fim;

  // $query_amigo = "SELECT * FROM empreendimento
  // INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
  // where empreendimento_cadastro.cliente_id = $porempresa";




  $query_amigo = "SELECT DISTINCT descricao_empreendimento, empreendimento_cadastro_id FROM produto INNER JOIN venda ON produto.idproduto = venda.produto_idproduto INNER JOIN parcelas ON venda.idvenda = parcelas.venda_idvenda INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro INNER JOIN cliente ON empreendimento_cadastro.cliente_id = cliente.idcliente WHERE cliente_id = $porempresa AND situacao ='PAGO' AND status_venda = 3 AND fluxo= 0 AND tipo_venda = 2 AND STR_TO_DATE(data_recebimento , '%d-%m-%Y') BETWEEN '$inicio' AND '$fim'";


  $executa_query = mysqli_query($db,$query_amigo) or die ("Erro ao listar empreendimento");

  $descricao = '';
  $empreendimento_id = '';

 //  $cont = 0;
  $retorno = array();
  $array_dados1 = array();
  while ($buscar_amigo = mysqli_fetch_assoc($executa_query))

  {                 
    $array_dados = array();

    //echo "entrei no while emprendimento";
    $descricao           = $buscar_amigo["descricao_empreendimento"];                 
    $empreendimento_id   = $buscar_amigo["empreendimento_cadastro_id"];

    array_push($array_dados, $descricao);
    array_push($array_dados, $empreendimento_id);

    $array_dados1[] = $array_dados;

  }

  $dados["dados_empreendimento"] = $array_dados1;

  //$dados["cont"] = $cont;

  return $dados;

}


function saldoUnidade($idvenda){

  include '../conexao.php';

  $query_amigo = "SELECT TRUNCATE(SUM(valor_parcelas),2) AS valor_parcelas FROM parcelas WHERE venda_idvenda = $idvenda AND situacao = 'em aberto'";
  $executa_query = mysqli_query($db,$query_amigo) or die ("Erro ao listar empreendimento");

  $dado =  mysqli_fetch_assoc($executa_query);

  $saldo = $dado['valor_parcelas'];


 // $saldo = number_format($dado, 2, ',','.');
  return $saldo;

}



function valorTotalParcelasPagas($idvenda){

 global $inicio;
 global $fim;


 include '../conexao.php';  

 $query_amigo123 = "SELECT valor_parcelas FROM parcelas  WHERE situacao = 'PAGO' AND venda_idvenda = $idvenda AND STR_TO_DATE(data_recebimento , '%d-%m-%Y')  <  '$inicio'";

 $totalrecebidoant = 0;
 $executa_query0 = mysqli_query($db,$query_amigo123) or die ("Erro ao listar empreendimento");
 while ($buscar_amigo1 = mysqli_fetch_assoc($executa_query0)){                 
  $totalrecebidoant         += $buscar_amigo1["valor_parcelas"]; 
}

$query_amigo = "SELECT valor_parcelas, data_recebimento FROM parcelas WHERE situacao = 'PAGO' AND venda_idvenda = $idvenda AND STR_TO_DATE(data_recebimento , '%d-%m-%Y')  BETWEEN   '$inicio' AND '$fim'";

$executa_query = mysqli_query($db,$query_amigo) or die ("Erro ao listar empreendimento");

$totalpago = 0;
while ($buscar_amigo = mysqli_fetch_assoc($executa_query)){                 
  $totalpago           += $buscar_amigo["valor_parcelas"]; 
  $data_recebimento     = $buscar_amigo["data_recebimento"];                
}


$dados['total_pago'] = $totalpago;
$dados['data_recebimento'] = $data_recebimento;
$dados['total_recebido_ant'] = $totalrecebidoant;


return $dados;

}



function buscarQuadraLote($idvenda,$status){
  include '../conexao.php';  
  global $codigo_empreendimento;


  if($status == 0) {


    $query_amigo = "SELECT * FROM produto 
    INNER JOIN lote ON produto.idproduto = lote.produto_idproduto
    INNER JOIN venda ON lote.idlote = venda.lote_idlote
    where status_venda = 3 AND idvenda = $idvenda
    AND empreendimento_idempreendimento = $codigo_empreendimento";   

  }

  if($status == 1){
    $query_amigo = "SELECT * FROM produto 
    INNER JOIN lote ON produto.idproduto = lote.produto_idproduto
    INNER JOIN venda ON lote.idlote = venda.lote_idlote
    where status_venda = 3 AND idvenda = $idvenda";

  }


  // $quadra = array();
  // $lote = array();
  $executa_query = mysqli_query($db,$query_amigo) or die ("Erro ao listar empreendimento");

  $totalpago = 0;
  while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
  {                 
   $quadra       = $buscar_amigo['quadra'];
   $lote         = $buscar_amigo['lote'];
 }

 if(!empty($quadra) && !empty($lote)){
   $dados['quadra'] = $quadra;
   $dados['lote'] = $lote;

   return $dados;


 }else{
  $dados = array();
  return $dados;
}

}



function buscarVendasEmpreendimento($porempresa){

  include '../conexao.php';

  global $inicio;
  global $fim;
  global $codigo_empreendimento;
  //echo "o codigo do emprendimento nesta funçao é .: " . $codigo_empreendimento;

  if($codigo_empreendimento === 0){

    $query_amigo = "SELECT *  FROM produto INNER JOIN venda ON produto.idproduto = venda.produto_idproduto
    INNER JOIN parcelas ON venda.idvenda = parcelas.venda_idvenda
    INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
    INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
    INNER JOIN cliente ON empreendimento_cadastro.cliente_id = cliente.idcliente
    WHERE cliente_id = $porempresa AND situacao ='PAGO' AND status_venda = 3 AND fluxo= 0 AND tipo_venda = 2 AND STR_TO_DATE(data_recebimento , '%d-%m-%Y')  BETWEEN   '$inicio' AND '$fim' ORDER BY quadra ASC, lote_idlote ASC";


  }else{

    $query_amigo = "SELECT *  FROM produto INNER JOIN venda ON produto.idproduto = venda.produto_idproduto
    INNER JOIN parcelas ON venda.idvenda = parcelas.venda_idvenda
    INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
    INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
    INNER JOIN cliente ON empreendimento_cadastro.cliente_id = cliente.idcliente
    WHERE empreendimento_cadastro_id = $codigo_empreendimento AND cliente_id = $porempresa AND situacao ='PAGO' AND status_venda = 3 AND fluxo= 0 AND tipo_venda = 2 AND STR_TO_DATE(data_recebimento , '%d-%m-%Y')  BETWEEN   '$inicio' AND '$fim' ORDER BY quadra ASC, lote_idlote ASC";

  }





  $executa_query = mysqli_query($db,$query_amigo) or die ("Erro ao listar empreendimento");

  $numrows = mysqli_num_rows($executa_query);
 // echo "achei  "  . $numrows . " -  linhas"; 

  if($numrows == 0){
   $dados = array();
   return $dados;
 }

 while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
 {                 

  $parcela[]           = $buscar_amigo["valor_parcelas"];                 
  $idvenda[]            =$buscar_amigo["idvenda"];
  $situacao           = $buscar_amigo["situacao"];               
  $tipovenda[]          = $buscar_amigo["tipo_venda"];
  $descricao              = $buscar_amigo["descricao_empreendimento"];
  $id_empreendimento      = $buscar_amigo["idempreendimento"];
  $empresa                = $buscar_amigo["nome_cli"];
  $cnpj                   = $buscar_amigo["cpf_cli"];
  $uf                     = $buscar_amigo["estado_cli"];
  $codempresa             = $buscar_amigo["cliente_id"];  
}

$todosempreendimento = pegaQtdEmprendimento($porempresa);
//echo "TODOS Empreendimento" . $todosempreendimento;
//echo $todosempreendimento;

$idvenda = array_unique($idvenda, SORT_REGULAR);
// echo "<pre>";
// print_r($idvenda);
// echo "</pre>";

for($i=1;$i<=$todosempreendimento;$i++){ //executa quantas vendas tem em cada empreendimento
  foreach ($idvenda as $value) {

     // echo "<br>";
     // echo "id de venda.: " . $value . "<br>";
     // echo "valor recebido.: " . valorTotalParcelasPagas($value) . "<br>";
     // $recebido[] = valorTotalParcelasPagas($value);
   $lote[] = buscarQuadraLote($value,0);

 }
}

$lote =array_unique($lote, SORT_REGULAR);
$lote =array_filter($lote);

$qtdvenda = array_unique($idvenda, SORT_REGULAR);
$qtdvenda = count($qtdvenda);

//echo "quantidade de vendas.: " . $qtdvenda;




$dat["situacao"] = $situacao;
$dat["idvenda"] = $idvenda; 
$dat["qtdvenda"] = $qtdvenda;
$dat["idempreendimento"] = $id_empreendimento;
$dat["lote"] = $lote;
$dat["empresa"] = $empresa;
$dat["codempresa"] = $codempresa;
$dat["cnpj"] = $cnpj;
$dat["uf"] = $uf;
return $dat;

}


function buscarEmpresa($emp){
  include "../conexao.php";
  $query_amigo = "SELECT nome_cli FROM cliente WHERE idcliente = $emp";

  $executa_query = mysqli_query($db,$query_amigo) or die ("erro ao buscar empresa");

  $empresa = mysqli_fetch_assoc($executa_query);

  $empresa = $empresa['nome_cli'];

  return $empresa;

}





function geraArquivo($conteudo,$render){

  include '../conexao.php';

  global $sel_empresa;
  global $html;
  global $inicio;
  global $fim;

  $arqHtml = $html;
  $arqHtml .= $render;

  $arqHtml = str_replace("'", '"',$arqHtml);


  $arqHtml = htmlentities($arqHtml);
  
  $exten = $inicio . "-" . $fim;
  //echo $exten;
  $filename = 'sped-'. $sel_empresa."-".$exten .'.txt';

  //echo "NOME DO ARQUIVO  " . $filename;
  
  $criar = fopen($filename, 'w+');
  $escreve = fwrite($criar, "$conteudo");
  fclose($criar);

// TRANSFERIR O ARQUIVO PARA O SERVIDOR

  $pastaO = $filename;
  $pastaD = '../sped/'.$filename;




  if (copy($pastaO, $pastaD)){
    $arquivo = $filename;

    }
    else
      {
          echo "Erro ao copiar arquivo.";
       }


  if(file_exists($filename)){
    unlink($filename);
//    echo("<font color=\"green\">" .$del . " deletado com sucesso!!");
  }

  $id_arq = '';

  $patharquivo = "sped/".$arquivo;

   $inserir = mysqli_query($db,"INSERT INTO sped_arquivos (id_arq,id_empresa,path_arq,data_geracao,nome_arquivo,html_arquivo) VALUES ('$id_arq', '$sel_empresa', '$patharquivo', NOW(),'$filename', '$arqHtml')") or die("erro ao salvar path do arquivo sped no banco");


   header("Location: ../gerar_sped.php?passaid=$sel_empresa");



}





// =====================================================================

  // $inserir = mysqli_query($db,"INSERT INTO sped_arquivos (id_arq,id_empresa,path_arq,data_geracao,nome_arquivo) VALUES ('$id_arq', '$sel_empresa', '$patharquivo', NOW(),'$filename')") or die("erro ao salvar path do arquivo sped no banco");


      //gerarPdf($html);





function carregaCliente($idvenda){

  include '../conexao.php';

 //echo "Contador é.: " . $idcontador . "<br>";

  $query_amigo = "SELECT * FROM cliente INNER JOIN venda ON
  venda.cliente_idcliente = cliente.idcliente
  WHERE idvenda = $idvenda";    
  $executa_query = mysqli_query($db,$query_amigo) or die ("Erro ao listar corretor");

  while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
  {                 

   $cpfcliente = $buscar_amigo['cpf_cli'];
   $datavenda = $buscar_amigo['data_venda'];



 }


 $dados['cpf_cliente'] = $cpfcliente;
 $dados['data_venda_cliente'] = $datavenda;


 return $dados;      

}



function carregaContador($idcontador){

 include '../conexao.php';

 //echo "Contador é.: " . $idcontador . "<br>";

 $query_amigo = "SELECT * FROM cliente WHERE idcliente = $idcontador";    
 $executa_query = mysqli_query($db,$query_amigo) or die ("Erro ao listar corretor");

 while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
 {                 

  $cnpjcontador = $buscar_amigo['cpf_cli'];
  $cepcontador = $buscar_amigo['cep_cli'];
  $endcontador = $buscar_amigo['endereco_cli'];
  $numendcontador = $buscar_amigo['numero_cli'];
  $bairrocontador = $buscar_amigo['bairro_cli'];
  $telcontador = $buscar_amigo['telefone1_cli'];
  $emailcontador = $buscar_amigo['email_cli'];



}

$dados['cnpjcontador'] = $cnpjcontador;
$dados['cep_contador'] = $cepcontador;
$dados['end_contador'] = $endcontador;
$dados['num_end_contador'] = $numendcontador;
$dados['bairro_contador'] = $bairrocontador;
$dados['tel_contador'] = $telcontador;
$dados['email_contador'] = $emailcontador;


return $dados;

}






function confSped($codempresa, $empresa){

  include '../conexao.php';

  // echo "A EMPRESA É.: " . $empresa . "<br>";

  // echo "O CODIGO DA EMPRESA É.: " . $codempresa . "<br>" ;
  $query_amigo = "SELECT * FROM sped_config WHERE empresa_id = $codempresa";




  $executa_query = mysqli_query($db,$query_amigo) or die ("Erro ao listar configuraçoes do sped");


  $linhas = mysqli_num_rows($executa_query);



  if($linhas == 0){
    header("Location: ../alterar_sped_empresa.php?idempresa=$codempresa&status=cadastrar");
  }



//  echo "retornou .: " . $linhas . "<br>";

  while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
  {                 

    $codmuniempresa = $buscar_amigo['cod_municipio_cli'];
    $nomeempresa = $buscar_amigo['empresa'];
    $nomecontador = $buscar_amigo['nome_contador'];
    $idcontador = $buscar_amigo['cliente_id_contador'];
    $cpfcontador = $buscar_amigo['cpf_contador'];
    $crccontador = $buscar_amigo['crc_contador'];
    $codmuncontador = $buscar_amigo['cod_municipio_contador'];
    $pis = $buscar_amigo['pis'];
    $cofins = $buscar_amigo['cofins'];
    $codatividade = $buscar_amigo['cod_atividade'];
    $aliquotaatividade = $buscar_amigo['aliquota_atividade'];
    $apropriacaocredito = $buscar_amigo['apropriacao_credito'];
    $codM205 = $buscar_amigo['codM205'];
  }

  $dadoscontador = carregaContador($idcontador);

  // echo "<pre>";
  // print_r($dadoscontador);
  // echo "</pre>";


  $dados['codmuniempresa'] = $codmuniempresa;
  $dados['nomeempresa'] = $nomeempresa;
  $dados['nomecontador'] = $nomecontador;
  $dados['cpf_contador'] = $cpfcontador;
  $dados['crc_contador'] = $crccontador;
  $dados['cod_municipio_contador'] = $codmuncontador;
  $dados['cnpj_contador'] = $dadoscontador['cnpjcontador'];
  $dados['cep_contador'] = $dadoscontador['cep_contador'];
  $dados['end_contador'] = $dadoscontador['end_contador'];
  $dados['num_end_contador'] = $dadoscontador['num_end_contador'];
  $dados['bairro_contador'] = $dadoscontador['bairro_contador'];
  $dados['tel_contador'] = $dadoscontador['tel_contador'];
  $dados['email_contador'] = $dadoscontador['email_contador'];
  $dados['pis'] = $pis;
  $dados['cofins'] = $cofins;
  $dados['cod_atividade'] = $codatividade;
  $dados['aliquota_atividade'] = $aliquotaatividade;
  $dados['apropriacao_credito'] = $apropriacaocredito;
  $dados['codM205'] = $codM205;

  return $dados;

}


function buscarEmpreendimentoIdVenda($idvenda){
 include '../conexao.php';


 $query_amigo = "SELECT empreendimento_cadastro.descricao_empreendimento FROM venda 
 INNER JOIN produto ON
 produto.idproduto = venda.produto_idproduto
 INNER JOIN  empreendimento  ON
 empreendimento.idempreendimento = produto.empreendimento_idempreendimento
 INNER JOIN  empreendimento_cadastro ON
 empreendimento_cadastro.idempreendimento_cadastro = empreendimento.empreendimento_cadastro_id
 WHERE  venda.idvenda = $idvenda";
 $executa_query = mysqli_query($db,$query_amigo) or die ("Erro ao listar corretor");


 while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
 {                 

  $emprendimento = $buscar_amigo['descricao_empreendimento'];

}




return $emprendimento;

}





function header_lote($codempresa, $empresa, $dataini, $datafin, $cnpj, $uf, $render){

 global $quantidade_venda;
 global $array_vendas_id;
 global $ssomatotalrecper;
 global $html;

 $ssomatotalrecper = str_replace('.', ',', $ssomatotalrecper);

 //print_r($array_vendas_id); die();

 $resultado = confSped($codempresa, $empresa);

 $pis = $resultado['pis'];
 $cofins = $resultado['cofins'];
 $codM205 = $resultado['codM205'];
 $codigo_atividade = $resultado['cod_atividade'];

 // echo "base do pis é .: " . $pis . "<br>";
 // echo "base do cofins é .: " . $cofins; die();

 $codmuniempresa = $resultado['codmuniempresa'];
 $nomecontador = $resultado['nomecontador'];
 $cpf_contador = $resultado['cpf_contador'];
 $crc_contador = $resultado['crc_contador'];
 $cnpj_contador = $resultado['cnpj_contador'];
 $cep_contador = $resultado['cep_contador'];
 $cnpj_contador  = str_replace('.', '', $cnpj_contador);
 $cnpj_contador  = str_replace('-', '', $cnpj_contador);
 $cnpj_contador  = str_replace('/', '', $cnpj_contador);
 $cep_contador = str_replace('.', '', $cep_contador);
 $cep_contador = str_replace('-', '', $cep_contador);
 $cep_contador = str_replace('/', '', $cep_contador);
 $end_contador = $resultado['end_contador'];
 $num_contador = $resultado['num_end_contador'];
 $bairro_contador = $resultado['bairro_contador'];
 $tel_contador = $resultado['tel_contador'];
 $tel_contador = str_replace('(', '', $tel_contador);
 $tel_contador = str_replace(')', '', $tel_contador);
 $tel_contador = str_replace('-', '', $tel_contador);
 $tel_contador = str_replace(' ', '', $tel_contador);
 $email_contador = $resultado['email_contador'];
 $cod_municipio_contador = $resultado['cod_municipio_contador'];



 //echo $tel_contador . "<br>";
 


 $end_contador = substr($end_contador, 0, 50);
 $end_contador = $end_contador . "No: " . $num_contador;

 $aliquota_atividade = $resultado['aliquota_atividade'];
 $aliqatividade = str_replace(',', ',', $aliquota_atividade);
 $aliqatividade = floatval($aliqatividade);
 $apropriacao_credito = $resultado['apropriacao_credito'];



 //echo $cnpj_contador;

 $dataini = date("dmY", strtotime($dataini));
 $datafin = date("dmY", strtotime($datafin));
 $cnpj = str_replace('.', '', $cnpj);
 $cnpj = str_replace('-', '', $cnpj);
 $cnpj = str_replace('/', '', $cnpj);

#################################################################################################
#        CABEÇALHO  DO SPED                                                                          #
#################################################################################################


 //versao anterior 003


 $header_lote  = '';
 $header_lote .= '|0000|004|0|||'.$dataini.'|'.$datafin.'|'.$empresa.'|'.$cnpj .'|'.$uf.'|'. $codmuniempresa .'||00|4|';  
 $header_lote .= chr(13).chr(10);                   
 $header_lote .= '|0001|0|';     
 $header_lote .= chr(13).chr(10);         
 $header_lote .='|0100|'.$nomecontador .'|'. $cpf_contador . '|'. $crc_contador .'|'. $cnpj_contador .'|'.$cep_contador.'|'. $end_contador . '|||'. $bairro_contador .'|'. $tel_contador .'||'. $email_contador .'|'. $cod_municipio_contador .'|';
 $header_lote .= chr(13).chr(10);                                          
 $header_lote .='|0110|'.$apropriacao_credito.'||1|1|';       
 $header_lote .= chr(13).chr(10);                                  
 $header_lote .='|0140||'.$empresa.'|'.$cnpj .'|'. $uf .'||' . $codmuniempresa .'|||';            
 $header_lote .= chr(13).chr(10);                            
 //$header_lote .= '|0145|1|'. $ssomatotalrecper .'|'. $ssomatotalrecper.'|0,00||';  
 $header_lote .='|0990|6|';  
 $header_lote .= chr(13).chr(10);                                    
 $header_lote .= '|A001|1|';       
 $header_lote .= chr(13).chr(10);     
 $header_lote .= '|A990|2|';     
 $header_lote .= chr(13).chr(10);                                 
 $header_lote .= '|C001|1|';              
 $header_lote .= chr(13).chr(10);      
 $header_lote .= '|C990|2|';       
 $header_lote .= chr(13).chr(10);    
 $header_lote .= '|D001|1|';     
 $header_lote .= chr(13).chr(10);      
 $header_lote .= '|D990|2|';   
 $header_lote .= chr(13).chr(10);         
 $header_lote .= '|F001|0|'; 
 $header_lote .= chr(13).chr(10);       
 $header_lote .= '|F010|'.$cnpj.'|'; 
 $header_lote .= chr(13).chr(10);                             



#################################################################################################
#        CORPO DO SPED                                                                          #
#################################################################################################

   // echo "<pre>";
   // print_r($array_vendas_id);
   // echo "</pre>"; die();


 $cont = 0;
 $recebido_total_periodo = 0;
 foreach ($array_vendas_id as $idvenda) {


  $res_empreendimento = empreendimento($codempresa);

   // echo "<pre>";
   // print_r($res_empreendimento);
   // echo "</pre>"; die();
  

  //$nome_empreendimento = $res_empreendimento['dados_empreendimento'][0];
  $nome_empreendimento = buscarEmpreendimentoIdVenda($idvenda);
 // echo "O NOME DO EMPREENDIMENTO É.: " . $nome_empreendimento; die();

  $resq = buscarQuadraLote($idvenda,1);

   // echo "<pre>";
   // print_r($resq);
   // echo "</pre>"; die();




  $res_dados_cliente = carregaCliente($idvenda);
  $res_valor_parcelas_pagas = valorTotalParcelasPagas($idvenda);
  $recebido_ate_periodo   =  $res_valor_parcelas_pagas['total_pago'];
  $recebido_no_periodo = $res_valor_parcelas_pagas['total_pago'];
  $recebido_acumulado_antes_periodo = $res_valor_parcelas_pagas['total_recebido_ant'];

  $recebido_anterior   =  $res_valor_parcelas_pagas['total_recebido_ant'];
  $recebido_ate_periodo = $recebido_ate_periodo + $recebido_anterior;

  $cpf_cliente = $res_dados_cliente['cpf_cliente'];
  $cpf_cliente = str_replace('.', '', $cpf_cliente);
  $cpf_cliente = str_replace('-', '', $cpf_cliente);




  $data_venda_cliente = $res_dados_cliente['data_venda_cliente'];
  $datavenda = explode(' ',$data_venda_cliente );
  $data_venda_cliente = $datavenda[0];
  $data_venda_cliente = str_replace('-', '', $data_venda_cliente);

  $qua = $resq['quadra'];
  $lot = $resq['lote'];

  $quadra_lote1 = $qua . " - " . $lot;
  
  //SOMATORIO DOS CAMPOS (10 + 11) / 9
  $recebido_total_periodo += $recebido_no_periodo;
  $percentual_receita_total = (($recebido_acumulado_antes_periodo + $recebido_no_periodo) / $recebido_ate_periodo) * 100;

//  echo "o campo 10 = (" . $recebido_acumulado_antes_periodo .") + campo 9 = (" .$recebido_no_periodo . ") / pelo campo 11 = (". $recebido_ate_periodo.") igual === " . $percentual_receita_total ; die();

  $percentual_receita_total = number_format($percentual_receita_total, 2, ',', '.');


  $recebido_no_periodo = str_replace('.', ',', $recebido_no_periodo);


  //echo "O PERCENTUAL TOTAL DE RECEITA DEU .: " . $percentual_receita_total . "<br>";


  //$recebido_no_periodo = number_format($recebido_no_periodo, 2, ',', '.');
  $recebido_no_periodo = str_replace('.', ',', $recebido_no_periodo);
   // echo "recebido no periodo é de.: " . $recebido_no_periodo; die();


  $recebido_acumulado_antes_periodo = number_format($recebido_acumulado_antes_periodo, 2, ',', '.');
  $recebido_acumulado_antes_periodo = str_replace('.', '', $recebido_acumulado_antes_periodo);
  $recebido_ate_periodo = number_format($recebido_ate_periodo, 2, ',', '.');
  $recebido_ate_periodo = str_replace('.', '', $recebido_ate_periodo);
  $recebido_no_periodo_calculo_pis = str_replace('.', '', $recebido_no_periodo );
  $recebido_no_periodo_calculo_pis = str_replace(',', '.', $recebido_no_periodo_calculo_pis);
  $recebido_no_periodo_calculo_pis =  floatval($recebido_no_periodo_calculo_pis);


  $pis_float = str_replace(',', '.', $pis);
  $pis_float = floatval($pis_float);
  $cofins_float = floatval($cofins);

  $cofins_apurado =  ($recebido_no_periodo_calculo_pis * $cofins_float) / 100;
  $cofins_apurado = number_format($cofins_apurado, 2, ',', '.');
  $cofins_apurado = str_replace('.', '', $cofins_apurado);

  $pis_apurado = ($recebido_no_periodo_calculo_pis * $pis_float) / 100;

  $pis_apurado = number_format($pis_apurado, 2, ',', '.');
  $pis_apurado = str_replace('.', '', $pis_apurado);

  
  $header_lote  .='|F200|05|02|'. $nome_empreendimento .'|'. $quadra_lote1 .'|'.$idvenda .'|'. $cpf_cliente .'|'. $data_venda_cliente .'|||'.$recebido_no_periodo .'|01|'. $recebido_no_periodo .'|'.$pis .'|'. $pis_apurado .'|01|'. $recebido_no_periodo .'|'. $cofins .'|'. $cofins_apurado .'|'. $percentual_receita_total .'|4||';      //echo "quadra e lote é .: " . $quadra_lote; die();
    $header_lote .= chr(13).chr(10);                          // essa é a quebra de linha


    $cont ++;
  }
  $pis_apurado_total = ($recebido_total_periodo * $pis_float) / 100;
  $testeapuracao = ($recebido_total_periodo * 0.28) / 100;
  $testeapuracao = number_format($testeapuracao, 2, ',','.');
  $testeapuracao = str_replace('.', '', $testeapuracao);

  // echo "<br>recebido total no perido foi de.: " . $recebido_total_periodo;
  // echo "<br>teste deu .: " . $testeapuracao;



  $cofins_apurado_total = ($recebido_total_periodo * $cofins_float) /100;
  $pis_apurado_total = number_format($pis_apurado_total, 2, ',', '.');
  $pis_apurado_total = str_replace('.', '', $pis_apurado_total);
  $cofins_apurado_total = number_format($cofins_apurado_total, 2, ',', '.');
  $cofins_apurado_total = str_replace('.', '', $cofins_apurado_total);
  $contriuicao_previdenciaria = ($recebido_total_periodo * $aliqatividade) / 100;
  
  $recebido_total_periodo = number_format($recebido_total_periodo, 2, ',', '.');
  $recebido_total_periodo = str_replace('.', '', $recebido_total_periodo);

  //CASO TIVER CONTRIBUIÇAO PREVIDENCIARIA , AJUSTAR A LOGIA A BAIXO COMENTADA

  $contriuicao_previdenciaria = number_format($contriuicao_previdenciaria, 2, ',', '.');
  $contriuicao_previdenciaria = str_replace('.', '', $contriuicao_previdenciaria);
  //$contriuicao_previdenciaria = '0,00'; 
#################################################################################################
#        RODAPE  DO SPED                                                                          #
#################################################################################################

  $cont = $cont + 5; 
  $contitotal = (77 + $cont) - 3;
  //echo "valor total de linhas " . $contitotal; die();

  $header_lote .= '|F500|'.$testeapuracao.'|06|||0||06|||0|||||RECEITA FINANCEIRA|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|F525|'.$testeapuracao.'|99||||'.$testeapuracao.'|06|06|RECEITA FINANCEIRA||';
  $header_lote .= chr(13).chr(10);           
  $header_lote .= '|F990|'. $cont .'|';     
  $header_lote .= chr(13).chr(10);           
  $header_lote .= '|M001|0|';        
  $header_lote .= chr(13).chr(10);
  $header_lote .= '|M200|0|0|0|0|0|0|0|'.$pis_apurado_total.'|0|0|'. $pis_apurado_total.'|'. $pis_apurado_total.'|';  
  $header_lote .= chr(13).chr(10);
  $header_lote .= '|M205|'.$codM205.'|810902|'.$pis_apurado_total.'|';
  $header_lote .= chr(13).chr(10);
  $header_lote .= '|M210|54|'.$recebido_total_periodo.'|'.$recebido_total_periodo.'|'.$pis.'|0||'.$pis_apurado_total.'|0|0|0|0|'.$pis_apurado_total .'|';
  $header_lote .= chr(13).chr(10);
  $header_lote .= '|M400|06|'.$testeapuracao.'|||';
  $header_lote .= chr(13).chr(10);
  $header_lote .= '|M410|999|'.$testeapuracao.'||RECEITA FINANCEIRA|';
  $header_lote .= chr(13).chr(10);
  $header_lote .= '|M600|0|0|0|0|0|0|0|'.$cofins_apurado_total.'|0|0|'.$cofins_apurado_total.'|'.$cofins_apurado_total.'|';
  $header_lote .= chr(13).chr(10);
  $header_lote .= '|M605|'.$codM205.'|217201|'.$cofins_apurado_total.'|';
  $header_lote .= chr(13).chr(10);
  $header_lote .= '|M610|54|'.$recebido_total_periodo.'|'.$recebido_total_periodo.'|'.$cofins.'|0||'.$cofins_apurado_total.'|0|0|0|0|'.$cofins_apurado_total.'|';
  $header_lote .= chr(13).chr(10);                                 
  $header_lote .= '|M800|06|'.$testeapuracao.'|||';
  $header_lote .= chr(13).chr(10);
  $header_lote .= '|M810|999|'.$testeapuracao.'||RECEITA FINANCEIRA|';
  $header_lote .= chr(13).chr(10);
  $header_lote .= '|M990|12|';     
  $header_lote .= chr(13).chr(10);                                 
  $header_lote .= '|P001|1|';        
  $header_lote .= chr(13).chr(10); 
  // $header_lote .= '|P010|'. $cnpj .'|'; 
  // $header_lote .= chr(13).chr(10); 
  // //P100 ->  verificar o campo 7 , valor das Exclusoes da Receita Bruta informadas no campo¨6
  // $header_lote .= '|P100|'. $dataini .'|'.  $datafin .'|'. $recebido_total_periodo .'|'. $codigo_atividade .'|'. $recebido_total_periodo .'|0,00|'. $recebido_total_periodo .'|'.$aliquota_atividade.'|'.$contriuicao_previdenciaria.'|||';  
  // $header_lote .= chr(13).chr(10);       
  // $header_lote .= '|P200|'. substr($dataini, -6) .'|'. $contriuicao_previdenciaria .'|0,00|0,00|'.$contriuicao_previdenciaria.'|298501|'; 
  $header_lote .= '|P990|2|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|1001|0|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|1900|'. $cnpj .'|99|||00|'. $recebido_total_periodo .'||01|01||RECEITA DE ATIVIDADE IMOBILIARIA||';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|1900|'. $cnpj . '|99|||00|'.$testeapuracao.'||06|06||RECEITA FINANCEIRA||';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|1990|4|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9001|0|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|0000|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|0001|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|0100|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|0110|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|0140|1|'; 
  $header_lote .= chr(13).chr(10); 
  // $header_lote .= '|9900|0145|1|';
  // $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|0990|1|'; 
  $header_lote .= chr(13).chr(10); 
  // $header_lote .= '|9900|1001|1|';
  // $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|1900|2|';
  $header_lote .= chr(13).chr(10); 
  // $header_lote .= '|9900|1990|1|';
  // $header_lote .= chr(13).chr(10); 
  // $header_lote .= '|9900|9001|1|';
  // $header_lote .= chr(13).chr(10); 
  // $header_lote .= '|9900|9990|1|';
  // $header_lote .= chr(13).chr(10); 
  // $header_lote .= '|9900|9999|1|';
  // $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|A001|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|A990|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|C001|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|C990|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|D001|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|D990|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|F001|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|F010|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|F200|'. $cont .'|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|F500|1|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|F525|1|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|F990|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|I001|1|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|I990|1|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|M001|1|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|M200|1|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|M205|1|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|M210|1|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|M400|1|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|M410|1|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|M600|1|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|M605|1|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|M610|1|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|M800|1|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|M810|1|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|M990|1|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|P001|1|'; 
  $header_lote .= chr(13).chr(10); 
  // $header_lote .= '|9900|P010|1|'; 
  // $header_lote .= chr(13).chr(10); 
  // $header_lote .= '|9900|P100|1|'; 
  // $header_lote .= chr(13).chr(10); 
  // $header_lote .= '|9900|P200|1|'; 
  $header_lote .= '|9900|P990|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|1001|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|1990|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|9001|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|9900|30|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|9990|1|';
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9900|9999|1|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9990|44|'; 
  $header_lote .= chr(13).chr(10); 
  $header_lote .= '|9999|'.$contitotal.'|';  
  $header_lote .= chr(13).chr(10);                         // essa é a quebra de linha



  $conteudo = $header_lote;

  return geraArquivo($conteudo,$render);

}


// $redir = geraPdf($html);

// if($redir){
//     header('Location: ../gerar_sped.php?idempresa=$sel_empresa');
// }


function geraPDF($html){
  $exten = DATE('dmY');
  //echo $exten;
  $filename = 'sped-'. $exten .'.pdf';

  $dompdf = new DOMPDF();
  $dompdf->load_html($html);
  $dompdf->set_paper("A4","landscape");
  ob_clean();

  $pdf = $dompdf->render();
  $canvas = $dompdf->get_canvas(); 
  $font = Font_Metrics::get_font("helvetica", "bold"); 
  $canvas->page_text(510, 18, "", $font, 6, array(0,0,0)); 
  $canvas->page_text(270, 792, "Pág. {PAGE_NUM}/{PAGE_COUNT}", $font, 6, array(0,0,0)); 
  header("Content-type: application/pdf"); 


  $dompdf->stream($filename, 
    array(
      "Attachment" => 1
    )
  );



}






?>