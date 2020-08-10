<?php 
header('Content-Type: text/html; charset=utf-8');

$funil 		= $_POST['value'];
$ativo 		= $_POST['action'];
$posicao 		= $_POST['fila'];


if (!$ativo) {
	$posicao = 0;
} 


include "conexao.php";

	$inserir = ("UPDATE crm_status SET
	crm_funil = '$ativo',    
	crm_posicaofunil = '$posicao' 
	WHERE crm_idstatus = $funil
");
	@mysqli_query($db,$inserir)
	
	?>

	<script>
		window.location="crm_cadstatus.php?cad=1";
	</script>

	

?>
