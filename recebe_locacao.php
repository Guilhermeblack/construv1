<?php

function qtd_proprietario($idimovel){


    include "conexao.php";
    $busca = "SELECT * FROM proprietarios WHERE imovel_id = $idimovel";
    $executa = mysqli_query($db, $busca);

    $total = mysqli_num_rows($executa);

    return $total;
}



function arruma_valor($valor){
$valor = str_replace("R$","", $valor);
$valor = str_replace(".","", $valor);
$valor = str_replace(",",".", $valor);

return $valor;
}

date_default_timezone_set('America/Sao_Paulo');

$cadastrado_por                = $_POST["cadastrado_por"];
$data_cadastro                 = date('d-m-Y H:i:s');

$cliente_idcliente             = $_POST["cliente_idcliente"];
$imovel_idimovel		           = $_POST["imovel_idimovel"];
$contacorrente                 = $_POST["contacorrente"];


$valor_aluguel 			           = $_POST["valor_aluguel"];
$prazo_contrato  		           = $_POST["prazo_contrato"];
$primeira_parcela  		         = $_POST["primeira_parcela"];

$iptu                          = $_POST["iptu"];
$vencimento_iptu               = $_POST["vencimento_iptu"];
$qtd_parcelas_iptu             = $_POST["qtd_parcelas_iptu"];
$data_venda 			             = date('d-m-Y');
   
   
$condominio  			             = $_POST["condominio"];
$vencimento_condominio         = $_POST["vencimento_condominio"];
$qtd_parcelas_condominio       = $_POST["qtd_parcelas_condominio"];
$codigo_municipio              = $_POST["codigo_municipio"];


$valor_alugueis 				       = $_POST["valor_alugueis"];
$vencimento_garantia_aluguel   = $_POST["vencimento_garantia_aluguel"];
$qtd_parcelas_garantia_aluguel = $_POST["qtd_parcelas_garantia_aluguel"];

$valor_danos 	 				        = $_POST["valor_danos"];
$vencimento_garantia_danos 		= $_POST["vencimento_garantia_danos"];
$qtd_parcelas_garantia_danos	= $_POST["qtd_parcelas_garantia_danos"];

$seguradora 	 		            = $_POST["seguradora"];
$numero_apolice 	 	          = $_POST["numero_apolice"];
$vencimento_seguro		        = $_POST["vencimento"];
$valor_seguro 	 		          = $_POST["valor_seguro"];
$qtd_parcelas_seguro	        = $_POST["qtd_parcelas_seguro"];

$taxa_administrativa	        = $_POST["taxa_administrativa"];
$meses_repasse			          = $_POST["meses_repasse"];
$valor_repasse			          = $_POST["valor_repasse"];
$dia_repasse			            = $_POST["dia_repasse"];

$lancar_iptu			            = $_POST["lancar_iptu"];
$lancar_condominio            = $_POST["lancar_condominio"];

$multa_atraso                 = $_POST["multa_atraso"];
$juros_atraso                 = $_POST["juros_atraso"];

$lancar_dimob                 = $_POST["lancar_dimob"];
$dimob_iptu                   = $_POST["dimob_iptu"];
$dimob_condominio             = $_POST["dimob_condominio"];
$indice_correcao              = $_POST["indice_correcao"];



$primeira_parcela               = date("d-m-Y", strtotime($primeira_parcela));
$vencimento_iptu                = date("d-m-Y", strtotime($vencimento_iptu));
$vencimento_condominio          = date("d-m-Y", strtotime($vencimento_condominio));
$vencimento_garantia_aluguel    = date("d-m-Y", strtotime($vencimento_garantia_aluguel));
$vencimento_garantia_danos      = date("d-m-Y", strtotime($vencimento_garantia_danos));
$vencimento                     = date("d-m-Y", strtotime($vencimento));
$dia_repasse                    = date("d-m-Y", strtotime($dia_repasse));



$valor_aluguel 	  = arruma_valor($valor_aluguel);
$iptu 			      = arruma_valor($iptu);
$condominio 	    = arruma_valor($condominio);
$valor_alugueis   = arruma_valor($valor_alugueis);
$valor_danos 	    = arruma_valor($valor_danos);
$valor_seguro 	  = arruma_valor($valor_seguro);
$valor_repasse 	  = arruma_valor($valor_repasse);


$parcela_iptu 				    = $iptu / $qtd_parcelas_iptu;
$parcela_condominio 		  = $condominio / $qtd_parcelas_condominio;
$parcela_garantia_aluguel = $valor_alugueis / $qtd_parcelas_garantia_aluguel;
$parcela_garantia_danos 	= $valor_danos / $qtd_parcelas_garantia_danos;

$status_contrato = '1';

$numero_sequencia = 1;
$numero_sequencia_repasse = 1;
$numero_sequencia_iptu = 1;
$numero_sequencia_iptu_repasse = 1;
$numero_sequencia_cond = 1;
$numero_sequencia_cond_repasse = 1;


     //// Busca o ID da administradora do Condominio do Imovel
    include "conexao.php";               
 	$query_amigo = "SELECT * FROM imovel
 					INNER JOIN cliente ON imovel.adm_condominio = cliente.idcliente
                	WHERE idimovel = $imovel_idimovel";



                $executa_query = mysqli_query ($db, $query_amigo) or die ("Erro ao listar adm condominio");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se s«ªo amigos
           
             $adm_condominio             = $buscar_amigo['idcliente'];
           
        
            } 



    //// Busca o ID do Locador do imovel Imovel
    include "conexao.php";               
 	  $query_locador = "SELECT locador_idlocador FROM imovel 					            
                	    WHERE idimovel = $imovel_idimovel";

    $executa_locador = mysqli_query ($db, $query_locador) or die ("Erro ao listar Locador");
    
    while ($buscar_locador = mysqli_fetch_assoc($executa_locador)) {
           
          $idlocador             = $buscar_locador['locador_idlocador'];
           
    }         
            
  



 include "conexao.php";


 $inserir_contrato = ("INSERT INTO locacao (

cliente_idcliente,
imovel_idimovel, 
contacorrente,
valor_aluguel,
prazo_contrato,    
primeira_parcela,
iptu,
vencimento_iptu,
qtd_parcelas_iptu,
condominio,
vencimento_condominio,
qtd_parcelas_condominio,
valor_alugueis,
vencimento_garantia_aluguel,
qtd_parcelas_garantia_aluguel,
valor_danos,
vencimento_garantia_danos,
qtd_parcelas_garantia_danos,
seguradora,
numero_apolice,
vencimento,
valor_seguro,
qtd_parcelas_seguro,
taxa_administrativa,
meses_repasse,
valor_repasse,
dia_repasse,
data_venda,
status_contrato,
cadastrado_feito_por,
data_cadastro_feito,
multa_atraso,
juros_atraso,
dimob,
dimob_iptu,
dimob_condominio,
codigo_municipio,
indice_correcao)


values (

'$cliente_idcliente',
'$imovel_idimovel', 
'$contacorrente', 
'$valor_aluguel', 
'$prazo_contrato', 
'$primeira_parcela',
'$iptu',
'$vencimento_iptu',
'$qtd_parcelas_iptu',
'$condominio',
'$vencimento_condominio',
'$qtd_parcelas_condominio',
'$valor_alugueis',
'$vencimento_garantia_aluguel',
'$qtd_parcelas_garantia_aluguel',
'$valor_danos',
'$vencimento_garantia_danos',
'$qtd_parcelas_garantia_danos',
'$seguradora',
'$numero_apolice',
'$vencimento_seguro',
'$valor_seguro',
'$qtd_parcelas_seguro',
'$taxa_administrativa',
'$meses_repasse',
'$valor_repasse',
'$dia_repasse',
'$data_venda',
'$status_contrato',
'$cadastrado_por',
'$data_cadastro',
'$multa_atraso',
'$juros_atraso',
'$lancar_dimob',
'$dimob_iptu',
'$dimob_condominio',
'$codigo_municipio',
'$indice_correcao'

)


");


$executar = mysqli_query ($db, $inserir_contrato);
$venda_idvenda = mysqli_insert_id($db);


//////  insere no contrato as parcelas dos alugueis
for($i = 0; $i <= ($prazo_contrato - 1); $i++){

if($i == 0){
    $vencimento = $primeira_parcela;
}else{
$vencimento   = date('d-m-Y', strtotime("+".$i." month",strtotime($primeira_parcela)));
}



////// tipo de venda:   1 para aluguel,   2 para terreno,   3 para venda
$receber_aluguel = mysqli_query($db, "INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
centrocusto_id,
fluxo,
cliente_id_novo,
data_lancamento_sistema,
lancamento_por,
numero_sequencia
)

values (
'$venda_idvenda',
'$valor_aluguel',
'$vencimento',
'Em Aberto',
'Aluguel',
'1',
'528',
'0',
'$cliente_idcliente',
'$data_cadastro',
'$cadastrado_por',
'$numero_sequencia'

)");

$numero_sequencia = $numero_sequencia + 1;
}



$qtd_proprietarios = qtd_proprietario($imovel_idimovel);

 include "conexao.php";

   $query_amigo = "SELECT * FROM proprietarios                         
                   where imovel_id = $imovel_idimovel";

                   $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
                  while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se são amigos
           
                   $proprietario_id       = $buscar_amigo["proprietario_id"];
                   $percentual            = $buscar_amigo["percentual"];
                  
                  
$valor_repasse_propri = $valor_repasse * ($percentual / 100);


/////////// Repasse das parcelas do Aluguel

for($i = 0; $i <= ($meses_repasse - 1); $i++){

if($i == 0){
    $data_repasse = $dia_repasse;
}else{
$data_repasse = date('d-m-Y', strtotime("+".$i." month",strtotime($dia_repasse)));
}


$pagar_aluguel = mysqli_query($db, "INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
centrocusto_id,
fluxo,
cliente_id_novo,
data_lancamento_sistema,
lancamento_por,
numero_sequencia
)

values (
'$venda_idvenda',
'$valor_repasse_propri',
'$data_repasse',
'Em Aberto',
'Repasse Aluguel',
'1',
'530',
'1',
'$proprietario_id',
'$data_cadastro',
'$cadastrado_por',
'$numero_sequencia_repasse'

)");
$numero_sequencia_repasse = $numero_sequencia_repasse + 1;
}

}

//////  insere no contrato as parcelas do IPTU
for($i = 0; $i <= ($qtd_parcelas_iptu - 1); $i++){

if($i == 0){
    $vencimento = $vencimento_iptu;
}else{
$vencimento = date('d-m-Y', strtotime("+".$i." month",strtotime($vencimento_iptu)));
}

if($lancar_iptu == '1'){
////// tipo de venda:   1 para aluguel,   2 para terreno,   3 para venda
$receber_iptu = mysqli_query($db, "INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
centrocusto_id,
fluxo,
cliente_id_novo,
data_lancamento_sistema,
lancamento_por,
numero_sequencia
)

values (
'$venda_idvenda',
'$parcela_iptu',
'$vencimento',
'Em Aberto',
'Parcela IPTU',
'1',
'523',
'0',
'$cliente_idcliente',
'$data_cadastro',
'$cadastrado_por',
'$numero_sequencia_iptu'

)");
$numero_sequencia_iptu = $numero_sequencia_iptu + 1;

$pagar_iptu = mysqli_query($db, "INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
centrocusto_id,
fluxo,
cliente_id_novo,
data_lancamento_sistema,
lancamento_por,
numero_sequencia
)

values (
'$venda_idvenda',
'$parcela_iptu',
'$vencimento',
'Em Aberto',
'Parcela IPTU',
'1',
'531',
'1',
'$cliente_idcliente',
'$data_cadastro',
'$cadastrado_por',
'$numero_sequencia_iptu_repasse'

)");
$numero_sequencia_iptu_repasse = $numero_sequencia_iptu_repasse + 1;
}



}

//////  insere no contrato as parcelas do CONDOMINIO
for($i = 0; $i <= ($qtd_parcelas_condominio - 1); $i++){

if($i == 0){
    $vencimento = $vencimento_condominio;
}else{
$vencimento = date('d-m-Y', strtotime("+".$i." month",strtotime($vencimento_condominio)));
}

if($lancar_condominio == '1'){
////// tipo de venda:   1 para aluguel,   2 para terreno,   3 para venda
$receber_cond = mysqli_query($db, "INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
centrocusto_id,
fluxo,
cliente_id_novo,
data_lancamento_sistema,
lancamento_por,
numero_sequencia
)

values (
'$venda_idvenda',
'$parcela_condominio',
'$vencimento',
'Em Aberto',
'Parcela Condominio',
'1',
'532',
'0',
'$cliente_idcliente',
'$data_cadastro',
'$cadastrado_por',
'$numero_sequencia_cond'

)");
$numero_sequencia_cond = $numero_sequencia_cond + 1;

$pagar_cond = mysqli_query($db, "INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
centrocusto_id,
fluxo,
cliente_id_novo,
data_lancamento_sistema,
lancamento_por,
numero_sequencia
)

values (
'$venda_idvenda',
'$parcela_condominio',
'$vencimento',
'Em Aberto',
'Parcela Condominio',
'1',
'524',
'1',
'$cliente_idcliente',
'$data_cadastro',
'$cadastrado_por',
'$numero_sequencia_cond_repasse'

)");
$numero_sequencia_cond_repasse = $numero_sequencia_cond_repasse + 1;
}

}

//////  insere no contrato as parcelas da Garantia Loca«®«ªo
for($i = 0; $i <= ($qtd_parcelas_garantia_aluguel - 1); $i++){

if($i == 0){
    $vencimento = $vencimento_garantia_aluguel;
}else{
$vencimento = date('d-m-Y', strtotime("+".$i." month",strtotime($vencimento_garantia_aluguel)));
}


////// tipo de venda:   1 para aluguel,   2 para terreno,   3 para venda
$insert = mysqli_query($db, "INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
centrocusto_id,
fluxo,
cliente_id_novo,
data_lancamento_sistema,
lancamento_por
)

values (
'$venda_idvenda',
'$parcela_garantia_aluguel',
'$vencimento',
'Em Aberto',
'Parcela Garantia Aluguel',
'1',
'526',
'0',
'$cliente_idcliente',
'$data_cadastro',
'$cadastrado_por'

)");


}


//////  insere no contrato as parcelas da Garantia Danos
for($i = 0; $i <= ($qtd_parcelas_garantia_danos - 1); $i++){

if($i == 0){
    $vencimento = $vencimento_garantia_danos;
}else{
$vencimento = date('d-m-Y', strtotime("+".$i." month",strtotime($vencimento_garantia_danos)));
}


////// tipo de venda:   1 para aluguel,   2 para terreno,   3 para venda
$insert = mysqli_query($db, "INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
centrocusto_id,
fluxo,
cliente_id_novo,
data_lancamento_sistema,
lancamento_por
)

values (
'$venda_idvenda',
'$parcela_garantia_danos',
'$vencimento',
'Em Aberto',
'Parcela Garantia Danos',
'1',
'527',
'0',
'$cliente_idcliente',
'$data_cadastro',
'$cadastrado_por'


)");


}




$fiador                   = $_POST["fiador"];

 foreach($fiador as $idfiador){

              $inserir_tipo = mysqli_query($db,"INSERT INTO fiador (locacao_idlocacao, cliente_idcliente, fiador_idfiador) values ('$venda_idvenda','$cliente_idcliente','$idfiador')");
          }



 ?>

<script>
	window.location="relatorio_locacoes.php";
</script>
