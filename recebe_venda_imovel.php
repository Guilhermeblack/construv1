<?php


$imovel_idimovel 			= $_POST["imovel_idimovel"];

$entrada 					= $_POST["entrada"];
$vencimento_primeira 		= $_POST["vencimento_primeira"];
$vencimento_restante 		= $_POST["vencimento_demais"];
$valor_para_parcelamento 	= $_POST["valor_para_parcelamento"];
$plano_pagamento 			= $_POST["plano_pagamento"];
$taxa_financiamento 		= $_POST["taxa_financiamento"];

$cliente_idcliente 			= $_POST["cliente_idcliente"];
$cliente_idcliente2 			= $_POST["cliente_idcliente2"];
$imobiliaria_idimobiliaria 	= $_POST["imobiliaria_idimobiliaria"];

$parcela_entrada 			= $_POST["parcela_entrada"];
$entrada_restante 			= $_POST["entrada_restante"];
$valor_desconto 			= $_POST["valor_desconto"];
$desconto       			= $_POST["desconto"];
$data_venda 				= date('d-m-Y');
   
   if($valor_para_parcelamento == ''){
   	$valor_para_parcelamento = 0;
   }


$entrada2 = str_replace("R$","", $entrada);
$entrada3 = str_replace(".","", $entrada2);
$entrada4 = str_replace(",",".", $entrada3);

$entrada_restante2 = str_replace("R$","", $entrada_restante);
$entrada_restante3 = str_replace(".","", $entrada_restante2);
$entrada_restante4 = str_replace(",",".", $entrada_restante3);   

 include_once "conexao.php";


$query_amigo323 = "SELECT * FROM imovel where idimovel = $imovel_idimovel";

                $executa_query323 = mysqli_query ($db,$query_amigo323) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo323 = mysqli_fetch_assoc($executa_query323)) {//--verifica se sè´™o amigos
           
             $status_lotee       = $buscar_amigo323['status'];

}


if($status_lotee == 1){  
		   header("Location: cadastro_venda_imovel.php?venda=2");
break;

 } 





 $inserir = ("INSERT INTO venda_imovel (

imovel_idimovel,
cliente_idcliente,
cliente_idcliente2,    
imobiliaria_idimobiliaria, 
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
entrada_restante    
  
)


Values (

'$imovel_idimovel',
'$cliente_idcliente',
'$cliente_idcliente2',  
'$imobiliaria_idimobiliaria',    
'$entrada4',    
'$vencimento_primeira', 
'$vencimento_restante',    
'$valor_para_parcelamento',    
'$plano_pagamento',    
'$taxa_financiamento',    
'$data_venda',
'$parcela_entrada',
'$desconto',
'$valor_desconto',
'$entrada_restante4'
)


");

$executar = mysqli_query ($db,$inserir);
$venda_idvenda = mysqli_insert_id();


$valor_parcela_entrada = $entrada_restante4 / $parcela_entrada;
include "price.php";

$Valor    =  $valor_para_parcelamento;
$Parcelas =  $plano_pagamento;
$Juros    =  $taxa_financiamento;

$parcela_price = Price($Valor, $Parcelas, $Juros);



if($entrada4 > 0){
$parcela_entrada = $parcela_entrada + 1;
$vencimento1 = $vencimento_primeira;
$inserir2 = mysqli_query($db,"INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda)

values (
'$venda_idvenda',
'$entrada4',
'$vencimento1',
'Em Aberto',
'Primeira da Entrada',
'3'

)


	");
}





for($i=0; $i <= ($parcela_entrada - 1); $i++){




if($i == 0){
	$vencimento = date('d-m-Y', strtotime("+".$i." month",strtotime($vencimento_primeira)));


}else if($i ==1){
	$vencimento = $vencimento_restante;

}else{

	$vencimento = date('d-m-Y', strtotime("+".($i-1)." month",strtotime($vencimento_restante)));
}


if($entrada4 > 0 and $i==0){

$vencimento = $vencimento_restante;


}
if($entrada4 > 0 and $i==1){

	$vencimento = date('d-m-Y', strtotime("+".($i)." month",strtotime($vencimento_restante)));
$i=$i+1;

}

$inserir2 = mysqli_query($db,"INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda)

values (
'$venda_idvenda',
'$valor_parcela_entrada',
'$vencimento',
'Em Aberto',
'Parcelamento Entrada',
'3'

)


	");


}


if($parcela_entrada == 1){

	$data_vencimento_parcelas_ultimo2 = $vencimento_restante;
	$plano_pagamento = $plano_pagamento - 1;


$inserir = mysqli_query($db,"INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda)

values (
'$venda_idvenda',
'$parcela_price',
'$data_vencimento_parcelas_ultimo2',
'Em Aberto',
'Financiamento',
'3'

)


	");


}



 $query_amigo = "SELECT * FROM parcelas order by idparcelas Desc limit 1";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se s√£o amigos
           
             $data_vencimento_parcelas_ultimo       = $buscar_amigo['data_vencimento_parcela'];

}



for($w=1; $w <= $plano_pagamento; $w++){



$vencimento2 = date('d-m-Y', strtotime("+".$w." month",strtotime($data_vencimento_parcelas_ultimo)));

$inserir = mysqli_query($db,"INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda)

values (
'$venda_idvenda',
'$parcela_price',
'$vencimento2',
'Em Aberto',
'Financiamento',
'3'

)


	");

}






$up = mysqli_query($db,"UPDATE imovel SET status='1' WHERE idimovel =$imovel_idimovel");



 ?>

<script>
	window.location="relatorio_vendas_imovel.php";
</script>