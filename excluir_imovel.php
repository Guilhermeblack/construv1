<?php 


$idimovel  = $_GET["idimovel"];




include "conexao.php";

$deletaimovel = mysqli_query($db,"DELETE FROM imovel WHERE idimovel = $idimovel");
$deleta_album = mysqli_query($db,"DELETE FROM fotos WHERE imovel_idimoel='$idimovel'");




?>
<script>
window.location ="imoveis.php";
</script>