<?php  ob_start(); 
error_reporting(0);
ini_set(“display_errors”, 0 ); 

function fotologo($id){
    include "../conexao.php";
            $query_amigo = "SELECT * FROM empreendimento_cadastro                           
                            WHERE idempreendimento_cadastro = $id";


            $executa_query = mysqli_query ($db,$query_amigo);                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
            $img   = $buscar_amigo['img_lote'];
          }

          return $img;
} 

function dados_locacao($locacao_id){
    include "../conexao.php";
            $query_amigo = "SELECT * FROM imovel WHERE idimovel = $locacao_id";                           
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

function dados_imobiliaria($imob){
  include "../conexao.php";
            $query_amigo = "SELECT * FROM cliente                           
                            WHERE idcliente = $imob";                           
            $executa_query = mysqli_query ($db,$query_amigo);                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
            $descricao_imob   = $buscar_amigo['nome_cli'];
          }

          return $descricao_imob;
}

function dados_corretor($corretor){
  include "../conexao.php";
            $query_amigo = "SELECT * FROM cliente                           
                            WHERE idcliente = $corretor";                           
            $executa_query = mysqli_query ($db,$query_amigo);                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos           
            $descricao_corretor   = $buscar_amigo['nome_cli'];
          }

          return $descricao_corretor;
}

function converterdata($dateSql){
    $ano= substr($dateSql, 0,4);
    $mes= substr($dateSql, 5,2);
    $dia= substr($dateSql, 1,2);
    return $dia."-".$mes."-".$ano;
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

      $inicio                   = $_POST["inicio"];
      $fim                      = $_POST["fim"];

      $empreendimento_id        = $_POST["empreendimento_id"];
      $categoria                = $_POST["categoria"];

      $locacao_id               = $_POST["idlocacao"];
      $imob                     = $_POST["imob"];
      $corretor                 = $_POST["corretor"];

      $origem                   = $_POST["origemfil"];
      $status                   = $_POST["status3"];
      $uf                       = $_POST["estado"];
      $cidade                   = $_POST["cidade"];
      $bairro                   = $_POST["bairro"];

      $inicio = date("d-m-Y", $inicio);
      $fim = date("d-m-Y", $fim);
$and = "";
$inner = "";

if ($empreendimento_id != 'Todos' && $locacao_id != 'Todos' && $categoria != 'Todos') { ?> 
  <script>
    window.location= "../crm_relatorios2.php?cad=1";
  </script>
  <?php
} elseif($empreendimento_id != 'Todos'){
      $and .= "AND idempreendimento_cadastro =".$empreendimento_id; 
    } elseif($locacao_id != 'Todos'){
     $and2 .= " AND idimovel =". $locacao_id;

    } 

if($categoria == 'Todos'){
       
     if($locacao_id != 'Todos'){
     $and2 .= " AND idimovel =". $locacao_id;
    } 
    
      }

if($inicio != '' AND $fim != ''){
        $and .=" AND STR_TO_DATE(crm_data_cadastro, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";
        $and2 .=" AND STR_TO_DATE(crm_data_cadastro, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";
      }

      if ($origem != "") {
        $and .=" AND crm_origem = ". $origem;
        $and2 .=" AND crm_origem = ". $origem;
      }
      if ($status != "") {
        $and .=" AND crm_statuscli = ".$status;
        $and2 .=" AND crm_statuscli = ".$status;
      }
      if ($uf != "") {
        $and .=" AND crm_uf = '".$uf."'";
        $and2 .=" AND crm_uf = '".$uf."'";
      }
      if ($cidade != "") {
        $and .=" AND crm_cidade = '".$cidade."'";
        $and2 .=" AND crm_cidade = '".$cidade."'";
      }
      if ($bairro != "") {
        $and .=" AND crm_bairro = '".$bairro."'";
        $and2 .=" AND crm_bairro = '".$bairro."'";
      }
      if ($imob != "") {
        $and .=" AND imobiliaria_id = '".$imob."'";
        $and2 .=" AND crm_idimob = '".$imob."'";
      }
      if ($corretor != "") {
        $and .=" AND crm_idcorretor = '".$corretor."'";
        $and2 .=" AND crm_idcorretor = '".$corretor."'";
      }

      

require_once("dompdf/dompdf_config.inc.php");

/* Cria a instância */
$dompdf = new DOMPDF();


if ($inicio == '--' || $fim == '--') {
  $data = "vazio";
} else { $data = "De $inicio até $fim";}
if ($empreendimento_id != 'Todos') {
  $idemp = $empreendimento_id;
  $empreendimento_id = dados_empreendimento($empreendimento_id);
  $logo = fotologo($idemp);
}
if ($locacao_id != 'Todos') {
  $locacao_id        = dados_locacao($locacao_id);
}




include "../conexao.php";


 $html .= "<table style='width:100%' border='0'>
    <tr>";

    if ($empreendimento_id == 'Todos' || is_null($empreendimento_id)){ 
      $html .= "<td colspan='2'>
      
      </td>";
       } else {
        $html .= "<td colspan='2'>

      <img src='../img/$idemp/$logo' height='110' />

      </td>";
    }
      $html .= "<td colspan='2' style='text-align: center'>Caldas Novas, $dia_hoje de $nome_mes de $ano_hoje</td>
    </tr>
    <tr>
      <td colspan='4' style='text-align: center; font-weight: bold;'>RELATÓRIO DE STATUS</td>
    </tr>
    <tr>
      <td colspan='2'><span style='font-weight: bold'>Data Período</span>: $data</td>
      <td colspan='2'><span style='font-weight: bold'>Locação</span>: $locacao_id</td>
    </tr>
    <tr>
      <td colspan='2'><span style='font-weight: bold'>Empreendimento</span>: $empreendimento_id</td>
      <td colspan='2'><span style='font-weight: bold'>Venda</span>: $locacao_id</td>
    </tr>
</table>";

$html .="<table style='width:100%; font-size:10px;' height='127' border='0'>";
  if ($categoria == '1' || $categoria == 'Todos') {
    
    $html .="<tr bgcolor='#b8b8b8'>
      <td style='text-align: center'><strong>Nome</strong></td>
      <td style='text-align: center'><strong>E-mail</strong></td>
      <td style='text-align: center'><strong>Celular</strong></td>
      <td style='text-align: center'><strong>Fixo</strong></td>
      <td style='text-align: center'><strong>Data/Hora Cadastro</strong></td>
      <td style='text-align: center'><strong>Origem</strong></td>
      <td style='text-align: center'><strong>Status</strong></td>
      <td style='text-align: center'><strong>Endereço</strong></td>
      <td style='text-align: center'><strong>Cidade/UF</strong></td>
      <td style='text-align: center'><strong>interesse</strong></td>
      <td style='text-align: center'><strong>Imob/Corretor</strong></td>
    </tr>";
#######################################LISTAGEM DOS EMPREENDIMENTOS########################################
###########################################################################################################
    
     

        include "../conexao.php";
        $query = "SELECT c.crm_nome, c.crm_email, c.crm_celular, c.crm_fixo, c.crm_data_cadastro, c.crm_horacad, o.crm_origemnome, s.crm_status, i.descricao_empreendimento, i.idempreendimento_cadastro, c.crm_rua, c.crm_cidade, c.crm_uf, c.crm_bairro, c.crm_numeroend, imob.imobiliaria_id, r.crm_idcorretor FROM crm_cli AS c INNER JOIN crm_status AS s ON c.crm_statuscli = s.crm_idstatus INNER JOIN crm_origem AS o ON c.crm_origem = o.crm_idorigem INNER JOIN empreendimento_cadastro AS i ON i.idempreendimento_cadastro = c.crm_interesse INNER JOIN empreendimento_imob AS imob  ON imob.empreendimento_id = c.crm_interesse INNER JOIN crm_roleta_corretor AS r ON r.crm_idcli = c.crm_id WHERE  crm_categoria = 2 $and";


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
                  $numero                     = $buscar_amigo["crm_numeroend"];
                  $interessel                  = $buscar_amigo["descricao_empreendimento"];
                  $cidade                 = $buscar_amigo["crm_cidade"];
                  $bairro                 = $buscar_amigo["crm_bairro"];
                  $uf                     = $buscar_amigo["crm_uf"];
                  $dimob                     = $buscar_amigo["imobiliaria_id"];
                  $dcorretor                     = $buscar_amigo["crm_idcorretor"];
                  $categ = $buscar_amigo["crm_categoria"];
                  $dimob = dados_imobiliaria($dimob); 
                  $dcorretor = dados_corretor($dcorretor);
    
 $html .="<tr>
  <td style='text-align: center'>$nomel</td>
  <td style='text-align: center'>$emaill</td>
  <td style='text-align: center'>$celularl</td>
  <td style='text-align: center'>$fixol</td>
  <td style='text-align: center'>$datal - $horal</td>
  <td style='text-align: center'>$origeml</td>
  <td style='text-align: center'>$statusl</td>
  <td style='text-align: center'>$enderecol, nº $numero, $bairro</td>
  <td style='text-align: center'>$cidade - $uf</td>
  <td style='text-align: center'>$interessel</td>
  <td style='text-align: center'>$dimob / $dcorretor</td>
  </tr>";

$total ++;
} } 
              
################################################FIM EMPREENDIMENTOS########################################
###########################################################################################################

if ($categoria == 2 OR $categoria == 'Todos') {
$html .="<tr bgcolor='#b8b8b8'>
      <td style='text-align: center'><strong>Nome</strong></td>
      <td style='text-align: center'><strong>E-mail</strong></td>
      <td style='text-align: center'><strong>Celular</strong></td>
      <td style='text-align: center'><strong>Fixo</strong></td>
      <td style='text-align: center'><strong>Data/Hora Cadastro</strong></td>
      <td style='text-align: center'><strong>Origem</strong></td>
      <td style='text-align: center'><strong>Status</strong></td>
      <td style='text-align: center'><strong>Endereço</strong></td>
      <td style='text-align: center'><strong>Cidade/UF</strong></td>
      <td style='text-align: center'><strong>interesse</strong></td>
      <td style='text-align: center'><strong>Imob/Corretor</strong></td>
    </tr>";
#########################################VENDA / LOCAÇÃO###################################################
###########################################################################################################
        

$query2 = "SELECT c.crm_nome, c.crm_email, c.crm_celular, c.crm_cidade, c.crm_fixo, c.crm_data_cadastro, c.crm_horacad, o.crm_origemnome, s.crm_status, i.endereco, c.crm_rua, i.idimovel FROM crm_cli as c 
INNER JOIN crm_status as s ON c.crm_statuscli = s.crm_idstatus 
INNER JOIN crm_origem as o ON c.crm_origem = o.crm_idorigem 
INNER JOIN imovel as i ON i.idimovel = c.crm_interesse 
INNER JOIN crm_roleta_corretor AS r ON r.crm_idcli = c.crm_id
WHERE crm_categoria != 2 $and2";
  
                              $executa_query2 = mysqli_query($db, $query2);

                              


                while ($buscar_amigo2 = mysqli_fetch_assoc($executa_query2)) {//--verifica se são amigos

                  $nomel                  = utf8_encode($buscar_amigo2["crm_nome"]);
                  $emaill                  = $buscar_amigo2["crm_email"];
                  $celularl                 = $buscar_amigo2["crm_celular"];
                  $fixol                  = $buscar_amigo2["crm_fixo"];
                  $datal                  = $buscar_amigo2["crm_data_cadastro"];
                  $horal                  = $buscar_amigo2["crm_horacad"];
                  $origeml                  = $buscar_amigo2["crm_origemnome"];
                  $statusl                  = $buscar_amigo2["crm_status"];
                  $enderecol                  = $buscar_amigo2["crm_rua"];
                  $interessel                  = $buscar_amigo2["endereco"];
                  $categ2 = $buscar_amigo2["crm_categoria"];
                  
                  

 $html .="<tr>
  <td style='text-align: center'>$nomel</td>
  <td style='text-align: center'>$emaill</td>
  <td style='text-align: center'>$celularl</td>
  <td style='text-align: center'>$fixol</td>
  <td style='text-align: center'>$datal - $horal</td>
  <td style='text-align: center'>$origeml</td>
  <td style='text-align: center'>$statusl</td>
  <td style='text-align: center'>$enderecol, nº $numero, $bairro</td>
  <td style='text-align: center'>$cidade - $uf</td>
  <td style='text-align: center'>$interessel</td>
  <td style='text-align: center'>$dimob / $dcorretor</td>

  </tr>";
  

$total ++;
} 
}
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
      <td style='text-align: center'><strong></strong></td>
      <td style='text-align: center'><strong>Total Cadastrados: $total</strong></td>
      
    </tr>";

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
