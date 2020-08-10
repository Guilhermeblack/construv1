<?php 
	$idimovel = $_POST['idimovel'];
	$idfoto   = $_POST['idfoto'];

	include "conexao.php";

	$altera = mysqli_query ($db, "UPDATE imovel SET img_principal = '$idfoto' where idimovel = $idimovel");
?>