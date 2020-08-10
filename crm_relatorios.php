<?php  ob_start(); 
error_reporting(0);
ini_set(“display_errors”, 0 ); 
  
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

      $empreendimento_id        = $_GET["empreendimento_id"];


      $locacao_id               = $_GET["idlocacao"];


 
 // Abaixo codigos de verificação dos dados do filtro APENAS PARA EXIBIR NO CABEÇALHO DO RELATORIO

require_once("dompdf/dompdf_config.inc.php");

/* Cria a instância */
$dompdf = new DOMPDF();
 

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

          $exibir = $endereco.", ".$numero;

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

require_once("dompdf/dompdf_config.inc.php");

/* Cria a instância */
$dompdf = new DOMPDF();
 
 $inicio  = converterdata($inicio);
          $fim     = converterdata($fim);
 
      $html = "<table style='width:100%' border='0'>
    <tr>
      <td colspan='2'><img src='../fotos/logo.jpg' /></td>
      <td colspan='2' style='text-align: center'>Franca, $dia_hoje de $nome_mes de $ano_hoje</td>
    </tr>
    <tr>
      <td colspan='4' style='text-align: center; font-weight: bold;'>RELATÓRIO DE LEADS</td>
    </tr>
    <tr>
      <td colspan='2'><span style='font-weight: bold'>Descrição</span>: Empreendimento / Venda / Locação</td>
      <td colspan='2'><span style='font-weight: bold'>Locação</span>: Identificar Imóvel aqui</td>
    </tr>
    <tr>
      <td colspan='2'><span style='font-weight: bold'>Empreendimento</span>: Identificar empreendimento aqui</td>
      <td colspan='2'><span style='font-weight: bold'>Venda</span>: Identificar imóvel aqui</td>
    </tr>
</table>";




$html .="<table style='width:100%; font-size:10px;' height='127' border='0'>

    <tr bgcolor='#b8b8b8'>
      <td style='text-align: center'><strong>Nome</strong></td>
      <td style='text-align: center'><strong>E-mail</strong></td>
      <td style='text-align: center'><strong>Celular</strong></td>
      <td style='text-align: center'><strong>Fixo</strong></td>
      <td style='text-align: center'><strong>Data Cadastro</strong></td>
      <td style='text-align: center'><strong>Hora Cadastro</strong></td>
      <td style='text-align: center'><strong>Origem</strong></td>
      <td style='text-align: center'><strong>Status</strong></td>
      <td style='text-align: center'><strong>Endereço</strong></td>
      <td style='text-align: center'><strong>interesse</strong></td>
    </tr>";
#######################################LISTAGEM DOS EMPREENDIMENTOS########################################
###########################################################################################################
    
     

        include "../conexao.php";
        $query = "SELECT c.crm_nome, c.crm_email, c.crm_celular, c.crm_fixo, c.crm_data_cadastro, c.crm_horacad, o.crm_origemnome, s.crm_status, i.descricao_empreendimento, c.crm_rua FROM crm_cli as c INNER JOIN crm_status as s ON c.crm_statuscli = s.crm_idstatus INNER JOIN crm_origem as o ON c.crm_origem = o.crm_idorigem INNER JOIN empreendimento_cadastro as i ON i.idempreendimento_cadastro = c.crm_interesse WHERE crm_categoria = 2";

               // echo $query; die();INNER JOIN imovel as im ON c.crm_interesse = im.idimovel

                  $executa_query = mysqli_query($db, $query);
$total = 0;
                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                  $nomel                  = utf8_encode($buscar_amigo["crm_nome"]);
                  $emaill                  = $buscar_amigo["crm_email"];
                  $celularl                 = $buscar_amigo["crm_celular"];
                  $fixol                  = $buscar_amigo["crm_fixo"];
                  $datal                  = $buscar_amigo["crm_data_cadastro"];
                  $horal                  = $buscar_amigo["crm_horacad"];
                  $origeml                  = $buscar_amigo["crm_origemnome"];
                  $statusl                  = $buscar_amigo["crm_status"];
                  $enderecol                  = $buscar_amigo["crm_rua"];
                  $interessel                  = $buscar_amigo["descricao_empreendimento"];
                  $categ = $buscar_amigo["crm_categoria"];
                  
if ($categ == 2 || $categ == 'Todos') {
  # code...

 $html .="<tr>
  <td style='text-align: center'>$nomel</td>
  <td style='text-align: center'>$emaill</td>
  <td style='text-align: center'>$celularl</td>
  <td style='text-align: center'>$fixol</td>
  <td style='text-align: center'>$datal</td>
  <td style='text-align: center'>$horal</td>
  <td style='text-align: center'>$origeml</td>
  <td style='text-align: center'>$statusl</td>
  <td style='text-align: center'>$enderecol</td>
  <td style='text-align: center'>$interessel</td>
  </tr>";

$total ++;
} }
             
################################################FIM EMPREENDIMENTOS########################################
###########################################################################################################
if ($categ != 2 || $categ == 'Todos') {
  # code...

$html .="<tr bgcolor='#b8b8b8'>
      <td style='text-align: center'><strong>Nome</strong></td>
      <td style='text-align: center'><strong>E-mail</strong></td>
      <td style='text-align: center'><strong>Celular</strong></td>
      <td style='text-align: center'><strong>Fixo</strong></td>
      <td style='text-align: center'><strong>Data Cadastro</strong></td>
      <td style='text-align: center'><strong>Hora Cadastro</strong></td>
      <td style='text-align: center'><strong>Origem</strong></td>
      <td style='text-align: center'><strong>Status</strong></td>
      <td style='text-align: center'><strong>Endereço</strong></td>
      <td style='text-align: center'><strong>interesse</strong></td>
    </tr>";
#########################################VENDA / LOCAÇÃO###################################################
###########################################################################################################

$query = "SELECT c.crm_nome, c.crm_email, c.crm_celular, c.crm_fixo, c.crm_data_cadastro, c.crm_horacad, o.crm_origemnome, s.crm_status, i.endereco, c.crm_rua FROM crm_cli as c INNER JOIN crm_status as s ON c.crm_statuscli = s.crm_idstatus INNER JOIN crm_origem as o ON c.crm_origem = o.crm_idorigem INNER JOIN imovel as i ON i.idimovel = c.crm_interesse WHERE crm_categoria != 2";

               

                  $executa_query = mysqli_query($db, $query);

                while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos

                  $nomel                  = utf8_encode($buscar_amigo["crm_nome"]);
                  $emaill                  = $buscar_amigo["crm_email"];
                  $celularl                 = $buscar_amigo["crm_celular"];
                  $fixol                  = $buscar_amigo["crm_fixo"];
                  $datal                  = $buscar_amigo["crm_data_cadastro"];
                  $horal                  = $buscar_amigo["crm_horacad"];
                  $origeml                  = $buscar_amigo["crm_origemnome"];
                  $statusl                  = $buscar_amigo["crm_status"];
                  $enderecol                  = $buscar_amigo["crm_rua"];
                  $interessel                  = $buscar_amigo["endereco"];
                  $descricao = $buscar_amigo["crm_categoria"];
                  
                  

 $html .="<tr>
  <td style='text-align: center'>$nomel</td>
  <td style='text-align: center'>$emaill</td>
  <td style='text-align: center'>$celularl</td>
  <td style='text-align: center'>$fixol</td>
  <td style='text-align: center'>$datal</td>
  <td style='text-align: center'>$horal</td>
  <td style='text-align: center'>$origeml</td>
  <td style='text-align: center'>$statusl</td>
  <td style='text-align: center'>$enderecol</td>
  <td style='text-align: center'>$interessel</td>
  </tr>";

$total ++;
} }

#########################################FIM VENDA / LOCAÇÃO###############################################
###########################################################################################################        

$html .="<tr bgcolor='#b8b8b8'>
      <td style='text-align: center'><strong></strong></td>
      <td style='text-align: center'><strong></strong></td>
      <td style='text-align: center'><strong></strong></td>
      <td style='text-align: center'><strong></strong></td>
      <td style='text-align: center'><strong></strong></td>
      <td style='text-align: center'><strong></strong></td>
      <td style='text-align: center'><strong></strong></td>
      <td style='text-align: center'><strong></strong></td>
      <td style='text-align: center'><strong></strong></td>
      <td style='text-align: center'><strong>Total Cadastrados: $total</strong></td>
      
    </tr>";

$html .="</table>";


print_r($html);

/*
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

*/




?>
