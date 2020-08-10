<?php 

$idigpm  = $_GET["idigpm"];
$idindice_correcao  = $_GET["idindice_correcao"];

include "conexao.php";

$deleta_album = mysqli_query($db,"DELETE FROM igpm WHERE idigpm='$idigpm'");



  



?>
<script>
window.location ="cadastro_igpm.php?idindice_correcao=<?php echo $idindice_correcao ?>";
</script>