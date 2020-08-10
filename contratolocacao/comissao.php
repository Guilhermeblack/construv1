<?php ob_start();
error_reporting(0);
ini_set(“display_errors”, 0 );

function dados_contrato($idparcelas){
  include "../conexao.php";

  $busca_cliente = "SELECT * FROM parcelas
                    INNER JOIN venda ON parcelas.venda_idvenda = venda.idvenda 
                    INNER JOIN lote ON venda.lote_idlote = lote.idlote 
                    INNER JOIN produto ON venda.produto_idproduto = produto.idproduto 
                    INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                    INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                    WHERE idparcelas = $idparcelas";
  $executa_query = mysqli_query($db, $busca_cliente);

  while ($busca_dados = mysqli_fetch_assoc($executa_query)) {
        
         $quadra                    = $busca_dados['quadra'];
         $lote                      = $busca_dados['lote'];
         $numero_sequencia          = $busca_dados['numero_sequencia'];
         $descricao_empreendimento  = $busca_dados['descricao_empreendimento'];
         $valor_desconto            = $busca_dados['valor_desconto'];
         $data_venda                = $busca_dados['data_venda'];
         
  }


        $dados["quadra"]                      = $quadra;
        $dados["lote"]                        = $lote;
        $dados["numero_sequencia"]            = $numero_sequencia;
        $dados["descricao_empreendimento"]    = $descricao_empreendimento;
        $dados["valor_desconto"]              = $valor_desconto;
        $dados["data_venda"]                  = $data_venda;
       

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

$horario_relatorio = date('d-m-Y H:i:s');


  $situacao   = $_GET["situacao"];  
  $cliente_id = $_GET["cliente_id"];  
  $teste      = $_GET["teste"];  
  
  $start      = $_GET["start"];
  $end        = $_GET["end"];

if($cliente_id != ""){
    $where .=" AND cliente_id_novo = ".$cliente_id;
}

if($teste != ""){
  $where .=" AND empreendimento_id_novo = ".$teste;
}

if($start != '' and $end != ''){
   $where .= " AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$start."' and '".$end."' ";
}
  
 // codigo para titulo do relatorio

if($start != '' and $end != ''){
       $exibir_ini  = date("d-m-Y", strtotime($start));
       $exibir_fim  = date("d-m-Y", strtotime($end));

$exibir_titulo = ' de '.$exibir_ini.' até '.$exibir_fim;
}


require_once("dompdf/dompdf_config.inc.php");
 
/* Cria a instância */
$dompdf = new DOMPDF();
 
 if($teste != ''){
  include "../conexao.php";
            $query_amigo = "SELECT * FROM empreendimento_cadastro                            
                            WHERE idempreendimento_cadastro = $teste";
                           
            $executa_query = mysqli_query ($db,$query_amigo);
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            $descricao_empreendimento       = $buscar_amigo['descricao_empreendimento'];

          }
    }
 
      $html = "<table style='width:100%' border='0' align='center'>

    <tr>
      <td style='width:20%'><img src='../fotos/hr.png' ></td>
      <td style='width:60%'><center><h4>RELATÓRIO DE COMISSÃO DE VENDAS</h4>
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
      <td style='text-align: center'><strong>Data Venda</strong></td>
      <td style='text-align: center'><strong>Empreendimento</strong></td>
      <td style='text-align: center'><strong>Quadra</strong></td>
      <td style='text-align: center'><strong>Lote</strong></td>
      <td style='text-align: center'><strong>Valor Venda</strong></td>
      <td style='text-align: center'><strong>Comissão R$</strong></td>
      <td style='text-align: center'><strong>Vencimento</strong></td>
      <td style='text-align: center'><strong>Situação</strong></td>

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
                      WHERE fluxo = 1 AND descricao = 'Comissao'  $where order by cliente_id_novo, venda_idvenda, venc Asc";
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


              $quadra                     = $dados_contrato["quadra"];
              $lote                       = $dados_contrato["lote"];
              $numero_sequencia           = $dados_contrato["numero_sequencia"];
              $descricao_empreendimento   = $dados_contrato["descricao_empreendimento"];
              $valor_desconto             = $dados_contrato["valor_desconto"];
              $data_venda                 = $dados_contrato["data_venda"];


              $exibir_vencimento  = date("d-m-Y", strtotime($data_vencimento_tratada));

              $diferenca = strtotime($hoje) - strtotime($data_vencimento_tratada);

              $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias


              $valor_multa = (2/100);
              $valor_juros = (0.033/100);

              $multa = ($valor_parcelas * $valor_multa);
              $juros = ($valor_parcelas * $valor_juros * $dias);

              $valor_multa_juros =   $valor_parcelas + $multa + $juros;
              
              $e_valor_desconto = number_format($valor_desconto, 2, ',', '.');
              $e_valor_parcelas = number_format($valor_parcelas, 2, ',', '.');

           

         
if($cliente_id_novo != $cliente_ant){



if($cont_linha > 0){
       

 $cont_e = number_format($cont, 2, ',', '.');

  $html .="<tr><td colspan='7' align='right'> <strong>Subtotal do Cliente:</strong></td>
  <td style='text-align: center'><strong> $cont_e</strong></td>
  </tr>";
  $cont = 0;

}

$html .= "<tr bgcolor='#b8b8b8'>
      <td colspan='5'><strong>Nome:</strong> $nome_cli</td>
      
      <td colspan='3'><strong>Telefone: </strong> $telefone1_cli / $telefone2_cli</td>
      
    </tr>";

      $cliente_ant = $cliente_id_novo;

  }


   $html .="<tr>
      <td style='text-align: center'>$data_venda</td>
      <td style='text-align: center'>$descricao_empreendimento</td>
      <td style='text-align: center'>$quadra</td>
      <td style='text-align: center'>$lote</td>
      <td style='text-align: center'>$e_valor_desconto</td>
      <td style='text-align: center'>$e_valor_parcelas</td>
      <td style='text-align: center'>$exibir_vencimento</td>
      <td style='text-align: center'>$situacao</td>";
        $cont      = $cont + $valor_multa_juros;
      

        $cont_geral = $cont_geral + $valor_multa_juros;

     

    $cont_linha = $cont_linha + 1;


}




        $cont_e = number_format($cont, 2, ',', '.');
       


  $html .="<tr>
  <td colspan='7' align='right'><strong> Subtotal do Cliente:</strong></td>
  <td style='text-align: center'><strong> $cont_e</strong></td>

  </tr>";


        $cont_geral_e = number_format($cont_geral, 2, ',', '.');

    $html .="<tr>
  <td colspan='7' align='right'><strong> Total Geral:</strong></td>
  <td style='text-align: center'><strong> $cont_geral_e</strong></td>

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
