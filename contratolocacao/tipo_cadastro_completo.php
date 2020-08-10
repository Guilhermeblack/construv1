<?php ob_start();
error_reporting(0);
ini_set(“display_errors”, 0 );


// echo "<pre>";
// print_r($_GET);
// echo "</pre>";


if(isset($_GET['tipo_cadastro'])){
$todos = count($_GET['tipo_cadastro']);

//echo $todos; 

 }else{
  $todos = 0;
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


function verifica_conjuge($idcliente){
  include "../conexao.php";

  $busca_cliente = "SELECT conjuge_idconjuge FROM conjuge WHERE cliente_idcliente = $idcliente";
  $executa_query = mysqli_query($db, $busca_cliente);

  while ($busca_dados = mysqli_fetch_assoc($executa_query)) {
        
         $conjuge_idconjuge          = $busca_dados['conjuge_idconjuge'];
  }

  return $conjuge_idconjuge;
  
}       

 $inicio = $_GET['inicio'];
 $fim = $_GET['fim'];


   if(isset($_GET['tipo_cadastro'])){
          $guarda_array = $_GET['tipo_cadastro'];
    }
    if($todos > 0){
          $where = ' cliente.idcliente > 0 ';
              $where .= "AND (tipo_cliente.descricao_tipo='" . $_GET['tipo_cadastro'][0] ."'";
       
      if($inicio != '' && $fim != ''){
             
             $novo_array = array_shift($_GET['tipo_cadastro']);

           foreach ($_GET['tipo_cadastro'] as $cad_tipo) {
             // echo "entrei aqui ";
           
              $where .= " OR  tipo_cliente.descricao_tipo='" . $cad_tipo ."' ";


           }
      
           $where .= ") AND STR_TO_DATE(cliente.data_cadastro, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";
      } else {

              foreach ($_GET['tipo_cadastro'] as $cad_tipo) {
                   $where .= " OR  tipo_cliente.descricao_tipo='" . $cad_tipo ."' ";
              }
          $where .= ")";

      }

    }


    if($todos <= 0){
        $where = ' cliente.idcliente > 0 ';

          $where .= " AND STR_TO_DATE(cliente.data_cadastro, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";

    }





      







require_once("dompdf/dompdf_config.inc.php");
 
/* Cria a instância */
$dompdf = new DOMPDF();
  include "../conexao.php";

if($todos == 14){

   $por_cadastro = "Geral";

}else{

if(isset($_GET['tipo_cadastro'])){
//print_r($guarda_array);
$por_cadastro = implode(',', $guarda_array);
$por_cadastro = str_replace(',', "  |  ", $por_cadastro);
//echo "<br>"  . $por_cadastro;
}else{
  $por_cadastro = "DE :  " . $inicio . "  ate "  . $fim ;
}

}

 $html = "<table style='width:100%' border='0 align='center'>

    <tr>
      
      
      <td style='width:60%'><center><h4>RELATÓRIO DE TIPO CADASTRO<br><h5>$por_cadastro</h5> </h4></center>
    
              </center>
      </td>
      <td style='width:20%'>&nbsp;</td>

    </tr>


</table><br><br>";

 
            $query_amigo = "SELECT * FROM cliente INNER JOIN cliente_tipo ON cliente.idcliente = cliente_tipo.idcliente INNER JOIN tipo_cliente ON cliente_tipo.idtipo = tipo_cliente.idtipo
                            WHERE $where  GROUP BY cliente.idcliente  ORDER BY cliente.data_cadastro DESC" ;
            
            //echo $query_amigo; die();

            $executa_query = mysqli_query ($db,$query_amigo);
            
            while ($busca_dados = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           

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
                     $telefone3_cli      = $busca_dados['telefone3_cli'];
                     $data_cadastro      = $busca_dados['data_cadastro'];
                     $cpf_cli            = $busca_dados['cpf_cli'];
                     $rg_cli             = $busca_dados['rg_cli'];
                     $nascimento_cli     = $busca_dados['nascimento_cli'];
                     $profissao_cli      = $busca_dados['profissao_cli'];
                     $estadocivil_cli    = $busca_dados['estadocivil_cli'];
                     $nacionalidade_cli  = $busca_dados['nacionalidade_cli'];
                     $descricao_tipo     = $busca_dados['descricao_tipo'];




$html .= "<table border='0' style='width:100%'>";


$html .="
    <tr>
      <td colspan='5'><strong>Data Cadastro:</strong> $data_cadastro </td>
    </tr>
    <tr>
      <td colspan='5'><strong>Nome:</strong> $nome_cli </td>
    </tr>
    <tr>
      <td colspan='5'><strong>Tipo Cadastro:</strong> $descricao_tipo </td>
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
  


    $html .="</table>";

   $html .="<hr style='width:100%'></hr>";


          }


echo $html;



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
