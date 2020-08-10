<?php 


$img 	   = $_GET["img"];



include "conexao.php";


$deleta_album = mysqli_query($db,"DELETE FROM slide_empreendimentos WHERE idslide_empreendimentos='$img'");





?>
<script>
window.location ="adicionar_destaque.php";
</script>