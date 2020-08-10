<?php ob_start();
 error_reporting(0);
ini_set(“display_errors”, 0 );
/* Carrega a classe DOMPdf */
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
$query_amigo = "SELECT * FROM locacao
                 INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel
                 INNER JOIN cliente ON locacao.cliente_idcliente = cliente.idcliente
                 WHERE idimovel = $idimovel";


        
                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos


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









$html = "<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>Contrato de Locação</title>

</head>

<body style='font-size:10px'>
<p align='center'><a name='_Hlk489452892'><strong><u><h1>VISTORIA</h1></u></strong></a></p>
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
                                WHERE locacao_idlocacao='.$idlocacao;
             
              
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

  $html .="
<h2> Fiador(a) $cont: </h2>
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

<h3>Declaramos que o imóvel em epígrafe, alugado nesta data foi vistoriado pelas partes, encontrando-se no seguinte estado:</h3><br><br>";


            $query_slide = mysqli_query($db, "SELECT * FROM vistoria
                                    WHERE idlocacao = $idlocacao group by codigo") or die ("Erro ao listar fotos, tente mais tarde"); 


            while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria
           
             $idvistoria         = $buscar_slide["idvistoria"];
             $titulo                = $buscar_slide["titulo"];
             $codigo                = $buscar_slide["codigo"];
             $descricao_vistoria    = $buscar_slide["descricao_vistoria"];
          

                    
$html .="<table width='500' border='0' align='center'>
  <tbody>
    <tr>
      <td colspan='4'><p align='center'><h2>$titulo</h2></p>$descricao_vistoria </td>
    </tr>
    <tr>";
  $query_url = mysqli_query($db, "SELECT * FROM vistoria
                                    WHERE codigo = $codigo") or die ("Erro ao listar fotos, tente mais tarde"); 


            while ($buscar_url = mysqli_fetch_assoc($query_url)) {//--While categoria
           
             $url         = $buscar_url["url"];
            


    $html .="<td width='124'> <img src='../fotos/vistoria/$idlocacao/$url' width='150' height='150' /></td>";
  }
      
    $html .="</tr>
  </tbody>
</table><br><br><br><br><br><br>";


}




$html .="<p>OBSERVAÇÃO: O(s) locatário(s), ao término da locação, se compromete a devolver ao locador o imóvel objeto desta vistoria cm todos os acessórios relacionados no estado em que ora os recebe:</p>
<p>&nbsp;</p>
<p>Franca, $dia de $mes_nome de $ano <br>
  <br>
</p>
<table width='500' border='0' align='center'>
  <tbody>
    <tr>
      <td width='250'><p align='center'>______________________________________</p>
      <p align='center'>Locatário  (a): $nome_cli</p></td>
      <td width='250'><p align='center'>______________________________________</p>
      <p align='center'>Locatário  (a): $nome_con</p></td>
    </tr>
    <tr>
      <td width='250'><p align='center'>_____________________________________</p>
      <p align='center'> Locador (a): $nome_loc</p></td>
      <td width='250'><p align='center'>_____________________________________</p>
      <p align='center'>Locador  (a): $nome_con_loc</p></td>
    </tr>
    <tr>
      <td width='250'><p align='center'>______________________________________</p>
      <p align='center'>Fiador  (a) $nome_fia</p></td>
      <td width='250'><p align='center'>______________________________________</p>
      <p align='center'>Fiador  (a) $nome_con_fia</p></td>
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

//echo ($html); die();
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
