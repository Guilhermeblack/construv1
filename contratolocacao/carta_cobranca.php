<?php ob_start();
error_reporting(0);
ini_set(“display_errors”, 0 );

set_time_limit(0);
ini_set("upload_max_filesize", "100M");
ini_set("max_execution_time", "1200");
ini_set("memory_limit", "-1");
ini_set("realpath_cache_ttl", "512");

require_once("dompdf/dompdf_config.inc.php");
 
/* Cria a instância */
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
  
function verifica_atraso($venda_id){

   date_default_timezone_set('America/Sao_Paulo');

    $hoje = date('Y-m-d');
    $hoje = date('Y-m-d',strtotime($hoje . "-1 days"));   
    $inicio = '1900-01-01';

    $where = ' AND tipo_venda = 2 AND venda_idvenda ='.$venda_id;
    $where .= " AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$hoje."' order by idparcelas";

    include "../conexao.php";
$cont = 0;
   $query_amigo = "SELECT COUNT(idparcelas) as total FROM parcelas                         
                   where  situacao = 'Em Aberto' AND fluxo = 0 $where";

                   $executa_query = mysqli_query ($db,$query_amigo);
                
                
                  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                   $total            = $buscar_amigo["total"];

                   
                  
                  }
            


return $total;
}

 
$empreendimento_id = $_GET["idempreendimento"];
$quadra_id         = $_GET["idquadra"];
$lote_id           = $_GET["idlote"];


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



$html = " ";

  $where1 = 'empreendimento_cadastro_id = '.$empreendimento_id;

  if($quadra_id != '' AND $quadra_id != 0){
    $where1 .=' AND venda.produto_idproduto = '.$quadra_id;
  }
  if($lote_id != '' AND $lote_id != 0){
    $where1 .= ' AND lote_idlote = '.$lote_id;
  }

  include "../conexao.php";
    $query_amigo = "SELECT idvenda, venda.cliente_idcliente, descricao_empreendimento, quadra, lote, img_lote FROM venda  
                    INNER JOIN produto ON venda.produto_idproduto = produto.idproduto 
                    INNER JOIN lote ON venda.lote_idlote = lote.idlote 
                    INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                    INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro

                    where $where1";

//echo "$query_amigo"; die();
                   $executa_query = mysqli_query ($db,$query_amigo);
                
                
                  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                   $idvenda                   = $buscar_amigo["idvenda"];
                   $cliente_idcliente         = $buscar_amigo["cliente_idcliente"];
                   $quadra                    = $buscar_amigo["quadra"];
                   $lote                      = $buscar_amigo["lote"];
                   $descricao_empreendimento  = $buscar_amigo["descricao_empreendimento"];

                  $dados_empresa = dados_empresa($cliente_idcliente);

                    $nome_cli         = $dados_empresa["nome_cli"];
                    $cep_cli          = $dados_empresa["cep_cli"];
                    $endereco_cli     = $dados_empresa["endereco_cli"];
                    $bairro_cli       = $dados_empresa["bairro_cli"];
                    $cidade_cli       = $dados_empresa["cidade_cli"];
                    $estado_cli       = $dados_empresa["estado_cli"];
                    $numero_cli       = $dados_empresa["numero_cli"];
                    $img = $buscar_amigo["img_lote"];


                   $verifica_atraso = verifica_atraso($idvenda);
                    if($verifica_atraso > 0){

                      $html .= "<div style='height:990px !important; position:absolut; float:none'>
                      <p style='text-align: center'><img src='../img/$empreendimento_id/$img' height='110' />
                      <div style='text-align:center'><h3> NOTIFICAÇÃO EXTRAJUDICIAL DE COBRANÇA  </h3> </div><br>
                   
                     <span style='font-style: italic'> Caldas Novas, $dia_hoje de $nome_mes de $ano_hoje <br><br>
                      Ilmo Sr(a)<br>
                     <strong> $nome_cli </strong><br>
                      $endereco_cli , $numero_cli<br>
                      Bairro: $bairro_cli  UF: $estado_cli<br>
                      Cidade: $cidade_cli  CEP: $cep_cli  <br><br><br>
                      Prezado  Sr(a). <br>
                      Tendo em vista que V.S. se encontra em atraso com o pagamento da(s) seguinte(s) parcela(s):
                      <br><br></span>
                      <table border='1' align='center' width='300'>
                        <tr>
                          <td align='center'><strong>Valor</strong></td>
                          <td align='center'><strong>Data de Vencimento</strong> </td>
                        </tr>
                      ";

    $hoje = date('Y-m-d');
    $hoje = date('Y-m-d',strtotime($hoje . "-1 days"));   
    $inicio = '1900-01-01';

    $where = ' AND tipo_venda = 2 AND venda_idvenda ='.$idvenda;
    $where .= " AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$hoje."' order by idparcelas desc";

         $query_amigo2 = "SELECT valor_parcelas, data_vencimento_parcela FROM parcelas                         
                   where  situacao = 'Em Aberto' AND fluxo = 0 $where";

                   $executa_query2 = mysqli_query ($db,$query_amigo2);
                
                
                  while ($buscar_amigo3 = mysqli_fetch_assoc($executa_query2)) {//--verifica se são amigos
           
                   $valor_parcelas            = $buscar_amigo3["valor_parcelas"];
                   $data_vencimento_parcela   = $buscar_amigo3["data_vencimento_parcela"];

                   
                   $valor_parcelas = 'R$ ' . number_format($valor_parcelas, 2, ',', '.'); 

                  


                      $html .="<tr>
                                <td align='center'>$valor_parcelas </td>
                                <td align='center'> $data_vencimento_parcela </td>
                               </tr>

                               "; 

}




                      $html .="</table><br><br>    <span style='font-style: italic'> Do imóvel sito na<strong>  Quadra $quadra, Lote $lote, Loteamento $descricao_empreendimento, </strong>
Caldas Novas/GO, estamos solicitando o vosso comparecimento em nosso escritório, sito no endereço declinado no rodapé, no prazo de três (03) dias, contados a partir do recebimento desta, a fim de efetuar o seu pagamento, devidamente acrescido dos encargos contratuais. 

    Vosso silêncio será interpretado como desinteresse, obrigando-nos a tomar as medidas judiciais cabíveis, com todos os ônus daí decorrentes. 

Atenciosamente </span><br><br><br><br><br><br>


<center><strong>______________________________________________________<br></strong>
Loteamento: $descricao_empreendimento
</center>


<br> <br> 

<div style='font-size:12px; text-align:center; position: absolute;
  bottom: 0;'>Caldas Novas - GO</div>
</div>
";

                   }

 }
  

$dompdf->load_html($html);
  $dompdf->set_paper("A4");
  ob_clean();

  $pdf = $dompdf->render();
  $canvas = $dompdf->get_canvas(); 
  $font = Font_Metrics::get_font("helvetica", "bold"); 
  $canvas->page_text(510, 18, "", $font, 6, array(0,0,0)); 
  header("Content-type: application/pdf");     
 
 
$dompdf->stream(
    "saida.pdf", 
    array(
        "Attachment" => false 
    )
);


?>
