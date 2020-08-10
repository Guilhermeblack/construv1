<?php 

$idproprietarios  = $_GET["idproprietarios"];
$idimovel         = $_GET["idimovel"];




include "conexao.php";


$deleta_album = mysqli_query($db, "DELETE FROM proprietarios WHERE idproprietarios='$idproprietarios'");



  



?>
<script>
window.location ="proprietario_imovel.php?idimovel=<?php echo $idimovel ?>";
</script>