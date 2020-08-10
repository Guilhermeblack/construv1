<?php ob_start();
error_reporting(0);
ini_set(“display_errors”, 0 );
require_once("dompdf/dompdf_config.inc.php");

  $dompdf = new DOMPDF();
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


function verifica_conjuge($idcliente){
  include "../conexao.php";

  $busca_cliente = "SELECT conjuge_idconjuge FROM conjuge WHERE cliente_idcliente = $idcliente";
  $executa_query = mysqli_query($db, $busca_cliente);

  while ($busca_dados = mysqli_fetch_assoc($executa_query)) {
        
         $conjuge_idconjuge          = $busca_dados['conjuge_idconjuge'];
  }

  return $conjuge_idconjuge;
  
}       

     $empreendimento_id = $_GET["empreendimento_id"];
    

     if(isset($_GET["lote"])){
      $lote             = $_GET["lote"];
    }else{
      $lote = 0;
    }


      if(isset($_GET["quadra"])){
      $quadra_id        = $_GET["quadra"];
    }else{
      $quadra_id = 0;
    }
  


      $where = "idvenda > 0";

     

      

      

      if($lote != '0'  AND $lote != ''){
        $where .= " AND lote_idlote = ".$lote;
      }
      
      if($quadra_id != '0' AND $quadra_id != ''){
        $where .= " AND produto_idproduto = ".$quadra_id;
      }

     
       if($empreendimento_id != ''){
        $where .= " AND empreendimento_cadastro_id = ".$empreendimento_id;
      }



 
  include "../conexao.php";
            $query_amigo = "SELECT * FROM venda
                            INNER JOIN lote ON venda.lote_idlote = lote.idlote
                            INNER JOIN produto ON venda.produto_idproduto = produto.idproduto 
                            INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                            INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                            WHERE $where order by quadra, lote Asc";
                           
            $executa_query = mysqli_query ($db,$query_amigo);
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            $descricao_empreendimento       = $buscar_amigo['descricao_empreendimento'];

          }
 
      $html = "<table style='width:100%' border='0' align='center'>

    <tr>
      <td style='width:20%'><img src='../fotos/hr.png' ></td>
      <td style='width:60%'><center><h4>RELATÓRIO DE CLIENTES</h4>
              <strong>Empreendimento:</strong>$descricao_empreendimento
              </center>
      </td>
      <td style='width:20%'>&nbsp;</td>
    </tr>

</table><br><br>";



  include "../conexao.php";
            $query_amigo = "SELECT * FROM venda
                            INNER JOIN lote ON venda.lote_idlote = lote.idlote
                            INNER JOIN produto ON venda.produto_idproduto = produto.idproduto 
                            INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                            INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                            WHERE $where order by quadra, lote Asc";
                           
            $executa_query = mysqli_query ($db,$query_amigo);
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
            $descricao_empreendimento       = $buscar_amigo['descricao_empreendimento'];
            $quadra               = $buscar_amigo["quadra"];
            $lote                 = $buscar_amigo["lote"];
            $cliente_idcliente    = $buscar_amigo["cliente_idcliente"];


            $dados_cliente    = dados_cliente($cliente_idcliente);
            $verifica_conjuge = verifica_conjuge($cliente_idcliente);

            if($verifica_conjuge != ''){
              $dados_conjuge = dados_cliente($verifica_conjuge);
            }

            if($dados_cliente["fisico_juridico"] == 2){
              $mostra_tipo = 'Juridica';
            }else{
              $mostra_tipo = 'Fisia';

            }


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


          $nome_con           = $dados_conjuge["nome_cli"];
          $cpf_con            = $dados_conjuge["cpf_cli"];
          $rg_con             = $dados_conjuge["rg_cli"];
          $nacionalidade_con  = $dados_conjuge["nacionalidade_cli"];
          $profissao_con      = $dados_conjuge["profissao_cli"];
          $nascimento_con     = $dados_conjuge["nascimento_cli"];










$html .= "<table border='0' style='width:100%'>";


$html .="<tr>
      <td width='83'><strong>Quadra:</strong> $quadra </td>
      <td width='85'>&nbsp;</td>
      <td width='106'><strong>Lote:</strong> $lote</td>
      <td width='88'>&nbsp;</td>
      <td width='60'>&nbsp;</td>
      <td width='182'>&nbsp;</td>
    </tr>
    <tr>
      <td colspan='5'><strong>Nome:</strong> $nome_cli </td>
      <td><strong>Tipo Pessoa:</strong> $mostra_tipo</td>
    </tr>
    <tr>
      <td colspan='4'><strong>Endereço:</strong> $endereco_cli , $numero_cli </td>
      <td colspan='2'><strong>Bairro:</strong> $bairro_cli </td>
    </tr>
    <tr>
      <td colspan='2'><strong>Cidade:</strong> $cidade_cli</td>
      <td><strong>Cep:</strong> $cep_cli</td>
      <td><strong>Estado:</strong> $estado_cli </td>
      <td colspan='2'> </td>
    </tr>
    <tr>
      <td colspan='3'><strong>Telefone 1:</strong> $telefone1_cli</td>
      <td colspan='3'><strong>Telefone 2:</strong> $telefone2_cli</td>
   
    </tr>
      <tr>
      <td colspan='6'><strong>Email:</strong> $email_cli</td>
   
    </tr>
    <tr>
      <td colspan='2'><strong>CPF/CNPJ:</strong> $cpf_cli</td>
      <td colspan='2'><strong>RG:</strong> $rg_cli</td>
     
      <td colspan='2'><strong>Nascimento:</strong> $nascimento_cli</td>
    </tr>
    <tr>
      <td colspan='3'><strong>Profissão:</strong> $profissao_cli</td>
      <td colspan='3'><strong>Estado Civil:</strong> $estadocivil_cli</td>
     
    </tr>";
    if ($verifica_conjuge == ''){ 
    $html .="<tr>
      <td colspan='2'></td>
      <td colspan='2'></td>
      <td colspan='2'></td>
    </tr>";
}


    if($verifica_conjuge != ''){ 
    $html .="<tr>
      <td colspan='6'><strong>Cônjuge</strong>:</td>
    </tr>
    <tr>
      <td colspan='4'><strong>Nome:</strong> $nome_con</td>
      <td colspan='2'><strong>Data Nascimento:</strong> $nascimento_con</td>
    </tr>
    <tr>
      <td colspan='2'><strong>CPF:</strong> $cpf_con</td>
      <td colspan='2'><strong>RG:</strong> $rg_con</td>
      <td colspan='2'><strong>Profissão:</strong> $profissao_con</td>
    </tr>";

  }

    $html .="</table>";

   $html .="<hr style='width:100%'></hr>";

}



print_r($html); die();
$dompdf->load_html($html);
  $dompdf->set_paper("A4");
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
