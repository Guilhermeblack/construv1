<?php 
	$idempreendimento = $_POST['idempreendimento'];
	$idfoto           = $_POST['idfoto'];

	include "conexao.php";

	$altera = mysqli_query ($db, "UPDATE empreendimento_cadastro SET img_lote = '$idfoto' where idempreendimento_cadastro = $idempreendimento");
?>