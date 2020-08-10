<?php 

$idproduto  = $_GET["idproduto"];

$idempreendimento  = $_GET["idempreendimento"];


include "conexao.php";


$deleta_album = mysqli_query($db,"DELETE FROM produto WHERE idproduto='$idproduto'");



  



?>
<script>
window.location ="cadastro_quadra.php?idempreendimento=<?php echo $idempreendimento ?>";
</script>