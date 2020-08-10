<?php 
function busca_cliente($idvenda){
  include "conexao.php";

   $query_amigo = "SELECT * FROM venda where idvenda = $idvenda";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $idcliente              = $buscar_amigo["cliente_idcliente"];

    }
    return $idcliente;
}



    include "conexao.php";
    $venda_id = $_GET["venda_id"];
    $empreendimento_id = $_GET["empreendimento_id"];

    $query_amigo = "SELECT * FROM venda_renegociacao where venda_id = $venda_id order by idvenda_renegociacao desc limit 1";
    $executa_query = mysqli_query ($db,$query_amigo);

    while ($buscar_amigo = mysqli_fetch_assoc($executa_query))
    {
      $idvenda_renegociacao = $buscar_amigo["idvenda_renegociacao"];
      $entrada              = $buscar_amigo["entrada"];
      $total_parcelas       = $buscar_amigo["total_parcelas"];
      $vencimento_primeira  = $buscar_amigo["vencimento_primeira"];
      $vencimento_restante  = $buscar_amigo["vencimento_restante"];
      $valor_parcela        = $buscar_amigo["valor_parcela"];
      $feito_por            = $buscar_amigo["feito_por"];
    }

$cliente_id_novo = busca_cliente($venda_id);
$lancamento = date('d-m-Y');



 $query_ren = "SELECT * FROM venda_ren_par where venda_ren_id = $idvenda_renegociacao";
    $executa_ren = mysqli_query ($db,$query_ren);

    while ($buscar_ren = mysqli_fetch_assoc($executa_ren))
    {
      $parcela_id = $buscar_ren["parcela_id"];





$inserir = ("UPDATE parcelas set		
					
          fluxo         = '6',
          obs_estorno   = 'RENEGOCIACAO DE CONTRATO',
          estornado_por = '$feito_por' 

		  WHERE idparcelas = $parcela_id");

 		$executa_query = mysqli_query ($db, $inserir);

}


if($entrada != ''){


$entrada_ren = mysqli_query($db,"INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
centrocusto_id,
fluxo,
empreendimento_id_novo,
cliente_id_novo,
data_lancamento_sistema,
lancamento_por,
numero_sequencia)

values (
'$venda_id',
'$entrada',
'$vencimento_primeira',
'Em Aberto',
'Primeira Entrada',
'2',
'2',
'0',
'$empreendimento_id',
'$cliente_id_novo',
'$lancamento',
'$feito_por',
'R-1'
)


  ");


}
















for($i=0; $i <= ($total_parcelas - 1); $i++){







if($i == 0)
{
  $vencimento = $vencimento_primeira;
}else{
  $vencimento =  date('d-m-Y', strtotime("+".($i-1)." month",strtotime($vencimento_restante)));
}


if($entrada != ''){

  $vencimento =  date('d-m-Y', strtotime("+".$i." month",strtotime($vencimento_restante)));

}



$cont = $i + 1;

$inserir2 = mysqli_query($db,"INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda,
centrocusto_id,
fluxo,
empreendimento_id_novo,
cliente_id_novo,
data_lancamento_sistema,
lancamento_por,
numero_sequencia)

values (
'$venda_id',
'$valor_parcela',
'$vencimento',
'Em Aberto',
'Financiamento',
'2',
'2',
'0',
'$empreendimento_id',
'$cliente_id_novo',
'$lancamento',
'$feito_por',
'R-$cont'
)


  ");

  



}
  



$atualiza_status = mysqli_query($db,"UPDATE venda_renegociacao set status = 1 WHERE venda_id = '$venda_id'");

?>

<script type="text/javascript">
  window.location="empreendimentos.php";
</script>