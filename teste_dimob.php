<?php
error_reporting(0);
ini_set(“display_errors”, 0);
/*
* @descr: Gera o arquivo de remessa para cobranca no padrao CNAB 400 vers. 7.0 ITAU
*/

function busca_socio($idempreendimento, $idproprietario)
{
      
     
       include "conexao.php";
       $busca_socio = "SELECT * FROM proprietarios 
                       WHERE empreendimento_id = $idempreendimento AND proprietario_id = $idproprietario";

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
 function valor_pago($idvenda, $ano_pesquisa)
{
      $inicio = $ano_pesquisa.'-01-01';
      $fim    = $ano_pesquisa.'-12-31';

      $situacao_and =" AND STR_TO_DATE(data_recebimento, '%d-%m-%Y') BETWEEN  '".$inicio."' and '".$fim."' ";

      
       include "conexao.php";
       $query_amigo = "SELECT SUM(valor_recebido) as total FROM parcelas where fluxo = 0 AND situacao = 'Pago' AND venda_idvenda = $idvenda AND tipo_venda = 2 $situacao_and";
       $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar nome da imobiliaria");
                
          while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
          {                 
            $total               = $buscar_amigo["total"];                
                            
          }
    
    return $total;

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


$cliente_id         = $_GET["idempreendedor"];
$empreendedor_id    = dados_info_cliente($cliente_id);


$nome_arquivo = date('Y-m-d H:i:s');
        $nome_arquivo = str_replace("-","", $nome_arquivo);
        $nome_arquivo = str_replace(":","", $nome_arquivo);
        $nome_arquivo = str_replace(" ","", $nome_arquivo);
$filename = 'dimob/'.$nome_arquivo.".txt";
$nome_gravar = $nome_arquivo.'.txt';
include "conexao.php";
$insert_dimob = mysqli_query($db, "INSERT INTO dimob (nome_arquivo) values('$nome_gravar')");

$ano_declaracao = $_GET["ano_declaracao"];

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
$conteudo .= $empreendimento_id["cpf_rfb"]; // CPF DO RESPONSAVEL PELA PESSOA JURIDICA PERANTE A RFB  
$conteudo .= limit($empreendedor_id["endereco_cli"],120); // NOME EMPRESARIAL
$conteudo .= $empreendedor_id["estado_cli"]; // Estado 
$conteudo .= '6425'; // Codigo do Municipio (consultar no site) 
$conteudo .= complementoRegistro(30,"brancos");

$conteudo .= chr(13).chr(10); //essa é a quebra de linha

      
       include "conexao.php";
            $query_amigo = "SELECT * FROM venda
                            INNER JOIN produto ON venda.produto_idproduto = produto.idproduto 
                            INNER JOIN empreendimento ON produto.empreendimento_idempreendimento = empreendimento.idempreendimento 
                            INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                            WHERE empreendimento.dimob = 1";


            $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar Empreendedor ou empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
                 
            $idempreendimento_cadastro       = $buscar_amigo["idempreendimento_cadastro"];

            $busca_socio = busca_socio($idempreendimento_cadastro, $cliente_id);

            if($busca_socio["total"] != 0){

            $idvenda          = $buscar_amigo["idvenda"];

            $valor_desconto   = $buscar_amigo["valor_desconto"];
            $data_venda       = $buscar_amigo["data_venda"];
            $cod_cliente      = $buscar_amigo["cliente_idcliente"];
          
            $data_venda       = str_replace("-", "", $data_venda);

            $valor_desconto   = str_replace(".", "", $valor_desconto);


            



           $busca_quem_comprou = "SELECT * FROM proprietarios_lote 
                                  WHERE venda_id = $idvenda";

           $executa_comprou = mysqli_query ($db,$busca_quem_comprou) or die ("Erro buscar socio");
                

          while ($buscar_amigo = mysqli_fetch_assoc($executa_comprou))
          {                 
            $percentual               = $buscar_amigo["percentual"];                
            $cliente_que_comprou      = $buscar_amigo["cliente_id"];


            $result_dados_cli = dados_info_cliente($cliente_que_comprou);

            $cpf_cli_tratado  =  $result_dados_cli["cpf_cli"];
            $cpf_cli_tratado  = str_replace(".", "", $cpf_cli_tratado);
            $cpf_cli_tratado  = str_replace("-", "", $cpf_cli_tratado);
            $cpf_cli_tratado  = str_replace("/", "", $cpf_cli_tratado);

            $cep_cli = $result_dados_cli["cep_cli"];
            $cep_cli = str_replace("-", "", $cep_cli);
            $cep_cli = str_replace(".", "", $cep_cli);

            $valor_total_pago = valor_pago($idvenda, $ano_declaracao); 

            
            $valor_total_pago = $valor_total_pago * ($percentual / 100);  

            $valor_operacao = $valor_desconto * ($busca_socio["percentual"] / 100);
            $valor_operacao = $valor_operacao * ($percentual / 100);

            $valor_total_pago = $valor_total_pago * ($busca_socio["percentual"] / 100);

            $valor_total_pago   = number_format($valor_total_pago, 2, '.', '');

            $valor_total_pago   = str_replace(".", "", $valor_total_pago);


### DADOS DOS CLIENTES PARA TESTE
$clientes[] = array(
 $cpf_cli_tratado,                         // 0  cpf_cli
 $result_dados_cli["nome_cli"],                // 1  nome_cli
 $idvenda,                              // 2  numero do contrato
 $data_venda,                            // 3  data do contrato
 $valor_operacao,                             // 4  valor total do contrato
 $valor_total_pago,                              // 5  valor pago no ano
  "U",                                   // 6  Tipo de imovel "U" URBANO "R" Rural
  $result_dados_cli["endereco_cli"],   // 7  Endereco do imovel
  $cep_cli,                            // 8  cep do imovel
  "6425",                                // 9  codigo do municipio
  $result_dados_cli["estado_cli"]                                   // 10 Estado



 );
} } 
}

$i = 1;
foreach($clientes as $cliente)
{
                                                                         
   $conteudo .= 'R03';                                                     
   $conteudo .= $empreendedor_id["cpf_cli"]; // CNPJ DO DECLARANTE            
   $conteudo .= $ano_declaracao; // ANO CALENDARIO            
   $conteudo .= limit($i,5); // SEQUENCIAL
   $conteudo .= limit($cliente[0],14); // CPF DO COMPRADOR
   $conteudo .= limit($cliente[1],60); // NOME DO COMPRADOR
   $conteudo .= limit($cliente[2],6); // NUMERO DO CONTRATO
   $conteudo .= limit($cliente[3],8); // DATA DO CONTRATO
   $conteudo .= limit($cliente[4],14); // VALOR TOTAL CONTRATO
   $conteudo .= limit($cliente[5],14); // VALOR PAGO NO ANO
   $conteudo .= limit($cliente[6],1); // TIPO DE IMOVEL
   $conteudo .= limit($cliente[7],60); // ENDERECO DO IMOVEL
   $conteudo .= limit($cliente[8],8); // CEP DO IMOVEL
   $conteudo .= limit($cliente[9],4); // Codigo do municipio
   $conteudo .= complementoRegistro(20,"brancos"); // reservado
   $conteudo .= limit($cliente[10],2); // Codigo do municipio
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
  window.location="gerar_dimob.php?dimob=1";
</script>