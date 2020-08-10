<?php 


$idconstruao  = $_GET["idconstruao"];




include "conexao.php";

$deletaimovel = mysqli_query($db,"DELETE FROM construao WHERE idconstruao = $idconstruao");
$deleta_album = mysqli_query($db,"DELETE FROM fotos_construao WHERE construao_idconstruao='$idconstruao'");




?>
<script>
window.location ="construcao.php";
</script>