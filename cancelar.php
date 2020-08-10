<?php


$idlote 		   = $_GET["idlote"];
$idvenda 		   = $_GET["idvenda"];
$idempreendimento  = $_GET["idempreendimento"];   
   
include "conexao.php";


// Libera o lote para Disponivel
$up = mysqli_query($db, "UPDATE lote SET status='1' WHERE idlote =$idlote");


// Atualiza status da venda 1 = proposta recusada
$cancela_venda  = mysqli_query($db, "UPDATE venda SET status_venda='1' WHERE idvenda =$idvenda");

?>

<script>
	window.location="relatorio_vendas.php?idempreendimento=<?php echo $idempreendimento ?>";
</script>