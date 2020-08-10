<?php ob_start();
error_reporting(0);
ini_set(“display_errors”, 0 );

set_time_limit(0);
ini_set("upload_max_filesize", "10M");
ini_set("max_execution_time", "800");
ini_set("memory_limit", "-1");
ini_set("realpath_cache_ttl", "120");

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


    
$where = " AND idparcelas > 0";


   
date_default_timezone_set('America/Sao_Paulo');               
$hoje = date('Y-m-d');
$hoje = date('Y-m-d',strtotime($hoje . "-1 days"));
$inicio = date('Y-m-d',strtotime($hoje . "-90 days"));

$horario_relatorio = date('d-m-Y H:i:s');


  $situacao   = $_GET["situacao"];  
  $cliente_id = $_GET["cliente_id"];  
  $teste      = $_GET["teste"];  

if($cliente_id != ""){
    $where .=" AND cliente_id_novo = ".$cliente_id;
}

  $where .=" AND empreendimento_id_novo = ".$teste;

if($situacao == '4'){
    $start = $_GET["start"];
    $end   = $_GET["end"];
}
  
if($situacao == '4'){
  $where .= " AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$start."' and '".$end."' ";
}else{
  $where .= " AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$hoje."' ";
}          
    



// codigo para titulo do relatorio

if($situacao == '1'){
  $exibir_titulo = 'Ultimos 90 dias';
}elseif($situacao == '2'){
  $exibir_titulo = 'Ultimos 60 dias';
}elseif($situacao == '3'){
  $exibir_titulo = 'Ultimos 30 dias';
}else{

       $exibir_ini  = date("d-m-Y", strtotime($start));
       $exibir_fim  = date("d-m-Y", strtotime($end));

$exibir_titulo = ' de '.$exibir_ini.' até '.$exibir_fim;
}








require_once("dompdf/dompdf_config.inc.php");
 
/* Cria a instância */
$dompdf = new DOMPDF();
 
  include "../conexao.php";
            $query_amigo = "SELECT * FROM empreendimento_cadastro                            
                            WHERE idempreendimento_cadastro = $teste";
                           
            $executa_query = mysqli_query ($db,$query_amigo);
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            $descricao_empreendimento       = $buscar_amigo['descricao_empreendimento'];
            $empreendimento_id = $buscar_amigo["idempreendimento_cadastro"];
            $img = $buscar_amigo["img_lote"];

          }
 
      $html = "<table style='width:100%' border='0' align='center'>

    <tr>
      <td style='width:20%'><img src='../img/$empreendimento_id/$img' height='110' /></td>
      <td style='width:60%'><center><h4>RELATÓRIO DE INADIMPLENTES</h4>
              <strong>Empreendimento:</strong>$descricao_empreendimento<br>
              <strong>Período: </strong>$exibir_titulo<br>
              <strong>Emissão: </strong>$horario_relatorio

              </center>
      </td>
      <td style='width:20%'>&nbsp;</td>
    </tr>

</table><br><br>

<table style='width:100%' height='127' border='0'>

    <tr bgcolor='#b8b8b8'>
      <td style='text-align: center'><strong>Quadra</strong></td>
      <td style='text-align: center'><strong>Lote</strong></td>
      <td style='text-align: center'><strong>Parcela</strong></td>
      <td style='text-align: center'><strong>Vencto</strong></td>
      <td style='text-align: center'><strong>Atraso</strong></td>
      <td style='text-align: center'><strong>Valor</strong></td>
      <td style='text-align: center'><strong>Multa</strong></td>
      <td style='text-align: center'><strong>Juros</strong></td>
      <td style='text-align: center'><strong>Total</strong></td>
    </tr>";


$cliente_ant = 0;
$cont = 0;
$cont_linha =0;
$venda_ant = 0;
$cont_lote = 0;

$cont_multa = 0;
$cont_juros = 0;
$cont_multa_juros = 0;

$cont_geral = 0;

$hoje = date('Y-m-d');
  include "../conexao.php";
            $query = "SELECT parcelas.idparcelas, parcelas.tipo_venda, parcelas.venda_idvenda, parcelas.valor_recebido, parcelas.valor_parcelas, parcelas.data_recebimento,parcelas.situacao,parcelas.cod_baixa,parcelas.cliente_id_novo, parcelas.forma_pagamento, STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') as venc 
                      FROM parcelas  
                      WHERE fluxo = 0 AND situacao = 'Em Aberto' AND tipo_venda = 2 $where order by cliente_id_novo, venda_idvenda, venc Asc";
            $executa_query = mysqli_query ($db,$query) or die ("Erro ao listar empreendimento");
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos


              $idparcelas                 = $buscar_amigo["idparcelas"];
              $venda_idvenda              = $buscar_amigo["venda_idvenda"];
              $cliente_id_novo            = $buscar_amigo["cliente_id_novo"];            
              $valor_parcelas             = $buscar_amigo["valor_parcelas"];


              $data_vencimento_tratada    = $buscar_amigo["venc"];
              $situacao                   = $buscar_amigo["situacao"];
              $descricaocentro            = $buscar_amigo["descricaocentro"];
              $tipo_venda_result          = $buscar_amigo["tipo_venda"];

              $dados_cliente  =  dados_cliente($cliente_id_novo); 


              $nome_cli           = $dados_cliente["nome_cli"];
              $cpf_cli            = $dados_cliente["cpf_cli"];
              $rg_cli             = $dados_cliente["rg_cli"];
              $nacionalidade_cli  = $dados_cliente["nacionalidade_cli"];
              $profissao_cli      = $dados_cliente["profissao_cli"];
              $estadocivil_cli    = $dados_cliente["estadocivil_cli"];
              $insc_municipal_cli = $dados_cliente["insc_municipal"];
              $endereco_cli       = $dados_cliente["endereco_cli"];
              $bairro_cli         = $dados_cliente["bairro_cli"];
              $cidade_cli         = $dados_cliente["cidade_cli"];
              $estado_cli         = $dados_cliente["estado_cli"];
              $email_cli          = $dados_cliente["email_cli"];
              $cep_cli            = $dados_cliente["cep_cli"];
              $telefone1_cli      = $dados_cliente["telefone1_cli"];
              $telefone2_cli      = $dados_cliente["telefone2_cli"];
              $renda_total_cli    = $dados_cliente["renda_total"];
              $numero_cli         = $dados_cliente["numero_cli"];
              $nascimento_cli     = $dados_cliente["nascimento_cli"];

              $dados_contrato  =  dados_contrato($idparcelas); 


              $quadra = $dados_contrato["quadra"];
              $lote   = $dados_contrato["lote"];
              $numero_sequencia   = $dados_contrato["numero_sequencia"];


              $exibir_vencimento  = date("d-m-Y", strtotime($data_vencimento_tratada));

              $diferenca = strtotime($hoje) - strtotime($data_vencimento_tratada);

              $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias


              $valor_multa = (2/100);
              $valor_juros = (0.033/100);

              $multa = ($valor_parcelas * $valor_multa);
              $juros = ($valor_parcelas * $valor_juros * $dias);

              $valor_multa_juros =   $valor_parcelas + $multa + $juros;
              
             
           

         
if($cliente_id_novo != $cliente_ant){



if($cont_linha > 0){
        $cont_lote_e = number_format($cont_lote, 2, ',', '.');
        $cont_multa_e = number_format($cont_multa, 2, ',', '.');
        $cont_juros_e = number_format($cont_juros, 2, ',', '.');
        $cont_multa_juros_e = number_format($cont_multa_juros, 2, ',', '.');

 $html .="<tr>
  <td colspan='5' align='right'><strong>Subtotal do Lote:</strong></td>
  <td style='text-align: center'><strong>  $cont_lote_e </strong></td>
  <td style='text-align: center'><strong>$cont_multa_e</strong></td>
  <td style='text-align: center'><strong>$cont_juros_e</strong></td>
  <td style='text-align: center'><strong>$cont_multa_juros_e</strong></td>
  </tr>";

  $cont_lote = 0;
  $cont_linha =0;

  $cont_multa =0;
  $cont_juros =0;
  $cont_multa_juros =0;
        $cont_e = number_format($cont, 2, ',', '.');

  $html .="<tr><td colspan='8' align='right'> <strong>Subtotal do Cliente:</strong></td>
  <td style='text-align: center'><strong> $cont_e</strong></td>
  </tr>";
  $cont = 0;

}

$html .= "<tr bgcolor='#b8b8b8'>
      <td colspan='5'><strong>Nome:</strong> $nome_cli</td>
      
      <td colspan='4'><strong>Telefone: </strong> $telefone1_cli / $telefone2_cli</td>
      
    </tr>";

      $cliente_ant = $cliente_id_novo;

  }
if($venda_ant != $venda_idvenda AND $cont_linha > 0){
        $cont_lote_e = number_format($cont_lote, 2, ',', '.');
         $cont_multa_e = number_format($cont_multa, 2, ',', '.');
        $cont_juros_e = number_format($cont_juros, 2, ',', '.');
        $cont_multa_juros_e = number_format($cont_multa_juros, 2, ',', '.');

  $html .="<tr>
  <td colspan='5' align='right'><strong>Subtotal do Lote:</strong></td>
  <td style='text-align: center'><strong>  $cont_lote_e </strong></td>
    <td style='text-align: center'><strong> $cont_multa_e</strong></td>
  <td style='text-align: center'><strong> $cont_juros_e</strong></td>
  <td style='text-align: center'><strong> $cont_multa_juros_e</strong></td>
  </tr>";
  $cont_lote = 0;
  $cont_multa = 0;
  $cont_juros = 0;
  $cont_multa_juros = 0;

}

   $html .="<tr>
      <td style='text-align: center'>$quadra</td>
      <td style='text-align: center'>$lote</td>
      <td style='text-align: center'>$numero_sequencia</td>
      <td style='text-align: center'>$exibir_vencimento</td>
      <td style='text-align: center'>$dias</td>";
        $cont      = $cont + $valor_multa_juros;
        $cont_lote = $cont_lote + $valor_parcelas;
        $cont_multa = $cont_multa + $multa;
        $cont_juros = $cont_juros + $juros;
        $cont_multa_juros = $cont_multa_juros + $valor_multa_juros;

        $cont_geral = $cont_geral + $valor_multa_juros;

        $valor_parcelas_e = number_format($valor_parcelas, 2, ',', '.');

        $multa_e = number_format($multa, 2, ',', '.');
        $juros_e = number_format($juros, 2, ',', '.');
        $multa_juros_e = number_format($valor_multa_juros, 2, ',', '.');

      $html .="<td style='text-align: center'>$valor_parcelas_e</td>
      <td style='text-align: center'>$multa_e</td>
      <td style='text-align: center'>$juros_e</td>
      <td style='text-align: center'>$multa_juros_e</td>
    </tr>";



    $venda_ant = $venda_idvenda;
    $cont_linha = $cont_linha + 1;


}



        $cont_lote_e = number_format($cont_lote, 2, ',', '.');

        $cont_e = number_format($cont, 2, ',', '.');
        $cont_multa_e = number_format($cont_multa, 2, ',', '.');
        $cont_juros_e = number_format($cont_juros, 2, ',', '.');
        $cont_multa_juros_e = number_format($cont_multa_juros, 2, ',', '.');


 $html .="<tr>
  <td colspan='5' align='right'><strong>Subtotal do Lote:</strong></td>
  <td style='text-align: center'><strong>  $cont_lote_e </strong></td>
  <td style='text-align: center'><strong>$cont_multa_e</strong></td>
  <td style='text-align: center'><strong>$cont_juros_e</strong></td>
  <td style='text-align: center'><strong>$cont_multa_juros_e</strong></td>
  </tr>";



  $html .="<tr>
  <td colspan='8' align='right'><strong> Subtotal do Cliente:</strong></td>
  <td style='text-align: center'><strong> $cont_e</strong></td>

  </tr>";


        $cont_geral_e = number_format($cont_geral, 2, ',', '.');

    $html .="<tr>
  <td colspan='8' align='right'><strong> Total Geral:</strong></td>
  <td style='text-align: center'><strong> $cont_geral_e</strong></td>

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
