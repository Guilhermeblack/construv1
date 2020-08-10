<?php

$idimovel = $_GET["idimovel"];
$op = $_GET["op"];

;


include "conexao.php";
	  $excluir_comando="UPDATE imovel SET 
	  slide='$op'
	  
	  
	   WHERE idimovel =$idimovel";
	  $excluir = mysqli_query($db,$excluir_comando);
?>
<script>
window.location="imoveis.php";
</script>
