<?php



$idlote 						= $_GET["idlote"];
$idvenda 						= $_GET["idvenda"];
$idempreendimento               = $_GET["idempreendimento"];   


   
 include "conexao.php";

$up = mysqli_query($db,"UPDATE lote SET status='2' WHERE idlote =$idlote");
$up2 = mysqli_query($db,"UPDATE venda SET status_venda ='2' WHERE idvenda =$idvenda");



?>


<script>
	window.location="relatorio_vendas.php?idempreendimento=<?php echo $idempreendimento ?>";
</script>




