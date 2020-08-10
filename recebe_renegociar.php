 <?php 

$valor 			= $_POST["valor"];
$descvenda 		= $_POST["descricao"];
$qtdparcelas 	= $_POST["qtdparcelas"];
$dataparcelas 	= $_POST["dataparcelas"];
$idvenda 		= $_POST["renegociar_idvenda"];
$tipo 			= '2';
$idempreendimento 			= $_POST["idempreendimento"];


    include "conexao.php";
    $deleta_parcelas = mysqli_query($db,"DELETE FROM parcelas WHERE venda_idvenda = '$idvenda' and tipo_venda = '$tipo' and descricao = '$descvenda' and situacao ='Em Aberto'");
    
$valor = str_replace("R$","", $valor);
$valor = str_replace(".","", $valor);
$valor = str_replace(",",".", $valor);

for($i=0; $i <= ($qtdparcelas - 1); $i++){


if($i == 0)
{
  $vencimento = $dataparcelas;
}else{
  $vencimento =  date('d-m-Y', strtotime("+".$i." month",strtotime($dataparcelas)));
}

$inserir2 = mysqli_query($db,"INSERT INTO parcelas (

venda_idvenda,
valor_parcelas,
data_vencimento_parcela,
situacao,
descricao,
tipo_venda)

values (
'$idvenda',
'$valor',
'$vencimento',
'Em Aberto',
'$descvenda',
'2'

)


  ");

  



}
    



?>

<script type="text/javascript">window.location="relatorio_vendas.php?idempreendimento=<?php echo $idempreendimento ?>";</script>