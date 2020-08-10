<?php

date_default_timezone_set('America/Sao_Paulo');


$os 						= $_POST["os"];
$quadra 					= $_POST["quadra"];
$lote						= $_POST["lote"];
$entrada 					= $_POST["entrada"];
$vencimento_primeira 		= $_POST["vencimento_primeira"];
$vencimento_restante 		= $_POST["vencimento_demais"];
$valor_para_parcelamento 	= $_POST["valor_para_parcelamento"];
$plano_pagamento 			= $_POST["plano_pagamento"];
$taxa_financiamento 		= $_POST["taxa_financiamento"];

$cliente_idcliente 			= $_POST["cliente_idcliente"];
$imobiliaria_idimobiliaria 	= $_POST["imobiliaria_idimobiliaria"];

$parcela_entrada 			= $_POST["parcela_entrada"];
$entrada_restante 			= $_POST["entrada_restante"];
$valor_desconto 			= $_POST["valor_desconto"];
$desconto       			= $_POST["desconto"];

$periodo_parcela       			= $_POST["periodo_parcela"];
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




$up = mysqli_query($db,"UPDATE lote SET status='0' WHERE idlote =$lote");




 ?>

<script>
	window.location="relatorio_vendas.php?idempreendimento=<?php echo $os ?>";
</script>