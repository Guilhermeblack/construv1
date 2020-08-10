<?php
error_reporting(0);
ini_set(“display_errors”, 0 );
/*
* @descr: Gera o arquivo de remessa para cobranca no padrao CNAB 400 vers. 7.0 ITAU
*/


function remover_acentos($str) { 
  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', '?', '?', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', 'Œ', 'œ', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'Š', 'š', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Ÿ', 'Z', 'z', 'Z', 'z', 'Ž', 'ž', '?', 'ƒ', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?', 'ç', 'Ç', "'"); 
  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o','c','C', " "); 
  return str_replace($a, $b, $str); 
} 





 function dados_info_cliente($idcliente)
{


       include "conexao.php";
       $query_amigo = "SELECT * FROM cliente where idcliente = $idcliente";

       $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar nome da imobiliaria");
                
          while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
            {                 
                  $nome_cli               = $buscar_amigo["nome_cli"];                 
                  $cpf_cli                = $buscar_amigo["cpf_cli"];                 
                  $endereco_cli           = $buscar_amigo["endereco_cli"];                 
                  $cidade_cli             = $buscar_amigo["cidade_cli"];                 
                  $cep_cli                = $buscar_amigo["cep_cli"];                 
                  $estado_cli             = $buscar_amigo["estado_cli"];
                  $cpf_rfb                = $buscar_amigo["cpf_rfb"];

            $cpf_cli_tratado  =  $cpf_cli;
            $cpf_cli_tratado  = str_replace(".", "", $cpf_cli_tratado);
            $cpf_cli_tratado  = str_replace("-", "", $cpf_cli_tratado);
            $cpf_cli_tratado  = str_replace("/", "", $cpf_cli_tratado);

            $cpf_rfb  = str_replace(".", "", $cpf_rfb);
            $cpf_rfb  = str_replace("-", "", $cpf_rfb);
            $cpf_rfb  = str_replace("/", "", $cpf_rfb);

             $cep_cli   = str_replace(".", "", $cep_cli);
             $cep_cli   = str_replace("-", "", $cep_cli);


                  $dados["cpf_rfb"]       = $cpf_rfb;
                  $dados["nome_cli"]      = $nome_cli;
                  $dados["cpf_cli"]       = $cpf_cli_tratado;
                  $dados["endereco_cli"]  = $endereco_cli;
                  $dados["cidade_cli"]    = $cidade_cli;
                  $dados["cep_cli"]       = $cep_cli;
                  $dados["estado_cli"]    = $estado_cli;
                            
          }
    
    return $dados;

}

function busca_socio($idimovel, $idproprietario)
{
      
     
       include "conexao.php";
       $busca_socio = "SELECT * FROM proprietarios 
                       WHERE imovel_id = $idimovel AND proprietario_id = $idproprietario";

       $executa_query = mysqli_query ($db,$busca_socio) or die ("Erro ao buscar socio");
                
       $total = mysqli_num_rows($executa_query);

        while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
          {                 
            $percentual               = $buscar_amigo["percentual"];                
                            
          }

          $dados["total"]      = $total;
          $dados["percentual"] = $percentual;
    
    return $dados;

}


 function valor_pago($idlocacao, $idcliente, $ano_pesquisa, $mes_pesquisa, $percentual)
{
      $inicio = $ano_pesquisa.'-'.$mes_pesquisa.'-01';
      $fim    = $ano_pesquisa.'-'.$mes_pesquisa.'-31';



      $situacao_and =" AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";

      
       include "conexao.php";
       $query_amigo = "SELECT valor_parcelas FROM parcelas 
                       where fluxo = 0 AND situacao = 'Pago' AND venda_idvenda = $idlocacao AND descricao = 'Aluguel' AND tipo_venda = 1 $situacao_and";

       $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar nome da imobiliaria");
                
          while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
          {                 
            $valor_parcelas               = $buscar_amigo["valor_parcelas"];                
            $valor_parcelas_percentual  = $valor_parcelas * ($percentual/100);                
                            
          }
    
    return $valor_parcelas_percentual;

}


         




function valor_comissao($idlocacao, $idcliente, $ano_pesquisa, $mes_pesquisa, $percentual)
{
      $inicio = $ano_pesquisa.'-'.$mes_pesquisa.'-01';
      $fim    = $ano_pesquisa.'-'.$mes_pesquisa.'-31';



      $situacao_and =" AND STR_TO_DATE(data_vencimento_parcela, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";

      
       include "conexao.php";
       $query_amigo = "SELECT valor_parcelas FROM parcelas 
                       where cliente_id_novo = $idcliente AND fluxo = 1 AND situacao = 'Pago' AND venda_idvenda = $idlocacao AND descricao = 'Repasse Aluguel' AND tipo_venda = 1 $situacao_and";

       $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar nome da imobiliaria");
                
          while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
          {                 
            $valor_parcelas               = $buscar_amigo["valor_parcelas"];    
                                        
          }


    
    return $valor_parcelas;

}
function limit($palavra,$limite)
{
   if(strlen($palavra) >= $limite)
   {
       $var = substr($palavra, 0,$limite);
   }
   else
   {
       $max = (int)($limite-strlen($palavra));
       $var = $palavra.complementoRegistro($max,"brancos");
   }
   return $var;
}

function sequencial($i)
{
   if($i < 10)
   {
       return zeros(0,5).$i;
   }
   else if($i > 10 && $i < 100)
   {
       return zeros(0,4).$i;
   }
   else if($i > 100 && $i < 1000)
   {
       return zeros(0,3).$i;
   }
   else if($i > 1000 && $i < 10000)
   {
       return zeros(0,2).$i;
   }
   else if($i > 10000 && $i < 100000)
   {
       return zeros(0,1).$i;
   }
}

function zeros($min,$max)
{
   $x = ($max - strlen($min));
   for($i = 0; $i < $x; $i++)
   {
       $zeros .= '0';
   }
   return $zeros.$min;
}

function complementoRegistro($int,$tipo)
{
   if($tipo == "zeros")
   {
       $space = '';
       for($i = 1; $i <= $int; $i++)
       {
           $space .= '0';
       }
   }
   else if($tipo == "brancos")
   {
       $space = '';
       for($i = 1; $i <= $int; $i++)
       {
           $space .= ' ';
       }
   }

   return $space;
}

$fusohorario = 3; // como o servidor de hospedagem é a dreamhost pego o fuso para o horario do brasil
$timestamp = mktime(date("H") - $fusohorario, date("i"), date("s"), date("m"), date("d"), date("Y"));

$DATAHORA['PT'] = gmdate("d/m/Y H:i:s", $timestamp);
$DATAHORA['EN'] = gmdate("Y-m-d H:i:s", $timestamp);
$DATA['PT'] = gmdate("d/m/Y", $timestamp);
$DATA['EN'] = gmdate("Y-m-d", $timestamp);
$DATA['DIA'] = gmdate("d",$timestamp);
$DATA['MES'] = gmdate("m",$timestamp);
$DATA['ANO'] = gmdate("y",$timestamp);
$HORA = gmdate("H:i:s", $timestamp);

define("REMESSA","dimob/",true);



$imobiliaria_id         = $_GET["imobiliaria_id"];  

$empreendedor_id = dados_info_cliente($imobiliaria_id);




$nome_arquivo = date('Y-m-d H:i:s');
        $nome_arquivo = str_replace("-","", $nome_arquivo);
        $nome_arquivo = str_replace(":","", $nome_arquivo);
        $nome_arquivo = str_replace(" ","", $nome_arquivo);
$filename = 'dimob/'.$nome_arquivo.".txt";
$nome_gravar = $nome_arquivo.'.txt';
include "conexao.php";
$insert_dimob = mysqli_query($db, "INSERT INTO dimob (nome_arquivo) values('$nome_gravar')");

$ano_declaracao = $_GET["ano_declaracao"];
$ano_pesquisa = $ano_declaracao;

$conteudo = '';

## REGISTRO HEADER
                          
$conteudo .= 'DIMOB';            
$conteudo .= complementoRegistro(369,"brancos");

$conteudo .= chr(13).chr(10); //essa é a quebra de linha


$conteudo .= 'R01';            
$conteudo .= $empreendedor_id["cpf_cli"]; // CNPJ DO DECLARANTE            
$conteudo .= $ano_declaracao; // ANO DE DECLARACAO           
$conteudo .= '0'; // DECLARACAO RETIFICADORA
$conteudo .= complementoRegistro(10,"brancos");
$conteudo .= '0'; // SITUACAO ESPECIAL
$conteudo .= complementoRegistro(10,"brancos");
$conteudo .= limit($empreendedor_id["nome_cli"],60); // NOME EMPRESARIAL
$conteudo .= $empreendedor_id["cpf_rfb"]; // CPF DO RESPONSAVEL PELA PESSOA JURIDICA PERANTE A RFB  
$conteudo .= limit($empreendedor_id["endereco_cli"],120); // NOME EMPRESARIAL
$conteudo .= $empreendedor_id["estado_cli"]; // Estado 
$conteudo .= '6425'; // Codigo do Municipio (consultar no site) 
$conteudo .= complementoRegistro(30,"brancos");

$conteudo .= chr(13).chr(10); //essa é a quebra de linha




$idlocador     = $_GET["idlocador"];
$dados_locador = dados_info_cliente($idlocador);


$query_amigo = "SELECT * FROM locacao 
                INNER JOIN cliente ON locacao.cliente_idcliente = cliente.idcliente
                INNER JOIN imovel ON locacao.imovel_idimovel = imovel.idimovel
                WHERE dimob = 1";



            include "conexao.php";
            $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar Empreendedor ou empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
                 
            $idlocacao        = $buscar_amigo["idlocacao"];
            $imovel_id        = $buscar_amigo["imovel_idimovel"];

            $busca_socio = busca_socio($imovel_id, $idlocador);

            if($busca_socio["total"] != 0){

            $cliente_idcliente        = $buscar_amigo["cliente_idcliente"];
            $data_venda       = $buscar_amigo["data_venda"];

            $endereco         = $buscar_amigo["endereco"];
            $numero           = $buscar_amigo["numero"];
            $estado           = $buscar_amigo["estado"];
            $cidade_idcidade  = $buscar_amigo["cidade_idcidade"];
            $cep              = $buscar_amigo["cep"];
            $codigo_municipio = $buscar_amigo["codigo_municipio"];
            $imovel_urbano    = $buscar_amigo["imovel_urbano"];


            $nome_cli         = $buscar_amigo["nome_cli"];                 
            $cpf_cli          = $buscar_amigo["cpf_cli"];                 
            
            $endereco = remover_acentos($endereco);
            $cidade_idcidade = remover_acentos($cidade_idcidade);
            
            $data_venda       = str_replace("-", "", $data_venda);

            $cpf_locatario    = str_replace(".", "", $cpf_cli);
            $cpf_locatario    = str_replace("-", "", $cpf_locatario);
            $cpf_locatario    = str_replace("/", "", $cpf_locatario);

             $cep   = str_replace(".", "", $cep);
             $cep   = str_replace("-", "", $cep);



            $aluguel_jan = valor_pago($idlocacao, $idlocador, $ano_pesquisa, '01', $busca_socio["percentual"]); 
            $aluguel_fev = valor_pago($idlocacao, $idlocador, $ano_pesquisa, '02', $busca_socio["percentual"]);
            $aluguel_mar = valor_pago($idlocacao, $idlocador, $ano_pesquisa, '03', $busca_socio["percentual"]);
            $aluguel_abr = valor_pago($idlocacao, $idlocador, $ano_pesquisa, '04', $busca_socio["percentual"]);
            $aluguel_mai = valor_pago($idlocacao, $idlocador, $ano_pesquisa, '05', $busca_socio["percentual"]);
            $aluguel_jun = valor_pago($idlocacao, $idlocador, $ano_pesquisa, '06', $busca_socio["percentual"]);
            $aluguel_jul = valor_pago($idlocacao, $idlocador, $ano_pesquisa, '07', $busca_socio["percentual"]);
            $aluguel_ago = valor_pago($idlocacao, $idlocador, $ano_pesquisa, '08', $busca_socio["percentual"]);
            $aluguel_set = valor_pago($idlocacao, $idlocador, $ano_pesquisa, '09', $busca_socio["percentual"]);
            $aluguel_out = valor_pago($idlocacao, $idlocador, $ano_pesquisa, '10', $busca_socio["percentual"]);
            $aluguel_nov = valor_pago($idlocacao, $idlocador, $ano_pesquisa, '11', $busca_socio["percentual"]);
            $aluguel_dez = valor_pago($idlocacao, $idlocador, $ano_pesquisa, '12', $busca_socio["percentual"]);



            $comissao_aluguel_jan = valor_comissao($idlocacao, $idlocador, $ano_pesquisa, '01',$busca_socio["percentual"]);
            $comissao_aluguel_fev = valor_comissao($idlocacao, $idlocador, $ano_pesquisa, '02',$busca_socio["percentual"]);
            $comissao_aluguel_mar = valor_comissao($idlocacao, $idlocador, $ano_pesquisa, '03',$busca_socio["percentual"]);
            $comissao_aluguel_abr = valor_comissao($idlocacao, $idlocador, $ano_pesquisa, '04',$busca_socio["percentual"]);
            $comissao_aluguel_mai = valor_comissao($idlocacao, $idlocador, $ano_pesquisa, '05',$busca_socio["percentual"]);
            $comissao_aluguel_jun = valor_comissao($idlocacao, $idlocador, $ano_pesquisa, '06',$busca_socio["percentual"]);
            $comissao_aluguel_jul = valor_comissao($idlocacao, $idlocador, $ano_pesquisa, '07',$busca_socio["percentual"]);
            $comissao_aluguel_ago = valor_comissao($idlocacao, $idlocador, $ano_pesquisa, '08',$busca_socio["percentual"]);
            $comissao_aluguel_set = valor_comissao($idlocacao, $idlocador, $ano_pesquisa, '09',$busca_socio["percentual"]);
            $comissao_aluguel_out = valor_comissao($idlocacao, $idlocador, $ano_pesquisa, '10',$busca_socio["percentual"]);
            $comissao_aluguel_nov = valor_comissao($idlocacao, $idlocador, $ano_pesquisa, '11',$busca_socio["percentual"]);
            $comissao_aluguel_dez = valor_comissao($idlocacao, $idlocador, $ano_pesquisa, '12',$busca_socio["percentual"]);

            $result_comissao_jan = $aluguel_jan - $comissao_aluguel_jan;
            $result_comissao_fev = $aluguel_fev - $comissao_aluguel_fev;
            $result_comissao_mar = $aluguel_mar - $comissao_aluguel_mar;
            $result_comissao_abr = $aluguel_abr - $comissao_aluguel_abr;
            $result_comissao_mai = $aluguel_mai - $comissao_aluguel_mai;
            $result_comissao_jun = $aluguel_jun - $comissao_aluguel_jun;
            $result_comissao_jul = $aluguel_jul - $comissao_aluguel_jul;
            $result_comissao_ago = $aluguel_ago - $comissao_aluguel_ago;
            $result_comissao_set = $aluguel_set - $comissao_aluguel_set;
            $result_comissao_out = $aluguel_out - $comissao_aluguel_out;
            $result_comissao_nov = $aluguel_nov - $comissao_aluguel_nov;
            $result_comissao_dez = $aluguel_dez - $comissao_aluguel_dez;

            $result_comissao_jan = number_format($result_comissao_jan, 2, '.', '');
            $result_comissao_fev = number_format($result_comissao_fev, 2, '.', '');
            $result_comissao_mar = number_format($result_comissao_mar, 2, '.', '');
            $result_comissao_abr = number_format($result_comissao_abr, 2, '.', '');
            $result_comissao_mai = number_format($result_comissao_mai, 2, '.', '');
            $result_comissao_jun = number_format($result_comissao_jun, 2, '.', '');
            $result_comissao_jul = number_format($result_comissao_jul, 2, '.', '');
            $result_comissao_ago = number_format($result_comissao_ago, 2, '.', '');
            $result_comissao_set = number_format($result_comissao_set, 2, '.', '');
            $result_comissao_out = number_format($result_comissao_out, 2, '.', '');
            $result_comissao_nov = number_format($result_comissao_nov, 2, '.', '');
            $result_comissao_dez = number_format($result_comissao_dez, 2, '.', '');

            $aluguel_jan = number_format($aluguel_jan, 2, '.', '');
            $aluguel_fev = number_format($aluguel_fev, 2, '.', '');
            $aluguel_mar = number_format($aluguel_mar, 2, '.', '');
            $aluguel_abr = number_format($aluguel_abr, 2, '.', '');
            $aluguel_mai = number_format($aluguel_mai, 2, '.', '');
            $aluguel_jun = number_format($aluguel_jun, 2, '.', '');
            $aluguel_jul = number_format($aluguel_jul, 2, '.', '');
            $aluguel_ago = number_format($aluguel_ago, 2, '.', '');
            $aluguel_set = number_format($aluguel_set, 2, '.', '');
            $aluguel_out = number_format($aluguel_out, 2, '.', '');
            $aluguel_nov = number_format($aluguel_nov, 2, '.', '');
            $aluguel_dez = number_format($aluguel_dez, 2, '.', '');

            $aluguel_jan   = str_replace(".", "", $aluguel_jan);
            $aluguel_fev   = str_replace(".", "", $aluguel_fev);
            $aluguel_mar   = str_replace(".", "", $aluguel_mar);
            $aluguel_abr   = str_replace(".", "", $aluguel_abr);
            $aluguel_mai   = str_replace(".", "", $aluguel_mai);
            $aluguel_jun   = str_replace(".", "", $aluguel_jun);
            $aluguel_jul   = str_replace(".", "", $aluguel_jul);
            $aluguel_ago   = str_replace(".", "", $aluguel_ago);
            $aluguel_set   = str_replace(".", "", $aluguel_set);
            $aluguel_out   = str_replace(".", "", $aluguel_out);
            $aluguel_nov   = str_replace(".", "", $aluguel_nov);
            $aluguel_dez   = str_replace(".", "", $aluguel_dez);


            $aluguel_jan = str_pad($aluguel_jan , 14, '0', STR_PAD_LEFT);
            $aluguel_fev = str_pad($aluguel_fev , 14, '0', STR_PAD_LEFT);
            $aluguel_mar = str_pad($aluguel_mar , 14, '0', STR_PAD_LEFT);
            $aluguel_abr = str_pad($aluguel_abr , 14, '0', STR_PAD_LEFT);
            $aluguel_mai = str_pad($aluguel_mai , 14, '0', STR_PAD_LEFT);
            $aluguel_jun = str_pad($aluguel_jun , 14, '0', STR_PAD_LEFT);
            $aluguel_jul = str_pad($aluguel_jul , 14, '0', STR_PAD_LEFT);
            $aluguel_ago = str_pad($aluguel_ago , 14, '0', STR_PAD_LEFT);
            $aluguel_set = str_pad($aluguel_set , 14, '0', STR_PAD_LEFT);
            $aluguel_out = str_pad($aluguel_out , 14, '0', STR_PAD_LEFT);
            $aluguel_nov = str_pad($aluguel_nov , 14, '0', STR_PAD_LEFT);
            $aluguel_dez = str_pad($aluguel_dez , 14, '0', STR_PAD_LEFT);




            $result_comissao_jan   = str_replace(".", "", $result_comissao_jan);
            $result_comissao_fev   = str_replace(".", "", $result_comissao_fev);
            $result_comissao_mar   = str_replace(".", "", $result_comissao_mar);
            $result_comissao_abr   = str_replace(".", "", $result_comissao_abr);
            $result_comissao_mai   = str_replace(".", "", $result_comissao_mai);
            $result_comissao_jun   = str_replace(".", "", $result_comissao_jun);
            $result_comissao_jul   = str_replace(".", "", $result_comissao_jul);
            $result_comissao_ago   = str_replace(".", "", $result_comissao_ago);
            $result_comissao_set   = str_replace(".", "", $result_comissao_set);
            $result_comissao_out   = str_replace(".", "", $result_comissao_out);
            $result_comissao_nov   = str_replace(".", "", $result_comissao_nov);
            $result_comissao_dez   = str_replace(".", "", $result_comissao_dez);


            $result_comissao_jan = str_pad($result_comissao_jan , 14, '0', STR_PAD_LEFT);
            $result_comissao_fev = str_pad($result_comissao_fev , 14, '0', STR_PAD_LEFT);
            $result_comissao_mar = str_pad($result_comissao_mar , 14, '0', STR_PAD_LEFT);
            $result_comissao_abr = str_pad($result_comissao_abr , 14, '0', STR_PAD_LEFT);
            $result_comissao_mai = str_pad($result_comissao_mai , 14, '0', STR_PAD_LEFT);
            $result_comissao_jun = str_pad($result_comissao_jun , 14, '0', STR_PAD_LEFT);
            $result_comissao_jul = str_pad($result_comissao_jul , 14, '0', STR_PAD_LEFT);
            $result_comissao_ago = str_pad($result_comissao_ago , 14, '0', STR_PAD_LEFT);
            $result_comissao_set = str_pad($result_comissao_set , 14, '0', STR_PAD_LEFT);
            $result_comissao_out = str_pad($result_comissao_out , 14, '0', STR_PAD_LEFT);
            $result_comissao_nov = str_pad($result_comissao_nov , 14, '0', STR_PAD_LEFT);
            $result_comissao_dez = str_pad($result_comissao_dez , 14, '0', STR_PAD_LEFT);
          



### DADOS DOS LOCATARIO PARA TESTE
$locatario[] = array(
 $cpf_locatario,        // 0  cpf_cli
 $nome_cli,             // 1  nome_cli
 $idlocacao,            // 2  numero do contrato
 $data_venda,           // 3  data do contrato
 $imovel_urbano,                   // 4  Tipo de imovel "U" URBANO "R" Rural
 $endereco,             // 5  Endereco do imovel
 $numero,               // 6  numero do imovel
 $cidade_idcidade,      // 7  cidade imovel
 $estado,               // 8  estado imovel
 $cep,                  // 9  cep do imovel
 $codigo_municipio,                 // 10  codigo do municipio
 $dados_locador["cpf_cli"],  // 11
 $dados_locador["nome_cli"],  // 12
$aluguel_jan,                 // 13
$result_comissao_jan,         // 14 
'00000000000000',                          // 15
$aluguel_fev,                 // 16
$result_comissao_fev,         // 17 
'00000000000000',                          // 18
$aluguel_mar,                 // 19
$result_comissao_mar,         // 20 
'00000000000000',                          // 21
$aluguel_abr,                 // 22
$result_comissao_abr,         // 23 
'00000000000000',                          // 24
$aluguel_mai,                 // 25
$result_comissao_mai,         // 26 
'00000000000000',                          // 27
$aluguel_jun,                 // 28
$result_comissao_jun,         // 29 
'00000000000000',                          // 30
$aluguel_jul,                 // 31
$result_comissao_jul,         // 32 
'00000000000000',                          // 33
$aluguel_ago,                 // 34
$result_comissao_ago,         // 35 
'00000000000000',                          // 36
$aluguel_set,                 // 37
$result_comissao_set,         // 38 
'00000000000000',                          // 39
$aluguel_out,                 // 40
$result_comissao_out,         // 41 
'00000000000000',                          // 42
$aluguel_nov,                 // 43
$result_comissao_nov,         // 44 
'00000000000000',                          // 45
$aluguel_dez,                 // 46
$result_comissao_dez,         // 47 
'00000000000000',                          // 48



 );

}

}


$i = 1;
foreach($locatario as $cliente)
{
                                                                         
   $conteudo .= 'R02';                                                     
   $conteudo .= $empreendedor_id["cpf_cli"]; // CNPJ DO DECLARANTE            
   $conteudo .= $ano_declaracao; // ANO CALENDARIO            
   $conteudo .= limit($i,5); // SEQUENCIAL
   $conteudo .= limit($cliente[11],14); // CPF DO LOCADOR
   $conteudo .= limit($cliente[12],60); // NOME DO LOCADOR

   $conteudo .= limit($cliente[0],14);  // CPF DO LOCATARIO
   $conteudo .= limit($cliente[1],60);  // NOME DO LOCATARIO

   $conteudo .= limit($cliente[2],6);   // NUMERO DO CONTRATO
   $conteudo .= limit($cliente[3],8);   // DATA DO CONTRATO


   $conteudo .= limit($cliente[13],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[14],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[15],14);   // TIPO DE IMOVEL

   $conteudo .= limit($cliente[16],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[17],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[18],14);   // TIPO DE IMOVEL

   $conteudo .= limit($cliente[19],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[20],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[21],14);   // TIPO DE IMOVEL

   $conteudo .= limit($cliente[22],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[23],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[24],14);   // TIPO DE IMOVEL

   $conteudo .= limit($cliente[25],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[26],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[27],14);   // TIPO DE IMOVEL

   $conteudo .= limit($cliente[28],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[29],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[30],14);   // TIPO DE IMOVEL

   $conteudo .= limit($cliente[31],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[32],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[33],14);   // TIPO DE IMOVEL

   $conteudo .= limit($cliente[34],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[35],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[36],14);   // TIPO DE IMOVEL

   $conteudo .= limit($cliente[37],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[38],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[39],14);   // TIPO DE IMOVEL

   $conteudo .= limit($cliente[40],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[41],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[42],14);   // TIPO DE IMOVEL

   $conteudo .= limit($cliente[43],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[44],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[45],14);   // TIPO DE IMOVEL

   $conteudo .= limit($cliente[46],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[47],14);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[48],14);   // TIPO DE IMOVEL



   $conteudo .= limit($cliente[4],1);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[5],60);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[9],8);   // TIPO DE IMOVEL
   $conteudo .= limit($cliente[10],4);   // TIPO DE IMOVEL

   $conteudo .= complementoRegistro(20,"brancos"); // reservado
   $conteudo .= limit($cliente[8],2);   // estado
   $conteudo .= complementoRegistro(10,"brancos"); // reservado


   $conteudo .= chr(13).chr(10); //essa é a quebra de linha

   $i = $i + 1;
   
  }

$conteudo .= 'T9'; // DECLARACAO RETIFICADORA
$conteudo .= complementoRegistro(100,"brancos");

if (!$handle = fopen($filename, 'w+')) 
{
    erro("Não foi possível abrir o arquivo ($filename)");
}

// Escreve $conteudo no nosso arquivo aberto.
if (fwrite($handle, "$conteudo") === FALSE) 
{
   erro("Não foi possível escrever no arquivo ($filename)");
}
fclose($handle);




?>
<script type="text/javascript">
  window.location="gerar_dimob_locacao.php?dimob=1";
</script>