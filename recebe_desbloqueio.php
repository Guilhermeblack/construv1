<?php



$lote						= $_GET["lote"];
$idproduto						= $_GET["idproduto"];
   include "conexao.php";

$up = mysqli_query($db, "UPDATE lote SET status='1' WHERE idlote =$lote");



 ?>

<script>
	window.location="cadastro_lote.php?idproduto=<?php echo $idproduto ?>";
</script>