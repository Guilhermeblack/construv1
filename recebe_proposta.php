<?php
$cliente_idcliente        = $_POST["cliente_idcliente"];

if($cliente_idcliente == ''){
function remover_acentos($str) { 

  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', '?', '?', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', 'Œ', 'œ', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'Š', 'š', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Ÿ', 'Z', 'z', 'Z', 'z', 'Ž', 'ž', '?', 'ƒ', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?', 'ç', 'Ç', "'"); 
  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o','c','C', " "); 
  return str_replace($a, $b, $str); 
} 
date_default_timezone_set('America/Sao_Paulo');

$nome_cli          = $_POST["nome_cli"];
$cpf_cli           = $_POST["cpf_cli"];
$rg_cli            = $_POST["rg_cli"];
$estadocivil_cli   = $_POST["estadocivil_cli"];
$nacionalidade_cli = $_POST["nacionalidade_cli"];
$profissao_cli     = $_POST["profissao_cli"];
$nascimento_cli    = $_POST["nascimento_cli"];
$email_cli         = $_POST["email_cli"];
$cidade_cli        = $_POST["cidade_cli"];
$endereco_cli      = $_POST["endereco_cli"];
$numero_cli        = $_POST["numero_cli"];
$bairro_cli        = $_POST["bairro_cli"];
$cep_cli           = $_POST["cep_cli"];
$telefone1_cli     = $_POST["telefone1_cli"];
$telefone2_cli     = $_POST["telefone2_cli"];
$estado_cli        = $_POST["estado_cli"];
$senha_cli_cad     = $_POST["senha"];
$idgrupo           = $_POST["idgrupo"];
$grupo_cliente     = $_POST["grupo_cliente"];
$imob_id           = $_POST["imob_id"];
$creci             = $_POST["creci"];
$insc_municipal    = $_POST["insc_municipal"];
$cadastrado_por    = $_POST["cadastrado_por"];
$complemento_cli   = $_POST["complemento_cli"];
$pessoa            = $_POST["pessoa"];
$obs_cli           = $_POST["obs_cli"];

$cargo             = $_POST["cargo"];
$salario_base      = $_POST["salario_base"];
$data_contratacao  = $_POST["data_contratacao"];
$data_demissao     = $_POST["data_demissao"];
$cpf_rfb           = $_POST["cpf_rfb"];
$renda_total       = $_POST["renda_total"];


$nome_con          = $_POST["nome_con"];
$cpf_con           = $_POST["cpf_con"];
$rg_con            = $_POST["rg_con"];
$nacionalidade_con = $_POST["nacionalidade_con"];
$profissao_con     = $_POST["profissao_con"];
$nascimento_con    = $_POST["nascimento_con"];

$imobiliaria_idimobiliaria= $_POST["imobiliaria_idimobiliaria"];





$renda_total = str_replace("R$","", $renda_total);
$renda_total = str_replace(".","",  $renda_total);
$renda_total = str_replace(",",".", $renda_total);

$grupo_acesso_logado  = $_POST["grupo_acesso_logado"];

$data_cadastro    = date('d-m-Y H:i:s');
   
$nome_cli2      = remover_acentos($nome_cli);
$endereco_cli2  = remover_acentos($endereco_cli);
$bairro_cli2    = remover_acentos($bairro_cli);
$cidade_cli2    = remover_acentos($cidade_cli);
$estado_cli2    = remover_acentos($estado_cli);

if($nascimento_cli != ""){
$nascimento_cli = date("d-m-Y", strtotime($nascimento_cli));
}
   
   
 include "conexao.php";


 $inserir = ("INSERT INTO cliente (
nome_cli,
cpf_cli,    
rg_cli,    
estadocivil_cli,    
nacionalidade_cli,    
profissao_cli,    
nascimento_cli,    
email_cli,    
cidade_cli,    
endereco_cli,    
numero_cli,    
bairro_cli,    
cep_cli,    
telefone1_cli,    
telefone2_cli,
data_cadastro,
imob_id,
estado_cli,
senha,
idgrupo, 
creci,
insc_municipal,
cadastrado_por,
complemento_cli,
fisico_juridico,
categoria_cliente,
obs_cli,
cargo,
salario_base,
data_contratacao,
cpf_rfb,
renda_total
)


values (
'$nome_cli2',
'$cpf_cli',    
'$rg_cli',    
'$estadocivil_cli',    
'$nacionalidade_cli',    
'$profissao_cli',    
'$nascimento_cli',    
'$email_cli',    
'$cidade_cli2',    
'$endereco_cli2',    
'$numero_cli',    
'$bairro_cli2',    
'$cep_cli',    
'$telefone1_cli',    
'$telefone2_cli',   
'$data_cadastro',
'$imob_id',
'$estado_cli2',
'$senha_cli_cad',
'$idgrupo',
'$creci',
'$insc_municipal',
'$cadastrado_por',
'$complemento_cli',
'$pessoa',
'$grupo_cliente',
'$obs_cli',
'$cargo',
'$salario_base',
'$data_contratacao',
'$cpf_rfb',
'$renda_total'

)


");


 $executa_query = mysqli_query ($db,$inserir);

 $id_ultimo_titular = mysqli_insert_id($db);


 $inserir_tipo = mysqli_query($db,"INSERT INTO cliente_tipo (idcliente, idtipo) values ('$id_ultimo_titular','1')");


   $inserir_vinculo = mysqli_query($db,"INSERT INTO vinculo (idcliente, idcorretor, data_vinculo, vinculado_por) values ('$id_ultimo_cliente','$imobiliaria_idimobiliaria','$data_cadastro','$cadastrado_por')");


 if($nome_con != ''){

$inserir_conjuge = mysqli_query($db, "INSERT INTO cliente (nome_cli, cpf_cli, rg_cli, nacionalidade_cli, profissao_cli, nascimento_cli, cadastrado_por) values ('$nome_con', '$cpf_con', '$rg_con', '$nacionalidade_con', '$profissao_con', '$nascimento_con','$cadastrado_por')");


 $id_ultimo_conjuge = mysqli_insert_id($db);

 $inserir_tipo = mysqli_query($db,"INSERT INTO cliente_tipo (idcliente, idtipo) values ('$id_ultimo_conjuge','6')");


$inserir_con = mysqli_query($db,"INSERT INTO conjuge (cliente_idcliente, conjuge_idconjuge) values ('$id_ultimo_titular','$id_ultimo_conjuge')");


}

$cliente_idcliente = $id_ultimo_titular;

}

$imobiliaria_idimobiliaria= $_POST["imobiliaria_idimobiliaria"];

$os 						          = $_POST["os"];
$quadra 					        = $_POST["quadra"];
$lote						          = $_POST["lote"];
$entrada 					        = $_POST["entrada"];
$vencimento_primeira 		  = $_POST["vencimento_primeira"];
$vencimento_restante 		  = $_POST["vencimento_demais"];
$valor_para_parcelamento 	= $_POST["valor_para_parcelamento"];
$plano_pagamento 			    = $_POST["plano_pagamento"];
$taxa_financiamento 		  = $_POST["taxa_financiamento"];


$parcela_entrada 			    = $_POST["parcela_entrada"];
$entrada_restante 			  = $_POST["entrada_restante"];
$valor_desconto 			    = $_POST["valor_desconto"];

$periodo_parcela       			    = $_POST["periodo_parcela"];
$qtd_parcelas_intermediarias    = $_POST["qtd_parcelas_intermediarias"];
$valor_parcela_intermediaria    = $_POST["valor_parcela_intermediaria"];
$data_primeira_intermediaria    = $_POST["data_primeira_intermediaria"];

$cadastrado_por       		= $_POST["cadastrado_por"];
$data_venda         = date('d-m-Y H:i:s');
$igpm             = date('d-m-Y');
   
   
$valor_parcela_entrada2       			= $_POST["valor_parcela_entrada2"];


$centrocusto_id       			= $_POST["centrocusto_id"];
$contacorrente       			= $_POST["contacorrente"];

$percentual       			= $_POST["percentual"];

$vencimento_primeira    	        = date("d-m-Y", strtotime($vencimento_primeira));
$vencimento_restante    	        = date("d-m-Y", strtotime($vencimento_restante));
$data_primeira_intermediaria    	= date("d-m-Y", strtotime($data_primeira_intermediaria));


$entrada = str_replace("R$","", $entrada);
$entrada = str_replace(".","",  $entrada);
$entrada = str_replace(",",".", $entrada);

$entrada_restante = str_replace("R$","", $entrada_restante);
$entrada_restante = str_replace(".","",  $entrada_restante);
$entrada_restante = str_replace(",",".", $entrada_restante); 

$valor_parcela_entrada = $valor_parcela_entrada2;

  		$cod_cessao = date('Y-m-d H:i:s');
        $cod_cessao = str_replace("-","", $cod_cessao);
        $cod_cessao = str_replace(":","", $cod_cessao);
        $cod_cessao = str_replace(" ","", $cod_cessao);

 include "conexao.php";


$query_amigo323 = "SELECT * FROM lote where idlote = $lote";

                $executa_query323 = mysqli_query ($db,$query_amigo323) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se s«ªo amigos
           
             $status_lotee       = $buscar_amigo323['status'];

}


if($status_lotee == 0){  
		   header("Location: gerar_contrato_empreendimento.php?idempreendimento=".$os."&erro=3"); die();


 } 
$up = mysqli_query($db,"UPDATE lote SET status='0' WHERE idlote =$lote");


if($entrada > 0){
	$valor_primeira = $entrada;
}else{
	$valor_primeira = $valor_parcela_entrada;
}

include "price.php";

$Valor    =  $valor_para_parcelamento;
$Parcelas =  $plano_pagamento;
$Juros    =  $taxa_financiamento;

$parcela_price = Price($Valor, $Parcelas, $Juros);


 $inserir = ("INSERT INTO venda (

produto_idproduto, 
cliente_idcliente,
imobiliaria_idimobiliaria, 
lote_idlote,    
valor_entrada,    
vencimento_primeira,
vencimento_restante,    
valor_para_parcelamento,    
plano_pagamento,    
taxa_financiamento,    
data_venda,
parcela_entrada,
desconto,
valor_desconto,
entrada_restante,
centrocusto_id,
contacorrente,
valor_parcela_financiamento,
valor_parcela_entrada,
cadastrado_por,
inter_periodo,
inter_qtd,
inter_valor,
inter_data,
igpm
    
  
)


Values (

'$quadra', 
'$cliente_idcliente',
'$imobiliaria_idimobiliaria',    
'$lote',    
'$entrada',    
'$vencimento_primeira', 
'$vencimento_restante',    
'$valor_para_parcelamento',    
'$plano_pagamento',    
'$taxa_financiamento',    
'$data_venda',
'$parcela_entrada',
'$desconto',
'$valor_desconto',
'$entrada_restante',
'$centrocusto_id',
'$contacorrente',
'$parcela_price',
'$valor_parcela_entrada',
'$cadastrado_por',
'$periodo_parcela',
'$qtd_parcelas_intermediarias',
'$valor_parcela_intermediaria',
'$data_primeira_intermediaria',
'$igpm'
)


");
$executar = mysqli_query ($db,$inserir);
$venda_cod = mysqli_insert_id($db);



$grava_propri = mysqli_query($db, "INSERT INTO proprietarios_lote (venda_id, cliente_id, percentual, cod_cessao, situacao_cessao) values('$venda_cod','$cliente_idcliente','$percentual','$cod_cessao','1')");








 ?>

<script>
	window.location="relatorio_vendas.php?idempreendimento=<?php echo $os ?>";
</script>