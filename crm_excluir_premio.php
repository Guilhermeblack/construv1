<?php 


if ($_GET["prm"]) {

include "conexao.php";

$ver 				= $_GET["prm"];

$queryex = "DELETE FROM crm_premio WHERE crm_idpremio = '$ver'";

$execex = mysqli_query($db, $queryex) or die("Impossível excluir!") . header('Location: crm_cadpremio.php?ex=2');



?>
<script>
window.location ="crm_cadpremio.php?ex=1";
</script>
<?php } elseif ($_GET["sts"]) {

	include "conexao.php";
	
	$ver 				= $_GET["sts"];

$queryex = "UPDATE crm_premio SET crm_statuspremio = '0' WHERE crm_idpremio = '$ver'";

$execex = mysqli_query($db, $queryex) or die("Impossível Inativar!") . header('Location: crm_cadpremio.php?in=2');
?>
<script>
window.location ="crm_cadpremio.php?in=1";
</script>
<?php } ?>