<?php 
$id1 = $_POST["status"];
$id2 = $_POST["hiddenid"];

include "conexao.php";

$delete ="DELETE FROM crm_painel WHERE crm_tipopainel = '$id2'";
$exec = mysqli_query ($db, $delete) or die("Impossível Deletar Dado.");
$cnt = 0;
foreach ($id1 as $key) {
	$inserir3 = ("INSERT INTO crm_painel (
		crm_tipopainel,
		crm_statuspainel
		)
		values (
		'$id2',
		'$id1[$cnt]'
		)
		"); 
	$cnt ++;

	$executa_query = mysqli_query ($db, $inserir3) or die ("Erro ao inserir no painel.");
}
?>
	<script>
		window.location="crm_statuspainel.php?cad=1";
	</script>

