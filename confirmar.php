<?php

if(isset($_GET["idparcelas"])){


$idlote 						= $_GET["idlote"];
$idvenda 						= $_GET["idvenda"];
$idparcelas 					= $_GET["idparcelas"];  
   
   
 include "conexao.php";

$up = mysqli_query($db,"UPDATE lote SET status='2' WHERE idlote =$idlote");
$up2 = mysqli_query($db,"UPDATE venda SET status_venda ='2' WHERE idvenda =$idvenda");
$up3 = mysqli_query($db,"UPDATE parcelas SET situacao ='Pago' WHERE idparcelas =$idparcelas");


?>
<script>
	window.location="baixa_parcelas.php";
</script>

<?php }else{


$idlote 						= $_GET["idlote"];
$idvenda 						= $_GET["idvenda"];
$idempreendimento               = $_GET["idempreendimento"];   

$comissao_imob_empreendimento   = $_POST["comissao_imob_empreendimento"];   
$quantidade_parcelas_repasse    = $_POST["quantidade_parcelas_repasse"];   
$vencimento_primeira_repasse    = $_POST["vencimento_primeira_repasse"];   
$comissao_para     				= $_POST["comissao_para"]; 

$repasse_venda     				= $_POST["repasse_venda"];   
$repasse_parcelas     			= $_POST["repasse_parcelas"];   
$vencimento_repasse     		= $_POST["vencimento_repasse"];   
$lancado_por     			    = $_POST["lancado_por"];   
$valor_venda     			    = $_POST["valor_venda"];   

$data_lancado = date('d-m-Y');

$vencimento_primeira_repasse    	= date("d-m-Y", strtotime($vencimento_primeira_repasse));

   
 include "conexao.php";

$up = mysqli_query($db,"UPDATE lote SET status='2' WHERE idlote =$idlote");
$up2 = mysqli_query($db,"UPDATE venda SET status_venda ='3' WHERE idvenda =$idvenda");


$grava_comissao = mysqli_query($db,"INSERT INTO venda_comissao (empreendimento_id, venda_id, percentual, qtd_parcelas, data_venc_primeira, comissao_para, lancado_por, data_lancado, valor_venda) values ('$idempreendimento', '$idvenda', '$comissao_imob_empreendimento', '$quantidade_parcelas_repasse', '$vencimento_primeira_repasse', '$comissao_para', '$lancado_por', '$data_lancado', '$valor_venda')");




                
                $query_venda = "SELECT * FROM venda
                INNER JOIN cliente ON cliente.idcliente = venda.cliente_idcliente
                INNER JOIN lote ON lote.idlote = venda.lote_idlote
                INNER JOIN produto ON  lote.produto_idproduto = produto.idproduto
                INNER JOIN empreendimento ON  produto.empreendimento_idempreendimento = empreendimento.idempreendimento
                
                where venda.idvenda = $idvenda";

                $executa_venda = mysqli_query ($db, $query_venda) or die ("Erro ao listar venda");
                
                
            while ($buscar_venda = mysqli_fetch_assoc($executa_venda)) {//--verifica se são amigos
           

        
$valor_total_entrada3 	   		= $buscar_venda["valor_entrada"]; 
$valor_desconto 	       		= $buscar_venda["valor_desconto"];      
$valor_total_entrada4 	   		= $buscar_venda["entrada_restante"]; 
$parcela_entrada           		= $buscar_venda["parcela_entrada"];
$plano_pagamento           		= $buscar_venda["plano_pagamento"];
$valor_parcela_financiamento    = $buscar_venda["valor_parcela_financiamento"];
$valor_parcela_entrada    		= $buscar_venda["valor_parcela_entrada"];
$vencimento_primeira 	   		= $buscar_venda["vencimento_primeira"];
$vencimento_restante 	   		= $buscar_venda["vencimento_restante"];
$idempreendimento          		= $buscar_venda["idempreendimento"]; 
$cliente_id_novo_pagar          = $buscar_venda["imobiliaria_idimobiliaria"]; 
$cliente_id_novo_receber        = $buscar_venda["cliente_idcliente"]; 

$inter_periodo        			= $buscar_venda["inter_periodo"]; 
$inter_qtd        				= $buscar_venda["inter_qtd"]; 
$inter_valor        			= $buscar_venda["inter_valor"]; 
$inter_data        				= $buscar_venda["inter_data"]; 
}


          $query_proprio = "SELECT * FROM empreendimento
                			INNER JOIN empreendimento_cadastro ON empreendimento.empreendimento_cadastro_id = empreendimento_cadastro.idempreendimento_cadastro
                				  WHERE idempreendimento = $idempreendimento";

                $executa_proprio = mysqli_query ($db, $query_proprio) or die ("Erro ao listar venda");
                while ($buscar_proprio = mysqli_fetch_assoc($executa_proprio)) {//--verifica se são amigos
           
       
				$tipo_empreendimento	 	   	= $buscar_proprio["tipo_empreendimento"]; 
				$empreendimento_id_novo 	   	= $buscar_proprio["idempreendimento_cadastro"]; 
				
				}








$repasse 				  = $valor_desconto * ($comissao_imob_empreendimento / 100);
$valor_repasse_parcelado  = $repasse / $quantidade_parcelas_repasse;

for($i = 0; $i <= $quantidade_parcelas_repasse - 1; $i++)
{
	$vencimento_primeira_repasse = date('d-m-Y', strtotime("+".$i." month",strtotime($vencimento_primeira_repasse)));

	$inserir_comissao = mysqli_query($db,"INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
fluxo,
centrocusto_id,
cliente_id_novo,
empreendimento_id_novo

)

values (
'$idvenda',
'$valor_repasse_parcelado',
'$vencimento_primeira_repasse',
'Em Aberto',
'Comissao',
'2',
'1',
'1',
'$comissao_para',
'$empreendimento_id_novo'

)


	");
}              


    
      


if($valor_total_entrada3 > 0){
$vencimento1 = $vencimento_primeira;
$inserir2 = mysqli_query($db,"INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
fluxo,
cliente_id_novo,
empreendimento_id_novo,
centrocusto_id,
numero_sequencia

)

values (
'$idvenda',
'$valor_total_entrada3',
'$vencimento1',
'Em Aberto',
'Primeira da Entrada',
'2',
'0',
'$cliente_id_novo_receber',
'$empreendimento_id_novo',
'1',
'1'

)


	");

/*
if($tipo_empreendimento == 1){
	$inserir_pagar1 = mysqli_query($db,"INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
fluxo)

values (
'$idvenda',
'$valor_total_entrada3',
'$vencimento1',
'Em Aberto',
'Primeira da Entrada',
'2',
'1'

)


	");
}


*/







}



///////// PARCELAS INTERMEDIARIAS 
if($inter_valor > 0){
	for($i=1; $i <= $inter_qtd; $i++){

	if($i == 1){
		$vencimento_inter = $inter_data;
	}else{
		$vencimento_inter = date('d-m-Y', strtotime("+".$inter_periodo." month",strtotime($vencimento_inter)));

	}

$inserir2 = mysqli_query($db,"INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
fluxo,
cliente_id_novo,
empreendimento_id_novo,
centrocusto_id,
numero_sequencia

)

values (
'$idvenda',
'$inter_valor',
'$vencimento_inter',
'Em Aberto',
'Parcela Intermediaria',
'2',
'0',
'$cliente_id_novo_receber',
'$empreendimento_id_novo',
'1',
'$i'

)


	");



}

}













for($i=0; $i <= ($parcela_entrada - 1); $i++){




if($i == 0){
	$vencimento = date('d-m-Y', strtotime("+".$i." month",strtotime($vencimento_primeira)));


}elseif($i ==1){
	$vencimento = $vencimento_restante;

}else{

	$vencimento = date('d-m-Y', strtotime("+".($i-1)." month",strtotime($vencimento_restante)));
}


if($valor_total_entrada3 > 0 and $i==0){

$vencimento = $vencimento_restante;


}elseif($valor_total_entrada3 > 0 and $i==1){

	$vencimento = date('d-m-Y', strtotime("+".($i)." month",strtotime($vencimento_restante)));


}elseif($valor_total_entrada3 > 0){
	$vencimento = date('d-m-Y', strtotime("+".($i)." month",strtotime($vencimento_restante)));

}else{

}
$numero_sequencia = $i +1;
$inserir2 = mysqli_query($db,"INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
fluxo,
cliente_id_novo,
empreendimento_id_novo,
centrocusto_id,
numero_sequencia)

values (
'$idvenda',
'$valor_parcela_entrada',
'$vencimento',
'Em Aberto',
'Parcelamento Entrada',
'2',
'0',
'$cliente_id_novo_receber',
'$empreendimento_id_novo',
'1',
'$numero_sequencia'

)


	");


/* if($tipo_empreendimento == 1)
{
	$inserir_pagar2 = mysqli_query($db,"INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
fluxo)

values (
'$idvenda',
'$valor_parcela_entrada',
'$vencimento',
'Em Aberto',
'Parcelamento Entrada',
'2',
'1'

)


	");
}

*/










}


/* if($parcela_entrada == 1){

	$data_vencimento_parcelas_ultimo2 = $vencimento_restante;
	$plano_pagamento = $plano_pagamento - 1;


$inserir = mysqli_query($db,"INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
fluxo,
cliente_id_novo,
empreendimento_id_novo,
centrocusto_id)

values (
'$idvenda',
'$valor_parcela_financiamento',
'$data_vencimento_parcelas_ultimo2',
'Em Aberto',
'Financiamento',
'2',
'0',
'$cliente_id_novo_receber',
'$empreendimento_id_novo',
'1'

)


	");


/*
if($tipo_empreendimento == 1)
{
	$inserir = mysqli_query($db,"INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
fluxo)

values (
'$idvenda',
'$valor_parcela_financiamento',
'$data_vencimento_parcelas_ultimo2',
'Em Aberto',
'Financiamento',
'2',
'1'

)


	");
}


*/




/*} */


if($parcela_entrada > 1){
 $query_amigo = "SELECT * FROM parcelas
 				 WHERE venda_idvenda = $idvenda AND tipo_venda = 2
 				 order by idparcelas Desc limit 1";

                $executa_query = mysqli_query ($db,$query_amigo) or die ("Erro ao listar empreendimento");
                
                
            while ($buscar_amigo = mysqli_fetch_assoc($executa_query)) {//--verifica se sÃ£o amigos
           
             $data_vencimento_parcelas_ultimo       = $buscar_amigo['data_vencimento_parcela'];
}

}else{
	$data_vencimento_parcelas_ultimo = date('d-m-Y', strtotime("-1 month",strtotime($vencimento_restante)));
}



for($w=1; $w <= $plano_pagamento; $w++){



$vencimento2 = date('d-m-Y', strtotime("+".$w." month",strtotime($data_vencimento_parcelas_ultimo)));

$inserir = mysqli_query($db,"INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
fluxo,
cliente_id_novo,
empreendimento_id_novo,
centrocusto_id,
numero_sequencia)

values (
'$idvenda',
'$valor_parcela_financiamento',
'$vencimento2',
'Em Aberto',
'Financiamento',
'2',
'0',
'$cliente_id_novo_receber',
'$empreendimento_id_novo',
'1',
'$w'

)


	");

/*
if($tipo_empreendimento == 1)
{
	$inserir = mysqli_query($db,"INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
fluxo)

values (
'$idvenda',
'$valor_parcela_financiamento',
'$vencimento2',
'Em Aberto',
'Financiamento',
'2',
'1'

)


	");

}


*/








}














?>


<script>
	window.location="relatorio_vendas.php?idempreendimento=<?php echo $idempreendimento ?>";
</script>



<?php } ?>
