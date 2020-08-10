<?php 

$idlote  = $_GET["idlote"];
$idproduto  = $_GET["idproduto"];



include "conexao.php";


$deleta_album = mysqli_query($db,"DELETE FROM lote WHERE idlote='$idlote'");



  



?>
<script>
window.location ="cadastro_lote.php?idproduto=<?php echo $idproduto ?>";
</script>