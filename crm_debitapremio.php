<?php 

if (isset($_POST["pts"])) {
	
$id1 = $_POST["pts"];

include "conexao.php";
$query_amigo = "SELECT * FROM crm_premio WHERE crm_idpremio = $id1 order by crm_descricaopremio asc";
	$query_slide = mysqli_query($db, $query_amigo) or die ("Erro ao listar grupo dos clientes, tente mais tarde");

			while ($buscar_slide = mysqli_fetch_assoc($query_slide)) {//--While categoria

				$id          = $buscar_slide["crm_idpremio"];
				$descpremio  = utf8_encode($buscar_slide["crm_descricaopremio"]);
				$vlrpremio 	 = $buscar_slide["crm_vlrpremio"];

			}



echo json_encode($vlrpremio);
} else {
	
$produto = 	$_POST["status"];
$id1 = 		$_POST["hiddenid"];
$vlr = 		$_POST["valorpts"];
$XXX = 		$_POST["hiddencrr"];
$desc = 	$_POST["descricao"];

include "conexao.php";
$query_amigo = "INSERT INTO crm_resgate (crm_interesseresgate, crm_corretorid, crm_vlrresgate, crm_descresgate, crm_codproduto) VALUES ($XXX, $id1, $vlr,'$desc', $produto)";

	$query_slide = mysqli_query($db, $query_amigo) or die ("Erro ao cadastrar valores, tente mais tarde");

?>

<script>
	window.location= "crm_debitop.php?cad=1";
</script>

<?php }



?>

	

